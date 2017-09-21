	<!DOCTYPE html>
	<html lang="en">
	<head>

		<title>Favorit Page - Events</title>

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

		<!-- Lightbox popup script-->
		<link rel="stylesheet" type="text/css" href="css/magnific-popup.css">


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

		<div class="header-spacer"></div>

		<div class="container">
			<div class="row">
				<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="ui-block">
						<div class="top-header top-header-favorit">
							<div class="top-header-thumb">
								<img src="img/top-header2.jpg" alt="nature">
								<div class="top-header-author">
									<div class="author-thumb">
										<img src="img/author-main2.jpg" alt="author">
									</div>
									<div class="author-content">
										<a href="#" class="h3 author-name">Green Goo Rock</a>
										<div class="country">Rock Band  |  San Francisco, CA</div>
									</div>
								</div>
							</div>
							<div class="profile-section">
								<div class="row">
									<div class="col-xl-8 offset-xl-2 col-lg-8 offset-lg-2 col-md-12 offset-md-0">
										<ul class="profile-menu">
											<li>
												<a href="12-FavouritePage.html">Timeline</a>
											</li>
											<li>
												<a href="13-FavouritePage-About.html">About</a>
											</li>
											<li>
												<a href="07-ProfilePage-Photos.html">Photos</a>
											</li>
											<li>
												<a href="09-ProfilePage-Videos.html">Videos</a>
											</li>
											<li>
												<a href="14-FavouritePage-Statistics.html">Statistics</a>
											</li>
											<li>
												<a href="15-FavouritePage-Events.html" class="active">Events</a>
											</li>
										</ul>
									</div>
								</div>

								<div class="control-block-button">
									<a href="#" class="btn btn-control bg-primary">
										<svg class="olymp-star-icon left-menu-icon"  data-toggle="tooltip" data-placement="right"   data-original-title="FAV PAGE"><use xlink:href="icons/icons.svg#olymp-star-icon"></use></svg>
									</a>

									<a href="#" class="btn btn-control bg-purple">
										<svg class="olymp-chat---messages-icon"><use xlink:href="icons/icons.svg#olymp-chat---messages-icon"></use></svg>
									</a>

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
							<div class="h6 title">Green Goo’s Events</div>
							<a href="#" class="more"><svg class="olymp-three-dots-icon"><use xlink:href="icons/icons.svg#olymp-three-dots-icon"></use></svg></a>
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
							<h6 class="title">UPCOMING EVENTS 2016</h6>
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

			<!-- Lightbox popup script-->
			<script src="js/jquery.magnific-popup.min.js"></script>

			<script src="js/mediaelement-and-player.min.js"></script>
			<script src="js/mediaelement-playlist-plugin.min.js"></script>

		</body>
		</html>