<?php

// Connexion à la base de donnée et insertion de session_start
include('../connexion_session.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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
	if ($_COOKIE['id_statut'] == 1 || $_COOKIE['id_statut'] == 2 || $_COOKIE['id_statut'] == 3 || $_COOKIE['id_statut'] == 4 || $_COOKIE['id_statut'] == 5) {

		if (isset($_GET['post'])) {
			$post=$_GET['post'];
			$query_select_aide = $bdd->prepare("SELECT * FROM aide inner join user on aide.id_user = user.id_user inner join statut on user.id_statut = statut.id_statut where aide.id_aide = ?");
			$query_select_aide->bindParam(1, $post);
			$query_select_aide->execute();
			$nb_test=$query_select_aide->rowCount();
			if($nb_test==0){
				header('Location: test_help.php');
			}else{
				$fetch=$query_select_aide->fetch();
				$query_select_aide_com = $bdd->prepare("SELECT * FROM  commentaires_aide left join user on commentaires_aide.id_user = user.id_user left join statut on user.id_statut = statut.id_statut where commentaires_aide.id_aide = ? order by like_com DESC");
				$query_select_aide_com->bindParam(1, $post);
				$query_select_aide_com->execute();

				$query_notif_code=$bdd->prepare("SELECT * FROM aide order by id_aide DESC limit 1");
				$query_notif_code->execute();
				$query_featured=$bdd->prepare("SELECT commentaires_aide.id_aide,titre, date_aide, count(commentaires_aide.id_aide) as toto FROM aide inner join commentaires_aide on aide.id_aide = commentaires_aide.id_aide group by commentaires_aide.id_aide order by toto DESC limit 5");
				$query_featured->execute();
				$query_recent=$bdd->prepare("SELECT commentaires_aide.id_aide, date_commentaire, titre FROM commentaires_aide left join aide on commentaires_aide.id_aide = aide.id_aide group by id_aide order by date_commentaire DESC limit 5");
				$query_recent->execute();
				$result_notif_code=$query_notif_code->fetch();
				$dernier=$result_notif_code['id_aide'];
				$query_inser_code=$bdd->prepare("UPDATE notifications set notif_D = ? where id_user = ?");
				$query_inser_code->bindParam(1, $dernier);
				$query_inser_code->bindParam(2, $id_graph);
				$query_inser_code->execute();
				?>

				<!DOCTYPE html>
				<html lang="fr" id="help_open">
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
					<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.9.1/sweetalert2.css">
					<style>
					.white{
						background-color: white;
						padding: 15px 15px 0 15px;
						margin-top: 25px;
					}
					a.cms {
						margin-left: 15px;
						display: inline-flex;
						color: white;
						background: tomato;
						padding: 10px;
						position: absolute;
						right: 15px;
						bottom: 10px;
					}
					.commentaires {
						background: white;
						border-radius: 5px;
						border-left: 1px solid #e6ecf5;
						border-right: 1px solid #e6ecf5;
						border-bottom: 1px solid #e6ecf5;
					}
					.no-mb, p.date_log_com{
						margin-bottom: 0;
					}
					.date_com {
						background: #fafbfd;
						padding: 15px 15px;
					}
					.h6.title.tar {
						text-align: left;
						padding-left: 175px;
					}
					.flex_wrapper.commentaires {
						border: inherit;
					}
					.no-padding{
						padding: 0;
					}
					p.date_log_com {
						display: inline-flex;
					}
					a.btn{
						color: white !important;
					}
					.best_answer {
						background-color: #1ed760;
						color: white !important;
						padding: 0 10px;
						margin-right: 5px;
						text-align: right;
						border-radius: 3px;
						float: right;
						cursor: pointer;
					}
					a.annuler {
						background: tomato;
						color: white !important;
						padding: 0 10px;
						border-radius: 3px;
						float: right;
						margin-right: 5px;
					}
					a.choose_answer {
						background: #1ed760;
						padding: 0 10px;
						color: white !important;
						float: right;
						margin-right: 5px;
						border-radius: 3px;
					}
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
						<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="ui-block responsive-flex">
								<div class="ui-block-title">
									<div class="h6 title">Historique des demandes</div>
									<div class="align-right">
										<a href="new_help.php" class="btn btn-blue btn-md">Demandez de l'aide</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>


				<div class="container">
					<div class="row">
						<div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-xs-12 border">
							<div class="ui-block no-mb">
								<div class="ui-block-title">
									<i class="icon fa fa-star c-yellow" aria-hidden="true"></i>
									<div class="h6 title tar"><?php echo utf8_encode($fetch['titre']);?><a class="cms" target="_blank" href="<?php echo utf8_encode($fetch['adresse_cms']);?>">CMS</a></div>
								</div>
								<div class="content_wrapper">
									<div class="flex_wrapper">
										<div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12">
											<p class="auteur">Auteurs</p>
											<div class="wrapper">	
												<img class="center" src="../<?php echo utf8_encode($fetch['photo_avatar']);?>" alt="">
												<p class="h6 author-name"><?php echo utf8_encode($fetch['prenom']." ".$fetch['nom']);?></p>
												<p class="country"><?php echo utf8_encode($fetch['nom_statut']);?></p>
											</div>
										</div>
										<div class="col-xl-9 col-lg-9 col-md-9 col-sm-12 col-xs-12 bl">
											<p class="msg">Messages</p>
											<pre class="break"><p class="post"><?php echo utf8_encode(nl2br($fetch['description']));?></p></pre>
											<?php if (!empty($fetch['code_aide'])) { ?>
											<p class="show_code">Voir le code <svg class="olymp-cupcake-icon left-menu-icon" data-toggle="tooltip" data-placement="right"  data-original-title="Voir plus"  ><use xlink:href="../icons/icons.svg#olymp-dropdown-arrow-icon"></use></svg></p>
											<?php } ?>
											<div class="code_wrapper">
												<code><?php echo html_entity_decode(nl2br($fetch['code_aide']));?></code>
											</div>
											<?php  if (!empty($fetch['capture'])) {?>
											<div class="post-img">
												<p class="pj">Pièce(s) jointe(s)</p>
												<a class='fancy-img' href='../uploads/help/<?php echo utf8_encode($fetch['capture']);?>' data-fancybox="gallery"><img src='../uploads/help/<?php echo utf8_encode($fetch['capture']);?>'></a>
											</div>
											<?php } ?>
										</div>
									</div>
									<div class="grey"><p class="topic-date"><?php echo time_elapsed_string($fetch['date_aide']);?></p> <a href="#" class="rep">Répondre</a>
									</div>
									<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">
										<?php foreach ($query_select_aide_com as $value) {
											$query_sel_lik = $bdd->prepare("SELECT id_like from like_com where id_graph = ? and id_com = ?");
											$query_sel_lik->bindParam(1, $_COOKIE['id_graph']);
											$query_sel_lik->bindParam(2, $value['id_commentaires_aide']);
											$query_sel_lik->execute();
											$nb_lik = $query_sel_lik->rowCount();
											if($nb_lik ==0){
												$tab= "";
											}else{
												$tab= "style=\"fill: #ff5e3a;color: #ff5e3a;\"";
											}

											if ($value['id_commentaires_aide'] == $fetch['id_meilleure_reponse']) {
												$best_answer = 'best';
												$btn = "";
												if ($_COOKIE['id_statut'] == 4 || $_COOKIE['id_statut'] == 5) {
													$btn = '<a class="annuler" data-id="'.$value['id_commentaires_aide'].'" data-aide="'. $fetch['id_aide'].'">Annuler</a>';
												}
												$btn .= '<a class="best_answer">Meilleure réponse</a>';
											}else{
												$best_answer = '';
												$btn = '';
											}

											?>
											<div class="flex_wrapper commentaires">

												<div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12">
													<div class="wrapper">	
														<img class="center" src="../<?php echo utf8_encode($value['photo_avatar']);?>" alt="">
														<p class="h6 author-name"><?php echo utf8_encode($value['prenom']." ".$value['nom']);?></p>
														<p class="country"><?php echo utf8_encode($value['nom_statut']);?></p>
													</div>
												</div>
												<div class="col-xl-9 col-lg-9 col-md-9 col-sm-12 col-xs-12 bl">
													<pre class="break"><p class="post"><?php echo htmlentities(utf8_encode($value['commentaire']));?></p></pre>
												</div>
											</div>
											<div class="date_com <?php echo $best_answer; ?>">
												<p class="date_log_com"><?php echo time_elapsed_string($value['date_commentaire']);?></p>
												<a class="reply-topic post-add-icon inline-items com like_commentaire_<?php echo $value['id_commentaires_aide'];?>"><svg class="olymp-heart-icon" <?php echo $tab;?>><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="../icons/icons.svg#olymp-heart-icon"></use></svg>
													<span><?php echo $value['like_com'];?></span>
												</a>
												<?php echo $btn;

												if (empty($fetch['id_meilleure_reponse']) && ($_COOKIE['id_statut'] == 4 || $_COOKIE['id_statut'] == 5)) {?>
												<a class="choose_answer" data-id="<?php echo $value['id_commentaires_aide'] ?>" data-aide="<?php echo $fetch['id_aide'];?>">Choisir comme meilleure réponse</a>
												<?php } ?>
											</div>
											<?php }?>
										</div>
										<form class="white">
											<input type="hidden" class="id_aide" value="<?php echo $fetch['id_aide'];?>">
											<div class="form-group label-floating">
												<label class="control-label">Réponse</label>
												<textarea class="form-control envoi_message_aide" style="height: 240px"></textarea>
												<span class="material-input"></span></div>

												<div class="row">
													<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12">
														<a class="btn btn-secondary btn-lg full-width reni_aide">Annuler</a>
													</div>

													<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12 ">
														<a class="btn btn-blue btn-lg full-width aide_envoi">Poster</a>
													</div>
												</div>
											</div>
										</form>
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
														<a href="help_open.php?post=<?php echo $value['id_aide'] ;?>" class="h6 title"><?php echo utf8_encode($value['titre']);?></a>
														<time class="entry-date updated" datetime="$value['date_aide']"><?php echo time_elapsed_string($value['date_aide']) ;?></time>
													</div>
												</li>
												<?php }?>
											</ul>

											<!-- ... end Widget Featured Topics -->
										</div>
									</div>

									<div class="ui-block no-mb">
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
															<a href="help_open.php?post=<?php echo $value['id_aide'] ;?>" class="h6 title"><?php echo utf8_encode($value['titre']);?></a>
															<time class="entry-date updated" datetime="$value['date_aide']"><?php echo time_elapsed_string($value['date_commentaire']) ;?></time>
														</div>
													</li>
													<?php }?>
												</ul>
												<!-- ... end Widget Recent Topics -->
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
							}
						}else{
							header('Location: help.php');
						}
					}else{
						header('Location: help.php');
					}
				}else{
					header('Location: ../login.php');
				}
				?>

