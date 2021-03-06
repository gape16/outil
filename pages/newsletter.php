<?php

// Connexion à la base de donnée et insertion de session_start
include('../connexion_session.php');


function time_elapsed_string($datetime, $full = false) {
	$now = new DateTime;
	$ago = new DateTime($datetime);
	$diff = $now->diff($ago);

	$diff->w = floor($diff->d / 7);
	$diff->d -= $diff->w * 7;

	$string = array(
		'y' => 'an',
		'm' => 'mois',
		'w' => 'semaine',
		'd' => 'jour',
		'h' => 'heure',
		'i' => 'minute',
		's' => 'seconde',
	);
	foreach ($string as $k => &$v) {
		if ($diff->$k) {
			$v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
		} else {
			unset($string[$k]);
		}
	}

	if (!$full) $string = array_slice($string, 0, 1);
	return $string ? ' Il y a ' .implode(', ', $string) : 'maintenant';
}

function time_elapsed_string_after($datetime, $full = false) {
	$now = new DateTime;
	$ago = new DateTime($datetime);
	$diff = $now->diff($ago);

	$diff->w = floor($diff->d / 7);
	$diff->d -= $diff->w * 7;

	$string = array(
		'y' => 'an',
		'm' => 'mois',
		'w' => 'semaine',
		'd' => 'jour',
		'h' => 'heure',
		'i' => 'minute',
		's' => 'seconde',
	);
	foreach ($string as $k => &$v) {
		if ($diff->$k) {
			$v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
		} else {
			unset($string[$k]);
		}
	}

	if (!$full) $string = array_slice($string, 0, 1);
	return $string ? ' Dans ' .implode(', ', $string) : 'maintenant';
}

if (isset($_COOKIE['id_statut'])) {
	$id_graph=$_COOKIE['id_graph'];
	// $bdd->exec('SET NAMES utf8');
	$requete=$bdd->prepare("SELECT * FROM user where id_user = ?");
	$requete->bindParam(1, $id_graph);
	$requete->execute();
	$result_user=$requete->fetch(PDO::FETCH_ASSOC);
	?>



	<!DOCTYPE html>
	<html lang="fr">
	<head>

		<title>Newsletter</title>

		<!-- Required meta tags always come first -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="x-ua-compatible" content="ie=edge">

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

		<link rel="stylesheet" type="text/css" href="../css/bootstrap-reboot.css">
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="../css/bootstrap-grid.css">

		<!-- Theme Styles CSS -->
		<link rel="stylesheet" type="text/css" href="../css/theme-styles.css">
		<link rel="stylesheet" type="text/css" href="../css/blocks.css">

		<!-- Main Font -->
		<link rel="stylesheet" type="text/css" href="../css/introjs.css">
		<!-- <link href="css/introjs-dark.css" rel="stylesheet"> -->
		<link rel="stylesheet" type="text/css" href="../css/introjs-rtl.css">
		<link rel="stylesheet" type="text/css" href="../css/simplecalendar.css">
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.9.1/sweetalert2.css">

		<link rel="stylesheet" type="text/css" href="../css/daterangepicker.css">
		<link rel="icon" type="image/png" href="img/favicon.png" />
		<style>
		#content_news {
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
		#newsfeed-items-grid div.lepost {
			padding-bottom: 40px;
		}
		@font-face {
			font-family: 'weather';
			src: url('https://s3-us-west-2.amazonaws.com/s.cdpn.io/93/artill_clean_icons-webfont.eot');
			src: url('https://s3-us-west-2.amazonaws.com/s.cdpn.io/93/artill_clean_icons-webfont.eot?#iefix') format('embedded-opentype'),
			url('https://s3-us-west-2.amazonaws.com/s.cdpn.io/93/artill_clean_icons-webfont.woff') format('woff'),
			url('https://s3-us-west-2.amazonaws.com/s.cdpn.io/93/artill_clean_icons-webfont.ttf') format('truetype'),
			url('https://s3-us-west-2.amazonaws.com/s.cdpn.io/93/artill_clean_icons-webfont.svg#artill_clean_weather_iconsRg') format('svg');
			font-weight: normal;
			font-style: normal;
		}
		.icon-0:before { content: ":"; }
		.icon-1:before { content: "p"; }
		.icon-2:before { content: "S"; }
		.icon-3:before { content: "Q"; }
		.icon-4:before { content: "S"; }
		.icon-5:before { content: "W"; }
		.icon-6:before { content: "W"; }
		.icon-7:before { content: "W"; }
		.icon-8:before { content: "W"; }
		.icon-9:before { content: "I"; }
		.icon-10:before { content: "W"; }
		.icon-11:before { content: "I"; }
		.icon-12:before { content: "I"; }
		.icon-13:before { content: "I"; }
		.icon-14:before { content: "I"; }
		.icon-15:before { content: "W"; }
		.icon-16:before { content: "I"; }
		.icon-17:before { content: "W"; }
		.icon-18:before { content: "U"; }
		.icon-19:before { content: "Z"; }
		.icon-20:before { content: "Z"; }
		.icon-21:before { content: "Z"; }
		.icon-22:before { content: "Z"; }
		.icon-23:before { content: "Z"; }
		.icon-24:before { content: "E"; }
		.icon-25:before { content: "E"; }
		.icon-26:before { content: "3"; }
		.icon-27:before { content: "a"; }
		.icon-28:before { content: "A"; }
		.icon-29:before { content: "a"; }
		.icon-30:before { content: "A"; }
		.icon-31:before { content: "6"; }
		.icon-32:before { content: "1"; }
		.icon-33:before { content: "6"; }
		.icon-34:before { content: "1"; }
		.icon-35:before { content: "W"; }
		.icon-36:before { content: "1"; }
		.icon-37:before { content: "S"; }
		.icon-38:before { content: "S"; }
		.icon-39:before { content: "S"; }
		.icon-40:before { content: "M"; }
		.icon-41:before { content: "W"; }
		.icon-42:before { content: "I"; }
		.icon-43:before { content: "W"; }
		.icon-44:before { content: "a"; }
		.icon-45:before { content: "S"; }
		.icon-46:before { content: "U"; }
		.icon-47:before { content: "S"; }
		.w-wethear i {
			color: #fff;
			font-family: weather;
			font-size: 86px;
			width: 64px;
			height: 65px;
			font-weight: normal;
			font-style: normal;
			line-height: 1.0;
			text-transform: none;
		}
		.weekly-forecast i{
			font-size: 33px;
		}
		.calendar tbody td{
			cursor: pointer;
		}
		.calendar .list {
			overflow: visible;
		}
		.save{
			float: right;
			background: #1ed760;
			padding: 10px;
			color: white;
			border-radius: 0.3rem;
			margin: 0 !important;
			cursor: pointer;
		} 
		#home-1 div#content_news {
			padding-left: 70px;
		}
		.widget .icons-block {
			text-align: right;
			margin-bottom: 0;
		}
		.w-birthday-alert .olymp-cupcake-icon {
			width: 64px;
			height: 60px;
		}
		.widget .content {
			position: relative;
			top: -60px;
		}
		.w-birthday-alert .content p.today {
			font-size: 1.5em;
		}
		.img_who{
			float: left;
		}
		.w-birthday-alert .content p.who {
			line-height: 35px;
			margin-left: 50px;
		}
		.w-birthday-alert .content p.who {
			line-height: 35px;
			text-transform: uppercase;
			margin-left: 50px;
			font-size: 1.3em;
			font-weight: bold;
		}
	</style>
	<script src="../js/webfontloader.min.js"></script>
	<script>
		WebFont.load({
			google: {
				families: ['Roboto:300,400,500,700:latin']
			}
		});
	</script>

	<link rel="stylesheet" type="text/css" href="../css/fonts.css">

	<!-- Styles for plugins -->
	<link rel="stylesheet" type="text/css" href="../css/jquery.mCustomScrollbar.min.css">
	<!-- Custom CSS -->
	<link rel="stylesheet" href="../css/main.css">
	<link rel="stylesheet" href="../css/jquery.fancybox.min.css">

</head>

<body>

	<?php 
	include('../includes/left_sidebar.php');
	include('../includes/header.php');
	include('../includes/responsive_header.php');
	?>


	<div class="header-spacer"></div>


	<div class="container">
		<div class="row">

			<!-- Main Content -->

			<main class="col-xl-9 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-xs-12">

				<div class="ui-block">
					<div class="news-feed-form">
						<!-- Nav tabs -->
						<ul class="nav nav-tabs" role="tablist">
							<li class="nav-item">
								<a class="nav-link active inline-items" data-toggle="tab" href="#home-1" role="tab" aria-expanded="true">

									<svg class="olymp-status-icon"><use xlink:href="../icons/icons.svg#olymp-status-icon"></use></svg>

									<span>Newsletter</span>
								</a>
							</li>
						</ul>

						<!-- Tab panes -->
						<div class="tab-content">
							<div class="tab-pane active" id="home-1" role="tabpanel" aria-expanded="true">
								<form>
									<div class="author-thumb">
										<img src="../<?php echo utf8_encode($result_user['photo_avatar']);?>" alt="author">
									</div>
									<div class="form-group with-icon label-floating is-empty">
										<label class="control-label">Publier une newsletter...</label>
										<textarea class="form-control" placeholder="" style="display: none;"></textarea>
										<div contenteditable="true" id="content_news"></div>
										<input type="file" id="choose_photo" name="photos" style="display: none;">
									</div>
									<div class="add-options-message">
										<div class="toolbar" style="display: none;">
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
										<a class="options-message" data-toggle="tooltip">
											<svg class="olymp-camera-icon" data-toggle="modal" data-target="#update-header-photo"><use xlink:href="../icons/icons.svg#olymp-camera-icon"></use></svg>
										</a>
										<a class="options-message toolbar_show">
											<svg class="olymp-settings-icon"><use xlink:href="../icons/icons.svg#olymp-settings-icon"></use></svg>
										</a>

										<button class="btn btn-primary btn-md-2 post_this">Poster</button>
									</div>

								</form>
							</div>
						</div>
					</div>
				</div>

				<div id="newsfeed-items-grid">

					<?php
					$post=$bdd->prepare("SELECT * FROM newsletter inner join user on newsletter.id_user = user.id_user order by id_news DESC");
					$post->execute();
					foreach ($post as $key => $value) {
						$like_id=$value['id_news'];
						$like=$bdd->prepare("SELECT * FROM like_news inner join user on like_news.id_graph = user.id_user where id_news = ?");
						$like->bindParam(1, $like_id);
						$like->execute();
						$like_bis=$bdd->prepare("SELECT * FROM like_news inner join user on like_news.id_graph = user.id_user where id_news = ? limit 2");
						$like_bis->bindParam(1, $like_id);
						$like_bis->execute();
						$nb_like=$like->rowCount();
						?>

						<div class="ui-block author_<?php echo $value['id_user']?>">
							<article class="hentry post">
								<input type="hidden" class="news_id" value="<?php echo $like_id;?>">
								<div class="post__author author vcard content_post inline-items">
									<img src="../<?php echo utf8_encode($value['photo_avatar']);?>" alt="author">

									<div class="author-date">
										<a class="h6 post__author-name fn" href="#"><?php echo utf8_encode($value['prenom'].' '.$value['nom']);?></a>
										<div class="post__date">
											<time class="published">
												<?php echo time_elapsed_string($value['date_creation']);?>
											</time>
										</div>
									</div>
									<?php 
									if($value['id_user']==$id_graph){
										?>
										<div class="more"><svg class="olymp-three-dots-icon"><use xlink:href="../icons/icons.svg#olymp-three-dots-icon"></use></svg>
											<ul class="more-dropdown">
												<li>
													<a class="edit_news">Modifier l'article</a>
												</li>
												<li>
													<a class="delete_news">Supprimer l'article</a>
												</li>
											</ul>
										</div>
										<?php }?>
									</div>

									<?php echo $value['content'];
									$com_news_b=$bdd->prepare("SELECT * FROM like_news where id_news = ? and id_graph = ?");
									$com_news_b->bindParam(1, $like_id);
									$com_news_b->bindParam(2, $id_graph);
									$com_news_b->execute();
									$nbb=$com_news_b->rowCount();
									?>

									<div class="post-additional-info inline-items">

										<a class="post-add-icon inline-items" style="cursor: pointer;">
											<svg class="olymp-heart-icon liker" <?php if($nbb != "0"){echo "style='fill: #ff5e3a;color: #ff5e3a;'";}?>><use xlink:href="../icons/icons.svg#olymp-heart-icon"></use></svg>
											<span <?php if($nbb != "0"){echo "style='color:#ff5e3a;'";}?>><?php echo $nb_like;?></span>
										</a>

										<ul class="friends-harmonic">
											<?php foreach ($like as $key => $value_lik) {?>
											<li>
												<a>
													<img src="../<?php echo $value_lik['photo_avatar'];?>" alt="friend">
												</a>
											</li>
											<?php }?>
										</ul>

										<div class="names-people-likes">
											<?php
											$i=0;
											foreach ($like_bis as $key => $value_like) {
												if($i!=0){
													echo ",";
												}
												if($value_like['id_graph'] == $id_graph){
													echo "<a style='color:#515365;'>Vous</a>";
												}else{?>
												<a style="color: #515365;"><?php echo $value_like['prenom']." ".$value_like['nom'];?></a>
												<?php }
												$i++;
											}
											if($nb_like>2){
												$test=$nb_like-2;
												if($test==1){
													echo "<br>et ".$test." autre personne";
												}else{
													echo "<br>et ".$test." autres personnes";
												}
											}
											if($nb_like>0){?>
											aimez
											<?php }?>
										</div>


										<?php
										$com_news=$bdd->prepare("SELECT * FROM commentaires_news where id_news = ?");
										$com_news->bindParam(1, $like_id);
										$com_news->execute();
										$nb_com_news=$com_news->rowCount();

										
										?>
										<div class="comments-shared">
											<a href="#" class="post-add-icon inline-items ajouter_com">
												<svg class="olymp-speech-balloon-icon" ><use xlink:href="../icons/icons.svg#olymp-speech-balloon-icon"></use></svg>
												<span><?php echo $nb_com_news;?></span>
											</a>
										</div>


									</div>

								</article>

								<ul class="comments-list comments_<?php echo $like_id;?>" style="display: none;">

								</ul>

								<form class="comment-form inline-items">
									<div class="post__author author vcard inline-items">
										<img src="../<?php echo utf8_encode($result_user['photo_avatar']);?>" alt="author">
										<div class="form-group with-icon-right ">
											<textarea class="form-control text_news" ></textarea>
											<div class="add-options-message ajout_com_news add_<?php echo $like_id;?>">
												<a class="options-message">
													<svg class="olymp-chat---messages-icon"><use xlink:href="../icons/icons.svg#olymp-chat---messages-icon"></use></svg>
												</a>
											</div>
										</div>
									</div>
								</form>
							</div>
							<?php
						}
						?>
					</div>


					<a id="load-more-button" href="#" class="btn btn-control btn-more" data-load-link="items-to-load.html" data-container="newsfeed-items-grid"><svg class="olymp-three-dots-icon"><use xlink:href="../icons/icons.svg#olymp-three-dots-icon"></use></svg></a>


				</main>

				<!-- ... end Main Content -->

				<!-- Right Sidebar -->
				<?php 
				$date_now=date("Y-m-d");
				$anniv=$bdd->prepare("SELECT * FROM user where MONTH(date_naissance) = MONTH(NOW()) AND   DAY(date_naissance)   = DAY(NOW()) order by date_naissance ASC");
				$anniv->execute();
				$anniv_bis=$bdd->prepare("SELECT * FROM user where MONTH(date_naissance) = MONTH(NOW()) AND   DAY(date_naissance)   = DAY(NOW()) order by date_naissance ASC");
				$anniv_bis->execute();
				$nb_anniv=$anniv->rowCount();

				?>
				<aside class="col-xl-3 order-xl-3 col-lg-6 order-lg-3 col-md-6 col-sm-12 col-xs-12">

					<div class="ui-block">
						<div class="widget w-birthday-alert">
							<div class="icons-block">
								<svg class="olymp-cupcake-icon"><use xlink:href="../icons/icons.svg#olymp-cupcake-icon"></use></svg>

							</div>

							<div class="content">
								<div class="author-thumb">
									<?php
									if($nb_anniv>0){ 
										?>
										<p class="today">Aujourd'hui c'est l'anniversaire de :</p>
									</div>

									<?php
									foreach ($anniv_bis as $key => $value) {?>
									<img class="img_who" src="../<?php echo $value['photo_avatar'];?>" alt="author">
									<p class="who"><?php echo utf8_encode($value['prenom']." ".$value['nom']."<br>");?></p><?php
								}

								?>

								<p>N'oubliez pas de lui souhaiter un joyeux anniversaire !</p>
								<?php }else{
									echo "<a href='#'' class='h4 title'>Il n'y a pas d'anniversaire aujourd'hui</a>";
									echo "<p>Revenez demain pour voir s'il y en a un !</p>";
								}?>
							</div>
						</div>
					</div>
					<div class="ui-block">
						<div class="calendar-container">
							<div class="calendar">

								<?php
								$monthNames = Array("Janvier", "Fevrier", "Mars", "Avril", "Mai", "Juin", "Juillet", "Aout", "Septembre", "Octobre", "Novembre", "Decembre");
								if (!isset($_REQUEST["month"])){ $_REQUEST["month"] = date("n"); }
								if (!isset($_REQUEST["year"])){ $_REQUEST["year"] = date("Y"); }
								$cMonth = $_REQUEST["month"];
								$cYear = $_REQUEST["year"];

								$prev_year = $cYear;
								$next_year = $cYear;
								$prev_month = $cMonth-1;
								$next_month = $cMonth+1;

								if ($prev_month == 0 ) {
									$prev_month = 12;
									$prev_year = $cYear - 1;
								}
								if ($next_month == 13 ) {
									$next_month = 1;
									$next_year = $cYear + 1;
								}
								?>
								<header>
									<h2 class="month"><?php echo $monthNames[$cMonth-1]; ?></h2>
									<a class="btn-prev fontawesome-angle-left" href="<?php echo $_SERVER["PHP_SELF"] . "?month=". $prev_month . "&year=" . $prev_year; ?>"></a>
									<a class="btn-next fontawesome-angle-right" href="<?php echo $_SERVER["PHP_SELF"] . "?month=". $next_month . "&year=" . $next_year; ?>"></a>
								</header>

								<table>
									<thead>
										<tr>
											<td>DIM</td>
											<td>LUN</td>
											<td>MAR</td>
											<td>MER</td>
											<td>JEU</td>
											<td>VEN</td>
											<td>SAM</td>
										</tr>
									</thead>
									<tbody>
										<?php
										$timestamp = mktime(0,0,0,$cMonth,1,$cYear);
										$maxday = date("t",$timestamp);
										$thismonth = getdate ($timestamp);
										$startday = $thismonth['wday'];
										for ($i=0; $i<($maxday+$startday); $i++) {
											if(($i % 7) == 0 ) echo "<tr>";
											if($i < $startday) echo "<td></td>";
											else echo "<td align='center' date-month='".$thismonth['mon']."' date-year='".$cYear."' date-day='".($i - $startday + 1)."' valign='middle' height='20px'>". ($i - $startday + 1) . "</td>";
											if(($i % 7) == 6 ) echo "</tr>";
										}
										?>

									</tbody>
								</table>
								<div class="list">
									<?php
									$list=$bdd->prepare("SELECT *  FROM calendrier where id_user = ? group by CAST(date_event AS DATE)");
									$list->bindParam(1, $id_graph);
									$list->execute();
									$i=0;
									foreach ($list as $key => $value) {
										$heure_temp=explode(" ", $value['date_event']);
										$heure=substr($heure_temp[1],0,5);
										$toto="%".$heure_temp[0]."%";
										$date_temp=explode("-", $heure_temp[0]);
										$year=$date_temp[0];
										$mois=$date_temp[1];
										$jour=$date_temp[2];
										if($jour<10){
											$jour = substr($jour, 1);
										}
										?>

										<div role="tablist" aria-multiselectable="true" class="day-event" date-year="<?php echo $year;?>" date-month="<?php echo $mois;?>" date-day="<?php echo $jour;?>">
											<div class="ui-block-title ui-block-title-small">
												<h6 class="title"><?php echo utf8_encode($value['titre']);?></h6>
											</div>
											<?php
											$list_bis=$bdd->prepare("SELECT *  FROM calendrier where id_user = ? and date_event like ?");
											$list_bis->bindParam(1, $id_graph);
											$list_bis->bindParam(2, $toto);
											$list_bis->execute();
											foreach ($list_bis as $key => $value_bis) {
												$i++;
												$heure_temp_bis=explode(" ", $value_bis['date_event']);
												$heure_bis=substr($heure_temp_bis[1],0,5);
												?>
												<div class="card delete_<?php echo $value_bis['id_calendrier'];?> chut">
													<div class="card-header" role="tab" id="headingOne-1">
														<div class="event-time">
															<span class="circle"></span>
															<time datetime="2004-07-24T18:18"><?php echo $heure_bis;?></time>
															<div class="more" style="float: right;">
																<svg class="olymp-three-dots-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="../icons/icons.svg#olymp-three-dots-icon"></use></svg>
																<ul class="more-dropdown">
																	<li>
																		<a class="delete" href="#">Supprimer la carte</a>
																	</li>
																</ul>
															</div>
														</div>
														<h5 class="mb-0">
															<a <?php if($value_bis['description']!=""){?> data-toggle="collapse" data-parent="#accordion" href="#collapseOne-<?php echo $i;?>" aria-expanded="true" aria-controls="collapseOne-<?php echo $i;?>" <?php }?>>
																<?php echo $value_bis['titre'];?><?php if($value_bis['description']!=""){?><svg class="olymp-dropdown-arrow-icon"><use xlink:href="../icons/icons.svg#olymp-dropdown-arrow-icon"></use></svg><?php }?>
															</a>
														</h5>
													</div>

													<div id="collapseOne-<?php echo $i;?>" class="collapse" role="tabpanel" >
														<div class="card-body">
															<?php echo utf8_encode($value_bis['description']);?>
														</div>
														<div class="place inline-items">
															<svg class="olymp-add-a-place-icon"><use xlink:href="icons/icons.svg#olymp-add-a-place-icon"></use></svg>
															<span><?php echo utf8_encode($value_bis['lieu']);?></span>
														</div>
													</div>
												</div>

												<?php }?>
												<a href="#" class="check-all" data-toggle="modal" data-target="#event_cre">Créer un évenement</a>
											</div>
											<?php }?>
											<div role="tablist" aria-multiselectable="true" class="day-event vide">
												<div class="ui-block-title ui-block-title-small">
													<h6 class="title">Evenement du jour</h6>
												</div>
												<div class="card">
												</div>

												<a href="#" class="check-all" data-toggle="modal" data-target="#event_cre">Créer un évenement</a>
											</div>

										</div>
									</div>
								</div>
							</div>
							<div class="ui-block custom_right">

								<div class="ui-block-title">
									<h6 class="title">Les prochains évenements</h6>
								</div>
								<ul class="widget w-activity-feed notification-list">

									<?php 
									$date_now=date("Y-m-d H:i:s");
									$feed=$bdd->prepare("SELECT * FROM calendrier inner join user on calendrier.id_user = user.id_user where calendrier.id_user = ? and date_event > ?");
									$feed->bindParam(1, $id_graph);
									$feed->bindParam(2, $date_now);
									$feed->execute();
									foreach ($feed as $key => $value) {
										?>	
										<li>
											<div class="author-thumb">
												<img src="../<?php echo $value['photo_avatar'];?>" alt="author">
											</div>
											<div class="notification-event">
												<a class="h6 notification-friend"><?php echo $value['titre'];?></a>.
												<span class="notification-date"><time class="entry-date updated" datetime="2004-07-24T18:18"><?php echo time_elapsed_string_after($value['date_event']);?></time></span>
											</div>
										</li>
										<?php }?>
									</ul>
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
							<svg class="olymp-close-icon"><use xlink:href="../icons/icons.svg#olymp-close-icon"></use></svg>
						</a>

						<div class="ui-block-title">
							<h6 class="title">Choix de la photo</h6>
						</div>

						<a href="#" class="upload-photo-item add_ph">
							<svg class="olymp-computer-icon"><use xlink:href="../icons/icons.svg#olymp-computer-icon"></use></svg>

							<h6>Télécharger une Photo</h6>
							<span>Depuis mon ordinateur.</span>
						</a>

						<a href="#" class="upload-photo-item" data-toggle="modal" data-target="#externe_link">

							<svg class="olymp-photos-icon"><use xlink:href="../icons/icons.svg#olymp-photos-icon"></use></svg>

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
				<div class="modal fade" id="event_cre">
					<div class="modal-dialog ui-block window-popup create-friend-group create-friend-group-1">
						<a href="#" class="close icon-close" data-dismiss="modal" aria-label="Close">
							<svg class="olymp-close-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="../icons/icons.svg#olymp-close-icon"></use></svg>
						</a>

						<div class="ui-block-title">
							<h6 class="title">Creation d'un évenement</h6>
						</div>

						<div class="ui-block-content">
							<div class="form-group label-floating is-focused">
								<label class="control-label">Date de l'évenement</label>
								<input class="form-control event_date" type="text" placeholder="" disabled="">
								<span class="material-input"></span>
							</div>

							<div class="form-group label-floating is-empty">
								<label class="control-label">Titre de l'évenement</label>
								<input class="form-control title_date" type="text" placeholder="">
								<span class="material-input"></span>
							</div>
							<div class="form-group label-floating is-empty">
								<label class="control-label">Lieu de l'évenement</label>
								<input class="form-control where_date" type="text" placeholder="">
								<span class="material-input"></span>
							</div>
							<div class="form-group label-floating">
								<label class="control-label">Heure de l'évenement</label>
								<input class="form-control hour_date" type="time" placeholder="" value="09:00">
								<span class="material-input"></span>
							</div>
							<div class="form-group label-floating is-empty" style="clear: both;">
								<label class="control-label">Description de l'évenement</label>
								<textarea class="form-control description_date" placeholder=""></textarea>
								<span class="material-input"></span>
							</div>
							<a href="#" class="btn btn-breez btn-lg full-width creation-event">Créer</a>
						</div>


					</div>
				</div>
				<!-- ... end Window-popup Create Friends Group -->


				<!-- jQuery first, then Other JS. -->
				<script src="../js/jquery-3.2.0.min.js"></script>
				<!-- Js effects for material design. + Tooltips -->
				<script src="../js/material.min.js"></script>
				<!-- Helper scripts (Tabs, Equal height, Scrollbar, etc) -->
				<script src="../js/theme-plugins.js"></script>
				<!-- Init functions -->
				<script src="../js/main.js"></script>
				<script src="../js/alterclass.js"></script>
				<!-- Select / Sorting script -->
				<script src="../js/selectize.min.js"></script>
				<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
				<link rel="stylesheet" type="text/css" href="../css/bootstrap-select.css">
				<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.9.1/sweetalert2.min.js"></script>

				<!-- <script src="js/moment.min.js"></script> -->
				<script src="../js/mediaelement-and-player.min.js"></script>
				<script src="../js/mediaelement-playlist-plugin.min.js"></script>
				<script src="../js/simpleUpload.min.js"></script>
				<script src="../js/intro.min.js"></script>
				<script src="../js/charte.js"></script>
				<script src="../js/jquery.simpleWeather.min.js"></script>
				<script src="../js/simplecalendar.js"></script>
				<script src="../js/daterangepicker.min.js"></script>
				<?php 
				if($_COOKIE['id_statut']==1) {
						//page graphistes 
					?><script src="../js/notifications.js"></script><?php
				}elseif  ($_COOKIE['id_statut']==2){
						//page  redacteurs
					?><script src="../js/notifications.js"></script><?php
				}
				elseif ($_COOKIE['id_statut']==3) {
						//page leader
					?><script src="../js/notifications.js"></script><?php
				}elseif ($_COOKIE['id_statut']==4) {
						//page controleur
					?><script src="../js/notifications_controleur.js"></script><?php
				}elseif($_COOKIE['id_statut']==5){
						//page admin
					?><script src="../js/notifications_admin.js"></script><?php
				}
				?> 
				<script>

					/* Does your browser support geolocation? */
					if ("geolocation" in navigator) {
						$('.js-geolocation').show(); 
					} else {
						$('.js-geolocation').hide();
					}


					function loadWeather(location, woeid) {
						$.simpleWeather({
							location: location,
							woeid: woeid,
							unit: 'c',
							success: function(weather) {
								$(".temperature-sensor").html(weather.temp+"°");
								$(".ic").html('<i class="icon-'+weather.code+'"></i>');
								$(".climate").html(weather.city);
								$(".humide").html(weather.low);
								$(".couche").html(weather.high);
								var html="";
								var jour="";
								for(var i=1;i<8;i++) {
									if(weather.forecast[i].day=="Sat"){ jour = "SAM";}
									if(weather.forecast[i].day=="Sun"){ jour = "DIM";}
									if(weather.forecast[i].day=="Mon"){ jour = "LUN";}
									if(weather.forecast[i].day=="Tue"){ jour = "MAR";}
									if(weather.forecast[i].day=="Wed"){ jour = "MER";}
									if(weather.forecast[i].day=="Thu"){ jour = "JEU";}
									if(weather.forecast[i].day=="Fri"){ jour = "VEN";}
									html += '<li><div class="day">'+jour+'</div><i class="icon-'+weather.forecast[i].code+'"></i><div class="temperature-sensor-day">'+weather.forecast[i].high+'°</div></li>';
								}
								$(".weekly-forecast").html(html);
								$(".date").html(weather.forecast[0].date);
								$(".w-wethear").show("slow");
							},
							error: function(error) {
								$(".temperature-sensor").html('<p>'+error+'</p>');
							}
						});
					}

					function GetMonthName(monthNumber) {
						var months = ["Janvier", "Fevrier", "Mars", "Avril", "Mai", "Juin", "Juillet", "Aout", "Septembre", "Octobre", "Novembre", "Decembre"];
						return months[monthNumber - 1];
					}

					$(function(){


						$("body").on('click', ".ajout_com_news", function(){
							var check="add_";
							var cls = $(this).attr('class').split(' ');
							for (var i = 0; i < cls.length; i++) {
								if (cls[i].indexOf(check) > -1) {
									var id_emet = cls[i].slice(check.length, cls[i].length);
								}
							}
							var texte=$(this).prev().val();
							console.log(texte);
							$.ajax({
								url: '../formulaire.php',
								type: 'POST',
								context: this,
								data: {text_ajout_news: texte, id_text_news:id_emet},
							})
							.done(function(data) {
								$(".comments_"+id_emet).append(data);
								$(this).prev().val('');
							})									
						})

						$(".text_news").keypress(function(e) {
							if(e.which == 13) {
								$(this).parent().find(".ajout_com_news").trigger( "click" );
							}
						});

						$("body").on('click', ".liker", function(){
							var liker = $(this).parents(".ui-block").find(".news_id").val();
							$.ajax({
								url: '../formulaire.php',
								type: 'POST',
								context: this,
								data: {liker_news: liker},
							})
							.done(function(data) {
								if (data == "ok") {
									$(this).css("fill", "#ff5e3a");
									$(this).css("color", "#ff5e3a");
									var valeur = $(this).parent().find("span").html();
									$(this).parent().find("span").html(valeur * 1 + 1 *1);
									$(this).parent().find("span").css("color", "#515365");
								}
							})
						})

						$("body").on('click', ".delete", function(){
							var check="delete_";
							var cls = $(this).parents(".chut").attr('class').split(' ');
							for (var i = 0; i < cls.length; i++) {
								if (cls[i].indexOf(check) > -1) {
									var id_emet = cls[i].slice(check.length, cls[i].length);
								}
							}
							swal({
								title: 'êtes vous sûr?',
								text: "Vous allez supprimer votre évenement!",
								type: 'warning',
								showCancelButton: true,
								confirmButtonColor: '#3085d6',
								cancelButtonColor: '#d33',
								confirmButtonText: 'Oui, le supprimer!'
							}).then(function (result) {
									// console.log(result);
									if (result) {
										$.ajax({
											url: '../formulaire.php',
											type: 'POST',
											data: {suppression_event: id_emet},
										})
										.done(function(data) {
											$(".delete_"+id_emet).remove();
											swal(
												'Suppression!',
												'Votre évenement a bien été supprimé.',
												'success'
												)
										})										
									}
								})
						})

						$("body").on('click', ".creation-event", function(){
							var date_event=$(".event_date").val();
							var date_temp =date_event.split("/");
							var year=date_temp[0];
							var month=date_temp[1];
							var day=date_temp[2]; 
							var titre_event = $(".title_date").val();
							var lieu_event=$(".where_date").val();
							var heure_event=$(".hour_date").val();
							var description_date=$(".description_date").val();
							$.ajax({
								url: '../formulaire.php',
								type: 'POST',
								data: {date_event: date_event, titre_event:titre_event,lieu_event:lieu_event,heure_event:heure_event,description_date:description_date},
							})
							.done(function(data) {
								$('#event_cre').modal('toggle');
								$(".list").html(data);
								$("td").each(function(){
									if($(this).attr("date-month") == month && $(this).attr("date-year") == year && $(this).attr("date-day")==day){
										$(this).addClass('event');
									}
								})
							})

						})

						$("body").on('click', ".calendar tbody td", function(e){
							var mois = $(this).attr("date-month");
							var jour = $(this).attr("date-day");
							var an = $(this).attr("date-year");
							if(!$(this).hasClass('event')){
								$(".vide .title").html("Evenement pour le "+jour+" "+GetMonthName(mois));
								$(".vide").slideToggle("slow");
								$(".vide").attr("date-month",mois);
								$(".vide").attr("date-day",jour);
								$(".vide").attr("date-year",an);
							}
						})

						$("body").on('click', ".check-all", function(){

							var mois = $(this).parents(".day-event").attr("date-month");
							var jour = $(this).parents(".day-event").attr("date-day");
							var an = $(this).parents(".day-event").attr("date-year");
							$(".event_date").val(an+"/"+mois+"/"+jour);

						})


						navigator.geolocation.getCurrentPosition(function(position) {
							loadWeather(position.coords.latitude+','+position.coords.longitude); 
							setInterval(loadWeather(position.coords.latitude+','+position.coords.longitude), 600000);
						});

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
						$("input").on('keyup', function(){
							if($(this).html()!=""){
								$(this).parent().addClass('is-focused');
							}
						})
						$("input").on('blur', function(){
							if($(this).html()!=""){
								$(this).parent().addClass('is-focused');
							}
						})
						$(".toolbar_show").on('click', function(){
							$(".toolbar").toggle("slow");
						})
						$("#choose_photo").on('change', function(){
							var file = $(this).prop("files");
							var names = $.map(file, function (val) { return val.name; });
							$(this).simpleUpload("upload_news.php", {

								start: function(file){
						//upload started
						// console.log(file);
					},
					progress: function(progress){
						//received progress
						// console.log(progress);
					},
					success: function(data){	
						// console.log(data);
						$("<img src='../uploads/newsletter/"+names[0]+"'>").appendTo("#content_news");
					},
					error: function(error){
						//upload failed
						// console.log(error);
					}

				});
						})
			// $('#content_news img').resizable({
			// 	animate: true,
			// 	ghost: true
			// });
			document.oncontextmenu = function() {return false;};

			$("body").on("mousedown", '#home-1 #content_news img', function(e){ 
				if( e.button == 2 ) { 
					var img_h = $(this).innerHeight();
					var img_w = $(this).innerWidth();
					$(this).width(img_w+10);
					return false; 
				} 
				return true; 
			}); 

			$("body").on('click', '#home-1 #content_news img', function(){
				var img_h = $(this).innerHeight();
				var img_w = $(this).innerWidth();
				$(this).width(img_w-10);
			})
			$(".post_this").on('click', function(e){
				if($("#content_news").html()!=""){
					e.preventDefault();
					var $target = $("#content_news").attr('contenteditable','false').addClass('lepost');
					var $clone = $target.clone();
					$clone.wrap('<div>');
					var htmlString = $clone.parent().html();
					$.ajax({
						url: '../formulaire.php',
						type: 'POST',
						data: {lecontenu: htmlString},
					})
					.done(function(data) {
						$("#newsfeed-items-grid").prepend(data);
						$("#home-1 #content_news").html('');
						$("form #content_news").attr('contenteditable','true');
					})
				}
			})
			$("body").on('click', ".ajouter_com", function(e){
				e.preventDefault();
				if($(this).find('span').text() != 0 ){
					var id_news = $(this).parents(".ui-block").find(".news_id").val();
					if($(".comments-list").css('display')=="none"){
						$.ajax({
							url: '../formulaire.php',
							type: 'POST',
							data: {id_comment_news: id_news},
						})
						.done(function(data) {
							$(".comments_"+id_news).html(data);
							$(".comments_"+id_news).slideToggle( "slow" );
						})
					}
				}
			})

			$("body").on('click', ".liker_com_news", function(e){
				e.preventDefault();
				var check="com_like_";
				var cls = $(this).parent().attr('class').split(' ');
				for (var i = 0; i < cls.length; i++) {
					if (cls[i].indexOf(check) > -1) {
						var id_emet = cls[i].slice(check.length, cls[i].length);
					}
				}
				$.ajax({
					url: '../formulaire.php',
					type: 'POST',
					context: this,
					data: {liker_news_com: id_emet},
				})
				.done(function(data) {
					if (data == "ok") {
						$(this).find(".olymp-heart-icon").css("fill", "#ff5e3a");
						$(this).find(".olymp-heart-icon").css("color", "#ff5e3a");
						var valeur = $(this).find("span").html();
						$(this).find("span").html(valeur * 1 + 1 *1);
						$(this).find("span").css("color", "#515365");
					}
				})			
			})

			$('body').on('click', '.edit_news', function(){
				$(this).parents('.ui-block').find('div#content_news').attr('contenteditable', 'true');
				$(this).parents('.ui-block').find('div#content_news').css({
					"border": "1px solid rgba(30, 215, 96, 0.12)",
					"padding": "20px 15px"
				});
				$(this).parents('.ui-block').find('div#content_news').trigger('click');
				$(this).parents('.ui-block').find('.content_post').append('<p class="save">Sauvegarder</p>');
				$(this).parents('.more').hide();
				var getClass= $(this).parents('.ui-block').attr('class');
				var author = getClass.split('_')[1];
				var newsId = $('input.news_id').val();

				console.log(author);
				console.log(newsId);

				$('body').on('click', '.save', function(){	
					var content = $(this).parents('.ui-block').find("#content_news").text();
					console.log(content);
					var wrapContent = '<div contenteditable="false" id="content_news" class="lepost">' + content + '</div>';
					console.log(wrapContent);
					$.ajax({
						url: '../formulaire.php',
						type: 'POST',
						data: {newsId: newsId, author: author, content: wrapContent}
					})
					.done(function(data) {
						swal(
							'Newsletter modifiée !',
							'success'
							).then(function(){
								location.reload();
							})
						})
				})
			})


			$('body').on('click', '.delete_news', function(){
				var getClass= $(this).parents('.ui-block').attr('class');
				var author = getClass.split('_')[1];
				var newsId = $('input.news_id').val();
				$.ajax({
					url: '../formulaire.php',
					type: 'POST',
					data: {newsId_suppr: newsId, author: author},
				})
				.done(function(data) {
					console.log(data);
					swal(
						'Newsletter supprimée !',
						'success'
						).then(function(){
							location.reload();
						})
					})
				
			})

		})
	</script>
</body>
</html>
<?php }else{
	header('Location: ../login.php');
}
?>