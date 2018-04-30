<?php
include('../connexion_session.php');
if (isset($_COOKIE['id_statut'])) {
//requète pour définir tous les statuts en options dans la partie inscription
	$query_statut = $bdd->query("SELECT * FROM statut");
	$query_statut_sel = $bdd->query("SELECT * FROM user where id_statut = '3' OR id_statut = '5' order by id_statut ASC");
// enregistrement d'un utilisateur de login.php
	$erreur="";
	if (isset($_POST['leader'])) {
		$nom=utf8_decode($_POST['nom']);
		$prenom=utf8_decode($_POST['prenom']);
		$mail=$_POST['mail'];
		$date_naissance=$_POST['datetimepicker'];
		$statut=$_POST['statut'];
		$leader=$_POST['leader'];
// test pour savoir si l'adresse email est déjà présente en base ce qui signifie de tester si l'utilisateur existe déjà
		$query_test_user = $bdd->prepare("SELECT email FROM user WHERE email = :mail");
		$query_test_user->bindParam(':mail', $mail);
		$query_test_user->execute();
		$test_user = $query_test_user->fetch();
		$nb_user = $query_test_user->rowCount();
		$date = DateTime::createFromFormat('d/m/Y', $date_naissance);
		$date_naissance = $date->format('Y-m-d');
		$photo='img/friend-harmonic13.jpg';
		$token='';
		$avatar='img/avatar63-sm.jpg';
		$mdp="";
		$date_create=date('Y-m-d');
		$temp="0";
		if ($nb_user == 0){
			$code = substr(md5(rand()),0,5);
//envoi du mail de récupération
			$to      = $mail;
			$subject = 'Création de compte';
			$message = '<html><body>Bonjour,<br>Vous avez demandé le renouvellement de mot de passe suite à un oubli !<br>Voici le lien à suivre pour créer votre mot de passe: http://outil.fr/login.php?code='.$code.'</body></html>';
			$headers =  "From: gaylord.petit@solocalms.fr\r\n".
			"Reply-To: gaylord.petit@solocalms.fr\r\n".
			"Content-Type: text/html; charset=\"UTF-8\"\r\n";
			mail($to, $subject, $message, $headers);
//si 0 donc pas d'utilisateur avec l'email existant alors on ajoute l'utilisateur
			$query_insert_user = $bdd->prepare("INSERT INTO user (nom, prenom, date_naissance, photo, email, mdp, id_statut, id_manager, token, photo_avatar, date_ajout, temp_statut) VALUES (?,?,?,?,?,?,?,?, ?,?, ?, ?)");
			$query_insert_user->bindParam(1, $nom);
			$query_insert_user->bindParam(2, $prenom);
			$query_insert_user->bindParam(3, $date_naissance);
			$query_insert_user->bindParam(4, $photo);
			$query_insert_user->bindParam(5, $mail);
			$query_insert_user->bindParam(6, $mdp);
			$query_insert_user->bindParam(7, $statut);
			$query_insert_user->bindParam(8, $leader);
			$query_insert_user->bindParam(9, $code);
			$query_insert_user->bindParam(10, $avatar);
			$query_insert_user->bindParam(11, $date_create);
			$query_insert_user->bindParam(12, $temp);
			$query_insert_user->execute();
			$erreur="";
		}else{
			$erreur="utilisateur déjà existant";
		}
	}
	if(isset($_POST['le_statut'])){
		$le_id=$_POST['le_id'];
		$nom=$_POST['nom'];
		$prenom=$_POST['prenom'];
		$email=$_POST['email'];
		$le_statut=$_POST['le_statut'];
		$le_leader=$_POST['le_leader'];
		$update=$bdd->prepare("UPDATE user set nom = ?, prenom = ?, email = ?, id_statut = ?, id_manager = ? where id_user = ?");
		$update->bindParam(1, $nom);
		$update->bindParam(2, $prenom);
		$update->bindParam(3, $email);
		$update->bindParam(4, $le_statut);
		$update->bindParam(5, $le_leader);
		$update->bindParam(6, $le_id);
		$update->execute();
	}
	?>

	<!DOCTYPE html>
	<html lang="fr">
	<head>

		<title>Les clients</title>

		<!-- Required meta tags always come first -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="x-ua-compatible" content="ie=edge">

		<link rel="stylesheet" type="text/css" href="../css/bootstrap-reboot.css">
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="../css/bootstrap-grid.css">

		<link rel="stylesheet" type="text/css" href="../css/introjs.css">
		<link rel="stylesheet" type="text/css" href="../css/introjs-rtl.css">

		<!-- Theme Styles CSS -->
		<link rel="stylesheet" type="text/css" href="../css/theme-styles.css">
		<link rel="stylesheet" type="text/css" href="../css/blocks.css">
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.9.1/sweetalert2.css">

		<link rel="icon" type="image/png" href="../img/favicon.png" />

		<!-- Main Font -->
		<script src="../../js/webfontloader.min.js"></script>
		<script>
			WebFont.load({
				google: {
					families: ['Roboto:300,400,500,700:latin']
				}
			});
		</script>

		<link rel="stylesheet" type="text/css" href="../css/fonts.css">

		<!-- Styles for plugins -->
		<link rel="stylesheet" type="text/css" href="../css/jquery.mCustomScrollbar.min.css">
		<!-- Custom CSS -->
		<link rel="stylesheet" href="../css/main.css">
		<link rel="stylesheet" href="../css/jquery.fancybox.min.css">
		<style type="text/css">
		.nouvv{
			padding: 0 !important;
			font-size: 30px;
			border: 1px dashed grey;
			text-align: center;
		}
		.nouvv:before{
			content:"";
		}
	</style>
</head>

<body>

	<!-- NAV + HEADER -->
	<?php 
	include('../includes/left_sidebar.php');
	include('../includes/header.php');
	include('../includes/responsive_header.php');
	?>
	<!-- ... end NAV + HEADER -->

	<div class="header-spacer header-spacer-small"></div>


	<div class="main-header">
		<div class="content-bg-wrap">
			<div class="content-bg bg-group"></div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 col-md-8 offset-md-2 col-sm-12 col-xs-12">
					<div class="main-header-content">
						<?php if ($_COOKIE['id_statut'] == 5) {?>
						<h1>Enregistrer ou modifier un utilisateur</h1>
						<p>Cette page vous permettra d'enregistrer ou de modifier un utilisateurs. Cette action enverra un mail à l'adresse indiquée et l'utilisateur pourra créer un mot de passe pour ensuite se connecter!
						</p>
						<?php }else{ ?>
						<h1>Visualisation des équipes</h1>
						<p>Cette page vous permettra de visualiser l'ensemble des équipes
						</p>
						<?php }?>
					</div>
				</div>
			</div>
		</div>

		<img class="img-bottom" src="img/group-bottom.png" alt="friends">
	</div>

	<!-- Main Content Groups -->

	<?php if ($_COOKIE['id_statut'] == 5) {?>
	<div class="container">
		<div class="row">
			<div class="col-xl-9 order-xl-2 col-lg-6 order-lg-2 col-md-12 order-md-1 col-sm-12 col-xs-12">
				<div class="ui-block">
					<div class="ui-block-title">
						<h6 class="title">Enregistrer un utilisateur</h6>
						<span style="color:red;font-style: italic;"><?php echo $erreur;?></span>
					</div>
					<div class="ui-block-content">
						<form method="POST" action="moderation_user.php" class="user_form">

							<div class="form-group label-floating is-empty">
								<label class="control-label">Prénom</label>
								<input autocomplete="off" class="form-control check_prenom" placeholder="" type="text" name="prenom" required>
							</div>
							<div class="form-group label-floating is-empty">
								<label class="control-label">Nom</label>
								<input autocomplete="off" class="form-control check_nom" placeholder="" type="text" name="nom" required>
							</div>


							<div class="form-group label-floating is-empty">
								<label class="control-label">Email</label>
								<input autocomplete="off" class="form-control check_email" placeholder="" type="email" name="mail" required>
							</div>

							<div class="form-group date-time-picker label-floating">
								<label class="control-label">Date de naissance</label>
								<input autocomplete="off" name="datetimepicker" value="10/11/1984" />
							</div>
							<select class="form-control check_statut mb" size="auto" name="statut" required>
								<option value="0">Choisir un statut</option>
								<?php foreach ($query_statut as $key => $statut) {?>
								<option value="<?php echo $statut['id_statut']?>"><?php echo utf8_encode($statut['nom_statut']);?></option>
								<?php }?>
							</select>

							<select class="form-control check_leader mb" size="auto" name="leader" required>
								<option value="0">Choisir un leader</option>
								<?php foreach ($query_statut_sel as $key => $statut_sel) {?>
								<option value="<?php echo $statut_sel['id_user']?>"><?php echo utf8_encode($statut_sel['prenom']);?> <?php echo utf8_encode($statut_sel['nom']);?></option>
								<?php }?>
							</select>

						</form>

						<div class="row">
							<div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<a href="#" class="btn btn-secondary btn-lg full-width">Renitialiser</a>
							</div>
							<div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<a href="#" class="btn btn-green btn-lg full-width btn-icon-left valid_user">
								Valider</a>
							</div>
						</div>
					</div>
				</div>

			</div>

			<div class="col-xl-3 order-xl-1 col-lg-6 order-lg-1 col-md-12 order-md-2 col-sm-12 col-xs-12">
				<div class="ui-block">
					<div class="ui-block-title">
						<h6 class="title">Ajoutés récemment</h6>
					</div>
					<ol class="widget w-playlist">
						<?php
						$query=$bdd->prepare("SELECT * FROM user inner join statut on user.id_statut = statut.id_statut order by id_user DESC limit 5");
						$query->execute();
						foreach ($query as $key => $value) {?>
						<li>
							<div class="playlist-thumb">
								<img src="../<?php echo $value['photo_avatar'];?>" alt="thumb-composition">
								<div class="overlay"></div>
								<a class="play-icon">
									<svg class="olymp-music-play-icon-big"><use xlink:href="icons/icons-music.svg#olymp-music-play-icon-big"></use></svg>
								</a>
							</div>

							<div class="composition">
								<a class="composition-name"><?php echo $value['prenom'];?> <?php echo $value['nom'];?></a>
								<a class="composition-author"><?php echo $value['nom_statut'];?></a>
							</div>
							<div class="composition-time">
								<!-- <time class="published" datetime="2017-03-24T18:18"><?php echo $value['date_ajout'];?></time> -->

							</div>
						</li>
						<?php }?>
					</ol>

				</div>
			</div>
		</div>
	</div>

	<div class="container">
		<div class="row">
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="ui-block responsive-flex">
					<div class="ui-block-title">
						<div class="h6 title">Modifier un utilisateur</div>

						<div class="align-right">
							<input type="text" placeholder="Rechercher un utilisateur" class="search_user">
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
	<?php } ?>
	<div class="container">
		<div class="row">
			<?php
			$query2=$bdd->prepare("SELECT * FROM user inner join statut on user.id_statut = statut.id_statut where user.id_statut='3' and id_user != '21'");
			$query2->execute();
			foreach ($query2 as $value2) {?>
			<div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<div class="ui-block">
					<div class="ui-block-title">
						<img style="cursor: pointer;max-width: 40px;max-height: 40px;" class="<?php if ($_COOKIE['id_statut'] == 5) { echo 'lemodal_moderation';}?>"  src="../<?php echo $value2['photo_avatar'];?>" alt="thumb-composition" d<?php if ($_COOKIE['id_statut'] == 5) { echo 'data-toggle="modal" data-target="#problemos"';}?> data-id="<?php echo $value2['id_user'];?>"> <h6 class="title"><?php echo $value2['prenom'];?> <?php echo $value2['nom'];?> </h6>
					</div>

					<ol class="widget w-playlist <?php if ($_COOKIE['id_statut'] == 5) { echo 'sortt';}?>" id = "<?php echo $value2['id_user'];?>">
						<?php
						$manag=$value2['id_user'];
						$query3=$bdd->prepare("SELECT * FROM user inner join statut on user.id_statut = statut.id_statut where id_manager=? and user.id_manager!='21' order by user.id_statut");
						$query3->bindParam(1, $manag);
						$query3->execute();
						foreach ($query3 as $value3) {?>
						<li class="<?php if ($_COOKIE['id_statut'] == 5) { echo 'lemodal_moderation';}?>" id="<?php echo $value3['id_user'];?>" <?php if ($_COOKIE['id_statut'] == 5) { echo 'data-toggle="modal" data-target="#problemos"';}?> data-id="<?php echo $value3['id_user'];?>" <?php if($value3['id_statut']=="2"){echo "style='background: rgba(31, 113, 173, 0.42)'";}elseif($value3['id_statut']=="1"){echo "style='background: rgba(173, 31, 168, 0.42)'";} ?>>
							<input type="hidden" class="temp_stat" value="<?php echo $value3['id_statut'];?>">
							<div class="playlist-thumb" >
								<img src="../<?php echo $value3['photo_avatar'];?>" alt="thumb-composition" style="max-width: 40px;max-height: 40px;">
							</div>

							<div class="composition">
								<a class="composition-name"><?php echo $value3['prenom'];?> <?php echo $value3['nom'];?></a>
								<a class="composition-author"><?php echo $value3['nom_statut'];?></a>
							</div>
							<div class="composition-time">
								<!-- <time class="published" datetime="2017-03-24T18:18"><?php echo $value3['date_ajout'];?></time> -->

							</div>
						</li>
						<?php }?>
					</ol>
				</div>
			</div>
			<?php }?>
			<div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<div class="ui-block">
					<div class="ui-block-title">
						<h6 class="title">Contrôleurs</h6>
					</div>

					<ol class="widget w-playlist <?php if ($_COOKIE['id_statut'] == 5) { echo 'sortt';}?>" id = "controlleur">
						<?php
						$query4=$bdd->prepare("SELECT * FROM user inner join statut on user.id_statut = statut.id_statut where user.id_statut='4' order by user.id_statut");
						$query4->execute();
						foreach ($query4 as $value4) {?>
						<li class="<?php if ($_COOKIE['id_statut'] == 5) { echo 'lemodal_moderation';}?>" id="<?php echo $value4['id_user'];?>" <?php if ($_COOKIE['id_statut'] == 5) { echo 'data-toggle="modal" data-target="#problemos"';}?> data-id="<?php echo $value4['id_user'];?>">
							<input type="hidden" class="temp_stat" value="<?php echo $value4['temp_statut'];?>">
							<div class="playlist-thumb">
								<img src="../<?php echo $value4['photo_avatar'];?>" alt="thumb-composition">
							</div>

							<div class="composition">
								<a class="composition-name"><?php echo $value4['prenom'];?> <?php echo $value4['nom'];?></a>
								<a class="composition-author"><?php echo $value4['nom_statut'];?></a>
							</div>
							<div class="composition-time">
							</div>
						</li>
						<?php }?>
					</ol>
				</div>
			</div>
		</div>
	</div>


	<div class="modal fade show" id="problemos">
		<div class="modal-dialog ui-block window-popup fav-page-popup">
			<a href="#" class="close icon-close" data-dismiss="modal" aria-label="Close">
				<svg class="olymp-close-icon"><use xlink:href="icons/icons.svg#olymp-close-icon"></use></svg>
			</a>

			<div class="ui-block-title">
				<h6 class="title">Modification de l'utilisateur</h6>
			</div>

			<div class="ui-block-content resultat_moderation">

			</div>

		</div>
	</div>

	<script src="../js/jquery-3.2.0.min.js"></script>
	<!-- Js effects for material design. + Tooltips -->
	<script src="../js/material.min.js"></script>
	<!-- Helper scripts (Tabs, Equal height, Scrollbar, etc) -->
	<script src="../js/theme-plugins.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
	<!-- Init functions -->
	<script src="../js/main.js"></script>
	<script src="../js/alterclass.js"></script>
	<!-- Select / Sorting script -->
	<script src="../js/selectize.min.js"></script>

	<!-- Swiper / Sliders -->
	<script src="../js/swiper.jquery.min.js"></script>

	<script src="../js/isotope.pkgd.min.js"></script>

	<script src="../js/mediaelement-and-player.min.js"></script>
	<script src="../js/mediaelement-playlist-plugin.min.js"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.9.1/sweetalert2.min.js"></script>
	<script src="../js/intro.min.js"></script>
	<script src="../js/pages/moderation_user.js"></script>
	<script src="../js/charte.js"></script>
	<?php 
	if(isset($_COOKIE['event'])) { 
		if($_COOKIE['event']==1){
			include("../includes/popup_event.php");
		}
	}
	if($_COOKIE['id_statut']==1) {
						//page graphistes 
		?><script src="../js/notifications.js"></script><?php
	}elseif  ($_COOKIE['id_statut']==2){
						//page  redacteurs
		?><script src="../js/notifications.js"></script><?php
	}
	elseif ($_COOKIE['id_statut']==3) {
						//page leader
		?><script src="../js/notifications.js"></script><?php
	}elseif ($_COOKIE['id_statut']==4) {
						//page controleur
		?><script src="../js/notifications_controleur.js"></script><?php
	}elseif($_COOKIE['id_statut']==5){
						//page admin
		?><script src="../js/notifications_admin.js"></script><?php
	}
	?> 

</body>
</html>
<?php 
}else{
	header('Location: ../login.php');
}
?>