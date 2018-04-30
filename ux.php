<?php

// Connexion à la base de donnée et insertion de session_start
include('connexion_session.php');


$query_all_post  = $bdd->prepare("SELECT * FROM ux_title");
$query_all_post->execute();

?>

<!DOCTYPE html>
<html lang="en">
<head>

	<title>Les tutos</title>

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
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&amp;subset=latin" media="all"><script>
		WebFont.load({
			google: {
				families: ['Roboto:300,400,500,700:latin']
			}
		});
	</script>

	<link rel="stylesheet" type="text/css" href="css/fonts.css">

	<!-- Styles for plugins -->
	<link rel="stylesheet" type="text/css" href="css/jquery.mCustomScrollbar.min.css">
	<link rel="stylesheet" type="text/css" href="css/swiper.min.css">
	<link rel="stylesheet" type="text/css" href="css/daterangepicker.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap-select.css">
	<style>
	.help-support-list li svg{
		min-width: 14px;
	}
	li {
		list-style-type: circle;
	}
	.main-header-content p {
		text-align: left !important;
	}
	h4.title {
		color: #515365;
	}
	.main-header-content p {
		color: #888da8;
	}
	.margin{
		margin-top: 20px;
		margin-bottom: 55px;
	}
	.img-margin {
		margin-top: 0 !important;
	}
	p.mt {
		margin-top: 20px;
	}
	.li-active {
		color: #ff5e3a !important;
	}
	.li-off{
		color: #888da8;
	}
	img.img-typo {
		display: block;
		margin: 0 auto;
		margin-bottom: 20px;
		margin-top: 50px;
	}
	.mb{
		margin-bottom: 20px;
	}
	img.third {
		width: 33.3333%;
		float: left;
		padding: 16px;
	}
	blockquote {
		background: tomato;
		color: white;
		text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.31);
		border-radius: 5px;
	}
	p.center {
		text-align: center;
	}
	p.faketitle {
		font-weight: 500;
		font-size: 115%;
	}
	h4, h5 {
		font-weight: 400;
	}
	.registration-login-form{
		min-height: 150px;
	}
	.plus{
		position: absolute;
		right: 0;
		width: 38px;
		padding: 15px 15px;
		height: 100%;
		/* vertical-align: middle; */
		top: 0;
		/* margin: auto; */
		font-size: 20px;
		/* text-align: left; */
		line-height: normal;
	}
	.remov_resum{
		color: red;
		font-weight: bold;
		margin-right: 30px;
		cursor: pointer;
	}

	.box {
		width: 500px;
		position: relative;
		margin: auto;
		height: 500px;
	}
	.trigger {
		width: 300px;
		height: 155px;
		position: absolute;
		z-index: 10;
		top: 120px;
		left: 120px;
		background-image: url(img/big_round.png);
		background-repeat: no-repeat;
		background-size: contain;
		background-position: center;
		cursor: pointer;
	}
	.popcircle {
		position: absolute;
		z-index: 9;
		width: 500px;
		height: 500px;
	}
	.popcircle ul {
		list-style: none;
		padding: 0px;
		margin: 0px;
		height: auto;
		cursor: pointer;
	}
	.popcircle ul li {
		top: 147.5px; left: 220px;
		list-style: none;
		height: 100px;
		width: 100px;
		position: absolute;
	}
	.popcircle ul li a {
		color: grey;
	}
	img {
		border:0;
	}
	#circle_btn:before {
		content: attr(data-before);
		position: absolute;
		top: 0px;
		left: 70px;
		background: #c15a5a;
		color: white;
		border-radius: 50%;
		/* padding: 31px; */
		width: 150px;
		height: 150px;
		/* transform-origin: center; */
		/* vertical-align: -50%; */
		/* margin: auto; */
		display: block;
		text-align: center;
		padding: 56px 0;
		font-size: 27px;
	}
	.recherche_item{
		width: 300px;    
		border: 1px solid #e6ecf5;
		position: absolute;
		top: 53px;
		z-index: 99999;
	}
	.recherche_item li{
		width: 100%;
		background: white;
		list-style: none;
		padding: 8px 18px;
	}
	.recherche_item li:hover{
		cursor: pointer;
		background: #e6ecf5;
	}
</style>
</head>

<body class="body-bg-white">


	<!-- Stunning header -->

	<div class="stunning-header bg-primary-opacity">

		<div class="header-spacer--standard"></div>
		<div class="stunning-header-content">
			<svg id="Calque_1" data-name="Calque 1" viewBox="0 0 70 70" style="width:55px;height:auto; "><defs><style>.cls-1,.cls-2{fill:#fff;}.cls-1{opacity:0.8;}</style></defs><polygon class="cls-1" points="7.08 18.82 35 2.64 62.92 18.82 62.92 51.18 35 67.36 7.08 51.18 7.08 18.82"></polygon><polygon class="cls-2" points="7.08 18.82 7.08 51.18 35 67.36 35 35 7.08 18.82"></polygon></svg><br>
			<h1 class="stunning-header-title">Outil démarche UX</h1>
			<ul class="breadcrumbs">
				<li class="breadcrumbs-item">
					<a href="#">Support sur l'approche UX</a>
					<span class="icon breadcrumbs-custom">/</span>
				</li>
			</ul>
		</div>

		<div class="content-bg-wrap">
			<div class="content-bg stunning-header-bg1"></div>
		</div>
	</div>

	<!-- End Stunning header -->

	<section class="negative-margin-top50">
		<div class="container">
			<div class="row">
				<div class="col-xl-10 m-auto col-lg-10 col-md-12 col-sm-12 col-xs-12">

					
					<!-- Search Form  -->
					
					<form class="form-inline search-form" method="post">
						<div class="form-group label-floating">
							<label class="control-label">Cherchez votre corps de métier</label>
							<input class="form-control bg-white recherche" placeholder="" type="text">
							<ul class="recherche_item">
							</ul>
						</div>

						<button class="btn btn-primary btn-lg">Rechercher</button>
					</form>

					<!-- ... end Search Form  -->
				</div>
			</div>
		</div>
	</section>

	<section>
		<div class="container">
			<div class="row">
				<div class="col-xl-10 m-auto col-lg-10 col-md-12 col-sm-12 col-xs-12">
					<a href="#" class="btn btn-purple btn-lg full-width" data-target="#ajout_metier" data-toggle="modal">Ajouter un métier !<div class="ripple-container"></div></a>
				</div>
			</div>
		</div>
	</section>


	<section class="medium-padding120">
		<div class="container">
			<div class="row">
				<?php 
				foreach ($query_all_post as $key => $value) {
					$query_ux_item=$bdd->prepare("SELECT * FROM ux_component where id_title = ?");
					$query_ux_item->bindParam(1, $value["id_title"]);
					$query_ux_item->execute();
					$nb_ux=$query_ux_item->rowCount();
					?>

					<div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">

						<div class="help-support-block">
							<h3 class="title" style="cursor: pointer;"><span><?php echo utf8_encode($value['nom']);?></span><a href="" class="total-topic"><?php echo $nb_ux;?></a></h3>
							<ul class="help-support-list <?php echo utf8_encode($value['nom']);?>" style="display: none;">
								<?php 
								foreach ($query_ux_item as $value2) {
									?>
									<li>
										<!-- <svg class="olymp-blog-icon"><use xlink:href="icons/icons.svg#olymp-blog-icon"></use></svg> -->
										<a><?php echo utf8_encode($value2["nom"]);?></a>
									</li>
									<?php }?>
								</ul>
							</div>

						</div>
						<?php }?>

					</div>
				</div>
			</section>

			<section class="medium-padding120" id="nouveau" style="display: none;">
				<div class="box">
					<div class="trigger" id="circle_btn"></div>
					<div class="popcircle">
						<ul id="pops">
						</ul>
					</div>
				</div>
			</section>


			<section class="align-right pt160 pb80 section-move-bg call-to-action-animation scrollme">
				<img class="first-img" alt="guy" src="img/guy.png" style="bottom: 0;opacity: 1;transform: scale(1);">
				<div class="content-bg-wrap">
					<div class="content-bg bg-section1"></div>
				</div>
			</section>


			<a class="back-to-top" href="#">
				<img src="icons/back-to-top.svg" alt="arrow" class="back-icon">
			</a>


			<div class="modal fade" id="ajout_metier">
				<div class="modal-dialog ui-block window-popup registration-login-form-popup">
					<a href="#" class="close icon-close" data-dismiss="modal" aria-label="Close">
						<svg class="olymp-close-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-close-icon"></use></svg>
					</a>
					<div class="registration-login-form">
						<!-- Tab panes -->
						<div class="tab-content">
							<div class="tab-pane active" id="home1" role="tabpanel" data-mh="log-tab">
								<div class="title h6">Ajout d'une catégorie</div>
								<form class="content">
									<div class="row">
										<div class="col-xl-12 col-lg-12 col-md-12">
											<div class="form-group label-floating">
												<label class="control-label">Nom de la catégorie</label>
												<input class="form-control cat" placeholder="" type="text">
											</div>
											<div class="form-group label-floating element_ux">
												<label class="control-label">Element</label>
												<input class="form-control elem" placeholder="" type="text">
												<a href="#" class="btn btn-blue btn-lg full-width plus">+</a>
											</div>
											<p style="display: none;">Element enregistré(s): <span class="save">0</span></p>

											<a href="#" class="btn btn-purple btn-lg full-width" id="voir">Valider ces expressions !</a>

										</div>
									</div>
								</form>
							</div>
							<div class="tab-pane" id="home2" role="tabpanel" data-mh="log-tab">
								<div class="title h6">Vérification des éléments</div>
								<form class="content">
									<div class="row">
										<div class="col-xl-12 col-lg-12 col-md-12">
											<p class="titre">Listes des éléments enregistrés :</p>
											<div class="ajout"></div><br>
											<p style="display: none;">Element enregistré(s): <span class="save">0</span></p>
											<br>
											<a href="#" class="btn btn-secondary btn-lg full-width retour">Retour</a>
											<a href="#" class="btn btn-primary btn-lg full-width finish">Terminé !</a>
										</div>
									</div>
								</form>
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

			<!-- Select / Sorting script -->
			<script src="js/selectize.min.js"></script>

			<!-- Swiper / Sliders -->
			<script src="js/swiper.jquery.min.js"></script>

			<script src="js/mediaelement-and-player.min.js"></script>
			<script src="js/mediaelement-playlist-plugin.min.js"></script>

			<!-- Datepicker input field script-->
			<script src="js/moment.min.js"></script>
			<script src="js/jquery.popcircle.1.0.js"></script>
			<script src="js/jquery.easing.1.3.js"></script>

			<script type="text/javascript">

				$(function(){
					$('.elem').keyup(function(e){
						if(e.keyCode == 13)
						{
							$(".plus").click();
						}
					});

					$(".plus").on('click', function(e){
						e.preventDefault();
						if($(".elem").val()!=""){
							$(".save").parent().css('display','block');
							$(".save").html($(".save").html()*1+1);
							$(".ajout").append('<p class="resum"><span class="remov_resum">X</span>'+$(".elem").val()+'</p>');
							$(".elem").val('');
						}
					})

					$("#voir").on('click', function(e){
						e.preventDefault();
						$(this).parents("#home1").removeClass("active");
						$("#home2").addClass("active");
					})

					$(".retour").on('click', function(e){
						e.preventDefault();
						$(this).parents("#home2").removeClass("active");
						$("#home1").addClass("active");
					})

					$(".finish").on('click', function(e){
						var item= [];
						$(".resum").each(function(){
							$(this).find('.remov_resum').remove();
							item.push($(this).html());
						})
						var categorie=$(".cat").val();
						$.ajax({
							url: 'ux_ajax.php',
							type: 'POST',
							data: {item: item, categorie: categorie}
						})
						.done(function(data) {
							location.reload();
						})						
					})

					$(".ajout").on('click', '.remov_resum', function(e){
						$(this).parent().remove();
						if($(".save").html()>0){
							$(".save").html($(".save").html()*1-1);
						}
					})


					$('.trigger').click(function(e){
						e.preventDefault();
						$.popcircle('#pops',{
							spacing:'100px',
							type:'full', // full, half, quad
							offset:4,	// 0, 1, 2, 3, 4, 5, 6, 7 or 5.1
							time:'slow' // slow, fast, 1000
						}
						);
					});

					$(".recherche").on('keyup', function(){
						var recherche = $(this).val();
						if(recherche.length >0){
							
							$(".recherche_item").html('');
							$.ajax({
								url: 'ux_ajax.php',
								type: 'POST',
								data: {recherche: recherche}
							})
							.done(function(data) {
								var infos = JSON.parse(data);
								for (var i = 0; i <= infos.length; i++){
									$(".recherche_item").append("<li>"+infos[i]['nom']+"</li>");
								}
							})
						}
					})

					$(".title").on('click', function(){
						$("#nouveau").fadeIn("slow");
						var contenu = $(this).parent().find(".help-support-list").html();
						$("#pops").html(contenu);
						var con=$(this).find("span").html();
						$("#circle_btn").attr('data-before',con);
						$('html,body').animate({
							scrollTop: $("#nouveau").offset().top},
							'slow');
						$.popcircle('#pops',{
							spacing:'100px',
							type:'full', // full, half, quad
							offset:4,	// 0, 1, 2, 3, 4, 5, 6, 7 or 5.1
							time:'slow' // slow, fast, 1000
						}
						);
					})

					$("body").on('click', ".recherche_item li", function(){
						// alert("oui");
						var con=$(this).html();
						$("#circle_btn").attr('data-before',con);
						$("#nouveau").fadeIn("slow");
						var contenu = $("."+con).html();
						$("#pops").html(contenu);
						$('html,body').animate({
							scrollTop: $("#nouveau").offset().top},
							'slow');
						$.popcircle('#pops',{
							spacing:'100px',
							type:'full', // full, half, quad
							offset:4,	// 0, 1, 2, 3, 4, 5, 6, 7 or 5.1
							time:'slow' // slow, fast, 1000
						}
						);
					})

				})



			</script>

		</body>
		</html>