<!DOCTYPE html>
<html lang="en">
<head>

	<title>Statistics</title>

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


	<div class="main-header">
		<div class="content-bg-wrap">
			<div class="content-bg bg-group"></div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 col-md-8 offset-md-2 col-sm-12 col-xs-12">
					<div class="main-header-content">
						<h1>Stats and Analytics</h1>
						<p>Welcome to your stats and analytics dashboard! Here you’l see all your profile stats like: visits,
							new friends, average comments, likes, social media reach, annual graphs, and much more!
						</p>
					</div>
				</div>
			</div>
		</div>

		<img class="img-bottom" src="img/statistics-bottom.png" alt="friends">
	</div>


	<div class="container">
		<div class="row">

			<div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-xs-12">
				<div class="ui-block">
					<div class="ui-block-content">
						<ul class="statistics-list-count">
							<li>
								<div class="points">
									<span>
										Last Month Visitors
									</span>
								</div>
								<div class="count-stat">28.432
									<span class="indicator positive"> + 4.207</span>
								</div>
							</li>
						</ul>
					</div>
				</div>
			</div>

			<div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-xs-12">
				<div class="ui-block">
					<div class="ui-block-content">
						<ul class="statistics-list-count">
							<li>
								<div class="points">
									<span>
										Last Year Visitors
									</span>
								</div>
								<div class="count-stat">450.623
									<span class="indicator negative"> - 12.352</span>
								</div>
							</li>
						</ul>
					</div>
				</div>
			</div>

			<div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-xs-12">
				<div class="ui-block">
					<div class="ui-block-content">
						<ul class="statistics-list-count">
							<li>
								<div class="points">
									<span>
										Last Month Posts
									</span>
								</div>
								<div class="count-stat">16.502
									<span class="indicator positive"> + 1.056</span>
								</div>
							</li>
						</ul>
					</div>
				</div>
			</div>

			<div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-xs-12">
				<div class="ui-block">
					<div class="ui-block-content">
						<ul class="statistics-list-count">
							<li>
								<div class="points">
									<span>
										Last Year Posts
									</span>
								</div>
								<div class="count-stat">390.822
									<span class="indicator positive"> + 2.847</span>
								</div>
							</li>
						</ul>
					</div>
				</div>
			</div>

		</div>
	</div>



	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-sm-12 col-xs-12">
				<div class="ui-block responsive-flex">
					<div class="ui-block-title">
						<div class="h6 title">Monthly Bar Graphic</div>
						<select class="selectpicker form-control without-border" size="auto">
							<option value="LY">LAST YEAR (2016)</option>
							<option value="CUR">CURRENT YEAR (2017)</option>
						</select>
						<a href="#" class="more"><svg class="olymp-three-dots-icon"><use xlink:href="icons/icons.svg#olymp-three-dots-icon"></use></svg></a>
					</div>

					<div class="ui-block-content">
						<div class="chart-js chart-js-one-bar">
							<canvas id="one-bar-chart" width="1400" height="380"></canvas>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xl-8 col-lg-8 col-md-7 col-sm-12 col-xs-12">
				<div class="ui-block responsive-flex" data-mh="pie-chart">
					<div class="ui-block-title">
						<div class="h6 title">Lines Graphic</div>

						<select class="selectpicker form-control without-border" size="auto">
							<option value="CUR">LAST 3 MONTH</option>
							<option value="LY">LAST YEAR (2016)</option>
						</select>

						<div class="points align-right">

							<span>
								<span class="statistics-point bg-yellow"></span>
								THIS YEAR
							</span>

							<span>
								<span class="statistics-point bg-primary"></span>
								LAST YEAR
							</span>

						</div>

						<a href="#" class="more"><svg class="olymp-three-dots-icon"><use xlink:href="icons/icons.svg#olymp-three-dots-icon"></use></svg></a>

					</div>

					<div class="ui-block-content">
						<div class="chart-js chart-js-line-graphic">
							<canvas id="line-graphic-chart" width="730" height="300"></canvas>
						</div>
					</div>

				</div>
			</div>
			<div class="col-xl-4 col-lg-4 col-md-5 col-sm-12 col-xs-12">
				<div class="ui-block" data-mh="pie-chart">
					<div class="ui-block-title">
						<div class="h6 title">Colors Pie Chart</div>
						<a href="#" class="more"><svg class="olymp-three-dots-icon"><use xlink:href="icons/icons.svg#olymp-three-dots-icon"></use></svg></a>
					</div>
					<div class="ui-block-content">
						<div class="chart-with-statistic">
							<ul class="statistics-list-count">
								<li>
									<div class="points">
										<span>
											<span class="statistics-point bg-purple"></span>
											Status Updates
										</span>
									</div>
									<div class="count-stat">8.247</div>
								</li>
								<li>
									<div class="points">
										<span>
											<span class="statistics-point bg-breez"></span>
											Multimedia
										</span>
									</div>
									<div class="count-stat">5.630</div>
								</li>
								<li>
									<div class="points">
										<span>
											<span class="statistics-point bg-primary"></span>
											Shared Posts
										</span>
									</div>
									<div class="count-stat">1.498</div>
								</li>
								<li>
									<div class="points">
										<span>
											<span class="statistics-point bg-yellow"></span>
											Blog Posts
										</span>
									</div>
									<div class="count-stat">1.136</div>
								</li>
							</ul>


							<div class="chart-js chart-js-pie-color">
								<canvas id="pie-color-chart" width="180" height="180"></canvas>
								<div class="general-statistics">16.502
									<span>Last Month Posts</span>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>

	<div class="container">
		<div class="row">

			<div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-xs-12">
				<div class="ui-block">
					<div class="ui-block-title">
						<div class="h6 title">Pie Chart with Text</div>
						<a href="#" class="more"><svg class="olymp-three-dots-icon"><use xlink:href="icons/icons.svg#olymp-three-dots-icon"></use></svg></a>
					</div>
					<div class="ui-block-content">
						<div class="circle-progress circle-pie-chart">
							<div class="pie-chart" data-value="0.68" data-startcolor="#38a9ff" data-endcolor="#317cb6">
								<div class="content"><span>%</span></div>
							</div>
						</div>

						<div class="chart-text">
							<h6>Friends Comments</h6>
							<p>68% of friends that visit your profile comment on your posts.</p>
						</div>
					</div>
				</div>
			</div>

			<div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-xs-12">
				<div class="ui-block">
					<div class="ui-block-title">
						<div class="h6 title">Worldwide Statistics</div>
						<a href="#" class="more"><svg class="olymp-three-dots-icon"><use xlink:href="icons/icons.svg#olymp-three-dots-icon"></use></svg></a>
					</div>

					<div class="ui-block-content">
						<div class="world-statistics">
							<div class="world-statistics-img">
								<img src="img/world-map.png" alt="map">
							</div>

							<ul class="country-statistics">
								<li>
									<img src="img/flag1.jpg" alt="flag">
									<span class="country">United States</span>
									<span class="count-stat">86.134</span>
								</li>
								<li>
									<img src="img/flag2.jpg" alt="flag">
									<span class="country">Mexico</span>
									<span class="count-stat">35.136</span>
								</li>
								<li>
									<img src="img/flag3.jpg" alt="flag">
									<span class="country">France</span>
									<span class="count-stat">12.600</span>
								</li>
								<li>
									<img src="img/flag4.jpg" alt="flag">
									<span class="country">Spain</span>
									<span class="count-stat">9.471</span>
								</li>
								<li>
									<img src="img/flag5.jpg" alt="flag">
									<span class="country">Ireland</span>
									<span class="count-stat">8.058</span>
								</li>
								<li>
									<img src="img/flag6.jpg" alt="flag">
									<span class="country">Argentina</span>
									<span class="count-stat">5.653</span>
								</li>
								<li>
									<img src="img/flag7.jpg" alt="flag">
									<span class="country">Ecuador</span>
									<span class="count-stat">2.924</span>
								</li>
							</ul>

						</div>
					</div>
				</div>
			</div>
		</div>


		<div class="row">
			<div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-xs-12">
				<div class="ui-block" data-mh="pie-chart">
					<div class="ui-block-title">
						<div class="h6 title">Country Detail</div>
						<a href="#" class="more"><svg class="olymp-three-dots-icon"><use xlink:href="icons/icons.svg#olymp-three-dots-icon"></use></svg></a>
					</div>
					<div class="ui-block-content js-google-map">
						<div id="us-chart-map" style="width: 270px; height: 180px; max-width: 100%;"></div>
						<ul class="statistics-list-count style-2">
							<li>
								<div class="points">
									<span>
										<span class="statistics-point bg-blue"></span>
										Profile Visits
									</span>
								</div>
								<div class="count-stat">4.290</div>
							</li>
							<li>
								<div class="points">
									<span>
										<span class="statistics-point bg-breez"></span>
										Post Likes
									</span>
								</div>
								<div class="count-stat">2.758</div>
							</li>
						</ul>
					</div>
				</div>
			</div>


			<div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-xs-12">
				<div class="ui-block" data-mh="pie-chart">
					<div class="ui-block-title">
						<div class="h6 title">Progress Bars</div>
						<a href="#" class="more"><svg class="olymp-three-dots-icon"><use xlink:href="icons/icons.svg#olymp-three-dots-icon"></use></svg></a>
					</div>

					<div class="ui-block-content">
						<div class="skills-item">
							<div class="skills-item-info">
								<span class="skills-item-title">Orange Gradient Progress</span>
								<span class="skills-item-count"><span class="count-animate" data-speed="1000" data-refresh-interval="50" data-to="62" data-from="0"></span><span class="units">62%</span></span>
							</div>
							<div class="skills-item-meter">
								<span class="skills-item-meter-active bg-primary" style="width: 62%"></span>
							</div>
						</div>

						<div class="skills-item">
							<div class="skills-item-info">
								<span class="skills-item-title">Violet Progress</span>
								<span class="skills-item-count"><span class="count-animate" data-speed="1000" data-refresh-interval="50" data-to="46" data-from="0"></span><span class="units">46%</span></span>
							</div>
							<div class="skills-item-meter">
								<span class="skills-item-meter-active bg-purple" style="width: 46%"></span>
							</div>
						</div>

						<div class="skills-item">
							<div class="skills-item-info">
								<span class="skills-item-title">Blue Progress</span>
								<span class="skills-item-count"><span class="count-animate" data-speed="1000" data-refresh-interval="50" data-to="79" data-from="0"></span><span class="units">79%</span></span>
							</div>
							<div class="skills-item-meter">
								<span class="skills-item-meter-active bg-blue" style="width: 79%"></span>
							</div>
						</div>

						<div class="skills-item">
							<div class="skills-item-info">
								<span class="skills-item-title">Aqua Progress</span>
								<span class="skills-item-count"><span class="count-animate" data-speed="1000" data-refresh-interval="50" data-to="34" data-from="0"></span><span class="units">34%</span></span>
							</div>
							<div class="skills-item-meter">
								<span class="skills-item-meter-active bg-breez" style="width: 34%"></span>
							</div>
						</div>

						<div class="skills-item">
							<div class="skills-item-info">
								<span class="skills-item-title">Yellow Progress</span>
								<span class="skills-item-count"><span class="count-animate" data-speed="1000" data-refresh-interval="50" data-to="95" data-from="0"></span><span class="units">95%</span></span>
							</div>
							<div class="skills-item-meter">
								<span class="skills-item-meter-active bg-yellow" style="width: 95%"></span>
							</div>
						</div>
					</div>

				</div>
			</div>


			<div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-xs-12">
				<div class="ui-block" data-mh="pie-chart">
					<div class="ui-block-title">
						<div class="h6 title">Icons with Text</div>
						<a href="#" class="more"><svg class="olymp-three-dots-icon"><use xlink:href="icons/icons.svg#olymp-three-dots-icon"></use></svg></a>
					</div>

					<div class="ui-block-content">
						<div class="monthly-indicator-wrap">
							<div class="monthly-indicator">
								<a href="#" class="btn btn-control bg-blue">
									<svg class="olymp-happy-face-icon"><use xlink:href="icons/icons.svg#olymp-happy-face-icon"></use></svg>
								</a>

								<div class="monthly-count">
									9.855
									<span class="period">Likes</span>
								</div>
							</div>

							<div class="monthly-indicator">
								<a href="#" class="btn btn-control bg-blue">
									<svg class="olymp-happy-face-icon"><use xlink:href="icons/icons.svg#olymp-happy-face-icon"></use></svg>
								</a>

								<div class="monthly-count">
									6.721
									<span class="period">Shares</span>
								</div>
							</div>

							<div class="monthly-indicator">
								<a href="#" class="btn btn-control bg-blue">
									<svg class="olymp-happy-face-icon"><use xlink:href="icons/icons.svg#olymp-happy-face-icon"></use></svg>
								</a>

								<div class="monthly-count">
									2.047
									<span class="period">Comments</span>
								</div>
							</div>

							<div class="monthly-indicator">
								<a href="#" class="btn btn-control bg-blue">
									<svg class="olymp-happy-face-icon"><use xlink:href="icons/icons.svg#olymp-happy-face-icon"></use></svg>
								</a>

								<div class="monthly-count">
									1.536
									<span class="period">Messages</span>
								</div>
							</div>

							<div class="monthly-indicator">
								<a href="#" class="btn btn-control bg-primary">
									<svg class="olymp-comments-post-icon"><use xlink:href="icons/icons.svg#olymp-comments-post-icon"></use></svg>
								</a>

								<div class="monthly-count">
									Paragraph
									<span class="period">Lorem ipsum dolor sit amet, consectetur icing elit, sed do eiusmod
										tempor incididunt ut ore et dolore magna aliqua. Ut enim ad minim an quis nostrud
										exercitation.
									</span>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>

		</div>


		<div class="row">
			<div class="col-lg-12 col-sm-12 col-xs-12">
				<div class="ui-block responsive-flex">
					<div class="ui-block-title">
						<div class="h6 title">Yearly Line Graphic</div>
						<select class="selectpicker form-control without-border" size="auto">
							<option value="LY">LAST YEAR (2016)</option>
							<option value="2">CURRENT YEAR (2017)</option>
						</select>
						<a href="#" class="more"><svg class="olymp-three-dots-icon"><use xlink:href="icons/icons.svg#olymp-three-dots-icon"></use></svg></a>
					</div>

					<div class="ui-block-content">
						<div class="chart-js chart-js-line-chart">
							<canvas id="line-chart" width="1400" height="380"></canvas>
						</div>
					</div>
					<hr>
					<div class="ui-block-content display-flex content-around">
						<div class="chart-js chart-js-small-pie">
							<canvas id="pie-small-chart" width="90" height="90"></canvas>
						</div>

						<div class="points points-block">

							<span>
								<span class="statistics-point bg-breez"></span>
								Yearly Likes
							</span>

							<span>
								<span class="statistics-point bg-yellow"></span>
								Yearly Comments
							</span>

						</div>

						<div class="text-stat">
							<div class="count-stat">2.758</div>
							<div class="title">Total Likes</div>
							<div class="sub-title">This Year</div>
						</div>

						<div class="text-stat">
							<div class="count-stat">5.420,7</div>
							<div class="title">Average Likes</div>
							<div class="sub-title">By Month</div>
						</div>

						<div class="text-stat">
							<div class="count-stat">42.973</div>
							<div class="title">Total Comments</div>
							<div class="sub-title">This Year</div>
						</div>

						<div class="text-stat">
							<div class="count-stat">3.581,1</div>
							<div class="title">Average Comments</div>
							<div class="sub-title">By Month</div>
						</div>

					</div>
				</div>
			</div>

		</div>
		<div class="row">
			<div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-xs-12">
				<div class="ui-block" data-mh="pie-chart">
					<div class="ui-block-title">
						<div class="h6 title">Progress Bars</div>
						<a href="#" class="more"><svg class="olymp-three-dots-icon"><use xlink:href="icons/icons.svg#olymp-three-dots-icon"></use></svg></a>
					</div>
					<div class="ui-block-content">
						<div class="chart-js chart-js-two-bar">
							<canvas id="two-bar-chart-2" width="400" height="300"></canvas>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-xs-12">
				<div class="ui-block" data-mh="pie-chart">
					<div class="ui-block-title">
						<div class="h6 title">Number with Slider</div>
						<a href="#" class="more"><svg class="olymp-three-dots-icon"><use xlink:href="icons/icons.svg#olymp-three-dots-icon"></use></svg></a>
					</div>

					<div class="ui-block-content">
						<div class="swiper-container" data-slide="fade">
							<div class="swiper-wrapper">
								<div class="swiper-slide">
									<div class="statistics-slide">
										<div class="count-stat" data-swiper-parallax="-500">248</div>
										<div class="title" data-swiper-parallax="-100"><span class="c-primary">Olympus</span> Posts Rank</div>
										<div class="sub-title" data-swiper-parallax="-100">The Olympus Rank measures the quantity of comments, likes and posts.</div>
									</div>
								</div>
								<div class="swiper-slide">
									<div class="statistics-slide">
										<div class="count-stat" data-swiper-parallax="-500">358</div>
										<div class="title" data-swiper-parallax="-100"><span class="c-primary">Olympus</span> Posts Rank</div>
										<div class="sub-title" data-swiper-parallax="-100">The Olympus Rank measures the quantity of comments, likes and posts.</div>
									</div>
								</div>
								<div class="swiper-slide">
									<div class="statistics-slide">
										<div class="count-stat" data-swiper-parallax="-500">711</div>
										<div class="title" data-swiper-parallax="-100"><span class="c-primary">Olympus</span> Posts Rank</div>
										<div class="sub-title" data-swiper-parallax="-100">The Olympus Rank measures the quantity of comments, likes and posts.</div>
									</div>
								</div>
							</div>

							<!-- If we need pagination -->
							<div class="swiper-pagination pagination-blue"></div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-xs-12">
				<div class="ui-block" data-mh="pie-chart">
					<div class="ui-block-title">
						<div class="h6 title">Pie Chart</div>
						<a href="#" class="more"><svg class="olymp-three-dots-icon"><use xlink:href="icons/icons.svg#olymp-three-dots-icon"></use></svg></a>
					</div>
					<div class="ui-block-content">
						<div class="chart-js chart-radar">
							<canvas id="radar-chart" width="400" height="300"></canvas>
						</div>
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

		<!-- Swiper / Sliders -->
		<script src="js/swiper.jquery.min.js"></script>

		<!-- Chart JS Generate scripts-->
		<script src="js/Chart.min.js"></script>
		<script src="js/chartjs-plugin-deferred.min.js"></script>
		<script src="js/circle-progress.min.js"></script>
		<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
		<script src="js/run-chart.js"></script>


		<script src="js/mediaelement-and-player.min.js"></script>
		<script src="js/mediaelement-playlist-plugin.min.js"></script>

	</body>
	</html>