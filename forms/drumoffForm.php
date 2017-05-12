<form class="form-horizontal" action="/scripts/eventsubmit.php" method="post" id="event-form">
  <fieldset>
    
    <!-- Form Name -->
    <legend><?php echo $name ?></legend>
    <div class="text-center">
      <button type="button" data-toggle="collapse" data-target="#description" class="btn btn-default"  style="margin: 10px;">Description</button>
    </div>
    <section id="description" class="collapse in"> <?php echo $description ?> </section>
    <br/>
    
    <!-- Unit Name input-->
    <div class="form-group">
      <label class="col-sm-4 control-label" for="drumoff-unit">Unit Name</label>
      <div class="col-sm-8">
        <input id="drumoff-unit" name="drumoff-unit" type="text" placeholder="e.g. The Awesome Line" class="form-control input-md" required="">
      </div>
    </div>
    
    <!-- School Name input-->
    <div class="form-group">
      <label class="col-sm-4 control-label" for="drumoff-school">School (if applicable)</label>
      <div class="col-sm-8">
        <input id="drumoff-school" name="drumoff-school" type="text" placeholder="e.g. Sandia High School" class="form-control input-md">
      </div>
    </div>
    
    <!-- Contact name input-->
    <div class="form-group">
      <label class="col-sm-4 control-label" for="drumoff-contact">Contact Name</label>
      <div class="col-sm-8">
        <input id="drumoff-contact" name="drumoff-contact" type="text" placeholder="" class="form-control input-md" required="">
      </div>
    </div>
        
    <!-- Contact email input-->
    <div class="form-group">
      <label class="col-sm-4 control-label" for="drumoff-email">Contact Email</label>
      <div class="col-sm-8">
        <input id="drumoff-email" name="drumoff-email" type="email" placeholder="sample@example.com" class="form-control input-md" required="">
      </div>
    </div>
    
    <!-- City Name input-->
    <div class="form-group">
      <label class="col-sm-4 control-label" for="drumoff-city">City</label>
      <div class="col-sm-8">
        <input id="drumoff-city" name="drumoff-city" type="text" placeholder="e.g. Albuquerque" class="form-control input-md" required="">
      </div>
    </div>
    
    <!-- Performer Count input-->
    <div class="form-group">
      <label class="col-sm-4 control-label" for="drumoff-performers">Number of Performers</label>
      <div class="col-sm-2">
        <input id="drumoff-performers" name="drumoff-performers" type="number" min="1" placeholder="#" class="form-control input-md" required="">
      </div>
      
      <!-- Cost output -->
      <label class="col-sm-2 control-label" for="drumoff-cost">Entry Fee</label>
      <div class="col-sm-4">
        <input id="drumoff-cost" name="drumoff-cost" type="text" placeholder="-" class="form-control" readonly>
      </div>
    </div>
    
    <!-- Staff input -->
    <div class="form-group">
      <label class="col-sm-4 control-label" for="drumoff-staff">Staff Names and Titles</label>
      <div class="col-sm-8">
        <textarea class="form-control" id="drumoff-staff" name="drumoff-staff">First Last, Title
First Last, Title</textarea>
      </div>
    </div>
    
    <!-- Payment method selection -->
    <div class="form-group">
      <label class="col-sm-4 control-label" for="drumoff-payment">Payment Method</label>
      <div class="col-sm-8">
        <label class="radio-inline" for="drumoff-payment-0">
          <input type="radio" name="drumoff-payment" id="drumoff-payment-0" value="Online" checked="checked">
          Online </label>
        <label class="radio-inline" for="drumoff-payment-1">
          <input type="radio" name="drumoff-payment" id="drumoff-payment-1" value="Check">
          Check </label>
        <label class="radio-inline" for="drumoff-payment-2">
          <input type="radio" name="drumoff-payment" id="drumoff-payment-2" value="Cash">
          Cash </label>
      </div>
    </div>
    <div id="cash-check-note" class="form-group" style="text-align: center; display: none;">
      <div class="col-sm-12">
        <h4>
          <p> Please mail/deliver cash/check payments to:</p>
          Arsenal Performing Arts<br>
          3301 Carlisle Blvd. NE<br>
          Albuquerque NM, 87110</h4>
        <h4>
          <p>Please make checks payable to:</p>
          Arsenal Performing Arts, Inc</h4>
      </div>
    </div>
    <h4 id="online-note" class="form-group" style="text-align: center;">You will receive an email with instructions for early payment.</h4>
    <input type="hidden" value="<?php echo $id?>" name="ev_id" />
    <!-- Submit Button -->
    <div class="form-group text-center">
      <div class="col-sm-12">
        <button id="submit-reg" name="submit-reg" class="btn btn-arsenal">Register for Event</button>
      </div>
    </div>
  </fieldset>
</form>
<script>
function calculate_cost(count) {
	if(count <= 10) {
		return count * 20;
	} else {
		return 200;
	}
}
$("#drumoff-performers").change(function() {
	var count = calculate_cost($(this).val());
	$("#drumoff-cost").val("$"+count.toString());
});
$( "#drumoff-performers" ).keyup(function() {
	var count = calculate_cost($(this).val());
	$("#drumoff-cost").val("$"+count.toString());
});
$("input[name='drumoff-payment']").click(function() {
	if($(this).val() !== "Online"){
	  	$("#online-note").fadeOut("slow");
		$("#cash-check-note").delay(500).fadeIn("slow");
	} else {
	  	$("#online-note").delay(500).fadeIn("slow");
		$("#cash-check-note").fadeOut("slow");
	}
 });
$('#event-form').submit(function(event) {
	var formData = {
		'name'       : $('input[name=drumoff-unit]').val(),
		'school'     : $('input[name=drumoff-school]').val(),
		'city'       : $('input[name=drumoff-city]').val(),
		'performers' : $('input[name=drumoff-performers]').val(),
		'total_fee'  : $('input[name=drumoff-cost]').val(),
		'contact'    : $('input[name=drumoff-contact]').val(),
		'email'      : $('input[name=drumoff-email]').val(),
		'staff_info' : $('textarea[name=drumoff-staff]').val(),
		'pay_method' : $('select[name=drumoff-payment]').val(),
		'ev_id'      : $('input[name=ev_id]').val(),
	};
	event.preventDefault();
	$.ajax({
		type        : 'POST',
		url         : './scripts/groupsubmit.php',
		data        : formData, 
		dataType    : 'html', 
		encode      : true
	})
	.done(function(data) {
		if(data == 0) {
			$('#event-form').fadeOut("slow");
			$("#backButton").fadeOut("fast");
			var div = $("<div id='success-note' style='text-align:center'><h3>Thank you for registering!</h3><p>You will receive an email from us shortly detailing the online payment option, event details, and contact information. Be sure to check your spam folder!</p></div></div>").hide();
			$("#inner").append(div);
			$("#success-note").delay(500).fadeIn("slow");
			$("#reRegisterButton").delay(500).fadeIn("slow");
		} else if(data == 1) {
			alert("It appears that this email address has already registered for this event. Email tech@arsenalperformingarts.org if this is a mistake.");
		} else if(data == 2) {
			alert("It appears that there is no way for you to pre-pay set up! The system administrator has been notified, and will email you shortly.");
		} else {
			alert("Form processing error. Please try reloading the page, though this is likely on our end. Email tech@arsenalperformingarts.org if issues persist. Code: 00"+data);
		}
	});
});
</script>