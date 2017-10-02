<?php

// Connexion à la base de donnée et insertion de session_start
include('connexion_session.php');


if (isset($_SESSION['id_statut'])) {
	$id_graph=$_SESSION['id_graph'];
	$query_select_card_crea_maquette = $bdd->prepare("SELECT num_client, raison_social, lien_CMS, photo FROM client inner join user on client.id_graph_maquette=user.id_user where client.id_graph_maquette=? and date_retour_maquette IS NULL and date_retour_cq IS NULL");
	$query_select_card_crea_maquette->bindParam(1, $id_graph);
	$query_select_card_crea_maquette->execute();
	$cards_client=$query_select_card_crea_maquette->fetchAll();
	?>

	<!DOCTYPE html>
	<html lang="en">
	<head>

		<title>Friend Groups</title>

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

	</head>

	<body>

		<!-- Fixed Sidebar Left -->

		<?php include('left_sidebar.php');?>

		<!-- ... end Fixed Sidebar Left -->

		<!-- Fixed Sidebar Left -->

		<?php include('fixed_left_sidebar.php');?>

		<!-- ... end Fixed Sidebar Left -->

		<!-- Fixed Sidebar Right -->

		<?php include('fixed_sidebar_right.php');?>

		<!-- ... end Fixed Sidebar Right -->


		<!-- Header -->

		<?php include('header.php');?>

		<!-- ... end Header -->


		<!-- Responsive Header -->

		<?php include('responsive_header.php');?>
		
		<!-- ... end Responsive Header -->

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
							<h1>N'hésitez plus, demandez de l'aide</h1>
							<p>C'est ici que vous allez pouvoir faire les demandes d'aide sur vos problèmes d'intégration</p>
						</div>
					</div>
				</div>
			</div>

			<img class="img-bottom" src="img/music-bottom.png" alt="friends">
		</div>

		<!-- Main Content Groups -->
		<?php 
		// si c'est un graph qui se connect
		if ($_SESSION['id_statut'] == 1) {?>
		<div class="container">
			<div class="row">
				<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="ui-block">
						<div class="ui-block-title">
							<h6 class="title">Demande d'aide</h6>
						</div>
						<div class="ui-block-content">
							<form class="form-group label-floating is-empty addclient">
								<div class="form-group is-empty label-floating ">
									<label class="control-label">Numéro client</label>
									<input class="form-control numclient" placeholder="" value="" type="text">
								</div>
								<div class="form-group label-floating is-empty">
									<label class="control-label">Adresse CMS</label>
									<input class="form-control adressecms" placeholder="" value="" type="text">
								</div>
								<div class="form-group label-floating is-empty">
									<label class="control-label">Description du problème</label>
									<textarea name="description" id="description" cols="30" rows="10"></textarea>
								</div>
							</form>
							<div class="row">
								<div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-xs-12">
									<a href="#" class="btn btn-secondary btn-lg full-width" data-toggle="modal" data-target="#faqs-popup">Renitialiser</a>
								</div>
								<div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-xs-12">
									<a href="#" class="btn btn-green btn-lg full-width btn-icon-left valider_aide"><i class="fa fa-paper-plane-o" aria-hidden="true"></i>
									Valider la demande</a>
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
						<div class="ui-block-title ui-block-title-small">
							<h6 class="title">Historique des demandes d'aide</h6>
						</div>
						<table class="event-item-table">
							<tbody>
								<tr class="event-item">
									<td class="upcoming">
										<div class="date-event">
											<svg class="olymp-small-calendar-icon"><use xlink:href="icons/icons.svg#olymp-small-calendar-icon"></use></svg>
											<span class="day">28</span>
											<span class="month">may</span>
										</div>
									</td>
									<td class="author">
										<div class="event-author inline-items">
											<div class="author-thumb">
												<img src="img/avatar66-sm.jpg" alt="author">
											</div>
											<div class="author-date">
												<a href="#" class="author-name h6">Green Goo in Gotham</a>
												<time class="published" datetime="2017-03-24T18:18">Saturday at 9:00pm</time>
											</div>
										</div>
									</td>
									<td class="location">
										<div class="place inline-items">
											<svg class="olymp-add-a-place-icon"><use xlink:href="icons/icons.svg#olymp-add-a-place-icon"></use></svg>
											<span>Gotham Bar</span>
										</div>
									</td>
									<td class="description">
										<p class="description">We’ll be playing in the Gotham Bar in May. Come and have a great time with us! Entry: $12</p>
									</td>
									<td class="users">
										<ul class="friends-harmonic">
											<li>
												<a href="#">
													<img src="img/friend-harmonic5.jpg" alt="friend">
												</a>
											</li>
											<li>
												<a href="#">
													<img src="img/friend-harmonic10.jpg" alt="friend">
												</a>
											</li>
											<li>
												<a href="#">
													<img src="img/friend-harmonic7.jpg" alt="friend">
												</a>
											</li>
											<li>
												<a href="#">
													<img src="img/friend-harmonic8.jpg" alt="friend">
												</a>
											</li>
											<li>
												<a href="#">
													<img src="img/friend-harmonic2.jpg" alt="friend">
												</a>
											</li>
											<li>
												<a href="#" class="all-users bg-breez">+24</a>
											</li>

											<li class="with-text">
												Will Assist
											</li>
										</ul>
									</td>
									<td class="add-event">
										<a href="20-CalendarAndEvents-MonthlyCalendar.html" class="btn btn-breez btn-sm">Add to Calendar</a>
									</td>

								</tr>
							</tbody>
						</table>

						<div class="ui-block-title ui-block-title-small">
							<h6 class="title">PAST EVENTS</h6>
						</div>

						<div class="no-past-events">
							<svg class="olymp-month-calendar-icon"><use xlink:href="icons/icons.svg#olymp-month-calendar-icon"></use></svg>
							<span>There are no past events <br/>to show</span>
						</div>
					</div>
				</div>
			</div>
		</div>

		<?php }?>
		<!-- ... end Window-popup Create Friends Group Add Friends -->

		<!-- Window-popup-CHAT for responsive min-width: 768px -->

		<?php include('chat_box.php');?>

		<!-- ... end Window-popup-CHAT for responsive min-width: 768px -->


		<!-- jQuery first, then Other JS. -->
		<script src="js/jquery-3.2.0.min.js"></script>
		<!-- Js effects for material design. + Tooltips -->
		<script src="js/material.min.js"></script>
		<!-- Helper scripts (Tabs, Equal height, Scrollbar, etc) -->
		<script src="js/theme-plugins.js"></script>
		<!-- Init functions -->
		<script src="js/main.js"></script>
		<script src="js/alterclass.js"></script>
		<script src="js/chat.js"></script>
		<!-- Select / Sorting script -->
		<script src="js/selectize.min.js"></script>

		<link rel="stylesheet" type="text/css" href="css/bootstrap-select.css">


		<script src="js/mediaelement-and-player.min.js"></script>
		<script src="js/mediaelement-playlist-plugin.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.9.1/sweetalert2.min.js"></script>

		<script src="js/charte.js"></script>
	</body>
	</html>
	<?php }else{
		header('Location: login.php');
	}
	?>