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
    <!-- Birthday input-->
    <div class="form-group">
      <label class="col-sm-4 control-label" for="birthday-reg">Date of Birth</label>
      <div class="col-sm-8">
        <input id="birthday-reg" name="birthday-reg" type="date" placeholder="MM/DD/YYYY" class="form-control input-md" required="">
      </div>
    </div>
    <!-- School input-->
    <div class="form-group">
      <label class="col-sm-4 control-label" for="school-reg">School</label>
      <div class="col-sm-8">
        <input id="school-reg" name="school-reg" type="text" placeholder="School name" class="form-control input-md" required="">
        <span class="help-block">e.g. "Sandia High School" or "University of New Mexico"</span> </div>
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
          <option value="8">Tuba</option>
          <option value="16">Snare</option>
          <option value="32">Tenors</option>
          <option value="64">Bass</option>
          <option value="128">Cymbals</option>
        </select>
      </div>
    </div>
    <!-- 2nd Instrument Select -->
    <div class="form-group">
      <label class="col-sm-4 control-label" for="instrument-select2">Alternate Instrument</label>
      <div class="col-sm-8">
        <select id="instrument-select2" name="instrument-select2" class="form-control">
          <option value="0" disabled selected>- SELECT -</option>
          <option value="1">Trumpet</option>
          <option value="2">Mellophone</option>
          <option value="4">Baritone/Euphonium</option>
          <option value="8">Tuba</option>
          <option value="16">Snare</option>
          <option value="32">Tenors</option>
          <option value="64">Bass</option>
          <option value="128">Cymbals</option>
          <option value="256">N/A</option>
        </select>
      </div>
    </div>
    <!-- Own-Instrument Select -->
    <div class="form-group">
      <label class="col-sm-4 control-label" for="own-instrument">Do you have access to your own instrument? (Brass only)</label>
      <div class="col-sm-4">
        <div class="radio">
          <label for="own-instrument-0">
            <input type="radio" name="own-instrument" id="own-instrument-0" value="0" required>
            No/Not Applicable </label>
        </div>
        <div class="radio">
          <label for="own-instrument-1">
            <input type="radio" name="own-instrument" id="own-instrument-1" value="1" required>
            Yes </label>
        </div>
      </div>
    </div>
    <h4 class="form-group" style="text-align: center;">You will receive an email with instructions for early payment.</h4>
    <input type="hidden" value="<?php echo $id?>" name="ev_id" />
    <!-- Submit Button -->
    <div class="form-group text-center">
      <div class="col-sm-12">
        <button id="submit-reg" name="submit-reg" class="btn btn-arsenal">Register for Event</button>
      </div>
    </div>
    <div id='error-zone' class="hidden">
      <h3 style="text-align:center; color: red;">There seems to be an issue.</h3>
      <p>Try using a different email, only one registration per email is allowed. If the problem persists, email <a href="mailto:tech@arsenalperformingarts.org">tech@arsenalperformingarts.org</a></p>
    </div>
  </fieldset>
</form>
<script>
$('#event-form').submit(function(event) {
	var formData = {
		'namef'  : $('input[name=name-first-reg]').val(),
		'namel'  : $('input[name=name-last-reg]').val(),
		'birth'  : $('input[name=birthday-reg]').val(),
		'school' : $('input[name=school-reg]').val(),
		'email'  : $('input[name=email-reg]').val(),
		'inst1'  : $('select[name=instrument-select1]').val(),
		'inst2'  : $('select[name=instrument-select2]').val(),
		'ownin'  : $('input[name=own-instrument]:checked').val(),
		'ev_id'  : $('input[name=ev_id]').val(),
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
			var div = $("<div id='success-note' style='text-align:center'><h3>Thank you for registering!</h3><p>You will receive an email from us shortly detailing advance payment, event details, and contact information. Be sure to check your spam folder!</p></div></div>").hide();
			$("#inner").append(div);
			$("#success-note").delay(500).fadeIn("slow");
			$("#reRegisterButton").delay(500).fadeIn("slow");
		} else if(data == 1) {
			alert("It appears that this email address has already registered for this event. Email tech@arsenalperformingarts.org if this is a mistake.");
		} else if(data == 2) {
			alert("It appears that there is no way for you to pre-pay set up! The system administrator has been notified, and will email you shortly.");
		} else {
			alert("Form processing error. Please try reloading the page. Email tech@arsenalperformingarts.org if issues persist.");
		}
	});
});
</script>