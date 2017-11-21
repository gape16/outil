<?php

// Connexion à la base de donnée et insertion de session_start
include('connexion_session.php');


if (isset($_SESSION['id_statut'])) {

	$id_graph=$_SESSION['id_graph'];
		// si c'est un graph qui se connect


	$selection_categorie_remontees = $bdd->prepare("SELECT * FROM categorie_remontees");
	$selection_categorie_remontees->execute();

	$query_select_remontees = $bdd->prepare("SELECT * FROM remontees left join user on user.id_user = remontees.id_user left join categorie_remontees on remontees.id_categorie_remontees = categorie_remontees.id_categorie_remontees left join etat_remontees on remontees.accept_remontees = etat_remontees.id_etat_remontees order by date_remontees DESC");
	$query_select_remontees->execute();

	?>

	<!DOCTYPE html>
	<html lang="fr">
	<head>

		<title>Les remontées</title>
		<meta http-equiv="refresh" content="120">

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
		<style>


		.modal .titre {
			font-size: 1.5rem;
			text-align: center;
			display: block;
			color: #2C2C2C;
			font-weight: normal;
			text-transform: uppercase;
		}
		.modal h6.title {
			text-align: center;
			position: relative;
			left: 70px;
		}
		span.categorie {
			display: block;
			text-align: center;
		}
		span.description {
			display: block;
			margin-bottom: 20px;
		}
		span.author {
			text-align: right;
			display: block;
			font-size: 0.7rem;
		}
		span.categorie {
			font-style: italic;
		}
		#modal_remontees .no-pr {
			position: initial;
			left: initial;
		}
		.etat_1 .open_modal, .etat_3 .open_modal {
			cursor: initial;
		}
		.open_modal {
			cursor: pointer;
		}
		.hax-modal {
			width: 960px;
			max-width: 960px;
			margin: 200px auto;
		}
		.ui-block-title {
			padding: 28px 25px 23px;
		}

	</style>
</head>

<body>

	<?php 
	if($_SESSION['id_statut']==1) {
		//page graphistes 
		include('left_sidebar.php');
		include('header.php');
	}elseif  ($_SESSION['id_statut']==2){
		//page  redacteurs
		include('left_sidebar_redac.php');
		include('header_redac.php');
	}
	elseif ($_SESSION['id_statut']==3) {
		//page leader
		include('left_sidebar_leader.php');
		include('header_leader.php');
	}elseif ($_SESSION['id_statut']==4) {
		//page controleur
		include('left_sidebar_controleur.php');
		include('header_controleur.php');
	}elseif($_SESSION['id_statut']==5){
		//page admin
		include('left_sidebar_admin.php');
		include('header_admin.php');
	}
	?>


	<!-- Responsive Header -->

	<?php include('responsive_header.php');?>

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
						<h1>N'hésitez plus, demandez de l'aide</h1>
						<p>C'est ici que vous allez pouvoir faire les demandes d'aide sur vos problèmes d'intégration</p>
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

	<div class="container">
		<div class="row">
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="ui-block">
					<div class="ui-block-title ui-block-title-small">
						<h6 class="title">Historique des remontées</h6>
						<div class="form-group label-floating is-empty">
							<label class="control-label">Recherche</label>
							<input class="form-control search" placeholder="" value="" type="text">
						</div>
					</div>
					<table class="event-item-table">
						<tbody>
							<?php foreach ($query_select_remontees as $key => $value){
								$date_tab=explode("-", $value['date_remontees']);
								$jour_tab=explode(" ",$date_tab[2]);
								$jour=$jour_tab[0];

								$m=$date_tab[1];
								$months = array (1=>'Jan',2=>'Fev',3=>'Mar',4=>'Avr',5=>'Mai',6=>'Juin',7=>'Juil',8=>'Aout',9=>'Sept',10=>'Oct',11=>'Nov',12=>'Dec');

								?>
								<tr class="event-item sorting-item categorie_<?php echo($value['id_categorie_remontees']) ?> etat_<?php echo($value['accept_remontees']) ?>">
									<td class="upcoming">
										<div class="date-event">
											<svg class="olymp-small-calendar-icon"><use xlink:href="icons/icons.svg#olymp-small-calendar-icon"></use></svg>
											<span class="day"><?php echo $jour;?></span>
											<span class="month"><?php echo $months[(int)$m]; ?></span>
										</div>
									</td>
									<td class="author">
										<div class="event-author inline-items">
											<div class="author-date">
												<a class="author-name h6 auteur"><?php echo $value['nom'];?> <?php echo $value['prenom'];?></a>
											</div>
										</div>
									</td>
									<td class="categorie">
										<p class="categorie"><?php echo utf8_encode($value['categorie_remontees']);?></p>
									</td>
									<td class="users">
										<p class="titre"><?php echo utf8_encode($value['titre']);?></p>
									</td>
									<td class="add-event">
										<a <?php if ($value['accept_remontees'] != 3 && $value['accept_remontees'] != 1) {?> data-toggle="modal" data-target="#modal_remontees" <?php }?> class="btn btn-breez btn-sm open_modal" style="background:<?php echo $value['couleur'];?>;color:white;"><?php echo utf8_encode($value['etat_remontees']);?></a>
									</td>
									<input type="hidden" class="description" value="<?php echo utf8_encode($value['description']);?>">
									<input type="hidden" class="commentaires" value="<?php echo utf8_encode($value['commentaires']);?>">
									<input type="hidden" class="id_remontees" value="<?php echo utf8_encode($value['id_remontees']);?>">
									<input type="hidden" class="kats" value="<?php echo utf8_encode($value['kats']);?>">
								</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>

		<div class="modal fade show" id="modal_remontees">
			<div class="modal-dialog ui-block window-popup create-event hax-modal">
				<a href="#" class="close icon-close" data-dismiss="modal" aria-label="Close">
					<svg class="olymp-close-icon"><use xlink:href="icons/icons.svg#olymp-close-icon"></use></svg>
				</a>

				<div class="ui-block-title">
					<h6 class="title">Détails du ticket</h6>
					<div class="date-event">
						<svg class="olymp-small-calendar-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="icons/icons.svg#olymp-small-calendar-icon"></use></svg>
						<span class="day"></span>
						<span class="month"></span>
					</div>
				</div>

				<div class="ui-block-content">
					<div class="row">
						<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="content_wrapper"><span class="titre"></span><span class="categorie"></span><br/>
								<span class="description"></span>
								<span class="author"></span>
							</div>
						</div>
					</div>
				</div>
				<div class="ui-block-title">
					<h6 class="title no-pr">Réponse du ticket</h6>
				</div>
				<div class="ui-block-content">
					<div class="row">
						<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<span class="commentaires"></span>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- jQuery first, then Other JS. -->
		<script src="js/jquery-3.2.0.min.js"></script>
		<!-- Js effects for material design. + Tooltips -->
		<script src="js/material.min.js"></script>
		<!-- Helper scripts (Tabs, Equal height, Scrollbar, etc) -->
		<script src="js/theme-plugins.js"></script>
		<!-- Init functions -->
		<script src="js/main.js"></script>
		<script src="js/alterclass.js"></script>
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
			$(function(){

				$('.open_modal').click(function(){
					var titre = $(this).parent().parent().find('.titre').html();
					var description = $(this).parent().parent().find('.description').val();
					var commentaires = $(this).parent().parent().find('.commentaires').val();
					var categorie = $(this).parent().parent().find('p.categorie').html();
					var auteur = $(this).parent().parent().find('.auteur').html();
					var day = $(this).parent().parent().find('.day').html();
					var month = $(this).parent().parent().find('.month').html();
					$('#modal_remontees .author').html('');
					$('#modal_remontees .titre').html('');
					$('#modal_remontees .description').html('');
					$('#modal_remontees .categorie').html('');
					$('#modal_remontees .day').html('');
					$('#modal_remontees .month').html('');
					$('#modal_remontees .author').append(auteur);
					$('#modal_remontees .titre').append(titre);
					$('#modal_remontees .description').append(description);
					$('#modal_remontees .categorie').append(categorie);
					$('#modal_remontees .day').append(day);
					$('#modal_remontees .month').append(month);
					$('#modal_remontees .commentaires').append(commentaires);
				})


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
								.done(function(data) {
									swal(
										'Remontée effectuée',
										'Votre remontée sera étudiée sous peu',
										'success'
										).then(function(){
											location.reload();
										})			
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


				$('.search').keyup(function(){
					var search = $(this).val();
					if(search.length >= 3){
						$.ajax({
							url: 'formulaire.php',
							type: 'POST',
							data: {remontees_search: search},
						})
						.done(function(data) {
							$('table.event-item-table tbody').html('');
							$(data).appendTo('table.event-item-table tbody');
						})
					}else{
						$.ajax({
							url: 'formulaire.php',
							type: 'POST',
							data: {remontees_search_empty: search},
						})
						.done(function(data) {
							$('table.event-item-table tbody').html('');
							$(data).appendTo('table.event-item-table tbody');
						})
					}
				});

			})
		</script>
	</body>
	</html>
	<?php

}else{
	header('Location: login.php');
}
?>