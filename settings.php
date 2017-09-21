<!DOCTYPE html>
<html lang="en">
<head>

	<title>Fav Page - Settings And Create Popup</title>

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
						<h1>Your Account Dashboard</h1>
						<p>Welcome to your account dashboard! Here you’ll find everything you need to change your
							profile information, settings, read notifications and requests, view your latest messages,
							change your pasword and much more! Also you can create or manage your own favourite page, have fun!
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
				<div class="ui-block">
					<div class="ui-block-title">
						<h6 class="title">Favorite Page Information</h6>
					</div>
					<div class="ui-block-content">
						<form>
							<div class="row">
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group label-floating">
										<label class="control-label">First Name</label>
										<input class="form-control" placeholder="" type="text" value="Green Goo">
									</div>

									<div class="form-group label-floating">
										<label class="control-label">Your Email</label>
										<input class="form-control" placeholder="" type="email" value="greengoo_gigs@yourmail.com">
									</div>

									<div class="form-group date-time-picker label-floating">
										<label class="control-label">Since</label>
										<input name="datetimepicker" value="10/24/1984" />
										<span class="input-group-addon">
											<svg class="olymp-calendar-icon icon"><use xlink:href="icons/icons.svg#olymp-calendar-icon"></use></svg>
										</span>
									</div>
								</div>

								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group label-floating">
										<label class="control-label">Last Name</label>
										<input class="form-control" placeholder="" type="text" value="Rock">
									</div>

									<div class="form-group label-floating">
										<label class="control-label">Your Website</label>
										<input class="form-control" placeholder="" type="email" value="www.ggrock.com">
									</div>


									<div class="form-group label-floating">
										<label class="control-label">Your Phone Number</label>
										<input class="form-control" placeholder="" type="text">
									</div>
								</div>

								<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
									<div class="form-group label-floating is-select">
										<label class="control-label">Your Country</label>
										<select class="selectpicker form-control" size="auto">
											<option value="US">United States</option>
											<option value="AU">Australia</option>
										</select>
									</div>
								</div>
								<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
									<div class="form-group label-floating is-select">
										<label class="control-label">Your State / Province</label>
										<select class="selectpicker form-control" size="auto">
											<option value="CA">California</option>
											<option value="TE">Texas</option>
										</select>
									</div>
								</div>
								<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
									<div class="form-group label-floating is-select">
										<label class="control-label">Your City</label>
										<select class="selectpicker form-control" size="auto">
											<option value="SF">San Francisco</option>
											<option value="NY">New York</option>
										</select>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group label-floating">
										<label class="control-label">Write a little description about the page</label>
										<textarea class="form-control" placeholder="">We are Rock Band from Los Angeles, now based in San Francisco, come and listen to us play!</textarea>
									</div>
								</div>

								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

									<div class="form-group label-floating is-empty">
										<label class="control-label">Based In</label>
										<input class="form-control" placeholder="" type="text">
									</div>

									<div class="form-group label-floating is-select">
										<label class="control-label">Category</label>
										<select class="selectpicker form-control" size="auto">
											<option value="MA">Rock Band</option>
											<option value="FE">Pop Band</option>
											<option value="FE">Jazz Band</option>
										</select>
									</div>
								</div>

								<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
									<div class="form-group label-floating">
										<label class="control-label">Additional Info</label>
										<textarea class="form-control" placeholder="" >We are open for gigs all over the country. If you are interested, please contact us via our website or send us an email to gigs@ggrock.com</textarea>
									</div>
								</div>

								<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
									<div class="form-group with-icon label-floating">
										<label class="control-label">Your Facebook Account</label>
										<input class="form-control" type="text" value="www.facebook.com/greengoo_rock">
										<i class="fa fa-facebook c-facebook" aria-hidden="true"></i>
									</div>
									<div class="form-group with-icon label-floating">
										<label class="control-label">Your Twitter Account</label>
										<input class="form-control" type="text" value="www.twitter.com/greengoo_rock">
										<i class="fa fa-twitter c-twitter" aria-hidden="true"></i>
									</div>
									<div class="form-group with-icon label-floating is-empty">
										<label class="control-label">Your RSS Feed Account</label>
										<input class="form-control" type="text">
										<i class="fa fa-rss c-rss" aria-hidden="true"></i>
									</div>
									<div class="form-group with-icon label-floating is-empty">
										<label class="control-label">Your Dribbble Account</label>
										<input class="form-control" type="text" value="">
										<i class="fa fa-dribbble c-dribbble" aria-hidden="true"></i>
									</div>
									<div class="form-group with-icon label-floating">
										<label class="control-label">Your Spotify Account</label>
										<input class="form-control" type="text" value="green_goo@spotify.com">
										<i class="fa fa-spotify c-spotify" aria-hidden="true"></i>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<a href="#" class="btn btn-secondary btn-lg full-width">Restore all Attributes</a>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<a href="#" class="btn btn-primary btn-lg full-width">Save all Changes</a>
								</div>
							</div>
						</form>
					</div>
				</div>

				<div class="ui-block">
					<div class="ui-block-title">
						<h6 class="title">Favourite Page Settings</h6>
					</div>
					<div class="ui-block-content">
						<form>
							<div class="row">

								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group label-floating is-select">
										<label class="control-label">Who Can Friend You?</label>
										<select class="selectpicker form-control" size="auto">
											<option value="EO">Everyone</option>
											<option value="NO">No One</option>
										</select>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group label-floating is-select">
										<label class="control-label">Who Can View Your Posts</label>
										<select class="selectpicker form-control" size="auto">
											<option value="US">Friends Only</option>
											<option value="EO">Everyone</option>
										</select>
									</div>
								</div>

								<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
									<div class="description-toggle">
										<div class="description-toggle-content">
											<div class="h6">Notifications Sound</div>
											<p>A sound will be played each time you receive a new activity notification</p>
										</div>

										<div class="togglebutton">
											<label>
												<input type="checkbox" checked="">
											</label>
										</div>
									</div>
									<div class="description-toggle">
										<div class="description-toggle-content">
											<div class="h6">Notifications Email</div>
											<p>We’ll send you an email to your account each time you receive a new activity notification</p>
										</div>

										<div class="togglebutton">
											<label>
												<input type="checkbox" checked="">
											</label>
										</div>
									</div>
									<div class="description-toggle">
										<div class="description-toggle-content">
											<div class="h6">Friend’s Birthdays</div>
											<p>Choose wheather or not receive notifications about your friend’s birthdays on your newsfeed</p>
										</div>

										<div class="togglebutton">
											<label>
												<input type="checkbox" checked="">
											</label>
										</div>
									</div>
									<div class="description-toggle">
										<div class="description-toggle-content">
											<div class="h6">Chat Message Sound</div>
											<p>A sound will be played each time you receive a new message on an inactive chat window</p>
										</div>

										<div class="togglebutton">
											<label>
												<input type="checkbox" checked="">
											</label>
										</div>
									</div>
								</div>

								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<a href="#" class="btn btn-secondary btn-lg full-width">Restore all Attributes</a>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<a href="#" class="btn btn-primary btn-lg full-width">Save all Changes</a>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>

			<div class="col-xl-3 pull-xl-9 col-lg-3 pull-lg-9 col-md-12 col-sm-12 col-xs-12 responsive-display-none">
				<div class="ui-block">
					<div class="your-profile">
						<div class="ui-block-title ui-block-title-small">
							<h6 class="title">Your PROFILE</h6>
						</div>

						<div id="accordion" role="tablist" aria-multiselectable="true">
							<div class="card">
								<div class="card-header" role="tab" id="headingOne">
									<h6 class="mb-0">
										<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
											Profile Settings
											<svg class="olymp-dropdown-arrow-icon"><use xlink:href="icons/icons.svg#olymp-dropdown-arrow-icon"></use></svg>
										</a>
									</h6>
								</div>

								<div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne">
									<ul class="your-profile-menu">
										<li>
											<a href="28-YourAccount-PersonalInformation.html">Personal Information</a>
										</li>
										<li>
											<a href="29-YourAccount-AccountSettings.html">Account Settings</a>
										</li>
										<li>
											<a href="30-YourAccount-ChangePassword.html">Change Password</a>
										</li>
										<li>
											<a href="31-YourAccount-HobbiesAndInterests.html">Hobbies and Interests</a>
										</li>
										<li>
											<a href="32-YourAccount-EducationAndEmployement.html">Education and Employement</a>
										</li>
									</ul>
								</div>
							</div>
						</div>


						<div class="ui-block-title">
							<a href="33-YourAccount-Notifications.html" class="h6 title">Notifications</a>
							<a href="#" class="items-round-little bg-primary">8</a>
						</div>
						<div class="ui-block-title">
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
							<a href="#" class="h6 title" data-toggle="modal" data-target="#fav-page-popup">Create Fav Page</a>
						</div>
						<div class="ui-block-title">
							<a href="36-FavPage-SettingsAndCreatePopup.html" class="h6 title">Fav Page Settings</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- ... end Your Account Personal Information -->


	<!-- Window Popup Favourite Page -->

	<div class="modal fade" id="fav-page-popup">
		<div class="modal-dialog ui-block window-popup fav-page-popup">
			<a href="#" class="close icon-close" data-dismiss="modal" aria-label="Close">
				<svg class="olymp-close-icon"><use xlink:href="icons/icons.svg#olymp-close-icon"></use></svg>
			</a>

			<div class="ui-block-title">
				<h6 class="title">Create Favourite Page</h6>
			</div>

			<div class="ui-block-content">
				<form>
					<div class="row">
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<div class="form-group label-floating is-empty">
								<label class="control-label">First Name</label>
								<input class="form-control" placeholder="" type="text" value="Green Goo">
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<div class="form-group label-floating is-empty">
								<label class="control-label">Last Name</label>
								<input class="form-control" placeholder="" type="text" value="Rock">
							</div>
						</div>
						<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="form-group label-floating is-empty">
								<label class="control-label">Your Email</label>
								<input class="form-control" placeholder="" type="email" value="greengoo_gigs@yourmail.com">
							</div>

							<div class="form-group label-floating is-empty">
								<label class="control-label">Your Website</label>
								<input class="form-control" placeholder="" type="email" value="www.ggrock.com">
							</div>

							<div class="form-group label-floating is-select">
								<label class="control-label">Category</label>
								<select class="selectpicker form-control" size="auto">
									<option value="MA">Rock Band</option>
									<option value="FE">Pop Band</option>
									<option value="FE">Jazz Band</option>
								</select>
							</div>

							<div class="form-group label-floating is-empty">
								<label class="control-label">Write a little description about the page</label>
								<textarea class="form-control" placeholder="">We are Rock Band from Los Angeles, now based in San Francisco, come and listen to us play!</textarea>
							</div>

							<div class="form-group label-floating is-select">
								<label class="control-label">Invite Friends</label>
								<select class="selectpicker form-control" multiple>
									<option value="MB" selected>Mathilda Brinker</option>
									<option value="NG" selected>Nicholas Grissom</option>
									<option value="TS">Tony Stevens</option>
								</select>
							</div>

							<button class="btn btn-primary btn-lg full-width">Create Favourite Page</button>
						</div>


					</div>

				</form>
			</div>

		</div>
	</div>

	<!-- ... end Window Popup Favourite Page -->



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


	</body>
	</html>
