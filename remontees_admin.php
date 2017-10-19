<?php

// Connexion à la base de donnée et insertion de session_start
include('connexion_session.php');


if (isset($_SESSION['id_statut'])) {
	if ($_SESSION['id_statut'] == 5) {

		$id_graph=$_SESSION['id_graph'];
		// si c'est un graph qui se connect


		$selection_remontees = $bdd->prepare("SELECT * FROM remontees inner join user on remontees.id_user = user.id_user inner join categorie_remontees on remontees.id_categorie_remontees = categorie_remontees.id_categorie_remontees");
		$selection_remontees->execute();

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
							<div class="ui-block-title">
								<h6 class="title">Demande d'évolution / remontées</h6>
							</div>
							<div class="ui-block-content">
								<table class="event-item-table">
									<tbody>
										<?php foreach ($selection_remontees as $key => $value) {?>
										<tr class="event-item">
											<td class="upcoming">
												<div class="date-event">
													<svg class="olymp-small-calendar-icon"><use xlink:href="icons/icons.svg#olymp-small-calendar-icon"></use></svg>
													<span class="day"><?php echo $value['date_remontees'];?></span>
												</div>
											</td>
											<td class="author">
												<div class="event-author inline-items">
													<div class="author-thumb">
														<img src="img/avatar43-sm.jpg" alt="author">
													</div>
													<div class="author-date">
														<a class="author-name h6"><?php echo $value['nom'];?> <?php echo $value['prenom'];?></a>
													</div>
												</div>
											</td>
											<td class="users">
												<p class="description"><span>Catégorie: <?php echo utf8_encode($value['categorie_remontees']);?></span></p>
											</td>
											<td class="users">
												<p class="description"><?php echo utf8_encode($value['description']);?></p>
											</td>
											<td class="add-event">
												<a data-toggle="modal" data-target="#modal_remontees" class="btn btn-breez btn-sm open_modal">Voir</a>
											</td>
											<input type="hidden" class="id_remontees" value="<?php echo utf8_encode($value['id_remontees']);?>">
										</tr>
										<?php } ?>
									</div>
								</div>
							</div>
						</div>
					</div>


					<!-- ... end Window-popup Create Friends Group Add Friends -->
					<div class="modal fade show" id="modal_remontees">
						<div class="modal-dialog ui-block window-popup create-event">
							<a href="#" class="close icon-close" data-dismiss="modal" aria-label="Close">
								<svg class="olymp-close-icon"><use xlink:href="icons/icons.svg#olymp-close-icon"></use></svg>
							</a>

							<div class="ui-block-title">
								<h6 class="title">Modération du ticket</h6>
							</div>

							<div class="ui-block-content">
								<div class="form-group label-floating">
									<label class="control-label">Commentaire (obligatoire si ticket refusé)</label>
									<textarea class="form-control commentaires" ></textarea>
								</div>
								<div class="row">
									<div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-xs-12">
										<a href="#" class="btn btn-secondary btn-lg full-width refuser_remontees">Refuser</a>
									</div>
									<div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-xs-12">
										<a href="#" class="btn btn-green btn-lg full-width accepter_remontees">Valider</a>
									</div>
								</div>
								<input type="hidden" class="hax_id_remontees">
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
							$('.open_modal').on('click', function(){
								var id_remontees = $(this).parent().parent().find('.id_remontees').val();
								console.log(id_remontees);
								$('.hax_id_remontees').val(id_remontees);
							})

							$('.accepter_remontees').on('click', function(){
								var commentaire = $('.commentaires').val();
								var id_remontees = $('.hax_id_remontees').val();
								$.ajax({
									url: 'formulaire.php',
									type: 'POST',
									data: {commentaire_remontees: commentaire, id_remontees: id_remontees},
								})
								.done(function() {
									console.log("success");
								})
							})

							$('.refuser_remontees').on('click', function(){
								var commentaire = $('.commentaires').val();
								var id_remontees = $('.hax_id_remontees').val();
								$.ajax({
									url: 'formulaire.php',
									type: 'POST',
									data: {commentaire_remontees: commentaire, id_remontees: id_remontees},
								})
								.done(function() {
									console.log("success");
								})
							})

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