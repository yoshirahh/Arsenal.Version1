<form class="form-horizontal" id="volunteer-contact-form" action="./scripts/volunteer-script.php" method="post">
	<fieldset>
		<!-- Form Name -->
		<h3 style="text-align:center">Volunteer Form</h3>
		<h5>Use this form to sign up to voluteer with Arsenal! We'll send you some emails with details as events arise.</h5>
		<!-- Name input-->
		<div class="form-group">
			<label class="col-sm-4 control-label" for="name-volunteer">Full Name</label>
			<div class="col-sm-8">
				<input id="name-volunteer" name="name-volunteer" type="text" placeholder="Jane Doe" class="form-control input-md" required="">
			</div>
		</div>

		<!-- Email input-->
		<div class="form-group">
			<label class="col-sm-4 control-label" for="email-volunteer">Email</label>
			<div class="col-sm-8">
				<div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
					<input id="email-volunteer" name="email-volunteer" class="form-control" placeholder="sample@example.com" type="email" required="">
				</div>
			</div>
		</div>

		<!-- Phone input-->
		<div class="form-group">
			<label class="col-sm-4 control-label" for="phone-volunteer">Phone</label>
			<div class="col-sm-8">
				<div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-earphone"></span></span>
					<input id="phone-volunteer" name="phone-volunteer" class="form-control" placeholder="(505) 123 - 4567" type="tel">
				</div>
			</div>
		</div>

		<!-- Volunteer Group -->
		<div class="form-group">
			<label class="col-sm-4 control-label" for="groups-volunteer[]"> Volunteer Group<span class="help-block">Select one or more options.</span></label>
			<div class="col-sm-8">
				<div class="checkbox">
					<label for="groups-volunteer-0">
                    <input type="checkbox" name="groups-volunteer[]" id="groups-volunteer-0" value="Food Crew"/>
                    Food Crew </label>
				</div>
				<div class="checkbox">
					<label for="groups-volunteer-1">
                    <input type="checkbox" name="groups-volunteer[]" id="groups-volunteer-1" value="Administration"/>
                    Administration </label>
				</div>
				<div class="checkbox">
					<label for="groups-volunteer-2">
                    <input type="checkbox" name="groups-volunteer[]" id="groups-volunteer-2" value="Uniform Crew"/>
                    Uniform Crew </label>
				</div>
				<div class="checkbox">
					<label for="groups-volunteer-3">
                    <input type="checkbox" name="groups-volunteer[]" id="groups-volunteer-3" value="Souvenir Booth"/>
                    Souvenir Booth </label>
				</div>
			</div>
		</div>

		<!-- Message -->
		<div class="form-group">
			<label class="col-sm-4 control-label" for="messagearea">Other Information</label>
			<div class="col-sm-8">
				<textarea class="form-control" id="messagearea" name="messagearea" placeholder="If there's else anything you'd like us to know, tell us here!" rows="2"></textarea>
			</div>
		</div>

		<!-- Submit button -->
		<div class="form-group text-center">
			<div class="col-sm-12">
				<button id="submit-volunteer" name="submit-volunteer" class="btn btn-arsenal">Submit Volunteer Form</button>
			</div>
		</div>
	</fieldset>
</form>
