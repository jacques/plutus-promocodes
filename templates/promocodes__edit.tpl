{include file="admin__header.tpl" title="Edit Promo Code" nav="config"}

      <div>
        <h2 class="page-header">Edit Promo Code</h2>
      </div>

      <div>
{include file="_partials/errorsnonsession.tpl"}

      <form action="/admin/promocodes/{$code}/edit" method="post" class="form-horizontal" role="form" accept-charset="UTF-8">
<input name="utf8" type="hidden" value="&#x2713;" />
{include file="_partials/csrf.tpl"}
  <div class="form-group">
    <label for="inputPromoCode" class="col-sm-2 control-label">Promo Code <span class="required">*</span></label>
    <div class="col-sm-10">
      <input type="text" name="promocode" class="form-control" id="inputPromoCode" placeholder="PromoCode" value="{if isset($promocode)}{$promocode}{/if}">
    </div>
  </div>
  <div class="form-group">
    <label for="inputAgency" class="col-sm-2 control-label">Agency Name <span class="required">*</span></label>
    <div class="col-sm-10">
      <select name="agency_id" class="form-control" id="inputAgency">
        <option value="">Please select...</option>
{foreach $agencies item=agency}
        <option value="{$agency->id}"{if isset($agency_id) && $agency->id eq $agency_id} selected{/if}>{$agency->agency_name}</option>
{/foreach}
      </select>
    </div>
  </div>
  <div class="form-group">
    <label for="inputAgent" class="col-sm-2 control-label">Assign to Agent <span class="required">*</span></label>
    <div class="col-sm-10">
      <select name="agent_id" class="form-control" id="inputAgent">
        <option value="" data-agency="-1">Please select...</option>
          {foreach $agents item=row}
        <option value="{$row.id}"{if isset($agent_id) && $row.id eq $agent_id} selected{/if} data-agency="{$row.agency_id}">{$row.name}</option>
          {/foreach}
      </select>
    </div>
  </div>
  <div class="form-group">
    <label for="inputAgent" class="col-sm-2 control-label">Account Plan <span class="required">*</span></label>
    <div class="col-sm-10">
      <select name="account_plan_id" class="form-control" id="inputAccountPlan">
        <option value="">Please select...</option>
          {foreach $account_plans item=row}
        <option value="{$row.id}"{if isset($account_plan_id) && $row.id eq $account_plan_id} selected{/if}>{$row.name} @ {($row.monthly/100)|string_format:"%0.2f"}</option>
          {/foreach}
      </select>
    </div>
  </div>
  <div class="form-group">
    <label for="inputUdf1" class="col-sm-2 control-label">UDF1 <span class="required">*</span></label>
    <div class="col-sm-10">
      <input type="text" name="udf1" class="form-control" id="inputUdf1" placeholder="Udf1" value="{if isset($udf1)}{$udf1}{/if}">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button data-disable-with="Processing ..." type="submit" class="btn btn-primary">Save Promo Code</button>
    </div>
  </div>
</form>
    </div>

{include file="admin__footer.tpl"}
