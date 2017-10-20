<?php

// Connexion à la base de donnée et insertion de session_start
include('connexion_session.php');

$id_graph=$_SESSION['id_graph'];
?>
<!DOCTYPE html>
<html lang="en">
<head>

	<title>Badges</title>

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
	<link rel="stylesheet" type="text/css" href="css/swiper.min.css">


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


	<!-- Main Header Badges -->

	<div class="main-header">
		<div class="content-bg-wrap">
			<div class="content-bg bg-badges"></div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 col-md-8 offset-md-2 col-sm-12 col-xs-12">
					<div class="main-header-content">
						<h1>Gagnez des Badges!</h1>
						<p>Profitez de votre imaginations, votre déterminations et vos envies afin d'obtenir le plus de badges possible et ainsi bluffer vos collègues!
						</p>
					</div>
				</div>
			</div>
		</div>

		<img class="img-bottom" src="img/badges-bottom.png" alt="friends">
	</div>

	<!-- ... end Main Header Badges -->


	<!-- Main Content Badges -->

	<div class="container">
		<div class="row">
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">

				<div class="ui-block">
					<div class="birthday-item inline-items badges">
						<div class="author-thumb">
							<img src="img/badge1.png" alt="author">
							<div class="label-avatar bg-primary">2</div>
						</div>
						<div class="birthday-author-name">
							<a href="#" class="h6 author-name">Retour Sans modifications</a>
							<div class="birthday-date">Vous avez effectuer un retour sans modifications, félicitation!</div>
						</div>

						<div class="skills-item">
							<div class="skills-item-meter">
								<span class="skills-item-meter-active" style="width: 76%"></span>
							</div>
						</div>

					</div>
				</div>

				<div class="ui-block">
					<div class="birthday-item inline-items badges">
						<div class="author-thumb">
							<img src="img/badge2.png" alt="author">
						</div>
						<div class="birthday-author-name">
							<a href="#" class="h6 author-name">Site du mois</a>
							<div class="birthday-date">Vous avez été élu meilleur site du mois.</div>
						</div>

						<div class="skills-item">
							<div class="skills-item-meter">
								<span class="skills-item-meter-active" style="width: 100%"></span>
							</div>
						</div>

					</div>
				</div>

				<div class="ui-block">
					<div class="birthday-item inline-items badges">
						<div class="author-thumb">
							<img src="img/badge3.png" alt="author">
							<div class="label-avatar bg-blue">4</div>
						</div>
						<div class="birthday-author-name">
							<a href="#" class="h6 author-name">Meilleure note</a>
							<div class="birthday-date">Vous avez obtenu un 10/10. </div>
						</div>

						<div class="skills-item">
							<div class="skills-item-meter">
								<span class="skills-item-meter-active" style="width: 52%"></span>
							</div>
						</div>

					</div>
				</div>

				<div class="ui-block">
					<div class="birthday-item inline-items badges">
						<div class="author-thumb">
							<img src="img/badge4.png" alt="author">
						</div>
						<div class="birthday-author-name">
							<a href="#" class="h6 author-name">Motivation sans égal</a>
							<div class="birthday-date">Votre motivation et votre dévouement vous qualifie pour une formation.</div>
						</div>

						<div class="skills-item">
							<div class="skills-item-meter">
								<span class="skills-item-meter-active" style="width: 100%"></span>
							</div>
						</div>

					</div>
				</div>

				<div class="ui-block">
					<div class="birthday-item inline-items badges">
						<div class="author-thumb">
							<img src="img/badge5.png" alt="author">
						</div>
						<div class="birthday-author-name">
							<a href="#" class="h6 author-name">Expert Code</a>
							<div class="birthday-date">Vous méttez à disposition régulièrement des bouts de codes.</div>
						</div>

						<div class="skills-item">
							<div class="skills-item-meter">
								<span class="skills-item-meter-active" style="width: 70%"></span>
							</div>
						</div>

					</div>
				</div>

				<div class="ui-block">
					<div class="birthday-item inline-items badges">
						<div class="author-thumb">
							<img src="img/badge6.png" alt="author">
						</div>
						<div class="birthday-author-name">
							<a href="#" class="h6 author-name">Force de proposition wordpress</a>
							<div class="birthday-date">Vous proposez régulièrement des évolutions Wordpress.</div>
						</div>

						<div class="skills-item">
							<div class="skills-item-meter">
								<span class="skills-item-meter-active" style="width: 23%"></span>
							</div>
						</div>

					</div>
				</div>

				<div class="ui-block">
					<div class="birthday-item inline-items badges">
						<div class="author-thumb">
							<img src="img/badge7.png" alt="author">
						</div>
						<div class="birthday-author-name">
							<a href="#" class="h6 author-name">Force de proposition outil</a>
							<div class="birthday-date">Vous proposez régulièrement des évolutions pour cet outil.</div>
						</div>

						<div class="skills-item">
							<div class="skills-item-meter">
								<span class="skills-item-meter-active" style="width: 100%"></span>
							</div>
						</div>

					</div>
				</div>

				<div class="ui-block">
					<div class="birthday-item inline-items badges">
						<div class="author-thumb">
							<img src="img/badge8.png" alt="author">
						</div>
						<div class="birthday-author-name">
							<a href="#" class="h6 author-name">Participation joyeuse</a>
							<div class="birthday-date">Vous participez à de nombreux anniversaires.</div>
						</div>

						<div class="skills-item">
							<div class="skills-item-meter">
								<span class="skills-item-meter-active" style="width: 100%"></span>
							</div>
						</div>

					</div>
				</div>

				<div class="ui-block">
					<div class="birthday-item inline-items badges">
						<div class="author-thumb">
							<img src="img/badge9.png" alt="author">
						</div>
						<div class="birthday-author-name">
							<a href="#" class="h6 author-name">Implication</a>
							<div class="birthday-date">Vous likez un certains nombres d'articles de veille.</div>
						</div>

						<div class="skills-item">
							<div class="skills-item-meter">
								<span class="skills-item-meter-active" style="width: 69%"></span>
							</div>
						</div>

					</div>
				</div>

				<div class="ui-block">
					<div class="birthday-item inline-items badges">
						<div class="author-thumb">
							<img src="img/badge10.png" alt="author">
						</div>
						<div class="birthday-author-name">
							<a href="#" class="h6 author-name">Don de savoir</a>
							<div class="birthday-date">Vous aidez un maximum sur les demandes d'aides.</div>
						</div>

						<div class="skills-item">
							<div class="skills-item-meter">
								<span class="skills-item-meter-active" style="width: 33%"></span>
							</div>
						</div>

					</div>
				</div>

				
			</div>
		</div>
	</div>

	<!-- ... end Main Content Badges -->


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

		<!-- Swiper / Sliders -->
		<script src="js/swiper.jquery.min.js"></script>

		<script src="js/mediaelement-and-player.min.js"></script>
		<script src="js/mediaelement-playlist-plugin.min.js"></script>

	</body>
	</html>
