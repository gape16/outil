<!DOCTYPE html>
<html lang="en">
<head>

	<title>Favorit Page - About</title>

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
											<a href="13-FavouritePage-About.html" class="active">About</a>
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
											<a href="15-FavouritePage-Events.html">Events</a>
										</li>
									</ul>
								</div>
							</div>

							<div class="control-block-button">
								<a href="#" class="btn btn-control bg-primary">
									<svg class="olymp-star-icon"><use xlink:href="icons/icons.svg#olymp-star-icon"></use></svg>
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
			<div class="col-xl-9 push-xl-3 col-lg-12 push-lg-0 col-md-12 col-sm-12 col-xs-12">
				<div class="ui-block responsive-flex">
					<div class="ui-block-title">
						<div class="h6 title">Green Goo’s Favers (5630)</div>
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

				<div class="row">
					<div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
						<div class="ui-block">
							<div class="friend-item">
								<div class="friend-header-thumb">
									<img src="img/friend9.jpg" alt="friend">
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
											<img src="img/avatar16.jpg" alt="author">
										</div>
										<div class="author-content">
											<a href="#" class="h5 author-name">James Summers</a>
											<div class="country">San Francisco, CA</div>
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
					<div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
						<div class="ui-block">
							<div class="friend-item">
								<div class="friend-header-thumb">
									<img src="img/friend10.jpg" alt="friend">
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
											<img src="img/avatar17.jpg" alt="author">
										</div>
										<div class="author-content">
											<a href="#" class="h5 author-name">Sarah Hetfield</a>
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
					<div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
						<div class="ui-block">
							<div class="friend-item">
								<div class="friend-header-thumb">
									<img src="img/friend11.jpg" alt="friend">
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
											<a href="#" class="h5 author-name">Mathilda Brinker</a>
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
					<div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
						<div class="ui-block">
							<div class="friend-item">
								<div class="friend-header-thumb">
									<img src="img/friend12.jpg" alt="friend">
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
											<img src="img/avatar19.jpg" alt="author">
										</div>
										<div class="author-content">
											<a href="#" class="h5 author-name">Jhonathan Simms</a>
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
					<div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
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
					<div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
						<div class="ui-block">
							<div class="friend-item">
								<div class="friend-header-thumb">
									<img src="img/friend13.jpg" alt="friend">
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
											<img src="img/avatar20.jpg" alt="author">
										</div>
										<div class="author-content">
											<a href="#" class="h5 author-name">Jessy Owens</a>
											<div class="country">Los Angeles, CA</div>
										</div>
									</div>

									<div class="swiper-container">
										<div class="swiper-wrapper">
											<div class="swiper-slide">
												<div class="friend-count" data-swiper-parallax="-500">
													<a href="#" class="friend-count-item">
														<div class="h6">87</div>
														<div class="title">Friends</div>
													</a>
													<a href="#" class="friend-count-item">
														<div class="h6">196</div>
														<div class="title">Photos</div>
													</a>
													<a href="#" class="friend-count-item">
														<div class="h6">8</div>
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
					<div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
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

									<div class="swiper-container swiper-swiper-unique-id-4 initialized swiper-container-horizontal"  >
										<div class="swiper-wrapper" style="width: 872px; transform: translate3d(-218px, 0px, 0px); transition-duration: 0ms;"><div class="swiper-slide swiper-slide-duplicate swiper-slide-prev" data-swiper-slide-index="1" style="width: 218px;">
											<p class="friend-about" data-swiper-parallax="-500">
												Hi!, I’m Marina and I’m a Community Manager for “Gametube”. Gamer and full-time mother.
											</p>

											<div class="friend-since" data-swiper-parallax="-100">
												<span>Friends Since:</span>
												<div class="h6">December 2014</div>
											</div>
										</div>
										<div class="swiper-slide swiper-slide-active" data-swiper-slide-index="0" style="width: 218px;">
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

										<div class="swiper-slide swiper-slide-next" data-swiper-slide-index="1" style="width: 218px;">
											<p class="friend-about" data-swiper-parallax="-500">
												Hi!, I’m Marina and I’m a Community Manager for “Gametube”. Gamer and full-time mother.
											</p>

											<div class="friend-since" data-swiper-parallax="-100">
												<span>Friends Since:</span>
												<div class="h6">December 2014</div>
											</div>
										</div>
										<div class="swiper-slide swiper-slide-duplicate" data-swiper-slide-index="0" style="width: 218px;">
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
										</div></div>

										<!-- If we need pagination -->
										<div class="swiper-pagination pagination-swiper-unique-id-4 swiper-pagination-clickable swiper-pagination-bullets"><span class="swiper-pagination-bullet swiper-pagination-bullet-active"></span><span class="swiper-pagination-bullet"></span></div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
						<div class="ui-block">
							<div class="friend-item">
								<div class="friend-header-thumb">
									<img src="img/friend14.jpg" alt="friend">
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
											<img src="img/avatar21.jpg" alt="author">
										</div>
										<div class="author-content">
											<a href="#" class="h5 author-name">Max Peterson</a>
											<div class="country">Austin, TX</div>
										</div>
									</div>

									<div class="swiper-container swiper-swiper-unique-id-4 initialized swiper-container-horizontal"  >
										<div class="swiper-wrapper" style="width: 872px; transform: translate3d(-218px, 0px, 0px); transition-duration: 0ms;"><div class="swiper-slide swiper-slide-duplicate swiper-slide-prev" data-swiper-slide-index="1" style="width: 218px;">
											<p class="friend-about" data-swiper-parallax="-500">
												Hi!, I’m Marina and I’m a Community Manager for “Gametube”. Gamer and full-time mother.
											</p>

											<div class="friend-since" data-swiper-parallax="-100">
												<span>Friends Since:</span>
												<div class="h6">December 2014</div>
											</div>
										</div>
										<div class="swiper-slide swiper-slide-active" data-swiper-slide-index="0" style="width: 218px;">
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

										<div class="swiper-slide swiper-slide-next" data-swiper-slide-index="1" style="width: 218px;">
											<p class="friend-about" data-swiper-parallax="-500">
												Hi!, I’m Marina and I’m a Community Manager for “Gametube”. Gamer and full-time mother.
											</p>

											<div class="friend-since" data-swiper-parallax="-100">
												<span>Friends Since:</span>
												<div class="h6">December 2014</div>
											</div>
										</div>
										<div class="swiper-slide swiper-slide-duplicate" data-swiper-slide-index="0" style="width: 218px;">
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
										</div></div>

										<!-- If we need pagination -->
										<div class="swiper-pagination pagination-swiper-unique-id-4 swiper-pagination-clickable swiper-pagination-bullets"><span class="swiper-pagination-bullet swiper-pagination-bullet-active"></span><span class="swiper-pagination-bullet"></span></div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
						<div class="ui-block">
							<div class="friend-item">
								<div class="friend-header-thumb">
									<img src="img/friend15.jpg" alt="friend">
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
											<img src="img/avatar22.jpg" alt="author">
										</div>
										<div class="author-content">
											<a href="#" class="h5 author-name">Marie Claire Stevens</a>
											<div class="country">Los Angeles, CA</div>
										</div>
									</div>

									<div class="swiper-container swiper-swiper-unique-id-4 initialized swiper-container-horizontal"  >
										<div class="swiper-wrapper" style="width: 872px; transform: translate3d(-218px, 0px, 0px); transition-duration: 0ms;"><div class="swiper-slide swiper-slide-duplicate swiper-slide-prev" data-swiper-slide-index="1" style="width: 218px;">
											<p class="friend-about" data-swiper-parallax="-500">
												Hi!, I’m Marina and I’m a Community Manager for “Gametube”. Gamer and full-time mother.
											</p>

											<div class="friend-since" data-swiper-parallax="-100">
												<span>Friends Since:</span>
												<div class="h6">December 2014</div>
											</div>
										</div>
										<div class="swiper-slide swiper-slide-active" data-swiper-slide-index="0" style="width: 218px;">
											<div class="friend-count" data-swiper-parallax="-500">
												<a href="#" class="friend-count-item">
													<div class="h6">87</div>
													<div class="title">Friends</div>
												</a>
												<a href="#" class="friend-count-item">
													<div class="h6">196</div>
													<div class="title">Photos</div>
												</a>
												<a href="#" class="friend-count-item">
													<div class="h6">8</div>
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

										<div class="swiper-slide swiper-slide-next" data-swiper-slide-index="1" style="width: 218px;">
											<p class="friend-about" data-swiper-parallax="-500">
												Hi!, I’m Marina and I’m a Community Manager for “Gametube”. Gamer and full-time mother.
											</p>

											<div class="friend-since" data-swiper-parallax="-100">
												<span>Friends Since:</span>
												<div class="h6">December 2014</div>
											</div>
										</div>
										<div class="swiper-slide swiper-slide-duplicate" data-swiper-slide-index="0" style="width: 218px;">
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
										</div></div>

										<!-- If we need pagination -->
										<div class="swiper-pagination pagination-swiper-unique-id-4 swiper-pagination-clickable swiper-pagination-bullets"><span class="swiper-pagination-bullet swiper-pagination-bullet-active"></span><span class="swiper-pagination-bullet"></span></div>
									</div>
								</div>
							</div>
						</div>
					</div>

				</div>

				<nav aria-label="Page navigation example">
					<ul class="pagination justify-content-center">
						<li class="page-item disabled">
							<a class="page-link" href="#" tabindex="-1">Previous</a>
						</li>
						<li class="page-item"><a class="page-link" href="#">1</a></li>
						<li class="page-item"><a class="page-link" href="#">2</a></li>
						<li class="page-item"><a class="page-link" href="#">3</a></li>
						<li class="page-item"><a class="page-link" href="#">...</a></li>
						<li class="page-item"><a class="page-link" href="#">12</a></li>
						<li class="page-item">
							<a class="page-link" href="#">Next</a>
						</li>
					</ul>
				</nav>
			</div>

			<div class="col-xl-3 pull-xl-9 col-lg-12 pull-lg-0 col-md-12 col-sm-12 col-xs-12">
				<div class="ui-block">
					<div class="ui-block-title">
						<h6 class="title">About Green Goo</h6>
						<a href="#" class="more"><svg class="olymp-three-dots-icon"><use xlink:href="icons/icons.svg#olymp-three-dots-icon"></use></svg></a>
					</div>
					<div class="ui-block-content">
						<ul class="widget w-personal-info item-block">
							<li>
								<span class="text">We are Rock Band from Los Angeles, now based in San Francisco, come and listen to us play!</span>
							</li>
							<li>
								<span class="title">Category:</span>
								<span class="text">Rock Band</span>
							</li>
							<li>
								<span class="title">Contact:</span>
								<span class="text">greengoo_gigs@youmail.com</span>
							</li>
							<li>
								<span class="title">Website:</span>
								<a href="#" class="text">www.ggrock.com</a>
							</li>
						</ul>
					</div>
				</div>

				<div class="ui-block">
					<div class="ui-block-title">
						<h6 class="title">Social Networks</h6>
						<a href="#" class="more"><svg class="olymp-three-dots-icon"><use xlink:href="icons/icons.svg#olymp-three-dots-icon"></use></svg></a>
					</div>
					<div class="ui-block-content">
						<div class="widget w-socials">
							<a href="#" class="social-item bg-facebook">
								<i class="fa fa-facebook" aria-hidden="true"></i>
								Facebook
							</a>
							<a href="#" class="social-item bg-twitter">
								<i class="fa fa-twitter" aria-hidden="true"></i>
								Twitter
							</a>
							<a href="#" class="social-item bg-green">
								<i class="fa fa-spotify" aria-hidden="true"></i>
								Spotify
							</a>
						</div>
					</div>
				</div>

				<div class="ui-block">
					<div class="ui-block-title">
						<h6 class="title">Additional Info</h6>
						<a href="#" class="more"><svg class="olymp-three-dots-icon"><use xlink:href="icons/icons.svg#olymp-three-dots-icon"></use></svg></a>
					</div>
					<div class="ui-block-content">
						<ul class="widget w-personal-info item-block">
							<li>
								<span class="title">Additional Info:</span>
								<span class="text">We are open for gigs all over the country. If you are interested,
									please contact us via our website or send us an email to gigs@ggrock.com
								</span>
							</li>
							<li>
								<span class="title">Since:</span>
								<span class="text">Founded in 1996</span>
							</li>
							<li>
								<span class="title">Joined Olympus:</span>
								<span class="text">September 14th, 2012</span>
							</li>
							<li>
								<span class="title">Phone Number:</span>
								<span class="text">(044) 555 - 6943 - 5789</span>
							</li>
						</ul>
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

		<!-- Swiper / Sliders -->
		<script src="js/swiper.jquery.min.js"></script>

		<script src="js/mediaelement-and-player.min.js"></script>
		<script src="js/mediaelement-playlist-plugin.min.js"></script>


	</body>
	</html>