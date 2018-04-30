<?php

// Connexion à la base de donnée et insertion de session_start
include('../connexion_session.php');


// truncate string at word
function shapeSpace_truncate_string_at_word($string, $limit, $break = ".", $pad = "...") {  
	
	if (strlen($string) <= $limit) return $string;
	
	if (false !== ($max = strpos($string, $break, $limit))) {

		if ($max < strlen($string) - 1) {
			
			$string = substr($string, 0, $max) . $pad;
			
		}
		
	}
	
	return $string;
	
}

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
			$v = $diff->$k . ' ' . $v . (($diff->$k > 1 && $k != "m")  ? 's' : '');
		} else {
			unset($string[$k]);
		}
	}

	if (!$full) $string = array_slice($string, 0, 1);
	return $string ? ' Il y a ' .implode(', ', $string) : 'maintenant';
}

if (isset($_COOKIE['id_statut'])) {

	$selection = $bdd->prepare("SELECT * FROM perles inner join user on perles.id_user = user.id_user");
	$selection->execute();

	$id_graph=$_COOKIE['id_graph'];

	?>

	<!DOCTYPE html>
	<html lang="fr" id="veille">
	<head>

		<title>Les perles</title>

		<!-- Required meta tags always come first -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="x-ua-compatible" content="ie=edge">

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" type="text/css" href="../css/bootstrap-reboot.css">
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="../css/bootstrap-grid.css">

		<!-- Theme Styles CSS -->
		<link rel="stylesheet" type="text/css" href="../css/theme-styles.css">
		<link rel="stylesheet" type="text/css" href="../css/blocks.css">
		<link rel="stylesheet" type="text/css" href="../css/fonts.min.css">
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.9.1/sweetalert2.css">
		<link rel="stylesheet" type="text/css" href="../css/bootstrap-select.css">

		<link rel="icon" type="image/png" href="../img/favicon.png" />


		<!-- Main Font -->
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
		<style>
		.perle .post-content p {
			word-break: break-all;
		}
		svg:not(:root).svg-inline--fa{overflow:visible}.svg-inline--fa{display:inline-block;font-size:inherit;height:1em;overflow:visible;vertical-align:-.125em}.svg-inline--fa.fa-lg{vertical-align:-.225em}.svg-inline--fa.fa-w-1{width:.0625em}.svg-inline--fa.fa-w-2{width:.125em}.svg-inline--fa.fa-w-3{width:.1875em}.svg-inline--fa.fa-w-4{width:.25em}.svg-inline--fa.fa-w-5{width:.3125em}.svg-inline--fa.fa-w-6{width:.375em}.svg-inline--fa.fa-w-7{width:.4375em}.svg-inline--fa.fa-w-8{width:.5em}.svg-inline--fa.fa-w-9{width:.5625em}.svg-inline--fa.fa-w-10{width:.625em}.svg-inline--fa.fa-w-11{width:.6875em}.svg-inline--fa.fa-w-12{width:.75em}.svg-inline--fa.fa-w-13{width:.8125em}.svg-inline--fa.fa-w-14{width:.875em}.svg-inline--fa.fa-w-15{width:.9375em}.svg-inline--fa.fa-w-16{width:1em}.svg-inline--fa.fa-w-17{width:1.0625em}.svg-inline--fa.fa-w-18{width:1.125em}.svg-inline--fa.fa-w-19{width:1.1875em}.svg-inline--fa.fa-w-20{width:1.25em}.svg-inline--fa.fa-pull-left{margin-right:.3em;width:auto}.svg-inline--fa.fa-pull-right{margin-left:.3em;width:auto}.svg-inline--fa.fa-border{height:1.5em}.svg-inline--fa.fa-li{width:2em}.svg-inline--fa.fa-fw{width:1.25em}.fa-layers svg.svg-inline--fa{bottom:0;left:0;margin:auto;position:absolute;right:0;top:0}.fa-layers{display:inline-block;height:1em;position:relative;text-align:center;vertical-align:-.125em;width:1em}.fa-layers svg.svg-inline--fa{-webkit-transform-origin:center center;transform-origin:center center}.fa-layers-counter,.fa-layers-text{display:inline-block;position:absolute;text-align:center}.fa-layers-text{left:50%;top:50%;-webkit-transform:translate(-50%,-50%);transform:translate(-50%,-50%);-webkit-transform-origin:center center;transform-origin:center center}.fa-layers-counter{background-color:#ff253a;border-radius:1em;color:#fff;height:1.5em;line-height:1;max-width:5em;min-width:1.5em;overflow:hidden;padding:.25em;right:0;text-overflow:ellipsis;top:0;-webkit-transform:scale(.25);transform:scale(.25);-webkit-transform-origin:top right;transform-origin:top right}.fa-layers-bottom-right{bottom:0;right:0;top:auto;-webkit-transform:scale(.25);transform:scale(.25);-webkit-transform-origin:bottom right;transform-origin:bottom right}.fa-layers-bottom-left{bottom:0;left:0;right:auto;top:auto;-webkit-transform:scale(.25);transform:scale(.25);-webkit-transform-origin:bottom left;transform-origin:bottom left}.fa-layers-top-right{right:0;top:0;-webkit-transform:scale(.25);transform:scale(.25);-webkit-transform-origin:top right;transform-origin:top right}.fa-layers-top-left{left:0;right:auto;top:0;-webkit-transform:scale(.25);transform:scale(.25);-webkit-transform-origin:top left;transform-origin:top left}.fa-lg{font-size:1.33333em;line-height:.75em;vertical-align:-.0667em}.fa-xs{font-size:.75em}.fa-sm{font-size:.875em}.fa-1x{font-size:1em}.fa-2x{font-size:2em}.fa-3x{font-size:3em}.fa-4x{font-size:4em}.fa-5x{font-size:5em}.fa-6x{font-size:6em}.fa-7x{font-size:7em}.fa-8x{font-size:8em}.fa-9x{font-size:9em}.fa-10x{font-size:10em}.fa-fw{text-align:center;width:1.25em}.fa-ul{list-style-type:none;margin-left:2.5em;padding-left:0}.fa-ul>li{position:relative}.fa-li{left:-2em;position:absolute;text-align:center;width:2em;line-height:inherit}.fa-border{border:solid .08em #eee;border-radius:.1em;padding:.2em .25em .15em}.fa-pull-left{float:left}.fa-pull-right{float:right}.fa.fa-pull-left,.fab.fa-pull-left,.fal.fa-pull-left,.far.fa-pull-left,.fas.fa-pull-left{margin-right:.3em}.fa.fa-pull-right,.fab.fa-pull-right,.fal.fa-pull-right,.far.fa-pull-right,.fas.fa-pull-right{margin-left:.3em}.fa-spin{-webkit-animation:fa-spin 2s infinite linear;animation:fa-spin 2s infinite linear}.fa-pulse{-webkit-animation:fa-spin 1s infinite steps(8);animation:fa-spin 1s infinite steps(8)}@-webkit-keyframes fa-spin{0%{-webkit-transform:rotate(0);transform:rotate(0)}100%{-webkit-transform:rotate(360deg);transform:rotate(360deg)}}@keyframes fa-spin{0%{-webkit-transform:rotate(0);transform:rotate(0)}100%{-webkit-transform:rotate(360deg);transform:rotate(360deg)}}.fa-rotate-90{-webkit-transform:rotate(90deg);transform:rotate(90deg)}.fa-rotate-180{-webkit-transform:rotate(180deg);transform:rotate(180deg)}.fa-rotate-270{-webkit-transform:rotate(270deg);transform:rotate(270deg)}.fa-flip-horizontal{-webkit-transform:scale(-1,1);transform:scale(-1,1)}.fa-flip-vertical{-webkit-transform:scale(1,-1);transform:scale(1,-1)}.fa-flip-horizontal.fa-flip-vertical{-webkit-transform:scale(-1,-1);transform:scale(-1,-1)}:root .fa-flip-horizontal,:root .fa-flip-vertical,:root .fa-rotate-180,:root .fa-rotate-270,:root .fa-rotate-90{-webkit-filter:none;filter:none}.fa-stack{display:inline-block;height:2em;position:relative;width:2em}.fa-stack-1x,.fa-stack-2x{bottom:0;left:0;margin:auto;position:absolute;right:0;top:0}.svg-inline--fa.fa-stack-1x{height:1em;width:1em}.svg-inline--fa.fa-stack-2x{height:2em;width:2em}.fa-inverse{color:#fff}.sr-only{border:0;clip:rect(0,0,0,0);height:1px;margin:-1px;overflow:hidden;padding:0;position:absolute;width:1px}.sr-only-focusable:active,.sr-only-focusable:focus{clip:auto;height:auto;margin:0;overflow:visible;position:static;width:auto}
		.testimonial-message, .testimonial-title{
			overflow-wrap: break-word;
		}
		*,
		*::before,
		*::after {
			box-sizing: border-box;
		}

		html,
		body {
			background: #fafafa;
			color: #fff;
			font-family: Roboto, sans-serif;
		}
		html a,
		body a {
			color: #fff;
		}

		.share {
			/* position: absolute; */
			/* top: 50%; */
			/* left: 50%; */
			transform: translate(0%, 0%);
			/* padding: 8px 18px; */
			/* width: 215px; */
			height: 60px;
			font-size: 24px;
			letter-spacing: 2px;
			overflow: hidden;
			background: tomato;
			border-radius: 30px;
			text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.1);
			transition: all .2s ease-in-out;
			cursor: default;
			user-select: none;
		}
		.share .text {
			position: absolute;
			top: 18px;
			left: 42px;
			overflow: hidden;
			width: 90px;
			height: 25px;
			text-align: right;
			z-index: 1;
		}
		.share .text em {
			position: absolute;
			right: 0;
			top: 0;
			transition: right .2s ease-in-out .1s;
		}
		.share .ico-share {
			position: absolute;
			top: 20px;
			right: 43px;
			transition: right .2s ease-in-out;
			width: 20px;
			height: 20px;
		}
		.share .ico {
			font-size: 24px;
			position: absolute;
			top: 18px;
			left: -35px;
			transition: all .2s ease-in-out;
			display: inline-block;
			z-index: 2;
		}
		.share:hover {
			background: linear-gradient(to top, #15aaff, #149fee);
			box-shadow: inset 0 3px 10px rgba(0, 0, 0, 0.3);
		}
		.share:hover em {
			right: -300%;
			transition-delay: 0;
		}
		.share:hover .fb {
			left: 32px;
			transition-delay: 0.3s;
		}
		.share:hover .tw {
			left: 70px;
			font-size: 25px;
			transition-delay: 0.2s;
		}
		.share:hover .gp {
			left: 119px;
			transition-delay: 0.1s;
		}
		.share:hover .ico-share {
			top: 23px;
			right: 30px;
			width: 15px;
			height: 15px;
		}

		/* Second */
		.share:nth-child(2) {
			margin-top: 50px;
			overflow: visible;
			display: none;
		}
		.share:nth-child(2)::before, .share:nth-child(2)::after {
			content: '';
			position: absolute;
			width: 100%;
			height: 100%;
			top: 0;
			left: 0;
			z-index: 1;
			background: linear-gradient(to bottom, #15aaff, #149fee);
			border-radius: 30px;
			transition: all .2s ease-in-out 0s;
			transition-delay: 0.35s;
		}
		.share:nth-child(2)::before {
			background: linear-gradient(to bottom, #E2E2E2, #F5F5F5);
			box-shadow: inset 0 0 1px rgba(0, 0, 0, 0.7);
			top: 0;
			width: 78%;
			left: 0;
			right: 0;
			margin: 0 auto;
			z-index: -1;
			transition: top .17s ease-in-out;
			transition-delay: 0.35s;
			border-radius: 0 0 8px 8px;
		}
		.share:nth-child(2) .text,
		.share:nth-child(2) .ico-share {
			z-index: 2;
		}
		.share:nth-child(2) .ico {
			color: #15a7fa;
			top: 10px;
			text-shadow: none;
			transition: all .17s ease-in-out;
			z-index: 1;
		}
		.share:nth-child(2) .fb {
			left: 48px;
			transition-delay: 0.1s;
			color: #43609c;
		}
		.share:nth-child(2) .tw {
			left: 87px;
			transition-delay: 0.18s;
			color: #1da1f2;
		}
		.share:nth-child(2) .gp {
			left: 135px;
			transition-delay: 0.26s;
			color: #d73d32;
		}
		.share:nth-child(2) .ico-share {
			transition: all .17s ease-in-out .1s;
		}
		.share:nth-child(2):hover::after {
			box-shadow: 0 1px 4px rgba(0, 0, 0, 0.5), inset 0 3px 10px rgba(0, 0, 0, 0.3);
			background: linear-gradient(to top, #15aaff, #149fee);
			transition-delay: 0s;
		}
		.share:nth-child(2):hover::before {
			top: 90%;
			transition-delay: 0s;
		}
		.share:nth-child(2):hover .text em {
			right: 0;
		}
		.share:nth-child(2):hover .ico-share {
			top: 21px;
			right: 43px;
			width: 16px;
			height: 16px;
			transition-delay: 0s;
		}
		.share:nth-child(2):hover .ico {
			top: 75px;
		}

	</style>
</head>

<body>

	<!-- NAV + HEADER -->
	<?php 
	include('../includes/left_sidebar.php');
	include('../includes/header.php');
	include('../includes/responsive_header.php');
	?>
	<!-- ... end NAV + HEADER -->

	<div class="header-spacer header-spacer-small"></div>

	<div class="main-header">
		<div class="content-bg-wrap">
			<div class="content-bg bg-events"></div>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="ui-block">
					<div class="ui-block-title">
						<h6 class="title">Ajout perles</h6>
					</div>
					<div class="ui-block-content">
						<form class="form-group label-floating is-empty perle">
							<div class="form-group is-empty label-floating">
								<label class="control-label">Titre</label>
								<input class="form-control titreperle" placeholder="" value="" type="text">
								<span class="material-input"></span>
							</div>
							<div class="form-group label-floating is-empty">
								<label class="control-label">Description</label>
								<textarea name="description" id="description" cols="30" rows="10"></textarea>
							</div>
							<div class="form-group label-floating is-empty">
								<form class="upload_perle">
									<input type="file" id="file-select" name="photos" required="required">
								</form>
							</div>
						</form>
						<div class="row">
							<div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<a href="#" class="btn btn-secondary btn-lg full-width reni_perle">Renitialiser</a>
							</div>
							<div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<a href="#" class="btn btn-green btn-lg full-width btn-icon-left valider_perle"><i class="fa fa-paper-plane-o" aria-hidden="true"></i>
								Envoyer l'article</a>
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
						<h6 class="title">Les perles du moment</h6>
					</div>
				</div>
				<div class="row">
					<?php 
					foreach ($selection as $key => $value) {
						$id_perles=$value['idperles'];
						$selection_note = $bdd->prepare("SELECT * FROM note_perles where id_perles = ?");
						$selection_note->bindParam(1, $id_perles);
						$selection_note->execute();
						$nb_note=$selection_note->rowCount();
						$note_final=0;
						if($nb_note == 0){
							$note_final = 0;
						}else{
							foreach ($selection_note as $key => $note) {
								$note_final=$note_final+$note['note_perles'];
							}
							$note_final=$note_final/$nb_note;
						}
						$pleine = "M259.3 17.8L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z";
						$vide = "M528.1 171.5L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6zM388.6 312.3l23.7 138.4L288 385.4l-124.3 65.3 23.7-138.4-100.6-98 139-20.2 62.2-126 62.2 126 139 20.2-100.6 98z";
						?>
						<div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
							<div class="ui-block">
								<div class="crumina-module crumina-testimonial-item">
									<div class="testimonial-header-thumb" style="background: url('../uploads/perles/<?php echo utf8_encode($value['img_perle']);?>'); background-size:cover;"></div>

									<div class="testimonial-item-content">

										<div class="author-thumb">
											<img src="../<?php echo utf8_encode($value['photo_avatar']);?>" alt="author" style="max-width: 100px;max-height: 100px;">
										</div>

										<h3 class="testimonial-title"><?php echo utf8_encode($value['titre_perle']);?></h3>

										<ul class="rait-stars">
											<li>
												<svg class="svg-inline--fa fa-star fa-w-18 star-icon" aria-hidden="true" data-prefix="fa" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path fill="currentColor" d="<?php if($note_final>= 1){ echo $pleine; }else{ echo $vide; }?>"></path></svg><!-- <i class="fa fa-star star-icon"></i> -->
											</li>
											<li>
												<svg class="svg-inline--fa fa-star fa-w-18 star-icon" aria-hidden="true" data-prefix="fa" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path fill="currentColor" d="<?php if($note_final>= 2){ echo $pleine; }else{ echo $vide; }?>"></path></svg><!-- <i class="fa fa-star star-icon"></i> -->
											</li>

											<li>
												<svg class="svg-inline--fa fa-star fa-w-18 star-icon" aria-hidden="true" data-prefix="fa" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path fill="currentColor" d="<?php if($note_final>= 3){ echo $pleine; }else{ echo $vide; }?>"></path></svg><!-- <i class="fa fa-star star-icon"></i> -->
											</li>
											<li>
												<svg class="svg-inline--fa fa-star fa-w-18 star-icon" aria-hidden="true" data-prefix="fa" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path fill="currentColor" d="<?php if($note_final>= 4){ echo $pleine; }else{ echo $vide; }?>"></path></svg><!-- <i class="fa fa-star star-icon"></i> -->
											</li>
											<li>
												<svg class="svg-inline--fa fa-star fa-w-18 star-icon" aria-hidden="true" data-prefix="fa" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path fill="currentColor" d="<?php if($note_final>= 5){ echo $pleine; }else{ echo $vide; }?>"></path></svg><!-- <i class="fa fa-star star-icon"></i> -->
											</li>
										</ul>

										<p class="testimonial-message"><?php echo utf8_encode($value['description_perle']);?>
										</p>

										<div class="author-content">
											<a href="#" class="h6 author-name"><?php echo utf8_encode($value['prenom']." ".$value['nom']);?></a>
											<div class="country"><?php echo time_elapsed_string($value['date_perle']);?></div>
										</div>
										<!-- <a href="#" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#registration-login-form-popup">Voter | <?php echo $nb_note;?><div class="ripple-container"></div></a> -->
										<div class="share">
											<a href="https://www.facebook.com/sharer/sharer.php?u=http%3A//codepen.io/supah/pen/MKNwZV" target="_blank" class="ico fb"><i class="fa fa-facebook"></i></a>
											<a href="https://twitter.com/home?status=Social%20Share%20by%20%40supahfunk%20http%3A//codepen.io/supah/pen/MKNwZV" target="_blank" class="ico tw"><i class="fa fa-twitter"></i></a>
											<a href="https://plus.google.com/share?url=http%3A//codepen.io/supah/pen/MKNwZV" target="_blank" class="ico gp"><i class="fa fa-google-plus"></i></a>
											<span class="text"><em>VOTER | (<?php echo $nb_note;?>)</em></span>
											<svg class="ico-share"><use xlink:href="#ico-share"></use></svg>
										</div>
										<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="display:none;">
											<symbol id="ico-share" x="0px" y="0px"
											viewBox="0 0 16 16" enable-background="new 0 0 16 16" xml:space="preserve">
											<g>
												<path fill="#FFFFFF" d="M13.26,10.387c-0.781,0-1.484,0.328-1.982,0.854L5.445,8.385c0.02-0.133,0.034-0.27,0.034-0.41
												c0-0.136-0.013-0.269-0.032-0.399l5.823-2.824c0.5,0.529,1.205,0.861,1.99,0.861c1.514,0,2.74-1.227,2.74-2.74
												s-1.227-2.74-2.74-2.74c-1.513,0-2.739,1.227-2.739,2.74c0,0.136,0.013,0.269,0.032,0.399L4.73,6.097
												c-0.5-0.529-1.205-0.861-1.99-0.861C1.227,5.236,0,6.462,0,7.976c0,1.513,1.227,2.739,2.74,2.739c0.781,0,1.484-0.328,1.983-0.854
												l5.832,2.855c-0.021,0.134-0.035,0.27-0.035,0.41c0,1.514,1.227,2.739,2.74,2.739S16,14.641,16,13.127S14.773,10.387,13.26,10.387z
												"/></g>
											</symbol></svg>
										</div>
									</div>
								</div>
							</div>
							<?php }?>

						</div>
						<!-- .. end W-Twitter -->
					</div>
				</div>
			</div>
		</div>
		<!-- ... end Window-popup Create Friends Group Add Friends -->

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
		<script src="../js/simpleUpload.min.js"></script>

		<!-- Swiper / Sliders -->
		<script src="../js/swiper.jquery.min.js"></script>

		<script src="../js/isotope.pkgd.min.js"></script>

		<script src="../js/mediaelement-and-player.min.js"></script>
		<script src="../js/mediaelement-playlist-plugin.min.js"></script>

		<script src="../js/mediaelement-and-player.min.js"></script>
		<script src="../js/mediaelement-playlist-plugin.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.9.1/sweetalert2.min.js"></script>
		<script src="../js/simpleUpload.min.js"></script>
		<script src="../js/charte.js"></script>
		<script src="../js/js.cookie.js"></script>
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
		<script type="text/javascript">
			$(function(){

				function makeid() {
					var text = "";
					var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

					for (var i = 0; i < 5; i++)
						text += possible.charAt(Math.floor(Math.random() * possible.length));
					text += '-';

					return text;
				}

				$(".reni_perle").on("click", function(){
					$(".perle").find("input").val('');
					$(".perle").find("select").val(0);
					$(".perle").find("textarea").val('');
				})

				$('.valider_perle').on('click', function(e){
					e.preventDefault();
					var titreperle = $('.titreperle').val();
					var file = $("#file-select").prop("files");
					var description = $('#description').val();
					var names = $.map(file, function (val) { return val.name; });
					var token = makeid();
					Cookies.set('token', token);
					if (titreperle.length >= 5) {
						$('.titreperle').removeClass('empty');
						if (description.length >= 30) {
							$('#description').removeClass('empty');
							$.ajax({
								url: '../../formulaire.php',
								type: 'POST',
								data: {titreperle: titreperle, description_perle: description, file_perle: names, token_perle: token}
							})
							.done(function(data) {
								swal(
									'Perle ajoutée !',
									'',
									'success'
									).then(function(){
										location.reload();
									})		
								})
							$('#file-select').simpleUpload("../../uploads/upload_perle.php", {

								start: function(file){
									//upload started
								},
								progress: function(progress){
									//received progress
								},
								success: function(data){
									console.log("upload successful!");
									console.log(data);
								},
								error: function(error){
									// console.log(error);
								}

							});
						}else{
							$('#description').addClass('empty');
							$('#description').prev().html('30 caractères minimum requis');
						}
					}else{
						$('.titreperle').addClass('empty');
						$('.titreperle').prev().html('5 caractères minimum requis');
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