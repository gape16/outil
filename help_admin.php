<?php

// Connexion à la base de donnée et insertion de session_start
include('connexion_session.php');

$id_graph=$_SESSION['id_graph'];

if (isset($_SESSION['id_statut'])) {
	// print_r($_POST);
	$query_achat=$bdd->prepare("SELECT * FROM achat_photos inner join etat_achat on achat_photos.id_etat_achat = etat_achat.id_etat_achat where id_graph = ? order by date_achat DESC");
	$query_achat->bindParam(1, $id_graph);
	$query_achat->execute();
	?>
	<!DOCTYPE html>
	<html lang="en">
	<head>

		<title>Friend Groups</title>

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
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.9.1/sweetalert2.css">

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
		<!-- Custom CSS -->
		<link rel="stylesheet" href="css/main.css">
		<link rel="stylesheet" href="css/jquery.fancybox.min.css">

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
				<div class="content-bg bg-music"></div>
			</div>
			<div class="container">
				<div class="row">
					<div class="col-lg-8 offset-lg-2 col-md-8 offset-md-2 col-sm-12 col-xs-12">
						<div class="main-header-content">
							<h1>N'hésitez plus, achetez vos photos!</h1>
							<p>C'est ici que vous allez pouvoir faire les demandes d'achat de photos et vidéos. vous pourrez télécharger au plus vite gràce au système de notification.
							</p>
						</div>
					</div>
				</div>
			</div>

			<img class="img-bottom" src="img/music-bottom.png" alt="friends">
		</div>

		<!-- Main Content Groups -->
		<div class="container">
			<div class="row">
				<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="ui-block">
						<div class="ui-block-title ui-block-title-small">
							<h6 class="title">Historique de mes achats</h6>
						</div>
						<table class="event-item-table">
							<tbody>
								<?php foreach ($query_achat as $key => $value) {
									$date_tab=explode("-", $value['date_achat']);
									$jour_tab=explode(" ",$date_tab[2]);
									$jour=$jour_tab[0];

									$m=$date_tab[1];
									$months = array (1=>'Jan',2=>'Fev',3=>'Mar',4=>'Avr',5=>'Mai',6=>'Juin',7=>'Juil',8=>'Aout',9=>'Sept',10=>'Oct',11=>'Nov',12=>'Dec');

									?>
									<tr class="event-item">
										<td class="upcoming">
											<div class="date-event">
												<svg class="olymp-small-calendar-icon"><use xlink:href="icons/icons.svg#olymp-small-calendar-icon"></use></svg>
												<span class="day"><?php echo $jour;?></span>
												<span class="month"><?php echo $months[(int)$m]; ?></span>
											</div>
										</td>
										<td class="author">
											<div class="event-author inline-items">
												<div class="author-thumb">
													<img src="img/avatar43-sm.jpg" alt="author">
												</div>
												<div class="author-date">
													<a class="author-name h6"><?php echo $value['id_client'];?></a>
												</div>
											</div>
										</td>
										<td class="location">
											<div class="place inline-items">
												<svg class="olymp-add-a-place-icon"><use xlink:href="icons/icons.svg#olymp-add-a-place-icon"></use></svg>
												<a href="<?php echo $value['lien'];?>" target="_blank" style="color:inherit;"><span>Lien Getty</span></a>
											</div>
										</td>
										<td class="users">
											<p class="description"><span style="font-weight: bold;">Catégorie:</span> <?php echo utf8_encode($value['categorie']);?></p>
										</td>
										<?php if(!empty($value['commentaire_controleur'])){?>
										<td class="description">
											<p class="description"><span style="font-weight: bold;">Commentaire contrôleur</span>: <?php echo utf8_encode($value['commentaire_controleur']);?></p>
										</td>
										<?php }else{?>
										<td class="description"></td>
										<?php }?>
										<td class="add-event">
											<a <?php if($value['id_etat_achat']==3){echo "href='".$value['lien_we']."' target='_blank'";}?> class="btn btn-breez btn-sm" style="background:<?php echo $value['couleur'];?>;color:white;"><?php echo utf8_encode($value['etat']);?></a>
										</td>

									</tr>
									<?php }?>
								</tbody>
							</table>




						</div>
					</div>
				</div>
			</div>

			<?php }?>
			<!-- ... end Window-popup Create Friends Group Add Friends -->

			<!-- Window-popup-CHAT for responsive min-width: 768px -->

			<?php include('chat_box.php');?>

			<!-- ... end Window-popup-CHAT for responsive min-width: 768px -->


			<!-- jQuery first, then Other JS. -->
			<script src="js/jquery-3.2.0.min.js"></script>
			<!-- Js effects for material design. + Tooltips -->
			<script src="js/material.min.js"></script>
			<!-- Helper scripts (Tabs, Equal height, Scrollbar, etc) -->
			<script src="js/theme-plugins.js"></script>
			<!-- Init functions -->
			<script src="js/main.js"></script>
			<script src="js/alterclass.js"></script>
			<script src="js/chat.js"></script>
			<!-- Select / Sorting script -->
			<script src="js/selectize.min.js"></script>

			<link rel="stylesheet" type="text/css" href="css/bootstrap-select.css">


			<script src="js/mediaelement-and-player.min.js"></script>
			<script src="js/mediaelement-playlist-plugin.min.js"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.9.1/sweetalert2.min.js"></script>

			<script src="js/charte.js"></script>
		</body>
		</html>