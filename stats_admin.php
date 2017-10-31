<?php 
include('connexion_session.php');

if (isset($_SESSION['id_statut'])) {
	if ($_SESSION['id_statut'] == 5) {

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
			<link rel="stylesheet" type="text/css" href="Bootstrap/dist/css/bootstrap-reboot.css">
			<link rel="stylesheet" type="text/css" href="Bootstrap/dist/css/bootstrap.css">
			<link rel="stylesheet" type="text/css" href="Bootstrap/dist/css/bootstrap-grid.css">

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
			</div>



			<div class="container">
				<div class="row">
					<?php 
					$date_control=date('Y-m-d');
					$query_stats_control=$bdd->prepare("SELECT * FROM stat_controle inner join user on stat_controle.id_controleur = user.id_user where date_stat_control = ?");
					$query_stats_control->bindParam(1, $date_control);
					$query_stats_control->execute();
					$query_stats_control_total=$bdd->prepare("SELECT sum(nb_validation_maquette) as val_maquette_toto, sum(nb_retour_maquette) as retour_maquette_toto, sum(nb_validation_cq) as val_cq_toto, sum(nb_retour_cq) as retour_cq_toto FROM stat_controle where date_stat_control = ?");
					$query_stats_control_total->bindParam(1, $date_control);
					$query_stats_control_total->execute();
					$resultat_total_control=$query_stats_control_total->fetch();
					$total_control_result=$resultat_total_control['val_maquette_toto']+$resultat_total_control['retour_maquette_toto']+$resultat_total_control['val_cq_toto']+$resultat_total_control['retour_cq_toto'];
					foreach ($query_stats_control as $key => $value) {
						$total_control=$value['nb_validation_maquette']+$value['nb_retour_maquette']+$value['nb_validation_cq']+$value['nb_retour_cq'];
						?>
						<div class="col-xl-4 col-lg-4 col-md-5 col-sm-12 col-xs-12 graphique_control">
							<input type="hidden" value="<?php echo $value['id_user'];?>" class="controleur">
							<div class="ui-block" data-mh="pie-chart">
								<div class="ui-block-title">
									<div class="h6 title">Stats Controles <?php echo utf8_encode($value['prenom']);?></div>
									<a href="#" class="more"><svg class="olymp-three-dots-icon"><use xlink:href="icons/icons.svg#olymp-three-dots-icon"></use></svg></a>
								</div>
								<div class="ui-block-content">
									<div class="chart-with-statistic">
										<ul class="statistics-list-count">
											<li>
												<div class="points">
													<span>
														<span class="statistics-point bg-purple"></span>
														Validations maquettes
													</span>
												</div>
												<div class="count-stat"><?php echo $value['nb_validation_maquette'];?></div>
											</li>
											<li>
												<div class="points">
													<span>
														<span class="statistics-point bg-breez"></span>
														Retours maquettes
													</span>
												</div>
												<div class="count-stat"><?php echo $value['nb_retour_maquette'];?></div>
											</li>
											<li>
												<div class="points">
													<span>
														<span class="statistics-point bg-primary"></span>
														Validations CQ
													</span>
												</div>
												<div class="count-stat"><?php echo $value['nb_validation_cq'];?></div>
											</li>
											<li>
												<div class="points">
													<span>
														<span class="statistics-point bg-yellow"></span>
														Retours CQ
													</span>
												</div>
												<div class="count-stat"><?php echo $value['nb_retour_cq'];?></div>
											</li>
										</ul>


										<div class="chart-js chart-js-pie-color">
											<canvas id="pie-color-chart<?php echo $key;?>" width="180" height="180"></canvas>
											<div class="general-statistics"><?php echo $total_control;?>
												<span>Actions contrôleurs</span>
											</div>
										</div>
									</div>
								</div>

							</div>
						</div>
						<?php }?>
						<div class="col-xl-4 col-lg-4 col-md-5 col-sm-12 col-xs-12 graphique_control">
							<input type="hidden" value="<?php echo $value['id_user'];?>" class="controleur">
							<div class="ui-block" data-mh="pie-chart">
								<div class="ui-block-title">
									<div class="h6 title">Stats Controles totales</div>
									<a href="#" class="more"><svg class="olymp-three-dots-icon"><use xlink:href="icons/icons.svg#olymp-three-dots-icon"></use></svg></a>
								</div>
								<div class="ui-block-content">
									<div class="chart-with-statistic">
										<ul class="statistics-list-count">
											<li>
												<div class="points">
													<span>
														<span class="statistics-point bg-purple"></span>
														Validations maquettes
													</span>
												</div>
												<div class="count-stat"><?php echo $resultat_total_control['val_maquette_toto'];?></div>
											</li>
											<li>
												<div class="points">
													<span>
														<span class="statistics-point bg-breez"></span>
														Retours maquettes
													</span>
												</div>
												<div class="count-stat"><?php echo $resultat_total_control['retour_maquette_toto'];?></div>
											</li>
											<li>
												<div class="points">
													<span>
														<span class="statistics-point bg-primary"></span>
														Validations CQ
													</span>
												</div>
												<div class="count-stat"><?php echo $resultat_total_control['val_cq_toto'];?></div>
											</li>
											<li>
												<div class="points">
													<span>
														<span class="statistics-point bg-yellow"></span>
														Retours CQ
													</span>
												</div>
												<div class="count-stat"><?php echo $resultat_total_control['retour_cq_toto'];?></div>
											</li>
										</ul>


										<div class="chart-js chart-js-pie-color">
											<canvas id="pie-color-chart" width="180" height="180"></canvas>
											<div class="general-statistics"><?php echo $total_control_result;?>
												<span>Actions contrôleurs</span>
											</div>
										</div>
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


				<script src="js/mediaelement-and-player.min.js"></script>
				<script src="js/mediaelement-playlist-plugin.min.js"></script>
				<script>
					$(function(){
						var pieColorChart = document.getElementById("pie-color-chart");
						$.ajax({
							url: 'formulaire.php',
							type: 'POST',
							data: {stat_controleur_total: 'controleur'},
						})
						.done(function(data) {
							var myObject = JSON.parse(data);
							a=myObject['val_maquette_toto'];
							b=myObject['retour_maquette_toto'];
							c=myObject['val_cq_toto'];
							d=myObject['retour_cq_toto'];
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
						$(".graphique_control").each(function( index ){
							var pieColorChart = document.getElementById("pie-color-chart"+index);
							var controleur = $(this).find('.controleur').val();
							$.ajax({
								url: 'formulaire.php',
								type: 'POST',
								data: {stat_controleur: controleur},
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