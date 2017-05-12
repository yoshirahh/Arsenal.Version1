<form class="form-horizontal " id="direct-contact-form" action="./scripts/ctsub.php" method="post">
          <fieldset>
            <!-- Form Name -->
            <h3 style="text-align:center">Direct Contact Form</h3>
            <h5>Use this form to send us a quick message via email. We will do our best to get back to you quickly.</h5>
            <!-- Name input-->
            <div class="form-group">
              <label class="col-sm-4 control-label" for="name-direct">Full Name</label>
              <div class="col-sm-8">
                <input id="name-direct" name="name-direct" type="text" placeholder="Jane Doe" class="form-control input-md" required="">
              </div>
            </div>
            
            <!-- Email input-->
            <div class="form-group">
              <label class="col-sm-4 control-label" for="email-direct">Email</label>
              <div class="col-sm-8">
                <div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
                  <input id="email-direct" name="email-direct" class="form-control" placeholder="sample@example.com" type="email" required="">
                </div>
              </div>
            </div>
            
            <!-- Phone input-->
            <div class="form-group">
              <label class="col-sm-4 control-label" for="phone-direct">Phone</label>
              <div class="col-sm-8">
                <div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-earphone"></span></span>
                  <input id="phone-direct" name="phone-direct" class="form-control" placeholder="(505) 123 - 4567" type="tel">
                </div>
              </div>
            </div>
            
            <!-- Contact Group -->
            <div class="form-group">
              <label class="col-sm-4 control-label" for="groups-direct"> Select a Group<span class="help-block">Select a group to send an email to. If unsure, use "General".</span></label>
              <div class="col-sm-8">
                <div class="radio">
                  <label for="groups-direct-0">
                    <input type="radio" name="groups-direct" id="groups-direct-0" value="general" checked="checked">
                    General </label>
                </div>
                <div class="radio">
                  <label for="groups-direct-1">
                    <input type="radio" name="groups-direct" id="groups-direct-1" value="arsenal">
                    Arsenal Drum and Bugle Corps </label>
                </div>
                <div class="radio hidden">
                  <label for="groups-direct-2">
                    <input type="radio" name="groups-direct" id="groups-direct-2" value="sentinel">
                    Sentinel Independent Winterguard </label>
                </div>
                <div class="radio">
                  <label for="groups-direct-3">
                    <input type="radio" name="groups-direct" id="groups-direct-3" value="tech suppport">
                    Technical Support </label>
                </div>
              </div>
            </div>
            
            <!-- Message -->
            <div class="form-group">
              <label class="col-sm-4 control-label" for="messagearea">Message</label>
              <div class="col-sm-8">
                <textarea class="form-control" id="messagearea" name="messagearea" required placeholder="Type your message to us here." rows="5"></textarea>
              </div>
            </div>
            
            <!-- Submit button -->
            <div class="form-group text-center">
              <div class="col-sm-12">
                <button id="submit-direct" name="submit-direct" class="btn btn-arsenal">Send Email</button>
              </div>
            </div>
          </fieldset>
        </form>