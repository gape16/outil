<?php

// Connexion à la base de donnée et insertion de session_start
include('connexion_session.php');







//test connexion !
if (isset($_POST['connect'])) {
	$mail=$_POST['mail'];
	$mdp=$_POST['mdp'];
	$query_test_user = $bdd->prepare("SELECT * FROM user WHERE email = :mail");
	$query_test_user->bindParam(':mail', $mail);
	$query_test_user->execute();
	$test_user = $query_test_user->fetch();
	if(password_verify($mdp, $test_user['mdp'])){
		//password correct donc redirection vers page d'accueil
		$_SESSION['email']=$mail;
		$_SESSION['id_graph']=$test_user['id_user'];
		$_SESSION['id_statut']=$test_user['id_statut'];
		if($test_user['id_statut']==1 || $test_user['id_statut']==2){
			//page graphistes redacteurs
			header('Location: accueil.php');
		}elseif ($test_user['id_statut']==3) {
			//page leader
			header('Location: accueil_leader.php');
		}elseif ($test_user['id_statut']==4) {
			//page controleur
			header('Location: accueil_controleur.php');
		}elseif($test_user['id_statut']==5){
			//page admin
			header('Location: accueil_admin.php');
		}
	}
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>

	<title>Inscription / connexion</title>

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
	<link rel="stylesheet" type="text/css" href="css/daterangepicker.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap-select.css">
	<!-- <embed type="image/svg+xml" src="icons.svg" /> -->

	<!-- Custom CSS -->
	<link rel="stylesheet" href="css/main.css">
	<link rel="stylesheet" href="css/jquery.fancybox.min.css">
	<style>
		.ah:before{
			height:300% !important;
		}
	</style>
</head>

<body class="landing-page">

	<div class="content-bg-wrap">
		<div class="content-bg ah"></div>
	</div>


	<!-- Landing Header -->

	<div class="container">
		<div class="row">
			<div class="col-xl-12 col-lg-12 col-md-12">
				<div id="site-header-landing" class="header-landing">
					<a href="02-ProfilePage.html" class="logo">
						<svg id="Calque_1" data-name="Calque 1" viewBox="0 0 70 70" style="width:55px;height:auto; "><defs><style>.cls-1,.cls-2{fill:#fff;}.cls-1{opacity:0.8;}</style></defs><polygon class="cls-1" points="7.08 18.82 35 2.64 62.92 18.82 62.92 51.18 35 67.36 7.08 51.18 7.08 18.82"></polygon><polygon class="cls-2" points="7.08 18.82 7.08 51.18 35 67.36 35 35 7.08 18.82"></polygon></svg>
						<h5 class="logo-title">SOLOCAL MARKETING SERVICE</h5>
					</a>
				</div>
			</div>
		</div>
	</div>

	<!-- ... end Landing Header -->

	<!-- Login-Registration Form  -->

	<div class="container">
		<div class="row display-flex">
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="landing-content">
					<h1>Inscription et connexion</h1>
					<p>
						Cette page vous permettra de vous inscrire et de vous connecter à l'ensemble des fonctionnalités de l'outil en fonction de votre statut.
						Bonne navigation à tous !
					</p>
				</div>
			</div>

			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="registration-login-form">
					<!-- Nav tabs -->
					<ul class="nav nav-tabs" role="tablist">
						
					</ul>

					<!-- Tab panes -->
					<div class="tab-content">
						<!--  -->
						<div class="tab-pane <?php if(isset($_COOKIE['register'])){ echo 'active';}?>" id="profile" role="tabpanel" data-mh="log-tab">
							<div class="title h6">Connecte toi à ton compte
								<?php 
								if (isset($_POST['connect'])) {
									if(!password_verify($mdp, $test_user['mdp'])){
									//password incorrect
										echo "<br><span style='font-style:italic;color:red;'>Impossible de se connecter</span>";
									}}
									?>
								</div>
								<?php if(isset($_GET['code'])){?>
								<form class="content connexion_first" method="POST">
									<div class="row">
										<div class="col-xl-12 col-lg-12 col-md-12">
											<div class="form-group label-floating is-empty">
												<label class="control-label">Ton Email</label>
												<input autocomplete="off" class="form-control email" placeholder="" type="email" name="mail">
											</div>
											<div class="form-group label-floating is-empty" style="display: none;">
												<label class="control-label">Ton code reçu par mail</label>
												<input autocomplete="off" class="form-control token_first" placeholder="" value="<?php echo $_GET['code'];?>" type="texte" name="mdp">
											</div>
											<input autocomplete="off" type="hidden" name="connect" value="">
											<div class="form-group label-floating is-empty nouveau_pass1" style="display: none;">
												<label class="control-label">Choisir un mot de passe</label>
												<input type="password" name="pass1" class="mdp1" >
											</div>
											<div class="form-group label-floating is-empty nouveau_pass2" style="display: none;">
												<label class="control-label">retaper le mot de passe</label>
												<input type="password" name="pass2" class="mdp2" >
											</div>
											<a href="#" class="btn btn-lg btn-primary full-width connec_first">Créé ton mot de passe!</a>
										</div>
									</div>
								</form>
								<?php }else{?>
								<form class="content connexion" method="POST">
									<div class="row">
										<div class="col-xl-12 col-lg-12 col-md-12">
											<div class="form-group label-floating is-empty">
												<label class="control-label">Ton Email</label>
												<input autocomplete="off" class="form-control email" placeholder="" type="email" name="mail">
											</div>
											<div class="form-group label-floating is-empty">
												<label class="control-label">Ton mot de passe</label>
												<input autocomplete="off" class="form-control" placeholder="" type="password" name="mdp">
											</div>
											<div class="remember">
												<a href="#" data-fancybox data-src="#hidden-content-b" class="forgot">Mot de passe oublié</a>
											</div>
											<input autocomplete="off" type="hidden" name="connect" value="">
											<a href="#" class="btn btn-lg btn-primary full-width connec">Connecte toi!</a>
											<div style="display: none;" id="hidden-content-b">
												<h2><span class="changement">Rentrer l'adresse mail</span> <span class="poste"></span></h2>
												<input autocomplete="off" type="text" placeholder="Email" class="forgotemail">
												<input autocomplete="off" type="hidden" class="hidden">
												<input autocomplete="off" type="text" placeholder="Regarde ta boite mail" class="token">
												<a href="#" class="btn btn-purple btn-lg full-width getpassword">Récupérer son mot de passe</a>
												<a href="#" class="btn btn-purple btn-lg full-width newpassword">Récupérer son mot de passe</a>
											</div>
										</div>
									</div>
								</form>
								<?php }?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- ... end Login-Registration Form  -->





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

		<!-- Datepicker input autocomplete="off" field script-->
		<script src="js/moment.min.js"></script>
		<script src="js/daterangepicker.min.js"></script>
		<script src="js/charte.js"></script>

		<!-- Fancybox-->
		<script src="js/jquery.fancybox.min.js"></script>


	</body>
	</html>