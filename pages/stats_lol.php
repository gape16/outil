<?php
include('connexion_session.php');

if (isset($_SESSION['id_statut'])) {
	?>
	<!DOCTYPE html>
	<html lang="en">
	<head>

		<title>Les statistiques</title>

		<!-- Required meta tags always come first -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="x-ua-compatible" content="ie=edge">

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" type="text/css" href="bootstrap/dist/css/bootstrap-reboot.css">
		<link rel="stylesheet" type="text/css" href="bootstrap/dist/css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="bootstrap/dist/css/bootstrap-grid.css">

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
		<link rel="stylesheet" type="text/css" href="css/swiper.min.css">

		<!-- Lightbox popup script-->
		<link rel="stylesheet" type="text/css" href="css/magnific-popup.css">

		<link rel="stylesheet" type="text/css" href="css/bootstrap-select.css">
		<link rel="stylesheet" type="text/css" href="css/main.css">


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

		<!-- ... end Header -->


		<!-- Responsive Header -->

		<?php include('responsive_header.php');?>

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
							<h1>Stats and Analytics</h1>
							<p>Welcome to your stats and analytics dashboard! Here you’l see all your profile stats like: visits,
								new friends, average comments, likes, social media reach, annual graphs, and much more!
							</p>
						</div>
					</div>
				</div>
			</div>

			<img class="img-bottom" src="img/statistics-bottom.png" alt="friends">
		</div>


		<div class="container">
			<div class="row">

				<div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-xs-12">
					<div class="ui-block">
						<div class="ui-block-content">
							<ul class="statistics-list-count">
								<li>
									<div class="points">
										<span>
											Nombre de maquette ce mois
										</span>
									</div>
									<?php
									$id_graph=$_SESSION['id_graph'];
									//selection d'idgpp dans la table client pour les projets maquette participés
									$query_idgpp=$bdd->prepare("SELECT IDGPP from client WHERE id_cqmaquette = ?");
									$query_idgpp->bindParam(1, $id_graph);
									$query_idgpp->execute();
											$tab_maquette=array();
									// on boucle sur tous les projets (et donc les idgpp)
									foreach ($query_idgpp as $key => $value) {
										//on selectionne toutes les lignes de la table controle où l'idgpp est celui de la boucle +
										// que l'état = 1 (maquette) et qu'il y a un commentaire controleur
										$id_gp=$value['IDGPP'];
										$query_worked_for=$bdd->prepare("SELECT * from controle WHERE IDGPP = ? and etat = 1 and commentaire_controleur IS NOT NULL");
										$query_worked_for->bindParam(1, $id_gp);
										//on boucle sur tous les contrôles fait où la personne à eu un commentaire et on ajout dans le tableau
										foreach ($query_worked_for as $value2) {
											$tab_maquette[]=$value2['id_check'];
										}
										var_dump($tab_maquette);
									}

									?>
									<div class="count-stat"><?php echo $nb?>
										<span class="indicator <?php echo $class;?>"><?php echo $signe;?> <?php echo $nb_moins;?></span>
									</div>
								</li>
							</ul>
						</div>
					</div>
				</div>

		<!-- ... end Window-popup-CHAT for responsive min-width: 768px -->


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

		<!-- Chart JS Generate scripts-->
		<script src="js/Chart.min.js"></script>
		<script src="js/chartjs-plugin-deferred.min.js"></script>
		<script src="js/circle-progress.min.js"></script>
		<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
		<script src="js/run-chart.js"></script>
		<script src="js/charte.js"></script>


		<script src="js/mediaelement-and-player.min.js"></script>
		<script src="js/mediaelement-playlist-plugin.min.js"></script>

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

				$(".new_date").on('change', function(){
					var new_date = $(this).val();

					$.ajax({
						url: 'formulaire.php',
						type: 'POST',
						data: {nb_code: new_date}
					})
					.done(function(data) {
						$(".nb_code").html(data);
					})
					$.ajax({
						url: 'formulaire.php',
						type: 'POST',
						data: {nb_achat: new_date}
					})
					.done(function(data) {
						$(".nb_achat").html(data);
					})
					$.ajax({
						url: 'formulaire.php',
						type: 'POST',
						data: {nb_aide: new_date}
					})
					.done(function(data) {
						$(".nb_aide").html(data);
					})

					var pieSmallChart = document.getElementById("pie-small-chart");

					if (pieSmallChart !== null) {
						var ctx_sc = pieSmallChart.getContext("2d");
						$.ajax({
							url: 'formulaire.php',
							type: 'POST',
							data: {stat_total_date: new_date}
						})
						.done(function(data) {
							var new_total = JSON.parse(data);
							var data_sc = {
								labels: ["Codes créés", "Demandes d'achat", "Demandes d'aide"],
								datasets: [
								{
									data: new_total,
									borderWidth: 0,
									backgroundColor: [
									"#08ddc1",
									"#ffdc1b",
									"#ef3d4c"
									]
								}]
							};

							var pieSmallEl = new Chart(ctx_sc, {
								type: 'doughnut',
								data: data_sc,
								options: {
									deferred: {
										delay: 300
									},
									cutoutPercentage:93,
									legend: {
										display: false
									},
									animation: {
										animateScale: true
									}
								}
							});
						})
					}



					var lineChart = document.getElementById("line-chart");

					if (lineChart !== null) {
						var ctx_lc = lineChart.getContext("2d");
						$.ajax({
							url: 'formulaire.php',
							type: 'POST',
							data: {code_stat_date: new_date}
						})
						.done(function(data) {
							console.log(data);
							var new_data_code = JSON.parse(data);
							$.ajax({
								url: 'formulaire.php',
								type: 'POST',
								data: {achat_stat_date: new_date}
							}).done(function(data2) {
								var new_data_achat = JSON.parse(data2);
								$.ajax({
									url: 'formulaire.php',
									type: 'POST',
									data: {aide_stat_date: new_date}
								}).done(function(data3) {
									var new_data_aide = JSON.parse(data3);
									var data_lc = {
										labels: ["Janvier", "Fevrier", "Mars", "Avril", "Mai", "Juin", "Juillet", "Aout", "Septembre", "Octobre", "Novembre", "Decembre"],
										datasets: [
										{
											label: " - Création de code",
											borderColor: "#08ddc1",
											borderWidth: 4,
											pointBorderColor: "#08ddc1",
											pointBackgroundColor: "#fff",
											pointBorderWidth: 4,
											pointRadius: 6,
											pointHoverRadius: 8,
											fill: false,
											lineTension:0,
											data: new_data_code
										},
										{
											label: " - demandes d'achat",
											borderColor: "#ffdc1b",
											borderWidth: 4,
											pointBorderColor: "#ffdc1b",
											pointBackgroundColor: "#fff",
											pointBorderWidth: 4,
											pointRadius: 6,
											pointHoverRadius: 8,
											fill: false,
											lineTension:0,
											data: new_data_achat
										},
										{
											label: " - demandes d'aide",
											borderColor: "#ef3d4c",
											borderWidth: 4,
											pointBorderColor: "#ef3d4c",
											pointBackgroundColor: "#fff",
											pointBorderWidth: 4,
											pointRadius: 6,
											pointHoverRadius: 8,
											fill: false,
											lineTension:0,
											data: new_data_aide
										}]
									};

									var lineChartEl = new Chart(ctx_lc, {
										type: 'line',
										data: data_lc,
										options: {
											legend: {
												display: false
											},
											responsive: true,
											scales: {
												xAxes: [{
													ticks: {
														fontColor: '#888da8'
													},
													gridLines: {
														color: "#f0f4f9"
													}
												}],
												yAxes: [{
													gridLines: {
														color: "#f0f4f9"
													},
													ticks: {
														beginAtZero:true,
														fontColor: '#888da8'
													}
												}]
											}
										}
									});
								})
							})
						})
					}
				})

var pieSmallChart = document.getElementById("pie-small-chart");

if (pieSmallChart !== null) {
	var ctx_sc = pieSmallChart.getContext("2d");
	$.ajax({
		url: 'formulaire.php',
		type: 'POST',
		data: {stat_total: 'value1'}
	})
	.done(function(data) {
		var new_total = JSON.parse(data);
		var data_sc = {
			labels: ["Codes créés", "Demandes d'achat", "Demandes d'aide"],
			datasets: [
			{
				data: new_total,
				borderWidth: 0,
				backgroundColor: [
				"#08ddc1",
				"#ffdc1b",
				"#ef3d4c"
				]
			}]
		};

		var pieSmallEl = new Chart(ctx_sc, {
			type: 'doughnut',
			data: data_sc,
			options: {
				deferred: {
					delay: 300
				},
				cutoutPercentage:93,
				legend: {
					display: false
				},
				animation: {
					animateScale: true
				}
			}
		});
	})
}



var lineChart = document.getElementById("line-chart");

if (lineChart !== null) {
	var ctx_lc = lineChart.getContext("2d");
	$.ajax({
		url: 'formulaire.php',
		type: 'POST',
		data: {code_stat: 'value1'}
	})
	.done(function(data) {
		var new_data_code = JSON.parse(data);
		$.ajax({
			url: 'formulaire.php',
			type: 'POST',
			data: {achat_stat: 'value1'}
		}).done(function(data2) {
			var new_data_achat = JSON.parse(data2);
			$.ajax({
				url: 'formulaire.php',
				type: 'POST',
				data: {aide_stat: 'value1'}
			}).done(function(data3) {
				var new_data_aide = JSON.parse(data3);
				var data_lc = {
					labels: ["Janvier", "Fevrier", "Mars", "Avril", "Mai", "Juin", "Juillet", "Aout", "Septembre", "Octobre", "Novembre", "Decembre"],
					datasets: [
					{
						label: " - Création de code",
						borderColor: "#08ddc1",
						borderWidth: 4,
						pointBorderColor: "#08ddc1",
						pointBackgroundColor: "#fff",
						pointBorderWidth: 4,
						pointRadius: 6,
						pointHoverRadius: 8,
						fill: false,
						lineTension:0,
						data: new_data_code
					},
					{
						label: " - demandes d'achat",
						borderColor: "#ffdc1b",
						borderWidth: 4,
						pointBorderColor: "#ffdc1b",
						pointBackgroundColor: "#fff",
						pointBorderWidth: 4,
						pointRadius: 6,
						pointHoverRadius: 8,
						fill: false,
						lineTension:0,
						data: new_data_achat
					},
					{
						label: " - demandes d'aide",
						borderColor: "#ef3d4c",
						borderWidth: 4,
						pointBorderColor: "#ef3d4c",
						pointBackgroundColor: "#fff",
						pointBorderWidth: 4,
						pointRadius: 6,
						pointHoverRadius: 8,
						fill: false,
						lineTension:0,
						data: new_data_aide
					}]
				};

				var lineChartEl = new Chart(ctx_lc, {
					type: 'line',
					data: data_lc,
					options: {
						legend: {
							display: false
						},
						responsive: true,
						scales: {
							xAxes: [{
								ticks: {
									fontColor: '#888da8'
								},
								gridLines: {
									color: "#f0f4f9"
								}
							}],
							yAxes: [{
								gridLines: {
									color: "#f0f4f9"
								},
								ticks: {
									beginAtZero:true,
									fontColor: '#888da8'
								}
							}]
						}
					}
				});
			})
		})
	})
}

})
</script>
</body>
</html>
<?php

}else{
	header('Location: login.php');
}
?>
