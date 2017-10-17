<?php

// Connexion à la base de donnée et insertion de session_start
include('connexion_session.php');


if (isset($_SESSION['id_statut'])) {
	if ($_SESSION['id_statut'] == 5) {

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

			<!-- Main Content Groups -->


			<div class="container cards">
				<div class="row">
					<!-- CARTE -->
						<!-- 					<div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-6">
						<div class="ui-block" data-mh="friend-groups-item">
							<div class="friend-item friend-groups">
								<div class="friend-item-content">
									<div class="more">
										<svg class="olymp-three-dots-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="icons/icons.svg#olymp-three-dots-icon"></use></svg>
										<ul class="more-dropdown">
											<li>
												<a href="#">Modifier la carte</a>
											</li>
											<li>
												<a href="#">Supprimer la carte</a>
											</li>
										</ul>
									</div>
									<div class="friend-avatar">
										<div class="author-thumb">
											<img src="img/crea_maquette.png" alt="Olympus">
										</div>
										<div class="author-content">
											<a href="#" class="h5 author-name">RS</a>
											<div class="country">NC</div>
										</div>
									</div>
									<ul class="friends-harmonic">
										<li>
											<a href="#">
												<img src="image" alt="friend">
											</a>
										</li>
									</ul>
									<div class="control-block-button">
										<a href="liencms" target="_blank" class="  btn btn-control bg-blue" data-toggle="modal" data-target="#create-friend-group-add-friends">
											<svg class="olymp-happy-faces-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="icons/icons.svg#olymp-happy-faces-icon"></use></svg>
										</a>
										<a href="check.php?idgpp=idgpp" class="btn btn-control btn-grey-lighter">
											<svg class="olymp-settings-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="icons/icons.svg#olymp-settings-icon"></use></svg>
										</a>
									</div>
								</div>
							</div>
						</div>
					</div> -->
					<div class="container">
						<div class="row">
							<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<div class="ui-block">
									<div class="ui-block-title">
										<h6 class="title">Historique des projets</h6> 
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
							console.log(data);
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
							console.log(data);
							$('.admin_card').html('');
							$(data).appendTo('.admin_card');
						})
					}
				});
			</script>
		</body>
		</html>
		<?php }else{
			header('Location: login.php');
		}
	}else{
		header('Location: login.php');
	}
	?>