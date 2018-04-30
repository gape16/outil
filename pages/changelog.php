<?php

// Connexion à la base de donnée et insertion de session_start
include('../connexion_session.php');

// truncate string at word
function shapeSpace_truncate_string_at_word($string, $limit, $break = " ", $pad = "...") {  
	
	if (strlen($string) <= $limit) return $string;
	
	if (false !== ($max = strpos($string, $break, $limit))) {

		if ($max < strlen($string) - 1) {
			
			$string = substr($string, 0, $max) . $pad;
			
		}
		
	}
	
	return $string;
	
}

$id_graph=$_COOKIE['id_graph'];

if (isset($_COOKIE['id_statut'])) {

	$selection_categorie = $bdd->prepare("SELECT * FROM categorie_log");
	$selection_categorie->execute();

	$selection_log = $bdd->prepare("SELECT * FROM log left join user on user.id_user = log.auteur left join categorie_log on categorie_log.id_categorie_log = log.categorie  order by date_log DESC");
	$selection_log->execute();

	?>
	<!DOCTYPE html>
	<html lang="fr" id="log">
	<head>

		<title>Changelog</title>
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

		<style>
		#log .no-mb {
			margin-bottom: 0;
		}
		#log .icon_date{
			display: flex;
			flex-direction: column;
			width: 80px;
		}
		#log .day, #log .month{
			display: block;
			width: 100%;
		}
		#log img.avatar {
			border-radius: 100%;
			margin-right: 15px;
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

	<!-- Stunning header -->

	<div class="stunning-header bg-primary-opacity">

		<!-- ... end Header Standard Landing  -->
		<div class="header-spacer--standard"></div>

		<div class="stunning-header-content">
			<h1 class="stunning-header-title">Découvrez les nouveautés Site Privilège</h1>
			<p>Tenez-vous au courant du développement de nos outils et process</p>
		</div>

		<div class="content-bg-wrap">
			<div class="content-bg stunning-header-bg1"></div>
		</div>
	</div>

	<!-- End Stunning header -->


	<section>
		<div class="container">
			<?php if($_COOKIE['id_statut']==4 || $_COOKIE['id_statut']==5){
				?>
				<div class="ui-block">
					<div class="ui-block-title bg-blue">
						<h6 class="title c-white">Créer un nouveau sujet</h6>
					</div>
					<div class="ui-block-content">
						<div class="row">
							<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<form class="form-group label-floating is-empty help form-reset no-mb">
									<div class="form-group is-empty label-floating ">
										<select class="categorie" name="type">
											<option value="0">Choisir une catégorie</option>
											<?php foreach ($selection_categorie as $key => $value){?>
											<option value="<?php echo $value['id_categorie_log'];?> "><?php echo utf8_encode($value['nom_categorie']);?> </option>
											<?php }?>
										</select>
									</div>
									<div class="form-group is-empty label-floating no-mb">
										<div class="form-group label-floating is-empty no-mb">
											<div class="form-group label-floating is-empty">
												<label class="control-label">Titre du log</label>
												<input class="form-control titre" placeholder="" value="" type="text">
												<span class="material-input"></span></div>
												<div class="form-group label-floating is-empty">
													<label class="control-label">Description</label>
													<textarea name="description" id="description" cols="30" rows="10"></textarea>
												</div>
											</form>
											<div class="form-group label-floating is-empty">
												<form class="upload_log-file">
													<input type="file" id="file-select" name="photos" multiple>
												</form>
											</div>
											<div class="row whitecolor">
												<div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-xs-12">
													<a class="btn btn-secondary btn-lg full-width reset">Renitialiser</a>
												</div>
												<div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-xs-12">
													<a class="btn btn-green btn-lg full-width btn-icon-left valider_log"><i class="fa fa-paper-plane-o" aria-hidden="true"></i>Valider la demande</a>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php }?>
				<div class="row">
					<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 m-auto">

						<ul class="table-careers">
							<li class="head">
								<span>Date</span>
								<span>Auteur</span>
								<span>Catégorie</span>
								<span>Titre</span>
								<span></span>
							</li>
							<?php foreach ($selection_log as $key => $value){
								$date_tab=explode("-", $value['date_log']);
								$jour_tab=explode(" ",$date_tab[2]);
								$jour=$jour_tab[0];

								$m=$date_tab[1];
								$months = array (1=>'Jan',2=>'Fev',3=>'Mar',4=>'Avr',5=>'Mai',6=>'Juin',7=>'Juil',8=>'Aout',9=>'Sept',10=>'Oct',11=>'Nov',12=>'Dec');
								?>
								<li>
									<div class="date-event icon_date">
										<svg class="olymp-small-calendar-icon"><use xlink:href="../icons/icons.svg#olymp-small-calendar-icon"></use></svg>
										<span class="day"><?php echo $jour;?></span>
										<span class="month"><?php echo $months[(int)$m]; ?></span>
									</div>
									<span class="town-place"><img src="../../<?php echo $value['photo_avatar'];?>" alt="" class="avatar"><?php echo $value['nom'];?> <?php echo $value['prenom'];?></span>
									<span class="position bold"><?php echo utf8_encode($value['nom_categorie']);?> </span>
									<span class="type bold"><?php echo utf8_encode($value['titre']);?> </span>
									<span><a href="changelog_open.php?id_log=<?php echo $value['id_log'];?>" class="btn btn-primary btn-sm full-width">Voir</a></span>
								</li>
								<?php } ?>
							</ul>

						</div>
					</div>
				</div>
			</section>

			<section class="medium-padding180 bg-section5 background-cover"></section>

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
			<script src="../js/mediaelement-playlist-plugin.min.js"></script>
			<script src="../js/simpleUpload.min.js"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.9.1/sweetalert2.min.js"></script>
			<?php 
			if(!isset($_COOKIE['event'])) { 
				include("../includes/popup_event.php");
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
			<script src="../js/js.cookie.js"></script>
			<script src="../js/pages/changelog.js"></script>
			<script src="../js/charte.js"></script>
			<script src="../js/alterclass.js"></script>

		</body>
		</html>
		<?php }else{
			header('Location: ../login.php');
		}
		?>