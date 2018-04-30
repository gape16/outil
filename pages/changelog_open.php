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

$id_graph=$_COOKIE['id_graph'];

if(isset($_GET['id_log'])){
	$id_log = $_GET['id_log'];
	$query_show_log = $bdd->prepare("SELECT * FROM log  left join user on user.id_user = log.auteur left join categorie_log on categorie_log.id_categorie_log = log.categorie WHERE id_log = ?");
	$query_show_log->bindParam(1, $id_log);
	$query_show_log->execute();
	$log = $query_show_log->fetch();
}else{
	header('Location: changelog.php');
}

if (isset($_COOKIE['id_statut'])) {

	?>
	<!DOCTYPE html>
	<html lang="fr" id="log_open">
	<head>

		<title>Changelog</title>
		<meta http-equiv="refresh" content="12000">

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
		<link rel='stylesheet' href='../css/fullcalendar.css'/>
		<link rel='stylesheet' href='../css/simplecalendar.css'/>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap-select.css">
		<link rel="stylesheet" type="text/css" href="../css/daterangepicker.css">
		<link rel="stylesheet" type="text/css" href="../css/main.css">
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.9.1/sweetalert2.css">
		<link rel="stylesheet" href="../css/jquery.fancybox.min.css">
		<style>
		.dl-pj{
			padding: 10px 20px;
			background: #38a9ff;
			color: white;
			border-radius: 3px;
		}
		a.dl-pj:hover{
			color: white !important;
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

	<div class="stunning-header bg-primary-opacity">

		<!-- ... end Header Standard Landing  -->
		<div class="header-spacer--standard"></div>

		<div class="stunning-header-content">
			<h1 class="stunning-header-title">Log</h1>
		</div>

		<div class="content-bg-wrap">
			<div class="content-bg stunning-header-bg1"></div>
		</div>
	</div>

	<div class="container pr55">
		<div class="col-xl-8 m-auto col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="ui-block">

				<!-- Single Post -->

				<article class="hentry blog-post single-post single-post-v1">

					<a class="post-category bg-primary"><?php if(isset($_GET['id_log'])) {echo utf8_encode($log['nom_categorie']); }?></a>

					<div class="wrapper">
						<div class="author-date">
							<div class="author-thumb">
								<img alt="author" src="../<?php echo utf8_encode($log['photo_avatar']);?>" class="avatar">
							</div>
							<div class="wrapper_whois">
								<a class="h6 post__author-name fn"><?php if(isset($_GET['id_log'])) {echo utf8_encode($log['nom'] . ' ' . $log['prenom']); }?></a><br/>
								<div class="post__date">
									<time class="published">
										<?php if(isset($_GET['id_log'])) {echo time_elapsed_string(utf8_encode($log['date_log'])); }?>
									</time>
								</div>
							</div>
						</div>


						<h1 class="post-title"><?php if(isset($_GET['id_log'])) {echo utf8_encode($log['titre']); }?></h1>


						<div class="post-content-wrap">
							<p class="post-content">
								<?php if(isset($_GET['id_log'])) {echo utf8_encode($log['description']); }?>
							</p>
						</div>
						<?php  if (!empty($log['file'])) {?>
						<div class="post-img">
							<p class="pj">Pièce(s) jointe(s)</p>
							<a class="dl-pj">Télécharger</a>
							<?php 

							$files = explode(";", $log['file']);

							foreach ($files as $key => $value) {?>
							<a class="trigger hide" href="../uploads/log/<?php echo($value);?>" download></a>
							<?php }?>
						</div>
						<?php } ?>
					</div>
				</article>

				<!-- ... end Single Post -->

			</div>
		</div>
	</div>


	<!-- jQuery first, then Other JS. -->
	<script src="../js/jquery-3.2.0.min.js"></script>
	<!-- Js effects for material design. + Tooltips -->
	<script src="../js/material.min.js"></script>
	<!-- Helper scripts (Tabs, Equal height, Scrollbar, etc) -->
	<script src="../js/theme-plugins.js"></script>
	<!-- Init functions -->
	<script src="../js/main.js"></script>

	<!-- Select / Sorting script -->
	<script src="../js/selectize.min.js"></script>

	<!-- Swiper / Sliders -->
	<script src="../js/swiper.jquery.min.js"></script>

	<!-- Datepicker input field script-->
	<script src="../js/moment.min.js"></script>
	<script src="../js/daterangepicker.min.js"></script>

	<!-- Calendar events script -->
	<script src="../js/fullcalendar.js"></script>

	<script src="../js/mediaelement-and-player.min.js"></script>
	<script src="../js/mediaelement-playlist-plugin.min.js"></script>
	<script src="../js/simpleUpload.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.9.1/sweetalert2.min.js"></script>
	<script src="../js/jquery.fancybox.min.js"></script>
	<?php
	if(!isset($_COOKIE['event'])) { 
		include("../includes/popup_event.php");
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
	<script src="../js/js.cookie.js"></script>
	<script src="../js/pages/changelog.js"></script>
	<script src="../js/charte.js"></script>
	<script src="../js/alterclass.js"></script>
	<script>

		$('.dl-pj').on('click', function(){
			$('.trigger').each(function(){
				$(this).get(0).click();
			})
		})
	</script>
</body>
</html>
<?php }else{
	header('Location: ../login.php');
}
?>