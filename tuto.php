<?php

// Connexion à la base de donnée et insertion de session_start
include('connexion_session.php');

if (isset($_SESSION['id_statut'])) {

	$query_all_post  = $bdd->prepare("SELECT * FROM pointcheck");
	$query_all_post->execute();

	?>

	<!DOCTYPE html>
	<html lang="en">
	<head>

		<title>Les tutos</title>

		<!-- Required meta tags always come first -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="x-ua-compatible" content="ie=edge">

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" type="text/css" href="css/bootstrap-reboot.css">
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="css/bootstrap-grid.css">

		<!-- Theme Styles CSS -->
		<link rel="stylesheet" type="text/css" href="css/theme-styles.css">
		<link rel="stylesheet" type="text/css" href="css/blocks.css">

		<!-- Main Font -->
		<script src="js/webfontloader.min.js"></script>
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&amp;subset=latin" media="all"><script>
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
		<link rel="stylesheet" type="text/css" href="css/daterangepicker.css">
		<link rel="stylesheet" type="text/css" href="css/bootstrap-select.css">
		<style>
		.help-support-list li svg{
			min-width: 14px;
		}
	</style>
</head>

<body class="body-bg-white">


	<!-- Stunning header -->

	<div class="stunning-header bg-primary-opacity">

		<div class="header-spacer--standard"></div>
		<div class="stunning-header-content">
			<svg id="Calque_1" data-name="Calque 1" viewBox="0 0 70 70" style="width:55px;height:auto; "><defs><style>.cls-1,.cls-2{fill:#fff;}.cls-1{opacity:0.8;}</style></defs><polygon class="cls-1" points="7.08 18.82 35 2.64 62.92 18.82 62.92 51.18 35 67.36 7.08 51.18 7.08 18.82"></polygon><polygon class="cls-2" points="7.08 18.82 7.08 51.18 35 67.36 35 35 7.08 18.82"></polygon></svg><br>
			<h1 class="stunning-header-title">Documentation</h1>
			<ul class="breadcrumbs">
				<li class="breadcrumbs-item">
					<a href="#">Support et doccumentation pour l'outil</a>
					<span class="icon breadcrumbs-custom">/</span>
				</li>
				<li class="breadcrumbs-item active">
					<span>Tutos pour la partie graph</span>
				</li>
			</ul>
		</div>

		<div class="content-bg-wrap">
			<div class="content-bg stunning-header-bg1"></div>
		</div>
	</div>

	<!-- End Stunning header -->

	<section class="negative-margin-top50 mb60">
		<div class="container">
			<div class="row">
				<div class="col-xl-10 m-auto col-lg-10 col-md-12 col-sm-12 col-xs-12">
					<form class="form-inline search-form" method="post">
						<div class="form-group label-floating">
							<label class="control-label">Posez votre question !</label>
							<input class="form-control bg-white" placeholder="" type="text" value="Pourrais-je avoir de l'aide sur le header">
							<span class="material-input"></span></div>

							<button class="btn btn-purple btn-lg">Rechercher</button>
						</form>
					</div>
				</div>
			</div>
		</section>


		<section>
			<div class="container">
				<div class="row">
					<div class="col-xl-8 ml-auto order-xl-2 col-lg-8 order-lg-2 col-md-12 order-md-1 col-sm-12 col-xs-12 lecontenu" >
						<?php if (isset($_GET['page'])) {
							$get=$_GET['page'];
							$query_get=$bdd->prepare("SELECT lien FROM pointcheck where id_check = ?");
							$query_get->bindParam(1, $get);
							$query_get->execute();
							$page=$query_get->fetch();
							include("tutos/".$page['lien']);
						}else{
							include("tutos/favicon.php");
						}?>
					</div>
					<div class="col-xl-3 order-xl-1 col-lg-3 order-lg-1 col-md-12 order-md-2 col-sm-12 col-xs-12" data-intro='Hello step one!'>
						<div class="help-support-block">
							<h3 class="title">Tous les tutoriels</h3>
							<ul class="help-support-list">
								<?php foreach ($query_all_post as $value) {?>
								<li>
									<svg class="olymp-blog-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="icons/icons.svg#olymp-blog-icon"></use></svg>
									<a style="cursor: pointer;" class="point_<?php echo utf8_encode($value['id_check']);?> letuto"><?php echo utf8_encode($value['question']);?></a>
								</li>
								<?php }?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</section>


		<section class="align-right pt160 pb80 section-move-bg call-to-action-animation scrollme">
			<div class="container">
				<div class="row">
					<div class="col-xl-10 m-auto col-lg-10 col-md-12 col-sm-12 col-xs-12">
						<a href="#" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#registration-login-form-popup">Start Making Friends Now!</a>
					</div>
				</div>
			</div>
			<img class="first-img" alt="guy" src="img/guy.png" style="bottom: 0;opacity: 1;transform: scale(1);">
			<div class="content-bg-wrap">
				<div class="content-bg bg-section1"></div>
			</div>
		</section>




		<a class="back-to-top" href="#">
			<img src="icons/back-to-top.svg" alt="arrow" class="back-icon">
		</a>



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

		<!-- Datepicker input field script-->
		<script src="js/moment.min.js"></script>
		<script src="js/charte.js"></script>
		<script>
			$(function(){
				$(".letuto").on('click', function(e){
					e.preventDefault();
					var check = "point_";
					checked = new Array();
					var cls = $(this).attr('class').split(' ');
					for (var i = 0; i < cls.length; i++) {
						if (cls[i].indexOf(check) > -1) {
							var id_emet = cls[i].slice(check.length, cls[i].length);
						}
					} 
					console.log(id_emet);
					$.ajax({
						url: 'formulaire.php',
						type: 'GET',
						data: {page: id_emet}
					})
					.done(function(data) {
						$.ajax({
							url: "tutos/"+data,
						})
						.done(function(contenu) {
							$(".lecontenu").html(contenu);
						})						
					})
				})
			})
		</script>

	</body>
	</html>
	<?php }else{
		header('Location: login.php');
	}
	?>