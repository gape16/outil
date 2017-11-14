<?php

// Connexion à la base de donnée et insertion de session_start
include('connexion_session.php');
$id_graph=$_SESSION['id_graph'];
$requete=$bdd->prepare("SELECT date_naissance FROM user where id_user = ?");
$requete->bindParam(1, $id_graph);
$requete->execute();
$result=$requete->fetch();
$date_naissance = $result['date_naissance'];
$date_tempo = str_replace('-', '/', $date_naissance);
$debut =  date('d/m/Y', strtotime($date_tempo));
?>


<div class="ui-block-title">
	<h6 class="title">Parametre du compte</h6>
</div>
<div class="ui-block-content">
	<form>
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mb">
				<p>Modifier l'image de profil</p>
				<form action="">
					<input class="mb" type="file" name="photos" id="file-s">
				</form>
				<p>Modifier la date de naissance</p>
				<div class="form-group date-time-picker label-floating">
					<label class="control-label">Ta date de naissance</label>
					<input autocomplete="off" class="check date" name="datetimepicker" value="<?php echo $debut;?>" />
				</div>
				<a class="btn btn-primary btn-lg full-width confirm_date" style="color:white;cursor:pointer;">
				Changer ma date de naissance</a>
			</div>
		</div>
	</form>
</div>

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
<script src="js/moment.min.js"></script>
<script src="js/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/bootstrap-select.css">


<script src="js/mediaelement-and-player.min.js"></script>
<script src="js/mediaelement-playlist-plugin.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.9.1/sweetalert2.min.js"></script>
<script src="js/simpleUpload.min.js"></script>
<script src="js/charte.js"></script>
<script src="js/account.js"></script>

<script>
	$(function(){
		
	})
</script>