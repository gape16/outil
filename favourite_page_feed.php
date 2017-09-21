<!DOCTYPE html>
<html lang="en">
<head>

	<title>Favorit Page Feed</title>

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

			<div class="col-xl-6 push-xl-3 col-lg-12 push-lg-0 col-sm-12 col-xs-12">

				<div class="page-description">
					<div class="icon">
						<svg class="olymp-star-icon left-menu-icon"  data-toggle="tooltip" data-placement="right"   data-original-title="FAV PAGE"><use xlink:href="icons/icons.svg#olymp-star-icon"></use></svg>
					</div>
					<span>Here you’ll see the recent updates of your Fav Pages</span>
				</div>
				<div id="newsfeed-items-grid">
					<div class="ui-block">
						<article class="hentry post has-post-thumbnail">

							<div class="post__author author vcard inline-items">
								<img src="img/avatar46-sm.jpg" alt="author">

								<div class="author-date">
									<a class="h6 post__author-name fn" href="#">Mannequin Angel</a>
									<div class="post__date">
										<time class="published" datetime="2017-03-24T18:18">
											36 mins ago
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

							<p>Check out the GIF of our photoshoot from the other day:</p>

							<div class="post-thumb">
								<img class="gif-play-image" data-mode="video" data-mp4="videos/post_video.mp4" src="img/post__thumb3.jpg"  alt="gif">
							</div>

							<div class="post-additional-info inline-items">

								<a href="#" class="post-add-icon inline-items">
									<svg class="olymp-heart-icon"><use xlink:href="icons/icons.svg#olymp-heart-icon"></use></svg>
									<span>15</span>
								</a>

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
								</ul>

								<div class="names-people-likes">
									<a href="#">Diana</a>, <a href="#">Nicholas</a> and
									<br>47 more liked this
								</div>


								<div class="comments-shared">
									<a href="#" class="post-add-icon inline-items">
										<svg class="olymp-speech-balloon-icon"><use xlink:href="icons/icons.svg#olymp-speech-balloon-icon"></use></svg>
										<span>16</span>
									</a>

									<a href="#" class="post-add-icon inline-items">
										<svg class="olymp-share-icon"><use xlink:href="icons/icons.svg#olymp-share-icon"></use></svg>
										<span>0</span>
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
						<article class="hentry post">

							<div class="post__author author vcard inline-items">
								<img src="img/avatar42-sm.jpg" alt="author">

								<div class="author-date">
									<a class="h6 post__author-name fn" href="#">Tapronus Rock</a>
									<div class="post__date">
										<time class="published" datetime="2017-03-24T18:18">
											54 mins ago
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

							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempo incididunt ut
								labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris consequat.
							</p>

							<div class="post-additional-info inline-items">

								<a href="#" class="post-add-icon inline-items">
									<svg class="olymp-heart-icon"><use xlink:href="icons/icons.svg#olymp-heart-icon"></use></svg>
									<span>24</span>
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
									<img src="img/author-page.jpg" alt="author">

									<div class="author-date">
										<a class="h6 post__author-name fn" href="02-ProfilePage.html">James Spiegel</a>
										<div class="post__date">
											<time class="published" datetime="2017-03-24T18:18">
												38 mins ago
											</time>
										</div>
									</div>

									<a href="#" class="more"><svg class="olymp-three-dots-icon"><use xlink:href="icons/icons.svg#olymp-three-dots-icon"></use></svg></a>

								</div>

								<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium der doloremque laudantium.</p>

								<a href="#" class="post-add-icon inline-items">
									<svg class="olymp-heart-icon"><use xlink:href="icons/icons.svg#olymp-heart-icon"></use></svg>
									<span>3</span>
								</a>
								<a href="#" class="reply">Reply</a>
							</li>
							<li>
								<div class="post__author author vcard inline-items">
									<img src="img/avatar1-sm.jpg" alt="author">

									<div class="author-date">
										<a class="h6 post__author-name fn" href="#">Mathilda Brinker</a>
										<div class="post__date">
											<time class="published" datetime="2017-03-24T18:18">
												1 hour ago
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

							<div class="form-group with-icon-right ">
								<textarea class="form-control" placeholder=""  ></textarea>
								<div class="add-options-message">
									<a href="#" class="options-message" data-toggle="modal" data-target="#update-header-photo">
										<svg class="olymp-camera-icon"><use xlink:href="icons/icons.svg#olymp-camera-icon"></use></svg>
									</a>
								</div>

								<span class="material-input"></span></div>

							</form>

						</div>

						<div class="ui-block">
							<article class="hentry post">

								<div class="post__author author vcard inline-items">
									<img src="img/avatar47-sm.jpg" alt="author">

									<div class="author-date">
										<a class="h6 post__author-name fn" href="#">Blue Whale Pizzas</a> uploaded 16 <a href="#">new photos</a>
										<div class="post__date">
											<time class="published" datetime="2017-03-24T18:18">
												7 hours ago
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

								<p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia erunt mollit anim id
									est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium.
								</p>

								<div class="post-block-photo js-zoom-gallery">
									<a href="img/post-photo7.jpg" class="half-width"><img src="img/post-photo7.jpg" alt="photo"></a>
									<a href="img/post-photo2.jpg" class="half-width"><img src="img/post-photo2.jpg" alt="photo"></a>
									<a href="img/post-photo3.jpg" class="col-3-width"><img src="img/post-photo3.jpg" alt="photo"></a>
									<a href="img/post-photo4.jpg" class="col-3-width"><img src="img/post-photo4.jpg" alt="photo"></a>
									<a href="img/post-photo5.jpg" class="more-photos col-3-width">
										<img src="img/post-photo5.jpg" alt="photo">
										<span class="h2">+12</span>
									</a>
								</div>

								<div class="post-additional-info inline-items">

									<a href="#" class="post-add-icon inline-items">
										<svg class="olymp-heart-icon"><use xlink:href="icons/icons.svg#olymp-heart-icon"></use></svg>
										<span>0</span>
									</a>

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
					</div>

					<a id="load-more-button" href="#" class="btn btn-control btn-more" data-load-link="items-to-load.html" data-container="newsfeed-items-grid"><svg class="olymp-three-dots-icon"><use xlink:href="icons/icons.svg#olymp-three-dots-icon"></use></svg></a>

				</div>

				<div class="col-xl-3 pull-xl-6 col-lg-6 pull-lg-0 col-md-6 col-sm-12 col-xs-12">
					<div class="ui-block">
						<div class="ui-block-title">
							<h6 class="title">Friend Suggestions</h6>
							<a href="#" class="more"><svg class="olymp-three-dots-icon"><use xlink:href="icons/icons.svg#olymp-three-dots-icon"></use></svg></a>
						</div>

						<ul class="widget w-friend-pages-added notification-list friend-requests">
							<li class="inline-items">
								<div class="author-thumb">
									<img src="img/avatar38-sm.jpg" alt="author">
								</div>
								<div class="notification-event">
									<a href="#" class="h6 notification-friend">Francine Smith</a>
									<span class="chat-message-item">8 Friends in Common</span>
								</div>
								<span class="notification-icon">
									<a href="#" class="accept-request">
										<span class="icon-add without-text">
											<svg class="olymp-happy-face-icon"><use xlink:href="icons/icons.svg#olymp-happy-face-icon"></use></svg>
										</span>
									</a>
								</span>

							</li>

							<li class="inline-items">
								<div class="author-thumb">
									<img src="img/avatar39-sm.jpg" alt="author">
								</div>
								<div class="notification-event">
									<a href="#" class="h6 notification-friend">Hugh Wilson</a>
									<span class="chat-message-item">6 Friends in Common</span>
								</div>
								<span class="notification-icon">
									<a href="#" class="accept-request">
										<span class="icon-add without-text">
											<svg class="olymp-happy-face-icon"><use xlink:href="icons/icons.svg#olymp-happy-face-icon"></use></svg>
										</span>
									</a>
								</span>

							</li>

							<li class="inline-items">
								<div class="author-thumb">
									<img src="img/avatar40-sm.jpg" alt="author">
								</div>
								<div class="notification-event">
									<a href="#" class="h6 notification-friend">Karen Masters</a>
									<span class="chat-message-item">6 Friends in Common</span>
								</div>
								<span class="notification-icon">
									<a href="#" class="accept-request">
										<span class="icon-add without-text">
											<svg class="olymp-happy-face-icon"><use xlink:href="icons/icons.svg#olymp-happy-face-icon"></use></svg>
										</span>
									</a>
								</span>

							</li>

						</ul>

					</div>

					<div class="ui-block">
						<div class="ui-block-title">
							<h6 class="title">Pages You May Like</h6>
							<a href="#" class="more"><svg class="olymp-three-dots-icon"><use xlink:href="icons/icons.svg#olymp-three-dots-icon"></use></svg></a>
						</div>

						<ul class="widget w-friend-pages-added notification-list friend-requests">
							<li class="inline-items">
								<div class="author-thumb">
									<img src="img/avatar41-sm.jpg" alt="author">
								</div>
								<div class="notification-event">
									<a href="#" class="h6 notification-friend">The Marina Bar</a>
									<span class="chat-message-item">Restaurant / Bar</span>
								</div>
								<span class="notification-icon" data-toggle="tooltip" data-placement="top" title="ADD TO YOUR FAVS">
									<a href="#">
										<svg class="olymp-star-icon left-menu-icon"  data-toggle="tooltip" data-placement="right"   data-original-title="FAV PAGE"><use xlink:href="icons/icons.svg#olymp-star-icon"></use></svg>
									</a>
								</span>

							</li>

							<li class="inline-items">
								<div class="author-thumb">
									<img src="img/avatar42-sm.jpg" alt="author">
								</div>
								<div class="notification-event">
									<a href="#" class="h6 notification-friend">Tapronus Rock</a>
									<span class="chat-message-item">Rock Band</span>
								</div>
								<span class="notification-icon" data-toggle="tooltip" data-placement="top" title="ADD TO YOUR FAVS">
									<a href="#">
										<svg class="olymp-star-icon left-menu-icon"  data-toggle="tooltip" data-placement="right"   data-original-title="FAV PAGE"><use xlink:href="icons/icons.svg#olymp-star-icon"></use></svg>
									</a>
								</span>

							</li>

							<li class="inline-items">
								<div class="author-thumb">
									<img src="img/avatar43-sm.jpg" alt="author">
								</div>
								<div class="notification-event">
									<a href="#" class="h6 notification-friend">Pixel Digital Design</a>
									<span class="chat-message-item">Company</span>
								</div>
								<span class="notification-icon" data-toggle="tooltip" data-placement="top" title="ADD TO YOUR FAVS">
									<a href="#">
										<svg class="olymp-star-icon left-menu-icon"  data-toggle="tooltip" data-placement="right"   data-original-title="FAV PAGE"><use xlink:href="icons/icons.svg#olymp-star-icon"></use></svg>
									</a>
								</span>

							</li>

							<li class="inline-items">
								<div class="author-thumb">
									<img src="img/avatar44-sm.jpg" alt="author">
								</div>
								<div class="notification-event">
									<a href="#" class="h6 notification-friend">Thompson’s Custom Clothing Boutique</a>
									<span class="chat-message-item">Clothing Store</span>
								</div>
								<span class="notification-icon" data-toggle="tooltip" data-placement="top" title="ADD TO YOUR FAVS">
									<a href="#">
										<svg class="olymp-star-icon left-menu-icon"  data-toggle="tooltip" data-placement="right"   data-original-title="FAV PAGE"><use xlink:href="icons/icons.svg#olymp-star-icon"></use></svg>
									</a>
								</span>

							</li>

							<li class="inline-items">
								<div class="author-thumb">
									<img src="img/avatar45-sm.jpg" alt="author">
								</div>
								<div class="notification-event">
									<a href="#" class="h6 notification-friend">Crimson Agency</a>
									<span class="chat-message-item">Company</span>
								</div>
								<span class="notification-icon" data-toggle="tooltip" data-placement="top" title="ADD TO YOUR FAVS">
									<a href="#">
										<svg class="olymp-star-icon left-menu-icon"  data-toggle="tooltip" data-placement="right"   data-original-title="FAV PAGE"><use xlink:href="icons/icons.svg#olymp-star-icon"></use></svg>
									</a>
								</span>
							</li>

							<li class="inline-items">
								<div class="author-thumb">
									<img src="img/avatar46-sm.jpg" alt="author">
								</div>
								<div class="notification-event">
									<a href="#" class="h6 notification-friend">Mannequin Angel</a>
									<span class="chat-message-item">Clothing Store</span>
								</div>
								<span class="notification-icon" data-toggle="tooltip" data-placement="top" title="ADD TO YOUR FAVS">
									<a href="#">
										<svg class="olymp-star-icon left-menu-icon"  data-toggle="tooltip" data-placement="right"   data-original-title="FAV PAGE"><use xlink:href="icons/icons.svg#olymp-star-icon"></use></svg>
									</a>
								</span>
							</li>

						</ul>

					</div>

				</div>

				<div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-xs-12">


					<div class="ui-block">
						<div class="widget w-create-fav-page">
							<div class="icons-block">
								<svg class="olymp-star-icon left-menu-icon"  data-toggle="tooltip" data-placement="right"   data-original-title="FAV PAGE"><use xlink:href="icons/icons.svg#olymp-star-icon"></use></svg>

								<a href="#" class="more"><svg class="olymp-three-dots-icon"><use xlink:href="icons/icons.svg#olymp-three-dots-icon"></use></svg></a>
							</div>

							<div class="content">
								<span>Be like them and</span>
								<h3 class="title">Create your own Favourite Page!</h3>
								<a href="36-FavPage-SettingsAndCreatePopup.html" class="btn btn-bg-secondary btn-sm">Start Now!</a>
							</div>
						</div>
					</div>

					<div class="ui-block">
						<div class="ui-block-title">
							<h6 class="title">Your Fav Pages (54)</h6>
							<a href="#" class="more"><svg class="olymp-three-dots-icon"><use xlink:href="icons/icons.svg#olymp-three-dots-icon"></use></svg></a>
						</div>
						<div class="ui-block-content">
							<ul class="widget w-faved-page">
								<li>
									<a href="#">
										<img src="img/avatar41-sm.jpg" alt="author">
									</a>
								</li>
								<li>
									<a href="#">
										<img src="img/faved-page7.jpg" alt="user">
									</a>
								</li>
								<li>
									<a href="#">
										<img src="img/avatar43-sm.jpg" alt="author">
									</a>
								</li>
								<li>
									<a href="#">
										<img src="img/faved-page7.jpg" alt="user">
									</a>
								</li>
								<li>
									<a href="#">
										<img src="img/avatar44-sm.jpg" alt="author">
									</a>
								</li>
								<li>
									<a href="#">
										<img src="img/avatar42-sm.jpg" alt="author">
									</a>
								</li>
								<li>
									<a href="#">
										<img src="img/faved-page7.jpg" alt="user">
									</a>
								</li>
								<li>
									<a href="#">
										<img src="img/avatar45-sm.jpg" alt="author">
									</a>
								</li>
								<li>
									<a href="#">
										<img src="img/avatar46-sm.jpg" alt="author">
									</a>
								</li>
								<li>
									<a href="#">
										<img src="img/faved-page7.jpg" alt="user">
									</a>
								</li>
								<li>
									<a href="#">
										<img src="img/faved-page1.jpg" alt="user">
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
									<a href="#">+40</a>
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
			<!-- Gif Player script-->
			<script src="js/jquery.gifplayer.js"></script>

			<script src="js/mediaelement-and-player.min.js"></script>
			<script src="js/mediaelement-playlist-plugin.min.js"></script>


		</body>
		</html>