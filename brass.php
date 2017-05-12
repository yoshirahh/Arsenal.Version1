<!DOCTYPE html>
<html lang="en">
<?php $page_name = "Arsenal Brass Campaign" ?>
<?php $canonical = "brass" ?>
<?php $sub_dir = "" ?>
<?php include_once ("./include/meta.php"); ?>
<body>
<?php include_once ("include/header.php"); ?>
<main class="container" post-affix>
  <div class="gen-content">
    <div class="row">
    	<div class="col-sm-6">
    		<img class="img-responsive" style="box-shadow: 0 1px 10px rgba(0,0,0,0.5);" src="images/BrassPoster.png"><br>
    	</div>
    	<div class="col-sm-6" style="font-size: 16px;">
    	<h1>Arsenal Brass Campaign</h1><br>
    	<div class="video-container"><iframe style="box-shadow: 0 1px 10px rgba(0,0,0,0.5);" width="100%" height="300" src="https://www.youtube.com/embed/Zz7uZSP13A4" frameborder="0" allowfullscreen></iframe></div>
    	<hr>
    		<p>We’re raising $20,000 to purchase a full horn line, and we need your help.
So far, we’ve been using instruments borrowed from high schools. This is not sustainable and brings with it a host of issues, including intonation problems between multiple different brands and insurance complications with the schools from which they are borrowed. By purchasing our own hornline we can ensure that our students not only sound good, but look good too.</p>
			<p>Giving to our brass campaign is not just a donation; it’s an investment in our future.</p>
			<p>Donors who give $25 or more have the option to receive a numbered copy of a limited 100 run copy of our Arsenal Brass poster, deliverable in July. They’ll be available for local pickup for free or can be shipped for a small fee.</p>
			<div style="text-align: center;"><button type="button" class="btn btn-arsenal btn-lg" href="" data-toggle="modal" data-target="#donateModal" >Donate Now</button></div>
    		</p>
    	</div>
    </div>
  </div>
</main>
<div class="modal fade" id="donateModal" role="dialog">
  <div class="modal-dialog"> 
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="text-align: center;">Arsenal Brass Campaign Donation</h4>
      </div>
      <div class="modal-body" id="registration-content">
        <div class="row">
	      <?php include_once("forms/brassdonation.php"); ?>
        </div>
      </div>
      <div class="modal-footer" style="text-align: center;">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<?php include_once ("include/footer.php"); ?>
</body>
</html>
