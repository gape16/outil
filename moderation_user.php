<?php
include('connexion_session.php');
if (isset($_SESSION['id_statut'])) {
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
	<html lang="en">
	<head>

		<title>Les clients</title>

		<!-- Required meta tags always come first -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="x-ua-compatible" content="ie=edge">

		<link rel="stylesheet" type="text/css" href="css/bootstrap-reboot.css">
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="css/bootstrap-grid.css">

		<link rel="stylesheet" type="text/css" href="css/introjs.css">
		<link rel="stylesheet" type="text/css" href="css/introjs-rtl.css">

		<!-- Theme Styles CSS -->
		<link rel="stylesheet" type="text/css" href="css/theme-styles.css">
		<link rel="stylesheet" type="text/css" href="css/blocks.css">
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.9.1/sweetalert2.css">

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
		<style>
		.ui-sortable-helper {
			border:1px solid gray;
			z-index: 9999999 !important;
			padding: 20px 10px;
			padding-bottom: 40px;
			cursor: pointer;
			list-style: none;
			height: 75px;
			background: white;
		}
		.ui-sortable-helper:before{
			position: relative;
			counter-increment: list1;
			content: counter(list1) " ";
			color: #888da8;
			display: inline-block;
			margin-right: 10px;
			font-size: 10px;
		}
		.ui-sortable-helper > * {
			display: inline-block;
			vertical-align: middle;
		}
		.ui-sortable-helper .playlist-thumb {
			position: relative;
			width: 34px;
			height: 34px;
			border-radius: 3px;
			overflow: hidden;
			margin-right: 12px;
		}
		.ui-sortable-helper .composition-time {
			position: relative;
			float: right;
			font-size: 11px;
			font-weight: 500;
		}
	</style>
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

	<?php include('header.php');?>

	<!-- ... end Header -->


	<!-- Responsive Header -->

	<?php include('responsive_header.php');?>

	<!-- ... end Responsive Header -->

	<!-- ... end Responsive Header -->


	<div class="header-spacer header-spacer-small"></div>


	<div class="main-header">
		<div class="content-bg-wrap">
			<div class="content-bg bg-group"></div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 col-md-8 offset-md-2 col-sm-12 col-xs-12">
					<div class="main-header-content">
						<h1>Enregistrer ou modifier un utilisateur</h1>
						<p>Cette page vous permettra d'enregistrer ou de modifier un utilisateurs. Cette action enverra un mail à l'adresse indiquée et l'utilisateur pourra créer un mot de passe pour ensuite se connecter!
						</p>
					</div>
				</div>
			</div>
		</div>

		<img class="img-bottom" src="img/group-bottom.png" alt="friends">
	</div>

	<!-- Main Content Groups -->


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
								<label class="control-label">Ta date de naissance</label>
								<input autocomplete="off" name="datetimepicker" value="10/11/1984" />
							</div>
							<select class="form-control check_statut" size="auto" name="statut" required>
								<option value="0">Choisir un statut</option>
								<?php foreach ($query_statut as $key => $statut) {?>
								<option value="<?php echo $statut['id_statut']?>"><?php echo utf8_encode($statut['nom_statut']);?></option>
								<?php }?>
							</select>

							<select class="form-control check_leader" size="auto" name="leader" required>
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
						<li class="js-open-popup" data-popup-target=".playlist-popup">
							<div class="playlist-thumb" data-toggle="tooltip" data-placement="top" title="PLAY / ADD TO PLAYER">
								<img src="<?php echo $value['photo'];?>" alt="thumb-composition">
								<div class="overlay"></div>
								<a href="#" class="play-icon">
									<svg class="olymp-music-play-icon-big"><use xlink:href="icons/icons-music.svg#olymp-music-play-icon-big"></use></svg>
								</a>
							</div>

							<div class="composition">
								<a href="#" class="composition-name"><?php echo $value['prenom'];?> <?php echo $value['nom'];?></a>
								<a href="#" class="composition-author"><?php echo $value['nom_statut'];?></a>
							</div>
							<div class="composition-time">
								<time class="published" datetime="2017-03-24T18:18"><?php echo $value['date_ajout'];?></time>

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
	<div class="container">
		<div class="row">
			<?php
			$query2=$bdd->prepare("SELECT * FROM user inner join statut on user.id_statut = statut.id_statut where user.id_statut='3' and id_user != '21'");
			$query2->execute();
			foreach ($query2 as $value2) {?>
			<div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<div class="ui-block">
					<div class="ui-block-title">
						<img style="cursor: pointer;" class="lemodal_moderation" src="<?php echo $value2['photo'];?>" alt="thumb-composition" data-toggle="modal" data-target="#problemos" data-id="<?php echo $value2['id_user'];?>"> <h6 class="title"> Equipe <?php echo $value2['prenom'];?> <?php echo $value2['nom'];?> </h6>
					</div>

					<ol class="widget w-playlist sortt" id = "<?php echo $value2['id_user'];?>">
						<?php
						$manag=$value2['id_user'];
						$query3=$bdd->prepare("SELECT * FROM user inner join statut on user.id_statut = statut.id_statut where id_manager=? and user.id_manager!='21' order by user.id_statut");
						$query3->bindParam(1, $manag);
						$query3->execute();
						foreach ($query3 as $value3) {?>
						<li class="lemodal_moderation" id="<?php echo $value3['id_user'];?>" data-toggle="modal" data-target="#problemos" data-id="<?php echo $value3['id_user'];?>" <?php if($value3['id_statut']=="2"){echo "style='background: rgba(31, 113, 173, 0.42)'";}elseif($value3['id_statut']=="1"){echo "style='background: rgba(173, 31, 168, 0.42)'";} ?>>
							<input type="hidden" class="temp_stat" value="<?php echo $value3['id_statut'];?>">
							<div class="playlist-thumb" >
								<img src="<?php echo $value['photo'];?>" alt="thumb-composition">
							</div>

							<div class="composition">
								<a href="#" class="composition-name"><?php echo $value3['prenom'];?> <?php echo $value3['nom'];?></a>
								<a href="#" class="composition-author"><?php echo $value3['nom_statut'];?></a>
							</div>
							<div class="composition-time">
								<time class="published" datetime="2017-03-24T18:18"><?php echo $value3['date_ajout'];?></time>

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
						<h6 class="title">Equipe des contrôleurs</h6>
					</div>

					<ol class="widget w-playlist sortt" id = "controlleur">
						<?php
						$query4=$bdd->prepare("SELECT * FROM user inner join statut on user.id_statut = statut.id_statut where user.id_statut='4' order by user.id_statut");
						$query4->execute();
						foreach ($query4 as $value4) {?>
						<li class="lemodal_moderation" id="<?php echo $value4['id_user'];?>" data-toggle="modal" data-target="#problemos" data-id="<?php echo $value4['id_user'];?>">">
							<input type="hidden" class="temp_stat" value="<?php echo $value4['temp_statut'];?>">
							<div class="playlist-thumb" >
								<img src="<?php echo $value['photo'];?>" alt="thumb-composition">
							</div>

							<div class="composition">
								<a href="#" class="composition-name"><?php echo $value4['prenom'];?> <?php echo $value4['nom'];?></a>
								<a href="#" class="composition-author"><?php echo $value4['nom_statut'];?></a>
							</div>
							<div class="composition-time">
								<time class="published" datetime="2017-03-24T18:18"><?php echo $value4['date_ajout'];?></time>

							</div>
						</li>
						<?php }?>
					</ol>
				</div>
			</div>
			<div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<div class="ui-block">
					<div class="ui-block-title">
						<h6 class="title">Equipe des Modifs</h6>
					</div>

					<ol class="widget w-playlist sortt" id="21">
						<?php
						$query4=$bdd->prepare("SELECT * FROM user inner join statut on user.id_statut = statut.id_statut where user.id_manager='21' order by user.id_statut");
						$query4->execute();
						foreach ($query4 as $value4) {?>
						<li class="lemodal_moderation" id="<?php echo $value4['id_user'];?>" data-toggle="modal" data-target="#problemos" data-id="<?php echo $value4['id_user'];?>" <?php if($value4['id_statut']=="2"){echo "style='background: rgba(31, 113, 173, 0.42)'";}elseif($value4['id_statut']=="1"){echo "style='background: rgba(173, 31, 168, 0.42)'";} ?>>
							<div class="playlist-thumb">
								<img src="<?php echo $value['photo'];?>" alt="thumb-composition">
							</div>

							<div class="composition">
								<a href="#" class="composition-name"><?php echo $value4['prenom'];?> <?php echo $value4['nom'];?></a>
								<a href="#" class="composition-author"><?php echo $value4['nom_statut'];?></a>
							</div>
							<div class="composition-time">
								<time class="published" datetime="2017-03-24T18:18"><?php echo $value4['date_ajout'];?></time>

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


	<?php include('chat_box.php');?>

	<!-- ... end Window-popup-CHAT for responsive min-width: 768px -->



	<!-- Init functions -->
	<script src="js/jquery-3.2.0.min.js"></script>
	<!-- Js effects for material design. + Tooltips -->
	<script src="js/material.min.js"></script>
	<!-- Helper scripts (Tabs, Equal height, Scrollbar, etc) -->
	<script src="js/theme-plugins.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
	<!-- Init functions -->
	<script src="js/main.js"></script>
	<script src="js/alterclass.js"></script>
	<script src="js/chat.js"></script>
	<!-- Select / Sorting script -->
	<script src="js/selectize.min.js"></script>

	<link rel="stylesheet" type="text/css" href="css/bootstrap-select.css">


	<script src="js/mediaelement-and-player.min.js"></script>
	<script src="js/mediaelement-playlist-plugin.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.9.1/sweetalert2.min.js"></script>

	<script src="js/intro.min.js"></script>
	<script src="js/charte.js"></script>
	<script src="js/notifications.js"></script>
	<script>
		function isValidEmailAddress(emailAddress) {
			var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
			return pattern.test(emailAddress);
		};
		$(function(){
			$(".lemodal_moderation").on('click', function(){
				var moderation_modif_user = $(this).data('id');
				$.ajax({
					url: 'formulaire.php',
					type: 'POST',
					data: {moderation_modif_user:moderation_modif_user}
				})
				.done(function(data) {
					$(".resultat_moderation").html(data);
				})
			})
			$(".search_user").on('keyup', function(){
				if($(this).val().length > 2){
					var search_user_moderation = $(this).val();
					$.ajax({
						url: 'formulaire.php',
						type: 'POST',
						data: {search_user_moderation: search_user_moderation}
					})
					.done(function(data) {
						$(".sortt li").css("border", "none");
						$(".sortt").css("border", "none");
						$(".sortt li").css("box-shadow", "none");
						$(".sortt ").css("box-shadow", "none");
						var infos = JSON.parse(data);
						for( var i = 0; i < infos.length; i++){
							$("#"+infos[i]).css('border','1px solid white');
							$("#"+infos[i]).css('box-shadow','0 0 35px black');
						}
					})							
				}else{
					$(".sortt li").css("border", "none");
					$(".sortt").css("border", "none");
					$(".sortt li").css("box-shadow", "none");
					$(".sortt ").css("box-shadow", "none");
				}
			})
			$(".sortt").sortable({
				connectWith: ".sortt",
				helper: "clone",
				appendTo: 'body',
				receive: function(event, ui) {
					var newLead = this.id;
					var newGraph = ui.item.attr("id");
					var ancien_statut = ui.item.find(".temp_stat").val();
					var ancien_lead=ui.sender.attr("id");
					if(newLead=="controlleur"){
						console.log("go control");
						$.ajax({
							url: 'formulaire.php',
							type: 'POST',
							data: {newLeader_control: newLead, newGraph:newGraph, ancien_statut:ancien_statut}
						})	
					}else if(ancien_lead=="controlleur"){
						console.log(newLead);
						console.log(newGraph);
						console.log(ancien_statut);
						$.ajax({
							url: 'formulaire.php',
							type: 'POST',
							data: {ancienLeader_control: newLead, newGraph:newGraph, ancien_statut:ancien_statut}
						})
					}else{
						console.log("equipe");
						$.ajax({
							url: 'formulaire.php',
							type: 'POST',
							data: {newLeader: newLead, newGraph:newGraph}
						})	
					}					
				}
			});
			$("body").on('click', '.modif_us', function(e){
				e.preventDefault();
				e.stopPropagation();
				$(".form_user").submit();
			})
			$(".valid_user").on('click', function(e){
				e.preventDefault();
				email_check=$(".check_email").val();
				if (!isValidEmailAddress(email_check)) {
					$(".check_email").addClass('empty');
				}else{
					$(".check_email").removeClass('empty');
					if($(".check_nom").val()==""){
						$(".check_nom").addClass('empty');
					}else{
						$(".check_nom").removeClass('empty');
						if($(".check_prenom").val()==""){
							$(".check_prenom").addClass('empty');
						}else{
							$(".check_prenom").removeClass('empty');
							if($(".check_statut").val()=="0"){
								$(".check_statut").addClass('empty');
							}else{
								$(".check_statut").removeClass('empty');
								if($(".check_leader").val()=="0"){
									$(".check_statut").addClass('empty');
								}else{
									$(".user_form").submit();
											// console.log($(".check_statut").val());
											// console.log($(".check_leader").val());
										}
									}
								}
							}
						}
					})
		})
	</script>
</body>
</html>
<?php }else{
	header('Location: login.php');
}
?>