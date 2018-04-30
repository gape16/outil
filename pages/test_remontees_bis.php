<?php

// Connexion à la base de donnée et insertion de session_start
include('../connexion_session.php');

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

if (isset($_SESSION['id_statut'])) {

	$id_graph=$_SESSION['id_graph'];
		// si c'est un graph qui se connect

	$requet = $bdd->prepare("UPDATE notifications_remontees SET active = 0 where id_user = ?");
	$requet->bindParam(1, $id_graph);
	$requet->execute();

	$requet_j = $bdd->prepare("UPDATE commentaires_remontees SET notif_com = 0 where id_user = ?");
	$requet_j->bindParam(1, $id_graph);
	$requet_j->execute();

	$requet_msg_notif = $bdd->prepare("UPDATE remontees SET notif_user = 0 where id_user = ?");
	$requet_msg_notif->bindParam(1, $id_graph);
	$requet_msg_notif->execute();


	$requete=$bdd->prepare("SELECT * FROM user where id_user = ?");
	$requete->bindParam(1, $id_graph);
	$requete->execute();
	$result_user=$requete->fetch(PDO::FETCH_ASSOC);

	$selection_categorie_remontees = $bdd->prepare("SELECT * FROM categorie_remontees");
	$selection_categorie_remontees->execute();

	$selection_etat_remontees = $bdd->prepare("SELECT * FROM etat_remontees");
	$selection_etat_remontees->execute();

	$selection_categorie_remontees_second = $bdd->prepare("SELECT * FROM categorie_remontees");
	$selection_categorie_remontees_second->execute();

	$query_select_remontees = $bdd->prepare("SELECT * FROM remontees left join user on user.id_user = remontees.id_user left join categorie_remontees on remontees.id_categorie_remontees = categorie_remontees.id_categorie_remontees left join etat_remontees on remontees.accept_remontees = etat_remontees.id_etat_remontees order by date_remontees DESC");
	$query_select_remontees->execute();
	
	?>

	<!DOCTYPE html>
	<html lang="fr" id="remontees">
	<head>

		<title>Les remontées</title>

		<!-- Required meta tags always come first -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="x-ua-compatible" content="ie=edge">

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" type="text/css" href="../css/bootstrap-reboot.css">
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="../css/bootstrap-grid.css">

		<!-- Theme Styles CSS -->
		<link rel="stylesheet" type="text/css" href="../css/theme-styles.css">
		<link rel="stylesheet" type="text/css" href="../css/blocks.css">
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.9.1/sweetalert2.css">

		<link rel="icon" type="image/png" href="../img/favicon.png" />

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
		<style type="text/css">
		.ui-block-title > * {
			margin-bottom: 0;
			display: block !important;
			vertical-align: middle;
			margin: auto;
			text-align:center;
		}
		article p.h6.post__author-name.fn {
			margin-top: 0;
		}
		.titre:first-letter{
			text-transform: uppercase;
		}
		.row .refuser_remontees, .row .refuser_remontees:hover, .row .refuser, .row .refuser:hover{
			background: tomato;
		}
		.row .traitement_remontees, .row .traitement_remontees:hover, .row .traitement, .row .traitement:hover{
			background: #9a9fbf;
		}
		.row .accepter_remontees,  .row .accepter_remontees:hover, .row .accepter, .row .accepter:hover{
			background: #1ed760;
		}
		.row .pending_remontees:hover, .post .kats:hover{
			background: #9a9fbf;
		}
		.kats-btn .kats:hover{
			margin-bottom: 0;
		}
		.chat{
			border-top: 1px solid #e6ecf5;
			padding-top: 15px !important;
			cursor: pointer;
			display: flex;
			flex-direction: column;
		}
		.comments_wrapper{
			display: none;
		}
		textarea{
			width: 100%;
		}
		a.kats {
			background: tomato;
			padding: 10px;
			display: inline-block;
			margin-bottom: 10px;
			color: white !important;
			border-radius: 3px;
		}
		.hentry .kats {
			line-height: 14px;
		}
		.pt{
			padding: 0;
			padding-top: 25px;
		}
		.mb20{
			margin-bottom: 20px;
		}
		.post-additional-info .comments-shared {
			float: right;
			margin-top: 8px;
			border-bottom: 1px solid #e6ecf5;
			padding-bottom: 20px;
			margin-right: 0;
		}
		a.post-add-icon.inline-items {
			float: right;
		}
		.post{
			padding: 0;
		}
		.post__author img {
			float: left;
		}
		.wrapper_content {
			margin-top: 55px;
			min-height: 90px;
		}
		.post__author.author.vcard.inline-items, .wrapper_content p {
			margin-bottom: 0;
		}
		.wrapper {
			width: 100%;
			padding: 25px;
		}
		form.comment-form.inline-items.pt {
			padding: 25px 0;
		}
		.post-additional-info.inline-items.chat {
			padding: 0 25px;
			background: #f0f2f533;
		}
		li.liste_com {
			display: flex;
			flex-direction: column;
		}
		li.liste_com p{
			margin: 20px 0;
		}
		li.liste_com p:first-letter {
			text-transform: uppercase;
		}
		.author-date{
			float: left;
		}
		a.show_kats {
			margin-left: 25px;
			background: tomato;
			padding: 10px;
			position: relative;
			top: 10px;
			color: white;
			border-radius: 3px;
		}
		h4.title {
			margin-left: 0;
			margin-bottom: 20px;
			min-height: auto;
		}
		.wrapper_content {
			margin-top: 55px;
		}
		img.img_remontees {
			width: 100%;
			height: auto;
			border-radius: inherit;
			margin: 20px 0;
		}
		.post .kats-btn {
			top: 60px;
		}
		.post-additional-info .comments-shared {
			margin-top: 28px;
		}
		.ui-block.remontees {
			width: calc(50% - 40px);
			margin-right: 40px !important;
		}
		.cat-list__item {
			cursor: pointer;
		}
		.cat-list__item:hover{
			color: white !important;
		}
		p.ref {
			text-align: right;
			font-style: italic;
			font-size: .7rem;
			margin: 10px 0;
		}
		.grid{
			width: 100%;
		}
		.sorting-item a.post-add-icon.inline-items {
			position: relative;
			bottom: 10px;
			right: 40px;
		}
		.etat a{
			color: white !important;
		}
		.etat a:hover {
			background: inherit;
		}
		article.hentry.post.video.no-padd{
			background-color: white;
		}
		.sorting-item{
			margin-bottom: 25px;	
		}
		.container .row {
			margin-right: 0;
			margin-left: 0;
		}
		input.form-control.search {
			background: white;
			border: 1px solid #dee4ec;
		}
		.wrapper_content .row {
			margin-top: 25px;
		}
		.hax_btn > div{
			padding: 	0;
		}
		.hax_btn > div .btn {
			margin-bottom: 0;
		}
		.row.hax_btn {
			margin-top: 20px;
			display: flex;
			justify-content: flex-end;
		}
		.hax_btn .btn-lg {
			padding: 9px;
		}
		.go_search {
			position: absolute;
			right: 0;
			height: 100%;
			width: 50px;
			padding: 15px 10px 10px 10px;
			cursor: pointer;
		}
		.hax_btn .btn {
			width: 40px;
			height: 40px;
			margin-bottom: 0;
			cursor: pointer;
		}
		.hax_btn .btn-icon-left i {
			margin-right: 0;
		}
		[class^="olymp-delete"], [class^="olymp-valider"] {
			height: 20px;
			width: 20px;
			display: inline-block;
		}
		.btn-tomato{
			background-color: tomato; 
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
			<div class="content-bg bg-music"></div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 col-md-8 offset-md-2 col-sm-12 col-xs-12">
					<div class="main-header-content">
						<h1>Ensemble améliorons nos outils</h1>
						<p>Faîtes nous remonter vos bugs et demandes d’évolutions</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Main Content Groups -->

	<div class="container">
		<div class="row">
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="ui-block">
					<div class="ui-block-title">
						<h6 class="title">Remontées</h6>
					</div>
					<div class="ui-block-content">
						<form class="form-group label-floating is-empty help">
							<div class="form-group is-empty label-floating">
								<select name="" id="" class="categorie">
									<option value="0">Choisir une catégorie</option>
									<?php foreach ($selection_categorie_remontees as $key => $value) {?>
									<option value="<?php echo($value['id_categorie_remontees']) ?>"><?php echo utf8_encode(($value['categorie_remontees'])) ?></option>
									<?php }
									?>
								</select>
							</div>
							<div class="form-group is-empty label-floating">
								<label class="control-label">Titre</label>
								<input class="form-control titre" placeholder="" value="" type="text">
								<span class="material-input"></span>
							</div>
						</form>
						<div class="form-group label-floating is-empty">
							<label class="control-label">Description</label>
							<textarea name="description" id="description" cols="30" rows="10"></textarea>
						</div>
						<div class="form-group label-floating is-empty">
							<form class="upload_veille">
								<input type="file" id="file-select" name="photos" required="required">
							</form>
						</div>
						<div class="row">
							<div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<a href="#" class="btn btn-secondary btn-lg full-width reni" data-toggle="modal" data-target="#faqs-popup">Renitialiser</a>
							</div>
							<div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<a href="#" class="btn btn-green btn-lg full-width btn-icon-left valider_remontee"><i class="fa fa-paper-plane-o" aria-hidden="true"></i>
								Remonter le problème</a>
							</div>
						</div>
					</div>
				</div>

			</div>

		</div>
	</div>
	<!-- ... end Main Content Groups -->
	<div class="container">
		<div class="row">


			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<ul class="cat-list-bg-style align-center sorting-menu etat">
					<li class="cat-list__item active" data-filter="*"><a href="#" class="">Toutes les catégories</a></li>
					<?php foreach ($selection_etat_remontees as $key => $value) { ?>
					<li class="cat-list__item btn-state_<?php echo($value['id_etat_remontees']) ?>" data-filter=".etat_<?php echo($value['id_etat_remontees']) ?>" style="background-color:<?php echo $value['couleur'] ?>"><a class=""><?php echo utf8_encode($value['etat_remontees']) ?></a></li>
					<?php } ?>
				</ul>
				<ul class="cat-list-bg-style align-center sorting-menu">
					<li class="cat-list__item active" data-filter="*"><a href="#" class="">Toutes les catégories</a></li>
					<?php foreach ($selection_categorie_remontees_second as $key => $value) { ?>
					<li class="cat-list__item btn-cate_<?php echo($value['id_categorie_remontees']) ?>" data-filter=".cat_<?php echo($value['id_categorie_remontees']) ?>"><a class=""><?php echo utf8_encode($value['categorie_remontees']) ?></a></li>
					<?php } ?>
				</ul>

				<div class="form-group is-empty label-floating">
					<label class="control-label">Recherche</label>
					<div class="go_search">
						<svg class="olymp-magnifying-glass-icon" style="fill: #dee4ec">
							<use xlink:href="../icons/icons.svg#olymp-magnifying-glass-icon"></use>
						</svg>
					</div>
					<input class="form-control search" placeholder="" value="" type="text">
				</div>
			</div>
		</div>

		<div class="row sorting-container grid" data-layout="masonry">
			<?php foreach ($query_select_remontees as $key => $value) {
				$id_remontees=$value['id_remontees'];
				$query_get_number = $bdd->prepare("SELECT * FROM commentaires_remontees WHERE id_remontees = ?");
				$query_get_number->bindParam(1, $id_remontees);
				$query_get_number->execute();
				$result = $query_get_number->rowCount();
				?>
				<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12 grid-item sorting-item cat_<?php echo($value['id_categorie_remontees']) ?>  etat_<?php echo($value['id_etat_remontees']) ?>">
					<!-- Post -->
					<article class="hentry post video no-padd" data-id="<?php echo $value['id_remontees'] ?>">
						<div class="post__author author vcard inline-items">
							<div class="wrapper">
								<img src="../<?php echo utf8_encode($value['photo_avatar']);?>" alt="author">
								<div class="author-date">
									<p class="h6 post__author-name fn"><?php echo utf8_encode($value['nom'].' '.$value['prenom']);?></p>
									<div class="post__date">
										<time class="published">
											<?php echo time_elapsed_string($value['date_remontees']);?>
										</time>
									</div>
								</div>
								<?php if ($_SESSION['id_statut'] == 4 || $_SESSION['id_statut'] == 5 && empty($value['kats'])) { ?>
								<a href="" class="show_kats" data-toggle="modal" data-target="#kats">AJOUTER KATS</a>
								<?php } ?>


								<?php 	if ($id_graph == $value['id_user'] || $_SESSION['id_statut'] == 4 || $_SESSION['id_statut'] == 5) {?>
								<div class="more">
									<svg class="olymp-three-dots-icon">
										<use xlink:href="../icons/icons.svg#olymp-three-dots-icon"></use>
									</svg>
									<ul class="more-dropdown">
										<li>
											<a class="edit_remontees">Modifier le ticket</a>
										</li>
										<li>
											<a class="delete_remontees">Supprimer le ticket</a>
										</li>
									</ul>
								</div>
								<?php } ?>

								<div class="wrapper_content" contenteditable="false">
									<?php if (!empty($value['file'])) { ?>
									<a data-fancybox="gallery" href="../uploads/remontees/<?php echo utf8_decode($value['file']);?>"><img class="img_remontees" src="../uploads/remontees/<?php echo utf8_decode($value['file']);?>"></a>
									<?php } ?>
									<h4 class="titre"><?php echo utf8_encode($value['titre']);?></h4>
									<p><?php echo htmlentities(utf8_encode($value['description']));?></p>
								</div>
								<p class="ref">Réference : <?php echo utf8_encode($value['ref']);?></p>
							</div>
							<div class="post-additional-info inline-items chat">
								<div class="comments-shared">
									<a class="post-add-icon inline-items">
										<svg class="olymp-speech-balloon-icon">
											<use xlink:href="../icons/icons.svg#olymp-speech-balloon-icon"></use>
										</svg>
										<span><?php echo $result; ?></span>
									</a>
								</div>
								<div class="comments_wrapper">
									<ul>
									</ul>
									<form class="comment-form inline-items pt">
										<div class="post__author author vcard inline-items">
											<img src="../<?php echo utf8_encode($result_user['photo_avatar']);?>" alt="author">
											<div class="form-group with-icon-right ">
												<textarea class="form-control commentaires" ></textarea>
												<div class="add-options-message ajout_com_remontees>">
													<a class="options-message">
														<svg class="olymp-chat---messages-icon"><use xlink:href="../icons/icons.svg#olymp-chat---messages-icon"></use></svg>
													</a>
												</div>
											</div>
										</div>
									</form>								
								</div>
							</div>
							<input type="hidden" class="id_remontees" value="<?php echo $value['id_remontees'] ?>">
							<input type="hidden" class="etat" value="<?php echo $value['accept_remontees'] ?>">
							<?php if ($_SESSION['id_statut'] == 4 || $_SESSION['id_statut'] == 5) { ?>
							<div class="control-block-button post-control-button">
								<a href="#" class="btn btn-control refuser_remontees" data-toggle="tooltip" data-placement="right" data-original-title="Refuser remontées">
									<svg class="olymp-like-post-icon">
										<use xlink:href="../icons/icons.svg#olymp-close-icon"></use>
									</svg>
								</a>
								<a href="#" class="btn btn-control traitement_remontees" data-toggle="tooltip" data-placement="right" data-original-title="Traitement remontées">
									<svg class="olymp-comments-post-icon">
										<use xlink:href="../icons/icons.svg#olymp-three-dots-icon"></use>
									</svg>
								</a>
								<a href="#" class="btn btn-control accepter_remontees" data-toggle="tooltip" data-placement="right" data-original-title="Accepeter remontées">
									<svg class="olymp-share-icon">
										<use xlink:href="../icons/icons.svg#olymp-check-icon"></use>
									</svg>
								</a>
								<?php if (!empty($value['kats'])) { ?>
								<a href="<?php echo utf8_encode($value['kats']);?>" class="btn btn-control kats"  data-toggle="tooltip" data-placement="right" data-original-title="Kats">
									K
								</a>
								<?php } ?>
							</div>
							<?php }else {
								if($value['id_etat_remontees'] == 1){ ?>
								<div class="control-block-button post-control-button">
									<a href="#" class="btn btn-control pending_remontees" data-toggle="tooltip" data-placement="right" data-original-title="Remontée en attente">
										<svg class="olymp-like-post-icon">
											<use xlink:href="../icons/icons.svg#olymp-popup-right-arrow"></use>
										</svg>
									</a>
								</div>
								<?php }else if ($value['id_etat_remontees'] == 2) { ?>
								<div class="control-block-button post-control-button">
									<a href="#" class="btn btn-control refuser"  data-toggle="tooltip" data-placement="right" data-original-title="Remontée refusée">
										<svg class="olymp-like-post-icon">
											<use xlink:href="../icons/icons.svg#olymp-close-icon"></use>
										</svg>
									</a>
								</div>
								<?php	}else if($value['id_etat_remontees'] == 3){?>
								<div class="control-block-button post-control-button">
									<a href="#" class="btn btn-control traitement"  data-toggle="tooltip" data-placement="right" data-original-title="Remontées en cours de traitement">
										<svg class="olymp-comments-post-icon">
											<use xlink:href="../icons/icons.svg#olymp-three-dots-icon"></use>
										</svg>
									</a>
								</div>
								<?php }else{ ?>
								<div class="control-block-button post-control-button">
									<a href="#" class="btn btn-control accepter"  data-toggle="tooltip" data-placement="right" data-original-title="Remontée traitée">
										<svg class="olymp-share-icon">
											<use xlink:href="../icons/icons.svg#olymp-check-icon"></use>
										</svg>
									</a>
								</div>
								<?php } if (!empty($value['kats'])) { ?>
								<div class="control-block-button post-control-button kats-btn">
									<a href="<?php echo utf8_encode($value['kats']);?>" class="btn btn-control kats"  data-toggle="tooltip" data-placement="right" data-original-title="Lien du KATS">
										K
									</a>
								</div>
								<?php }} ?>
							</article>
							<!-- .. end Post -->
						</div>
						<?php } ?>
					</div>
				</div>

				<div class="modal fade show" id="kats">
					<div class="modal-dialog ui-block window-popup create-event">
						<a href="#" class="close icon-close" data-dismiss="modal" aria-label="Close">
							<svg class="olymp-close-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="../icons/icons.svg#olymp-close-icon"></use></svg>
						</a>

						<div class="ui-block-title">
							<h4 class="title">Insérer un lien KATS</h4>
							<input type="text" class="kats">
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
				<script src="../js/jquery.fancybox.min.js"></script>

				<link rel="stylesheet" type="text/css" href="../css/bootstrap-select.css">


				<script src="../js/mediaelement-and-player.min.js"></script>
				<script src="../js/mediaelement-playlist-plugin.min.js"></script>
				<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.9.1/sweetalert2.min.js"></script>
				<script src="../js/simpleUpload.min.js"></script>
				<script src="../js/masonry.pkgd.js"></script>
				<script src="https://unpkg.com/imagesloaded@4/imagesloaded.pkgd.js"></script>
				<script src="../js/isotope.pkgd.min.js"></script>				
				<script src="../js/js.cookie.js"></script>
				<!-- <script src="../js/pages/remontees.js"></script> -->
				<script src="../js/charte.js"></script>
				<?php 
				if(isset($_COOKIE['event'])) { 
					if($_COOKIE['event']==1){
						include("../includes/popup_event.php");
					}
				}
				if($_SESSION['id_statut']==1) {
						//page graphistes 
					?><script src="../js/notifications.js"></script><?php
				}elseif  ($_SESSION['id_statut']==2){
						//page  redacteurs
					?><script src="../js/notifications.js"></script><?php
				}
				elseif ($_SESSION['id_statut']==3) {
						//page leader
					?><script src="../js/notifications.js"></script><?php
				}elseif ($_SESSION['id_statut']==4) {
						//page controleur
					?><script src="../js/notifications_controleur.js"></script><?php
				}elseif($_SESSION['id_statut']==5){
						//page admin
					?><script src="../js/notifications_admin.js"></script><?php
				}
				?> 

				<script>
// init Masonry
var $grid = $('.grid').isotope({
	itemSelector: '.grid-item',
	stagger: 30
});
// layout Masonry after each image loads
$grid.imagesLoaded().progress( function() {
	$grid.masonry('layout');
});

function makeid() {
	var text = "";
	var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

	for (var i = 0; i < 5; i++)
		text += possible.charAt(Math.floor(Math.random() * possible.length));
	return text;
}


var maxCategorie = $('.etat li').length-1 ;

$('[class*="btn-state_"]').on('click', function(e){
	e.preventDefault();
	e.stopPropagation();
	var check="btn-state_";
	var cls = $(this).attr('class').split(' ');
	console.log(cls);
	for (var i = 0; i < cls.length; i++) {
		if (cls[i].indexOf(check) > -1) {
			var id_emet = cls[i].slice(check.length, cls[i].length);
		}
	}
	var filterValue = $(this).attr('data-filter');
	$grid.isotope({ filter: filterValue });
	// remove clicked element
	// $('[class*=etat_]').hide();
	// $('.etat_'+ id_emet).show();
	// $('.grid').masonry( 'reload' );
	// $('.grid').masonry( 'layout' );
})



$('.wrapper_content').keyup(function(){
	$('.grid').masonry();
})

$('textarea.form-control.commentaires').on('click', function(){
	$('.grid').masonry();
})

$('.grid-item').each(function(){
	if ($(this).find('.form-group.with-icon-right').hasClass('is-focused')) {
		$(this).next().trigger('click');
		$('.grid').masonry();
	}else{
		$('.grid').masonry();
	}
})


$('.comments-shared').on('click', function(){
	$(this).parent().parent().find('.comments_wrapper').toggle();
	var id_remontees = $(this).parents('.video').find('.id_remontees').val();
	$(this).toggleClass('mb20');
	$(this).find('.kats').toggleClass('show');
	$.ajax({
		url: '../formulaire.php',
		type: 'POST',
		context: this,
		data: {search_com: id_remontees},
	})
	.done(function(data) {
		console.log(data);
		$(this).parents('.chat').find('.comments_wrapper ul').html(' ');
		$(this).parents('.chat').find('.comments_wrapper ul').append(data);
		$(this).parents('.form-group').find('textarea.form-control.commentaires').val('');
		$('.grid').masonry();
	})
})

$('svg.olymp-chat---messages-icon').on('click', function(){
	var commentaires = $(this).parents('.form-group').find('textarea.form-control.commentaires').val();
	var id_remontees = $(this).parents('.video').find('.id_remontees').val();
	$.ajax({
		url: '../formulaire.php',
		type: 'POST',
		context: this,
		data: {id_remontees_ajout_com: id_remontees, commentaires: commentaires},
	})
	.done(function(data) {
		$(this).parents('.chat').find('.comments_wrapper ul').append(data);
		$(this).parents('.form-group').find('textarea.form-control.commentaires').val('');
		$('.grid').masonry();
	})
})




$('.delete_remontees').on('click', function(){
	var id = $(this).parents('.hentry').attr('data-id');
	$.ajax({
		url: '../../formulaire.php',
		type: 'POST',
		data: {delete_remontees: id},
	})
	.done(function(data) {
		swal(
			'Remontée supprimée',
			'Votre remontée est supprimée',
			'success'
			).then(function(){
				location.reload();
			})		
		})
})

$('.edit_remontees').on('click', function(){
	$(this).parents('.hentry').find('.wrapper_content').attr('contentEditable', 'true').get(0).focus();
	var btn = '<div class="row hax_btn"><a class="btn btn-secondary btn-tomato btn-lg full-width cancel"><svg class="olymp-delete" style="fill: #dee4ec"><use xlink:href="../icons/icons.svg#olymp-little-delete"></use></svg></a><a class="btn btn-green btn-lg full-width btn-icon-left valider_edit_remontee"><svg class="olymp-valider" style="fill: #dee4ec"><use xlink:href="../icons/icons.svg#olymp-check-icon"></use></svg></a></div>';
	$(this).parents('.hentry').find('.wrapper_content').css('padding', '10px');
	$(this).parents('.hentry').find('.wrapper_content').after(btn);
	$('.grid').masonry();	
})

$('body').on('click', '.valider_edit_remontee', function(){
	var id = $(this).parents('.hentry').attr('data-id');
	var titre = $(this).parents('.hentry').find('.wrapper_content .titre').html();
	var text = $(this).parents('.hentry').find('.wrapper_content p').html();
	$.ajax({
		url: '../../formulaire.php',
		type: 'POST',
		data: {edit_remontees: id, titre: titre, text: text},
	})
	.done(function(data) {
		swal(
			'Remontée modifiée',
			'success'
			).then(function(){
				location.reload();
			})		
		})
});

$('body').on('click', '.cancel', function(){
	$(this).parents('.hentry').find('.wrapper_content').attr('contentEditable', 'false');
	$('.hax_btn').remove();
});

$('.valider_remontee').on('click', function(){
	var categorie = $('select.categorie').val();
	var titre = $('.titre').val();
	var description = $('#description').val();
	var file = $("#file-select").prop("files");
	var names = $.map(file, function (val) { return val.name; });
	var token = makeid();
	Cookies.set('token', token);

	if (categorie != 0) {
		$('.categorie').removeClass('empty');
		if (titre.length >= 5) {
			$('.titre').removeClass('empty');
			if (description.length >= 30) {
				$('#description').removeClass('empty');
				$.ajax({
					url: '../../formulaire.php',
					type: 'POST',
					data: {categorie_remontees: categorie, titre_remontees: titre, description_remontees: description, file: names, token: token},
				})
				.done(function(data) {
					swal(
						'Remontée effectuée',
						'Votre remontée sera étudiée sous peu',
						'success'
						).then(function(){
							location.reload();
						})		
					})
				$('#file-select').simpleUpload("../../uploads/upload_remontees.php", {

					start: function(file){
						//upload started
					},
					progress: function(progress){
						//received progress
					},
					success: function(data){
						console.log("upload successful!");
						console.log(data);
					},
					error: function(error){
						//upload failed
					}
				});
			}else{
				$('#description').addClass('empty');
				$('#description').prev().html('30 caractères minimum requis');
			}
		}else{
			$('.titre').addClass('empty');
			$('.titre').prev().html('5 caractères minimum requis');
		}
	}else{
		$('.categorie').addClass('empty');
		$('.categorie').prev().html('Une catégorie est requise');
	}
})

$('.reni').on('click', function(){
	$('select.categorie').val(0);
	$('.titre').val('');
	$('#description').val('');
})

$('.go_search').on('click', function(){
	var search = $('input.search').val();
	// $('.grid').masonry();
	if(search.length >= 3){
		$.ajax({
			url: '../../formulaire.php',
			type: 'POST',
			data: {remontees_search: search},
		})
		.done(function(data) {
			var $data = $(data);
			$('.grid').html('');
			$('.grid').append( $data )
			$('.grid').masonry( 'reloadItems' );
			$('.grid').masonry( 'layout' );
		})
	}else{
		$.ajax({
			url: '../../formulaire.php',
			type: 'POST',
			data: {remontees_search_empty: search},
		})
		.done(function(data) {
			var $data = $(data);
			$('.grid').html('');
			$('.grid').append( $data )
			$('.grid').masonry( 'reloadItems' );
			$('.grid').masonry( 'layout' );
		})
	}
});

$(".commentaires").keypress(function(e) {
	if(e.which == 13) {
		$(this).parent().find("svg.olymp-chat---messages-icon").trigger( "click" );
	}
});

$('.search').keypress(function(e) {
	if(e.which == 13) {
		$(".go_search").trigger( "click" );
	}
});

$('.sorting-item').each(function(){
	var etat = $(this).find('.etat').val();

	if (etat == 1) {
		$(this).find('.refuser_remontees').css('opacity', '0.2');
		$(this).find('.traitement_remontees').css('opacity', '0.2');
		$(this).find('.accepter_remontees').css('opacity', '0.2');
	}
	if (etat == 2) {
		$(this).find('.refuser_remontees').css('opacity', '1');
		$(this).find('.traitement_remontees').css('opacity', '0.2');
		$(this).find('.accepter_remontees').css('opacity', '0.2');
	}
	if (etat == 3) {
		$(this).find('.refuser_remontees').css('opacity', '0.2');
		$(this).find('.traitement_remontees').css('opacity', '1');
		$(this).find('.accepter_remontees').css('opacity', '0.2');
	}
	if (etat == 4) {
		$(this).find('.refuser_remontees').css('opacity', '0.2');
		$(this).find('.traitement_remontees').css('opacity', '0.2');
		$(this).find('.accepter_remontees').css('opacity', '1');
	}
})


$('.accepter_remontees').on('click', function(){
	var id_remontees = $(this).parents('.video').find('.id_remontees').val();
	var kats =  $('input.kats').val();
	$.ajax({
		url: '../../formulaire.php',
		type: 'POST',
		data: {id_remontees_accept: id_remontees, kats: kats},
	})
	.done(function(data) {
		swal(
			'Le graph est notifié',
			'success'
			).then(function(){
				location.reload();
			})
		})
})

$('.refuser_remontees').on('click', function(){
	var id_remontees = $(this).parents('.video').find('.id_remontees').val();
	var kats =  $('input.kats').val();
	$.ajax({
		url: '../../formulaire.php',
		type: 'POST',
		data: {id_remontees_refus: id_remontees, kats: kats},
	})
	.done(function(data) {
		swal(
			'Remontée refusée',
			'Le graph est notifié',
			'error'
			).then(function(){
				location.reload();
			})
		})
})

$('.traitement_remontees').on('click', function(){
	var id_remontees = $(this).parents('.video').find('.id_remontees').val();
	var kats =  $('input.kats').val();
	$.ajax({
		url: '../../formulaire.php',
		type: 'POST',
		data: {id_remontees_traitement: id_remontees, kats: kats},
	})
	.done(function(data) {
		swal(
			'Remontée en traitement',
			'La remontée est en cours de traitement',
			'success'
			).then(function(){
				location.reload();
			})
		})
})
</script>
</body>
</html>
<?php

}else{
	header('Location: ../login.php');
}
?>