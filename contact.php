<!DOCTYPE html>
<html lang="en">
<?php $page_name = "Contact Us" ?>
<?php $canonical = "contact" ?>
<?php $sub_dir = "" ?>
<?php include_once ("./include/meta.php"); ?>

<body>
	<?php include_once ("./include/header.php"); ?>
	<main class="container">
		<div class="row">
			<div class="col-sm-8">
				<div class="gen-content">
					<h1>Contact Us</h1>
					<?php $cookie_name = 'arsenal_org_contact_cookie'; ?>
					<?php if(isset($_COOKIE[$cookie_name]) && $_COOKIE[$cookie_name] == 'TRUE') : ?>
					<div class="alert alert-success fade in"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> <strong>Thanks!</strong> We have received your response, and you should recieve a confirmation email shortly.</div>
					<?php elseif(isset($_COOKIE[$cookie_name]) && $_COOKIE[$cookie_name] == 'FALSE') : ?>
					<div class="alert alert-danger fade in"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> <strong>Hold up.</strong> You need to complete all of the form fields.</div>
					<?php endif; ?>
					<?php include_once("./forms/contactForm.php") ?>
				</div>
				<br class="visible-xs">
			</div>
			<div class="col-sm-4">
				<div class="gen-content">
					<h2 class="topmost">Email Addresses</h2>
					<div style="padding: 0 5px 15px 15px;">
						<li>Arsenal Performing Arts: <a href="mailto:contact@arsenalperformingarts.org">contact@ArsenalPerformingArts.org</a>
						</li>
						<li>Arsenal Drum and Bugle Corps: <a href="mailto:arsenal@arsenalperformingarts.org">arsenal@ArsenalPerformingArts.org</a>
						</li>
						<li>Technical Support: <a href="mailto:tech@arsenalperformingarts.org">tech@ArsenalPerformingArts.org</a>
					</div>
					</li>
				</div>
				<br>
				<div class="gen-content">
					<h2>Mailing Lists</h2>
					<div style="padding: 10px; padding-top: 0; text-align: center;">
						<h4 style="text-align:center;">Subscribe to our mailing list to keep up to date.</h4>
						<h5 style="text-align:left;">General program udpates.</h5>
						<?php include_once ("./include/quicksub.html")?>
						<h5 style="text-align:left;">Receive updates for the brass section.</h5>
						<?php include_once ("./include/brasslist.html")?>
						<h5 style="text-align:left;">Receive updates for the percussion section.</h5>
						<?php include_once ("./include/perclist.html")?>
					</div>
				</div>
			</div>
		</div>
		</div>
	</main>
	<?php include_once ("./include/footer.php"); ?>
</body>

</html>