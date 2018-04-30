<?php

// Connexion à la base de donnée et insertion de session_start
include('connexion_session.php');

function time_elapsed_string($datetime, $full = false) {
	$now = new DateTime;
	$ago = new DateTime($datetime);
	$diff = $now->diff($ago);

	$diff->w = floor($diff->d / 7);
	$diff->d -= $diff->w * 7;

	$string = array(
		'y' => 'an',
		'm' => 'mois',
		'w' => 'semaine',
		'd' => 'jour',
		'h' => 'heure',
		'i' => 'minute',
		's' => 'seconde',
	);
	foreach ($string as $k => &$v) {
		if ($diff->$k) {
			$v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
		} else {
			unset($string[$k]);
		}
	}

	if (!$full) $string = array_slice($string, 0, 1);
	return $string ? ' Il y a ' .implode(', ', $string) : 'maintenant';
}

$id_graph=$_SESSION['id_graph'];

if (isset($_SESSION['id_statut'])) {
	// print_r($_POST);
	// $id_receveur=$_POST['receveur'];
	// $query_com_anniv_select=$bdd->prepare("SELECT * FROM commentaires_anniversaire inner join user on commentaires_anniversaire.id_receveur = user.id_user order by date_com DESC");
	// $query_com_anniv_select->execute();

	?>
	<!DOCTYPE html>
	<html lang="en">
	<head>

		<title>Les anniversaires</title>
		<meta http-equiv="refresh" content="12000">

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
		<link rel='stylesheet' href='css/fullcalendar.css'/>
		<link rel='stylesheet' href='css/simplecalendar.css'/>
		<link rel="stylesheet" type="text/css" href="css/bootstrap-select.css">
		<link rel="stylesheet" type="text/css" href="css/daterangepicker.css">
		<link rel="stylesheet" type="text/css" href="css/main.css">

		<style>
		.msg_gestionnaire {
			min-height: 220px;
			border: 1px solid rgba(255, 99, 71, 0.22);
			padding: 20px;
		}
		.wrapper_msg, .wrapper_anniv_cmd{
			display: none;
		}
		#anniversaire .reni {
			background: #9a9fbf;
		}
		#anniversaire a.btn.btn-green.btn-lg {
			width: 100%;
			padding: 10px;
		}
		a.btn.btn-green.btn-lg.reni, input.date_bday {
			margin-bottom: 10px;
		}
		a.btn.btn-green.btn-lg.save {
			margin-bottom: 0;
		}
		input.date_bday {
			width: 100%;
			padding: 10px;	
		}
		.dib p {
			width: 30%;
			float: left;
		}
		li.com_anniv {
			padding: 25px;
			border-bottom: 1px solid rgba(167, 167, 167, 0.23);
		}
		p.auteur {
			font-weight: 500;
		}
		span.date {
			font-weight: 100;
			font-size: 0.7rem;
		}
		img.img_avatar {
			width: 30px;
			height: 30px;
			border-radius: 30px;
			margin-right: 5px;
		}
		p.msg {
			margin-bottom: 0;
		}
		li.com_anniv:last-child {
			border-bottom: inherit;
		}
		#anniversaire .post p {
			margin: 0;
		}
		span.date_butoir {
			text-align: center;
			display: block;
			padding: 10px;
			background: tomato;
			color: white;
			border-radius: 3px;
			margin-top: 10px;
		}
		.butoir{
			display: none;
		}
		a.btn.edit_msg {
			width: 100%;
			margin-top: 10px;
			background: #9a9fbf;
			color: white;
			padding: 10px;
			cursor: pointer;
			margin-bottom: 10px;
		}
		a.btn.chef_anniv {
			background: tomato;
			color: white;
		}
		a.btn.chef_anniv:hover {
			color: white;
		}
		.save_edit{
			display: none;
		}
		a.btn.save_edit {
			margin-bottom: 0;
			background: #1ed760;
			color: white;
			cursor: pointer;
			width: 100%;
			padding: 10px;
		}
		a.btn:hover{
			color: white !important;
		}
		input.change_date {
			padding: 10px;
			margin-top: 5px;
		}
		#anniversaire .event-description {
			height: 100%;
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


	<!-- Main Header Events -->

	<div class="main-header">
		<div class="content-bg-wrap">
			<div class="content-bg bg-birthday"></div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 col-md-8 offset-md-2 col-sm-12 col-xs-12">
					<div class="main-header-content">
						<h1>N'oubliez jamais un anniversaire!</h1>
						<p>Bienvenu sur la page des anniversaire ce qui vous permettre de ne plus rater aucune date.
						</p>
					</div>
				</div>
			</div>
		</div>

		<img class="img-bottom" src="img/birthdays-bottom.png" alt="friends">
	</div>

	<!-- ... end Main Header Events -->


	<div class="container">
		<div class="row">
			<?php for ($i=1; $i < 13; $i++) { 
				if ($i<10) {
					$u="0".$i;
				}else{
					$u=$i;
				}
				$var = "%-".$u."-%";
				$query_=$bdd->prepare("SELECT * FROM user left join gestion_anniversaire on user.id_user=gestion_anniversaire.id_receveur where date_naissance like ?");
				$query_->bindParam(1, $var);
				$query_->execute();
				$tab=["Janvier","Fevrier","Mars","Avril","Mai","Juin","Juillet","Aout","Septembre","Octobre","Novembre","Decembre"];
				?>

				<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="ui-block">
						<div class="ui-block-title">
							<h6 class="title"><?php echo $tab[$i-1];?></h6>
						</div>
					</div>
				</div>
				<?php foreach ($query_ as $key => $value) {?>
				<div class="col-xl-4 col-lg-6 col-md-12 col-sm-12 col-xs-12">
					<div class="ui-block">
						<div class="birthday-item inline-items">
							<div class="author-thumb">
								<img src="<?php echo utf8_encode($value['photo']);?>" alt="author">
							</div>
							<div class="birthday-author-name">
								<a href="#" class="h6 author-name"><?php echo $value['prenom']." ".$value['nom'];?></a>
								<div class="birthday-date"><?php echo explode("-",$value['date_naissance'])[2];?> <?php echo $tab[$i-1];?> <?php echo explode("-",$value['date_naissance'])[0];?></div>
							</div>
							<a data-toggle="modal" data-target="#anniversaire" data-emet="<?php echo $value['id_emetteur'];?>" data-id="<?php echo $value['id_user'];?>" class="btn btn-sm bg-blue participer">Participer<div class="ripple-container"></div></a>
						</div>
					</div>
				</div>
				<?php }}?>



			</div>
		</div>
		<!-- Window-popup Event Private Public -->
		<div class="modal fade show" id="anniversaire" >
			<div class="modal-dialog ui-block window-popup event-private-public private-event">
				<a href="#" class="close icon-close" data-dismiss="modal" aria-label="Close">
					<svg class="olymp-close-icon"><use xlink:href="icons/icons.svg#olymp-close-icon"></use></svg>
				</a>
				<article class="hentry post has-post-thumbnail thumb-full-width private-event">

					<div class="row">
						<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
							<div class="post__author author vcard inline-items">
								<div class="author-date">
									<a class="h6 post__author-name fn user_popup" href="#">PARTICIPATION ANNIVERSAIRE</a>
									<div class="post__date date_popup">
										<time class="published" datetime="2017-03-24T18:18">

										</time>
									</div>
								</div>

							</div>
							<div class="wrapper_msg">
								<div class="msg_gestionnaire" contenteditable="false">
									//TON MESSAGE ICI
								</div>
							</div>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
							<div class="event-description">
								<h6 class="event-description-title">Infos pratiques</h6>
								<div class="place inline-items">
									<img class="avatar" src="" alt="author">
									<span class="who"></span>
									<span class="when"></span>
								</div>
								<a class="btn chef_anniv">S'occuper de l'anniversaire</a>
								<div class="wrapper_anniv_cmd">
									<div class="dib">
										<p>Date butoir :</p>
										<input type="date" class="date_bday" name="bday">
									</div>
									<a href="#" class="btn btn-green btn-lg reni">Réinitialiser</a>
									<a href="#" class="btn btn-green btn-lg save">Sauvegarder</a>
								</div>
							</div>
						</div>
					</article>

					<div data-mcs-theme="dark" style="max-height: 300px;overflow-y: scroll;">
						<ul class="com_anniv">
							
						</ul>
					</div>

					<form class="comment-form inline-items">

						<div class="form-group with-icon-right ">
							<textarea class="form-control envoi_message_anniversaire" placeholder=""  ></textarea>
							<input type="hidden" class="id_anniversaire">
							<div class="add-options-message">
								<a href="#" class="options-message anniv-envoi">
									<svg class="olymp-camera-icon"><use xlink:href="icons/icons.svg#olymp-chat---messages-icon"></use></svg>
								</a>
							</div>

							<span class="material-input"></span><span class="material-input"></span>
						</div>

					</form>
				</div>
				<input type="hidden" class="hax-qui">
			</div>
		</div>
	</div>

	<!-- ... end Window-popup Create Friends Group Add Friends -->


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

	<!-- Datepicker input field script-->
	<script src="js/moment.min.js"></script>
	<script src="js/daterangepicker.min.js"></script>

	<!-- Calendar events script -->
	<script src="js/fullcalendar.js"></script>

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
	<script src="js/charte.js"></script>
	<script src="js/alterclass.js"></script>
	<script>
		$(function(){

			function charger_commentaires(){
				setTimeout( function(){
					if($("#anniversaire").is('[class*="show"]')){
						var check="dial_";
						var cls = $("#anniversaire").attr('class').split(' ');
						for (var i = 0; i < cls.length; i++) {
							if (cls[i].indexOf(check) > -1) {
								var id_emet = cls[i].slice(check.length, cls[i].length);
							}
						}
						var max = 0;
						$('#anniversaire li').each(function() {
							max = Math.max(this.id, max);
						});
						console.log(max); 
						var id_commentair = max;
						if(id_commentair==undefined){
							id_commentair=0;
						}
						$.ajax({
							url: 'formulaire.php',
							type: 'POST',
							data: {charger_com: id_emet, id_com:id_commentair},
						})
						.done(function(data) {
							console.log(data);
							var liste = "";
							var infos = JSON.parse(data);
							for (var i = 0; i <= infos.length - 1; i++) {

								liste+="<li class='com_anniv' id='"+infos[i]['id_commentaires']+"'>";
								liste+="<p class='auteur'> <img src='"+infos[i]['photo_avatar']+"' class='img_avatar'>"+ infos[i]['nom'] + "";
								liste+="<span class='date'>, "+infos[i]['date']+"</span>";
								liste+="</p>";
								liste+="<p class='msg'>"+infos[i]['msg']+"</p>";
								liste+="</li>";

								var $target = $('ul.com_anniv').parent(); 
								$target.animate({scrollTop: $(".com_anniv").height()}, 200);
							}
							$("ul.com_anniv").append(liste);
						})
					}
					charger_commentaires();
				}, 500);
			}

			//CLIC SUR UNE PERSONNE
			$('.participer').on('click', function(){
				charger_commentaires();
				var qui = $(this).parent().find('.author-name').html();
				var quand = $(this).parent().find('.birthday-date').html();
				var img = $(this).parent().find('.author-thumb img').attr('src');


						//RESET
						$('#anniversaire .who').html('');
						$('#anniversaire .when').html('');


						$('#anniversaire .who').append(qui);
						$('#anniversaire .who').append(qui);
						$('#anniversaire .when').append(quand);
						$('#anniversaire img.avatar').attr('src', img);

						var receveur = $(this).data('id');
						$('.hax-qui').val(receveur);
						$('.msg_gestionnaire').html('');

						//AFFICHE COM
						$.ajax({
							url: 'formulaire.php',
							type: 'POST',
							data: {receveur_anniv: receveur},
						})
						.done(function(data) {
							// $('.com_anniv').html('');
							// $('.com_anniv').append(data);
							$('textarea.form-control.envoi_message_anniversaire').val('');
						})

						// SI IL Y A DEJA UN GESTIONNAIRE
						$.ajax({
							url: 'formulaire.php',
							type: 'POST',
							data: {msg_chef_anniv: receveur},
						})
						.done(function(data) {
							var data_anniv = JSON.parse(data);	
							var date_butoir = data_anniv[1];
							date_butoir = date_butoir.split(' ')[0];
							year = date_butoir.split('-')[0];
							month = date_butoir.split('-')[1];
							day = date_butoir.split('-')[2];
							
							$('.msg_gestionnaire').html('');
							$('.butoir').remove();
							
							$('.msg_gestionnaire').append(data_anniv[0]);
							$('.event-description').append('<div class="butoir" style="display: block;"><p>Date butoir : <br> <span class="date_butoir">' + day + '/' + month + '/' + year +'</span></p><a class="btn edit_msg">Modifier le message</a><a class="btn save_edit">Sauvegarder le message</a></div>');
						})

						// MSG + DATE	
						$.ajax({
							url: 'formulaire.php',
							type: 'POST',
							data: {receveur_gestion: receveur},
						})
						.done(function(data) {
							//SI IL N Y A PAS DE GESTIONNAIRE
							console.log(data);
							if (data == 1) {
								console.log('pas de msg');
								$('.butoir').remove();
							}else{
								$('a.btn.chef_anniv').css('display', 'none');
								$('.butoir').css('display', 'block');
								$('.wrapper_msg').css('display', 'block');
							}
						})

						//CHECK SI L'UTILISATEUR EST LE GESTIONNAIRE DE CETTE BRIQUE
						$.ajax({
							url: 'formulaire.php',
							type: 'POST',
							data: {user_gestion: receveur},
						})
						.done(function(data) {
							console.log(data);
							if (data==0) {
								$('a.btn.edit_msg').css('display', 'none');
							}
						})


						$('.wrapper_msg').css('display', 'none');
						$('.wrapper_anniv_cmd').css('display', 'none');
						$('a.btn.chef_anniv').css('display', 'block');

					})

			//AFFICHAGE DU CHAMP POUR ECRIRE
			$('a.btn.chef_anniv').click(function(){
				$(this).fadeOut(10);
				$('.wrapper_msg').fadeIn(500);
				$('.wrapper_anniv_cmd').fadeIn(500);
				$('.msg_gestionnaire').attr('contenteditable', 'true');
			})

			//RESET CHAMP
			$('.reni').on('click', function(){
				$('.msg_gestionnaire').html('');
			})

			//ENVOI DU MSG GESTIONNAIRE DANS LA DTB
			$('.save').on('click', function(){
				var receveur = $(this).parents().find('.modal').attr('class');
				receveur = receveur.split('_')[1];
				var date = $(this).parent().find('.date_bday').val();
				var msg = $(this).parents('.modal').find('.msg_gestionnaire').html();
				$.ajax({
					url: 'formulaire.php',
					context: this,
					type: 'POST',
					data: {receveur_chef_anniv: receveur, date_bday: date, message_anniv: msg},
				})
				.done(function(data) {


					console.log(date);
					

					$('.msg_gestionnaire').append(data);
					$('.msg_gestionnaire').css('border', 'inherit');
					$('.msg_gestionnaire').attr('contenteditable', 'false');
					$('.wrapper_anniv_cmd').css('display', 'none');
					$('.butoir').css('display', 'block');

					$('.event-description').append('<div class="butoir" style="display: block;"><p>Date butoir : <br> <span class="date_butoir">'+ date +'</span></p><a class="btn edit_msg">Modifier le message</a><a class="btn save_edit">Sauvegarder le message</a></div>');
				})
			})

			//BIND COMMENTAIRE
			$(document).keypress(function(e) {
				if(e.which == 13) {
					$('.add-options-message').trigger('click');
				}
			});

			//ENVOI COMMENTAIRE
			$('.add-options-message').on('click', function(){
				var receveur = $(this).parents().find('.modal').attr('class');
				receveur = receveur.split('_')[1];
				var commentaire = $('textarea.form-control.envoi_message_anniversaire').val();

				console.log(receveur);
				console.log(commentaire);

				$.ajax({
					url: 'formulaire.php',
					type: 'POST',
					data: {commentaire_anniv: commentaire, receveur: receveur},
				})
				.done(function(data) {

					console.log(data);
					$('.comments-list').append(data);
					$('textarea.form-control.envoi_message_anniversaire').val('');
				})
			})



			//EDIT LE MSG SI ON EST GESTIONNAIRE
			$('body').on('click', '.edit_msg', function(){
				//RECUP DE L'ANCIENNE DATE BUTOIR
				var date = $('.date_butoir').html();
				var year = date.split('/')[2];
				var month = date.split('/')[1];
				var day = date.split('/')[0];

				var newDate = year+'-'+month+'-'+day;
				$('.date_butoir').remove();
				var inputDate = "<input type='date' class='change_date'>";
				$('.butoir p').append(inputDate);
				$('.change_date').val(newDate);
				$('.change_date').css('border', '1px solid rgba(255, 99, 71, 0.22)');
				
				var receveur = $(this).parents().find('.hax-qui').val();

				$.ajax({
					url: 'formulaire.php',
					type: 'POST',
					data: {modif_msg: receveur},
				})
				.done(function(data) {
					console.log(data);
					if (data == 1) {
						$('.msg_gestionnaire').attr('contenteditable', 'true');

						var div = $('.msg_gestionnaire');
						setTimeout(function() {
							div.focus();
						}, 0);

						$('.save_edit').css('display', 'block');
					}
				})
			})


			//SAVE LE MSG ET LA DATE GESTIONNAIRE APRES EDIT
			$('body').on('click', '.save_edit', function(){
				var msg = $('.msg_gestionnaire').html();
				var receveur = $(this).parents().find('.hax-qui').val();
				var newDate = $('input.change_date').val();
				$.ajax({
					url: 'formulaire.php',
					type: 'POST',
					data: {msg_after_edit: msg, receveur_after_edit: receveur, date: newDate},
				})
				.done(function(data) {
					console.log("success");
				})
			});
		})
	</script>
</body>
</html>
<?php }else{
	header('Location: login.php');
}
?>