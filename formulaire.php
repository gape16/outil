<?php
include('connexion_session.php');



if (isset($_POST['jobUser'])) {
	$job = $_POST['jobUser'];
	$query_test_code = $bdd->prepare("SELECT code FROM statut WHERE id_statut = :code");
	$query_test_code->bindParam(':code', $job);
	$query_test_code->execute();
	$test_code = $query_test_code->fetch();
	echo $test_code["code"];
}

if (isset($_POST['idForgot'])) {
	$mail=$_POST['idForgot'];
	$code = substr(md5(rand()),0,5);
	$query_insert_user = $bdd->prepare("UPDATE user SET token = ? where email = ?");
	$query_insert_user->bindParam(1, $code);
	$query_insert_user->bindParam(2, $mail);
	$query_insert_user->execute();
 	//envoi du mail de récupération
	$to      = $mail;
	$subject = 'Récupération mot de passe';
	$message = 'Bonjour, Vous avez demandé le renouvellement de mot de passe suite à un oubli ! <br>Voici le code à fournir lors de la vérification:'.$code;
	$headers = 'From: info@example.com' . "\r\n" .
	'Reply-To: info@example.com' . "\r\n" .
	'X-Mailer: PHP/' . phpversion();

	// mail($to, $subject, $message, $headers);
	echo $code;
}

if (isset($_POST['newPassword'])) {
	$pass = password_hash($_POST['newPassword'], PASSWORD_DEFAULT);
	$mail = $_POST['mailNewPassword'];
	$query_insert_user = $bdd->prepare("UPDATE user SET mdp = ? where email = ?");
	$query_insert_user->bindParam(1, $pass);
	$query_insert_user->bindParam(2, $mail);
	$query_insert_user->execute();
}

if (isset($_POST['numClient'])) {
	$numClient=$_POST['numClient'];
	$date = date('Y-m-d H:i:s');
	$raisonSociale=$_POST['raisonSociale'];
	$dateRetourMaquette=NULL;
	$dateRetourCq=NULL;
	$idGraphMaquette=0;
	$idControleurMaquette=0;
	$idGraphCq=0;
	$idControleurCq=0;
	$idEtat=1;
	$adresseCms=$_POST['adresseCms'];
	//test savoir si client existe déjà ou non
	$query_test_client = $bdd->prepare("SELECT id_client FROM client where num_client = ? and lien_CMS = ?");
	$query_test_client->bindParam(1, $numClient);
	$query_test_client->bindParam(2, $adresseCms);
	$query_test_client->execute();
	$test_client= $query_test_client->fetch();
	$nb_client=$query_test_client->rowCount();
	echo $nb_client;
	if($nb_client==0){
		//création du client
		$query_ins_client = $bdd->prepare("INSERT INTO client (num_client, date_integration, raison_social, date_retour_maquette, date_retour_cq, id_graph_maquette, id_controleur_maquette, id_graph_cq, id_controleur_cq, id_etat, lien_CMS) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ? ,?)");
		$query_ins_client->bindParam(1, $numClient);
		$query_ins_client->bindParam(2, $date);
		$query_ins_client->bindParam(3, $raisonSociale);
		$query_ins_client->bindParam(4, $dateRetourMaquette);
		$query_ins_client->bindParam(5, $dateRetourCq);
		$query_ins_client->bindParam(6, $idGraphMaquette);
		$query_ins_client->bindParam(7, $idControleurMaquette);
		$query_ins_client->bindParam(8, $idGraphCq);
		$query_ins_client->bindParam(9, $idControleurCq);
		$query_ins_client->bindParam(10, $idEtat);
		$query_ins_client->bindParam(11, $adresseCms);
		$query_ins_client->execute();
		$new_card= '<div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-6">';
		$new_card.='<div class="ui-block" data-mh="friend-groups-item" style="height: 396px;">';
		$new_card.='<div class="friend-item friend-groups">';
		$new_card.='<div class="friend-item-content">';
		$new_card.='<div class="more">';
		$new_card.='<svg class="olymp-three-dots-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="icons/icons.svg#olymp-three-dots-icon"></use></svg>';
		$new_card.='<ul class="more-dropdown">';
		$new_card.='<li>';
		$new_card.='<a href="#">Report Profile</a>';
		$new_card.='</li>';
		$new_card.='<li>';
		$new_card.='<a href="#">Block Profile</a>';
		$new_card.='					</li>';
		$new_card.='					<li>';
		$new_card.='						<a href="#">Turn Off Notifications</a>';
		$new_card.='					</li>';
		$new_card.='				</ul>';
		$new_card.='			</div>';
		$new_card.='			<div class="friend-avatar">';
		$new_card.='				<div class="author-thumb">';
		$new_card.='					<img src="img/logo.png" alt="Olympus">';
		$new_card.='				</div>';
		$new_card.='				<div class="author-content">';
		$new_card.='					<a href="#" class="h5 author-name">My Family</a>';
		$new_card.='					<div class="country">6 Friends in the Group</div>';
		$new_card.='				</div>';
		$new_card.='			</div>';

		$new_card.='			<ul class="friends-harmonic">';
		$new_card.='				<li>';
		$new_card.='					<a href="#">';
		$new_card.='						<img src="img/friend-harmonic5.jpg" alt="friend">';
		$new_card.='					</a>';
		$new_card.='				</li>';
		$new_card.='				<li>';
		$new_card.='					<a href="#">';
		$new_card.='						<img src="img/friend-harmonic10.jpg" alt="friend">';
		$new_card.='					</a>';
		$new_card.='				</li>';
		$new_card.='				<li>';
		$new_card.='					<a href="#">';
		$new_card.='						<img src="img/friend-harmonic7.jpg" alt="friend">';
		$new_card.='					</a>';
		$new_card.='				</li>';
		$new_card.='				<li>';
		$new_card.='					<a href="#">';
		$new_card.='						<img src="img/friend-harmonic8.jpg" alt="friend">';
		$new_card.='					</a>';
		$new_card.='				</li>';	
		$new_card.='			</ul>';
		$new_card.='<div class="control-block-button">';
		$new_card.='				<a href="#" class="  btn btn-control bg-blue" data-toggle="modal" data-target="#create-friend-group-add-friends">';
		$new_card.='					<svg class="olymp-happy-faces-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="icons/icons.svg#olymp-happy-faces-icon"></use></svg>';
		$new_card.='				</a>';

		$new_card.='				<a href="#" class="btn btn-control btn-grey-lighter">';
		$new_card.='					<svg class="olymp-settings-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="icons/icons.svg#olymp-settings-icon"></use></svg>';
		$new_card.='				</a>';

		$new_card.='			</div>';
		$new_card.='		</div>';
		$new_card.='	</div>';
		$new_card.='</div>';
		$new_card.='</div>';
		// echo $new_card;
		// echo "non existant";
	}else{
		//refus de création
		// echo "existant";
	}
}