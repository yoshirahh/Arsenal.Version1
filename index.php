<!DOCTYPE html>
<html lang="en">
<?php $page_name = "Welcome" ?>
<?php $canonical = "" ?>
<?php $sub_dir = "" ?>
<?php include_once ("./include/meta.php"); ?>

<body>
	<?php include_once ("./include/header.php"); ?>
	<main class="container">
		<div class="row">
			<div class="col-sm-8">
				<div class="gen-content" style="padding: 0;">
					<div id="carousel-main" class="carousel slide" data-ride="carousel">
						<ol class="carousel-indicators">
							<li data-target="#carousel-main" data-slide-to="0" class="active"></li>
							<li data-target="#carousel-main" data-slide-to="1" class=""></li>
							<li data-target="#carousel-main" data-slide-to="2" class=""></li>
<!--							<li data-target="#carousel-main" data-slide-to="3" class=""></li>-->
						</ol>
						<div class="carousel-inner" role="listbox">
							<div class="item active">
								<a href="./news/2017show.php">
            						<img src="./images/Volver Announcement Slide.png" alt="Announcing the 2017 show: Volver" class="center-block">
              					</a>
							</div>
							<div class="item">
								<a href="">
             						<img src="./images/bethann.png" alt="Join Arsenal Today!" class="center-block">
             					</a>
							</div>
							<div class="item">
								<a href="./news/apparel.php">
            						<img src="./images/partner.png" alt="Arsenal Partners with MarchingApparel.com!" class="center-block">
            					</a>
							</div>
<!--
							<div class="item">
								<a href="./news/ip.php">
            						<img src="./images/ippartner.png" alt="Arsenal Partners with Innovative Percussion Inc.!" class="center-block">
            					</a>
							</div>
-->
						</div>
						<a class="left carousel-control" href="./images/#carousel-main" role="button" data-slide="prev"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span><span class="sr-only">Previous</span></a><a class="right carousel-control" href="./images/#carousel-main" role="button" data-slide="next"><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span><span class="sr-only">Next</span></a>
					</div>
				</div>
				<div id="under-carousel" class="module">
					<div class="module-head">Our Partners</div>
					<div class="row f-sponsors">
						<div class="col-sm-8"><a href="http://www.musicmart.com/" target="_blank"> <img class="img-responsive" src="./images/mmlogo.png" alt="Music Mart" title=""></a> </div>
						<div class="col-sm-4"> <a href="http://www.marchingapparel.com/" target="_blank"><img class="img-responsive" src="./images/MAlogoSq.png" alt="MarchingApparel.com" title=""></a> </div>
						<div class="col-sm-offset-2 col-sm-8"> <a href="http://www.innovativepercussion.com/" target="_blank"><img class="img-responsive" src="./images/iplogo.png" alt="Innovative Percussion, Inc." title=""> </a></div>
					</div>
				</div>
			</div>
			<div class="col-sm-4">
				<div id="right-upper" class="module">
					<div class="module-head">Welcome!</div>
					<div>Arsenal Performing Arts is a 501(c)3 non-profit organized out of Albuquerque, New Mexico, dedicated to providing programs to enhance the marching arts in New Mexico. Our flagship program, Arsenal Drum and Bugle Corps, is set to debut in 2017 with the DCI Summer Tour. We here at Arsenal are excited to provide an opportunity for young people to experience the marching arts at the highest level.</div>
				</div>
				<div id="right-lower" class="module">
					<div class="module-head">Support Arsenal</div>
					<div> <a href="./brass" target="_self" title="Support Arsenal&#39;s Capital Campaign!">
          <img class="randimg" style="content:url(./images/randimg/InvestInBrass.jpg)">
          </a>
 					</div>
				</div>
			</div>
		</div>
		<script>
			$( document ).ready( function () {
				var images = [ 'InvestInBrass.jpg' ];
				$( '#banner-load' ).replaceWith( '<img class="randimg" style="content:url(imagesrandimg/' + images[ Math.floor( Math.random() * images.length ) ] + ')">' );
			} );
		</script>
	</main>
	<?php include_once ("./include/footer.php"); ?>
</body>

</html>