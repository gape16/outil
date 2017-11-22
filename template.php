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
	if ($_SESSION['id_statut'] == 1 || $_SESSION['id_statut'] == 2 || $_SESSION['id_statut'] == 3 || $_SESSION['id_statut'] == 4) {
		$query_select_template = $bdd->prepare("SELECT * FROM template left join user on template.id_user=user.id_user left join categorie_template on template.categorie=categorie_template.id_categorie_template WHERE accept_template = 1 order by date_template DESC");
		$query_select_template->execute();

		$query_select_template_categorie = $bdd->prepare("SELECT * FROM categorie_template");
		$query_select_template_categorie->execute();
		?>

		<!DOCTYPE html>
		<html lang="en">
		<head>

			<title>Partage de template</title>

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
			ul.cat-list-bg-style.align-center.sorting-menu {
				width: 100%;
			}
			div#template > div {
				width: 60vw;
				max-width: 60vw;
			}
			a.img_betheme, .copy, .slider-rev {
				display: block;
				color: white !important;
				background: #0094ea;
				text-align: center;
				padding: 10px;
				margin-bottom: 10px;
				border-radius: 5px;
			}
			.copy{
				background: tomato;
				cursor: pointer;
			}
			a.btn.btn-green.btn-sm.full-width.ok_template {
				color: white;
			}
			.ok_template, .ko_template {
				width: 48%;
				float: left;
				color: white !important;
				margin: 10px 1%;
			}
			article.hentry {
				cursor: pointer;
			}
			.hentry code {
				display: none;
			}
			#shortcode_modal code {
				display: block;
			}
			div#shortcode_modal code h1, div#shortcode_modal code h2 {
				font-size: inherit;
				color: inherit;
			}
			div#shortcode_modal code p {
				text-align: inherit !important;
				margin: inherit !important;
				font-size: inherit;
			}
			div#shortcode_modal code strong {
				font-weight: inherit !important;
			}
			#shortcode_modal code {
				display: block;
				max-height: 50vh;
				overflow-y: auto;
			}
			div#shortcode_modal code u {
				text-decoration: inherit;
			}
			.modal-dialog {
				margin: 200px auto 0;
			}
			.slider-rev {
				background: #9a9fbf;
			}
			.hide-input input{
				display: none;
			}
			#tt{
				opacity: 0;
			}
			img.trigger-input {
				display: block;
				margin: 0 auto;
				margin-bottom: 10px;
				width: 60px;
			}
			.hide-input p {
				text-align: center;
			}
			.hide-input a{
				color: inherit;
			}
			.wrapper-previsu, .wrapper-slider, .wrapper-betheme{
				display: none;
			}
			.form-group.label-floating.is-empty {
				display: block;
				margin: 20px auto;
			}
			p.file {
				font-style: italic;
				font-size: 0.8rem;
				font-weight: 100;
			}
			p.need {
				font-weight: 400;
			}
			.empty-p{
				color: tomato;
			}
			#prop-template .modal-dialog {
				max-width: 60vw;
			}
			.proposition .ui-block {
				width: 100%;
			}
			.proposition .col-xl-12.col-lg-12.col-md-12.col-sm-12.col-xs-12 {
				padding: 0;
			}
			.proposition .ui-block {
				margin-bottom: 0;
			}
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
			<ul class="cat-list-bg-style align-center sorting-menu">
				<li class="cat-list__item active" data-filter="*"><a href="#" class="">Toutes les catégories</a></li>
				<li class="cat-list__item" data-filter=".Slider"><a href="#" class="">Slider</a></li>
				<li class="cat-list__item" data-filter=".Contenu"><a href="#" class="">Page</a></li>
				<li class="cat-list__item" data-filter=".Footer"><a href="#" class="">Footer</a></li>
			</ul>
			<div class="row sorting-container" data-layout="masonry">
				<?php foreach ($query_select_template as $key => $value): ?>	
					<div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 col-xs-12 sorting-item <?php echo $value['categorie_template'];?>">
						<div class="ui-block bloc_template">
							<article class="hentry blog-post">
								<a data-toggle="modal" data-target="#template">
									<img src="uploads/template/previsualisation/<?php echo $value['previsualisation'];?>" alt="">
									<div class="post-content">
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
								<div class="author"></div>
							</div>
							<h3 class="title"></h3>
							<div id="shortcode_modal" class="shortcode">
								<code></code>
							</div>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
							<div class="event-description">
								<h6 class="event-description-title">Fichiers pratique</h6><br>
								<a class="copy">Copier le shortcode</a>
								<a href="uploads/template/betheme/" class="img_betheme" download>Fichier BeTheme</a>
								<a href="uploads/template/slider/" class="slider-rev" download>Zip Slider</a>
								<a class="fancy-img" href="uploads/template/previsualisation/" data-fancybox>
									<img src="uploads/template/previsualisation/"/>
								</a>
							</div>
						</div>
					</div>
				</article>
			</div>
			<textarea id="tt"></textarea> 
		</div>

		<!-- Window-popup Event Private Public -->
		<div class="modal fade show" id="prop-template">
			<div class="modal-dialog ui-block window-popup event-private-public private-event">
				<a href="#" class="close icon-close" data-dismiss="modal" aria-label="Close">
					<svg class="olymp-close-icon"><use xlink:href="icons/icons.svg#olymp-close-icon"></use></svg>
				</a>
				<div class="container proposition">
					<div class="row">
						<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="ui-block">
								<div class="ui-block-title">
									<h6 class="title">Partage de template</h6>
								</div>
								<div class="ui-block-content">
									<form class="form-group label-floating is-empty help form-reset">
										<div class="form-group is-empty label-floating ">
											<select name="type" id="categorie">
												<option value="0">Choisir une catégorie</option>
												<?php foreach ($query_select_template_categorie as $key => $value) {?>
												<option value="<?php echo($value['id_categorie_template']) ?>"><?php echo utf8_encode(($value['categorie_template'])) ?></option>
												<?php }
												?>
											</select>
										</div>
										<div class="form-group is-empty label-floating ">
											<label class="control-label">Titre</label>
											<input class="form-control titre" placeholder="" value="" type="text" required="required">
										</div>
										<div class="form-group label-floating is-empty hide-label-description">
											<label class="control-label">Shortcode VC</label>
											<textarea name="description" id="description" cols="30" rows="10"></textarea>
										</div>
									</form>
									<div class="row hide-input">
										<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12 wrapper-betheme">
											<div class="form-group label-floating is-empty">
												<a href="#" class="lien-betheme">
													<img src="img/logo-betheme.jpg" alt="" class="trigger-input betheme">
													<p class="need">Fichier BeTheme</p>
												</a>
												<form class="upload_betheme">
													<input type="file" id="betheme" name="photos" required="required" accept=".txt">
												</form>
											</div>
										</div>
										<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12 wrapper-previsu">
											<div class="form-group label-floating is-empty">
												<a href="#" class="lien-previsu">
													<img src="img/logo-image.png" alt="" class="trigger-input previ">
													<p class="need">Image du template</p>
												</a>
												<form class="upload_template">
													<input type="file" id="previsualisation" name="photos" required="required" accept="image/*">
												</form>
											</div>
										</div>
										<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12 wrapper-slider">
											<div class="form-group label-floating is-empty">
												<a href="#" class="lien-slider">
													<img src="img/logo-slider.jpg" alt="" class="trigger-input slider">
													<p class="need">Fichier ZIP du slider</p>
												</a>
												<form class="upload_template">
													<input type="file" id="slider" name="zip" required="required" accept=".zip">
												</form>
											</div>
										</div>
									</div>
									<div class="row whitecolor">
										<div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-xs-12">
											<a class="btn btn-secondary btn-lg full-width reset">Renitialiser</a>
										</div>
										<div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-xs-12">
											<a class="btn btn-green btn-lg full-width btn-icon-left valider_template"><i class="fa fa-paper-plane-o" aria-hidden="true"></i>
											Valider le template</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="btn-fixed" data-toggle="modal" data-target="#prop-template"><p>Propose ton template!</p></div>


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

		<link rel="stylesheet" type="text/css" href="css/bootstrap-select.css">


		<script src="js/mediaelement-and-player.min.js"></script>
		<script src="js/mediaelement-playlist-plugin.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.9.1/sweetalert2.min.js"></script>
		<script src="js/simpleUpload.min.js"></script>
		<script src="js/charte.js"></script>
		<script src="js/isotope.pkgd.min.js"></script>
		<script src="js/jquery.fancybox.min.js"></script>
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



							//BIND LES IMAGES AVEC LES INPUTS
							$('a.lien-betheme').on('click', function(e){
								e.preventDefault();
								$('#betheme').trigger('click');
							})
							$('a.lien-previsu').on('click', function(e){
								e.preventDefault();
								$('#previsualisation').trigger('click');
							})
							$('a.lien-slider').on('click', function(e){
								e.preventDefault();
								$('#slider').trigger('click');
							})

							// AFFICHAGE DES INPUTS EN FONCTION DE LA CATEGORIE
							$('#categorie').on('change', function(){
								if ($(this).val() == 1) {
									$('.wrapper-slider').css('display', 'flex');
									$('.wrapper-previsu').css('display', 'flex');
									$('.wrapper-betheme').css('display', 'none');
									$('#description, .hide-label-description').css('display', 'none');
								}
								if ($(this).val() == 2) {
									$('.wrapper-slider').css('display', 'none');
									$('.wrapper-previsu').css('display', 'flex');
									$('.wrapper-betheme').css('display', 'flex');
									$('#description, .hide-label-description').css('display', 'flex');
								}
								if ($(this).val() == 3) {
									$('.wrapper-previsu').css('display', 'flex');
									$('.wrapper-betheme').css('display', 'flex');
									$('.wrapper-slider').css('display', 'none');
									$('#description, .hide-label-description').css('display', 'flex');
								}
							})

							//AFFICHAGE DU NOM DU FICHIER UPLOADE
							$('#slider').on('change', function(){
								var file_slider = $("#slider").prop("files");
								var names_slider = $.map(file_slider, function (val) { return val.name; });
								$('<p class="file">'+ names_slider + '</p>').appendTo('.wrapper-slider .need')
							})

							$('#previsualisation').on('change', function(){
								var file = $("input#previsualisation").prop("files");
								var names = $.map(file, function (val) { return val.name; });
								$('<p class="file">'+ names + '</p>').appendTo('.wrapper-previsu .need')
							})

							$('#betheme').on('change', function(){
								var file_betheme = $("#betheme").prop("files");
								var names_betheme = $.map(file_betheme, function (val) { return val.name; });
								$('<p class="file">'+ names_betheme + '</p>').appendTo('.wrapper-betheme .need')
							})

							$('.bloc_template').on('click', function(){
								var id_template = $(this).find('.id_template').val();
								var titre = $(this).find('.titre').val();
								var shortcode = $(this).find('.shortcode').val();
								var image = $(this).find('.image').val();
								var betheme = $(this).find('.betheme').val();
								var slider = $(this).find('.slider').val();

								$('#template .title').html(titre);
								$('#template .shortcode code').html(shortcode);
								$('#tt').val(shortcode);
								$('#template a.img_betheme').attr('href', 'uploads/template/betheme/' + betheme);
								$('#template .fancy-img').attr('href', 'uploads/template/previsualisation/' + image);
								$('#template .fancy-img img').attr('src', 'uploads/template/previsualisation/' + image);
								$('#template .slider-rev').attr('href', 'uploads/template/slider/' + slider);

							})

							$("a.copy").on('click', function(){
								$('#tt').select();
								document.execCommand('copy');
							});

							$('.valider_template').on('click', function(e){
								e.preventDefault();
								e.stopPropagation();
								var categorie = $('select#categorie').val();
								var titre = $('.titre').val();
								var shortcode = $('#description').val();
								var slider = $('#slider').val();
								var previsualisation = $('#previsualisation').val();
								var betheme = $('#betheme').val();

								var file_betheme = $("#betheme").prop("files");
								var names_betheme = $.map(file_betheme, function (val) { return val.name; });

								var file_slider = $("#slider").prop("files");
								var names_slider = $.map(file_slider, function (val) { return val.name; });

								var file = $("input#previsualisation").prop("files");
								var names = $.map(file, function (val) { return val.name; });

								console.log($('select#categorie').val());
								if (categorie != 0) {
									$('select#categorie').removeClass('empty');
									if (titre.length >= 5) {
										$('.titre').removeClass('empty');
										if (categorie == 1) {
											if (previsualisation != 0) {
												$('.wrapper-previsu p.need').removeClass('empty-p');
												if (slider != 0) {
													$('.wrapper-slider p.need').removeClass('empty-p');
													$.ajax({
														url: 'formulaire.php',
														type: 'POST',
														data: {categorie_template: categorie, titre: titre, shortcode: shortcode, betheme: names_betheme, visu: names, slider: names_slider},
													})
													.done(function(data) {
														swal(
															'Template proposé !',
															).then(function(){
																location.reload();
															})
														})
												}else{
													$('.wrapper-slider p.need').addClass('empty-p');
													$('.wrapper-slider p.need').html('Veuillez uploader votre fichier ZIP slider');
												}
											}else{
												$('.wrapper-previsu p.need').addClass('empty-p');
												$('.wrapper-previsu p.need').html('Veuillez uploader votre image de prévisualisation');
											}
										}else if (categorie == 2 || categorie == 3) {
											$('select#categorie').removeClass('empty');
											if (shortcode != 0) {
												$('#description').removeClass('empty');
												$('#description').prev().html('Shortcode VC');
												if (betheme != 0) {
													$('.wrapper-betheme p.need').removeClass('empty-p');
													if (previsualisation != 0) {
														$('.wrapper-previsu p.need').removeClass('empty-p');
														$.ajax({
															url: 'formulaire.php',
															type: 'POST',
															data: {categorie_template: categorie, titre: titre, shortcode: shortcode, betheme: names_betheme, visu: names, slider: names_slider},
														})
														.done(function(data) {
															swal(
																'Template proposé !',
																).then(function(){
																	location.reload();
																})
															})
													}else{
														$('.wrapper-previsu p.need').addClass('empty-p');
														$('.wrapper-previsu p.need').html('Veuillez uploader votre image de prévisualisation');
													}
												}else{
													$('.wrapper-betheme p.need').addClass('empty-p');
													$('.wrapper-betheme p.need').html('Veuillez uploader votre fichier BeTheme');
												}
											}else{
												$('#description').addClass('empty');
												$('#description').prev().html('Le shortcode est nécessaire pour partager un template');
											}
										}
									}else{
										$('.titre').addClass('empty');
									}
								}else{
									$('select#categorie').addClass('empty');
								}
							});


							$('#betheme').simpleUpload("upload_betheme.php", {

								start: function(file){
									//upload started
								},
								progress: function(progress){
									//received progress
								},
								success: function(data){
								},
								error: function(error){
									//upload failed
								}
							});

							$('#slider').simpleUpload("upload_slider.php", {

								start: function(file){
									//upload started
								},
								progress: function(progress){
									//received progress
								},
								success: function(data){
								},
								error: function(error){
									//upload failed
								}
							});

							$('input#previsualisation').simpleUpload("upload_template.php", {

								start: function(file){
									//upload started
								},
								progress: function(progress){
									//received progress
								},
								success: function(data){
								},
								error: function(error){
									//upload failed
								}

							});
						})
					</script>
				</body>
				</html>
				<?php }else{
					header('Location: template_admin.php');
				}
			}else{
				header('Location: login.php');
			}
			?>




