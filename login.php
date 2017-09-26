<?php

// Connexion à la base de donnée et insertion de session_start
include('connexion_session.php');


//requète pour définir tous les statuts en options dans la partie inscription
$query_statut = $bdd->query("SELECT * FROM statut");


// enregistrement d'un utilisateur de login.php
if (isset($_POST['register'])) {
	$nom=$_POST['nom'];
	$prenom=$_POST['prenom'];
	$mail=$_POST['mail'];
	$date_naissance=$_POST['datetimepicker'];
	$mdp=password_hash($_POST['mdp'], PASSWORD_DEFAULT);
	$statut=$_POST['statut'];
	// test pour savoir si l'adresse email est déjà présente en base ce qui signifie de tester si l'utilisateur existe déjà
	$query_test_user = $bdd->prepare("SELECT email FROM user WHERE email = :mail");
	$query_test_user->bindParam(':mail', $mail);
	$query_test_user->execute();
	$test_user = $query_test_user->fetch();
	$nb_user = $query_test_user->rowCount();
	$date = DateTime::createFromFormat('d/m/Y', $date_naissance);
	$date_naissance = $date->format('Y-m-d');
	$photo='img/friend-harmonic13.jpg';
	$id_manager=0;
	$token='';
	if ($nb_user == 0){
		//si 0 donc pas d'utilisateur avec l'email existant alors on ajoute l'utilisateur
		$query_insert_user = $bdd->prepare("INSERT INTO user (nom, prenom, date_naissance, photo, email, mdp, id_statut, id_manager, token) VALUES (?,?,?,?,?,?,?,?)");
		$query_insert_user->bindParam(1, $nom);
		$query_insert_user->bindParam(2, $prenom);
		$query_insert_user->bindParam(3, $date_naissance);
		$query_insert_user->bindParam(4, $photo);
		$query_insert_user->bindParam(5, $mail);
		$query_insert_user->bindParam(6, $mdp);
		$query_insert_user->bindParam(7, $statut);
		$query_insert_user->bindParam(8, $id_manager);
		$query_insert_user->bindParam(9, $token);
		$query_insert_user->execute();
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
		header('Location: accueil.php');
	}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>

	<title>Landing Page</title>

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
	<link rel="stylesheet" type="text/css" href="Bootstrap/dist/css/bootstrap-reboot.css">
	<link rel="stylesheet" type="text/css" href="Bootstrap/dist/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="Bootstrap/dist/css/bootstrap-grid.css">

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

</head>

<body class="landing-page">

	<div class="content-bg-wrap">
		<div class="content-bg"></div>
	</div>


	<!-- Landing Header -->

	<div class="container">
		<div class="row">
			<div class="col-xl-12 col-lg-12 col-md-12">
				<div id="site-header-landing" class="header-landing">
					<a href="02-ProfilePage.html" class="logo">
						<img src="img/logo.png" alt="Olympus">
						<h5 class="logo-title">olympus</h5>
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
					<h1>Check ton site</h1>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reiciendis alias molestiae fuga accusantium, expedita nam natus in dolores dignissimos, repellat placeat necessitatibus porro unde sunt amet quasi, consequatur itaque repudiandae.
					</p>
				</div>
			</div>

			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="registration-login-form">
					<!-- Nav tabs -->
					<ul class="nav nav-tabs" role="tablist">
						<li class="nav-item">
							<a class="nav-link active" data-toggle="tab" href="#home" role="tab">
								<svg id="olymp-login-icon" viewBox="0 0 29 32" width="100%" height="100%">
									<title>login-icon</title>
									<path d="M0 17.443c0 6.515 4.287 12.026 10.195 13.875v-3.081c-4.263-1.728-7.273-5.901-7.273-10.783 0-4.883 3.009-9.056 7.273-10.784v-3.1c-5.908 1.849-10.195 7.36-10.195 13.872zM18.922 3.578v3.092c4.263 1.728 7.273 5.901 7.273 10.783s-3.009 9.056-7.273 10.783v3.071c5.894-1.855 10.169-7.357 10.169-13.863 0-6.503-4.273-12.007-10.169-13.865zM13.104 14.545h2.909v-14.545h-2.909v14.545zM13.104 32h2.909v-2.909h-2.909v2.909z"></path>
								</svg>
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" data-toggle="tab" href="#profile" role="tab">
								<svg id="olymp-register-icon" viewBox="0 0 37 32" width="100%" height="100%">
									<title>register-icon</title>
									<path d="M16 3.213c3.24 0 6.192 1.214 8.446 3.2h4.346c-2.917-3.888-7.549-6.413-12.781-6.413-7.165 0-13.227 4.714-15.259 11.213h3.387c1.899-4.69 6.491-8 11.861-8zM16 28.813c-5.37 0-9.962-3.31-11.861-8h-3.378c2.040 6.485 8.094 11.187 15.25 11.187 5.222 0 9.842-2.515 12.762-6.387h-4.325c-2.256 1.986-5.208 3.2-8.448 3.2zM32 14.413v-4.8h-3.2v4.8h-4.8v3.2h4.8v4.8h3.2v-4.8h4.8v-3.2h-4.8zM3.2 14.413h-3.2v3.2h3.2v-3.2z"></path>
								</svg>
							</a>
						</li>
					</ul>

					<!-- Tab panes -->
					<div class="tab-content">
						<div class="tab-pane active connect" id="home" role="tabpanel" data-mh="log-tab">
							<div class="title h6">Connectez-vous
								<?php
								if (isset($_POST['register'])) {
									if ($nb_user != 0){
										echo "<br><span style='font-style:italic;color:red;'>Utilisateur déjà existant !</span>";
									}
								}
								?>
							</div>
							<form class="content signin" method="POST" action="login.php">
								<div class="row">
									<div class="col-lg-6 col-md-6">
										<div class="form-group label-floating is-empty">
											<label class="control-label">Prénom</label>
											<input autocomplete="off" class="form-control check" placeholder="" type="text" name="prenom">
										</div>
									</div>
									<div class="col-lg-6 col-md-6">
										<div class="form-group label-floating is-empty">
											<label class="control-label">Nom</label>
											<input autocomplete="off" class="form-control check" placeholder="" type="text" name="nom">
										</div>
									</div>
									<div class="col-xl-12 col-lg-12 col-md-12">
										<div class="form-group label-floating is-empty">
											<label class="control-label">Ton email</label>
											<input autocomplete="off" class="form-control check email" placeholder="" type="email" name="mail">
										</div>
										<div class="form-group label-floating is-empty">
											<label class="control-label">Ton mot de passe</label>
											<input autocomplete="off" class="form-control check" placeholder="" type="password" name="mdp">
										</div>

										<div class="form-group date-time-picker label-floating">
											<label class="control-label">Ta date de naissance</label>
											<input autocomplete="off" class="check" name="datetimepicker" value="10/11/1984" />
											<span class="input autocomplete="off"-group-addon">
												<svg class="olymp-calendar-icon"><use xlink:href="#olymp-calendar-icon"></use></svg>
											</span>
										</div>
										<input autocomplete="off" type="hidden" name="register" value="">
										<select class="form-control" size="auto" name="statut">
											<option value="0">Choisir un statut</option>
											<?php foreach ($query_statut as $key => $statut) {?>
											<option value="<?php echo $statut['id_statut']?>"><?php echo utf8_encode($statut['nom_statut']);?></option>
											<?php }?>
										</select>

										<a href="#" data-fancybox data-src="#hidden-content-a" class="btn btn-purple btn-lg full-width inscription fancybox">Termine ton inscription !</a>
										<div style="display: none;" id="hidden-content-a">
											<h2>Rentrer le code pour : <span class="poste"></span></h2>
											<input autocomplete="off" type="text" placeholder="Code" class="code">
											<a href="#" class="btn btn-purple btn-lg full-width submit">Termine ton inscription !</a>
										</div>
									</div>
								</div>
							</form>
						</div>
						<div class="tab-pane" id="profile" role="tabpanel" data-mh="log-tab">
							<div class="title h6">Connecte toi à ton compte
								<?php 
								if (isset($_POST['connect'])) {
									if(!password_verify($mdp, $test_user['mdp'])){
									//password incorrect
										echo "<br><span style='font-style:italic;color:red;'>Impossible de se connecter</span>";
									}}
									?>
								</div>
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
												<h2>Rentrer l'adresse mail <span class="poste"></span></h2>
												<input autocomplete="off" type="text" placeholder="Email" class="forgotemail">
												<input autocomplete="off" type="hidden" class="hidden">
												<input autocomplete="off" type="text" placeholder="Regarde ta boite mail" class="token">
												<a href="#" class="btn btn-purple btn-lg full-width getpassword">Récupérer son mot de passe</a>
												<a href="#" class="btn btn-purple btn-lg full-width newpassword">Récupérer son mot de passe</a>
											</div>
										</div>
									</div>
								</form>
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