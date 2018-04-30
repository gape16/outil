<?php

// Connexion à la base de donnée et insertion de session_start
include('../connexion_session.php');


function time_elapsed_string($datetime, $full = false) {
	$now = new DateTime;
	$ago = new DateTime($datetime);
	$diff = $now->diff($ago);

	$diff->w = floor($diff->d / 7);
	$diff->d -= $diff->w * 7;

	$string = array(
		'y' => 'an',
		'm' => 'mois',
		'w' => 'semaine',
		'd' => 'jour',
		'h' => 'heure',
		'i' => 'minute',
		's' => 'seconde',
	);
	foreach ($string as $k => &$v) {
		if ($diff->$k) {
			$v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
		} else {
			unset($string[$k]);
		}
	}

	if (!$full) $string = array_slice($string, 0, 1);
	return $string ? ' Il y a ' .implode(', ', $string) : 'maintenant';
}

// truncate string at word
function shapeSpace_truncate_string_at_word($string, $limit, $break = " ", $pad = "...") {  
	
	if (strlen($string) <= $limit) return $string;
	
	if (false !== ($max = strpos($string, $break, $limit))) {

		if ($max < strlen($string) - 1) {
			
			$string = substr($string, 0, $max) . $pad;
		}
		
	}
	return $string;
}

if (isset($_COOKIE['id_statut'])) {
	if (isset($_GET['limite'])) {
		$limite=intval($_GET['limite'])-1;
	}else{
		$limite=0;
	}

	$query_select_categorie = $bdd->prepare("SELECT * FROM categorie_aide");
	$query_select_categorie->execute();
	$query_select_aide = $bdd->prepare("SELECT * FROM aide inner join user on aide.id_user=user.id_user inner join etat_aide on aide.id_etat_aide = etat_aide.id_etat_aide order by date_aide DESC limit :offset, 10");
	$query_select_aide->bindValue('offset', $limite, PDO::PARAM_INT);
	$query_select_aide->execute();
	$id_graph=$_COOKIE['id_graph'];
	$query_select_aide_limit = $bdd->prepare("SELECT * FROM aide inner join user on aide.id_user=user.id_user inner join etat_aide on aide.id_etat_aide = etat_aide.id_etat_aide order by date_aide DESC");
	$query_select_aide_limit->execute();
	$nb_limit=$query_select_aide_limit->rowCount();
	$query_notif_code=$bdd->prepare("SELECT * FROM aide order by id_aide DESC limit 1");
	$query_notif_code->execute();
	$query_featured=$bdd->prepare("SELECT commentaires_aide.id_aide, titre, date_aide, count(commentaires_aide.id_aide) as toto FROM aide inner join commentaires_aide on aide.id_aide = commentaires_aide.id_aide group by commentaires_aide.id_aide order by toto DESC limit 5");
	$query_featured->execute();
	$query_recent=$bdd->prepare("SELECT commentaires_aide.id_aide,commentaires_aide.id_aide, date_commentaire, titre FROM commentaires_aide left join aide on commentaires_aide.id_aide = aide.id_aide group by id_aide order by date_commentaire DESC limit 5");
	$query_recent->execute();
	$result_notif_code=$query_notif_code->fetch();
	$dernier=$result_notif_code['id_aide'];
	$query_inser_code=$bdd->prepare("UPDATE notifications set notif_D = ? where id_user = ?");
	$query_inser_code->bindParam(1, $dernier);
	$query_inser_code->bindParam(2, $id_graph);
	$query_inser_code->execute();
	?>

	<!DOCTYPE html>
	<html lang="fr">
	<head>

		<title>Demande d'aide</title>

		<!-- Required meta tags always come first -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="x-ua-compatible" content="ie=edge">

		<link rel="icon" type="image/png" href="../img/favicon.png" />

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" type="text/css" href="../css/bootstrap-reboot.css">
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="../css/bootstrap-grid.css">

		<!-- Theme Styles CSS -->
		<link rel="stylesheet" type="text/css" href="../css/theme-styles.css">
		<link rel="stylesheet" type="text/css" href="../css/blocks.css">
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.9.1/sweetalert2.css">

		<!-- Main Font -->
		<script src="../js/webfontloader.min.js"></script>
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
		<style>
		.text				{
			max-width: 300px;
			word-wrap: break-word;
		}
		textarea#code {
			width: 100%;
			border-color: #e6ecf5;
		}
		.no-mb{
			margin-bottom: 0;
		}
		.reset_new_help, .valider_aide{
			cursor: pointer;
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


	<!-- Main Header Groups -->

	<div class="main-header">
		<div class="content-bg-wrap">
			<div class="content-bg bg-group"></div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-lg-8 m-auto col-md-8 col-sm-12 col-xs-12">
					<div class="main-header-content">
						<h1>Bienvenu au centre d'aide!</h1>
						<p>Vous avez un problème et vous ne savez pas comment le résoudre ou bien vous ne savez pas combien de temps cela va vous prendre ? Ne cherchez plus vous allez trouver votre bonheur ici !</p>
					</div>
				</div>
			</div>
		</div>
	</div>



	<div class="container">
		<div class="row">
			<div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-xs-12">

				<div class="ui-block">
					<div class="ui-block-title bg-blue">
						<h6 class="title c-white">Créer un nouveau sujet</h6>
					</div>
					<div class="ui-block-content">
						<div class="row">
							<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<form role="form" data-toggle="validator" class="form-group label-floating is-empty help form-reset" id="new_help">
									<div class="form-group is-empty label-floating">
										<select class="categorie" name="type" data-validation="required" data-validation-error-msg-required="Veuillez selectionner une catégorie" required>
											<option value="0">Choisir une catégorie</option>
											<?php foreach ($query_select_categorie as $key => $value) {?>
											<option value="<?php echo($value['id_categorie_aide']) ?>"><?php echo utf8_encode($value['nom_categorie_aide']) ?></option>
											<div class="help-block with-errors"></div>
											<?php }
											?>
										</select>
									</div>
									<div class="form-group is-empty label-floating has-feedback">
										<label for="inputNum" class="control-label">Numéro client</label>
										<input class="form-control numclient" id="inputNum" type="text" data-validation="length required number" data-validation-length="8" data-validation-error-msg-number="Un numéro client est requis" data-validation-error-msg-length="8 caractères requis"  data-validation-error-msg-required="Champs requis" required>
									</div>
									<div class="form-group label-floating is-empty has-feedback">
										<label id="inputCms" class="control-label">Adresse CMS</label>
										<input class="form-control adressecms" id="inputCms" type="url" data-validation="required url" data-validation-error-msg-url="Lien exemple : https://cms.site-privilege.pagesjaunes.fr/workflow/service/SG23A03B45E0991F40E05400212848EF90/" data-validation-error-msg-required="Champs requis" required>
									</div>
									<div class="form-group label-floating is-empty">
										<label class="control-label">Titre du problème</label>
										<input class="form-control titre_probleme" placeholder=""  data-validation="length required" data-validation-length="min3" data-validation-error-msg-length="3 caractères minimum requis"  data-validation-error-msg-required="Champs requis" required>
									</div>
									<div class="form-group label-floating is-empty">
										<label class="control-label">Description du problème</label>
										<textarea name="description" id="description" cols="30" rows="10" data-validation="length required" data-validation-length="min140" data-validation-error-msg-length="140 caractères minimum requis"  data-validation-error-msg-required="Champs requis" required></textarea>
										<p><span class="count">0</span> / 140 caractères</p>
									</div>
									<div class="form-group label-floating is-empty">
										<label class="control-label">Code</label>
										<textarea name="description" id="code" cols="30" rows="10"></textarea>
									</div>
									<div class="form-group label-floating is-empty">
										<form class="upload_veille">
											<input type="file" id="file-select" name="photos" required="required" data-validation="mime size" data-validation-allowing="jpg, png, gif" data-validation-max-size="2M">
										</form>
									</div>
								</form>
								<div class="row whitecolor">
									<div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-xs-12">
										<a class="btn btn-secondary btn-lg full-width reset_new_help">Réinitialiser </a>
									</div>
									<div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-xs-12">
										<a class="btn btn-green btn-lg full-width btn-icon-left valider_aide"><i class="fa fa-paper-plane-o" aria-hidden="true"></i>
										Valider la demande</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-xs-12">
				<div class="ui-block">
					<div class="ui-block-title">
						<h6 class="title">Sujets favoris</h6>
					</div>
					<div class="ui-block-content">


						<!-- Widget Featured Topics -->

						<ul class="widget w-featured-topics no-mb">
							<?php foreach ($query_featured as $value) {?>
							<li>
								<i class="icon fa fa-star" aria-hidden="true"></i>
								<div class="content">
									<a href="test_help_open.php?post=<?php echo $value['id_aide'] ;?>" class="h6 title"><?php echo utf8_encode($value['titre']);?></a>
									<time class="entry-date updated" datetime="$value['date_aide']"><?php echo time_elapsed_string($value['date_aide']) ;?></time>
								</div>
							</li>
							<?php }?>
						</ul>

						<!-- ... end Widget Featured Topics -->
					</div>
				</div>

				<div class="ui-block">
					<div class="ui-block-title">
						<h6 class="title">Sujets commentés récemment</h6>
					</div>
					<div class="ui-block-content">


						<!-- Widget Recent Topics -->

						<ul class="widget w-featured-topics no-mb">
							<?php foreach ($query_recent as $value) {
								?>
								<li>
									<div class="content">
										<a href="test_help_open.php?post=<?php echo $value['id_aide'] ;?>" class="h6 title"><?php echo utf8_encode($value['titre']);?></a>
										<time class="entry-date updated" datetime="$value['date_aide']"><?php echo time_elapsed_string($value['date_commentaire']) ;?></time>
									</div>
								</li>
								<?php }?>
							</ul>

							<!-- ... end Widget Recent Topics -->
						</div>
					</div>

				</div>

			</div>
		</div>



		<!-- ... end Window-popup-CHAT for responsive min-width: 768px -->
		<!-- jQuery first, then Other JS. -->
		<script src="../js/jquery-3.2.0.min.js"></script>
		<!-- Js effects for material design. + Tooltips -->
		<script src="../js/material.min.js"></script>
		<!-- Helper scripts (Tabs, Equal height, Scrollbar, etc) -->
		<script src="../js/theme-plugins.js"></script>
		<!-- Init functions -->
		<script src="../js/main.js"></script>
		<script src="../js/alterclass.js"></script>
		<!-- Select / Sorting script -->
		<script src="../js/selectize.min.js"></script>

		<link rel="stylesheet" type="text/css" href="../css/bootstrap-select.css">

		<script src="../js/mediaelement-and-player.min.js"></script>
		<script src="../js/mediaelement-playlist-plugin.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.9.1/sweetalert2.min.js"></script>
		<script src="../js/simpleUpload.min.js"></script>
		<script src="../js/pages/help.js"></script>
		<script src="../js/charte.js"></script>
		<script src="../js/jquery.fancybox.min.js"></script>
		<script src="../js/js.cookie.js"></script>

		<script src="../js/jquery.form-validator.js"></script>

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
	<?php }else{
		header('Location: ../login.php');
	}
	?>
