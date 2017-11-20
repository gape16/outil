<?php

// Connexion à la base de donnée et insertion de session_start
include('connexion_session.php');

$id_graph=$_SESSION['id_graph'];

if (isset($_SESSION['id_statut'])) {
	// print_r($_POST);

	?>
	<!DOCTYPE html>
	<html lang="en">
	<head>

		<title>Les anniversaires</title>

		<!-- Required meta tags always come first -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="x-ua-compatible" content="ie=edge">

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" type="text/css" href="Bootstrap/dist/css/bootstrap-reboot.css">
		<link rel="stylesheet" type="text/css" href="Bootstrap/dist/css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="Bootstrap/dist/css/bootstrap-grid.css">

		<!-- Theme Styles CSS -->
		<link rel="stylesheet" type="text/css" href="css/theme-styles.css">
		<link rel="stylesheet" type="text/css" href="css/blocks.css">

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
		<link rel='stylesheet' href='css/fullcalendar.css'/>
		<link rel='stylesheet' href='css/simplecalendar.css'/>
		<link rel="stylesheet" type="text/css" href="css/bootstrap-select.css">
		<link rel="stylesheet" type="text/css" href="css/daterangepicker.css">
		<link rel="stylesheet" type="text/css" href="css/main.css">


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


		<!-- Main Header Events -->

		<div class="main-header">
			<div class="content-bg-wrap">
				<div class="content-bg bg-birthday"></div>
			</div>
			<div class="container">
				<div class="row">
					<div class="col-lg-8 offset-lg-2 col-md-8 offset-md-2 col-sm-12 col-xs-12">
						<div class="main-header-content">
							<h1>N'oubliez jamais un anniversaire!</h1>
							<p>Bienvenu sur la page des anniversaire ce qui vous permettre de ne plus rater aucune date.
							</p>
						</div>
					</div>
				</div>
			</div>

			<img class="img-bottom" src="img/birthdays-bottom.png" alt="friends">
		</div>

		<!-- ... end Main Header Events -->


		<div class="container">
			<div class="row">
				<?php for ($i=1; $i < 13; $i++) { 
					if ($i<10) {
						$u="0".$i;
					}else{
						$u=$i;
					}
					$var = "%-".$u."-%";
					$query_=$bdd->prepare("SELECT * FROM user where date_naissance like ?");
					$query_->bindParam(1, $var);
					$query_->execute();
					$tab=["Janvier","Fevrier","Mars","Avril","Mai","Juin","Juillet","Aout","Septembre","Octobre","Novembre","Decembre"];
					?>

					<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="ui-block">
							<div class="ui-block-title">
								<h6 class="title"><?php echo $tab[$i-1];?></h6>
							</div>
						</div>
					</div>
					<?php foreach ($query_ as $key => $value) {?>
					<div class="col-xl-4 col-lg-6 col-md-12 col-sm-12 col-xs-12">
						<div class="ui-block">
							<div class="birthday-item inline-items">
								<div class="author-thumb">
									<img src="<?php echo utf8_encode($value['photo']);?>" alt="author">
								</div>
								<div class="birthday-author-name">
									<a href="#" class="h6 author-name"><?php echo $value['prenom']." ".$value['nom'];?></a>
									<div class="birthday-date"><?php echo explode("-",$value['date_naissance'])[2];?> <?php echo $tab[$i-1];?> <?php echo explode("-",$value['date_naissance'])[0];?></div>
								</div>
								<a data-toggle="modal" data-target="#anniversaire" data-id="<?php echo $value['id_user'];?>" class="btn btn-sm bg-blue participer">Participer<div class="ripple-container"></div></a>
							</div>
						</div>
					</div>
					<?php }}?>

					

				</div>
			</div>
			<!-- Window-popup Event Private Public -->
			<div class="modal fade show" id="anniversaire" >
				<div class="modal-dialog ui-block window-popup event-private-public private-event">
					<a href="#" class="close icon-close" data-dismiss="modal" aria-label="Close">
						<svg class="olymp-close-icon"><use xlink:href="icons/icons.svg#olymp-close-icon"></use></svg>
					</a>
					<article class="hentry post has-post-thumbnail thumb-full-width private-event">

						<div class="row">
							<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
								<div class="post__author author vcard inline-items">
									<div class="author-date">
										<a class="h6 post__author-name fn user_popup" href="#">PARTICIPATION ANNIVERSAIRE</a>
										<div class="post__date date_popup">
											<time class="published" datetime="2017-03-24T18:18">

											</time>
										</div>
									</div>

								</div>
								<h1 class="titreproblemos">

								</h1>
								<p class="descproblemos">

								</p>
								<div class="hax imgg"></div>
							</div>
							<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
								<div class="event-description">
									<h6 class="event-description-title">Infos pratiques</h6>
									<div class="place inline-items">
										<img class="avatar" src="<?php echo $value['photo_avatar'];?>" alt="author">
										<span class="who"></span>
										<span class="when"></span>
									</div>
								</div>
							</div>
						</article>

						<div data-mcs-theme="dark" style="max-height: 300px;overflow-y: scroll;">
							<ul class="comments-list">

							</ul>

						</div>

						<form class="comment-form inline-items">

							<div class="form-group with-icon-right ">
								<textarea class="form-control envoi_message_anniversaire" placeholder=""  ></textarea>
								<input type="hidden" class="id_anniversaire">
								<div class="add-options-message">
									<a href="#" class="options-message anniversaire_envoi">
										<svg class="olymp-camera-icon"><use xlink:href="icons/icons.svg#olymp-chat---messages-icon"></use></svg>
									</a>
								</div>

								<span class="material-input"></span><span class="material-input"></span></div>

							</form>
						</div>
					</div>
				</div>
			</div>

			<!-- ... end Window-popup Create Friends Group Add Friends -->


			<!-- jQuery first, then Other JS. -->
			<script src="js/jquery-3.2.0.min.js"></script>
			<!-- Js effects for material design. + Tooltips -->
			<script src="js/material.min.js"></script>
			<!-- Helper scripts (Tabs, Equal height, Scrollbar, etc) -->
			<script src="js/theme-plugins.js"></script>
			<!-- Init functions -->
			<script src="js/main.js"></script>

			<!-- Select / Sorting script -->
			<script src="js/selectize.min.js"></script>

			<!-- Swiper / Sliders -->
			<script src="js/swiper.jquery.min.js"></script>

			<!-- Datepicker input field script-->
			<script src="js/moment.min.js"></script>
			<script src="js/daterangepicker.min.js"></script>

			<!-- Calendar events script -->
			<script src="js/fullcalendar.js"></script>

			<script src="js/mediaelement-and-player.min.js"></script>
			<script src="js/mediaelement-playlist-plugin.min.js"></script>
			<?php 
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
			?>
			<script src="js/charte.js"></script>
			<script src="js/alterclass.js"></script>
			<script>
				$(function(){

					$('.participer').on('click', function(){
						var qui = $(this).parent().find('.author-name').html();
						var quand = $(this).parent().find('.birthday-date').html();
						console.log(qui);
						console.log(quand);
						$('#anniversaire .who').html('');
						$('#anniversaire .when').html('');
						$('#anniversaire .who').append(qui);
						$('#anniversaire .when').append(quand);
					})
				})
			</script>
		</body>
		</html>
		<?php }else{
			header('Location: login.php');
		}
		?>