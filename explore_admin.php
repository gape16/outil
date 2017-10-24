<?php

// Connexion à la base de donnée et insertion de session_start
include('connexion_session.php');

$id_graph=$_SESSION['id_graph'];

$query_code = $bdd->prepare("SELECT * FROM code inner join user on code.id_user = user.id_user inner join categorie_code on code.categorie_code = categorie_code.id_categorie_code  WHERE accept_code = 0 order by date_code DESC");
$query_code->execute();
$nb=$query_code->rowCount();

$query_notif_code=$bdd->prepare("SELECT * FROM code where accept_code = 1 order by id_code DESC limit 1");
$query_notif_code->execute();
$result_notif_code=$query_notif_code->fetch();
$dernier=$result_notif_code['id_code'];
$query_inser_code=$bdd->prepare("UPDATE notifications set notif_A = ? where id_user = ?");
$query_inser_code->bindParam(1, $dernier);
$query_inser_code->bindParam(2, $id_graph);
$query_inser_code->execute();

?>

<!DOCTYPE html>
<html lang="en">
<head>

	<title>Explore !</title>

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
	<style>
		.align-center {
			width: 100%;
		}
	</style>
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

	<!-- Code Editors -->
	<div class="container">
		<div class="row">

			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="clients-grid">

					<ul class="cat-list-bg-style align-center sorting-menu">
						<li class="cat-list__item active" data-filter="*"><a href="#" class="">Toutes les catégories</a></li>

						<li class="cat-list__item" data-filter=".HTML"><a href="#" class="">HTML</a></li>
						<li class="cat-list__item" data-filter=".CSS"><a href="#" class="">CSS</a></li>
						<li class="cat-list__item" data-filter=".JS"><a href="#" class="">JS</a></li>
					</ul>
					<div class="row sorting-container" id="veille_code" data-layout="masonry">
						<?php if($nb!=0){
							foreach ($query_code as $key => $value) {?>
							<div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-xs-12 sorting-item <?php echo($value['categorie_code']) ?>">
								<div class="ui-block">
									<article class="hentry blog-post">
										<a class="opencode" target="_blank" href="code.php">
											<div class="post-content">
												<p class="post-category bg-blue-light"><?php echo utf8_encode($value['categorie_code']);?></p>
												<h4><?php echo utf8_encode($value['titre']);?></h4>
												<p><?php echo utf8_encode($value['description']);?></p>
												<div class="author-date">
													<p class="h6 post__author-name fn"><?php echo utf8_encode($value['prenom']);?> <?php echo utf8_encode($value['nom']);?></p>
													<div class="post__date">
														<time class="published">
															<?php echo utf8_encode($value['date_code']);?>
														</time>
													</div>
													<a href="#" class="accept_code">Valider</a>
												</div>
											</div>
											<input class="id_code" type="hidden" value="<?php echo utf8_encode($value['id_code']);?>">
										</a>
									</article>
								</div>
							</div>
							<?php }
						}else{
							echo "Aucun code envoyé pour le moment !";
						}
						?>
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
	<script src="js/chat.js"></script>
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

	<script src="js/charte.js"></script>
	<script src="js/notifications.js"></script>

	<script>
		$('.sorting-item').each(function(){
			var id_code = $(this).find('input.id_code').val();
			$(this).on('click', function(){
				$(this).find('a.opencode').attr('href', function(){
					return this.href + '?id_code=' + id_code + '';
				})
			})
		});
		$('.accept_code').on('click', function(){
			var id_code = $('.id_code').val();
			console.log(id_code);
			$.ajax({
				url: 'formulaire.php',
				type: 'POST',
				data: {clic_accept: 'value1', id_code: id_code},
			})
			.done(function() {
				swal('Code accepté !')
			})		
		})
	</script>
</body>
</html>