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
use Plutus\Models\PromoCode;
use Plutus\Models\User;

$app->get('/admin/promocodes', $authenticate($app), $is_admin($app), function () use ($app, $config) {
    if (!array_key_exists('promocodes', $config['features'])) {
        $app->notFound();
    }

});

$app->post('/admin/promocodes', $authenticate($app), $is_admin($app), function () use ($app, $config) {
    if (!array_key_exists('promocodes', $config['features'])) {
        $app->notFound();
    }

});

$app->get('/admin/promocodes/new', $authenticate($app), $is_admin($app), function () use ($app, $config) {
    if (!array_key_exists('promocodes', $config['features'])) {
        $app->notFound();
    }

});

$app->map('/admin/promocodes/:promocode/edit', $authenticate($app), $is_admin($app), function () use ($app, $config) {
    if (!array_key_exists('promocodes', $config['features'])) {
        $app->notFound();
    }

    if ($app->request()->isPost()) {
    }
})->via('GET', 'POST');
