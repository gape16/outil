<?php 
include('connexion_session.php');

if (isset($_COOKIE['id_statut'])) {
	if ($_COOKIE['id_statut'] == 5) {

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

			<link rel="stylesheet" type="text/css" href="css/daterangepicker.css">

		</head>

		<body>


			<?php 
			if($_COOKIE['id_statut']==1) {
		//page graphistes 
				include('left_sidebar.php');
				include('header.php');
			}elseif  ($_COOKIE['id_statut']==2){
		//page  redacteurs
				include('left_sidebar_redac.php');
				include('header_redac.php');
			}
			elseif ($_COOKIE['id_statut']==3) {
		//page leader
				include('left_sidebar_leader.php');
				include('header_leader.php');
			}elseif ($_COOKIE['id_statut']==4) {
		//page controleur
				include('left_sidebar_controleur.php');
				include('header_controleur.php');
			}elseif($_COOKIE['id_statut']==5){
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
					<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="ui-block">
							<div class="ui-block-content">
								<form>
									<div class="row">
										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
											<div class="form-group label-floating">
												<span>Quelles stats souhaitez vous ?</span>
												<select name="" id="change_stat">
													<option value="">Choisir un type de statistique</option>
													<option value="uno">Les contrôleurs</option>
													<option value="dos">Un utilisateur</option>
													<option value="tres">Une équipe</option>
												</select>
											</div>
										</div>
										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 uno" style="display: none;">
											<div class='col-sm-12'>
												<div class="form-group date-time-picker label-floating">
													<label class="control-label">Date début</label>
													<input name="datetimepicker" value="" id="date_debut_control"/>
													<span class="input-group-addon">
														<svg class="olymp-calendar-icon"><use xlink:href="icons/icons.svg#olymp-calendar-icon"></use></svg>
													</span>
												</div>
											</div>
											<div class='col-sm-12'>
												<div class="form-group date-time-picker label-floating">
													<label class="control-label">Date fin</label>
													<input name="datetimepicker" value="" id="date_fin_control"/>
													<span class="input-group-addon">
														<svg class="olymp-calendar-icon"><use xlink:href="icons/icons.svg#olymp-calendar-icon"></use></svg>
													</span>
												</div>
											</div>

											<a class="btn btn-secondary btn-md full-width valid_date_control">Voir stats Controleurs</a>
										</div>

										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 dos" style="display: none;">
											<div class='col-sm-12'>
												<div class="form-group label-floating">
													<select class="new_graph">
														<option value="0">Choisir un collaborateur</option>
														<?php
														$query_user=$bdd->prepare("SELECT * FROM user order by prenom asc");
														$query_user->execute();
														foreach ($query_user as $key => $value) {?>
														<option value="<?php echo $value['id_user'];?>"><?php echo $value['prenom']." ".$value['nom'];?></option>
														<?php }?>
													</select>
												</div>
											</div>

											<a class="btn btn-blue btn-md full-width valid_user">Voir stats utilisateur</a>
										</div>

										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 tres" style="display: none;">
											<div class='col-sm-12'>
												<div class="form-group label-floating">
													<select class="new_graph">
														<option value="0">Choisir un collaborateur</option>
														<?php
														$query_user=$bdd->prepare("SELECT * FROM user order by prenom asc");
														$query_user->execute();
														foreach ($query_user as $key => $value) {?>
														<option value="<?php echo $value['id_user'];?>"><?php echo $value['prenom']." ".$value['nom'];?></option>
														<?php }?>
													</select>
												</div>
											</div>

											<a href="#" class="btn btn-blue btn-md full-width ">Voir stats équipe</a>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="container">
				<div class="row lescontroleurs">

				</div>
			</div>
			<!-- <div class="container">
				<div class="row">
					<div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<div class="ui-block">
							<div class="ui-block-content">
								<ul class="statistics-list-count">
									<li>
										<div class="points">
											<span>
												Last Month Visitors
											</span>
										</div>
										<div class="count-stat">28.432
											<span class="indicator positive"> + 4.207</span>
										</div>
									</li>
								</ul>
							</div>
						</div>
					</div>

					<div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<div class="ui-block">
							<div class="ui-block-content">
								<ul class="statistics-list-count">
									<li>
										<div class="points">
											<span>
												Last Year Visitors
											</span>
										</div>
										<div class="count-stat">450.623
											<span class="indicator negative"> - 12.352</span>
										</div>
									</li>
								</ul>
							</div>
						</div>
					</div>

					<div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<div class="ui-block">
							<div class="ui-block-content">
								<ul class="statistics-list-count">
									<li>
										<div class="points">
											<span>
												Last Month Posts
											</span>
										</div>
										<div class="count-stat">16.502
											<span class="indicator positive"> + 1.056</span>
										</div>
									</li>
								</ul>
							</div>
						</div>
					</div>

					<div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<div class="ui-block">
							<div class="ui-block-content">
								<ul class="statistics-list-count">
									<li>
										<div class="points">
											<span>
												Last Year Posts
											</span>
										</div>
										<div class="count-stat">390.822
											<span class="indicator positive"> + 2.847</span>
										</div>
									</li>
								</ul>
							</div>
						</div>
					</div>

				</div>
			</div> -->



			<div class="container">
				<div class="row">
					<div class="col-lg-12 col-sm-12 col-xs-12">
						<div class="ui-block responsive-flex">
							<div class="ui-block-title">
								<div class="h6 title">Détails achats, aides, codes</div>
								<select class="new_date">
									<option value="<?php echo date('Y');?>" selected="selected">Année en cours</option>
									<option value="<?php echo date('Y')-1;?>">Année <?php echo date('Y')-1;?></option>
								</select>
								<!-- <select class="new_graph">
									<option value="0">Choisir un collaborateur</option>
									<?php
									$query_user=$bdd->prepare("SELECT * FROM user order by prenom asc");
									$query_user->execute();
									foreach ($query_user as $key => $value) {?>
									<option value="<?php echo $value['id_user'];?>"><?php echo $value['prenom']." ".$value['nom'];?></option>
									<?php }?>
								</select> -->
							</div>

							<div class="ui-block-content neww">
								<div class="chart-js chart-js-line-chart"><iframe class="chartjs-hidden-iframe" tabindex="-1" style="display: block; overflow: hidden; border: 0px; margin: 0px; top: 0px; left: 0px; bottom: 0px; right: 0px; height: 100%; width: 100%; position: absolute; pointer-events: none; z-index: -1;"></iframe>
									<canvas id="line-chart" width="1222" height="331" style="display: block; width: 1222px; height: 331px;"></canvas>
								</div>
							</div>
							<hr>
							<div class="ui-block-content display-flex content-around neww">
								<div class="chart-js chart-js-small-pie"><iframe class="chartjs-hidden-iframe" tabindex="-1" style="display: block; overflow: hidden; border: 0px; margin: 0px; top: 0px; left: 0px; bottom: 0px; right: 0px; height: 100%; width: 100%; position: absolute; pointer-events: none; z-index: -1;"></iframe>
									<canvas id="pie-small-chart" width="90" height="90" style="display: block;"></canvas>
								</div>

								<div class="points points-block">

									<span>
										<span class="statistics-point bg-breez"></span>
										Codes créés
									</span>

									<span>
										<span class="statistics-point bg-yellow"></span>
										Demandes d'achat
									</span>

									<span>
										<span class="statistics-point bg-red" style="background: red;"></span>
										Demandes d'aide
									</span>
								</div>

								<div class="text-stat">
									<?php
									$id_graph=$_COOKIE['id_graph'];
									$annee=date('Y');
									$varsearch = "%" . $annee . "-%";
									$query=$bdd->prepare("SELECT id_code FROM code where date_code like ? and id_user = ? and accept_code = 1");
									$query->bindParam(1, $varsearch);
									$query->bindParam(2, $id_graph);
									$query->execute();

									?>
									<div class="count-stat nb_code"><?php echo $query->rowCount();?></div>
									<div class="title">Total de codes créés</div>
									<div class="sub-title">Cette année</div>
								</div>

								<div class="text-stat">
									<?php
									$query=$bdd->prepare("SELECT id_achat FROM achat_photos where date_achat like ? and id_graph = ?");
									$query->bindParam(1, $varsearch);
									$query->bindParam(2, $id_graph);
									$query->execute();
									?>
									<div class="count-stat nb_achat"><?php echo $query->rowCount();?></div>
									<div class="title">Total de demandes d'achat</div>
									<div class="sub-title">Cette année</div>
								</div>

								<div class="text-stat">
									<?php
									$query=$bdd->prepare("SELECT id_aide FROM aide where date_aide like ? and id_user = ?");
									$query->bindParam(1, $varsearch);
									$query->bindParam(2, $id_graph);
									$query->execute();
									?>
									<div class="count-stat nb_aide"><?php echo $query->rowCount();?></div>
									<div class="title">Total demandes d'aide</div>
									<div class="sub-title">Cette année</div>
								</div>

							</div>
						</div>
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
			<!-- Select / Sorting script -->
			<script src="js/selectize.min.js"></script>

			<!-- Swiper / Sliders -->
			<script src="js/swiper.jquery.min.js"></script>

			<!-- Datepicker input field script-->
			<script src="js/moment.min.js"></script>
			<script src="js/daterangepicker.min.js"></script>

			<script src="js/mediaelement-and-player.min.js"></script>
			<script src="js/mediaelement-playlist-plugin.min.js"></script>
			<?php 
			if($_COOKIE['id_statut']==1) {
						//page graphistes 
				?><script src="../js/notifications.js"></script><?php
			}elseif  ($_COOKIE['id_statut']==2){
						//page  redacteurs
				?><script src="../js/notifications.js"></script><?php
			}
			elseif ($_COOKIE['id_statut']==3) {
						//page leader
				?><script src="../js/notifications.js"></script><?php
			}elseif ($_COOKIE['id_statut']==4) {
						//page controleur
				?><script src="../js/notifications_controleur.js"></script><?php
			}elseif($_COOKIE['id_statut']==5){
						//page admin
				?><script src="../js/notifications_admin.js"></script><?php
			}
			?> 
			<script>
				$(function(){

					$("#change_stat").on('change', function(){
						$(".uno").hide();
						$(".dos").hide();
						$(".tres").hide();
						$('.'+$(this).val()).show();
					})


					$(".neww").css('display','none');
					$(".display-flex.content-around").css('display','none');
					$(".valid_user").on('click', function(){
						$(".neww").css('display','block');
						$(".display-flex.content-around").css('display','flex');
						var new_date = $('.new_date').val();
						var new_graph=$(".new_graph").val();
						$.ajax({
							url: 'formulaire.php',
							type: 'POST',
							data: {nb_code_annee: new_date, nb_code_graph: new_graph}
						})
						.done(function(data) {
							console.log(data);
							$(".nb_code").html(data);
						})
						$.ajax({
							url: 'formulaire.php',
							type: 'POST',
							data: {nb_achat_annee: new_date, nb_achat_graph:new_graph}
						})
						.done(function(data) {
							$(".nb_achat").html(data);
						})
						$.ajax({
							url: 'formulaire.php',
							type: 'POST',
							data: {nb_aide_annee: new_date, nb_aide_graph:new_graph}
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
								data: {stat_total_date_annee: new_date, stat_total_date_graph:new_graph}
							})
							.done(function(data) {
								console.log(data);
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
								data: {code_stat_date_annee: new_date, code_stat_date_graph : new_graph}
							})
							.done(function(data) {
								var new_data_code = JSON.parse(data);
								$.ajax({
									url: 'formulaire.php',
									type: 'POST',
									data: {achat_stat_date_annee: new_date, achat_stat_date_graph:new_graph}
								}).done(function(data2) {
									var new_data_achat = JSON.parse(data2);		
									$.ajax({
										url: 'formulaire.php',
										type: 'POST',
										data: {aide_stat_date_annee: new_date, aide_stat_date_graph:new_graph}
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
$(".new_date").on('change', function(){
	var new_date = $(this).val();
	var new_graph=$(".new_graph").val();
	if(new_graph==0){
		alert('choisir un collaborateur');
	}else{
		$(".neww").css('display','block');
		$(".display-flex.content-around").css('display','flex');
		$.ajax({
			url: 'formulaire.php',
			type: 'POST',
			data: {nb_code_annee: new_date, nb_code_graph: new_graph}
		})
		.done(function(data) {
			$(".nb_code").html(data);
		})
		$.ajax({
			url: 'formulaire.php',
			type: 'POST',
			data: {nb_achat_annee: new_date, nb_achat_graph:new_graph}
		})
		.done(function(data) {
			$(".nb_achat").html(data);
		})
		$.ajax({
			url: 'formulaire.php',
			type: 'POST',
			data: {nb_aide_annee: new_date, nb_aide_graph:new_graph}
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
				data: {stat_total_date_annee: new_date, stat_total_date_graph:new_graph}
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
				data: {code_stat_date_annee: new_date, code_stat_date_graph : new_graph}
			})
			.done(function(data) {
				console.log(data);
				var new_data_code = JSON.parse(data);
				$.ajax({
					url: 'formulaire.php',
					type: 'POST',
					data: {achat_stat_date_annee: new_date, achat_stat_date_graph:new_graph}
				}).done(function(data2) {
					var new_data_achat = JSON.parse(data2);		
					$.ajax({
						url: 'formulaire.php',
						type: 'POST',
						data: {aide_stat_date_annee: new_date, aide_stat_date_graph:new_graph}
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
	}
})
})

</script>
<script>
	$(function(){
		$(".valid_date_control").on('click', function(){
			if($("#date_fin_control").val()!=''){
				var debut = $("#date_debut_control").val();
				var fin = $("#date_fin_control").val();

				$.ajax({
					url: 'formulaire.php',
					type: 'POST',
					data: {stat_controleur: 'controleur', debut_cont:debut, fin_cont:fin},
				})
				.done(function(data) {
					$(".lescontroleurs").html(data);
					$(".graphique_control").each(function( index ){
						var pieColorChart = document.getElementById("pie-color-chart"+index);
						var controleur = $(this).find('.controleur').val();
						$.ajax({
							url: 'formulaire.php',
							type: 'POST',
							data: {stat_controleur_dessin: controleur, debut_cont:debut, fin_cont:fin},
						})
						.done(function(data) {
							console.log(data);
							var myObject = JSON.parse(data);
							a=myObject['nb_validation_maquette'];
							b=myObject['nb_retour_maquette'];
							c=myObject['nb_validation_cq'];
							d=myObject['nb_retour_cq'];
							if (pieColorChart !== null) {
								var ctx_pc = pieColorChart.getContext("2d");
								var data_pc = {
									labels: ["nb_validation_maquette", "nb_retour_maquette", "nb_validation_cq", "nb_retour_cq"],
									datasets: [
									{
										data: [a,b,c,d],
										borderWidth: 0,
										backgroundColor: [
										"#7c5ac2",
										"#08ddc1",
										"#ff5e3a",
										"#ffd71b"
										]
									}]
								};

								var pieColorEl = new Chart(ctx_pc, {
									type: 'doughnut',
									data: data_pc,
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
							}
						})
					})
					var pieColorChart = document.getElementById("pie-color-chart-total");
					$.ajax({
						url: 'formulaire.php',
						type: 'POST',
						data: {stat_controleur_dessin_total: 'controleur', debut_cont:debut, fin_cont:fin},
					})
					.done(function(data) {
						var myObject = JSON.parse(data);
						a=myObject['nb_validation_maquette'];
						b=myObject['nb_retour_maquette'];
						c=myObject['nb_validation_cq'];
						d=myObject['nb_retour_cq'];
						if (pieColorChart !== null) {
							var ctx_pc = pieColorChart.getContext("2d");
							var data_pc = {
								labels: ["nb_validation_maquette", "nb_retour_maquette", "nb_validation_cq", "nb_retour_cq"],
								datasets: [
								{
									data: [a,b,c,d],
									borderWidth: 0,
									backgroundColor: [
									"#7c5ac2",
									"#08ddc1",
									"#ff5e3a",
									"#ffd71b"
									]
								}]
							};

							var pieColorEl = new Chart(ctx_pc, {
								type: 'doughnut',
								data: data_pc,
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
						}
					})
					
				})
			}
		})
	})
</script>
</body>
</html>
<?php }else{
	header('Location: stats.php');
}
}else{
	header('Location: login.php');
}
?>