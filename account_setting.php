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

		<title>Your Account - Account Settings</title>

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
		<link rel="stylesheet" type="text/css" href="css/daterangepicker.css">
		<link rel="stylesheet" type="text/css" href="css/jquery.mCustomScrollbar.min.css">
		<link rel="stylesheet" type="text/css" href="css/bootstrap-select.css">


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


		<!-- Main Header Your Account -->

		<div class="main-header">
			<div class="content-bg-wrap">
				<div class="content-bg bg-account"></div>
			</div>
			<div class="container">
				<div class="row">
					<div class="col-lg-8 offset-lg-2 col-md-8 offset-md-2 col-sm-12 col-xs-12">
						<div class="main-header-content">
							<h1>Parametre du compte</h1>
							<p>Ici vous allez pouvoir changer votre mot de passe, votre image, activer/désactiver les notifications.
							</p>
						</div>
					</div>
				</div>
			</div>

			<img class="img-bottom" src="img/account-bottom.png" alt="friends">
		</div>

		<!-- ... end Main Header Your Account -->



		<!-- Your Account Personal Information -->

		<div class="container">
			<div class="row">
				<div class="col-xl-9 push-xl-3 col-lg-9 push-lg-3 col-md-12 col-sm-12 col-xs-12">
					<div class="ui-block multitab">
						<div class="ui-block-title">
							<h6 class="title">Parametre du compte</h6>
						</div>
						<div class="ui-block-content">
							<form>
								<div class="row">
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
										<div class="form-group">
											<select class="form-control" size="0" name="statut">
												<option value="0">Changer de leader</option>
												<option value="1">Amélie</option>
												<option value="2">Aurélie</option>
												<option value="3">Catherine</option>
												<option value="4">Edith</option>
												<option value="5">Jennifer</option>
												<option value="6">Julie</option>
												<option value="7">Kévin</option>
												<option value="8">Laure</option>
												<option value="9">Melody</option>
												<option value="10">Quentin</option>
												<option value="11">Tiffany</option>
											</select>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
										<div class="form-group label-floating is-empty">
											<label class="control-label">Confirm New Password</label>
											<input class="form-control" placeholder="" type="password">
											<span class="material-input"></span></div>
										</div>

									</div>
								</form>
							</div>
						</div>
					</div>

					<div class="col-xl-3 pull-xl-9 col-lg-3 pull-lg-9 col-md-12 col-sm-12 col-xs-12 responsive-display-none">
						<div class="ui-block">
							<div class="your-profile">

								<div id="accordion" role="tablist" aria-multiselectable="true">
									<div class="card">
										<div class="card-header" role="tab" id="headingOne">
											<h6 class="mb-0">
												<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
													Parametre profil
													<svg class="olymp-dropdown-arrow-icon"><use xlink:href="icons/icons.svg#olymp-dropdown-arrow-icon"></use></svg>
												</a>
											</h6>
										</div>

										<div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne">
											<ul class="your-profile-menu">
												<li>
													<a href="29-YourAccount-AccountSettings.html">Parametre du compte</a>
												</li>
												<li>
													<a class="changepassword" href="changePassword.html">Changer le mot de passe</a>
												</li>
												<li>
													<a href="30-YourAccount-ChangePassword.html">Notifications</a>
												</li>
											</ul>
										</div>
									</div>
								</div>


							<!--<div class="ui-block-title">
								<a href="34-YourAccount-ChatMessages.html" class="h6 title">Chat / Messages</a>
							</div>
							<div class="ui-block-title">
								<a href="35-YourAccount-FriendsRequests.html" class="h6 title">Friend Requests</a>
								<a href="#" class="items-round-little bg-blue">4</a>
							</div>
							<div class="ui-block-title ui-block-title-small">
								<h6 class="title">FAVOURITE PAGE</h6>
							</div>
							<div class="ui-block-title">
								<a href="36-FavPage-SettingsAndCreatePopup.html" class="h6 title">Create Fav Page</a>
							</div>
							<div class="ui-block-title">
								<a href="36-FavPage-SettingsAndCreatePopup.html" class="h6 title">Fav Page Settings</a>
							</div>-->
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- ... end Your Account Personal Information -->


		<!-- Window-popup-CHAT for responsive min-width: 768px -->

		<div class="ui-block popup-chat popup-chat-responsive">
			<div class="ui-block-title">
				<span class="icon-status online"></span>
				<h6 class="title" >Chat</h6>
				<div class="more">
					<svg class="olymp-three-dots-icon"><use xlink:href="icons/icons.svg#olymp-three-dots-icon"></use></svg>
					<svg class="olymp-little-delete js-chat-open"><use xlink:href="icons/icons.svg#olymp-little-delete"></use></svg>
				</div>
			</div>
			<div class="mCustomScrollbar">
				<ul class="notification-list chat-message chat-message-field">
					<li>
						<div class="author-thumb">
							<img src="img/avatar14-sm.jpg" alt="author" class="mCS_img_loaded">
						</div>
						<div class="notification-event">
							<span class="chat-message-item">Hi James! Please remember to buy the food for tomorrow! I’m gonna be handling the gifts and Jake’s gonna get the drinks</span>
							<span class="notification-date"><time class="entry-date updated" datetime="2004-07-24T18:18">Yesterday at 8:10pm</time></span>
						</div>
					</li>

					<li>
						<div class="author-thumb">
							<img src="img/author-page.jpg" alt="author" class="mCS_img_loaded">
						</div>
						<div class="notification-event">
							<span class="chat-message-item">Don’t worry Mathilda!</span>
							<span class="chat-message-item">I already bought everything</span>
							<span class="notification-date"><time class="entry-date updated" datetime="2004-07-24T18:18">Yesterday at 8:29pm</time></span>
						</div>
					</li>

					<li>
						<div class="author-thumb">
							<img src="img/avatar14-sm.jpg" alt="author" class="mCS_img_loaded">
						</div>
						<div class="notification-event">
							<span class="chat-message-item">Hi James! Please remember to buy the food for tomorrow! I’m gonna be handling the gifts and Jake’s gonna get the drinks</span>
							<span class="notification-date"><time class="entry-date updated" datetime="2004-07-24T18:18">Yesterday at 8:10pm</time></span>
						</div>
					</li>
				</ul>
			</div>

			<form>

				<div class="form-group label-floating is-empty">
					<label class="control-label">Press enter to post...</label>
					<textarea class="form-control" placeholder=""></textarea>
					<div class="add-options-message">
						<a href="#" class="options-message">
							<svg class="olymp-computer-icon"><use xlink:href="icons/icons.svg#olymp-computer-icon"></use></svg>
						</a>
						<div class="options-message smile-block">

							<svg class="olymp-happy-sticker-icon"><use xlink:href="icons/icons.svg#olymp-happy-sticker-icon"></use></svg>

							<ul class="more-dropdown more-with-triangle triangle-bottom-right">
								<li>
									<a href="#">
										<img src="img/icon-chat1.png" alt="icon">
									</a>
								</li>
								<li>
									<a href="#">
										<img src="img/icon-chat2.png" alt="icon">
									</a>
								</li>
								<li>
									<a href="#">
										<img src="img/icon-chat3.png" alt="icon">
									</a>
								</li>
								<li>
									<a href="#">
										<img src="img/icon-chat4.png" alt="icon">
									</a>
								</li>
								<li>
									<a href="#">
										<img src="img/icon-chat5.png" alt="icon">
									</a>
								</li>
								<li>
									<a href="#">
										<img src="img/icon-chat6.png" alt="icon">
									</a>
								</li>
								<li>
									<a href="#">
										<img src="img/icon-chat7.png" alt="icon">
									</a>
								</li>
								<li>
									<a href="#">
										<img src="img/icon-chat8.png" alt="icon">
									</a>
								</li>
								<li>
									<a href="#">
										<img src="img/icon-chat9.png" alt="icon">
									</a>
								</li>
								<li>
									<a href="#">
										<img src="img/icon-chat10.png" alt="icon">
									</a>
								</li>
								<li>
									<a href="#">
										<img src="img/icon-chat11.png" alt="icon">
									</a>
								</li>
								<li>
									<a href="#">
										<img src="img/icon-chat12.png" alt="icon">
									</a>
								</li>
								<li>
									<a href="#">
										<img src="img/icon-chat13.png" alt="icon">
									</a>
								</li>
								<li>
									<a href="#">
										<img src="img/icon-chat14.png" alt="icon">
									</a>
								</li>
								<li>
									<a href="#">
										<img src="img/icon-chat15.png" alt="icon">
									</a>
								</li>
								<li>
									<a href="#">
										<img src="img/icon-chat16.png" alt="icon">
									</a>
								</li>
								<li>
									<a href="#">
										<img src="img/icon-chat17.png" alt="icon">
									</a>
								</li>
								<li>
									<a href="#">
										<img src="img/icon-chat18.png" alt="icon">
									</a>
								</li>
								<li>
									<a href="#">
										<img src="img/icon-chat19.png" alt="icon">
									</a>
								</li>
								<li>
									<a href="#">
										<img src="img/icon-chat20.png" alt="icon">
									</a>
								</li>
								<li>
									<a href="#">
										<img src="img/icon-chat21.png" alt="icon">
									</a>
								</li>
								<li>
									<a href="#">
										<img src="img/icon-chat22.png" alt="icon">
									</a>
								</li>
								<li>
									<a href="#">
										<img src="img/icon-chat23.png" alt="icon">
									</a>
								</li>
								<li>
									<a href="#">
										<img src="img/icon-chat24.png" alt="icon">
									</a>
								</li>
								<li>
									<a href="#">
										<img src="img/icon-chat25.png" alt="icon">
									</a>
								</li>
								<li>
									<a href="#">
										<img src="img/icon-chat26.png" alt="icon">
									</a>
								</li>
								<li>
									<a href="#">
										<img src="img/icon-chat27.png" alt="icon">
									</a>
								</li>
							</ul>
						</div>
					</div>
					<span class="material-input"></span></div>

				</form>


			</div>

			<!-- ... end Window-popup-CHAT for responsive min-width: 768px -->



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

			<!-- Datepicker input field script-->
			<script src="js/moment.min.js"></script>
			<script src="js/daterangepicker.min.js"></script>

			<script src="js/mediaelement-and-player.min.js"></script>
			<script src="js/mediaelement-playlist-plugin.min.js"></script>
			<script src="js/charte.js"></script>

		</body>
		</html>
		<?php }else{
			header('Location: login.php');
		}
		?>