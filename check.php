<?php
// Connexion à la base de donnée et insertion de session_start
include('connexion_session.php');
$requete = $bdd->prepare('SELECT * from categorie');
$requete->execute();
$etat = 'maquette';
?>
<!DOCTYPE html>
<html lang="en">
<head>

	<title>Post Versions</title>

	<!-- Required meta tags always come first -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="x-ua-compatible" content="ie=edge">

	<!-- Main Font -->
	<script src="js/webfontloader.min.js"></script>
	<script>
		WebFont.load({
			google: {
				families: ['Roboto:300,400,500,700:latin']
			}
		});
	</script>

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" type="text/css" href="css/bootstrap-reboot.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap-grid.css">

	<!-- Theme Styles CSS -->
	<link rel="stylesheet" type="text/css" href="css/theme-styles.css">
	<link rel="stylesheet" type="text/css" href="css/blocks.css">
	<link rel="stylesheet" type="text/css" href="css/fonts.css">

	<!-- Styles for plugins -->
	<link rel="stylesheet" type="text/css" href="css/jquery.mCustomScrollbar.min.css">

	<!-- Lightbox popup script-->
	<link rel="stylesheet" type="text/css" href="css/magnific-popup.css">
	<!-- fullPageJS -->
	<link rel="stylesheet" href="css/jquery.fullPage.css">
	<!-- CUSTOM CSS -->
	<link rel="stylesheet" href="css/main.css">

	<style>
	body{
		overflow-y: hidden;
	}
</style>
</head>
<body>

	<!-- Fixed Sidebar Left -->

	<?php include('left_sidebar.php');?>

	<!-- ... end Fixed Sidebar Left -->

	<!-- Fixed Sidebar Left -->

	<?php include('fixed_left_sidebar.php');?>

	<!-- ... end Fixed Sidebar Left -->

	<!-- Fixed Sidebar Right -->

	<?php include('fixed_sidebar_right.php');?>

	<!-- ... end Fixed Sidebar Right -->


	<!-- Header -->

	<?php include('header.php');?>

	<!-- ... end Header -->


	<!-- Responsive Header -->

	<?php include('responsive_header.php');?>

	<!-- ... end Responsive Header -->

	<!-- ... end Responsive Header -->


	<div class="container custom">
		<div class="row">
			<div id="fullpage">
				<div id="loader-wrapper">
					<div id="loader"></div>

					<div class="loader-section section-left"></div>
					<div class="loader-section section-right"></div>

				</div>
				<div class="section">
					<input class="idgpp" type="hidden" value="<?php echo $_GET['idgpp']; ?>">
					<?php 
					foreach ($requete as $key => $value) {
						$valueetat = 1;
						$content = $bdd->prepare('SELECT * from pointcheck where '. $etat .' = ? and id_categorie = ?');
						$content->bindParam(1, $valueetat);
						$content->bindParam(2, $value['id_categorie']);
						$content->execute();
						?>
						<div class="slide">
							<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<div class="ui-block">
									<div class="ui-block-title">
										<h3 class="title"><?php echo  utf8_encode($value['nom_categorie']); ?></h3>
									</div>
								</div>
							</div>
							<div class="container custom">
								<div class="row">
									<?php foreach ($content as $card){ ?>
									<!-- point check -->
									<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 card_<?php echo  utf8_encode($card['id_check']); ?>">
										<div class="ui-block">
											<div class="available-widget">
												<div class="checkbox">
													<label>
														<h4 class="title"><?php echo  utf8_encode($card['titre']); ?></h4>
														<img alt="" class="illu" src="<?php echo  utf8_encode($card['picto']); ?>">
														<p class="desc"><?php echo  utf8_encode($card['description']); ?></p>
														<input name="optionsCheckboxes" type="checkbox"><span class="checkbox-material"><span class="check"></span></span>
														<div class="voirplus">
															<a href="<?php echo  utf8_encode($card['lien']); ?>">En savoir plus</a>
														</div>
													</label>
												</div>
											</div>
										</div>
										<!--end point check-->
									</div>
									<?php } ?>
									<!--end row au dessous-->	
								</div>
								<!-- end container-->
							</div>
							<!-- end slide-->
						</div>
						<?php } ?>
						<!-- new slide -->
						<div class="slide">
							<!-- end slide-->
						</div>
					</div>
					<!-- end section-->
				</div>
				<!-- fullpage-->	
			</div>
		</div>
	</div>

	<!-- ... end Window-popup-CHAT for responsive min-width: 768px -->

	<!-- jQuery first, then Other JS. -->
	<script src="js/jquery-3.2.0.min.js"></script>
	<!-- Js effects for material design. + Tooltips -->
	<script src="js/material.min.js"></script>
	<!-- Helper scripts (Tabs, Equal height, Scrollbar, etc) -->
	<script src="js/theme-plugins.js"></script>
	<!-- Init functions -->
	<script src="js/main.js"></script>

	<!-- Select / Sorting script -->
	<script src="js/selectize.min.js"></script>

	<!-- Lightbox popup script-->
	<script src="js/jquery.magnific-popup.min.js"></script>
	<!-- Gif Player script-->
	<script src="js/jquery.gifplayer.js"></script>

	<script src="js/mediaelement-and-player.min.js"></script>
	<script src="js/mediaelement-playlist-plugin.min.js"></script>

	<script src="js/jquery.fullPage.min.js"></script>
	<script>
		$(document).ready(function() {
			$('#fullpage').fullpage({
				onSlideLeave: function( anchorLink, index, slideIndex, direction, nextSlideIndex){
					var leavingSlide = $(this);

		//leaving the first slide of the 2nd Section to the right
		if(index == 1 && slideIndex == 4 && direction == 'right'){
			var checked = new Array();
			var i = 0;
			var idCheck = [];
			var valueCheck = [];
			var arrayCheck = [];
			var idGpp = $('.idgpp').val();
			$("div[class*='card_']").each(function(){
				var check = "card_";
				checked[i] = new Array();
				var cls = $(this).attr('class').split(' ');
				for (var i = 0; i < cls.length; i++) {
					if (cls[i].indexOf(check) > -1) {
						var id_emet = cls[i].slice(check.length, cls[i].length);
					}
				} 
				console.log($(this).find('.checkbox').attr('class'));
				if($(this).find('.checkbox').hasClass('clicked')){
					alert('lol');
					idCheck.push(id_emet);
					valueCheck.push(1);
				}else{
					idCheck.push(id_emet);	
					valueCheck.push(0);			
				}
				i++;
			});
			$.ajax({
				url: 'formulaire.php',
				type: 'POST',
				data: {idCheck: idCheck, valueCheck: valueCheck, idGpp: idGpp},
			})
			.done(function(data) {
				console.log("success");
				console.log(data);
			})

			
			console.log(idCheck);
			console.log(valueCheck);
			return false;
		}

		//leaving the 3rd slide of the 2nd Section to the left
		if(index == 1 && slideIndex == 2 && direction == 'left'){

		}
	}
});

			$(document).ready(function() {
				setTimeout(function(){
					$('body').addClass('loaded');
					$('h1').css('color','#222222');
				}, 2000);

			});
		});
	</script>
</body>
</html>