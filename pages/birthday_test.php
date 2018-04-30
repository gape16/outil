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

$id_graph=$_COOKIE['id_graph'];

if (isset($_COOKIE['id_statut'])) {
	// $id_receveur=$_POST['receveur'];
	// $query_com_anniv_select=$bdd->prepare("SELECT * FROM commentaires_anniversaire inner join user on commentaires_anniversaire.id_receveur = user.id_user order by date_com DESC");
	// $query_com_anniv_select->execute();

	?>
	<!DOCTYPE html>
	<html lang="fr" id="birth">
	<head>

		<title>Les anniversaires</title>
		<meta http-equiv="refresh" content="12000">

		<!-- Required meta tags always come first -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="x-ua-compatible" content="ie=edge">

		<link rel="icon" type="image/png" href="../img/favicon.png" />

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" type="text/css" href="../css/bootstrap-reboot.css">
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="../css/bootstrap-grid.css">

		<!-- Theme Styles CSS -->
		<link rel="stylesheet" type="text/css" href="../css/theme-styles.css">
		<link rel="stylesheet" type="text/css" href="../css/blocks.css">

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
		<link rel='stylesheet' href='../css/fullcalendar.css'/>
		<link rel='stylesheet' href='../css/simplecalendar.css'/>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap-select.css">
		<link rel="stylesheet" type="text/css" href="../css/daterangepicker.css">
		<link rel="stylesheet" type="text/css" href="../css/main.css">
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.9.1/sweetalert2.css">
		<link rel="stylesheet" type="text/css" href="    https://cdn.jsdelivr.net/npm/pretty-checkbox@3.0/dist/pretty-checkbox.min.css
		">
		<style>
		.flag {
			width: 50px;
			background: tomato;
			height: 87px;
			padding: 0;
			margin-right: 25px;
		}


		.wrapper{
			width: 50px;
		}

		.act{
			position: absolute;
			width: 402px;
			height: 91px;
			background: #38a9ff;
			top: 0;
			border-radius: 5px;
			display: flex;
		}
		.act_n{
			position: absolute;
			width: 402px;
			height: 91px;
			background: #ddd;
			top: 0;
			border-radius: 5px;
			display: flex;
		}

		/* Switch 1 Specific Styles Start */

		input[type="checkbox"].switch_1{
			font-size: 30px;
			-webkit-appearance: none;
			-moz-appearance: none;
			appearance: none;
			height: 1em;
			background: #ddd;
			border-radius: 3em;
			position: relative;
			cursor: pointer;
			outline: none;
			-webkit-transition: all .2s ease-in-out;
			transition: all .2s ease-in-out;
			display: block;
			margin-right: 15px;
		}

		input[type="checkbox"].switch_1:checked{
			background: #0ebeff;
		}

		input[type="checkbox"].switch_1:after{
			position: absolute;
			content: "";
			width: 1em;
			height: 1em;
			border-radius: 50%;
			background: #fff;
			-webkit-box-shadow: 0 0 .25em rgba(0,0,0,.3);
			box-shadow: 0 0 .25em rgba(0,0,0,.3);
			-webkit-transform: scale(.7);
			transform: scale(.7);
			left: 0;
			-webkit-transition: all .2s ease-in-out;
			transition: all .2s ease-in-out;
		}

		input[type="checkbox"].switch_1:checked:after{
			left: calc(100% - 1em);
		}

		/* Switch 1 Specific Style End */

		
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

	<!-- Main Header Events -->

	<div class="main-header">
		<div class="content-bg-wrap">
			<div class="content-bg bg-birthday"></div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 col-md-8 offset-md-2 col-sm-12 col-xs-12">
					<div class="main-header-content">
						<h1>N'oubliez jamais un anniversaire!</h1>
						<p>Bienvenu sur la page des anniversaire ce qui vous permettre de ne plus rater aucune date.
						</p>
					</div>
				</div>
			</div>
		</div>

		<img class="img-bottom" src="../img/birthdays-bottom.png" alt="friends">
	</div>

	<!-- ... end Main Header Events -->


	<div class="container">
		<div class="row">
			<?php for ($i=1; $i < 13; $i++) { 
				if ($i<10) {
					$u="0".$i;
				}else{
					$u=$i;
				}
				$var = "%-".$u."-%";
				$query_=$bdd->prepare("SELECT * FROM user left join gestion_anniversaire on user.id_user=gestion_anniversaire.id_receveur where date_naissance like ? order by day(date_naissance) ASC");
				$query_->bindParam(1, $var);
				$query_->execute();
				$tab=["Janvier","Fevrier","Mars","Avril","Mai","Juin","Juillet","Aout","Septembre","Octobre","Novembre","Decembre"];
				?>

				<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="ui-block">
						<div class="ui-block-title">
							<h6 class="title"><?php echo $tab[$i-1];?></h6>
						</div>
					</div>
				</div>
				<?php foreach ($query_ as $key => $value) {	
					$id_compte=$value['id_user'];
					$query_test=$bdd->prepare("SELECT * FROM notification_anniversaire where id_compte = ? and id_user_selection = ?");
					$query_test->bindParam(1, $id_graph);
					$query_test->bindParam(2, $id_compte);
					$query_test->execute();
					$nb_retour=$query_test->rowCount();
					if($nb_retour==0){
						$no_notif=0;
					}else{
						$retour_test=$query_test->fetch();
						$no_notif=$retour_test['active'];
					}
					?>
					<div class="col-xl-4 col-lg-6 col-md-12 col-sm-12 col-xs-12 bd">
						<div class="ui-block">
							<div class="birthday-item inline-items">
								<div class="wrapper">
									<div class="switch_box box_1">
										<input type="checkbox" class="switch_1 dial_<?php echo $value['id_user'];?>" <?php if($no_notif==1){echo "checked";} ?>>
									</div>
								</div>
								<div class="author-thumb">
									<img class="birthday-pic" src="../<?php echo utf8_encode($value['photo_avatar']);?>" alt="author">
								</div>
								<div class="birthday-author-name">
									<a href="#" class="h6 author-name"><?php echo $value['prenom']." ".$value['nom'];?></a>
									<div class="birthday-date"><?php echo explode("-",$value['date_naissance'])[2];?> <?php echo $tab[$i-1];?></div>
								</div>
								<a href="birthday_open_test.php?post=<?php echo $value['id_aide'];?>" data-emet="<?php echo $value['id_emetteur'];?>" data-id="<?php echo $value['id_user'];?>" class="btn btn-sm bg-blue participer">Participer</a>
							</div>
						</div>
					</div>
					<?php }}?>


					<input type="hidden" class="who" value="<?php echo $_COOKIE['id_graph']?>">
				</div>
			</div>
			<!-- Window-popup Event Private Public -->
			<div class="modal fade show" id="anniversaire" >
				<div class="modal-dialog ui-block window-popup event-private-public private-event">
					<a href="#" class="close icon-close" data-dismiss="modal" aria-label="Close">
						<svg class="olymp-close-icon"><use xlink:href="icons/icons.svg#olymp-close-icon"></use></svg>
					</a>
					<article class="hentry post has-post-thumbnail thumb-full-width private-event">

						<div class="row">
							<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
								<div class="post__author author vcard inline-items">
									<div class="author-date">
										<a class="h6 post__author-name fn user_popup" href="#">PARTICIPATION ANNIVERSAIRE</a>
										<div class="post__date date_popup">
											<time class="published" datetime="2017-03-24T18:18">

											</time>
										</div>
									</div>

								</div>
								<div class="wrapper_msg">
									<div class="msg_gestionnaire" contenteditable="false">
									</div>
								</div>
							</div>
							<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
								<div class="event-description">
									<h6 class="event-description-title">Infos pratiques</h6>
									<div class="place inline-items">
										<img class="avatar" src="" alt="author">
										<span class="who"></span>
										<span class="when"></span>
									</div>
									<a class="btn chef_anniv">S'occuper de l'anniversaire</a>
									<div class="wrapper_anniv_cmd">
										<div class="dib">
											<p>Date butoir :</p>
											<input type="date" class="date_bday" name="bday">
										</div>
										<a href="#" class="btn btn-green btn-lg reni">Réinitialiser</a>
										<a href="#" class="btn btn-green btn-lg save">Sauvegarder</a>
									</div>
								</div>
							</div>
						</article>

						<div class="com" data-mcs-theme="dark" style="max-height: 380px;overflow-y: scroll;">
							<ul class="com_anniv">

							</ul>
						</div>

						<form class="comment-form inline-items">

							<div class="form-group with-icon-right ">
								<textarea class="form-control envoi_message_anniversaire" placeholder=""  ></textarea>
								<input type="hidden" class="id_anniversaire">
								<div class="add-options-message">
									<a href="#" class="options-message anniv-envoi">
										<svg class="olymp-camera-icon"><use xlink:href="icons/icons.svg#olymp-chat---messages-icon"></use></svg>
									</a>
								</div>

								<span class="material-input"></span><span class="material-input"></span>
							</div>

						</form>
					</div>
					<input type="hidden" class="hax-qui">
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

		<!-- Select / Sorting script -->
		<script src="../js/selectize.min.js"></script>

		<!-- Swiper / Sliders -->
		<script src="../js/swiper.jquery.min.js"></script>

		<!-- Datepicker input field script-->
		<script src="../js/moment.min.js"></script>
		<script src="../js/daterangepicker.min.js"></script>

		<!-- Calendar events script -->
		<script src="../js/fullcalendar.js"></script>

		<script src="../js/mediaelement-and-player.min.js"></script>
		<script src="../js/mediaelement-playlist-plugin.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.9.1/sweetalert2.min.js"></script>
		<?php 
		if(isset($_COOKIE['event'])) { 
			if($_COOKIE['event']==1){
				include("../includes/popup_event.php");
			}
		}
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
		<script src="../js/pages/birthday.js"></script>
		<script src="../js/charte.js"></script>
		<script src="../js/alterclass.js"></script>
	</body>
	</html>
	<?php }else{
		header('Location: ../login.php');
	}
	?>