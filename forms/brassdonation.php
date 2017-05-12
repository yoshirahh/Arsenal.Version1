<form class="form-horizontal" action="https://www.paypal.com/cgi-bin/webscr" method="post" name="paypal" id="paypal" target="_blank" autocomplete="on">
<!-- You can replace _donations with _xclick if wished -->
  <input type="hidden" name="cmd" value="_donations">
  <!--Change this to your PayPal Email Address -->
  <input type="hidden" name="item_name" value="Arsenal Brass Campaign Donation">
  <input type="hidden" name="business" value="arsenaldbc@gmail.com">
  <!--Change this to your PayPal Email Address -->
  <input type="hidden" name="receiver_email" value="arsenaldbc@gmail.com">
  <!--- Add You Business Name or Item Name -->
  <input type="hidden" name="brass_donation" value="Donation to Arsenal Brass Campaign">

<fieldset>
<!-- Donation Amount-->
<div class="form-group">
  <label class="col-md-4 control-label" for="amount">Donation Amount</label>
  <div class="col-md-8">
	<div class="input-group">
	  <span class="input-group-addon">USD</span>
	  <input type="text" name="amount" id="amount" value="" min="1" maxlength="10" class="form-control" placeholder="ex: 25" onKeyPress="return restrictChars(event, this)">
	</div>
	<p class="help-block">Poster eligibility requires a minimum of $25 is required. Values rounded down to nearest whole dollar.</p>
  </div>
</div>

<!-- Poster Selection -->
<div class="form-group" id="posterchoice">
  <label class="col-md-4 control-label" for="posterSelection">Do you want the poster?</label>
  <div class="col-md-4">
  <div class="radio">
	<label for="posterSelection-0">
	  <input type="radio" name="posterSelection" id="posterSelection-0" value="0" checked="checked">
	  No
	</label>
	</div>
  <div class="radio">
	<label for="posterSelection-1">
	  <input type="radio" name="posterSelection" id="posterSelection-1" value="1">
	  Yes
	</label>
	</div>
  </div>
</div>

<!-- Delivery Location -->
<div class="form-group" id="deliverychoice">
  <label class="col-md-4 control-label" for="deliverySelection">Choose delivery location:</label>
  <div class="col-md-4">
  <div class="radio">
	<label for="deliverySelection-0">
	  <input type="radio" name="deliverySelection" id="deliverySelection-0" value="0" checked="checked">
	  Music Mart
	</label>
	</div>
  <div class="radio">
	<label for="deliverySelection-1">
	  <input type="radio" name="deliverySelection" id="deliverySelection-1" value="1">
	  Personal ($8 shipping charge applies)
	</label>
	</div>
  </div>
</div>

<!-- Personal Address -->
<div class="form-group" id="addresschoice">
  <label class="col-md-4 control-label" for="shipping_address">Personal address</label>  
  <div class="col-md-8">
  <div class="col-md-12"><input id="address1" name="address1" type="text" placeholder="3301 Carlisle Blvd NE"class="form-control input-md"></div>
  <div class="col-md-12"><input id="city" name="city" type="text" placeholder="Albuquerque" class="form-control input-md"></div>
  <div class="col-md-4"><input id="state" name="state" type="text" placeholder="NM" class="form-control input-md"></div>
  <div class="col-md-8"><input id="zip" name="zip" type="text" placeholder="87110" class="form-control input-md"></div>
  <div class="help-block col-md-12">Please include street, city, state, and ZIP</div>  
  </div>
</div>

  <input type="hidden" name="custom" value="No">

<!--Change this to your return page -->
  <input type="hidden" name="return" value="http://arsenalperformingarts.org/brass">
  <!--Change this to your cancel page -->
  <input type="hidden" name="cancel_return" value="http://arsenalperformingarts.org/brass">
  <!-- no_shipping 
0 prompt for an address, but do not require. 
1  do not prompt for an address. 
2 prompt for an address and require one, needed for gift aid.
 -->
<!--  <input type="hidden" name="no_shipping" value="2">-->
  <!--Shipping Cost Per Item-->
  <input type="hidden" name="shipping" id="shipping" value="8" />

<!-- Submit Button -->
<div class="form-group">
  <div class="col-md-12" style="text-align: center;">
	<button id="submit" name="submit" class="btn btn-primary">Proceed to Checkout</button>
  </div>
</div>

</fieldset>
</form>

<script>
function getKey(e) {
  if (window.event)
    return window.event.keyCode;
  else if (e)
    return e.which;
  else
    return null;
}

function restrictChars(e, obj) {
  var CHAR_AFTER_DP = 2; // number of decimal places   
  var validList = "0123456789"; // allowed characters in field   
  var key, keyChar;
  key = getKey(e);
  if (key == null) return true;
  // control keys   
  // null, backspace, tab, carriage return, escape   
  if (key == 0 || key == 8 || key == 9 || key == 13 || key == 27)
    return true;
  // get character   
  keyChar = String.fromCharCode(key);
  // check valid characters   
  if (validList.indexOf(keyChar) != -1) {
    // check for existing decimal point   
    var dp = 0;
    if ((dp = obj.value.indexOf(".")) > -1) {
      if (keyChar == ".")
        return false; // only one allowed   
      else {
        // room for more after decimal point?   
        if (obj.value.length - dp <= CHAR_AFTER_DP)
          return true;
      }
    } else return true;
  }
  // not a valid character   
  return false;
}
	
// Pass data-foo selected amount to amount field
$(document).ready(function() {
	var $add_on = 0;
  $("#posterchoice").hide();
  $("#deliverychoice").hide();
  $("#addresschoice").hide();
  $('#item_number').change(function() {
	$('#amount').val( $(this).find('option:selected').data('foo') );
	$("#amount" ).trigger( "focus" );
	$("#amount" ).trigger('keyup');
  });
  $("#amount").change(function() {
	if(parseInt($("#amount").val(), 10) >= 25) {
	  $("#posterchoice").fadeIn("fast");
	} else {
	$add_on = 0;
	  $("#addresschoice").fadeOut("fast");
	  $("#deliverychoice").fadeOut("fast");
	  $("#posterchoice").fadeOut("fast");
	}
  });

  $('input[name=posterSelection]').change(function() {
	if ($('input[name=posterSelection]:checked').val() == 1) {
	$add_on = 8;
	  $("#deliverychoice").fadeIn("fast");
	} else {
	$add_on = 0;
	  $("#addresschoice").fadeOut("fast");
	  $("#deliverychoice").fadeOut("fast");
	}
  });
	
  $('input[name=deliverySelection]').change(function() {
	if ($('input[name=deliverySelection]:checked').val() == 1) {
	  $("#addresschoice").fadeIn("fast");
	} else {
	  $("#addresschoice").fadeOut("fast");
	}
  });
	
  $('#paypal').on('submit', function(e) { //use on if jQuery 1.7+
	  $("#amount").val(parseInt($("#amount").val()) + $add_on)
	  $("input[name=custom]").val($add_on);
	  var addr = $('input[name=address1]').val() + " " + $('input[name=city]').val() + " " + $('input[name=state]').val() + " " + $('input[name=zip]').val();
	  var in_data = {		
		'choice'   : $('input[name=posterSelection]:checked').val(),
		'donation' : $('input[name=amount]').val(),
		'delivery' : $('input[name=deliverySelection]:checked').val(),
		'address'  : addr
	  }
	  $.ajax(
		{ url: '/scripts/email',
         data: in_data,
         type: 'post',
         success: function(output) {}
	  });
  });
});
</script>