<?php

// Connexion à la base de donnée et insertion de session_start
include('connexion_session.php');


if (isset($_SESSION['id_statut'])) {
	$id_graph=$_SESSION['id_graph'];
	// si c'est un graph qui se connect
	if ($_SESSION['id_statut'] == 1 || $_SESSION['id_statut'] == 2) {
		$query_select_card_crea_maquette = $bdd->prepare("SELECT num_client, raison_social, lien_CMS, photo, IDGPP, id_etat FROM client inner join user on client.id_graph_maquette=user.id_user where client.id_graph_maquette=? and (id_etat = 1 or id_etat= 3 or id_etat = 4 or id_etat = 6)");
		$query_select_card_crea_maquette->bindParam(1, $id_graph);
		$query_select_card_crea_maquette->execute();
		$cards_client=$query_select_card_crea_maquette->fetchAll();
	}else{
		$query_select_card_crea_maquette = $bdd->prepare("SELECT num_client, raison_social, lien_CMS, photo, IDGPP, id_etat FROM client inner join user on client.id_graph_maquette=user.id_user where id_etat = 2 or id_etat= 5");
		$query_select_card_crea_maquette->bindParam(1, $id_graph);
		$query_select_card_crea_maquette->execute();
		$cards_client=$query_select_card_crea_maquette->fetchAll();
	}
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

		<?php include('header.php');?>

		<!-- ... end Header -->


		<!-- Responsive Header -->

		<?php include('responsive_header.php');?>

		<!-- ... end Responsive Header -->

		<!-- ... end Responsive Header -->


		<div class="header-spacer header-spacer-small"></div>


		<div class="main-header">
			<div class="content-bg-wrap">
				<div class="content-bg bg-group"></div>
			</div>
			<div class="container">
				<div class="row">
					<div class="col-lg-8 offset-lg-2 col-md-8 offset-md-2 col-sm-12 col-xs-12">
						<div class="main-header-content">
							<h1>Suivez vos clients</h1>
							<p>Cette page vous permettra de checker les sites de vos clients à l'aide d'une checklist. Vous y retrouverez l'ensemble des tutoriels si vous bloquez sur un point. L'utilisation est simple il vous suffit d'ajouter un client et c'est parti !
							</p>
						</div>
					</div>
				</div>
			</div>

			<img class="img-bottom" src="img/group-bottom.png" alt="friends">
		</div>

		<!-- Main Content Groups -->


		<div class="container cards">
			<div class="row">
				<div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-6">
					<div class="friend-item friend-groups create-group hauteur-card ajout-client" data-mh="friend-groups-item">
						<a href="#" class="full-block" data-toggle="modal" data-target="#create-friend-group-1"></a>
						<div class="content">
							<a href="#" class="  btn btn-control bg-blue" data-toggle="modal" data-target="#create-friend-group-1">
								<svg class="olymp-plus-icon"><use xlink:href="icons/icons.svg#olymp-plus-icon"></use></svg>
							</a>
							<div class="author-content">
								<a href="#" class="h5 author-name">Ajouter un client</a>
								<div class="country">-</div>
							</div>
						</div>
					</div>
				</div>


				<?php foreach ($cards_client as $key => $value) {?>
				<?php
				if($value['id_etat']==1){
					$class_etat="crea-maquette";
					$class_img="img/Crea-maquette.png";
				}elseif ($value['id_etat']==2) {
					$class_etat="ctrl-maquette";
					$class_img="img/Ctrl-maquette.png";
				}elseif ($value['id_etat']==3) {
					$class_etat="retour-crea";
					$class_img="img/Retour-crea.png";
				}elseif ($value['id_etat']==4) {
					$class_etat="crea-graphique";
					$class_img="img/Crea-graphique.png";
				}elseif ($value['id_etat']==5) {
					$class_etat="ctrl-design";
					$class_img="img/Ctrl-design.png";
				}elseif ($value['id_etat']==6) {
					$class_etat="retour-crea";
					$class_img="img/Retour-graphique.png";
				}elseif ($value['id_etat']==7) {
					$class_etat="site-valide";
					$class_img="img/Site-valide.png";
				}
				?>
				<div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-6">
					<div class="ui-block hauteur-card" data-mh="friend-groups-item">
						<div class="friend-item friend-groups <?php echo $class_etat;?>">
							<div class="friend-item-content">
								<div class="friend-avatar entete-card">
									<div class="author-thumb etat-card">
										<img src="<?php echo $class_img;?>" alt="Olympus">
									</div>
									<div class="author-content texte-card">
										<a href="#" class="h5 author-name"><?php echo utf8_encode($value['raison_social']);?></a>
										<div class="country"><?php echo $value['num_client'];?></div>
									</div>
								</div>
								<div class="control-block-button bouton-check">
									<a href="<?php echo utf8_encode($value['lien_CMS']);?>" target="_blank" class="  btn btn-control bg-blue bouton-icone1" data-toggle="modal" data-target="#create-friend-group-add-friends">
										<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="35%" version="1.1" height="35%" viewBox="0 0 64 64" enable-background="new 0 0 64 64">
											<path d="m60.135,3.875c-5.156-5.166-13.545-5.168-18.697,0l-11.576,11.619c-0.788,0.791-0.788,2.074 0,2.865 0.79,0.792 2.067,0.792 2.856,0l11.576-11.618c3.578-3.589 9.401-3.587 12.984,0 3.578,3.591 3.578,9.435 0,13.024l-15.292,15.339c-1.732,1.739-4.038,2.697-6.49,2.697-2.451,0-4.758-0.959-6.492-2.697-0.789-0.792-2.067-0.792-2.857,0-0.788,0.791-0.788,2.074 0,2.865 2.499,2.505 5.818,3.885 9.35,3.885s6.848-1.381 9.347-3.885l15.292-15.338c5.152-5.17 5.152-13.584-0.001-18.756z" fill="#FFFFFF"/>
											<path d="m31.015,45.904l-11.312,11.346c-1.732,1.739-4.039,2.697-6.491,2.697-2.451,0-4.759-0.958-6.489-2.697-3.578-3.591-3.578-9.434 0-13.023l15.289-15.338c3.582-3.588 9.406-3.588 12.983,0 0.789,0.793 2.067,0.793 2.856,0 0.789-0.791 0.789-2.072 0-2.864-5.152-5.17-13.541-5.17-18.697,0l-15.288,15.336c-5.155,5.17-5.155,13.584 4.44089e-16,18.754 2.497,2.506 5.816,3.885 9.346,3.885 3.531,0 6.853-1.379 9.348-3.885l11.31-11.345c0.79-0.791 0.79-2.074 0-2.865-0.788-0.792-2.067-0.792-2.855-0.001z" fill="#FFFFFF"/>
										</svg>
									</a>
									<a href="check.php?idgpp=<?php echo $value['IDGPP'];?>" class="btn btn-control btn-grey-lighter bouton-icone2">
										<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" width="35%" height="35%" viewBox="0 0 394.893 394.893" style="enable-background:new 0 0 394.893 394.893;" xml:space="preserve">
											<path d="M344.426,191.963c-6.904,0-12.5,5.597-12.5,12.5V350.91H25V43.982h246.57c6.904,0,12.5-5.597,12.5-12.5    c0-6.903-5.596-12.5-12.5-12.5H12.5c-6.903,0-12.5,5.597-12.5,12.5V363.41c0,6.903,5.597,12.5,12.5,12.5h331.926    c6.902,0,12.5-5.597,12.5-12.5V204.463C356.926,197.56,351.33,191.963,344.426,191.963z" fill="#FFFFFF"/>
											<path d="M391.23,27.204c-4.881-4.881-12.795-4.881-17.678,0L169.957,230.801l-50.584-50.584c-4.882-4.881-12.796-4.881-17.678,0    c-4.881,4.882-4.881,12.796,0,17.678l59.423,59.423c2.441,2.44,5.64,3.661,8.839,3.661c3.199,0,6.398-1.221,8.839-3.661    L391.23,44.882C396.113,40,396.113,32.086,391.23,27.204z" fill="#FFFFFF"/>
										</svg>
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php }?>
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
		<!-- <script src="js/chat.js"></script> -->
		<!-- Select / Sorting script -->
		<script src="js/selectize.min.js"></script>

		<link rel="stylesheet" type="text/css" href="css/bootstrap-select.css">


		<script src="js/mediaelement-and-player.min.js"></script>
		<script src="js/mediaelement-playlist-plugin.min.js"></script>

		<script src="js/charte.js"></script>
		<script src="js/notifications.js"></script>

	</body>
	</html>
	<?php }else{
		header('Location: login.php');
	}
	?>