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

if (isset($_COOKIE['id_statut'])) {
	if ($_COOKIE['id_statut'] == 1 || $_COOKIE['id_statut'] == 2 || $_COOKIE['id_statut'] == 3 || $_COOKIE['id_statut'] == 4 ||  $_COOKIE['id_statut'] == 5) {
		$query_select_template = $bdd->prepare("SELECT * FROM template left join user on template.id_user=user.id_user left join categorie_template on template.categorie=categorie_template.id_categorie_template WHERE accept_template = 1 order by date_template DESC");
		$query_select_template->execute();

		$query_select_template_categorie = $bdd->prepare("SELECT * FROM categorie_template");
		$query_select_template_categorie->execute();


		$query_select_template_moderer = $bdd->prepare("SELECT * FROM template left join user on template.id_user=user.id_user left join categorie_template on template.categorie=categorie_template.id_categorie_template WHERE accept_template = 0 order by date_template DESC");
		$query_select_template_moderer->execute();
		?>

		<!DOCTYPE html>
		<html lang="fr" id="templ">
		<head>

			<title>Partage de template</title>

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
								<h1>Bibliothèque de templates</h1>
								<p>Consultez et partagez vos templates de slider et de page.</p>
							</div>
						</div>
					</div>
				</div>
			</div>

			<?php if($_COOKIE['id_statut']==4 || $_COOKIE['id_statut']==5){?>
			<div class="container">
				<div class="row">
					<div class="ui-block-title custom">
						<h6 class="title">Templates à modérer</h6>
					</div>
					<?php foreach ($query_select_template_moderer as $key => $value): ?>	
						<div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 col-xs-12 sorting-item <?php echo $value['categorie_template'];?>">
							<div class="ui-block bloc_template_moderer">
								<article class="hentry blog-post">
									<a data-toggle="modal" data-target="#template_moderer">
										<img src="../uploads/template/previsualisation/<?php echo utf8_encode($value['previsualisation']);?>" alt="">
										<div class="post-content">
											<div class="hacks-relative">	
												<p class="post-category bg-blue-light"><?php echo utf8_encode($value['categorie_template']);?></p>
												<h4><?php echo utf8_encode($value['titre']);?></h4>
												<div class="author-date">
													<p class="h6 post__author-name fn"><?php echo utf8_encode($value['nom']);?> <?php echo utf8_encode($value['prenom']);?></p>
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
										<input type="hidden" class="nom" value="<?php echo utf8_encode($value['prenom']);?> <?php echo utf8_encode($value['nom']);?>">
										<code><input type="hidden" class="shortcode" value='<?php echo utf8_encode($value['shortcode']);?>'></code>
										<input type="hidden" class="image" value="<?php echo utf8_encode($value['previsualisation']);?>">
										<input type="hidden" class="betheme" value="<?php echo utf8_encode($value['betheme']);?>">
										<input type="hidden" class="slider" value="<?php echo utf8_encode($value['slider']);?>">
										<input type="hidden" class="photo" value="<?php echo utf8_encode($value['photo_avatar']);?>">
										<input type="hidden" class="description" value="<?php echo utf8_encode($value['description']);?>">
									</a>
								</article>
							</div>
						</div>
					<?php endforeach ?>
				</div>
			</div>

			<!-- Window-popup Event Private Public -->
			<div class="modal fade show" id="template_moderer">
				<div class="modal-dialog ui-block window-popup event-private-public private-event">
					<a href="#" class="close icon-close" data-dismiss="modal" aria-label="Close">
						<svg class="olymp-close-icon"><use xlink:href="../icons/icons.svg#olymp-close-icon"></use></svg>
					</a>
					<article class="hentry post has-post-thumbnail thumb-full-width private-event">
						<div class="row">
							<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
								<div class="post__author author vcard inline-items">
									<img class="img_avatar" src="" alt="author">
									<div class="author qui"></div>
								</div>
								<h3 class="title"></h3>
								<div class="infos">
									<p class="description">	</p>
									<p class="toggle_code">Voir le shortcode</p>
									<code class="shortcode">
										<pre>	</pre>
									</code>
								</div>
							</div>
							<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
								<div class="event-description">
									<h6 class="event-description-title">Fichiers pratique</h6><br>
									<a class="copy">Copier le shortcode</a>
									<a href="" class="img_betheme" download>Fichier BeTheme</a>

									<a href="" class="slider-rev" download>Zip Slider</a>

									<a class="fancy-img" href="" data-fancybox>
										<img src=""/>
									</a>

									<a class="btn btn-secondary btn-sm full-width ko_template">Refuser</a>
									<a class="btn btn-green btn-sm full-width ok_template">Valider</a>
								</div>
							</div>
						</div>
					</article>
				</div>
				<textarea id="tt" style="opacity:0;"></textarea> 
				<input type="hidden" class="id_template"">
			</div>
			<?php }?>






			<div class="container">
				<ul class="cat-list-bg-style align-center sorting-menu">
					<li class="cat-list__item active" data-filter="*"><a href="#" class="">Toutes les catégories</a></li>
					<li class="cat-list__item" data-filter=".Slider"><a href="#" class="">Slider</a></li>
					<li class="cat-list__item" data-filter=".Contenu"><a href="#" class="">Page</a></li>
					<li class="cat-list__item" data-filter=".Footer"><a href="#" class="">Footer</a></li>
					<a href="#" class="cat-list__item red-btn" data-toggle="modal" data-target="#prop-template">Propose ton template</a>
				</ul>
				<div class="row sorting-container" data-layout="masonry">
					<?php foreach ($query_select_template as $key => $value): ?>	
						<div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 col-xs-12 sorting-item <?php echo $value['categorie_template'];?>">
							<div class="ui-block bloc_template">
								<article class="hentry blog-post">
									<a data-toggle="modal" data-target="#template">
										<img src="../uploads/template/previsualisation/<?php echo utf8_encode($value['previsualisation']);?>" alt="">
										<div class="post-content">
											<div class="hacks-relative">
												<p class="post-category bg-blue-light"><?php echo utf8_encode($value['categorie_template']);?></p>
												<h4><?php echo utf8_encode($value['titre']);?></h4>
												<div class="author-date">
													<p class="h6 post__author-name fn"><?php echo utf8_encode($value['nom']);?> <?php echo utf8_encode($value['prenom']);?></p>
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
										<input type="hidden" class="nom" value="<?php echo utf8_encode($value['prenom']);?> <?php echo utf8_encode($value['nom']);?>">
										<code><input type="hidden" class="shortcode" value='<?php echo utf8_encode($value['shortcode']);?>'></code>
										<input type="hidden" class="image" value="<?php echo utf8_encode($value['previsualisation']);?>">
										<input type="hidden" class="betheme" value="<?php echo utf8_encode($value['betheme']);?>">
										<input type="hidden" class="slider" value="<?php echo utf8_encode($value['slider']);?>">
										<input type="hidden" class="photo" value="<?php echo utf8_encode($value['photo_avatar']);?>">
										<input type="hidden" class="description" value="<?php echo utf8_encode($value['description']);?>">
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
						<svg class="olymp-close-icon"><use xlink:href="../icons/icons.svg#olymp-close-icon"></use></svg>
					</a>
					<article class="hentry post has-post-thumbnail thumb-full-width private-event">
						<div class="row">
							<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
								<div class="post__author author vcard inline-items">
									<img class="img_avatar" src="" alt="author">
									<div class="author qui"></div>
								</div>
								<h3 class="title"></h3>
								<div class="infos">
									<p class="description">	</p>
									<p class="toggle_code">Voir le shortcode</p>
									<code class="shortcode">
										<pre>	</pre>
									</code>
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
						<svg class="olymp-close-icon"><use xlink:href="../icons/icons.svg#olymp-close-icon"></use></svg>
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
												<label class="control-label">Description</label>
												<textarea name="description" id="description" cols="30" rows="10"></textarea>
											</div>
											<div class="form-group label-floating is-empty hide-label-shortcode">
												<label class="control-label">Shortcode VC</label>
												<textarea name="description" id="shortcode" cols="30" rows="10"></textarea>
											</div>
										</form>
										<div class="row hide-input">
											<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12 wrapper-betheme">
												<div class="form-group label-floating is-empty">
													<a href="#" class="lien-betheme">
														<img src="../img/logo-betheme.jpg" alt="" class="trigger-input betheme">
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
														<img src="../img/logo-image.png" alt="" class="trigger-input previ">
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
														<img src="../img/logo-slider.jpg" alt="" class="trigger-input slider">
														<p class="need">Fichier ZIP du slider</p>
													</a>
													<form class="upload_template">
														<input type="file" id="slider" name="photos" required="required" accept=".zip">
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
			<script src="../js/pages/template.js"></script>
			<!-- <script src="../js/charte.js"></script> -->
			<script src="../js/isotope.pkgd.min.js"></script>
			<script src="../js/jquery.fancybox.min.js"></script>
			<script src="../js/js.cookie.js"></script>
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
		<?php }else{
			header('Location: template.php');
		}
	}else{
		header('Location: ../login.php');
	}
	?>




