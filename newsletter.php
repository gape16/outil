<?php

// Connexion à la base de donnée et insertion de session_start
include('connexion_session.php');
if (isset($_SESSION['id_statut'])) {
	$id_graph=$_SESSION['id_graph'];
	// $bdd->exec('SET NAMES utf8');
	$requete=$bdd->prepare("SELECT * FROM user where id_user = ?");
	$requete->bindParam(1, $id_graph);
	$requete->execute();
	$result_user=$requete->fetch(PDO::FETCH_ASSOC);
	?>

	<!DOCTYPE html>
	<html lang="en">
	<head>

		<title>Les clients</title>

		<!-- Required meta tags always come first -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="x-ua-compatible" content="ie=edge">

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" type="text/css" href="css/bootstrap-reboot.css">
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="css/bootstrap-grid.css">

		<!-- Theme Styles CSS -->
		<link rel="stylesheet" type="text/css" href="css/theme-styles.css">
		<link rel="stylesheet" type="text/css" href="css/blocks.css">

		<!-- Main Font -->
		<link rel="stylesheet" type="text/css" href="css/introjs.css">
		<!-- <link href="css/introjs-dark.css" rel="stylesheet"> -->
		<link rel="stylesheet" type="text/css" href="css/introjs-rtl.css">
		<link rel="stylesheet" type="text/css" href="css/simplecalendar.css">
		<style>
		#content_news {
			padding-left: 70px !important;
			padding: 1.5rem 1.1rem .2rem;
			line-height: 1.8;
			color: #464a4c;
			background-color: transparent;
			border-color: #ffc6ba;
			outline: none;
			min-height: 160px;
			border-radius: 0;
			border-top: none;
			border-left: none;
			border-right: none;
			resize: none;
			font-size: 13px;
		}

		.toolbar {
			text-align: left;
		}

		.toolbar a,
		.fore-wrapper,
		.back-wrapper {
			border: 1px solid #AAA;
			background: #FFF;
			font-family: 'Candal';
			border-radius: 1px;
			color: black;
			padding: 5px;
			width: 1.5em;
			margin: -2px;
			margin-top: 10px;
			display: inline-block;
			text-decoration: none;
			box-shadow: 0px 1px 0px #CCC;
			box-sizing: content-box;
			text-align: center;
		}

		.toolbar a:hover,
		.fore-wrapper:hover,
		.back-wrapper:hover {
			background: #f2f2f2;
			border-color: #8c8c8c;
		}

		a[data-command='redo'],
		a[data-command='strikeThrough'],
		a[data-command='justifyFull'],
		a[data-command='insertOrderedList'],
		a[data-command='outdent'],
		a[data-command='p'],
		a[data-command='superscript'] {
			margin-right: 5px;
			border-radius: 0 3px 3px 0;
		}

		a[data-command='undo'],
		.fore-wrapper,
		a[data-command='justifyLeft'],
		a[data-command='insertUnorderedList'],
		a[data-command='indent'],
		a[data-command='h1'],
		a[data-command='subscript'] {
			border-radius: 3px 0 0 3px;
		}

		a.palette-item {
			height: 1em;
			border-radius: 3px;
			margin: 2px;
			width: 1em;
			border: 1px solid #CCC;
		}

		a.palette-item:hover {
			border: 1px solid #CCC;
			box-shadow: 0 0 3px #333;
		}

		.fore-palette,
		.back-palette {
			display: none;
		}

		.fore-wrapper,
		.back-wrapper {
			display: inline-block;
			cursor: pointer;
		}

		.fore-wrapper:hover .fore-palette,
		.back-wrapper:hover .back-palette {
			display: block;
			float: left;
			position: absolute;
			padding: 3px;
			width: 160px;
			background: #FFF;
			border: 1px solid #DDD;
			box-shadow: 0 0 5px #CCC;
			height: 70px;
		}

		.fore-palette a,
		.back-palette a {
			background: #FFF;
			margin-bottom: 2px;
		}
	</style>
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
	<!-- Custom CSS -->
	<link rel="stylesheet" href="css/main.css">
	<link rel="stylesheet" href="css/jquery.fancybox.min.css">

</head>

<body>


	<?php 
	if($_SESSION['id_statut']==1) {
		//page graphistes 
		include('left_sidebar.php');
		include('header.php');
	}elseif  ($_SESSION['id_statut']==2){
		//page  redacteurs
		include('left_sidebar_redac.php');
		include('header_redac.php');
	}
	elseif ($_SESSION['id_statut']==3) {
		//page leader
		include('left_sidebar_leader.php');
		include('header_leader.php');
	}elseif ($_SESSION['id_statut']==4) {
		//page controleur
		include('left_sidebar_controleur.php');
		include('header_controleur.php');
	}elseif($_SESSION['id_statut']==5){
		//page admin
		include('left_sidebar_admin.php');
		include('header_admin.php');
	}
	?>



	<!-- Responsive Header -->

	<?php include('responsive_header.php');?>

	<!-- ... end Responsive Header -->

	<!-- ... end Responsive Header -->


	<div class="header-spacer"></div>


	<div class="container">
		<div class="row">

			<!-- Main Content -->

			<main class="col-xl-6 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-xs-12">

				<div class="ui-block">
					<div class="news-feed-form">
						<!-- Nav tabs -->
						<ul class="nav nav-tabs" role="tablist">
							<li class="nav-item">
								<a class="nav-link active inline-items" data-toggle="tab" href="#home-1" role="tab" aria-expanded="true">

									<svg class="olymp-status-icon"><use xlink:href="icons/icons.svg#olymp-status-icon"></use></svg>

									<span>Newsletter</span>
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link inline-items" data-toggle="tab" href="#profile-1" role="tab" aria-expanded="false">

									<svg class="olymp-multimedia-icon"><use xlink:href="icons/icons.svg#olymp-multimedia-icon"></use></svg>

									<span>Veille technologique</span>
								</a>
							</li>

							<li class="nav-item">
								<a class="nav-link inline-items" data-toggle="tab" href="#blog" role="tab" aria-expanded="false">
									<svg class="olymp-blog-icon"><use xlink:href="icons/icons.svg#olymp-blog-icon"></use></svg>

									<span>Information</span>
								</a>
							</li>
						</ul>

						<!-- Tab panes -->
						<div class="tab-content">
							<div class="tab-pane active" id="home-1" role="tabpanel" aria-expanded="true">
								<form>
									<div class="author-thumb">
										<img src="<?php echo utf8_encode($result_user['photo_avatar']);?>" alt="author">
									</div>
									<div class="form-group with-icon label-floating is-empty">
										<label class="control-label">Publier une newsletter...</label>
										<textarea class="form-control" placeholder="" style="display: none;"></textarea>
										<div contenteditable="true" id="content_news"></div>
										<input type="file" id="choose_photo" style="display: none;">
									</div>
									<div class="add-options-message">
										<div class="toolbar">
											<a href="#" data-command='undo'><i class='fa fa-undo'></i></a>
											<a href="#" data-command='redo'><i class='fa fa-repeat'></i></a>
											<div class="fore-wrapper"><i class='fa fa-font' style='color:#C96;'></i>
												<div class="fore-palette">
												</div>
											</div>
											<div class="back-wrapper"><i class='fa fa-font' style='background:#C96;'></i>
												<div class="back-palette">
												</div>
											</div>
											<a href="#" data-command='bold'><i class='fa fa-bold'></i></a>
											<a href="#" data-command='italic'><i class='fa fa-italic'></i></a>
											<a href="#" data-command='underline'><i class='fa fa-underline'></i></a>
											<a href="#" data-command='strikeThrough'><i class='fa fa-strikethrough'></i></a>
											<a href="#" data-command='justifyLeft'><i class='fa fa-align-left'></i></a>
											<a href="#" data-command='justifyCenter'><i class='fa fa-align-center'></i></a>
											<a href="#" data-command='justifyRight'><i class='fa fa-align-right'></i></a>
											<a href="#" data-command='justifyFull'><i class='fa fa-align-justify'></i></a>
											<a href="#" data-command='indent'><i class='fa fa-indent'></i></a>
											<a href="#" data-command='outdent'><i class='fa fa-outdent'></i></a>
											<a href="#" data-command='insertUnorderedList'><i class='fa fa-list-ul'></i></a>
											<a href="#" data-command='insertOrderedList'><i class='fa fa-list-ol'></i></a>

											<a href="#" data-command='createlink'><i class='fa fa-link'></i></a>
											<a href="#" data-command='unlink'><i class='fa fa-unlink'></i></a>
											<a href="#" data-command='moins'><i class="fa fa-font" style="font-size: 10px;"></i></a>
											<a href="#" data-command='plus'><i class="fa fa-font" style="font-size: 15px;"></i></a>
										</div>
										<a class="options-message" data-toggle="tooltip" data-placement="top"   data-original-title="ADD PHOTOS">
											<svg class="olymp-camera-icon" data-toggle="modal" data-target="#update-header-photo"><use xlink:href="icons/icons.svg#olymp-camera-icon"></use></svg>
										</a>
										<a class="options-message" data-toggle="tooltip" data-placement="top"   data-original-title="TAG YOUR FRIENDS">
											<svg class="olymp-computer-icon"><use xlink:href="icons/icons.svg#olymp-computer-icon"></use></svg>
										</a>

										<a class="options-message" data-toggle="tooltip" data-placement="top"   data-original-title="ADD LOCATION">
											<svg class="olymp-small-pin-icon"><use xlink:href="icons/icons.svg#olymp-small-pin-icon"></use></svg>
										</a>

										<button class="btn btn-primary btn-md-2">Poster</button>
										<button   class="btn btn-md-2 btn-border-think btn-transparent c-grey">Aperçu</button>

									</div>

								</form>
							</div>

							<div class="tab-pane" id="profile-1" role="tabpanel" aria-expanded="true">
								<form>
									<div class="author-thumb">
										<img src="img/author-page.jpg" alt="author">
									</div>
									<div class="form-group with-icon label-floating is-empty">
										<label class="control-label">Share what you are thinking here...</label>
										<textarea class="form-control" placeholder=""  ></textarea>
									</div>
									<div class="add-options-message">
										<a href="#" class="options-message" data-toggle="tooltip" data-placement="top"   data-original-title="ADD PHOTOS">
											<svg class="olymp-camera-icon" data-toggle="modal" data-target="#update-header-photo"><use xlink:href="icons/icons.svg#olymp-camera-icon"></use></svg>
										</a>
										<a href="#" class="options-message" data-toggle="tooltip" data-placement="top"   data-original-title="TAG YOUR FRIENDS">
											<svg class="olymp-computer-icon"><use xlink:href="icons/icons.svg#olymp-computer-icon"></use></svg>
										</a>

										<a href="#" class="options-message" data-toggle="tooltip" data-placement="top"   data-original-title="ADD LOCATION">
											<svg class="olymp-small-pin-icon"><use xlink:href="icons/icons.svg#olymp-small-pin-icon"></use></svg>
										</a>

										<button class="btn btn-primary btn-md-2">Post Status</button>
										<button   class="btn btn-md-2 btn-border-think btn-transparent c-grey">Preview</button>

									</div>

								</form>
							</div>

							<div class="tab-pane" id="blog" role="tabpanel" aria-expanded="true">
								<form>
									<div class="author-thumb">
										<img src="img/author-page.jpg" alt="author">
									</div>
									<div class="form-group with-icon label-floating is-empty">
										<label class="control-label">Share what you are thinking here...</label>
										<textarea class="form-control" placeholder=""  ></textarea>
									</div>
									<div class="add-options-message">
										<a href="#" class="options-message" data-toggle="tooltip" data-placement="top"   data-original-title="ADD PHOTOS">
											<svg class="olymp-camera-icon" data-toggle="modal" data-target="#update-header-photo"><use xlink:href="icons/icons.svg#olymp-camera-icon"></use></svg>
										</a>
										<a href="#" class="options-message" data-toggle="tooltip" data-placement="top"   data-original-title="TAG YOUR FRIENDS">
											<svg class="olymp-computer-icon"><use xlink:href="icons/icons.svg#olymp-computer-icon"></use></svg>
										</a>

										<a href="#" class="options-message" data-toggle="tooltip" data-placement="top"   data-original-title="ADD LOCATION">
											<svg class="olymp-small-pin-icon"><use xlink:href="icons/icons.svg#olymp-small-pin-icon"></use></svg>
										</a>

										<button class="btn btn-primary btn-md-2">Post Status</button>
										<button   class="btn btn-md-2 btn-border-think btn-transparent c-grey">Preview</button>

									</div>

								</form>
							</div>
						</div>
					</div>
				</div>

				<div id="newsfeed-items-grid">

					<div class="ui-block">
						<article class="hentry post video">

							<div class="post__author author vcard inline-items">
								<img src="img/avatar7-sm.jpg" alt="author">

								<div class="author-date">
									<a class="h6 post__author-name fn" href="#">Marina Valentine</a> shared a <a href="#">link</a>
									<div class="post__date">
										<time class="published" datetime="2004-07-24T18:18">
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
									<img src="img/video-youtube1.jpg" alt="photo">
									<a href="https://youtube.com/watch?v=excVFQ2TWig" class="play-video">
										<svg class="olymp-play-icon"><use xlink:href="icons/icons.svg#olymp-play-icon"></use></svg>
									</a>
								</div>

								<div class="video-content">
									<a href="#" class="h4 title">Iron Maid - ChillGroves</a>
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

					<div class="ui-block">
						<article class="hentry post">

							<div class="post__author author vcard inline-items">
								<img src="img/avatar10-sm.jpg" alt="author">

								<div class="author-date">
									<a class="h6 post__author-name fn" href="#">Elaine Dreyfuss</a>
									<div class="post__date">
										<time class="published" datetime="2004-07-24T18:18">
											9 hours ago
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
									<br>22 more liked this
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
											<time class="published" datetime="2004-07-24T18:18">
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
											<time class="published" datetime="2004-07-24T18:18">
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

								<div class="form-group with-icon-right ">
									<textarea class="form-control" placeholder=""  ></textarea>
									<div class="add-options-message">
										<a href="#" class="options-message" data-toggle="modal" data-target="#update-header-photo">
											<svg class="olymp-camera-icon"><use xlink:href="icons/icons.svg#olymp-camera-icon"></use></svg>
										</a>
									</div>
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
										<time class="published" datetime="2004-07-24T18:18">
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
						<article class="hentry post has-post-thumbnail">

							<div class="post__author author vcard inline-items">
								<img src="img/avatar3-sm.jpg" alt="author">

								<div class="author-date">
									<a class="h6 post__author-name fn" href="#">Sarah Hetfield</a>
									<div class="post__date">
										<time class="published" datetime="2004-07-24T18:18">
											March 2 at 9:06am
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

							<p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
								pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt
								mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque.
							</p>

							<div class="post-additional-info inline-items">

								<a href="#" class="post-add-icon inline-items">
									<svg class="olymp-heart-icon"><use xlink:href="icons/icons.svg#olymp-heart-icon"></use></svg>
									<span>0 Likes</span>
								</a>

								<div class="comments-shared">
									<a href="#" class="post-add-icon inline-items">
										<svg class="olymp-speech-balloon-icon"><use xlink:href="icons/icons.svg#olymp-speech-balloon-icon"></use></svg>
										<span>0 Comments</span>
									</a>

									<a href="#" class="post-add-icon inline-items">
										<svg class="olymp-share-icon"><use xlink:href="icons/icons.svg#olymp-share-icon"></use></svg>
										<span>2 Shares</span>
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
								<img src="img/avatar2-sm.jpg" alt="author">

								<div class="author-date">
									<a class="h6 post__author-name fn" href="#">Nicholas Grissom</a>
									<div class="post__date">
										<time class="published" datetime="2004-07-24T18:18">
											March 2 at 8:34am
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

							<p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
								pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt
								mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem
								accusantium doloremque.
							</p>

							<div class="post-additional-info inline-items">

								<a href="#" class="post-add-icon inline-items">
									<svg class="olymp-heart-icon"><use xlink:href="icons/icons.svg#olymp-heart-icon"></use></svg>
									<span>22</span>
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
										<span>0</span>
									</a>

									<a href="#" class="post-add-icon inline-items">
										<svg class="olymp-share-icon"><use xlink:href="icons/icons.svg#olymp-share-icon"></use></svg>
										<span>2</span>
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


			</main>

			<!-- ... end Main Content -->


			<!-- Left Sidebar -->

			<aside class="col-xl-3 order-xl-1 col-lg-6 order-lg-2 col-md-6 col-sm-12 col-xs-12">
				<div class="ui-block">
					<div class="widget w-wethear">
						<a href="#" class="more"><svg class="olymp-three-dots-icon"><use xlink:href="icons/icons.svg#olymp-three-dots-icon"></use></svg></a>

						<div class="wethear-now inline-items">
							<div class="temperature-sensor">64°</div>
							<div class="max-min-temperature">
								<span>58°</span>
								<span>76°</span>
							</div>

							<svg class="olymp-weather-partly-sunny-icon"><use xlink:href="icons/icons-weather.svg#olymp-weather-partly-sunny-icon"></use></svg>
						</div>

						<div class="wethear-now-description">
							<div class="climate">Partly Sunny</div>
							<span>Real Feel: <span>67°</span></span>
							<span>Chance of Rain: <span>49%</span></span>
						</div>

						<ul class="weekly-forecast">

							<li>
								<div class="day">sun</div>
								<svg class="olymp-weather-sunny-icon"><use xlink:href="icons/icons-weather.svg#olymp-weather-sunny-icon"></use></svg>

								<div class="temperature-sensor-day">60°</div>
							</li>

							<li>
								<div class="day">mon</div>
								<svg class="olymp-weather-partly-sunny-icon"><use xlink:href="icons/icons-weather.svg#olymp-weather-partly-sunny-icon"></use></svg>
								<div class="temperature-sensor-day">58°</div>
							</li>

							<li>
								<div class="day">tue</div>
								<svg class="olymp-weather-cloudy-icon"><use xlink:href="icons/icons-weather.svg#olymp-weather-cloudy-icon"></use></svg>

								<div class="temperature-sensor-day">67°</div>
							</li>

							<li>
								<div class="day">wed</div>
								<svg class="olymp-weather-rain-icon"><use xlink:href="icons/icons-weather.svg#olymp-weather-rain-icon"></use></svg>

								<div class="temperature-sensor-day">70°</div>
							</li>

							<li>
								<div class="day">thu</div>
								<svg class="olymp-weather-storm-icon"><use xlink:href="icons/icons-weather.svg#olymp-weather-storm-icon"></use></svg>

								<div class="temperature-sensor-day">58°</div>
							</li>

							<li>
								<div class="day">fri</div>
								<svg class="olymp-weather-snow-icon"><use xlink:href="icons/icons-weather.svg#olymp-weather-snow-icon"></use></svg>

								<div class="temperature-sensor-day">68°</div>
							</li>

							<li>
								<div class="day">sat</div>

								<svg class="olymp-weather-wind-icon-header"><use xlink:href="icons/icons-weather.svg#olymp-weather-wind-icon-header"></use></svg>

								<div class="temperature-sensor-day">65°</div>
							</li>

						</ul>

						<div class="date-and-place">
							<h5 class="date">Saturday, March 26th</h5>
							<div class="place">San Francisco, CA</div>
						</div>

					</div>
				</div>


				<div class="ui-block">
					<div class="calendar-container">
						<div class="calendar">
							<header>
								<h6 class="month">March 2017</h6>
								<a class="calendar-btn-prev fontawesome-angle-left" href="#"></a>
								<a class="calendar-btn-next fontawesome-angle-right" href="#"></a>
							</header>
							<table>
								<thead>
									<tr><td>Mon</td><td>Tue</td><td>Wed</td><td>Thu</td><td>Fri</td><td>Sat</td><td>San</td></tr>
								</thead>
								<tbody>
									<tr>
										<td date-month="12" date-day="1">1</td>
										<td date-month="12" date-day="2" class="event-uncomplited event-complited">
											2
										</td>
										<td date-month="12" date-day="3">3</td>
										<td date-month="12" date-day="4">4</td>
										<td date-month="12" date-day="5">5</td>
										<td date-month="12" date-day="6">6</td>
										<td date-month="12" date-day="7">7</td>
									</tr>
									<tr>
										<td date-month="12" date-day="8">8</td>
										<td date-month="12" date-day="9">9</td>
										<td date-month="12" date-day="10" class="event-complited">10</td>
										<td date-month="12" date-day="11">11</td>
										<td date-month="12" date-day="12">12</td>
										<td date-month="12" date-day="13">13</td>
										<td date-month="12" date-day="14">14</td>
									</tr>
									<tr>
										<td date-month="12" date-day="15" class="event-complited-2">15</td>
										<td date-month="12" date-day="16">16</td>
										<td date-month="12" date-day="17">17</td>
										<td date-month="12" date-day="18">18</td>
										<td date-month="12" date-day="19">19</td>
										<td date-month="12" date-day="20">20</td>
										<td date-month="12" date-day="21">21</td>
									</tr>
									<tr>
										<td date-month="12" date-day="22">22</td>
										<td date-month="12" date-day="23">23</td>
										<td date-month="12" date-day="24">24</td>
										<td date-month="12" date-day="25">25</td>
										<td date-month="12" date-day="26">26</td>
										<td date-month="12" date-day="27">27</td>
										<td date-month="12" date-day="28" class="event-uncomplited">28</td>
									</tr>
									<tr>
										<td date-month="12" date-day="29">29</td>
										<td date-month="12" date-day="30">30</td>
										<td date-month="12" date-day="31">31</td>
									</tr>
								</tbody>
							</table>
							<div class="list">


								<div id="accordion-1" role="tablist" aria-multiselectable="true" class="day-event" date-month="12" date-day="2">
									<div class="ui-block-title ui-block-title-small">
										<h6 class="title">TODAY’S EVENTS</h6>
									</div>
									<div class="card">
										<div class="card-header" role="tab" id="headingOne-1">
											<div class="event-time">
												<span class="circle"></span>
												<time datetime="2004-07-24T18:18">9:00am</time>
												<a href="#" class="more"><svg class="olymp-three-dots-icon"><use xlink:href="icons/icons.svg#olymp-three-dots-icon"></use></svg></a>
											</div>
											<h5 class="mb-0">
												<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne-1" aria-expanded="true" aria-controls="collapseOne-1">
													Breakfast at the Agency<svg class="olymp-dropdown-arrow-icon"><use xlink:href="icons/icons.svg#olymp-dropdown-arrow-icon"></use></svg>
												</a>
											</h5>
										</div>

										<div id="collapseOne-1" class="collapse" role="tabpanel" >
											<div class="card-body">
												Hi Guys! I propose to go a litle earlier at the agency to have breakfast and talk a little more about the new design project we have been working on. Cheers!
											</div>
											<div class="place inline-items">
												<svg class="olymp-add-a-place-icon"><use xlink:href="icons/icons.svg#olymp-add-a-place-icon"></use></svg>
												<span>Daydreamz Agency</span>
											</div>

											<ul class="friends-harmonic inline-items">
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
												<li class="with-text">
													Will Assist
												</li>
											</ul>
										</div>
									</div>

									<div class="card">
										<div class="card-header" role="tab" id="headingTwo-1">
											<div class="event-time">
												<span class="circle"></span>
												<time datetime="2004-07-24T18:18">9:00am</time>
												<a href="#" class="more"><svg class="olymp-three-dots-icon"><use xlink:href="icons/icons.svg#olymp-three-dots-icon"></use></svg></a>
											</div>
											<h5 class="mb-0">
												<a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo-1" aria-expanded="true" aria-controls="collapseTwo-1">
													Send the new “Olympus” project files to the Agency<svg class="olymp-dropdown-arrow-icon"><use xlink:href="icons/icons.svg#olymp-dropdown-arrow-icon"></use></svg>
												</a>
											</h5>
										</div>

										<div id="collapseTwo-1" class="collapse" role="tabpanel">
											<div class="card-body">
												Hi Guys! I propose to go a litle earlier at the agency to have breakfast and talk a little more about the new design project we have been working on. Cheers!
											</div>
										</div>

									</div>

									<div class="card">
										<div class="card-header" role="tab" id="headingThree-1">
											<div class="event-time">
												<span class="circle"></span>
												<time datetime="2004-07-24T18:18">6:30am</time>
												<a href="#" class="more"><svg class="olymp-three-dots-icon"><use xlink:href="icons/icons.svg#olymp-three-dots-icon"></use></svg></a>
											</div>
											<h5 class="mb-0">
												<a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#" aria-expanded="false">
													Take Querty to the Veterinarian
												</a>
											</h5>
										</div>
										<div class="place inline-items">
											<svg class="olymp-add-a-place-icon"><use xlink:href="icons/icons.svg#olymp-add-a-place-icon"></use></svg>
											<span>Daydreamz Agency</span>
										</div>
									</div>

									<a href="#" class="check-all">Check all your Events</a>
								</div>

								<div id="accordion-2" role="tablist" aria-multiselectable="true" class="day-event" date-month="12" date-day="10">
									<div class="ui-block-title ui-block-title-small">
										<h6 class="title">TODAY’S EVENTS</h6>
									</div>
									<div class="card">
										<div class="card-header" role="tab" id="headingOne-2">
											<div class="event-time">
												<span class="circle"></span>
												<time datetime="2004-07-24T18:18">9:00am</time>
												<a href="#" class="more"><svg class="olymp-three-dots-icon"><use xlink:href="icons/icons.svg#olymp-three-dots-icon"></use></svg></a>
											</div>
											<h5 class="mb-0">
												<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne-2" aria-expanded="true" aria-controls="collapseOne-2">
													Breakfast at the Agency<svg class="olymp-dropdown-arrow-icon"><use xlink:href="icons/icons.svg#olymp-dropdown-arrow-icon"></use></svg>
												</a>
											</h5>
										</div>

										<div id="collapseOne-2" class="collapse" role="tabpanel">
											<div class="card-body">
												Hi Guys! I propose to go a litle earlier at the agency to have breakfast and talk a little more about the new design project we have been working on. Cheers!
											</div>
											<div class="place inline-items">
												<svg class="olymp-add-a-place-icon"><use xlink:href="icons/icons.svg#olymp-add-a-place-icon"></use></svg>
												<span>Daydreamz Agency</span>
											</div>

											<ul class="friends-harmonic inline-items">
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
												<li class="with-text">
													Will Assist
												</li>
											</ul>
										</div>

									</div>

									<a href="#" class="check-all">Check all your Events</a>
								</div>

								<div id="accordion-3" role="tablist" aria-multiselectable="true" class="day-event" date-month="12" date-day="15">
									<div class="ui-block-title ui-block-title-small">
										<h6 class="title">TODAY’S EVENTS</h6>
									</div>
									<div class="card">
										<div class="card-header" role="tab" id="headingOne-3">
											<div class="event-time">
												<span class="circle"></span>
												<time datetime="2004-07-24T18:18">9:00am</time>
												<a href="#" class="more"><svg class="olymp-three-dots-icon"><use xlink:href="icons/icons.svg#olymp-three-dots-icon"></use></svg></a>
											</div>
											<h5 class="mb-0">
												<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne-3" aria-expanded="true" aria-controls="collapseOne-3">
													Breakfast at the Agency<svg class="olymp-dropdown-arrow-icon"><use xlink:href="icons/icons.svg#olymp-dropdown-arrow-icon"></use></svg>
												</a>
											</h5>
										</div>

										<div id="collapseOne-3" class="collapse" role="tabpanel">
											<div class="card-body">
												Hi Guys! I propose to go a litle earlier at the agency to have breakfast and talk a little more about the new design project we have been working on. Cheers!
											</div>

											<div class="place inline-items">
												<svg class="olymp-add-a-place-icon"><use xlink:href="icons/icons.svg#olymp-add-a-place-icon"></use></svg>
												<span>Daydreamz Agency</span>
											</div>

											<ul class="friends-harmonic inline-items">
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
												<li class="with-text">
													Will Assist
												</li>
											</ul>
										</div>

									</div>

									<div class="card">
										<div class="card-header" role="tab" id="headingTwo-3">
											<div class="event-time">
												<span class="circle"></span>
												<time datetime="2004-07-24T18:18">12:00pm</time>
												<a href="#" class="more"><svg class="olymp-three-dots-icon"><use xlink:href="icons/icons.svg#olymp-three-dots-icon"></use></svg></a>
											</div>
											<h5 class="mb-0">
												<a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo-3" aria-expanded="true" aria-controls="collapseTwo-3">
													Send the new “Olympus” project files to the Agency<svg class="olymp-dropdown-arrow-icon"><use xlink:href="icons/icons.svg#olymp-dropdown-arrow-icon"></use></svg>
												</a>
											</h5>
										</div>

										<div id="collapseTwo-3" class="collapse" role="tabpanel" >
											<div class="card-body">
												Hi Guys! I propose to go a litle earlier at the agency to have breakfast and talk a little more about the new design project we have been working on. Cheers!
											</div>
										</div>

									</div>

									<div class="card">
										<div class="card-header" role="tab" id="headingThree-3">
											<div class="event-time">
												<span class="circle"></span>
												<time datetime="2004-07-24T18:18">6:30pm</time>
												<a href="#" class="more"><svg class="olymp-three-dots-icon"><use xlink:href="icons/icons.svg#olymp-three-dots-icon"></use></svg></a>
											</div>
											<h5 class="mb-0">
												<a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#" aria-expanded="false">
													Take Querty to the Veterinarian
												</a>
											</h5>
										</div>
										<div class="place inline-items">
											<svg class="olymp-add-a-place-icon"><use xlink:href="icons/icons.svg#olymp-add-a-place-icon"></use></svg>
											<span>Daydreamz Agency</span>
										</div>
									</div>

									<a href="#" class="check-all">Check all your Events</a>
								</div>

								<div id="accordion-4" role="tablist" aria-multiselectable="true" class="day-event" date-month="12" date-day="28">
									<div class="ui-block-title ui-block-title-small">
										<h6 class="title">TODAY’S EVENTS</h6>
									</div>
									<div class="card">
										<div class="card-header" role="tab" id="headingOne-4">
											<div class="event-time">
												<span class="circle"></span>
												<time datetime="2004-07-24T18:18">9:00am</time>
												<a href="#" class="more"><svg class="olymp-three-dots-icon"><use xlink:href="icons/icons.svg#olymp-three-dots-icon"></use></svg></a>
											</div>
											<h5 class="mb-0">
												<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne-4" aria-expanded="true" aria-controls="collapseOne-4">
													Breakfast at the Agency<svg class="olymp-dropdown-arrow-icon"><use xlink:href="icons/icons.svg#olymp-dropdown-arrow-icon"></use></svg>
												</a>
											</h5>
										</div>

										<div id="collapseOne-4" class="collapse" role="tabpanel" aria-labelledby="headingOne-4">
											<div class="card-body">
												Hi Guys! I propose to go a litle earlier at the agency to have breakfast and talk a little more about the new design project we have been working on. Cheers!
											</div>
											<div class="place inline-items">
												<svg class="olymp-add-a-place-icon"><use xlink:href="icons/icons.svg#olymp-add-a-place-icon"></use></svg>
												<span>Daydreamz Agency</span>
											</div>

											<ul class="friends-harmonic inline-items">
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
												<li class="with-text">
													Will Assist
												</li>
											</ul>
										</div>

									</div>

									<a href="#" class="check-all">Check all your Events</a>
								</div>

							</div>
						</div>
					</div>
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
									<svg class="olymp-star-icon"><use xlink:href="icons/icons.svg#olymp-star-icon"></use></svg>
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
									<svg class="olymp-star-icon"><use xlink:href="icons/icons.svg#olymp-star-icon"></use></svg>
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
									<svg class="olymp-star-icon"><use xlink:href="icons/icons.svg#olymp-star-icon"></use></svg>
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
									<svg class="olymp-star-icon"><use xlink:href="icons/icons.svg#olymp-star-icon"></use></svg>
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
									<svg class="olymp-star-icon"><use xlink:href="icons/icons.svg#olymp-star-icon"></use></svg>
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
									<svg class="olymp-star-icon"><use xlink:href="icons/icons.svg#olymp-star-icon"></use></svg>
								</a>
							</span>
						</li>

					</ul>

				</div>
			</aside>

			<!-- ... end Left Sidebar -->


			<!-- Right Sidebar -->

			<aside class="col-xl-3 order-xl-3 col-lg-6 order-lg-3 col-md-6 col-sm-12 col-xs-12">

				<div class="ui-block">
					<div class="widget w-birthday-alert">
						<div class="icons-block">
							<svg class="olymp-cupcake-icon"><use xlink:href="icons/icons.svg#olymp-cupcake-icon"></use></svg>
							<a href="#" class="more"><svg class="olymp-three-dots-icon"><use xlink:href="icons/icons.svg#olymp-three-dots-icon"></use></svg></a>
						</div>

						<div class="content">
							<div class="author-thumb">
								<img src="img/avatar48-sm.jpg" alt="author">
							</div>
							<span>Today is</span>
							<a href="#" class="h4 title">Marina Valentine’s Birthday!</a>
							<p>Leave her a message with your best wishes on her profile page!</p>
						</div>
					</div>
				</div>


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
						<h6 class="title">Activity Feed</h6>
						<a href="#" class="more"><svg class="olymp-three-dots-icon"><use xlink:href="icons/icons.svg#olymp-three-dots-icon"></use></svg></a>
					</div>

					<ul class="widget w-activity-feed notification-list">
						<li>
							<div class="author-thumb">
								<img src="img/avatar49-sm.jpg" alt="author">
							</div>
							<div class="notification-event">
								<a href="#" class="h6 notification-friend">Marina Polson</a> commented on Jason Mark’s <a href="#" class="notification-link">photo.</a>.
								<span class="notification-date"><time class="entry-date updated" datetime="2004-07-24T18:18">2 mins ago</time></span>
							</div>
						</li>

						<li>
							<div class="author-thumb">
								<img src="img/avatar9-sm.jpg" alt="author">
							</div>
							<div class="notification-event">
								<a href="#" class="h6 notification-friend">Jake Parker </a> liked Nicholas Grissom’s <a href="#" class="notification-link">status update.</a>.
								<span class="notification-date"><time class="entry-date updated" datetime="2004-07-24T18:18">5 mins ago</time></span>
							</div>
						</li>

						<li>
							<div class="author-thumb">
								<img src="img/avatar50-sm.jpg" alt="author">
							</div>
							<div class="notification-event">
								<a href="#" class="h6 notification-friend">Mary Jane Stark </a> added 20 new photos to her <a href="#" class="notification-link">gallery album.</a>.
								<span class="notification-date"><time class="entry-date updated" datetime="2004-07-24T18:18">12 mins ago</time></span>
							</div>
						</li>

						<li>
							<div class="author-thumb">
								<img src="img/avatar51-sm.jpg" alt="author">
							</div>
							<div class="notification-event">
								<a href="#" class="h6 notification-friend">Nicholas Grissom </a> updated his profile <a href="#" class="notification-link">photo</a>.
								<span class="notification-date"><time class="entry-date updated" datetime="2004-07-24T18:18">1 hour ago</time></span>
							</div>
						</li>
						<li>
							<div class="author-thumb">
								<img src="img/avatar48-sm.jpg" alt="author">
							</div>
							<div class="notification-event">
								<a href="#" class="h6 notification-friend">Marina Valentine </a> commented on Chris Greyson’s <a href="#" class="notification-link">status update</a>.
								<span class="notification-date"><time class="entry-date updated" datetime="2004-07-24T18:18">1 hour ago</time></span>
							</div>
						</li>

						<li>
							<div class="author-thumb">
								<img src="img/avatar52-sm.jpg" alt="author">
							</div>
							<div class="notification-event">
								<a href="#" class="h6 notification-friend">Green Goo Rock </a> posted a <a href="#" class="notification-link">status update</a>.
								<span class="notification-date"><time class="entry-date updated" datetime="2004-07-24T18:18">1 hour ago</time></span>
							</div>
						</li>
						<li>
							<div class="author-thumb">
								<img src="img/avatar10-sm.jpg" alt="author">
							</div>
							<div class="notification-event">
								<a href="#" class="h6 notification-friend">Elaine Dreyfuss  </a> liked your <a href="#" class="notification-link">blog post</a>.
								<span class="notification-date"><time class="entry-date updated" datetime="2004-07-24T18:18">2 hours ago</time></span>
							</div>
						</li>

						<li>
							<div class="author-thumb">
								<img src="img/avatar10-sm.jpg" alt="author">
							</div>
							<div class="notification-event">
								<a href="#" class="h6 notification-friend">Elaine Dreyfuss  </a> commented on your <a href="#" class="notification-link">blog post</a>.
								<span class="notification-date"><time class="entry-date updated" datetime="2004-07-24T18:18">2 hours ago</time></span>
							</div>
						</li>

						<li>
							<div class="author-thumb">
								<img src="img/avatar53-sm.jpg" alt="author">
							</div>
							<div class="notification-event">
								<a href="#" class="h6 notification-friend">Bruce Peterson </a> changed his <a href="#" class="notification-link">profile picture</a>.
								<span class="notification-date"><time class="entry-date updated" datetime="2004-07-24T18:18">15 hours ago</time></span>
							</div>
						</li>

					</ul>
				</div>


				<div class="ui-block">
					<div class="widget w-action">

						<img src="img/logo.png" alt="Olympus">
						<div class="content">
							<h4 class="title">OLYMPUS</h4>
							<span>THE BEST SOCIAL NETWORK THEME IS HERE!</span>
							<a href="01-LandingPage.html" class="btn btn-bg-secondary btn-md">Register Now!</a>
						</div>
					</div>
				</div>

			</aside>

			<!-- ... end Right Sidebar -->

		</div>
	</div>


	<!-- Window-popup Update Header Photo -->

	<div class="modal fade" id="update-header-photo">
		<div class="modal-dialog ui-block window-popup update-header-photo">
			<a href="#" class="close icon-close" data-dismiss="modal" aria-label="Close">
				<svg class="olymp-close-icon"><use xlink:href="icons/icons.svg#olymp-close-icon"></use></svg>
			</a>

			<div class="ui-block-title">
				<h6 class="title">Choix de la photo</h6>
			</div>

			<a href="#" class="upload-photo-item add_ph">
				<svg class="olymp-computer-icon"><use xlink:href="icons/icons.svg#olymp-computer-icon"></use></svg>

				<h6>Télécharger une Photo</h6>
				<span>Depuis mon ordinateur.</span>
			</a>

			<a href="#" class="upload-photo-item" data-toggle="modal" data-target="#externe_link">

				<svg class="olymp-photos-icon"><use xlink:href="icons/icons.svg#olymp-photos-icon"></use></svg>

				<h6>Choisir une photo</h6>
				<span>Depuis un lien externe</span>
			</a>
		</div>
	</div>


	<!-- ... end Main Content Groups -->
	<div class="modal fade" id="externe_link">
		<div class="modal-dialog ui-block window-popup">
			<div class="ui-block-title">
				<h6 class="title">Insérer le lien de la photo</h6>
			</div>
			<div class="ui-block-content">
				<div class="form-group is-empty label-floating ">
					<label class="control-label">Indiquer le lien externe</label>
					<input class="form-control" placeholder="" value="" type="text">
				</div>
				<a href="#" class="btn btn-secondary btn-lg btn--half-width">Annuler</a>
				<a href="#" class="btn btn-primary btn-lg btn--half-width">Confirmer</a>
			</div>
		</div>
	</div>

	<!-- Window-popup Create Friends Group -->
	<div class="modal fade" id="create-friend-group-1">
		<div class="modal-dialog ui-block window-popup create-friend-group create-friend-group-1">
			<a href="#" class="close icon-close" data-dismiss="modal" aria-label="Close">
				<svg class="olymp-close-icon"><use xlink:href="icons/icons.svg#olymp-close-icon"></use></svg>
			</a>

			<div class="ui-block-title">
				<h6 class="title">Ajouter un client</h6>
			</div>

			<div class="ui-block-content">
				<form class="form-group label-floating is-empty addclient">
					<div class="form-group is-empty label-floating ">
						<label class="control-label">Numéro client</label>
						<input class="form-control numclient" placeholder="" value="" type="text">
					</div>
					<div class="form-group label-floating is-empty">
						<label class="control-label">Raison sociale</label>
						<input class="form-control raisonsociale" placeholder="" value="" type="text">
					</div>
					<div class="form-group label-floating is-empty">
						<label class="control-label">Adresse CMS</label>
						<input class="form-control adressecms" placeholder="" value="" type="text">
					</div>
				</form>
				<a href="#" class="btn btn-blue btn-lg full-width btn-addclient">Ajouter le client</a>
			</div>


		</div>
	</div>
	<!-- ... end Window-popup Create Friends Group -->


	<!-- jQuery first, then Other JS. -->
	<script src="js/jquery-3.2.0.min.js"></script>
	<!-- Js effects for material design. + Tooltips -->
	<script src="js/material.min.js"></script>
	<!-- Helper scripts (Tabs, Equal height, Scrollbar, etc) -->
	<script src="js/theme-plugins.js"></script>
	<!-- Init functions -->
	<script src="js/main.js"></script>
	<script src="js/alterclass.js"></script>
	<!-- Select / Sorting script -->
	<script src="js/selectize.min.js"></script>

	<link rel="stylesheet" type="text/css" href="css/bootstrap-select.css">

	<script src="js/simplecalendar.js"></script>
	<script src="js/mediaelement-and-player.min.js"></script>
	<script src="js/mediaelement-playlist-plugin.min.js"></script>

	<script src="js/intro.min.js"></script>
	<script src="js/charte.js"></script>
	<?php 
	if($_SESSION['id_statut']==1) {
						//page graphistes 
		?><script src="js/notifications.js"></script><?php
	}elseif  ($_SESSION['id_statut']==2){
						//page  redacteurs
		?><script src="js/notifications_redac.js"></script><?php
	}
	elseif ($_SESSION['id_statut']==3) {
						//page leader
		?><script src="js/notifications_leader.js"></script><?php
	}elseif ($_SESSION['id_statut']==4) {
						//page controleur
		?><script src="js/notifications_controleur.js"></script><?php
	}elseif($_SESSION['id_statut']==5){
						//page admin
		?><script src="js/notifications_admin.js"></script><?php
	}
	?>
	<script>
		$(function(){
			var colorPalette = ['000000', 'FF9966', '6699FF', '99FF66', 'CC0000', '00CC00', '0000CC', '333333', '0066FF', 'FFFFFF'];
			var forePalette = $('.fore-palette');
			var backPalette = $('.back-palette');

			for (var i = 0; i < colorPalette.length; i++) {
				forePalette.append('<a href="#" data-command="forecolor" data-value="' + '#' + colorPalette[i] + '" style="background-color:' + '#' + colorPalette[i] + ';" class="palette-item"></a>');
				backPalette.append('<a href="#" data-command="backcolor" data-value="' + '#' + colorPalette[i] + '" style="background-color:' + '#' + colorPalette[i] + ';" class="palette-item"></a>');
			}

			$('.toolbar a').click(function(e) {
				var command = $(this).data('command');
				if (command == 'h1' || command == 'h2' || command == 'p') {
					document.execCommand('formatBlock', false, command);
				}
				if (command == 'moins') {
					document.execCommand($(this).data('command'), false, $(this).data('value'));
				}
				if (command == 'plus') {
					document.execCommand($(this).data('command'), false, $(this).data('value'));
				}
				if (command == 'forecolor' || command == 'backcolor') {
					document.execCommand($(this).data('command'), false, $(this).data('value'));
				}
				if (command == 'createlink' || command == 'insertimage') {
					url = prompt('Enter the link here: ', 'http:\/\/');
					document.execCommand($(this).data('command'), false, url);
				} else document.execCommand($(this).data('command'), false, null);
			});

			$(".add_ph").on('click', function(){
				$("#choose_photo").click();
			})

			$("#choose_photo").on('change', function(){
				$("#content_news").append('<img src="'+$(this).val()+'">');
			})

			$("#content_news").on('keyup', function(){
				if($(this).html()!=""){
					$(this).parent().addClass('is-focused');
				}
			})
			$("#content_news").on('blur', function(){
				if($(this).html()!=""){
					$(this).parent().addClass('is-focused');
				}
			})
		})
	</script>
</body>
</html>
<?php }else{
	header('Location: login.php');
}
?>