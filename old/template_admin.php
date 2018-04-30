<?php

// Connexion à la base de donnée et insertion de session_start
include('connexion_session.php');

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
	if ($_SESSION['id_statut'] == 4 || $_SESSION['id_statut'] == 5) {
		$query_select_template = $bdd->prepare("SELECT * FROM template left join user on template.id_user=user.id_user left join categorie_template on template.categorie=categorie_template.id_categorie_template WHERE accept_template = 0 order by date_template DESC");
		$query_select_template->execute();
		?>

		<!DOCTYPE html>
		<html lang="fr" id="temp">
		<head>

			<title>Les templates</title>

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
			<link rel="stylesheet" type="text/css" href="css/jquery.fancybox.min.css">

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
			
		</style>
	</head>

	<body>

		<?php 
		if($_SESSION['id_statut']==1) {
			//page graphistes 
			include('left_sidebar.php');
			include('header.php');
		}elseif  ($_SESSION['id_statut']==2){
			//page  redacteurs
			include('left_sidebar_redac.php');
			include('header_redac.php');
		}
		elseif ($_SESSION['id_statut']==3) {
			//page leader
			include('left_sidebar_leader.php');
			include('header_leader.php');
		}elseif ($_SESSION['id_statut']==4) {
			//page controleur
			include('left_sidebar_controleur.php');
			include('header_controleur.php');
		}elseif($_SESSION['id_statut']==5){
			//page admin
			include('left_sidebar_admin.php');
			include('header_admin.php');
		}
		?>


		<!-- Responsive Header -->

		<?php include('responsive_header.php');?>

		<!-- ... end Responsive Header -->



		<div class="header-spacer header-spacer-small"></div>


		<div class="main-header">
			<div class="content-bg-wrap">
				<div class="content-bg bg-music"></div>
			</div>
			<div class="container">
				<div class="row">
					<div class="col-lg-8 offset-lg-2 col-md-8 offset-md-2 col-sm-12 col-xs-12">
						<div class="main-header-content">
							<h1>Partagez ici vos templates de slider ou de page</h1>
							<p>C'est ici que vous allez pouvoir partager vos templates de slider ou de page</p>
						</div>
					</div>
				</div>
			</div>

			<img class="img-bottom" src="img/music-bottom.png" alt="friends">
		</div>

		<div class="container">
			<div class="row">
				<div class="ui-block-title custom">
					<h6 class="title">Templates à modérer</h6>
				</div>
				<?php foreach ($query_select_template as $key => $value): ?>	
					<div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 col-xs-12 sorting-item <?php echo $value['categorie_template'];?>">
						<div class="ui-block bloc_template">
							<article class="hentry blog-post">
								<a data-toggle="modal" data-target="#template">
									<img src="uploads/template/previsualisation/<?php echo utf8_encode($value['previsualisation']);?>" alt="">
									<div class="post-content">
										<div class="hacks-relative">	
											<p class="post-category bg-blue-light"><?php echo utf8_encode($value['categorie_template']);?></p>
											<h4><?php echo utf8_encode($value['titre']);?></h4>
											<div class="author-date">
												<p class="h6 post__author-name fn"><?php echo utf8_encode($value['nom']);?></p>
												<div class="post__date">
													<time class="published">
														<?php echo time_elapsed_string($value['date_template']);?>
													</time>
												</div>
											</div>
										</div>
									</div>
									<input type="hidden" class="id_template" value="<?php echo utf8_encode($value['id_template']);?>">
									<input type="hidden" class="titre" value="<?php echo utf8_encode($value['titre']);?>">
									<input type="hidden" class="nom" value="<?php echo utf8_encode($value['id_template']);?> <?php echo utf8_encode($value['prenom']);?>">
									<code><input type="hidden" class="shortcode" value='<?php echo utf8_encode($value['shortcode']);?>'></code>
									<input type="hidden" class="image" value="<?php echo utf8_encode($value['previsualisation']);?>">
									<input type="hidden" class="betheme" value="<?php echo utf8_encode($value['betheme']);?>">
									<input type="hidden" class="slider" value="<?php echo utf8_encode($value['slider']);?>">
								</a>
							</article>
						</div>
					</div>
				<?php endforeach ?>
			</div>
			<textarea id="tt"></textarea> 
		</div>


		<!-- Window-popup Event Private Public -->
		<div class="modal fade show" id="template">
			<div class="modal-dialog ui-block window-popup event-private-public private-event">
				<a href="#" class="close icon-close" data-dismiss="modal" aria-label="Close">
					<svg class="olymp-close-icon"><use xlink:href="icons/icons.svg#olymp-close-icon"></use></svg>
				</a>
				<article class="hentry post has-post-thumbnail thumb-full-width private-event">
					<div class="row">
						<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
							<div class="post__author author vcard inline-items">
								<img src="<?php echo $value['photo_avatar'];?>" alt="author">
								<div class="author"><?php echo utf8_encode($value['prenom']);?> <?php echo utf8_encode($value['nom']);?></div>
							</div>
							<h3 class="title"><?php echo utf8_encode($value['titre']);?></h3>
							<div id="shortcode_modal" class="shortcode">
								<code><?php echo utf8_encode($value['shortcode']);?></code>
							</div>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
							<div class="event-description">
								<h6 class="event-description-title">Fichiers pratique</h6><br>
								<a class="copy">Copier le shortcode</a>
								<?php if ($value['betheme']) {?>
								<a href="uploads/template/betheme/<?php echo $value['betheme'];?>" class="img_betheme" download>Fichier BeTheme</a><?php } ?>
								<?php if ($value['slider']) {?>
								<a href="uploads/template/slider/<?php echo $value['slider'];?>" class="slider-rev" download>Zip Slider</a><?php } ?>
								<?php if ($value['previsualisation']) {?>
								<a class="fancy-img" href="uploads/template/previsualisation/<?php echo utf8_encode($value['previsualisation']);?>" data-fancybox>
									<img src="uploads/template/previsualisation/<?php echo utf8_encode($value['previsualisation']);?>"/>
								</a>
								<?php } ?>
								<a class="btn btn-secondary btn-sm full-width ko_template">Refuser</a>
								<a class="btn btn-green btn-sm full-width ok_template">Valider</a>
							</div>
						</div>
					</div>
				</article>
				<input type="hidden" class="id_template" value="<?php echo $value['id_template'];?>">
			</div>
			<textarea id="tt" style="opacity:0;"></textarea> 
		</div>

		<!-- jQuery first, then Other JS. -->
		<script src="js/jquery-3.2.0.min.js"></script>
		<!-- Js effects for material design. + Tooltips -->
		<script src="js/material.min.js"></script>
		<!-- Helper scripts (Tabs, Equal height, Scrollbar, etc) -->
		<script src="js/theme-plugins.js"></script>
		<!-- Init functions -->
		<script src="js/main.js"></script>
		<script src="js/alterclass.js"></script>
		<!-- Select / Sorting script -->
		<script src="js/selectize.min.js"></script>
		<script src="js/jquery.fancybox.min.js"></script>

		<link rel="stylesheet" type="text/css" href="css/bootstrap-select.css">


		<script src="js/mediaelement-and-player.min.js"></script>
		<script src="js/mediaelement-playlist-plugin.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.9.1/sweetalert2.min.js"></script>
		<script src="js/simpleUpload.min.js"></script>
		<script src="js/charte.js"></script>
					<!-- <?php 
					if($_SESSION['id_statut']==1) {
						//page graphistes 
						?><script src="js/notifications.js"></script><?php
					}elseif  ($_SESSION['id_statut']==2){
						//page  redacteurs
						?><script src="js/notifications_redac.js"></script><?php
					}
					elseif ($_SESSION['id_statut']==3) {
						//page leader
						?><script src="js/notifications_leader.js"></script><?php
					}elseif ($_SESSION['id_statut']==4) {
						//page controleur
						?><script src="js/notifications_controleur.js"></script><?php
					}elseif($_SESSION['id_statut']==5){
						//page admin
						?><script src="js/notifications_admin.js"></script><?php
					}
					?> -->

					<script>
						$(function(){
							$("[data-fancybox]").fancybox({
								// Options will go here
							});

							$('.ok_template').on('click', function(){
								var id_template = $(this).parents('#template').find('.id_template').val();
								console.log(id_template);
								$.ajax({
									url: 'formulaire.php',
									type: 'POST',
									data: {id_template: id_template},
								})
								.done(function() {
									swal(
										'Template accepté',
										).then(function(){
											location.reload();
										})
									})			
							})

							$('.ko_template').on('click', function(){
								var id_template = $('#template .id_template').val();
								console.log(id_template);
								$.ajax({
									url: 'formulaire.php',
									type: 'POST',
									data: {refus_template: '0', id_template: id_template},
								})
								.done(function() {
									swal(
										'Template refusé',
										).then(function(){
											location.reload();
										})
									})
							})

							$('.bloc_template').on('click', function(){
								var id_template = $(this).find('.id_template').val();
								var titre = $(this).find('.titre').val();
								var shortcode = $(this).find('.shortcode').val();
								var image = $(this).find('.image').val();
								var betheme = $(this).find('.betheme').val();
								var slider = $(this).find('.slider').val();
								console.log(shortcode);

								$('#template .title').html(titre);
								$('#template .shortcode code').html(shortcode);
								$('#tt').val(shortcode);
								$('#template a.img_betheme').attr('href', 'uploads/template/betheme/' + betheme);
								$('#template .fancy-img').attr('href', 'uploads/template/previsualisation/' + image);
								$('#template .fancy-img img').attr('src', 'uploads/template/previsualisation/' + image);
								$('#template .slider-rev').attr('href', 'uploads/template/slider/' + slider);

								$('.slider-rev').css('display', 'block');
								$('.img_betheme').css('display', 'block');
								$('.previsualisation').css('display', 'block');

								if (slider == 0) {
									$('.slider-rev').css('display', 'none');
								}
								if (betheme == 0) {
									$('.img_betheme').css('display', 'none');
								}
							})
							$("a.copy").on('click', function(){
								$('#tt').select();
								document.execCommand('copy');
							});
						})
					</script>
				</body>
				</html>
				<?php }else{
					header('Location: template.php');
				}
			}else{
				header('Location: login.php');
			}
			?>
