<?php

// Connexion à la base de donnée et insertion de session_start
include('../connexion_session.php');

$id_graph=$_COOKIE['id_graph'];

if (isset($_COOKIE['id_statut'])) {
	// print_r($_POST);
	if ($_COOKIE['id_statut'] == 1 || $_COOKIE['id_statut'] == 2 || $_COOKIE['id_statut'] == 3 || $_COOKIE['id_statut'] == 4 || $_COOKIE['id_statut'] == 5) {
	// print_r($_POST);
		$query_=$bdd->prepare("SELECT id_user, nom, prenom FROM user WHERE id_manager = ?");
		$query_->bindParam(1, $id_graph);
		$query_->execute();
		$requete_proposition = $bdd->prepare("SELECT id_proposition, date_proposition, num_client, lien_maquette, proposition_design.id_user FROM proposition_design INNER JOIN user ON proposition_design.id_user = user.id_user");
		$requete_proposition->execute();
		?>
		<!DOCTYPE html>
		<html lang="en">
		<head>

			<title>Controleur</title>
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
			.show_maquette{
				display: table-row !important;
			}
			a.show_all {
				padding: 10px 10px 10px 10px;
				float: right;
				background: #1ed760;
				color: white !important;
				border-radius: 2px;
				cursor: pointer;
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
							<h1>Site du mois</h1>
							<p>Vous allez pouvoir proposer votre site du mois
							</p>
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
							<h6 class="title">Lien maquette</h6>
						</div>
						<div class="ui-block-content">
							<form method="POST" action="achat_photos.php" class="ajout_photo">
								<div class="form-group label-floating is-empty">
									<select name="" id="graphiste">
										<option value="0">Choisir un graphiste</option>
										<?php foreach ($query_ as $value): ?>
											<option value="<?php echo utf8_encode($value['id_user']);?>"><?php echo utf8_encode($value['nom'] .' '. $value['prenom']);?></option>
										<?php endforeach ?>
									</select>
								</div>
								<div class="form-group label-floating is-empty">
									<label class="control-label">Numero client</label>
									<input class="form-control numclient" type="text" placeholder="" name="id_client">
									<span class="material-input"></span>
								</div>
								<div class="form-group label-floating is-empty">
									<label class="control-label">Lien maquette</label>
									<input class="form-control lienmaquette" type="text" placeholder="" name="id_client">
									<span class="material-input"></span>
								</div>
							</form>


							<div class="row">
								<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
									<a href="#" class="btn btn-green btn-lg full-width btn-icon-left valider_design"><i class="fa fa-paper-plane-o" aria-hidden="true"></i>
									Proposer la maquette</a>
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
						<div class="ui-block-title ui-block-title-small">
							<h6 class="title">Maquettes proposées</h6>
							<a href="#" class="show_all">Montrer tout</a>
						</div>

						<table class="event-item-table" id="proposition_maquette">
							<tbody>
								<?php foreach ($requete_proposition as $key => $value) {
									$date_tab=explode("-", $value['date_proposition']);
									$jour_tab=explode(" ",$date_tab[2]);
									$jour=$jour_tab[0];
									$semaine = date('W', strtotime($value['date_proposition']));

									$m=$date_tab[1];
									$months = array (1=>'Jan',2=>'Fev',3=>'Mar',4=>'Avr',5=>'Mai',6=>'Juin',7=>'Juil',8=>'Aout',9=>'Sept',10=>'Oct',11=>'Nov',12=>'Dec');
									?>
									<tr class="event-item week_<?php echo $semaine;?>">
										<td class="upcoming">
											<div class="date-event">
												<svg class="olymp-small-calendar-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="../icons/icons.svg#olymp-small-calendar-icon"></use></svg>
												<span class="day"><?php echo $jour;?></span>
												<span class="month"><?php echo $months[(int)$m]; ?></span>
											</div>
										</td>
										<td class="author">
											<div class="event-author inline-items">
												<div class="author-date">
													<a class="author-name h6"><?php echo $value['num_client'] ?></a>
												</div>
											</div>
										</td>
										<td class="location">
											<div class="place inline-items">
												<svg class="olymp-add-a-place-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="../icons/icons.svg#olymp-add-a-place-icon"></use></svg>
												<a href="<?php echo $value['lien_maquette'] ?>" style="color: #9ea3b8;" target="_blank">Lien de la maquette</a>
											</div>
										</td>
										<td class="add-event">
											<p><?php utf8_encode($value['prenom']).' '. utf8_encode($value['prenom']) ?></p>
										</td>
										<td class="delete">
											<div class="date-event">
												<a class="btn-haxor check_proposition" data-toggle="modal" data-target="#delete" data-client="<?php echo $value['num_client'] ?>" href="#">Supprimer</a>
											</div>
										</td>
									</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="modal fade show" id="check_design">
				<div class="modal-dialog ui-block window-popup edit-widget edit-widget-pool">
					<a href="#" class="close icon-close" data-dismiss="modal" aria-label="Close">
						<svg class="olymp-close-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="../icons/icons.svg#olymp-close-icon"></use></svg>
					</a>
					<div class="ui-block-title">
						<h6 class="title">Numéro client : </h6>
					</div>
					<div class="ui-block">
						<div class="ui-block-content">
							<div class="row modalcheck">	
								<div class="form-group is-empty label-floating ">
									<label class="control-label">Note sur /10</label>
									<input class="form-control note" placeholder="" value="" type="text">
								</div>
							</div>
							<div class="row">	
								<div class="col-lg-12 col-sm-12">
									<a href="#" class="btn btn-md full-width accept">Accepter</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- MODAL SUPPR -->
			<div class="modal fade show" id="delete">
				<div class="modal-dialog ui-block window-popup edit-widget edit-widget-pool">
					<a href="#" class="close icon-close" data-dismiss="modal" aria-label="Close">
						<svg class="olymp-close-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="../icons/icons.svg#olymp-close-icon"></use></svg>
					</a>
					<div class="ui-block-title">
						<h6 class="title">Supprimer le site : <span class="appendnc"></span></h6>
					</div>
					<div class="ui-block nomb">
						<div class="ui-block-content">
							<div class="row">	
								<div class="col-lg-12 col-sm-12">
									<a href="#" class="btn btn-md full-width red refus">Accepter</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<input class="weekoftheday" type="hidden" value="<?php echo date('W')?>">
	</div>

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
	<script src="../js/charte.js"></script>
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

	<script>
		$(function(){
				//AJOUTER UN DESIGN
				$('.valider_design').on('click', function(e){
					e.preventDefault();
					var numClient = $('.numclient').val();
					var lienMaquette = $('.lienmaquette').val();
					var idUser = $('#graphiste').val();

					console.log(numClient);
					console.log(lienMaquette);
					console.log(idUser);
					if(numClient.length == 8 && $.isNumeric(numClient)){
						$('.numclient').removeClass('empty');
						if(idUser != 0){
							$('#graphiste').removeClass('empty');
							if (lienMaquette.length != 0) {
								$('.lienmaquette').removeClass('empty');
								$.ajax({
									url: '../../formulaire.php',
									type: 'POST',
									data: {numClient_controleur: numClient, lienMaquette: lienMaquette, idUser: idUser},
								})
								.done(function(data) {
									if (data == "existant") {
										swal(
											'Erreur',
											'Vous avez déjà proposé une maquette ce mois ci',
											'error'
											).then(function () {
												location.reload();
											})
										}else{
											$(data).appendTo('#proposition_maquette tbody');
											swal(
												'Design validé',
												'La maquette est mise de côté',
												'success'
												).then(function () {
													location.reload();
												})
											}
										})
							}else{
								$('.lienmaquette').addClass('empty');
								$('.lienmaquette').prev().html("Un lien de maquette est requis");
							}
						}else{
							$('#graphiste').addClass('empty');
							$('#graphiste').prev().html("Un graphiste est requis");
						}
					}else{
						$('.numclient').addClass('empty');
						$('.numclient').prev().html("Le numéro client doit être à 8 chiffres");
					}
				});

				// AFFICHAGE SEMAINE EN COUR
				// $('.show_all').on('click', function(e){
				// 	e.preventDefault()
				// 	$.ajax({	
				// 		url: '../../formulaire.php',
				// 		type: 'POST',
				// 		data: {showWeek: 'value1'},
				// 	})
				// 	.done(function(data) {
				// 		console.log(data);
				// 		$('.event-item').each(function(){
				// 			if ($(this).hasClass('week_'+ data +'')) {
				// 				$(this).fadeIn();
				// 			}else{
				// 				$(this).fadeOut();
				// 			}
				// 		})
				// 	})
				// });

				var week = $('.weekoftheday').val();
				$('.event-item').each(function(){
					if ($(this).hasClass('week_'+ week +'')) {
						$(this).show();
					}else{
						$(this).hide();
					}
				})
				$('.show_all').on('click', function(){
					$('.event-item').each(function(){
						if (!$(this).hasClass('week_'+ week +'')) {
							$(this).toggleClass('show_maquette');
						}
					});
				})

			});
		</script>
	</body>
	</html>
	<?php }else{
		header('Location: ../help.php');
	}
}else{
	header('Location: ../login.php');
}
?>