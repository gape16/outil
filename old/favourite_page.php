<!DOCTYPE html>
<html lang="en">
<head>

	<title>Favourite Page</title>

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
	<link rel="stylesheet" type="text/css" href="css/mediaelement-playlist-plugin.min.css">
	<link rel="stylesheet" type="text/css" href="css/mediaelementplayer.css">

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
											<a href="12-FavouritePage.html" class="active">Timeline</a>
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
			<div class="col-xl-6 push-xl-3 col-lg-12 push-lg-0 col-sm-12 col-xs-12">
				<div id="newsfeed-items-grid">
					<div class="ui-block">
						<article class="hentry post">

							<div class="post__author author vcard inline-items">
								<img src="img/avatar5-sm.jpg" alt="author">

								<div class="author-date">
									<a class="h6 post__author-name fn" href="#">Green Goo Rock</a>
									<div class="post__date">
										<time class="published" datetime="2017-03-24T18:18">
											4 hours ago
										</time>
									</div>
								</div>

								<div class="more"><svg class="olymp-three-dots-icon"><use xlink:href="icons/icons.svg#olymp-three-dots-icon"></use></svg>
									<ul class="more-dropdown">
										<li>
											<a href="#">Edit Post</a>
										</li>
										<li>
											<a href="#">Delete Post</a>
										</li>
										<li>
											<a href="#">Turn Off Notifications</a>
										</li>
										<li>
											<a href="#">Select as Featured</a>
										</li>
									</ul>
								</div>

							</div>

							<p>Hi guys! We just wanted to let everyone know that we are currently recording
								our new album “News of the Goo”. We’ll be playing one of our new songs this Friday at 8pm in
								our Fake Street 320 recording studio, come and join us!
							</p>

							<div class="post-additional-info inline-items">

								<a href="#" class="post-add-icon inline-items">
									<svg class="olymp-heart-icon"><use xlink:href="icons/icons.svg#olymp-heart-icon"></use></svg>
									<span>36</span>
								</a>

								<ul class="friends-harmonic">
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
											<img src="img/friend-harmonic9.jpg" alt="friend">
										</a>
									</li>
									<li>
										<a href="#">
											<img src="img/friend-harmonic10.jpg" alt="friend">
										</a>
									</li>
									<li>
										<a href="#">
											<img src="img/friend-harmonic11.jpg" alt="friend">
										</a>
									</li>
								</ul>

								<div class="names-people-likes">
									<a href="#">You</a>, <a href="#">Elaine</a> and
									<br>34 more liked this
								</div>


								<div class="comments-shared">
									<a href="#" class="post-add-icon inline-items">
										<svg class="olymp-speech-balloon-icon"><use xlink:href="icons/icons.svg#olymp-speech-balloon-icon"></use></svg>
										<span>17</span>
									</a>

									<a href="#" class="post-add-icon inline-items">
										<svg class="olymp-share-icon"><use xlink:href="icons/icons.svg#olymp-share-icon"></use></svg>
										<span>24</span>
									</a>
								</div>


							</div>

							<div class="control-block-button post-control-button">

								<a href="#" class="btn btn-control">
									<svg class="olymp-like-post-icon"><use xlink:href="icons/icons.svg#olymp-like-post-icon"></use></svg>
								</a>

								<a href="#" class="btn btn-control">
									<svg class="olymp-comments-post-icon"><use xlink:href="icons/icons.svg#olymp-comments-post-icon"></use></svg>
								</a>

								<a href="#" class="btn btn-control">
									<svg class="olymp-share-icon"><use xlink:href="icons/icons.svg#olymp-share-icon"></use></svg>
								</a>

							</div>

						</article>

						<ul class="comments-list">
							<li>
								<div class="post__author author vcard inline-items">
									<img src="img/avatar2-sm.jpg" alt="author">

									<div class="author-date">
										<a class="h6 post__author-name fn" href="#">Nicholas Grissom</a>
										<div class="post__date">
											<time class="published" datetime="2017-03-24T18:18">
												28 mins ago
											</time>
										</div>
									</div>

									<a href="#" class="more"><svg class="olymp-three-dots-icon"><use xlink:href="icons/icons.svg#olymp-three-dots-icon"></use></svg></a>

								</div>

								<p>Dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit.</p>

								<a href="#" class="post-add-icon inline-items">
									<svg class="olymp-heart-icon"><use xlink:href="icons/icons.svg#olymp-heart-icon"></use></svg>
									<span>6</span>
								</a>
								<a href="#" class="reply">Reply</a>
							</li>
							<li>
								<div class="post__author author vcard inline-items">
									<img src="img/avatar19-sm.jpg" alt="author">

									<div class="author-date">
										<a class="h6 post__author-name fn" href="#">Jimmy Elricson</a>
										<div class="post__date">
											<time class="published" datetime="2017-03-24T18:18">
												2 hours ago
											</time>
										</div>
									</div>

									<a href="#" class="more"><svg class="olymp-three-dots-icon"><use xlink:href="icons/icons.svg#olymp-three-dots-icon"></use></svg></a>

								</div>

								<p>Ratione voluptatem sequi en lod nesciunt. Neque porro quisquam est, quinder dolorem ipsum
									quia dolor sit amet, consectetur adipisci velit en lorem ipsum duis aute irure dolor in reprehenderit in voluptate velit esse cillum.
								</p>

								<a href="#" class="post-add-icon inline-items">
									<svg class="olymp-heart-icon"><use xlink:href="icons/icons.svg#olymp-heart-icon"></use></svg>
									<span>8</span>
								</a>
								<a href="#" class="reply">Reply</a>
							</li>
						</ul>

						<a href="#" class="more-comments">View more comments <span>+</span></a>

						<form class="comment-form inline-items">

							<div class="post__author author vcard inline-items">
								<img src="img/author-page.jpg" alt="author">
							</div>

							<div class="form-group with-icon-right">
								<textarea class="form-control" placeholder=""  ></textarea>
								<div class="add-options-message">
									<a href="#" class="options-message" data-toggle="modal" data-target="#update-header-photo">
										<svg class="olymp-camera-icon"><use xlink:href="icons/icons.svg#olymp-camera-icon"></use></svg>
									</a>
								</div>

							</div>

						</form>

					</div>

					<div class="ui-block">
						<article class="hentry post has-post-thumbnail">

							<div class="post__author author vcard inline-items">
								<img src="img/avatar5-sm.jpg" alt="author">

								<div class="author-date">
									<a class="h6 post__author-name fn" href="#">Green Goo Rock</a>
									<div class="post__date">
										<time class="published" datetime="2017-03-24T18:18">
											March 8 at 6:42pm
										</time>
									</div>
								</div>

								<div class="more"><svg class="olymp-three-dots-icon"><use xlink:href="icons/icons.svg#olymp-three-dots-icon"></use></svg>
									<ul class="more-dropdown">
										<li>
											<a href="#">Edit Post</a>
										</li>
										<li>
											<a href="#">Delete Post</a>
										</li>
										<li>
											<a href="#">Turn Off Notifications</a>
										</li>
										<li>
											<a href="#">Select as Featured</a>
										</li>
									</ul>
								</div>

							</div>

							<p>Hey guys! We are gona be playing this Saturday of <a href="#">The Marina Bar</a> for their new Mystic Deer Party.
								If you wanna hang out and have a really good time, come and join us. We’l be waiting for you!
							</p>

							<div class="post-thumb">
								<img src="img/post__thumb1.jpg" alt="photo">
							</div>

							<div class="post-additional-info inline-items">

								<a href="#" class="post-add-icon inline-items">
									<svg class="olymp-heart-icon"><use xlink:href="icons/icons.svg#olymp-heart-icon"></use></svg>
									<span>49</span>
								</a>

								<ul class="friends-harmonic">
									<li>
										<a href="#">
											<img src="img/friend-harmonic9.jpg" alt="friend">
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
											<img src="img/friend-harmonic11.jpg" alt="friend">
										</a>
									</li>
								</ul>

								<div class="names-people-likes">
									<a href="#">Jimmy</a>, <a href="#">Andrea</a> and
									<br>47 more liked this
								</div>


								<div class="comments-shared">
									<a href="#" class="post-add-icon inline-items">
										<svg class="olymp-speech-balloon-icon"><use xlink:href="icons/icons.svg#olymp-speech-balloon-icon"></use></svg>
										<span>264</span>
									</a>

									<a href="#" class="post-add-icon inline-items">
										<svg class="olymp-share-icon"><use xlink:href="icons/icons.svg#olymp-share-icon"></use></svg>
										<span>37</span>
									</a>
								</div>


							</div>

							<div class="control-block-button post-control-button">

								<a href="#" class="btn btn-control">
									<svg class="olymp-like-post-icon"><use xlink:href="icons/icons.svg#olymp-like-post-icon"></use></svg>
								</a>

								<a href="#" class="btn btn-control">
									<svg class="olymp-comments-post-icon"><use xlink:href="icons/icons.svg#olymp-comments-post-icon"></use></svg>
								</a>

								<a href="#" class="btn btn-control">
									<svg class="olymp-share-icon"><use xlink:href="icons/icons.svg#olymp-share-icon"></use></svg>
								</a>

							</div>

						</article>
					</div>

					<div class="ui-block">
						<article class="hentry post video">

							<div class="post__author author vcard inline-items">
								<img src="img/avatar5-sm.jpg" alt="author">

								<div class="author-date">
									<a class="h6 post__author-name fn" href="#">Gren Goo Rock</a> shared a <a href="#">link</a>
									<div class="post__date">
										<time class="published" datetime="2017-03-24T18:18">
											March 4 at 2:05pm
										</time>
									</div>
								</div>

								<div class="more"><svg class="olymp-three-dots-icon"><use xlink:href="icons/icons.svg#olymp-three-dots-icon"></use></svg>
									<ul class="more-dropdown">
										<li>
											<a href="#">Edit Post</a>
										</li>
										<li>
											<a href="#">Delete Post</a>
										</li>
										<li>
											<a href="#">Turn Off Notifications</a>
										</li>
										<li>
											<a href="#">Select as Featured</a>
										</li>
									</ul>
								</div>

							</div>

							<p>Hey <a href="#">Cindi</a>, you should really check out this new song by Iron Maid. The next time they come to the city we should totally go!</p>

							<div class="post-video">
								<div class="video-thumb">
									<img src="img/video-youtube.jpg" alt="photo">
									<a href="https://youtube.com/watch?v=excVFQ2TWig" class="play-video">
										<svg class="olymp-play-icon"><use xlink:href="icons/icons.svg#olymp-play-icon"></use></svg>
									</a>
								</div>

								<div class="video-content">
									<a href="#" class="h4 title">Killer Queen - Archiduke</a>
									<p>Lorem ipsum dolor sit amet, consectetur ipisicing elit, sed do eiusmod tempor incididunt
										ut labore et dolore magna aliqua...
									</p>
									<a href="#" class="link-site">YOUTUBE.COM</a>
								</div>
							</div>

							<div class="post-additional-info inline-items">

								<a href="#" class="post-add-icon inline-items">
									<svg class="olymp-heart-icon"><use xlink:href="icons/icons.svg#olymp-heart-icon"></use></svg>
									<span>18</span>
								</a>

								<ul class="friends-harmonic">
									<li>
										<a href="#">
											<img src="img/friend-harmonic9.jpg" alt="friend">
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
											<img src="img/friend-harmonic11.jpg" alt="friend">
										</a>
									</li>
								</ul>

								<div class="names-people-likes">
									<a href="#">Jenny</a>, <a href="#">Robert</a> and
									<br>18 more liked this
								</div>

								<div class="comments-shared">
									<a href="#" class="post-add-icon inline-items">
										<svg class="olymp-speech-balloon-icon"><use xlink:href="icons/icons.svg#olymp-speech-balloon-icon"></use></svg>
										<span>0</span>
									</a>

									<a href="#" class="post-add-icon inline-items">
										<svg class="olymp-share-icon"><use xlink:href="icons/icons.svg#olymp-share-icon"></use></svg>
										<span>16</span>
									</a>
								</div>


							</div>

							<div class="control-block-button post-control-button">

								<a href="#" class="btn btn-control">
									<svg class="olymp-like-post-icon"><use xlink:href="icons/icons.svg#olymp-like-post-icon"></use></svg>
								</a>

								<a href="#" class="btn btn-control">
									<svg class="olymp-comments-post-icon"><use xlink:href="icons/icons.svg#olymp-comments-post-icon"></use></svg>
								</a>

								<a href="#" class="btn btn-control">
									<svg class="olymp-share-icon"><use xlink:href="icons/icons.svg#olymp-share-icon"></use></svg>
								</a>

							</div>

						</article>
					</div>
				</div>
				<a id="load-more-button" href="#" class="btn btn-control btn-more" data-load-link="items-to-load.html" data-container="newsfeed-items-grid"><svg class="olymp-three-dots-icon"><use xlink:href="icons/icons.svg#olymp-three-dots-icon"></use></svg></a>

			</div>

			<div class="col-xl-3 pull-xl-6 col-lg-6 pull-lg-0 col-md-6 col-sm-12 col-xs-12">
				<div class="ui-block">
					<div class="ui-block-title">
						<h6 class="title">Page Intro</h6>
						<a href="#" class="more"><svg class="olymp-three-dots-icon"><use xlink:href="icons/icons.svg#olymp-three-dots-icon"></use></svg></a>
					</div>
					<div class="ui-block-content">
						<ul class="widget w-personal-info item-block">
							<li>
								<span class="text">We are Rock Band from Los Angeles, now based in San Francisco, come and listen to us play!</span>
							</li>
							<li>
								<span class="title">Created:</span>
								<span class="text">September 17th, 2013</span>
							</li>
							<li>
								<span class="title">Based in:</span>
								<span class="text">San Francisco, California</span>
							</li>
							<li>
								<span class="title">Contact:</span>
								<a href="#" class="text">greengoo_gigs@youmail.com</a>
							</li>
							<li>
								<span class="title">Website:</span>
								<a href="#" class="text">www.ggrock.com</a>
							</li>
							<li>
								<span class="title">Favourites:</span>
								<a href="#" class="text">5630 </a>
							</li>
						</ul>

						<div class="widget w-socials">
							<h6 class="title">Other Social Networks:</h6>
							<a href="#" class="social-item bg-facebook">
								<i class="fa fa-facebook" aria-hidden="true"></i>
								Facebook
							</a>
							<a href="#" class="social-item bg-twitter">
								<i class="fa fa-twitter" aria-hidden="true"></i>
								Twitter
							</a>
							<a href="#" class="social-item bg-green">
								<i class="fa fa-dribbble" aria-hidden="true"></i>
								Spotify
							</a>
						</div>
					</div>
				</div>

				<div class="ui-block">
					<div class="ui-block-title">
						<h6 class="title">Location</h6>
						<a href="#" class="more"><svg class="olymp-three-dots-icon"><use xlink:href="icons/icons.svg#olymp-three-dots-icon"></use></svg></a>
					</div>

					<div class="widget w-contacts">
						<!-- Google map -->

						<div class="section">
							<div id="map"></div>
							<script>
								var map;

								function initMap() {

									var myLatLng = {lat: -25.363, lng: 131.044};

									map = new google.maps.Map(document.getElementById('map'), {
										center: myLatLng,
										zoom: 14,
									scrollwheel: false//set to true to enable mouse scrolling while inside the map area
								});

									var marker = new google.maps.Marker({
										position: myLatLng,
										map: map,
										icon: {
											url: "img/marker-google.png",
											scaledSize: new google.maps.Size(50, 50)
										}

									});
								}


							</script>
							<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBESxStZOWN9aMvTdR3Nov66v6TXxpRZMM&callback=initMap"
							async defer></script>
						</div>

						<!-- End Google map -->

						<ul>
							<li>
								<span class="title">Address:</span>
								<span class="text">Fake Street 320, San Francisco California, USA.
								</span>
							</li>
							<li>
								<span class="title">Working Hours:</span>
								<span class="text">Mon-Fri 9:00am to 6:00pm
									Weekends 10:00am to 8:00pm
								</span>
							</li>
						</ul>
					</div>

				</div>

				<div class="ui-block">
					<div class="ui-block-title">
						<h6 class="title">Faved this Page</h6>
						<a href="#" class="more"><svg class="olymp-three-dots-icon"><use xlink:href="icons/icons.svg#olymp-three-dots-icon"></use></svg></a>
					</div>
					<div class="ui-block-content">
						<ul class="widget w-faved-page">
							<li>
								<a href="#">
									<img src="img/faved-page1.jpg" alt="user">
								</a>
							</li>
							<li>
								<a href="#">
									<img src="img/faved-page2.jpg" alt="user">
								</a>
							</li>
							<li>
								<a href="#">
									<img src="img/faved-page3.jpg" alt="user">
								</a>
							</li>
							<li>
								<a href="#">
									<img src="img/faved-page4.jpg" alt="user">
								</a>
							</li>
							<li>
								<a href="#">
									<img src="img/faved-page5.jpg" alt="user">
								</a>
							</li>
							<li>
								<a href="#">
									<img src="img/faved-page6.jpg" alt="user">
								</a>
							</li>
							<li>
								<a href="#">
									<img src="img/faved-page7.jpg" alt="user">
								</a>
							</li>
							<li>
								<a href="#">
									<img src="img/faved-page8.jpg" alt="user">
								</a>
							</li>
							<li>
								<a href="#">
									<img src="img/faved-page9.jpg" alt="user">
								</a>
							</li>
							<li>
								<a href="#">
									<img src="img/faved-page7.jpg" alt="user">
								</a>
							</li>
							<li>
								<a href="#">
									<img src="img/faved-page10.jpg" alt="user">
								</a>
							</li>
							<li>
								<a href="#">
									<img src="img/faved-page11.jpg" alt="user">
								</a>
							</li>
							<li>
								<a href="#">
									<img src="img/faved-page7.jpg" alt="user">
								</a>
							</li>
							<li>
								<a href="#">
									<img src="img/faved-page12.jpg" alt="user">
								</a>
							</li>
							<li class="all-users">
								<a href="#">+5k</a>
							</li>
						</ul>
					</div>
				</div>


				<div class="ui-block">
					<div class="ui-block-title">
						<h6 class="title">Twitter Feed</h6>
						<a href="#" class="more"><svg class="olymp-three-dots-icon"><use xlink:href="icons/icons.svg#olymp-three-dots-icon"></use></svg></a>
					</div>

					<ul class="widget w-twitter">
						<li class="twitter-item">
							<div class="author-folder">
								<img src="img/twitter-avatar.png" alt="avatar">
								<div class="author">
									<a href="#" class="author-name">Green Goo Rock</a>
									<a href="#" class="group">@greengoo_rock</a>
									<span class="verified"><i class="fa fa-check" aria-hidden="true"></i></span>
								</div>
							</div>
							<p>This Friday at 8pm we’ll be playing a song of our new album, come and join us! <a href="#" class="link-post">#NewsoftheGoo</a></p>
							<span class="post__date">
								<time class="published" datetime="2017-03-24T18:18">
									4 hours ago
								</time>
							</span>
						</li>
						<li class="twitter-item">
							<div class="author-folder">
								<img src="img/twitter-avatar.png" alt="avatar">
								<div class="author">
									<a href="#" class="author-name">Green Goo Rock</a>
									<a href="#" class="group">@greengoo_rock</a>
									<span class="verified"><i class="fa fa-check" aria-hidden="true"></i></span>
								</div>
							</div>
							<p>Tickets for the Marina Party are now available on <a href="#" class="link-post">www.ggrock.com</a></p>
							<span class="post__date">
								<time class="published" datetime="2017-03-24T18:18">
									Yesterday
								</time>
							</span>
						</li>
						<li class="twitter-item">
							<div class="author-folder">
								<img src="img/twitter-avatar.png" alt="avatar">
								<div class="author">
									<a href="#" class="author-name">Green Goo Rock</a>
									<a href="#" class="group">@greengoo_rock</a>
									<span class="verified"><i class="fa fa-check" aria-hidden="true"></i></span>
								</div>
							</div>
							<p>We had a great time playing in Italy. Thanks a lot to the incredible fans! <a href="#" class="link-post">#GGinRome #PisaArena </a></p>
							<span class="post__date">
								<time class="published" datetime="2017-03-24T18:18">
									5 days ago
								</time>
							</span>
						</li>
					</ul>
				</div>
			</div>

			<div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-xs-12">
				<div class="ui-block">
					<div class="ui-block-title">
						<h6 class="title">Last Photos</h6>
						<a href="#" class="more"><svg class="olymp-three-dots-icon"><use xlink:href="icons/icons.svg#olymp-three-dots-icon"></use></svg></a>
					</div>
					<div class="ui-block-content">
						<ul class="widget w-last-photo js-zoom-gallery">
							<li>
								<a href="img/last-photo1-large.jpg">
									<img src="img/last-photo1-large.jpg" alt="photo">
								</a>
							</li>
							<li>
								<a href="img/last-photo2-large.jpg">
									<img src="img/last-photo2-large.jpg" alt="photo">
								</a>
							</li>
							<li>
								<a href="img/last-photo3-large.jpg">
									<img src="img/last-photo3-large.jpg" alt="photo">
								</a>
							</li>
							<li>
								<a href="img/last-photo4-large.jpg">
									<img src="img/last-photo4-large.jpg" alt="photo">
								</a>
							</li>
							<li>
								<a href="img/last-phot11-large.jpg">
									<img src="img/last-phot11-large.jpg" alt="photo">
								</a>
							</li>
							<li>
								<a href="img/last-phot12-large.jpg">
									<img src="img/last-phot12-large.jpg" alt="photo">
								</a>
							</li>
							<li>
								<a href="img/last-photo7-large.jpg">
									<img src="img/last-photo7-large.jpg" alt="photo">
								</a>
							</li>
							<li>
								<a href="img/last-photo8-large.jpg">
									<img src="img/last-photo8-large.jpg" alt="photo">
								</a>
							</li>
							<li>
								<a href="img/last-photo9-large.jpg">
									<img src="img/last-photo9-large.jpg" alt="photo">
								</a>
							</li>
						</ul>
					</div>
				</div>

				<div class="ui-block">
					<div class="ui-block-title">
						<h6 class="title">Green Goo’s Playlist</h6>
						<a href="#" class="more">
							<span class="c-green">
								<svg class="olymp-remove-playlist-icon"><use xlink:href="icons/icons.svg#olymp-remove-playlist-icon"></use></svg>
							</span>
						</a>
					</div>

					<ol class="widget w-playlist">
						<li class="js-open-popup" data-popup-target=".playlist-popup">
							<div class="playlist-thumb">
								<img src="img/playlist1.jpg" alt="thumb-composition">
								<div class="overlay"></div>
								<a href="#" class="play-icon">
									<svg class="olymp-music-play-icon-big"><use xlink:href="icons/icons-music.svg#olymp-music-play-icon-big"></use></svg>
								</a>
							</div>

							<div class="composition">
								<a href="#" class="composition-name">Ruler of Firenze</a>
								<a href="#" class="composition-author">Eden Artifact</a>
							</div>

							<div class="composition-time">
								<time class="published" datetime="2017-03-24T18:18">5:48</time>
								<a href="#" class="more"><svg class="olymp-three-dots-icon"><use xlink:href="icons/icons.svg#olymp-three-dots-icon"></use></svg></a>
							</div>

						</li>

						<li class="js-open-popup" data-popup-target=".playlist-popup">
							<div class="playlist-thumb">
								<img src="img/playlist2.jpg" alt="thumb-composition">
								<div class="overlay"></div>
								<a href="#" class="play-icon">
									<svg class="olymp-music-play-icon-big"><use xlink:href="icons/icons-music.svg#olymp-music-play-icon-big"></use></svg>
								</a>
							</div>

							<div class="composition">
								<a href="#" class="composition-name">Ruler of Firenze</a>
								<a href="#" class="composition-author">Eden Artifact</a>
							</div>

							<div class="composition-time">
								<time class="published" datetime="2017-03-24T18:18">5:48</time>
								<a href="#" class="more"><svg class="olymp-three-dots-icon"><use xlink:href="icons/icons.svg#olymp-three-dots-icon"></use></svg></a>
							</div>

						</li>
						<li class="js-open-popup" data-popup-target=".playlist-popup">
							<div class="playlist-thumb">
								<img src="img/playlist3.jpg" alt="thumb-composition">
								<div class="overlay"></div>
								<a href="#" class="play-icon">
									<svg class="olymp-music-play-icon-big"><use xlink:href="icons/icons-music.svg#olymp-music-play-icon-big"></use></svg>
								</a>
							</div>

							<div class="composition">
								<a href="#" class="composition-name">Ruler of Firenze</a>
								<a href="#" class="composition-author">Eden Artifact</a>
							</div>

							<div class="composition-time">
								<time class="published" datetime="2017-03-24T18:18">5:48</time>
								<a href="#" class="more"><svg class="olymp-three-dots-icon"><use xlink:href="icons/icons.svg#olymp-three-dots-icon"></use></svg></a>
							</div>

						</li>
						<li class="js-open-popup" data-popup-target=".playlist-popup">
							<div class="playlist-thumb">
								<img src="img/playlist4.jpg" alt="thumb-composition">
								<div class="overlay"></div>
								<a href="#" class="play-icon">
									<svg class="olymp-music-play-icon-big"><use xlink:href="icons/icons-music.svg#olymp-music-play-icon-big"></use></svg>
								</a>
							</div>

							<div class="composition">
								<a href="#" class="composition-name">Ruler of Firenze</a>
								<a href="#" class="composition-author">Eden Artifact</a>
							</div>

							<div class="composition-time">
								<time class="published" datetime="2017-03-24T18:18">5:48</time>
								<a href="#" class="more"><svg class="olymp-three-dots-icon"><use xlink:href="icons/icons.svg#olymp-three-dots-icon"></use></svg></a>
							</div>

						</li>
						<li class="js-open-popup" data-popup-target=".playlist-popup">
							<div class="playlist-thumb">
								<img src="img/playlist5.jpg" alt="thumb-composition">
								<div class="overlay"></div>
								<a href="#" class="play-icon">
									<svg class="olymp-music-play-icon-big"><use xlink:href="icons/icons-music.svg#olymp-music-play-icon-big"></use></svg>
								</a>
							</div>

							<div class="composition">
								<a href="#" class="composition-name">Ruler of Firenze</a>
								<a href="#" class="composition-author">Eden Artifact</a>
							</div>

							<div class="composition-time">
								<time class="published" datetime="2017-03-24T18:18">5:48</time>
								<a href="#" class="more"><svg class="olymp-three-dots-icon"><use xlink:href="icons/icons.svg#olymp-three-dots-icon"></use></svg></a>
							</div>

						</li>
					</ol>

				</div>

				<div class="ui-block">
					<div class="ui-block-title">
						<h6 class="title">Green Goo's Poll</h6>
						<a href="#" class="more"><svg class="olymp-three-dots-icon"><use xlink:href="icons/icons.svg#olymp-three-dots-icon"></use></svg></a>
					</div>
					<div class="ui-block-content">
						<ul class="widget w-pool">
							<li>
								<p>If you had to choose, which actor do you prefer to be the next Darkman? </p>
							</li>

							<li>
								<div class="skills-item">
									<div class="skills-item-info">
										<span class="skills-item-title">

											<span class="radio">
												<label>
													<input type="radio" name="optionsRadios">
													Thomas Bale
												</label>
											</span>
										</span>
										<span class="skills-item-count"><span class="count-animate" data-speed="1000" data-refresh-interval="50" data-to="62" data-from="0"></span><span class="units">62%</span></span>
									</div>
									<div class="skills-item-meter">
										<span class="skills-item-meter-active bg-primary" style="width: 62%"></span>
									</div>

									<div class="counter-friends">12 friends voted for this</div>

									<ul class="friends-harmonic">
										<li>
											<a href="#">
												<img src="img/friend-harmonic1.jpg" alt="friend">
											</a>
										</li>
										<li>
											<a href="#">
												<img src="img/friend-harmonic2.jpg" alt="friend">
											</a>
										</li>
										<li>
											<a href="#">
												<img src="img/friend-harmonic3.jpg" alt="friend">
											</a>
										</li>
										<li>
											<a href="#">
												<img src="img/friend-harmonic4.jpg" alt="friend">
											</a>
										</li>
										<li>
											<a href="#">
												<img src="img/friend-harmonic5.jpg" alt="friend">
											</a>
										</li>
										<li>
											<a href="#">
												<img src="img/friend-harmonic6.jpg" alt="friend">
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
												<img src="img/friend-harmonic9.jpg" alt="friend">
											</a>
										</li>
										<li>
											<a href="#" class="all-users">+3</a>
										</li>
									</ul>

								</div>
							</li>

							<li>
								<div class="skills-item">
									<div class="skills-item-info">
										<span class="skills-item-title">

											<span class="radio">
												<label>
													<input type="radio" name="optionsRadios">
													Ben Robertson
												</label>
											</span>
										</span>
										<span class="skills-item-count"><span class="count-animate" data-speed="1000" data-refresh-interval="50" data-to="27" data-from="0"></span><span class="units">27%</span></span>
									</div>
									<div class="skills-item-meter">
										<span class="skills-item-meter-active bg-primary" style="width: 27%"></span>
									</div>
									<div class="counter-friends">7 friends voted for this</div>

									<ul class="friends-harmonic">
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
												<img src="img/friend-harmonic9.jpg" alt="friend">
											</a>
										</li>
										<li>
											<a href="#">
												<img src="img/friend-harmonic10.jpg" alt="friend">
											</a>
										</li>
										<li>
											<a href="#">
												<img src="img/friend-harmonic11.jpg" alt="friend">
											</a>
										</li>
										<li>
											<a href="#">
												<img src="img/friend-harmonic12.jpg" alt="friend">
											</a>
										</li>
										<li>
											<a href="#">
												<img src="img/friend-harmonic13.jpg" alt="friend">
											</a>
										</li>
									</ul>
								</div>
							</li>

							<li>
								<div class="skills-item">
									<div class="skills-item-info">
										<span class="skills-item-title">
											<span class="radio">
												<label>
													<input type="radio" name="optionsRadios">
													Michael Streiton
												</label>
											</span>
										</span>
										<span class="skills-item-count"><span class="count-animate" data-speed="1000" data-refresh-interval="50" data-to="11" data-from="0"></span><span class="units">11%</span></span>
									</div>
									<div class="skills-item-meter">
										<span class="skills-item-meter-active bg-primary" style="width: 11%"></span>
									</div>

									<div class="counter-friends">2 people voted for this</div>

									<ul class="friends-harmonic">
										<li>
											<a href="#">
												<img src="img/friend-harmonic14.jpg" alt="friend">
											</a>
										</li>
										<li>
											<a href="#">
												<img src="img/friend-harmonic15.jpg" alt="friend">
											</a>
										</li>
									</ul>
								</div>
							</li>
						</ul>
						<a href="#" class="btn btn-md-2 btn-border-think custom-color c-grey full-width">Vote Now!</a>
					</div>
				</div>

				<div class="ui-block">
					<div class="ui-block-title">
						<h6 class="title">Last Videos</h6>
						<a href="#" class="more"><svg class="olymp-three-dots-icon"><use xlink:href="icons/icons.svg#olymp-three-dots-icon"></use></svg></a>
					</div>
					<div class="ui-block-content">
						<ul class="widget w-last-video">
							<li>
								<a href="https://youtube.com/watch?v=excVFQ2TWig" class="play-video play-video--small">
									<svg class="olymp-play-icon"><use xlink:href="icons/icons.svg#olymp-play-icon"></use></svg>
								</a>
								<img src="img/video1.jpg" alt="video">
								<div class="video-content">
									<div class="title">Green Goo - Live at Dan’s Arena</div>
									<time class="published" datetime="2017-03-24T18:18">5:48</time>
								</div>
								<div class="overlay"></div>
							</li>
							<li>
								<a href="https://youtube.com/watch?v=excVFQ2TWig" class="play-video play-video--small">
									<svg class="olymp-play-icon"><use xlink:href="icons/icons.svg#olymp-play-icon"></use></svg>
								</a>
								<img src="img/video2.jpg" alt="video">
								<div class="video-content">
									<div class="title">Green Goo - Live at Dan’s Arena</div>
									<time class="published" datetime="2017-03-24T18:18">5:48</time>
								</div>
								<div class="overlay"></div>
							</li>
							<li>
								<a href="https://youtube.com/watch?v=excVFQ2TWig" class="play-video play-video--small">
									<svg class="olymp-play-icon"><use xlink:href="icons/icons.svg#olymp-play-icon"></use></svg>
								</a>
								<img src="img/video3.jpg" alt="video">
								<div class="video-content">
									<div class="title">Green Goo - Live at Dan’s Arena</div>
									<time class="published" datetime="2017-03-24T18:18">5:48</time>
								</div>
								<div class="overlay"></div>
							</li>
						</ul>
					</div>
				</div>

			</div>
		</div>
	</div>


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


	<div class="window-popup playlist-popup">

		<a href="" class="icon-close js-close-popup">
			<svg class="olymp-close-icon"><use xlink:href="icons/icons.svg#olymp-close-icon"></use></svg>
		</a>

		<table class="playlist-popup-table">

			<thead>

				<tr>

					<th class="play">
						PLAY
					</th>

					<th class="cover">
						COVER
					</th>

					<th class="song-artist">
						SONG AND ARTIST
					</th>

					<th class="album">
						ALBUM
					</th>

					<th class="released">
						RELEASED
					</th>

					<th class="duration">
						DURATION
					</th>

					<th class="spotify">
						GET IT ON SPOTIFY
					</th>

					<th class="remove">
						REMOVE
					</th>
				</tr>

			</thead>

			<tbody>
				<tr>
					<td class="play">
						<a href="#" class="play-icon">
							<svg class="olymp-music-play-icon-big"><use xlink:href="icons/icons-music.svg#olymp-music-play-icon-big"></use></svg>
						</a>
					</td>
					<td class="cover">
						<div class="playlist-thumb">
							<img src="img/playlist19.jpg" alt="thumb-composition">
						</div>
					</td>
					<td class="song-artist">
						<div class="composition">
							<a href="#" class="composition-name">We Can Be Heroes</a>
							<a href="#" class="composition-author">Jason Bowie</a>
						</div>
					</td>
					<td class="album">
						<a href="#" class="album-composition">Ziggy Firedust</a>
					</td>
					<td class="released">
						<div class="release-year">2014</div>
					</td>
					<td class="duration">
						<div class="composition-time">
							<time class="published" datetime="2017-03-24T18:18">6:17</time>
						</div>
					</td>
					<td class="spotify">
						<i class="fa fa-spotify composition-icon" aria-hidden="true"></i>
					</td>
					<td class="remove">
						<a href="#" class="remove-icon">
							<svg class="olymp-close-icon"><use xlink:href="icons/icons.svg#olymp-close-icon"></use></svg>
						</a>
					</td>
				</tr>

				<tr>
					<td class="play">
						<a href="#" class="play-icon">
							<svg class="olymp-music-play-icon-big"><use xlink:href="icons/icons-music.svg#olymp-music-play-icon-big"></use></svg>
						</a>
					</td>
					<td class="cover">
						<div class="playlist-thumb">
							<img src="img/playlist6.jpg" alt="thumb-composition">
						</div>
					</td>
					<td class="song-artist">
						<div class="composition">
							<a href="#" class="composition-name">The Past Starts Slow and Ends</a>
							<a href="#" class="composition-author">System of a Revenge</a>
						</div>
					</td>
					<td class="album">
						<a href="#" class="album-composition">Wonderize</a>
					</td>
					<td class="released">
						<div class="release-year">2014</div>
					</td>
					<td class="duration">
						<div class="composition-time">
							<time class="published" datetime="2017-03-24T18:18">6:17</time>
						</div>
					</td>
					<td class="spotify">
						<i class="fa fa-spotify composition-icon" aria-hidden="true"></i>
					</td>
					<td class="remove">
						<a href="#" class="remove-icon">
							<svg class="olymp-close-icon"><use xlink:href="icons/icons.svg#olymp-close-icon"></use></svg>
						</a>
					</td>
				</tr>

				<tr>
					<td class="play">
						<a href="#" class="play-icon">
							<svg class="olymp-music-play-icon-big"><use xlink:href="icons/icons-music.svg#olymp-music-play-icon-big"></use></svg>
						</a>
					</td>
					<td class="cover">
						<div class="playlist-thumb">
							<img src="img/playlist7.jpg" alt="thumb-composition">
						</div>
					</td>
					<td class="song-artist">
						<div class="composition">
							<a href="#" class="composition-name">The Pretender</a>
							<a href="#" class="composition-author">Kung Fighters</a>
						</div>
					</td>
					<td class="album">
						<a href="#" class="album-composition">Warping Lights</a>
					</td>
					<td class="released">
						<div class="release-year">2014</div>
					</td>
					<td class="duration">
						<div class="composition-time">
							<time class="published" datetime="2017-03-24T18:18">6:17</time>
						</div>
					</td>
					<td class="spotify">
						<i class="fa fa-spotify composition-icon" aria-hidden="true"></i>
					</td>
					<td class="remove">
						<a href="#" class="remove-icon">
							<svg class="olymp-close-icon"><use xlink:href="icons/icons.svg#olymp-close-icon"></use></svg>
						</a>
					</td>
				</tr>

				<tr>
					<td class="play">
						<a href="#" class="play-icon">
							<svg class="olymp-music-play-icon-big"><use xlink:href="icons/icons-music.svg#olymp-music-play-icon-big"></use></svg>
						</a>
					</td>
					<td class="cover">
						<div class="playlist-thumb">
							<img src="img/playlist8.jpg" alt="thumb-composition">
						</div>
					</td>
					<td class="song-artist">
						<div class="composition">
							<a href="#" class="composition-name">Seven Nation Army</a>
							<a href="#" class="composition-author">The Black Stripes</a>
						</div>
					</td>
					<td class="album">
						<a href="#" class="album-composition ">Icky Strung (LIVE at Cube Garden)</a>
					</td>
					<td class="released">
						<div class="release-year">2014</div>
					</td>
					<td class="duration">
						<div class="composition-time">
							<time class="published" datetime="2017-03-24T18:18">6:17</time>
						</div>
					</td>
					<td class="spotify">
						<i class="fa fa-spotify composition-icon" aria-hidden="true"></i>
					</td>
					<td class="remove">
						<a href="#" class="remove-icon">
							<svg class="olymp-close-icon"><use xlink:href="icons/icons.svg#olymp-close-icon"></use></svg>
						</a>
					</td>
				</tr>

				<tr>
					<td class="play">
						<a href="#" class="play-icon">
							<svg class="olymp-music-play-icon-big"><use xlink:href="icons/icons-music.svg#olymp-music-play-icon-big"></use></svg>
						</a>
					</td>
					<td class="cover">
						<div class="playlist-thumb">
							<img src="img/playlist9.jpg" alt="thumb-composition">
						</div>
					</td>
					<td class="song-artist">
						<div class="composition">
							<a href="#" class="composition-name">Leap of Faith</a>
							<a href="#" class="composition-author">Eden Artifact</a>
						</div>
					</td>
					<td class="album">
						<a href="#" class="album-composition">The Assassins’s Soundtrack</a>
					</td>
					<td class="released">
						<div class="release-year">2014</div>
					</td>
					<td class="duration">
						<div class="composition-time">
							<time class="published" datetime="2017-03-24T18:18">6:17</time>
						</div>
					</td>
					<td class="spotify">
						<i class="fa fa-spotify composition-icon" aria-hidden="true"></i>
					</td>
					<td class="remove">
						<a href="#" class="remove-icon">
							<svg class="olymp-close-icon"><use xlink:href="icons/icons.svg#olymp-close-icon"></use></svg>
						</a>
					</td>
				</tr>

				<tr>
					<td class="play">
						<a href="#" class="play-icon">
							<svg class="olymp-music-play-icon-big"><use xlink:href="icons/icons-music.svg#olymp-music-play-icon-big"></use></svg>
						</a>
					</td>
					<td class="cover">
						<div class="playlist-thumb">
							<img src="img/playlist10.jpg" alt="thumb-composition">
						</div>
					</td>
					<td class="song-artist">
						<div class="composition">
							<a href="#" class="composition-name">Killer Queen</a>
							<a href="#" class="composition-author">Archiduke</a>
						</div>
					</td>
					<td class="album">
						<a href="#" class="album-composition ">News of the Universe</a>
					</td>
					<td class="released">
						<div class="release-year">2014</div>
					</td>
					<td class="duration">
						<div class="composition-time">
							<time class="published" datetime="2017-03-24T18:18">6:17</time>
						</div>
					</td>
					<td class="spotify">
						<i class="fa fa-spotify composition-icon" aria-hidden="true"></i>
					</td>
					<td class="remove">
						<a href="#" class="remove-icon">
							<svg class="olymp-close-icon"><use xlink:href="icons/icons.svg#olymp-close-icon"></use></svg>
						</a>
					</td>
				</tr>
			</tbody>
		</table>

		<audio id="mediaplayer" data-showplaylist="true">
			<source src="mp3/Twice.mp3" title="Track 1" data-poster="track1.png" type="audio/mpeg">
				<source src="mp3/Twice.mp3" title="Track 2" data-poster="track2.png" type="audio/mpeg">
					<source src="mp3/Twice.mp3" title="Track 3" data-poster="track3.png" type="audio/mpeg">
						<source src="mp3/Twice.mp3" title="Track 4" data-poster="track4.png" type="audio/mpeg">
						</audio>

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

						<!-- Load more news AJAX script -->
						<script src="js/ajax-pagination.js"></script>

						<!-- Select / Sorting script -->
						<script src="js/selectize.min.js"></script>

						<!-- Lightbox popup script-->
						<script src="js/jquery.magnific-popup.min.js"></script>

						<script src="js/mediaelement-and-player.min.js"></script>
						<script src="js/mediaelement-playlist-plugin.min.js"></script>

						<script src="js/mediaelement-and-player.min.js"></script>
						<script src="js/mediaelement-playlist-plugin.min.js"></script>


					</body>
					</html>