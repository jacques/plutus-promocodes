<?php declare(strict_types=1);
/**
 * Promotional Codes Plugin for Plutus.
 *
 * THIS SOFTWARE IS PROVIDED BY JACQUES MARNEWECK AND ITS CONTRIBUTORS ``AS
 * IS'' AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO,
 * THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR
 * PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL JACQUES MARNEWECK OR ITS
 * CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL,
 * EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO,
 * PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS;
 * OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY,
 * WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR
 * OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF
 * ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * @author    Jacques Marneweck <jacques@siberia.co.za>
 * @copyright 2019 Jacques Marneweck.  All rights strictly reserved.
 * @license   proprietary
 */

use Plutus\Models\AccountPlan;
use Plutus\Models\Agency;
use Plutus\Models\AgencyAgent;
use Plutus\Models\Promocode;
use Plutus\Models\User;

$app->get('/admin/promocodes', $authenticate($app), $is_admin($app), function () use ($app, $config) {
    if (!array_key_exists('promocodes', $config['features'])) {
        $app->notFound();
    }

    if (
        !is_superadmin() &&
        !is_financeadmin()
    ) {
        $app->notFound();
    }

    if ($app->request()->get('agency_id')) {
        $agency_id = $app->request()->get('agency_id');
        $promocodes = Promocode::with('agency')
            ->where('agency_id', $agency_id)
            ->get();
    } else {
        $promocodes = Promocode::all();
    }

    $app->template->bulkAssign(
        compact(
            'agencies',
            'promocodes'
        )
    );
    $app->template->display('promocodes/index.tpl');
});

$app->post('/admin/promocodes', $authenticate($app), $is_admin($app), function () use ($app, $config) {
    if (!array_key_exists('promocodes', $config['features'])) {
        $app->notFound();
    }

    if (
        !is_superadmin() &&
        !is_financeadmin()
    ) {
        $app->notFound();
    }

    $post = $app->request()->post();

    $v = new \Valitron\Validator($post);
    $v->rule('required', [
        'promocode',
        'agency_id',
        'agent_id',
        'account_plan_id',
        'udf1',
    ])->message('Please enter the {field}');
    $v->rule('lengthMin', 'promocode', 2);
    $v->labels([
        'promocode'       => 'Promotional Code',
        'account_plan_id' => 'Default Account Plan',
        'agency_id'       => 'Assign to Agency',
        'agent_id'        => 'Assigned to Agent',
        'udf1'            => 'UDF1',
    ]);

    $ok = $v->validate();
    if ($ok) {
        $promocode = (new PromoCode());
        $promocode->promocode = $post['promocode'];
        $promocode->agency_id = $post['agency_id'];
        $promocode->agent_id = $post['agent_id'];
        $promocode->account_plan_id = $post['account_plan_id'];
        $promocode->udf1 = $post['udf1'];
        $promocode->save();

        $app->redirect('/admin/promocodes');
    }

    var_dump($app->request()->post());

    $app->template->display('promocodes/new.tpl');
});

$app->get('/admin/promocodes/new', $authenticate($app), $is_admin($app), function () use ($app, $config) {
    if (!array_key_exists('promocodes', $config['features'])) {
        $app->notFound();
    }

    if (
        !is_superadmin() &&
        !is_financeadmin()
    ) {
        $app->notFound();
    }

    $agencies = Agency::orderBy('agency_name')
        ->get()
        ;

    /**
     * Agencies which have agents are shown on the dropdown.
     */
    $agents = AgencyAgent::selectRaw("\n            u.id AS id,\n            CONCAT(u.first_name, ' ', u.last_name) AS name,\n            agencies__agents.agency_id\n        ")
        ->leftJoin('users as u', 'u.id', '=', 'agencies__agents.user_id')
        ->whereNotIn('agencies__agents.agency_id', [3])
        ->groupBy('u.id')
        ->groupBy('agencies__agents.agency_id')
        ->orderBy('u.first_name', 'ASC')
        ->orderBy('u.last_name', 'ASC')
        ->get();

    $account_plans = AccountPlan::where('account_type', 'wallet')
        ->where('active', 1)
        ->orderBy('monthly')
        ->get()
        ;

    $app->template->bulkAssign(
        compact(
            'account_plans',
            'agencies',
            'agents'
        )
    );
    $app->template->display('promocodes/new.tpl');
});

$app->map('/admin/promocodes/:promocode/edit', $authenticate($app), $is_admin($app), function () use ($app, $config) {
    if (!array_key_exists('promocodes', $config['features'])) {
        $app->notFound();
    }

    if (
        !is_superadmin() &&
        !is_financeadmin()
    ) {
        $app->notFound();
    }

    if ($app->request()->isPost()) {
    }
})->via('GET', 'POST');
