<?php

// Connexion à la base de donnée et insertion de session_start
include('connexion_session.php');

if(isset($_GET['token'])){
	$token = $_GET['token'];
	$query_edit_pw = $bdd->prepare("SELECT * FROM user WHERE token = ?");
	$query_edit_pw->bindParam(1, $token);
	$query_edit_pw->execute();
	exit();
}


if(isset($_COOKIE['id_graph'])){
	$_SESSION['email']=$_COOKIE['email'];
	$_SESSION['id_graph']=$_COOKIE['id_graph'];
	$_SESSION['id_statut']=$_COOKIE['id_statut'];
	if($_COOKIE['id_statut']==1) {
			//page graphistes 
		header('Location: pages/help.php');
			// echo "1";
	}elseif  ($_COOKIE['id_statut']==2){
			//page  redacteurs
		header('Location: pages/help.php');
			// echo "2";
	}
	elseif ($_COOKIE['id_statut']==3) {
			//page leader
			// echo "3";
		header('Location: pages/help.php');
	}elseif ($_COOKIE['id_statut']==4) {
			//page controleur
			// echo "4";
		header('Location: pages/help.php');
	}elseif($_COOKIE['id_statut']==5){
			//page admin
			// echo "5";
		header('Location: pages/help.php');
	}
}

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
		setcookie("email", $mail,2147483647);
		setcookie("id_graph", $test_user['id_user'],2147483647);
		setcookie("id_statut", $test_user['id_statut'],2147483647);
		if($test_user['id_statut']==1) {
			//page graphistes 
			header('Location: pages/help.php');
			// echo "1";
		}elseif  ($test_user['id_statut']==2){
			//page  redacteurs
			header('Location: pages/help.php');
			// echo "2";
		}
		elseif ($test_user['id_statut']==3) {
			//page leader
			// echo "3";
			header('Location: pages/help.php');
		}elseif ($test_user['id_statut']==4) {
			//page controleur
			// echo "4";
			header('Location: pages/help.php');
		}elseif($test_user['id_statut']==5){
			//page admin
			// echo "5";
			header('Location: pages/help.php');
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
	<link rel="icon" type="image/png" href="img/favicon.png" />

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
	.tab-content > .tab-pane{
		display: block;
	}
	html, body {
		width: 100%;
		height: auto;
		overflow: hidden;
	}
</style>
</head>

<body class="landing-page">

	<div class="content-bg-wrap">
		<div class="content-bg ah"></div>
	</div>


	<!-- Landing Header -->

	<div class="container" style="margin-bottom: 0;">
		<div class="row">
			<div class="col-xl-12 col-lg-12 col-md-12">
				<div id="site-header-landing" class="header-landing">
					<a href="#" class="logo" style="background: none;">
						<svg id="Calque_1" data-name="Calque 1" viewBox="0 0 70 70" style="width:55px;height:auto; "><defs><style>.cls-1,.cls-2{fill:#fff;}.cls-1{opacity:0.8;}</style></defs><polygon class="cls-1" points="7.08 18.82 35 2.64 62.92 18.82 62.92 51.18 35 67.36 7.08 51.18 7.08 18.82"></polygon><polygon class="cls-2" points="7.08 18.82 7.08 51.18 35 67.36 35 35 7.08 18.82"></polygon></svg>
						<h5 class="logo-title">SOLOCAL MARKETING SERVICE</h5>
					</a>
				</div>
			</div>
		</div>
	</div>

	<!-- ... end Landing Header -->

	<!-- Login-Registration Form  -->

	<div class="container" style="margin-bottom: 0;">
		<div class="row display-flex">
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="landing-content">
					<h1>Inscription et connexion</h1>
					<p>
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
									}
								}
								?>
							</div>
							<form class="content connexion" method="POST">
								<div class="row">
									<?php if(isset($_GET['token'])){?>
									<div class="col-xl-12 col-lg-12 col-md-12">
										<div class="form-group label-floating is-empty">
											<label class="control-label">Crée un mot de passe</label>
											<input autocomplete="off" class="form-control email" placeholder="" type="email" name="mail">
										</div>
										<div class="form-group label-floating is-empty">
											<label class="control-label">Retaper le mot de passe</label>
											<input autocomplete="off" class="form-control" placeholder="" type="password" name="mdp">
										</div>
										<a href="#" class="btn btn-lg btn-primary full-width connec">Connecte toi!</a>
									</div>
									<?php }else{?>
									<div class="col-xl-12 col-lg-12 col-md-12">
										<div class="form-group label-floating is-empty <?php if (isset($_POST['connect'])) { echo "is-focused"; }?>">
											<label class="control-label">Ton Email</label>
											<input autocomplete="off" class="form-control email" placeholder="" type="email" name="mail" value="<?php if (isset($_POST['connect'])) { echo $_POST['mail']; }?>">
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
									<?php }?>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php if(isset($_GET['token'])){?>
	<div class="col-xl-12 col-lg-12 col-md-12">
		<div class="form-group label-floating is-empty">
			<label class="control-label">Crée un mot de passe</label>
			<input autocomplete="off" class="form-control email" placeholder="" type="email" name="mail">
		</div>
		<div class="form-group label-floating is-empty">
			<label class="control-label">Retaper le mot de passe</label>
			<input autocomplete="off" class="form-control" placeholder="" type="password" name="mdp">
		</div>
		<a href="#" class="btn btn-lg btn-primary full-width connec">Connecte toi!</a>
	</div>
	<?php }?>

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