<!-- PayPal Payment -->
<div class='form-group'>
<form action='https://www.paypal.com/cgi-bin/webscr' method='post' target='_top'>
  <input type='hidden' name='cmd' value='_s-xclick'>
  <input type='hidden' name='custom' value='_s-xclick'>
  <input type='hidden' name='hosted_button_id' value='SM8VM9AX26CEW'>
  <div class='row'>
    <div class='col-md-4 control-label'>
      <label>
        <input type='hidden' name='on0' value='Clinic Choice'>
        Clinic Choice</label>
    </div>
    <div class='col-md-5'>
      <select name='os0' class='form-control'>
        <option value='Arsenal Clinic'>Arsenal Clinic $30.00 USD</option>
        <option value='Sentinel Clinic (2 day)'>Sentinel Clinic (2 day) $30.00 USD</option>
        <option value='Sentinel Clinic (1 day)'>Sentinel Clinic (1 day) $20.00 USD</option>
      </select>
    </div>
    <div class='col-md-3 center-block'>
      <input type='hidden' name='currency_code' value='USD'>
      <input type='submit' value='Pay Now' name='submit-paypal' title='PayPal - The safer, easier way to pay online!' class='btn btn-success'>
    </div>
  </div>
</form>
</div