<?php

// Connexion à la base de donnée et insertion de session_start
include('connexion_session.php');


if (isset($_SESSION['id_statut'])) {
	$id_graph=$_SESSION['id_graph'];
	// si c'est un graph qui se connect
	if ($_SESSION['id_statut'] == 1 || $_SESSION['id_statut'] == 2) {
		$query_select_card_crea_maquette = $bdd->prepare("SELECT num_client, raison_social, lien_CMS, photo, IDGPP FROM client inner join user on client.id_graph_maquette=user.id_user where client.id_graph_maquette=? and (id_etat = 1 or id_etat= 3 or id_etat = 4 or id_etat = 6)");
		$query_select_card_crea_maquette->bindParam(1, $id_graph);
		$query_select_card_crea_maquette->execute();
		$cards_client=$query_select_card_crea_maquette->fetchAll();
	}else{
		$query_select_card_crea_maquette = $bdd->prepare("SELECT num_client, raison_social, lien_CMS, photo, IDGPP FROM client inner join user on client.id_graph_maquette=user.id_user where id_etat = 2 or id_etat= 5");
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
					<div class="friend-item friend-groups create-group" data-mh="friend-groups-item">
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

				<div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-6">
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
										<a href="#" class="h5 author-name"><?php echo utf8_encode($value['raison_social']);?></a>
										<div class="country"><?php echo $value['num_client'];?></div>
									</div>
								</div>
								<ul class="friends-harmonic">
									<li>
										<a href="#">
											<img src="<?php echo utf8_encode($value['photo']);?>" alt="friend">
										</a>
									</li>
								</ul>
								<div class="control-block-button">
									<a href="<?php echo utf8_encode($value['lien_CMS']);?>" target="_blank" class="  btn btn-control bg-blue" data-toggle="modal" data-target="#create-friend-group-add-friends">
										<svg class="olymp-happy-faces-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="icons/icons.svg#olymp-happy-faces-icon"></use></svg>
									</a>
									<a href="check.php?idgpp=<?php echo $value['IDGPP'];?>" class="btn btn-control btn-grey-lighter">
										<svg class="olymp-settings-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="icons/icons.svg#olymp-settings-icon"></use></svg>
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
		<script src="js/chat.js"></script>
		<!-- Select / Sorting script -->
		<script src="js/selectize.min.js"></script>

		<link rel="stylesheet" type="text/css" href="css/bootstrap-select.css">


		<script src="js/mediaelement-and-player.min.js"></script>
		<script src="js/mediaelement-playlist-plugin.min.js"></script>

		<script src="js/charte.js"></script>

	</body>
	</html>
	<?php }else{
		header('Location: login.php');
	}
	?>