<?php

// Connexion à la base de donnée et insertion de session_start
include('connexion_session.php');


// truncate string at word
function shapeSpace_truncate_string_at_word($string, $limit, $break = ".", $pad = "...") {  
	
	if (strlen($string) <= $limit) return $string;
	
	if (false !== ($max = strpos($string, $break, $limit))) {

		if ($max < strlen($string) - 1) {
			
			$string = substr($string, 0, $max) . $pad;
			
		}
		
	}
	
	return $string;
	
}

if (isset($_SESSION['id_statut'])) {

	$selection_categorie = $bdd->prepare("SELECT * FROM categorie_veille");
	$selection_categorie->execute();

	$selection_categorie2 = $bdd->prepare("SELECT * FROM categorie_veille");
	$selection_categorie2->execute();

	$selection_article_veille = $bdd->prepare("SELECT * FROM veille");
	$selection_article_veille->execute();

	$id_graph=$_SESSION['id_graph'];

	$query_notif_code=$bdd->prepare("SELECT * FROM veille order by id_veille DESC limit 1");
	$query_notif_code->execute();
	$result_notif_code=$query_notif_code->fetch();
	$dernier=$result_notif_code['id_veille'];
	$query_inser_code=$bdd->prepare("UPDATE notifications set notif_B = ? where id_user = ?");
	$query_inser_code->bindParam(1, $dernier);
	$query_inser_code->bindParam(2, $id_graph);
	$query_inser_code->execute();

	?>

	<!DOCTYPE html>
	<html lang="en">
	<head>

		<title>Friend Groups</title>

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
		<link rel="stylesheet" type="text/css" href="css/bootstrap-select.css">


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
				<div class="content-bg bg-account"></div>
			</div>
			<div class="container">
				<div class="row">
					<div class="col-lg-8 offset-lg-2 col-md-8 offset-md-2 col-sm-12 col-xs-12">
						<div class="main-header-content">
							<h1>Veille</h1>
							<p>Ici faites votre veille
							</p>
						</div>
					</div>
				</div>
			</div>

			<img class="img-bottom" src="img/blog_bottom.png" alt="friends">
		</div>

		<!-- Main Content Groups -->
		<?php 
		// si c'est un graph qui se connect
		if ($_SESSION['id_statut'] == 1) {?>
		<div class="container">
			<div class="row">
				<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="ui-block">
						<div class="ui-block-title">
							<h6 class="title">Ajout veille</h6>
						</div>
						<div class="ui-block-content">
							<form class="form-group label-floating is-empty help">
								<div class="form-group is-empty label-floating">
									<label class="control-label">Lien de la veille</label>
									<input class="form-control lienveille" placeholder="" value="" type="text">
									<span class="material-input"></span>
								</div>
								<div class="form-group is-empty label-floating">
									<label class="control-label">Titre</label>
									<input class="form-control titreveille" placeholder="" value="" type="text">
									<span class="material-input"></span>
								</div>
								<div class="form-group is-empty label-floating">
									<select name="" id="" class="categorie">
										<option value="0">Choisir une catégorie</option>
										<?php foreach ($selection_categorie as $key => $value) {?>
										<option value="<?php echo($value['id_categorie_veille']) ?>"><?php echo($value['categorie']) ?></option>
										<?php }
										?>
									</select>
								</div>
								<div class="form-group label-floating is-empty">
									<form class="upload_veille">
										<input type="file" id="file-select" name="photos" required="required">
									</form>
									
								</div>
								<div class="form-group label-floating is-empty">
									<label class="control-label">Description</label>
									<textarea name="description" id="description" cols="30" rows="10"></textarea>
								</div>
							</form>
							<div class="row">
								<div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-xs-12">
									<a href="#" class="btn btn-secondary btn-lg full-width" data-toggle="modal" data-target="#faqs-popup">Renitialiser</a>
								</div>
								<div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-xs-12">
									<a href="#" class="btn btn-green btn-lg full-width btn-icon-left valider_veille"><i class="fa fa-paper-plane-o" aria-hidden="true"></i>
										Envoyer l'article</a>
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
						<div class="clients-grid">

							<ul class="cat-list-bg-style align-center sorting-menu">
								<li class="cat-list__item active" data-filter="*"><a href="#" class="">Toutes les catégories</a></li>

								<?php foreach ($selection_categorie2 as $key => $value) {?>
								<li class="cat-list__item" data-filter=".<?php echo($value['id_categorie_veille']) ?>"><a href="#" class=""><?php echo($value['categorie']) ?></a></li>
								<?php }
								?>
							</ul>
							<div class="row sorting-container" id="clients-grid-1" data-layout="masonry">
								<?php foreach ($selection_article_veille as $key => $value) {?>
								<div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-xs-12 sorting-item <?php echo($value['categorie']) ?>">
									<div class="ui-block">
										<article class="hentry blog-post">
											<div class="post-thumb">
												<img src="uploads/veille/<?php echo($value['file']) ?>" alt="photo">
											</div>
											<div class="post-content">
												<a href="<?php echo($value['lien']) ?>	" class="h4 post-title"><?php echo($value['titre']) ?></a>
												<p><?php echo($value['description']) ?>											</p>

												<div class="author-date not-uppercase">
													<div class="post__date">
														<time class="published" datetime="2017-03-24T18:18">
															<?php echo($value['date_veille']) ?>
														</time>
													</div>
												</div>
												<a href="#" class="post-add-icon inline-items" style="fill: #ff5e3a;color: #ff5e3a;"><svg class="olymp-heart-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="icons/icons.svg#olymp-heart-icon"></use></svg><span><?php echo($value['like_veille']) ?></span></a>
											</div>
										</article>
									</div>
								</div>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
			</div>





			<?php }?>
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

			<!-- Select / Sorting script -->
			<script src="js/selectize.min.js"></script>

			<!-- Swiper / Sliders -->
			<script src="js/swiper.jquery.min.js"></script>

			<script src="js/isotope.pkgd.min.js"></script>

			<script src="js/mediaelement-and-player.min.js"></script>
			<script src="js/mediaelement-playlist-plugin.min.js"></script>

			<script src="js/mediaelement-and-player.min.js"></script>
			<script src="js/mediaelement-playlist-plugin.min.js"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.9.1/sweetalert2.min.js"></script>
			<script src="js/simpleUpload.min.js"></script>

			<script src="js/charte.js"></script>
			<script>

				$(function(){
					$('.valider_veille').on('click', function(){
						var lienveille = $('.lienveille').val();
						var titreveille = $('.titreveille').val();
						var categorie = $('select.categorie').val();
						var file = $("#file-select").prop("files");
						var description = $('#description').val();
						var names = $.map(file, function (val) { return val.name; });
						$.ajax({
							url: 'formulaire.php',
							type: 'POST',
							data: {lienveille: lienveille, titreveille: titreveille, categorie_veille: categorie, description_veille: description, file_veille: names}
						})
						.done(function(data) {
							location.reload();
						})
						$('#file-select').simpleUpload("upload.php", {

							start: function(file){
						//upload started
					},
					progress: function(progress){
						//received progress
					},
					success: function(data){
						console.log("upload successful!");
						console.log(data);
					},
					error: function(error){
						//upload failed
					}

				});
					})
				})
			</script>
		</body>
		</html>
		<?php }else{
			header('Location: login.php');
		}
		?>