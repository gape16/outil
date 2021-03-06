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

if (isset($_COOKIE['id_statut'])) {

	$query_code = $bdd->prepare("SELECT * FROM code inner join user on code.id_user = user.id_user inner join categorie_code on code.categorie_code = categorie_code.id_categorie_code  WHERE accept_code = 1 order by date_code DESC");
	$query_code->execute();

	$query_notif_code=$bdd->prepare("SELECT * FROM code where accept_code = 1 order by id_code DESC limit 1");
	$query_notif_code->execute();
	$result_notif_code=$query_notif_code->fetch();
	$dernier=$result_notif_code['id_code'];
	$query_inser_code=$bdd->prepare("UPDATE notifications set notif_A = ? where id_user = ?");
	$query_inser_code->bindParam(1, $dernier);
	$query_inser_code->bindParam(2, $id_graph);
	$query_inser_code->execute();

	?>

	<!DOCTYPE html>
	<html lang="fr" id="explore">
	<head>

		<title>Partage code</title>
		<meta http-equiv="refresh" content="120">

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
		<link rel="stylesheet" type="text/css" href="../css/bootstrap-select.css">
		<style>
		.deny_code{
			background: tomato;
		}
		.accept_code{
			background: #1ed760;
		}
	</style>

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
	pre.break {
		white-space: pre-wrap;
		white-space: -moz-pre-wrap; 
		white-space: -pre-wrap;      
		white-space: -o-pre-wrap; 
		word-wrap: break-word;       
		font-family: Roboto, -apple-system, system-ui, BlinkMacSystemFont, "Segoe UI", "Helvetica Neue", Arial, sans-serif;
		font-size: 0.812rem;
		font-weight: normal;
		line-height: 1.5;
		color: #888da8;
	}
	#veille_code .opencode p{
		word-break: break-word;
	}
</style>
</head>

<body id="veille_code">

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
			<div class="content-bg bg-account"></div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 col-md-8 offset-md-2 col-sm-12 col-xs-12">
					<div class="main-header-content">
						<h1>Bibliothèque de code</h1>
						<p>Consultez et partagez vos codes.
						</p>
					</div>
				</div>
			</div>
		</div>

	</div>


	<?php 

	if($_COOKIE['id_statut']==4 || $_COOKIE['id_statut']==5){
		$query_code_moderer = $bdd->prepare("SELECT * FROM code inner join user on code.id_user = user.id_user inner join categorie_code on code.categorie_code = categorie_code.id_categorie_code  WHERE accept_code = 0 order by date_code DESC");
		$query_code_moderer->execute();
		$nb=$query_code_moderer->rowCount();
		?>
		<div class="container">
			<div class="row">
				<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<h2 class="modo">MODERATION</h2>
					<div class="clients-grid">
						<div class="row" data-layout="masonry">
							<?php if($nb!=0){
								foreach ($query_code_moderer as $key => $value) {?>
								<div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 col-xs-12 <?php echo($value['categorie_code']) ?>">
									<div class="ui-block">
										<article class="first-code hentry blog-post">
											<a class="opencode" target="_blank" href="code.php?id_code=<?php echo utf8_encode($value['id_code']);?>">
												<p class="post-category bg-blue-light"><?php echo utf8_encode($value['categorie_code']);?></p>
												<div class="post-content">
													<h4><?php echo utf8_encode($value['titre']);?></h4>
													<p><?php echo utf8_encode($value['description']);?></p>

													<div class="author-date">
														<p class="h6 post__author-name fn"><?php echo utf8_encode($value['prenom']);?> <?php echo utf8_encode($value['nom']);?></p>
														<div class="post__date">
															<time class="published">
																<?php echo time_elapsed_string($value['date_code']);?>
															</time>
														</div>
													</div>
												</div>
												<input class="id_code" type="hidden" value="<?php echo utf8_encode($value['id_code']);?>">
											</a>
										</article>
										<a class="moderation_code deny_code">Refuser</a>
										<a class="moderation_code accept_code">Accepter</a>
									</div>
								</div>
								<?php }
							}else{	?>
							<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<p>Aucune code à modérer pour le moment</p>
							</div>
							<?php }
							?>
						</div>
					</div>
				</div>
			</div>
		</div>

		<?php
	}
	?>


	<!-- Code Editors -->
	<div class="container explore">
		<div class="row">
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="ui-block">
					<div class="ui-block-title">
						<h6 class="title">Historique des codes partagés</h6> 
						<div class="form-group label-floating is-empty">
							<label class="control-label">Recherche</label>
							<input class="form-control search" placeholder="" value="" type="text">
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 np">
				<div class="clients-grid">
					<ul class="cat-list-bg-style align-center sorting-menu">
						<li class="cat-list__item active" data-filter="*"><a href="#" class="">Toutes les catégories</a></li>
						<li class="cat-list__item" data-filter=".CSS"><a href="#" class="">CSS</a></li>
						<li class="cat-list__item" data-filter=".JS"><a href="#" class="">JS</a></li>
						<?php if($_COOKIE['id_statut']!=3) {?><li class="cat-list__item active create_code"><a href="code.php">Créer son code</a></li> <?php } ?>
					</ul>
					<div class="row sorting-container"  id="wrapper_code" data-layout="masonry">
						<?php foreach ($query_code as $key => $value) {?>
						<div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 col-xs-12 sorting-item <?php echo($value['categorie_code']) ?>">
							<div class="ui-block">
								<article class="first-code hentry blog-post">
									<a class="opencode" target="_blank" href="code.php?id_code=<?php echo utf8_encode($value['id_code']);?>">
										<p class="post-category bg-blue-light"><?php echo utf8_encode($value['categorie_code']);?></p>
										<div class="post-content">
											<h4><?php echo utf8_encode($value['titre']);?></h4>
											<pre class="break"><p><?php echo utf8_encode($value['description']);?></p></pre>
											<div class="author-date">
												<p class="h6 post__author-name fn"><?php echo utf8_encode($value['prenom']);?> <?php echo utf8_encode($value['nom']);?></p>
												<div class="post__date">
													<time class="published">
														<?php echo time_elapsed_string($value['date_code']);?>
													</time>
												</div>
											</div>
										</div>
										<input class="id_code" type="hidden" value="<?php echo utf8_encode($value['id_code']);?>">
									</a>
								</article>
							</div>

						</div>
						<?php }?>
					</div>
				</div>
			</div>
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
<script src="../js/alterclass.js"></script>
<!-- Select / Sorting script -->
<script src="../js/selectize.min.js"></script>

<!-- Swiper / Sliders -->
<script src="../js/swiper.jquery.min.js"></script>

<script src="../js/isotope.pkgd.min.js"></script>

<script src="../js/mediaelement-and-player.min.js"></script>
<script src="../js/mediaelement-playlist-plugin.min.js"></script>

<script src="../js/mediaelement-and-player.min.js"></script>
<script src="../js/mediaelement-playlist-plugin.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.9.1/sweetalert2.min.js"></script>
<script src="../js/pages/explore.js"></script>

<script src="../js/charte.js"></script>
<?php 
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