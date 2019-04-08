{include file="admin__header.tpl" title="Promocodes" nav="config"}

{if isset($smarty.session.flash.success)}
        <div class="alert alert-success" role="alert">{$smarty.session.flash.success}</div>
{/if}

      <div class="page-header">
       <div class="pull-right hidden-print"><a href="/admin/promocodes/new" class="btn btn-primary"><i class="fa fa-fw fa-plus-circle"></i> Add Promo Code</a></div>
        <h3>Promocodes</h3>
      </div>

      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>#</th>
            <th>Promocode</th>
            <th>Agency</th>
            <th>Default Agent</th>
            <th>Default Account Plan</th>
            <th>UDF1</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
{foreach $promocodes item=row}
          <tr>
            <td>{$row->id|escape}</td>
            <td>{$row->promocode|escape}</td>
            <td>{$row->agency->agency_name|escape}</td>
            <td>{$row->agent->first_name|escape} {$row->agent->last_name|escape}</td>
            <td>{$row->account_plan->name|escape}</td>
            <td>{$row->udf1|escape}</td>
            <td>
              <a href="/admin/promocodes/{$row->id}/edit"><i class="fa fa-pencil fa-fw"></i> Edit</a>
              <a href="/admin/promocodes/{$row->id}/delete"><i class="fa fa-trash fa-fw"></i> Soft Delete</a>
            </td>
          </tr>
{/foreach}
        </tbody>
      </table>

{include file="admin__footer.tpl"}
