<?php

// Connexion à la base de donnée et insertion de session_start
include('connexion_session.php');


if (isset($_SESSION['id_statut'])) {

	$id_graph=$_SESSION['id_graph'];
		// si c'est un graph qui se connect


	$selection_categorie_remontees = $bdd->prepare("SELECT * FROM categorie_remontees");
	$selection_categorie_remontees->execute();

	?>

	<!DOCTYPE html>
	<html lang="fr">
	<head>

		<title>Les remontées</title>

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

		<?php include('header.php');?>

		<!-- ... end Header -->


		<!-- Responsive Header -->

		<?php include('responsive_header.php');?>

		<!-- ... end Responsive Header -->

		<!-- ... end Responsive Header -->


		<div class="header-spacer header-spacer-small"></div>

		<!-- Main Content Groups -->

		<div class="container mt">
			<div class="row">
				<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="ui-block">
						<div class="ui-block-title">
							<h6 class="title">Remontées</h6>
						</div>
						<div class="ui-block-content">
							<form class="form-group label-floating is-empty help">
								<div class="form-group is-empty label-floating">
									<select name="" id="" class="categorie">
										<option value="0">Choisir une catégorie</option>
										<?php foreach ($selection_categorie_remontees as $key => $value) {?>
										<option value="<?php echo($value['id_categorie_remontees']) ?>"><?php echo utf8_encode(($value['categorie_remontees'])) ?></option>
										<?php }
										?>
									</select>
								</div>
								<div class="form-group is-empty label-floating">
									<label class="control-label">Titre</label>
									<input class="form-control titre" placeholder="" value="" type="text">
									<span class="material-input"></span>
								</div>
							</form>
							<div class="form-group label-floating is-empty">
								<label class="control-label">Description</label>
								<textarea name="description" id="description" cols="30" rows="10"></textarea>
							</div>

							<div class="row">
								<div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-xs-12">
									<a href="#" class="btn btn-secondary btn-lg full-width reni" data-toggle="modal" data-target="#faqs-popup">Renitialiser</a>
								</div>
								<div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-xs-12">
									<a href="#" class="btn btn-green btn-lg full-width btn-icon-left valider_remontee"><i class="fa fa-paper-plane-o" aria-hidden="true"></i>
									Remonter le problème</a>
								</div>
							</div>
						</div>
					</div>

				</div>

			</div>
		</div>
		<!-- ... end Main Content Groups -->

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
		<script src="js/notifications.js"></script>
		<script>
			$(function(){
				$('.valider_remontee').on('click', function(){
					var categorie = $('select.categorie').val();
					var titre = $('.titre').val();
					var description = $('#description').val();
					if (categorie != 0) {
						$('.categorie').removeClass('empty');
						if (titre.length >= 5) {
							$('.titre').removeClass('empty');
							if (description.length >= 30) {
								$('#description').removeClass('empty');
								$.ajax({
									url: 'formulaire.php',
									type: 'POST',
									data: {categorie_remontees: categorie, titre_remontees: titre, description_remontees: description},
								})
								.done(function() {
									swal(
										'Remontée effectuée',
										'Votre remontée sera étudiée sous peu',
										'success'
										)
									setTimeout(function(){
										location.reload();
									},1000);
								})
							}else{
								$('#description').addClass('empty');
								$('#description').prev().html('30 caractères minimum requis');
							}
						}else{
							$('.titre').addClass('empty');
							$('.titre').prev().html('5 caractères minimum requis');
						}
					}else{
						$('.categorie').addClass('empty');
						$('.categorie').prev().html('Une catégorie est requise');
					}
				})

				$('.reni').on('click', function(){
					$('select.categorie').val(0);
					$('.titre').val('');
					$('#description').val('');
				})
			})
		</script>
	</body>
	</html>
	<?php
	
}else{
	header('Location: login.php');
}
?>