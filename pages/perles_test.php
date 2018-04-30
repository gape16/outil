<?php

// Connexion à la base de donnée et insertion de session_start
include('../connexion_session.php');


// truncate string at word
function shapeSpace_truncate_string_at_word($string, $limit, $break = ".", $pad = "...") {  
	
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
			$v = $diff->$k . ' ' . $v . (($diff->$k > 1 && $k != "m")  ? 's' : '');
		} else {
			unset($string[$k]);
		}
	}

	if (!$full) $string = array_slice($string, 0, 1);
	return $string ? ' Il y a ' .implode(', ', $string) : 'maintenant';
}

if (isset($_COOKIE['id_statut'])) {

	$selection = $bdd->prepare("SELECT * FROM perles inner join user on perles.id_user = user.id_user");
	$selection->execute();

	$id_graph=$_COOKIE['id_graph'];

	?>

	<!DOCTYPE html>
	<html lang="fr" id="veille">
	<head>

		<title>Les perles</title>

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
		<link rel="stylesheet" type="text/css" href="../css/fonts.min.css">
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.9.1/sweetalert2.css">
		<link rel="stylesheet" type="text/css" href="../css/bootstrap-select.css">

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
		<style>
		.perle .post-content p {
			word-break: break-all;
		}
		.crumina-testimonial-item .author-content {
			padding-bottom: 10px;
		}
		.rait-stars li {
			width: 16px;
		}
		.vote {
			opacity: 0;	
			position: absolute	;
			left: -110px;
			top: 2px;
			margin-bottom: 	0;
		}
		.noter, .background {
			margin-bottom: 0;
			background: #9a9fbf;
			color: white;
			padding: 10px 0;
			position: absolute;
			bottom: 0;
			width: 100%;
			left: 0;
			height: 40px;
		}
		.noter p{
			margin: 0;	
		}
		.noter:hover > p{
			display: none;	
		}
		.noter:hover .vote {
			opacity: 1;	
			margin-bottom: 0;
			position: relative;
			top: 0;
			left: 0;
			margin-top: 2px;
			transition: all .2s linear;
		}
		.checked {
			color: #ffce08;
		}
		.fa{
			cursor: pointer;
		}
		p.testimonial-message {
			overflow-wrap: break-word;
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
			<div class="content-bg bg-events"></div>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="ui-block">
					<div class="ui-block-title">
						<h6 class="title">Ajout perles</h6>
					</div>
					<div class="ui-block-content">
						<form class="form-group label-floating is-empty perle">
							<div class="form-group is-empty label-floating">
								<label class="control-label">Titre</label>
								<input class="form-control titreperle" placeholder="" value="" type="text">
								<span class="material-input"></span>
							</div>
							<div class="form-group label-floating is-empty">
								<label class="control-label">Description</label>
								<textarea name="description" id="description" cols="30" rows="10"></textarea>
							</div>
							<div class="form-group label-floating is-empty">
								<form class="upload_perle">
									<input type="file" id="file-select" name="photos" required="required">
								</form>
							</div>
						</form>
						<div class="row">
							<div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<a href="#" class="btn btn-secondary btn-lg full-width reni_perle">Renitialiser</a>
							</div>
							<div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<a href="#" class="btn btn-green btn-lg full-width btn-icon-left valider_perle"><i class="fa fa-paper-plane-o" aria-hidden="true"></i>
								Envoyer l'article</a>
							</div>
						</div>
					</div>
				</div>

			</div>

		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="ui-block">
					<div class="ui-block-title">
						<h6 class="title">Les perles du moment</h6>
					</div>
				</div>
				<div id="perles" class="row" data-layout="masonry">
					<?php 
					foreach ($selection as $key => $value) {
						$id_perles=$value['idperles'];
						$selection_note = $bdd->prepare("SELECT * FROM note_perles where id_perles = ?");
						$selection_note->bindParam(1, $id_perles);
						$selection_note->execute();
						$nb_note=$selection_note->rowCount();
						$note_final=0;
						if($nb_note == 0){
							$note_final = 0;
						}else{
							foreach ($selection_note as $key => $note) {
								$note_final=$note_final+$note['note_perles'];
							}
							$note_final=$note_final/$nb_note;
						}
						$pleine = "M259.3 17.8L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z";
						$vide = "M528.1 171.5L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6zM388.6 312.3l23.7 138.4L288 385.4l-124.3 65.3 23.7-138.4-100.6-98 139-20.2 62.2-126 62.2 126 139 20.2-100.6 98z";
						?>
						<div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12" data-id="<?php echo $value['idperles'];?>">
							<div class="ui-block">
								<div class="crumina-module crumina-testimonial-item">
									<div class="testimonial-header-thumb" style="background: url('../uploads/perles/<?php echo utf8_encode($value['img_perle']);?>'); background-size:cover;"></div>

									<div class="testimonial-item-content">

										<div class="author-thumb">
											<img src="../<?php echo utf8_encode($value['photo_avatar']);?>" alt="author" style="max-width: 100px;max-height: 100px;">
										</div>

										<h3 class="testimonial-title"><?php echo utf8_encode($value['titre_perle']);?></h3>

										<ul class="rait-stars">
											<li>
												<svg class="svg-inline--fa fa-star fa-w-18 star-icon" aria-hidden="true" data-prefix="fa" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path fill="currentColor" d="<?php if($note_final>= 1){ echo $pleine; }else{ echo $vide; }?>"></path></svg><!-- <i class="fa fa-star star-icon"></i> -->
											</li>
											<li>
												<svg class="svg-inline--fa fa-star fa-w-18 star-icon" aria-hidden="true" data-prefix="fa" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path fill="currentColor" d="<?php if($note_final>= 2){ echo $pleine; }else{ echo $vide; }?>"></path></svg><!-- <i class="fa fa-star star-icon"></i> -->
											</li>

											<li>
												<svg class="svg-inline--fa fa-star fa-w-18 star-icon" aria-hidden="true" data-prefix="fa" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path fill="currentColor" d="<?php if($note_final>= 3){ echo $pleine; }else{ echo $vide; }?>"></path></svg><!-- <i class="fa fa-star star-icon"></i> -->
											</li>
											<li>
												<svg class="svg-inline--fa fa-star fa-w-18 star-icon" aria-hidden="true" data-prefix="fa" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path fill="currentColor" d="<?php if($note_final>= 4){ echo $pleine; }else{ echo $vide; }?>"></path></svg><!-- <i class="fa fa-star star-icon"></i> -->
											</li>
											<li>
												<svg class="svg-inline--fa fa-star fa-w-18 star-icon" aria-hidden="true" data-prefix="fa" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path fill="currentColor" d="<?php if($note_final>= 5){ echo $pleine; }else{ echo $vide; }?>"></path></svg><!-- <i class="fa fa-star star-icon"></i> -->
											</li>
										</ul>

										<p class="testimonial-message"><?php echo utf8_encode($value['description_perle']);?>
										</p>

										<div class="author-content">
											<a href="#" class="h6 author-name"><?php echo utf8_encode($value['prenom']." ".$value['nom']);?></a>
											<div class="country"><?php echo time_elapsed_string($value['date_perle']);?></div>
										</div>
										

										<?php 	

										$id_perles=$value['idperles'];
										$id_user=$_COOKIE['id_graph'];
										$check_if_user_has_voted = $bdd->prepare("SELECT * FROM note_perles where id_perles = ? and id_user = ?");
										$check_if_user_has_voted->bindParam(1, $id_perles);
										$check_if_user_has_voted->bindParam(2, $id_user);
										$check_if_user_has_voted->execute();
										$nb=$check_if_user_has_voted->rowCount();

										if ($nb >= 1) { ?>
										<div class="background">	
											<p>Vous avez déjà voté</p>
										</div> 
										<?php }else{ ?>
										<div class="noter">	
											<p>Noter la perle</p>
											<div class="vote">	
												<span class="fa fa-star" data-id="1"></span>
												<span class="fa fa-star" data-id="2"></span>
												<span class="fa fa-star" data-id="3"></span>
												<span class="fa fa-star" data-id="4"></span>
												<span class="fa fa-star" data-id="5"></span>
											</div>
										</div> 

										<?php } ?>



									</div>
								</div>
							</div>
						</div>
						<?php }?>

					</div>
					<!-- .. end W-Twitter -->
				</div>
			</div>
		</div>
	</div>
	<!-- ... end Window-popup Create Friends Group Add Friends -->

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
	<script src="../js/simpleUpload.min.js"></script>

	<!-- Swiper / Sliders -->
	<script src="../js/swiper.jquery.min.js"></script>

	<script src="../js/isotope.pkgd.min.js"></script>
	<script src="../js/masonry.pkgd.js"></script>

	<script src="../js/mediaelement-and-player.min.js"></script>
	<script src="../js/mediaelement-playlist-plugin.min.js"></script>

	<script src="../js/mediaelement-and-player.min.js"></script>
	<script src="../js/mediaelement-playlist-plugin.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.9.1/sweetalert2.min.js"></script>
	<script src="../js/simpleUpload.min.js"></script>
	<script src="../js/charte.js"></script>
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
	<script type="text/javascript">
		$(function(){

			// jQuery
			$grid.masonry();

			var $grid = $('.grid').masonry({
				columnWidth: 80
			});

			$('#perles').imagesLoaded().progress( function() {
				$('#perles').masonry('layout');
			});

			function makeid() {
				var text = "";
				var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

				for (var i = 0; i < 5; i++)
					text += possible.charAt(Math.floor(Math.random() * possible.length));
				text += '-';

				return text;
			}

			$('.fa-star').hover(function(){
				$(this).toggleClass('checked');
				$(this).prevAll('.fa-star').toggleClass('checked');
			})

			$('.fa-star').on('click', function(){
				var id = $(this).attr('data-id');
				var id_perle = $(this).parents('.col-xl-4').attr('data-id');
				$.ajax({
					url: '../formulaire.php',
					type: 'POST',
					data: {id_perle_note: id_perle, note: id},
				})
				.done(function() {
					console.log("success");
				})	
			})


			$(".reni_perle").on("click", function(){
				$(".perle").find("input").val('');
				$(".perle").find("select").val(0);
				$(".perle").find("textarea").val('');
			})

			$('.valider_perle').on('click', function(e){
				e.preventDefault();
				var titreperle = $('.titreperle').val();
				var file = $("#file-select").prop("files");
				var description = $('#description').val();
				var names = $.map(file, function (val) { return val.name; });
				var token = makeid();
				Cookies.set('token', token);
				if (titreperle.length >= 5) {
					$('.titreperle').removeClass('empty');
					if (description.length >= 30) {
						$('#description').removeClass('empty');
						$.ajax({
							url: '../../formulaire.php',
							type: 'POST',
							data: {titreperle: titreperle, description_perle: description, file_perle: names, token_perle: token}
						})
						.done(function(data) {
							swal(
								'Perle ajoutée !',
								'',
								'success'
								).then(function(){
									location.reload();
								})		
							})
						$('#file-select').simpleUpload("../../uploads/upload_perle.php", {

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
									// console.log(error);
								}

							});
					}else{
						$('#description').addClass('empty');
						$('#description').prev().html('30 caractères minimum requis');
					}
				}else{
					$('.titreperle').addClass('empty');
					$('.titreperle').prev().html('5 caractères minimum requis');
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