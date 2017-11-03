<?php

// Connexion à la base de donnée et insertion de session_start
include('connexion_session.php');

$id_graph=$_SESSION['id_graph'];
?>
<!DOCTYPE html>
<html lang="en">
<head>

	<title>Badges</title>

	<!-- Required meta tags always come first -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="x-ua-compatible" content="ie=edge">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" type="text/css" href="Bootstrap/dist/css/bootstrap-reboot.css">
	<link rel="stylesheet" type="text/css" href="Bootstrap/dist/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="Bootstrap/dist/css/bootstrap-grid.css">

	<!-- Theme Styles CSS -->
	<link rel="stylesheet" type="text/css" href="css/theme-styles.css">
	<link rel="stylesheet" type="text/css" href="css/blocks.css">

	<!-- Main Font -->
	<script src="js/webfontloader.min.js"></script>
	<script>
		WebFont.load({
			google: {
				families: ['Roboto:300,400,500,700:latin']
			}
		});
	</script>

	<link rel="stylesheet" type="text/css" href="css/fonts.css">

	<!-- Styles for plugins -->
	<link rel="stylesheet" type="text/css" href="css/jquery.mCustomScrollbar.min.css">
	<link rel="stylesheet" type="text/css" href="css/swiper.min.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">


</head>
<body>

	<!-- Fixed Sidebar Left -->
	<?php 
	if($_SESSION['id_statut']==1) {
			//page graphistes 
		include('left_sidebar.php');
	}elseif  ($_SESSION['id_statut']==2){
			//page  redacteurs
		include('left_sidebar_redac.php');
	}
	elseif ($_SESSION['id_statut']==3) {
			//page leader
		include('left_sidebar_leader.php');
	}elseif ($_SESSION['id_statut']==4) {
			//page controleur
		include('left_sidebar_controleur.php');
	}elseif($_SESSION['id_statut']==5){
			//page admin
		include('left_sidebar_admin.php');
	}
	?>

	<!-- ... end Fixed Sidebar Left -->

	<!-- Fixed Sidebar Right -->

	<?php include('fixed_sidebar_right.php');?>

	<!-- ... end Fixed Sidebar Right -->


	<!-- Header -->

	<?php 
	if($_SESSION['id_statut']==1) {
			//page graphistes 
		include('header.php');
	}elseif  ($_SESSION['id_statut']==2){
			//page  redacteurs
		include('header.php');
	}
	elseif ($_SESSION['id_statut']==3) {
			//page leader
		include('header.php');
	}elseif ($_SESSION['id_statut']==4) {
			//page controleur
		include('header_admin.php');
	}elseif($_SESSION['id_statut']==5){
			//page admin
		include('header_admin.php');
	}
	?>

	<!-- ... end Header -->


	<!-- Responsive Header -->

	<?php include('responsive_header.php');?>

	<!-- ... end Responsive Header -->

	<!-- ... end Responsive Header -->



	<div class="header-spacer header-spacer-small"></div>


	<!-- Main Header Badges -->

	<div class="main-header">
		<div class="content-bg-wrap">
			<div class="content-bg bg-badges"></div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 col-md-8 offset-md-2 col-sm-12 col-xs-12">
					<div class="main-header-content">
						<h1>Gagnez des Badges!</h1>
						<p>Profitez de votre imaginations, votre déterminations et vos envies afin d'obtenir le plus de badges possible et ainsi bluffer vos collègues!
						</p>
					</div>
				</div>
			</div>
		</div>

		<img class="img-bottom" src="img/badges-bottom.png" alt="friends">
	</div>

	<!-- ... end Main Header Badges -->


	<!-- Main Content Badges -->

	<div class="container">
		<div class="row">
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">

				<div class="ui-block">
					<div class="birthday-item inline-items badges">
						<div class="author-thumb">
							<img src="img/badge1.png" alt="author">
							<div class="label-avatar bg-primary">2</div>
						</div>
						<div class="birthday-author-name">
							<a href="#" class="h6 author-name">Retour Sans modifications</a>
							<div class="birthday-date">Vous avez effectuer un retour sans modifications, félicitation!</div>
						</div>

						<div class="skills-item">
							<div class="skills-item-meter">
								<span class="skills-item-meter-active" style="width: 76%"></span>
							</div>
						</div>

					</div>
				</div>

				<div class="ui-block">
					<div class="birthday-item inline-items badges">
						<div class="author-thumb">
							<img src="img/badge2.png" alt="author">
						</div>
						<div class="birthday-author-name">
							<a href="#" class="h6 author-name">Site du mois</a>
							<div class="birthday-date">Vous avez été élu meilleur site du mois.</div>
						</div>

						<div class="skills-item">
							<div class="skills-item-meter">
								<span class="skills-item-meter-active" style="width: 100%"></span>
							</div>
						</div>

					</div>
				</div>

				<div class="ui-block">
					<div class="birthday-item inline-items badges">
						<div class="author-thumb">
							<img src="img/badge3.png" alt="author">
							<div class="label-avatar bg-blue">4</div>
						</div>
						<div class="birthday-author-name">
							<a href="#" class="h6 author-name">Meilleure note</a>
							<div class="birthday-date">Vous avez obtenu un 10/10. </div>
						</div>

						<div class="skills-item">
							<div class="skills-item-meter">
								<span class="skills-item-meter-active" style="width: 52%"></span>
							</div>
						</div>

					</div>
				</div>

				<div class="ui-block">
					<div class="birthday-item inline-items badges">
						<div class="author-thumb">
							<img src="img/badge4.png" alt="author">
						</div>
						<div class="birthday-author-name">
							<a href="#" class="h6 author-name">Motivation sans égal</a>
							<div class="birthday-date">Votre motivation et votre dévouement vous qualifie pour une formation.</div>
						</div>

						<div class="skills-item">
							<div class="skills-item-meter">
								<span class="skills-item-meter-active" style="width: 100%"></span>
							</div>
						</div>

					</div>
				</div>

				<div class="ui-block">
					<div class="birthday-item inline-items badges">
						<div class="author-thumb">
							<img src="img/badge5.png" alt="author">
						</div>
						<div class="birthday-author-name">
							<a href="#" class="h6 author-name">Expert Code</a>
							<div class="birthday-date">Vous méttez à disposition régulièrement des bouts de codes.</div>
						</div>

						<div class="skills-item">
							<div class="skills-item-meter">
								<span class="skills-item-meter-active" style="width: 70%"></span>
							</div>
						</div>

					</div>
				</div>

				<div class="ui-block">
					<div class="birthday-item inline-items badges">
						<div class="author-thumb">
							<img src="img/badge6.png" alt="author">
						</div>
						<div class="birthday-author-name">
							<a href="#" class="h6 author-name">Force de proposition wordpress</a>
							<div class="birthday-date">Vous proposez régulièrement des évolutions Wordpress.</div>
						</div>

						<div class="skills-item">
							<div class="skills-item-meter">
								<span class="skills-item-meter-active" style="width: 23%"></span>
							</div>
						</div>

					</div>
				</div>

				<div class="ui-block">
					<div class="birthday-item inline-items badges">
						<div class="author-thumb">
							<img src="img/badge7.png" alt="author">
						</div>
						<div class="birthday-author-name">
							<a href="#" class="h6 author-name">Force de proposition outil</a>
							<div class="birthday-date">Vous proposez régulièrement des évolutions pour cet outil.</div>
						</div>

						<div class="skills-item">
							<div class="skills-item-meter">
								<span class="skills-item-meter-active" style="width: 100%"></span>
							</div>
						</div>

					</div>
				</div>

				<div class="ui-block">
					<div class="birthday-item inline-items badges">
						<div class="author-thumb">
							<img src="img/badge8.png" alt="author">
						</div>
						<div class="birthday-author-name">
							<a href="#" class="h6 author-name">Participation joyeuse</a>
							<div class="birthday-date">Vous participez à de nombreux anniversaires.</div>
						</div>

						<div class="skills-item">
							<div class="skills-item-meter">
								<span class="skills-item-meter-active" style="width: 100%"></span>
							</div>
						</div>

					</div>
				</div>

				<div class="ui-block">
					<div class="birthday-item inline-items badges">
						<div class="author-thumb">
							<img src="img/badge9.png" alt="author">
						</div>
						<div class="birthday-author-name">
							<a href="#" class="h6 author-name">Implication</a>
							<div class="birthday-date">Vous likez un certains nombres d'articles de veille.</div>
						</div>

						<div class="skills-item">
							<div class="skills-item-meter">
								<span class="skills-item-meter-active" style="width: 69%"></span>
							</div>
						</div>

					</div>
				</div>

				<div class="ui-block">
					<div class="birthday-item inline-items badges">
						<div class="author-thumb">
							<img src="img/badge10.png" alt="author">
						</div>
						<div class="birthday-author-name">
							<a href="#" class="h6 author-name">Don de savoir</a>
							<div class="birthday-date">Vous aidez un maximum sur les demandes d'aides.</div>
						</div>

						<div class="skills-item">
							<div class="skills-item-meter">
								<span class="skills-item-meter-active" style="width: 33%"></span>
							</div>
						</div>

					</div>
				</div>

				
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

	<!-- Swiper / Sliders -->
	<script src="js/swiper.jquery.min.js"></script>

	<script src="js/mediaelement-and-player.min.js"></script>
	<script src="js/mediaelement-playlist-plugin.min.js"></script>
	<script src="js/charte.js"></script>
	<?php 
	if($_SESSION['id_statut']==1) {
						//page graphistes 
		?><script src="js/notifications.js"></script><?php
	}elseif  ($_SESSION['id_statut']==2){
						//page  redacteurs
		?><script src="js/notifications_redac.js"></script><?php
	}
	elseif ($_SESSION['id_statut']==3) {
						//page leader
		?><script src="js/notifications_leader.js"></script><?php
	}elseif ($_SESSION['id_statut']==4) {
						//page controleur
		?><script src="js/notifications_controleur.js"></script><?php
	}elseif($_SESSION['id_statut']==5){
						//page admin
		?><script src="js/notifications_admin.js"></script><?php
	}
	?>
</body>
</html>
