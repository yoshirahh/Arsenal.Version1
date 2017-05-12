<form class="form-horizontal" action="/scripts/eventsubmit.php" method="post" id="event-form">
  <fieldset>
    <!-- Form Name -->
    <legend><?php echo $name ?></legend>
    <div class="text-center">
      <button type="button" data-toggle="collapse" data-target="#description" class="btn btn-default"  style="margin: 10px;">Description</button>
    </div>
    <section id="description" class="collapse in"> <?php echo $description ?> </section>
    <br/>
    <!-- Name input-->
    <div class="form-group">
      <label class="col-sm-4 control-label" for="name-first-reg">Name</label>
      <div class="col-sm-8">
        <input id="name-first-reg" name="name-first-reg" type="text" placeholder="First" class="form-control input-md" required="">
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-4 control-label" for="name-last-reg"></label>
      <div class="col-sm-8">
        <input id="name-last-reg" name="name-last-reg" type="text" placeholder="Last" class="form-control input-md" required="">
      </div>
    </div>
    <!-- Email input-->
    <div class="form-group">
      <label class="col-sm-4 control-label" for="email-reg">Email Address</label>
      <div class="col-sm-8">
        <input id="email-reg" name="email-reg" type="email" placeholder="example@place.com" class="form-control input-md" required="">
      </div>
    </div>
    <!-- 1st Instrument Select -->
    <div class="form-group">
      <label class="col-sm-4 control-label" for="instrument-select1">Primary Instrument</label>
      <div class="col-sm-8">
        <select id="instrument-select1" name="instrument-select1" class="form-control" required>
          <option value="0" disabled selected>- SELECT -</option>
          <option value="1">Trumpet</option>
          <option value="2">Mellophone</option>
          <option value="4">Baritone/Euphonium</option>
          <option value="16">Snare</option>
          <option value="32">Tenors</option>
          <option value="128">Cymbals</option>
        </select>
      </div>
    </div>
    <!-- School input-->
    <div class="form-group">
      <label class="col-sm-4 control-label" for="school-reg">School</label>
      <div class="col-sm-8">
        <input id="school-reg" name="school-reg" type="text" placeholder="School name" class="form-control input-md" required="">
        <span class="help-block">e.g. "Sandia High School" or "University of New Mexico"</span> </div>
    </div>
    
    <!-- Parent name input-->
    <div class="form-group">
      <label class="col-sm-4 control-label" for="p-name-first-reg">Parent Name</label>
      <div class="col-sm-8">
        <input id="p-name-first-reg" name="p-name-first-reg" type="text" placeholder="First" class="form-control input-md" required="">
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-4 control-label" for="p-name-last-reg"></label>
      <div class="col-sm-8">
        <input id="p-name-last-reg" name="p-name-last-reg" type="text" placeholder="Last" class="form-control input-md" required="">
      </div>
    </div>
    <!-- Parent email input-->
    <div class="form-group">
      <label class="col-sm-4 control-label" for="p-email-reg">Parent Email Address</label>
      <div class="col-sm-8">
        <input id="p-email-reg" name="p-email-reg" type="email" placeholder="example@place.com" class="form-control input-md" required="">
      </div>
    </div>
    <h4 class="form-group" style="text-align: center;">You will receive an email with instructions for the audition within 24 hours.</h4>
    <input type="hidden" value="<?php echo $id?>" name="ev_id" />
    <!-- Submit Button -->
    <div class="form-group text-center">
      <div class="col-sm-12">
        <button id="submit-reg" name="submit-reg" class="btn btn-arsenal">Register for Auditions</button>
      </div>
    </div>
  </fieldset>
</form>
<script>
$('#event-form').submit(function(event) {
	var formData = {
		'first_name'  : $('input[name=name-first-reg]').val(),
		'last_name'  : $('input[name=name-last-reg]').val(),
		'email'  : $('input[name=email-reg]').val(),
		'parent_first_name': $('input[name=p-name-first-reg]').val(),
		'parent_last_name': $('input[name=p-name-last-reg]').val(),
		'birthday'  : $('input[name=birthday-reg]').val(),
		'school_id' : $('input[name=school-reg]').val(),
		'parent_email': $('input[name=p-email-reg]').val(),
		'primary_instrument'  : $('select[name=instrument-select1]').val(),
		'secondary_instrument'  : 0,
		'ev_id' : $('input[name=ev_id]').val(),
	};
	event.preventDefault();
	$.ajax({
		type        : 'POST',
		url         : '/scripts/eventsubmit.php',
		data        : formData, 
		dataType    : 'html',
		encode      : true
	})
	.done(function(data) {
		if(data == 0) {
			$('#event-form').fadeOut("slow");
			$("#backButton").fadeOut("fast");
			var div = $("<div id='success-note' style='text-align:center'><h3>Thank you for registering!</h3><p>You will receive an email from us shortly detailing the instructions for the audition. Be sure to check your spam folder!</p></div></div>").hide();
			$("#inner").append(div);
			$("#success-note").delay(500).fadeIn("slow");
			$("#reRegisterButton").delay(500).fadeIn("slow");
		} else if(data == 1) {
			alert("It appears that this email address has already registered for this event. Email tech@arsenalperformingarts.org if this is a mistake.");
		} else if(data == 2) {
			alert("It appears that there is no way for you to pre-pay set up! The system administrator has been notified, and will email you shortly.");
		} else {
			alert("Form processing error. This is likely on our end, so email tech@arsenalperformingarts.org. Error code: ");
		}
	});
});
</script>