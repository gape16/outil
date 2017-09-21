<?php echo "ou25252i";?>
<!DOCTYPE html>
<html lang="en">
<head>

	<title>Landing Page</title>

	<!-- Required meta tags always come first -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="x-ua-compatible" content="ie=edge">

	<!-- Main Font -->
	<script src="js/webfontloader.min.js"></script>

	<script>
		WebFont.load({
			google: {
				families: ['Roboto:300,400,500,700:latin']
			}
		});
	</script>

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" type="text/css" href="Bootstrap/dist/css/bootstrap-reboot.css">
	<link rel="stylesheet" type="text/css" href="Bootstrap/dist/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="Bootstrap/dist/css/bootstrap-grid.css">

	<!-- Theme Styles CSS -->
	<link rel="stylesheet" type="text/css" href="css/theme-styles.css">
	<link rel="stylesheet" type="text/css" href="css/blocks.css">
	<link rel="stylesheet" type="text/css" href="css/fonts.css">

	<!-- Styles for plugins -->
	<link rel="stylesheet" type="text/css" href="css/jquery.mCustomScrollbar.min.css">
	<link rel="stylesheet" type="text/css" href="css/daterangepicker.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap-select.css">
	<!-- <embed type="image/svg+xml" src="icons.svg" /> -->
	

</head>

<body class="landing-page">

	<div class="content-bg-wrap">
		<div class="content-bg"></div>
	</div>


	<!-- Landing Header -->

	<div class="container">
		<div class="row">
			<div class="col-xl-12 col-lg-12 col-md-12">
				<div id="site-header-landing" class="header-landing">
					<a href="02-ProfilePage.html" class="logo">
						<img src="img/logo.png" alt="Olympus">
						<h5 class="logo-title">olympus</h5>
					</a>

					<ul class="profile-menu">
						<li>
							<a href="#">About Us</a>
						</li>
						<li>
							<a href="#">Careers</a>
						</li>
						<li>
							<a href="#">FAQS</a>
						</li>
						<li>
							<a href="#">Help & Support</a>
						</li>
						<li>
							<a href="#" class="js-expanded-menu">
								<svg class="olymp-menu-icon"><svg id="olymp-menu-icon" viewBox="0 0 41 32" width="100%" height="100%">
									<title>menu-icon</title>
									<path d="M4.571 0h-4.571v4.571h4.571v-4.571zM9.143 0v4.571h32v-4.571h-32zM13.714 13.714h-13.714v4.571h13.714v-4.571zM18.286 13.714v4.571h4.571v-4.571h-4.571zM27.429 18.286h13.714v-4.571h-13.714v4.571zM0 32h32v-4.569h-32v4.569zM36.571 32h4.571v-4.569h-4.571v4.569z"></path>
								</svg></svg>
								<svg class="olymp-close-icon"><svg id="olymp-close-icon" viewBox="0 0 32 32" width="100%" height="100%">
									<title>close-icon</title>
									<path d="M14.222 17.778h3.556v-3.556h-3.556v3.556zM31.084 3.429l-2.514-2.514-10.057 10.057 2.514 2.514 10.057-10.057zM0.916 28.571l2.514 2.514 10.057-10.055-2.516-2.514-10.055 10.055zM18.514 21.029l10.057 10.055 2.514-2.514-10.057-10.055-2.514 2.514zM0.916 3.431l10.057 10.055 2.516-2.514-10.059-10.057-2.514 2.516z"></path>
								</svg></svg>
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>

	<!-- ... end Landing Header -->

	<!-- Login-Registration Form  -->

	<div class="container">
		<div class="row display-flex">
			<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12">
				<div class="landing-content">
					<h1>Welcome to the Biggest Social Network in the World</h1>
					<p>We are the best and biggest social network with 5 billion active users all around the world. Share you
						thoughts, write blog posts, show your favourite music via Stopify, earn badges and much more!
					</p>
					<a href="#" class="btn btn-md btn-border c-white">Register Now!</a>
				</div>
			</div>

			<div class="col-xl-5 col-lg-6 col-md-12 col-sm-12 col-xs-12">
				<div class="registration-login-form">
					<!-- Nav tabs -->
					<ul class="nav nav-tabs" role="tablist">
						<li class="nav-item">
							<a class="nav-link active" data-toggle="tab" href="#home" role="tab">
								<svg id="olymp-login-icon" viewBox="0 0 29 32" width="100%" height="100%">
									<title>login-icon</title>
									<path d="M0 17.443c0 6.515 4.287 12.026 10.195 13.875v-3.081c-4.263-1.728-7.273-5.901-7.273-10.783 0-4.883 3.009-9.056 7.273-10.784v-3.1c-5.908 1.849-10.195 7.36-10.195 13.872zM18.922 3.578v3.092c4.263 1.728 7.273 5.901 7.273 10.783s-3.009 9.056-7.273 10.783v3.071c5.894-1.855 10.169-7.357 10.169-13.863 0-6.503-4.273-12.007-10.169-13.865zM13.104 14.545h2.909v-14.545h-2.909v14.545zM13.104 32h2.909v-2.909h-2.909v2.909z"></path>
								</svg>
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" data-toggle="tab" href="#profile" role="tab">
								<svg id="olymp-register-icon" viewBox="0 0 37 32" width="100%" height="100%">
									<title>register-icon</title>
									<path d="M16 3.213c3.24 0 6.192 1.214 8.446 3.2h4.346c-2.917-3.888-7.549-6.413-12.781-6.413-7.165 0-13.227 4.714-15.259 11.213h3.387c1.899-4.69 6.491-8 11.861-8zM16 28.813c-5.37 0-9.962-3.31-11.861-8h-3.378c2.040 6.485 8.094 11.187 15.25 11.187 5.222 0 9.842-2.515 12.762-6.387h-4.325c-2.256 1.986-5.208 3.2-8.448 3.2zM32 14.413v-4.8h-3.2v4.8h-4.8v3.2h4.8v4.8h3.2v-4.8h4.8v-3.2h-4.8zM3.2 14.413h-3.2v3.2h3.2v-3.2z"></path>
								</svg>
							</a>
						</li>
					</ul>

					<!-- Tab panes -->
					<div class="tab-content">
						<div class="tab-pane active" id="home" role="tabpanel" data-mh="log-tab">
							<div class="title h6">Register to Olympus</div>
							<form class="content">
								<div class="row">
									<div class="col-lg-6 col-md-6">
										<div class="form-group label-floating is-empty">
											<label class="control-label">First Name</label>
											<input class="form-control" placeholder="" type="text">
										</div>
									</div>
									<div class="col-lg-6 col-md-6">
										<div class="form-group label-floating is-empty">
											<label class="control-label">Last Name</label>
											<input class="form-control" placeholder="" type="text">
										</div>
									</div>
									<div class="col-xl-12 col-lg-12 col-md-12">
										<div class="form-group label-floating is-empty">
											<label class="control-label">Your Email</label>
											<input class="form-control" placeholder="" type="email">
										</div>
										<div class="form-group label-floating is-empty">
											<label class="control-label">Your Password</label>
											<input class="form-control" placeholder="" type="password">
										</div>

										<div class="form-group date-time-picker label-floating">
											<label class="control-label">Your Birthday</label>
											<input name="datetimepicker" value="10/24/1984" />
											<span class="input-group-addon">
												<svg class="olymp-calendar-icon"><use xlink:href="#olymp-calendar-icon"></use></svg>
											</span>
										</div>

										<div class="form-group label-floating is-select">
											<label class="control-label">Your Gender</label>
											<select class="selectpicker form-control" size="auto">
												<option value="MA">Male</option>
												<option value="FE">Female</option>
											</select>
										</div>

										<div class="remember">
											<div class="checkbox">
												<label>
													<input name="optionsCheckboxes" type="checkbox">
													I accept the <a href="#">Terms and Conditions</a> of the website
												</label>
											</div>
										</div>

										<a href="#" class="btn btn-purple btn-lg full-width">Complete Registration!</a>
									</div>
								</div>
							</form>
						</div>

						<div class="tab-pane" id="profile" role="tabpanel" data-mh="log-tab">
							<div class="title h6">Login to your Account</div>
							<form class="content">
								<div class="row">
									<div class="col-xl-12 col-lg-12 col-md-12">
										<div class="form-group label-floating is-empty">
											<label class="control-label">Your Email</label>
											<input class="form-control" placeholder="" type="email">
										</div>
										<div class="form-group label-floating is-empty">
											<label class="control-label">Your Password</label>
											<input class="form-control" placeholder="" type="password">
										</div>

										<div class="remember">

											<div class="checkbox">
												<label>
													<input name="optionsCheckboxes" type="checkbox">
													Remember Me
												</label>
											</div>
											<a href="#" class="forgot">Forgot my Password</a>
										</div>

										<a href="#" class="btn btn-lg btn-primary full-width">Login</a>

										<div class="or"></div>

										<a href="#" class="btn btn-lg bg-facebook full-width btn-icon-left"><i class="fa fa-facebook" aria-hidden="true"></i>Login with Facebook</a>

										<a href="#" class="btn btn-lg bg-twitter full-width btn-icon-left"><i class="fa fa-twitter" aria-hidden="true"></i>Login with Twitter</a>


										<p>Don’t you have an account? <a href="#">Register Now!</a> it’s really simple and you can start enjoing all the benefits!</p>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- ... end Login-Registration Form  -->





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





</body>
</html>