<?php

// Connexion à la base de donnée et insertion de session_start
include('connexion_session.php');


if (isset($_SESSION['id_statut'])) {
	if ($_SESSION['id_statut'] == 5 || $_SESSION['id_statut'] == 3) {

		$id_graph=$_SESSION['id_graph'];
		// si c'est un graph qui se connect
		$envoid=0;
		$requete_up_pret = $bdd->prepare('UPDATE client set envoi_maquette=? where id_graph_maquette = ? or id_graph_cq = ? or id_controleur_maquette = ? or id_controleur_cq = ?');
		$requete_up_pret->bindParam(1, $envoid);
		$requete_up_pret->bindParam(2, $id_graph);
		$requete_up_pret->bindParam(3, $id_graph);
		$requete_up_pret->bindParam(4, $id_graph);
		$requete_up_pret->bindParam(5, $id_graph);
		$requete_up_pret->execute(); 


		$selection_graph = $bdd->prepare("SELECT * FROM user");
		$selection_graph->execute();

		$selection_qualif = $bdd->prepare("SELECT * FROM etat");
		$selection_qualif->execute();
		?>

		<!DOCTYPE html>
		<html lang="fr">
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

			<?php 
			if($_SESSION['id_statut']==1) {
			//page graphistes 
				include('left_sidebar.php');
			}elseif  ($_SESSION['id_statut']==2){
			//page  redacteurs
				include('left_sidebar_redac.php');
			}
			elseif ($_SESSION['id_statut']==3) {
			//page leader
				include('left_sidebar_leader.php');
			}elseif ($_SESSION['id_statut']==4) {
			//page controleur
				include('left_sidebar_controleur.php');
			}elseif($_SESSION['id_statut']==5){
			//page admin
				include('left_sidebar_admin.php');
			}
			?>


			<!-- ... end Fixed Sidebar Left -->

			<!-- Fixed Sidebar Right -->

			<?php include('fixed_sidebar_right.php');?>

			<!-- ... end Fixed Sidebar Right -->


			<!-- Header -->

			<?php 
			if($_SESSION['id_statut']==1) {
			//page graphistes 
				include('header.php');
			}elseif  ($_SESSION['id_statut']==2){
			//page  redacteurs
				include('header.php');
			}
			elseif ($_SESSION['id_statut']==3) {
			//page leader
				include('header.php');
			}elseif ($_SESSION['id_statut']==4) {
			//page controleur
				include('header_admin.php');
			}elseif($_SESSION['id_statut']==5){
			//page admin
				include('header_admin.php');
			}
			?>
			

			<!-- ... end Header -->


			<!-- Responsive Header -->

			<?php include('responsive_header.php');?>

			<!-- ... end Responsive Header -->

			<!-- ... end Responsive Header -->


			<div class="header-spacer header-spacer-small"></div>

			<!-- Main Content Groups -->


			<div class="container cards">
				<div class="row">
					<div class="container">
						<div class="row">
							<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<div class="ui-block">
									<div class="ui-block-title">
										<h6 class="title">Recherche de projet</h6> 
										<div class="form-group label-floating is-empty">
											<label class="control-label">Recherche</label>
											<input class="form-control search" placeholder="" value="" type="text">
											<span class="material-input"></span>
										</div>
									</div>

								</div>
							</div>
						</div>
					</div>

					<div class="container">
						<div class="row admin_card">
						</div>
					</div>
				</div>
			</div>
			<!-- ... end Main Content Groups -->


			<!-- Window-popup Create Friends Group -->
			<div class="modal fade show" id="change">
				<div class="modal-dialog ui-block window-popup create-friend-group create-friend-group-1">
					<a href="#" class="close icon-close" data-dismiss="modal" aria-label="Close">
						<svg class="olymp-close-icon"><use xlink:href="icons/icons.svg#olymp-close-icon"></use></svg>
					</a>

					<div class="ui-block-title">
						<h6 class="title">Ajouter un client</h6>
					</div>

					<div class="ui-block-content">
						<form class="form-group label-floating addclient">
							<div class="form-group label-floating ">
								<label class="control-label">Numéro client</label>
								<input class="form-control numclient" placeholder="" value="" type="text">
							</div>
							<div class="form-group label-floating">
								<label class="control-label">Raison sociale</label>
								<input class="form-control raisonsociale" placeholder="" value="" type="text">
							</div>
							<div class="form-group label-floating">
								<label class="control-label">Adresse CMS</label>
								<input class="form-control adressecms" placeholder="" value="" type="text">
							</div>
							<div class="form-group label-floating">
								<select name="" class="changegraph">
									<option value="0">Choisir une catégorie</option>
									<?php foreach ($selection_graph as $key => $value) {?>
									<option value="<?php echo($value['id_user']) ?>"><?php echo utf8_encode($value['nom']); ?> <?php echo utf8_encode($value['prenom']); ?></option>
									<?php }
									?>
								</select>
							</div>
							<div class="form-group label-floating">
								<select name="" class="changequalif">
									<option value="0">Choisir une qualif</option>
									<?php foreach ($selection_qualif as $key => $value) {?>
									<option value="<?php echo($value['id_etat']) ?>"><?php echo utf8_encode(($value['nom_etat'])) ?></option>
									<?php }
									?>
								</select>
							</div>
						</form>
						<a href="#" class="btn btn-blue btn-lg full-width btn-modif" data-dismiss="modal">Modifier le client</a>
					</div>


				</div>
			</div>
			<!-- ... end Window-popup Create Friends Group -->


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
				$('.search').keyup(function(){
					var search = $(this).val();
					if(search.length >= 3){
						$.ajax({
							url: 'formulaire.php',
							type: 'POST',
							data: {admin_search: search},
						})
						.done(function(data) {
							$('.admin_card').html('');
							$(data).appendTo('.admin_card');
						})
					}else{
						$.ajax({
							url: 'formulaire.php',
							type: 'POST',
							data: {admin_search_empty: search},
						})
						.done(function(data) {
							$('.admin_card').html('');
							$(data).appendTo('.admin_card');
						})
					}
				});

				//DELETE
				$( "body" ).on( "click", ".delete", function() {
					var numClient = $('.country').html();
					var idgpp = $('.idgpp').val();
					swal({
						title: 'Êtes-vous sûr ?',
						text: "Cette action n'est pas reversible!",
						type: 'warning',
						showCancelButton: true,
						confirmButtonColor: '#3085d6',
						cancelButtonColor: '#d33',
						confirmButtonText: 'Oui, supprimer la fiche'
					}).then(function () {
						$.ajax({
							url: 'formulaire.php',
							type: 'POST',
							data: {delete: 'value1', admin_numClient: numClient, admin_idgpp: idgpp},
						})
						.done(function(data) {
							$('.admin_' + data).fadeOut(1000, function(){
								$(this).remove();
							})
							swal(
								'Supprimé !',
								'La fiche a été suppimée',
								'success'
								).then(function(){
									location.reload();
								})
							})
					})
				})
				// //CHANGER
				$( "body" ).on( "click", ".modifier", function() {
					var numClient = $(this).parents('.hauteur-card').find('.country').html();
					var raisonSociale = $(this).parents('.hauteur-card').find('a.h5.author-name').html();
					var adresseCms = $(this).parents('.hauteur-card').find('.liencms').attr('href');
					var graph = $(this).parents('.hauteur-card').find('.graph').val();
					var recupId = $(this).parents('.hauteur-card').attr('class');
					var idClient = recupId.split('admin_');
					var check_qualif="qualif_";
					var cls_qualif = $(".hauteur-card").attr('class').split(' ');
					console.log(cls_qualif);
					for (var i = 0; i < cls_qualif.length; i++) {
						if (cls_qualif[i].indexOf(check_qualif) > -1) {
							var id_qualif = cls_qualif[i].slice(check_qualif.length, cls_qualif[i].length);
						}
					}
					var check_id="projet_";
					var cls_id = $(".hauteur-card").attr('class').split(' ');
					for (var i = 0; i < cls_id.length; i++) {
						if (cls_id[i].indexOf(check_id) > -1) {
							var id_client = cls_id[i].slice(check_id.length, cls_id[i].length);
						}
					}

					$('.numclient').val(numClient);
					$('.raisonsociale').val(raisonSociale);
					$('.adressecms').val(adresseCms);
					$('.changegraph').val(graph);
					$('select.changequalif').val(id_qualif);
					console.log(id_qualif);
					console.log(id_client);
					$('.btn-modif').on('click', function(){
						var numClient = $('#change .numclient').val();
						var raisonSociale = $('#change .raisonsociale').val();
						var adresseCms = $('#change .adressecms').val();
						var graph = $('#change .changegraph').val();
						var qualif = $('#change .changequalif').val();
						$.ajax({
							url: 'formulaire.php',
							type: 'POST',
							data: {modifier_num: numClient, modifier_rs: raisonSociale, modifier_cms: adresseCms, modifier_graph: graph, modifier_qualif: qualif, getIdClient: id_client},
						})
						.done(function(data) {
							swal('La brique a été modifiée').then(function(){
								location.reload();
							})
						})		
					})
				});

			</script>
		</body>
		</html>
		<?php }else{
			header('Location: accueil.php');
		}
	}else{
		header('Location: login.php');
	}
	?>