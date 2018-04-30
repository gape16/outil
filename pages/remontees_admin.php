<?php

// Connexion à la base de donnée et insertion de session_start
include('../connexion_session.php');

// truncate string at word
function shapeSpace_truncate_string_at_word($string, $limit, $break = " ", $pad = "...") {  
	
	if (strlen($string) <= $limit) return $string;
	
	if (false !== ($max = strpos($string, $break, $limit))) {

		if ($max < strlen($string) - 1) {
			
			$string = substr($string, 0, $max) . $pad;
			
		}
		
	}
	
	return $string;
	
}

if (isset($_SESSION['id_statut'])) {
	if ($_SESSION['id_statut'] == 4 || $_SESSION['id_statut'] == 5) {
		$id_graph=$_SESSION['id_graph'];

		$requet = $bdd->prepare("UPDATE notifications_remontees SET active = 0 where id_user = ?");
		$requet->bindParam(1, $id_graph);
		$requet->execute();

		$selection_remontees = $bdd->prepare("SELECT * FROM remontees left join user on user.id_user = remontees.id_user left join categorie_remontees on remontees.id_categorie_remontees = categorie_remontees.id_categorie_remontees left join etat_remontees on remontees.accept_remontees = etat_remontees.id_etat_remontees order by date_remontees DESC");
		$selection_remontees->execute();

		$selection_etat_remontees = $bdd->prepare("SELECT * FROM etat_remontees");
		$selection_etat_remontees->execute();
		?>

		<!DOCTYPE html>
		<html lang="fr" id="remontees">
		<head>

			<title>Les remontées</title>

			<!-- Required meta tags always come first -->
			<meta charset="utf-8">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<meta http-equiv="x-ua-compatible" content="ie=edge">

			<!-- Bootstrap CSS -->
			<link rel="stylesheet" type="text/css" href="../css/bootstrap-reboot.css">
			<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
			<link rel="stylesheet" type="text/css" href="../css/bootstrap-grid.css">

			<!-- Theme Styles CSS -->
			<link rel="stylesheet" type="text/css" href="../css/theme-styles.css">
			<link rel="stylesheet" type="text/css" href="../css/blocks.css">
			<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.9.1/sweetalert2.css">

			<link rel="icon" type="image/png" href="../img/favicon.png" />

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
			<style type="text/css">
			.ui-block-title > * {
    margin-bottom: 0;
    display: block !important;
    vertical-align: middle;
    margin: auto;
    text-align:center;
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

			<!-- Main Content Groups -->

			<div class="container">
				<div class="row">
					<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<ul class="cat-list-bg-style align-center sorting-menu">
							<li class="cat-list__item active" data-filter="*"><a href="#" class="">Toutes les catégories</a></li>

							<?php foreach ($selection_etat_remontees as $key => $value) {?>
							<li class="cat-list__item" data-filter="etat_<?php echo($value['id_etat_remontees']) ?>"><a href="#" class=""><?php echo utf8_encode($value['etat_remontees']) ?></a></li>
							<?php }
							?>
						</ul>
						<div class="ui-block" style="margin-bottom: 0">
							<div class="ui-block-title">
								<h6 class="title">Demande d'évolution / remontées</h6>
								<div class="form-group label-floating is-empty">
									<label class="control-label">Recherche</label>
									<input class="form-control search" placeholder="" value="" type="text">
								</div>
							</div>
							<div class="ui-block-content">
								<table class="event-item-table">
									<tbody>
										<?php foreach ($selection_remontees as $key => $value) {
											$date_tab=explode("-", $value['date_remontees']);
											$jour_tab=explode(" ",$date_tab[2]);
											$jour=$jour_tab[0];

											$m=$date_tab[1];
											$months = array (1=>'Jan',2=>'Fev',3=>'Mar',4=>'Avr',5=>'Mai',6=>'Juin',7=>'Juil',8=>'Aout',9=>'Sept',10=>'Oct',11=>'Nov',12=>'Dec');
											?>
											<tr class="event-item sorting-item categorie_<?php echo($value['id_categorie_remontees']) ?> etat_<?php echo($value['accept_remontees']) ?> remontee">
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
															<a class="author-name h6 auteur"><?php echo utf8_encode($value['nom']);?> <?php echo utf8_encode($value['prenom']);?></a>
														</div>
													</div>
												</td>
												<td class="categorie">
													<p class="categorie"><?php echo utf8_encode($value['categorie_remontees']);?></p>
												</td>
												<td class="users">
													<p class="titre"><?php echo utf8_encode($value['titre']);?></p>
												</td>
												<td class="users description">
													<p class="description"><?php echo shapeSpace_truncate_string_at_word(utf8_encode($value['description']),50);?></p>
												</td>
												<td class="add-event">
													<a data-toggle="modal" data-target="#modal_remontees" class="btn btn-breez btn-sm open_modal" style="background:<?php echo $value['couleur'];?>;color:white;"><?php echo utf8_encode($value['etat_remontees']);?></a>
												</td>
												<input type="hidden" class="letitre" value="<?php echo htmlentities(utf8_encode($value['titre']));?>">
												<input type="hidden" class="description" value="<?php echo htmlentities(utf8_encode($value['description']));?>">
												<input type="hidden" class="commentaires" value="<?php echo utf8_encode($value['commentaires']);?>">
												<input type="hidden" class="id_remontees" value="<?php echo utf8_encode($value['id_remontees']);?>">
												<input type="hidden" class="kats" value="<?php echo utf8_encode($value['kats']);?>">
												<input type="hidden" class="file" value="<?php echo utf8_encode($value['file']);?>">
												<input type="hidden" class="date" value="<?php echo utf8_encode($value['date_remontees']);?>">
												<input type="hidden" class="auteur" value="<?php echo utf8_encode($value['id_user']);?>">
												<input type="hidden" class="id_rep" value="<?php echo utf8_encode($value['id_rep']);?>">
											</tr>
											<?php } ?>
										</tbody>
									</table>
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
							<h6 class="title">Modération du ticket</h6><br>
							<span class="title_sous" style="display: inherit;">Modération du ticket</span>
						</div>

						<div class="row padding">
							<div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-xs-12">
								<div class="form-group label-floating is-empty">
									<h6 class="title title-left">Description</h6>
									<p class="description"></p>
									<p class="auteur"></p>
								</div>
							</div>
							<div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-xs-12 border-left">
								<div class="form-group label-floating is-empty">
									<h6 class="title">Informations</h6>
									<div class="date-event">
										<svg class="olymp-small-calendar-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="../icons/icons.svg#olymp-small-calendar-icon"></use></svg>
										<span class="day"></span>
										<span class="month"></span>
									</div>
									<a class="fancy-img img-link" href="" data-fancybox>
										Pièce jointe
									</a>
									<a class="kats-link" href="" target="_blank">
										Lien du KATS
									</a>
								</div>
							</div>
						</div>
						<div class="ui-block-content">
							<p class="get_author">Traité par : </p>
							<div class="form-group label-floating is-empty">
								<label class="control-label">Lien du KATS</label>
								<input class="form-control kats" placeholder="" value="" type="text">
							</div>
							<div class="form-group label-floating">
								<label class="control-label">Commentaire (obligatoire si ticket refusé)</label>
								<textarea class="form-control commentaires" ></textarea>
							</div>
							<div class="row">
								<div class="col-xl-4 col-lg-12 col-md-12 col-sm-12 col-xs-12">
									<a href="#" class="btn btn-secondary full-width refuser_remontees">Refuser</a>
								</div>
								<div class="col-xl-4 col-lg-12 col-md-12 col-sm-12 col-xs-12">
									<a href="#" class="btn  btn-secondary full-width traitement_remontees btn-hax">En traitement</a>
								</div>
								<div class="col-xl-4 col-lg-12 col-md-12 col-sm-12 col-xs-12">
									<a href="#" class="btn btn-green full-width accepter_remontees">Valider</a>
								</div>
							</div>
							<input type="hidden" class="hax_id_remontees">
						</div>
					</div>
				</div>
				<!-- ... end Main Content Groups -->

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

				<!-- Swiper / Sliders -->
				<script src="../js/swiper.jquery.min.js"></script>

				<script src="../js/isotope.pkgd.min.js"></script>

				<script src="../js/mediaelement-and-player.min.js"></script>
				<script src="../js/mediaelement-playlist-plugin.min.js"></script>

				<script src="../js/mediaelement-and-player.min.js"></script>
				<script src="../js/mediaelement-playlist-plugin.min.js"></script>
				<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.9.1/sweetalert2.min.js"></script>

				<script src="../js/jquery.fancybox.min.js"></script>

				<script src="../js/pages/remontees_admin.js"></script>
				<script src="../js/charte.js"></script>
				<?php 
				if($_SESSION['id_statut']==1) {
						//page graphistes 
					?><script src="../js/notifications.js"></script><?php
				}elseif  ($_SESSION['id_statut']==2){
						//page  redacteurs
					?><script src="../js/notifications.js"></script><?php
				}
				elseif ($_SESSION['id_statut']==3) {
						//page leader
					?><script src="../js/notifications.js"></script><?php
				}elseif ($_SESSION['id_statut']==4) {
						//page controleur
					?><script src="../js/notifications_controleur.js"></script><?php
				}elseif($_SESSION['id_statut']==5){
						//page admin
					?><script src="../js/notifications_admin.js"></script><?php
				}
				?> 
			</body>
			</html>
			<?php }else{
				header('Location: remontees.php');
			}
		}else{
			header('Location: ../login.php');
		}
		?>