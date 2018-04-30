<?php

// Connexion à la base de donnée et insertion de session_start
include('../connexion_session.php');

$id_graph=$_COOKIE['id_graph'];

if (isset($_COOKIE['id_statut'])) {
	// print_r($_POST);
	if ($_COOKIE['id_statut'] == 4 || $_COOKIE['id_statut'] == 5) {
		$id_etat_achat=1;
		$query_achat=$bdd->prepare("SELECT * FROM achat_photos inner join etat_achat on achat_photos.id_etat_achat = etat_achat.id_etat_achat inner join user on achat_photos.id_graph = user.id_user where achat_photos.id_etat_achat = ? order by date_achat DESC");
		$query_achat->bindParam(1, $id_etat_achat);
		$query_achat->execute();

		$query_etat=$bdd->prepare("SELECT etat, id_etat_achat FROM etat_achat where id_etat_achat != ?");
		$query_etat->bindParam(1, $id_etat_achat);
		$query_etat->execute();

		$query_notif_code=$bdd->prepare("SELECT * FROM achat_photos where id_etat_achat !=1 order by id_achat DESC limit 1");
		$query_notif_code->execute();
		$result_notif_code=$query_notif_code->fetch();
		$dernier=$result_notif_code['id_achat'];
		$query_inser_code=$bdd->prepare("UPDATE notifications set notif_C = ? where id_user = ?");
		$query_inser_code->bindParam(1, $dernier);
		$query_inser_code->bindParam(2, $id_graph);
		$query_inser_code->execute();
		?>
		<!DOCTYPE html>
		<html lang="fr">
		<head>

			<title>Achat photos</title>

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
			<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.9.1/sweetalert2.css">

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
			.avatar_photos {
				width: 30px;
				border-radius: 100%;
			}
			li.with-text {
				line-height: 34px;
			}
			.validation_achat{
				background-color: #1ed760;
			}
			#create-achat .no-mb {
				margin-bottom: 0;
			}
			p.link {
				display: flex;
				justify-content: space-between;
			}
			a.lien_getty {
				background: tomato;
				color: white;
				padding: 5px 10px;
				position: relative;
				top: -5px;
				border-radius: 3px;
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
		</div>

		<!-- Main Content Groups -->
		<?php 
		// si c'est un graph qui se connect
		if ($_SESSION['id_statut'] == 4 || $_SESSION['id_statut'] == 5 || $_SESSION['id_statut'] == 3) {?>
		<div class="container">
			<div class="row">
				<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="ui-block">
						<div class="ui-block-title">
							<h6 class="title">Demande d'achat de photos / vidéos</h6>
						</div>
						<div class="ui-block-content">

							<table class="event-item-table">
								<tbody>
									<?php if($query_achat->rowCount()==0){
										echo "Aucune demande n'a été faite";
									}
									foreach ($query_achat as $key => $value) {
										$date_tab=explode("-", $value['date_achat']);
										$jour_tab=explode(" ",$date_tab[2]);
										$jour=$jour_tab[0];

										$m=$date_tab[1];
										$months = array (1=>'Jan',2=>'Fev',3=>'Mar',4=>'Avr',5=>'Mai',6=>'Juin',7=>'Juil',8=>'Aout',9=>'Sept',10=>'Oct',11=>'Nov',12=>'Dec');

										?>
										<tr class="event-item">
											<td class="upcoming">
												<div class="date-event">
													<svg class="olymp-small-calendar-icon"><use xlink:href="../icons/icons.svg#olymp-small-calendar-icon"></use></svg>
													<span class="day"><?php echo $jour;?></span>
													<span class="month"><?php echo $months[(int)$m]; ?></span>
												</div>
											</td>
											<td class="author">
												<div class="event-author inline-items">
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
											<td class="users">
												<ul class="friends-harmonic">
													<li><img class="avatar_photos" src="../<?php echo $value['photo_avatar'];?>" alt="friend"></li>
													<li class="with-text">
														<?php echo utf8_encode($value['prenom']);?> <?php echo utf8_encode($value['nom']);?>
													</li>
												</ul>
											</td>
											<td class="add-event">
												<a data-toggle="modal" data-target="#create-achat" data-id="<?php echo $value['id_client'];?>" data-lien="<?php echo $value['lien'];?>" data-achat="<?php echo $value['id_achat'];?>" class="btn btn-breez btn-sm valider_achat_admin" style="background:#1ed760;color:white;cursor:pointer;">Acheter</a>
											</td>

										</tr>
										<?php }?>
									</tbody>
								</table>

							</div>
						</div>

					</div>

				</div>
			</div>

			<?php }?>
			<!-- ... end Window-popup Create Friends Group Add Friends -->
			<div class="modal fade show" id="create-achat" style="display: none;">
				<div class="modal-dialog ui-block window-popup create-event">
					<a href="#" class="close icon-close" data-dismiss="modal" aria-label="Close">
						<svg class="olymp-close-icon"><use xlink:href="icons/icons.svg#olymp-close-icon"></use></svg>
					</a>

					<div class="ui-block-title">
						<h6 class="title">Validation de l'achat pour client <span class="id_client"></span></h6>
						<input type="hidden" value="" class="id_achat">
					</div>

					<div class="ui-block-content">

						<p class="link">Lien du tableau getty: <a href="#" class="lien_getty" target="_blank">Getty</a>
						</p>
						<div class="form-group label-floating">
							<label class="control-label">Lien weTransfer</label>
							<input class="form-control lien_we" type="text">
						</div>


						<div class="form-group label-floating">
							<label class="control-label">Commentaire (obligatoire si commande refusée)</label>
							<textarea id="description" class="form-control commentaires" ></textarea>
							<span class="material-input"></span>
						</div>
						<p><span class="count">0</span> / 30 caractères</p>
						<div class="form-group label-floating is-select">
							<label class="control-label">Etat</label>
							<select class="form-control etat_select" size="auto">
								<option value="0">Choisir un etat</option>
								<?php foreach ($query_etat as $value) {?>
								<option value="<?php echo $value['id_etat_achat'];?>"><?php echo utf8_encode($value['etat']);?></option>
								<?php }?>
							</select>
						</div>
						<div class="form-group label-floating is-empty no-mb">
							<button class="btn btn-primary btn-lg full-width validation_achat no-mb">Valider</button>
						</div>
					</div>
				</div>
			</div>
			<!-- Window-popup-CHAT for responsive min-width: 768px -->

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

			<link rel="stylesheet" type="text/css" href="../css/bootstrap-select.css">


			<script src="../js/mediaelement-and-player.min.js"></script>
			<script src="../js/mediaelement-playlist-plugin.min.js"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.9.1/sweetalert2.min.js"></script>

			<script src="../js/pages/achat_photos.js"></script>
			<script src="../js/charte.js"></script>
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
		</body>
		</html>
		<?php }else{
			header('Location: achat_photos.php');
		}
	}else{
		header('Location: ../login.php');
	}
	?>