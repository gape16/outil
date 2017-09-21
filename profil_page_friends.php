<!DOCTYPE html>
<html lang="en">
<head>

	<title>Profile Page - Friends</title>

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

	<div class="header-spacer"></div>

	<!-- Top Header -->

	<div class="container">
		<div class="row">
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="ui-block">
					<div class="top-header">
						<div class="top-header-thumb">
							<img src="img/top-header1.jpg" alt="nature">
						</div>
						<div class="profile-section">
							<div class="row">
								<div class="col-lg-5 col-md-5 ">
									<ul class="profile-menu">
										<li>
											<a href="02-ProfilePage.html">Timeline</a>
										</li>
										<li>
											<a href="05-ProfilePage-About.html">About</a>
										</li>
										<li>
											<a href="06-ProfilePage.html" class="active">Friends</a>
										</li>
									</ul>
								</div>
								<div class="col-lg-5 offset-lg-2 col-md-5 offset-md-2">
									<ul class="profile-menu">
										<li>
											<a href="07-ProfilePage-Photos.html">Photos</a>
										</li>
										<li>
											<a href="09-ProfilePage-Videos.html">Videos</a>
										</li>
										<li>
											<div class="more">
												<svg class="olymp-three-dots-icon"><use xlink:href="icons/icons.svg#olymp-three-dots-icon"></use></svg>
												<ul class="more-dropdown more-with-triangle">
													<li>
														<a href="#">Report Profile</a>
													</li>
													<li>
														<a href="#">Block Profile</a>
													</li>
												</ul>
											</div>
										</li>
									</ul>
								</div>
							</div>

							<div class="control-block-button">
								<a href="35-YourAccount-FriendsRequests.html" class="btn btn-control bg-blue">
									<svg class="olymp-happy-face-icon"><use xlink:href="icons/icons.svg#olymp-happy-face-icon"></use></svg>
								</a>

								<a href="#" class="btn btn-control bg-purple">
									<svg class="olymp-chat---messages-icon"><use xlink:href="icons/icons.svg#olymp-chat---messages-icon"></use></svg>
								</a>

								<div class="btn btn-control bg-primary more">
									<svg class="olymp-settings-icon"><use xlink:href="icons/icons.svg#olymp-settings-icon"></use></svg>

									<ul class="more-dropdown more-with-triangle triangle-bottom-right">
										<li>
											<a href="#" data-toggle="modal" data-target="#update-header-photo">Update Profile Photo</a>
										</li>
										<li>
											<a href="#" data-toggle="modal" data-target="#update-header-photo">Update Header Photo</a>
										</li>
										<li>
											<a href="29-YourAccount-AccountSettings.html">Account Settings</a>
										</li>
									</ul>
								</div>
							</div>
						</div>
						<div class="top-header-author">
							<a href="02-ProfilePage.html" class="author-thumb">
								<img src="img/author-main1.jpg" alt="author">
							</a>
							<div class="author-content">
								<a href="02-ProfilePage.html" class="h4 author-name">James Spiegel</a>
								<div class="country">San Francisco, CA</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- ... end Top Header -->

	<div class="container">
		<div class="row">
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="ui-block responsive-flex">
					<div class="ui-block-title">
						<div class="h6 title">James’s Friends (86)</div>
						<form class="w-search">
							<div class="form-group with-button">
								<input class="form-control" type="text" placeholder="Search Friends...">
								<button>
									<svg class="olymp-magnifying-glass-icon"><use xlink:href="icons/icons.svg#olymp-magnifying-glass-icon"></use></svg>
								</button>
							</div>
						</form>
						<a href="#" class="more"><svg class="olymp-three-dots-icon"><use xlink:href="icons/icons.svg#olymp-three-dots-icon"></use></svg></a>
					</div>
				</div>
			</div>
		</div>
	</div>


	<!-- Friends -->

	<div class="container">
		<div class="row">
			<div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-6">
				<div class="ui-block">
					<div class="friend-item">
						<div class="friend-header-thumb">
							<img src="img/friend1.jpg" alt="friend">
						</div>

						<div class="friend-item-content">

							<div class="more">
								<svg class="olymp-three-dots-icon"><use xlink:href="icons/icons.svg#olymp-three-dots-icon"></use></svg>
								<ul class="more-dropdown">
									<li>
										<a href="#">Report Profile</a>
									</li>
									<li>
										<a href="#">Block Profile</a>
									</li>
									<li>
										<a href="#">Turn Off Notifications</a>
									</li>
								</ul>
							</div>
							<div class="friend-avatar">
								<div class="author-thumb">
									<img src="img/avatar1.jpg" alt="author">
								</div>
								<div class="author-content">
									<a href="#" class="h5 author-name">Nicholas Grissom</a>
									<div class="country">San Francisco, CA</div>
								</div>
							</div>

							<div class="swiper-container" data-slide="fade">
								<div class="swiper-wrapper">
									<div class="swiper-slide">
										<div class="friend-count" data-swiper-parallax="-500">
											<a href="#" class="friend-count-item">
												<div class="h6">52</div>
												<div class="title">Friends</div>
											</a>
											<a href="#" class="friend-count-item">
												<div class="h6">240</div>
												<div class="title">Photos</div>
											</a>
											<a href="#" class="friend-count-item">
												<div class="h6">16</div>
												<div class="title">Videos</div>
											</a>
										</div>
										<div class="control-block-button" data-swiper-parallax="-100">
											<a href="#" class="btn btn-control bg-blue">
												<svg class="olymp-happy-face-icon"><use xlink:href="icons/icons.svg#olymp-happy-face-icon"></use></svg>
											</a>

											<a href="#" class="btn btn-control bg-purple">
												<svg class="olymp-chat---messages-icon"><use xlink:href="icons/icons.svg#olymp-chat---messages-icon"></use></svg>
											</a>

										</div>
									</div>

									<div class="swiper-slide">
										<p class="friend-about" data-swiper-parallax="-500">
											Hi!, I’m Marina and I’m a Community Manager for “Gametube”. Gamer and full-time mother.
										</p>

										<div class="friend-since" data-swiper-parallax="-100">
											<span>Friends Since:</span>
											<div class="h6">December 2014</div>
										</div>
									</div>
								</div>

								<!-- If we need pagination -->
								<div class="swiper-pagination"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-6">
				<div class="ui-block">
					<div class="friend-item">
						<div class="friend-header-thumb">
							<img src="img/friend2.jpg" alt="friend">
						</div>

						<div class="friend-item-content">

							<div class="more">
								<svg class="olymp-three-dots-icon"><use xlink:href="icons/icons.svg#olymp-three-dots-icon"></use></svg>
								<ul class="more-dropdown">
									<li>
										<a href="#">Report Profile</a>
									</li>
									<li>
										<a href="#">Block Profile</a>
									</li>
									<li>
										<a href="#">Turn Off Notifications</a>
									</li>
								</ul>
							</div>
							<div class="friend-avatar">
								<div class="author-thumb">
									<img src="img/avatar2.jpg" alt="author">
								</div>
								<div class="author-content">
									<a href="#" class="h5 author-name">Marina Valentine</a>
									<div class="country">Long Island, NY</div>
								</div>
							</div>

							<div class="swiper-container">
								<div class="swiper-wrapper">
									<div class="swiper-slide">
										<div class="friend-count" data-swiper-parallax="-500">
											<a href="#" class="friend-count-item">
												<div class="h6">52</div>
												<div class="title">Friends</div>
											</a>
											<a href="#" class="friend-count-item">
												<div class="h6">240</div>
												<div class="title">Photos</div>
											</a>
											<a href="#" class="friend-count-item">
												<div class="h6">16</div>
												<div class="title">Videos</div>
											</a>
										</div>
										<div class="control-block-button" data-swiper-parallax="-100">
											<a href="#" class="btn btn-control bg-blue">
												<svg class="olymp-happy-face-icon"><use xlink:href="icons/icons.svg#olymp-happy-face-icon"></use></svg>
											</a>

											<a href="#" class="btn btn-control bg-purple">
												<svg class="olymp-chat---messages-icon"><use xlink:href="icons/icons.svg#olymp-chat---messages-icon"></use></svg>
											</a>

										</div>
									</div>

									<div class="swiper-slide">
										<p class="friend-about" data-swiper-parallax="-500">
											Hi!, I’m Marina and I’m a Community Manager for “Gametube”. Gamer and full-time mother.
										</p>

										<div class="friend-since" data-swiper-parallax="-100">
											<span>Friends Since:</span>
											<div class="h6">December 2014</div>
										</div>
									</div>
								</div>

								<!-- If we need pagination -->
								<div class="swiper-pagination"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-6">
				<div class="ui-block">
					<div class="friend-item">
						<div class="friend-header-thumb">
							<img src="img/friend3.jpg" alt="friend">
						</div>

						<div class="friend-item-content">

							<div class="more">
								<svg class="olymp-three-dots-icon"><use xlink:href="icons/icons.svg#olymp-three-dots-icon"></use></svg>
								<ul class="more-dropdown">
									<li>
										<a href="#">Report Profile</a>
									</li>
									<li>
										<a href="#">Block Profile</a>
									</li>
									<li>
										<a href="#">Turn Off Notifications</a>
									</li>
								</ul>
							</div>
							<div class="friend-avatar">
								<div class="author-thumb">
									<img src="img/avatar3.jpg" alt="author">
								</div>
								<div class="author-content">
									<a href="#" class="h5 author-name">Nicholas Grissom</a>
									<div class="country">Los Angeles, CA</div>
								</div>
							</div>

							<div class="swiper-container">
								<div class="swiper-wrapper">
									<div class="swiper-slide">
										<div class="friend-count" data-swiper-parallax="-500">
											<a href="#" class="friend-count-item">
												<div class="h6">49</div>
												<div class="title">Friends</div>
											</a>
											<a href="#" class="friend-count-item">
												<div class="h6">132</div>
												<div class="title">Photos</div>
											</a>
											<a href="#" class="friend-count-item">
												<div class="h6">5</div>
												<div class="title">Videos</div>
											</a>
										</div>
										<div class="control-block-button" data-swiper-parallax="-100">
											<a href="#" class="btn btn-control bg-blue">
												<svg class="olymp-happy-face-icon"><use xlink:href="icons/icons.svg#olymp-happy-face-icon"></use></svg>
											</a>

											<a href="#" class="btn btn-control bg-purple">
												<svg class="olymp-chat---messages-icon"><use xlink:href="icons/icons.svg#olymp-chat---messages-icon"></use></svg>
											</a>

										</div>
									</div>

									<div class="swiper-slide">
										<p class="friend-about" data-swiper-parallax="-500">
											Hi!, I’m Marina and I’m a Community Manager for “Gametube”. Gamer and full-time mother.
										</p>

										<div class="friend-since" data-swiper-parallax="-100">
											<span>Friends Since:</span>
											<div class="h6">December 2014</div>
										</div>
									</div>
								</div>

								<!-- If we need pagination -->
								<div class="swiper-pagination"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-6">
				<div class="ui-block">
					<div class="friend-item">
						<div class="friend-header-thumb">
							<img src="img/friend4.jpg" alt="friend">
						</div>

						<div class="friend-item-content">
							<div class="more">
								<svg class="olymp-three-dots-icon"><use xlink:href="icons/icons.svg#olymp-three-dots-icon"></use></svg>
								<ul class="more-dropdown">
									<li>
										<a href="#">Report Profile</a>
									</li>
									<li>
										<a href="#">Block Profile</a>
									</li>
									<li>
										<a href="#">Turn Off Notifications</a>
									</li>
								</ul>
							</div>

							<div class="friend-avatar">
								<div class="author-thumb">
									<img src="img/avatar4.jpg" alt="author">
								</div>
								<div class="author-content">
									<a href="#" class="h5 author-name">Chris Greyson</a>
									<div class="country">Austin, TX</div>
								</div>
							</div>

							<div class="swiper-container">
								<div class="swiper-wrapper">
									<div class="swiper-slide">
										<div class="friend-count" data-swiper-parallax="-500">
											<a href="#" class="friend-count-item">
												<div class="h6">65</div>
												<div class="title">Friends</div>
											</a>
											<a href="#" class="friend-count-item">
												<div class="h6">104</div>
												<div class="title">Photos</div>
											</a>
											<a href="#" class="friend-count-item">
												<div class="h6">12</div>
												<div class="title">Videos</div>
											</a>
										</div>
										<div class="control-block-button" data-swiper-parallax="-100">
											<a href="#" class="btn btn-control bg-blue">
												<svg class="olymp-happy-face-icon"><use xlink:href="icons/icons.svg#olymp-happy-face-icon"></use></svg>
											</a>

											<a href="#" class="btn btn-control bg-purple">
												<svg class="olymp-chat---messages-icon"><use xlink:href="icons/icons.svg#olymp-chat---messages-icon"></use></svg>
											</a>

										</div>
									</div>

									<div class="swiper-slide">
										<p class="friend-about" data-swiper-parallax="-500">
											Hi!, I’m Marina and I’m a Community Manager for “Gametube”. Gamer and full-time mother.
										</p>

										<div class="friend-since" data-swiper-parallax="-100">
											<span>Friends Since:</span>
											<div class="h6">December 2014</div>
										</div>
									</div>
								</div>

								<!-- If we need pagination -->
								<div class="swiper-pagination"></div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-6">
				<div class="ui-block">
					<div class="friend-item">
						<div class="friend-header-thumb">
							<img src="img/friend5.jpg" alt="friend">
						</div>

						<div class="friend-item-content">

							<div class="more">
								<svg class="olymp-three-dots-icon"><use xlink:href="icons/icons.svg#olymp-three-dots-icon"></use></svg>
								<ul class="more-dropdown">
									<li>
										<a href="#">Report Profile</a>
									</li>
									<li>
										<a href="#">Block Profile</a>
									</li>
									<li>
										<a href="#">Turn Off Notifications</a>
									</li>
								</ul>
							</div>
							<div class="friend-avatar">
								<div class="author-thumb">
									<img src="img/avatar5.jpg" alt="author">
								</div>
								<div class="author-content">
									<a href="#" class="h5 author-name">Elaine Dreifuss</a>
									<div class="country">New York, NY</div>
								</div>
							</div>

							<div class="swiper-container">
								<div class="swiper-wrapper">
									<div class="swiper-slide">
										<div class="friend-count" data-swiper-parallax="-500">
											<a href="#" class="friend-count-item">
												<div class="h6">82</div>
												<div class="title">Friends</div>
											</a>
											<a href="#" class="friend-count-item">
												<div class="h6">204</div>
												<div class="title">Photos</div>
											</a>
											<a href="#" class="friend-count-item">
												<div class="h6">27</div>
												<div class="title">Videos</div>
											</a>
										</div>
										<div class="control-block-button" data-swiper-parallax="-100">
											<a href="#" class="btn btn-control bg-blue">
												<svg class="olymp-happy-face-icon"><use xlink:href="icons/icons.svg#olymp-happy-face-icon"></use></svg>
											</a>

											<a href="#" class="btn btn-control bg-purple">
												<svg class="olymp-chat---messages-icon"><use xlink:href="icons/icons.svg#olymp-chat---messages-icon"></use></svg>
											</a>

										</div>
									</div>

									<div class="swiper-slide">
										<p class="friend-about" data-swiper-parallax="-500">
											Hi!, I’m Marina and I’m a Community Manager for “Gametube”. Gamer and full-time mother.
										</p>

										<div class="friend-since" data-swiper-parallax="-100">
											<span>Friends Since:</span>
											<div class="h6">December 2014</div>
										</div>
									</div>
								</div>

								<!-- If we need pagination -->
								<div class="swiper-pagination"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-6">
				<div class="ui-block">
					<div class="friend-item">
						<div class="friend-header-thumb">
							<img src="img/friend6.jpg" alt="friend">
						</div>

						<div class="friend-item-content">

							<div class="more">
								<svg class="olymp-three-dots-icon"><use xlink:href="icons/icons.svg#olymp-three-dots-icon"></use></svg>
								<ul class="more-dropdown">
									<li>
										<a href="#">Report Profile</a>
									</li>
									<li>
										<a href="#">Block Profile</a>
									</li>
									<li>
										<a href="#">Turn Off Notifications</a>
									</li>
								</ul>
							</div>
							<div class="friend-avatar">
								<div class="author-thumb">
									<img src="img/avatar6.jpg" alt="author">
								</div>
								<div class="author-content">
									<a href="#" class="h5 author-name">Bruce Peterson</a>
									<div class="country">Austin, TX</div>
								</div>
							</div>

							<div class="swiper-container">
								<div class="swiper-wrapper">
									<div class="swiper-slide">
										<div class="friend-count" data-swiper-parallax="-500">
											<a href="#" class="friend-count-item">
												<div class="h6">73</div>
												<div class="title">Friends</div>
											</a>
											<a href="#" class="friend-count-item">
												<div class="h6">360</div>
												<div class="title">Photos</div>
											</a>
											<a href="#" class="friend-count-item">
												<div class="h6">11</div>
												<div class="title">Videos</div>
											</a>
										</div>
										<div class="control-block-button" data-swiper-parallax="-100">
											<a href="#" class="btn btn-control bg-blue">
												<svg class="olymp-happy-face-icon"><use xlink:href="icons/icons.svg#olymp-happy-face-icon"></use></svg>
											</a>

											<a href="#" class="btn btn-control bg-purple">
												<svg class="olymp-chat---messages-icon"><use xlink:href="icons/icons.svg#olymp-chat---messages-icon"></use></svg>
											</a>

										</div>
									</div>

									<div class="swiper-slide">
										<p class="friend-about" data-swiper-parallax="-500">
											Hi!, I’m Marina and I’m a Community Manager for “Gametube”. Gamer and full-time mother.
										</p>

										<div class="friend-since" data-swiper-parallax="-100">
											<span>Friends Since:</span>
											<div class="h6">December 2014</div>
										</div>
									</div>
								</div>

								<!-- If we need pagination -->
								<div class="swiper-pagination"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-6">
				<div class="ui-block">
					<div class="friend-item">
						<div class="friend-header-thumb">
							<img src="img/friend7.jpg" alt="friend">
						</div>

						<div class="friend-item-content">

							<div class="more">
								<svg class="olymp-three-dots-icon"><use xlink:href="icons/icons.svg#olymp-three-dots-icon"></use></svg>
								<ul class="more-dropdown">
									<li>
										<a href="#">Report Profile</a>
									</li>
									<li>
										<a href="#">Block Profile</a>
									</li>
									<li>
										<a href="#">Turn Off Notifications</a>
									</li>
								</ul>
							</div>
							<div class="friend-avatar">
								<div class="author-thumb">
									<img src="img/avatar7.jpg" alt="author">
								</div>
								<div class="author-content">
									<a href="#" class="h5 author-name">Carol Summers</a>
									<div class="country">Los Angeles, CA</div>
								</div>
							</div>

							<div class="swiper-container">
								<div class="swiper-wrapper">
									<div class="swiper-slide">
										<div class="friend-count" data-swiper-parallax="-500">
											<a href="#" class="friend-count-item">
												<div class="h6">49</div>
												<div class="title">Friends</div>
											</a>
											<a href="#" class="friend-count-item">
												<div class="h6">132</div>
												<div class="title">Photos</div>
											</a>
											<a href="#" class="friend-count-item">
												<div class="h6">5</div>
												<div class="title">Videos</div>
											</a>
										</div>
										<div class="control-block-button" data-swiper-parallax="-100">
											<a href="#" class="btn btn-control bg-blue">
												<svg class="olymp-happy-face-icon"><use xlink:href="icons/icons.svg#olymp-happy-face-icon"></use></svg>
											</a>

											<a href="#" class="btn btn-control bg-purple">
												<svg class="olymp-chat---messages-icon"><use xlink:href="icons/icons.svg#olymp-chat---messages-icon"></use></svg>
											</a>

										</div>
									</div>

									<div class="swiper-slide">
										<p class="friend-about" data-swiper-parallax="-500">
											Hi!, I’m Marina and I’m a Community Manager for “Gametube”. Gamer and full-time mother.
										</p>

										<div class="friend-since" data-swiper-parallax="-100">
											<span>Friends Since:</span>
											<div class="h6">December 2014</div>
										</div>
									</div>
								</div>

								<!-- If we need pagination -->
								<div class="swiper-pagination"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-6">
				<div class="ui-block">
					<div class="friend-item">
						<div class="friend-header-thumb">
							<img src="img/friend8.jpg" alt="friend">
						</div>

						<div class="friend-item-content">
							<div class="more">
								<svg class="olymp-three-dots-icon"><use xlink:href="icons/icons.svg#olymp-three-dots-icon"></use></svg>
								<ul class="more-dropdown">
									<li>
										<a href="#">Report Profile</a>
									</li>
									<li>
										<a href="#">Block Profile</a>
									</li>
									<li>
										<a href="#">Turn Off Notifications</a>
									</li>
								</ul>
							</div>

							<div class="friend-avatar">
								<div class="author-thumb">
									<img src="img/avatar8.jpg" alt="author">
								</div>
								<div class="author-content">
									<a href="#" class="h5 author-name">Michael Maximoff</a>
									<div class="country">Portland, OR</div>
								</div>
							</div>

							<div class="swiper-container">
								<div class="swiper-wrapper">
									<div class="swiper-slide">
										<div class="friend-count" data-swiper-parallax="-500">
											<a href="#" class="friend-count-item">
												<div class="h6">58</div>
												<div class="title">Friends</div>
											</a>
											<a href="#" class="friend-count-item">
												<div class="h6">304</div>
												<div class="title">Photos</div>
											</a>
											<a href="#" class="friend-count-item">
												<div class="h6">19</div>
												<div class="title">Videos</div>
											</a>
										</div>
										<div class="control-block-button" data-swiper-parallax="-100">
											<a href="#" class="btn btn-control bg-blue">
												<svg class="olymp-happy-face-icon"><use xlink:href="icons/icons.svg#olymp-happy-face-icon"></use></svg>
											</a>

											<a href="#" class="btn btn-control bg-purple">
												<svg class="olymp-chat---messages-icon"><use xlink:href="icons/icons.svg#olymp-chat---messages-icon"></use></svg>
											</a>

										</div>
									</div>

									<div class="swiper-slide">
										<p class="friend-about" data-swiper-parallax="-500">
											Hi!, I’m Marina and I’m a Community Manager for “Gametube”. Gamer and full-time mother.
										</p>

										<div class="friend-since" data-swiper-parallax="-100">
											<span>Friends Since:</span>
											<div class="h6">December 2014</div>
										</div>
									</div>
								</div>

								<!-- If we need pagination -->
								<div class="swiper-pagination"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- ... end Friends -->



	<!-- Window-popup Update Header Photo -->

	<div class="modal fade" id="update-header-photo">
		<div class="modal-dialog ui-block window-popup update-header-photo">
			<a href="#" class="close icon-close" data-dismiss="modal" aria-label="Close">
				<svg class="olymp-close-icon"><use xlink:href="icons/icons.svg#olymp-close-icon"></use></svg>
			</a>

			<div class="ui-block-title">
				<h6 class="title">Update Header Photo</h6>
			</div>

			<a href="#" class="upload-photo-item">
				<svg class="olymp-computer-icon"><use xlink:href="icons/icons.svg#olymp-computer-icon"></use></svg>

				<h6>Upload Photo</h6>
				<span>Browse your computer.</span>
			</a>

			<a href="#" class="upload-photo-item" data-toggle="modal" data-target="#choose-from-my-photo">

				<svg class="olymp-photos-icon"><use xlink:href="icons/icons.svg#olymp-photos-icon"></use></svg>

				<h6>Choose from My Photos</h6>
				<span>Choose from your uploaded photos</span>
			</a>
		</div>
	</div>


	<!-- ... end Window-popup Update Header Photo -->


	<!-- Window-popup Choose from my Photo -->
	<div class="modal fade" id="choose-from-my-photo">
		<div class="modal-dialog ui-block window-popup choose-from-my-photo">
			<a href="#" class="close icon-close" data-dismiss="modal" aria-label="Close">
				<svg class="olymp-close-icon"><use xlink:href="icons/icons.svg#olymp-close-icon"></use></svg>
			</a>

			<div class="ui-block-title">
				<h6 class="title">Choose from My Photos</h6>

				<!-- Nav tabs -->
				<ul class="nav nav-tabs" role="tablist">
					<li class="nav-item">
						<a class="nav-link active" data-toggle="tab" href="#home" role="tab" aria-expanded="true">
							<svg class="olymp-photos-icon"><use xlink:href="icons/icons.svg#olymp-photos-icon"></use></svg>
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#profile" role="tab" aria-expanded="false">
							<svg class="olymp-albums-icon"><use xlink:href="icons/icons.svg#olymp-albums-icon"></use></svg>
						</a>
					</li>
				</ul>
			</div>


			<div class="ui-block-content">
				<!-- Tab panes -->
				<div class="tab-content">
					<div class="tab-pane active" id="home" role="tabpanel" aria-expanded="true">

						<div class="choose-photo-item" data-mh="choose-item">
							<div class="radio">
								<label class="custom-radio">
									<img src="img/choose-photo1.jpg" alt="photo">
									<input type="radio" name="optionsRadios">
								</label>
							</div>
						</div>
						<div class="choose-photo-item" data-mh="choose-item">
							<div class="radio">
								<label class="custom-radio">
									<img src="img/choose-photo2.jpg" alt="photo">
									<input type="radio" name="optionsRadios">
								</label>
							</div>
						</div>
						<div class="choose-photo-item" data-mh="choose-item">
							<div class="radio">
								<label class="custom-radio">
									<img src="img/choose-photo3.jpg" alt="photo">
									<input type="radio" name="optionsRadios">
								</label>
							</div>
						</div>

						<div class="choose-photo-item" data-mh="choose-item">
							<div class="radio">
								<label class="custom-radio">
									<img src="img/choose-photo4.jpg" alt="photo">
									<input type="radio" name="optionsRadios">
								</label>
							</div>
						</div>
						<div class="choose-photo-item" data-mh="choose-item">
							<div class="radio">
								<label class="custom-radio">
									<img src="img/choose-photo5.jpg" alt="photo">
									<input type="radio" name="optionsRadios">
								</label>
							</div>
						</div>
						<div class="choose-photo-item" data-mh="choose-item">
							<div class="radio">
								<label class="custom-radio">
									<img src="img/choose-photo6.jpg" alt="photo">
									<input type="radio" name="optionsRadios">
								</label>
							</div>
						</div>

						<div class="choose-photo-item" data-mh="choose-item">
							<div class="radio">
								<label class="custom-radio">
									<img src="img/choose-photo7.jpg" alt="photo">
									<input type="radio" name="optionsRadios">
								</label>
							</div>
						</div>
						<div class="choose-photo-item" data-mh="choose-item">
							<div class="radio">
								<label class="custom-radio">
									<img src="img/choose-photo8.jpg" alt="photo">
									<input type="radio" name="optionsRadios">
								</label>
							</div>
						</div>
						<div class="choose-photo-item" data-mh="choose-item">
							<div class="radio">
								<label class="custom-radio">
									<img src="img/choose-photo9.jpg" alt="photo">
									<input type="radio" name="optionsRadios">
								</label>
							</div>
						</div>


						<a href="#" class="btn btn-secondary btn-lg btn--half-width">Cancel</a>
						<a href="#" class="btn btn-primary btn-lg btn--half-width">Confirm Photo</a>

					</div>
					<div class="tab-pane" id="profile" role="tabpanel" aria-expanded="false">

						<div class="choose-photo-item" data-mh="choose-item">
							<figure>
								<img src="img/choose-photo10.jpg" alt="photo">
								<figcaption>
									<a href="#">South America Vacations</a>
									<span>Last Added: 2 hours ago</span>
								</figcaption>
							</figure>
						</div>
						<div class="choose-photo-item" data-mh="choose-item">
							<figure>
								<img src="img/choose-photo11.jpg" alt="photo">
								<figcaption>
									<a href="#">Photoshoot Summer 2016</a>
									<span>Last Added: 5 weeks ago</span>
								</figcaption>
							</figure>
						</div>
						<div class="choose-photo-item" data-mh="choose-item">
							<figure>
								<img src="img/choose-photo12.jpg" alt="photo">
								<figcaption>
									<a href="#">Amazing Street Food</a>
									<span>Last Added: 6 mins ago</span>
								</figcaption>
							</figure>
						</div>

						<div class="choose-photo-item" data-mh="choose-item">
							<figure>
								<img src="img/choose-photo13.jpg" alt="photo">
								<figcaption>
									<a href="#">Graffity & Street Art</a>
									<span>Last Added: 16 hours ago</span>
								</figcaption>
							</figure>
						</div>
						<div class="choose-photo-item" data-mh="choose-item">
							<figure>
								<img src="img/choose-photo14.jpg" alt="photo">
								<figcaption>
									<a href="#">Amazing Landscapes</a>
									<span>Last Added: 13 mins ago</span>
								</figcaption>
							</figure>
						</div>
						<div class="choose-photo-item" data-mh="choose-item">
							<figure>
								<img src="img/choose-photo15.jpg" alt="photo">
								<figcaption>
									<a href="#">The Majestic Canyon</a>
									<span>Last Added: 57 mins ago</span>
								</figcaption>
							</figure>
						</div>


						<a href="#" class="btn btn-secondary btn-lg btn--half-width">Cancel</a>
						<a href="#" class="btn btn-primary btn-lg disabled btn--half-width">Confirm Photo</a>
					</div>
				</div>
			</div>

		</div>
	</div>

	<!-- ... end Window-popup Choose from my Photo -->

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