<?php

// Connexion à la base de donnée et insertion de session_start
include('connexion_session.php');


if (isset($_SESSION['id_statut'])) {
	$id_graph=$_SESSION['id_graph'];
	$query_select_card_crea_maquette = $bdd->prepare("SELECT num_client, raison_social, lien_CMS, photo FROM client inner join user on client.id_graph_maquette=user.id_user where client.id_graph_maquette=? and date_retour_maquette IS NULL and date_retour_cq IS NULL");
	$query_select_card_crea_maquette->bindParam(1, $id_graph);
	$query_select_card_crea_maquette->execute();
	$cards_client=$query_select_card_crea_maquette->fetchAll();
	?>

	<!DOCTYPE html>
	<html lang="en">
	<head>

		<title>Parametre du compte</title>

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
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.9.1/sweetalert2.css">
		<link rel="stylesheet" type="text/css" href="css/daterangepicker.css">

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
		<!-- Custom CSS -->
		<link rel="stylesheet" href="css/main.css">
		<link rel="stylesheet" href="css/jquery.fancybox.min.css">


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
			include('header_redac.php');
		}
		elseif ($_SESSION['id_statut']==3) {
			//page leader
			include('header_leader.php');
		}elseif ($_SESSION['id_statut']==4) {
			//page controleur
			include('header_controleur.php');
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


		<!-- Main Header Your Account -->

		<div class="main-header">
			<div class="content-bg-wrap">
				<div class="content-bg bg-account"></div>
			</div>
			<div class="container">
				<div class="row">
					<div class="col-lg-8 offset-lg-2 col-md-8 offset-md-2 col-sm-12 col-xs-12">
						<div class="main-header-content">
							<h1>Parametre du compte</h1>
							<p>Ici vous allez pouvoir changer votre mot de passe, votre avatar, activer/désactiver les notifications.
							</p>
						</div>
					</div>
				</div>
			</div>

			<img class="img-bottom" src="img/account-bottom.png" alt="friends">
		</div>

		<!-- ... end Main Header Your Account -->



		<!-- Your Account Personal Information -->

		<div class="container">
			<div class="row">
				<div class="col-xl-9 push-xl-3 col-lg-9 push-lg-3 col-md-12 col-sm-12 col-xs-12">
					<div class="ui-block multitab">
						<div class="ui-block-title">
							<h6 class="title">Modifier le mot de passe</h6>
						</div>
						<div class="ui-block-content">
							<form>
								<div class="row">

									<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
										<div class="form-group label-floating is-empty">
											<label class="control-label">Mot de passe actuel</label>
											<input class="form-control mdpActuel" placeholder="" type="password">
											<span class="material-input"></span></div>
										</div>

										<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
											<div class="form-group label-floating is-empty">
												<label class="control-label">Nouveau mot de passe</label>
												<input class="form-control password" placeholder="" type="password">
												<span class="material-input"></span></div>
											</div>
											<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
												<div class="form-group label-floating is-empty">
													<label class="control-label">Confirmer le nouveau mot de passe</label>
													<input class="form-control passwordverify" placeholder="" type="password">
													<span class="material-input"></span></div>
												</div>

												<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
													<a href="#" class="btn btn-green btn-lg full-width confirmpw">
													Changer le mot de passe</a>
												</div>

											</div>
										</form>
									</div>
								</div>
							</div>

							<div class="col-xl-3 pull-xl-9 col-lg-3 pull-lg-9 col-md-12 col-sm-12 col-xs-12 responsive-display-none">
								<div class="ui-block">
									<div class="your-profile">

										<div id="accordion" role="tablist" aria-multiselectable="true">
											<div class="card">
												<div class="card-header" role="tab" id="headingOne">
													<h6 class="mb-0">
														<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
															Parametre profil
															<svg class="olymp-dropdown-arrow-icon"><use xlink:href="icons/icons.svg#olymp-dropdown-arrow-icon"></use></svg>
														</a>
													</h6>
												</div>

												<div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne">
													<ul class="your-profile-menu">
														<li>
															<a class="accountsetting" href="accountsetting.html">Parametre du compte</a>
														</li>
														<li>
															<a class="changepassword" href="changePassword.html">Changer le mot de passe</a>
														</li>
													</ul>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<!-- ... end Your Account Personal Information -->


					<!-- jQuery first, then Other JS. -->
					<script src="js/jquery-3.2.0.min.js"></script>
					<!-- Js effects for material design. + Tooltips -->
					<script src="js/material.min.js"></script>
					<!-- Helper scripts (Tabs, Equal height, Scrollbar, etc) -->
					<script src="js/theme-plugins.js"></script>
					<!-- Init functions -->
					<script src="js/main.js"></script>
					<script src="js/alterclass.js"></script>
					<script src="js/chat.js"></script>
					<!-- Select / Sorting script -->
					<script src="js/selectize.min.js"></script>
					<script src="js/moment.min.js"></script>
					<script src="js/daterangepicker.min.js"></script>
					<link rel="stylesheet" type="text/css" href="css/bootstrap-select.css">


					<script src="js/mediaelement-and-player.min.js"></script>
					<script src="js/mediaelement-playlist-plugin.min.js"></script>
					<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.9.1/sweetalert2.min.js"></script>

					<script src="js/charte.js"></script>
					<script src="js/account.js"></script>

					<script>
						$(function(){
							$('body').on('click', '.valider_accountsetting', function(){
								var date = $('.date').val();
								console.log(date);
								$.ajax({
									url: 'formulaire.php',
									type: 'POST',
									data: {date_naissance: date},
								})
								.done(function(data) {
									console.log(data);
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