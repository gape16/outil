<?php
include('connexion_session.php');


if(isset($_POST['achat_client'])){
	$id_client=$_POST['achat_client'];
	$id_achat=$_POST['achat'];
	$lien_wetrans=$_POST['lien_wetrans'];
	$commentaire_achat=utf8_decode($_POST['commentaire_achat']);
	$etat_achat=$_POST['etat_achat'];
	$id_control=$_SESSION['id_graph'];
	$query_update_achat = $bdd->prepare("UPDATE achat_photos SET id_etat_achat = ?, id_controleur = ?, commentaire_controleur = ?, lien_we = ? where id_achat = ?");
	$query_update_achat->bindParam(1, $etat_achat);
	$query_update_achat->bindParam(2, $id_control);
	$query_update_achat->bindParam(3, $commentaire_achat);
	$query_update_achat->bindParam(4, $lien_wetrans);
	$query_update_achat->bindParam(5, $id_achat);
	$query_update_achat->execute();
	// echo "UPDATE achat_photos SET id_etat_achat = $etat_achat, id_controleur = $id_control, commentaire_controleur = $commentaire_achat, lien_we = $lien_wetrans where id_achat = $id_achat";
}

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

	mail($to, $subject, $message, $headers);
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
	$idGraphMaquette=$_SESSION['id_graph'];
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
	// echo $nb_cligitteent;
	if($nb_client==0){
		//création du client
		// echo "INSERT INTO client (num_client, date_integration, raison_social, date_retour_maquette, date_retour_cq, id_graph_maquette, id_controleur_maquette, id_graph_cq, id_controleur_cq, id_etat, lien_CMS) VALUES ('$numClient', '$date', '$raisonSociale', '$dateRetourMaquette', '$dateRetourCq', '$idGraphMaquette', '$idControleurMaquette', '$idGraphCq', '$idControleurCq', '$idEtat' ,'$adresseCms')";
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
		$new_card.='<div class="ui-block" data-mh="friend-groups-item">';
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
		$new_card.='					<img src="img/crea_maquette.png" alt="Olympus">';
		$new_card.='				</div>';
		$new_card.='				<div class="author-content">';
		$new_card.='					<a href="#" class="h5 author-name">'.$raisonSociale.'</a>';
		$new_card.='					<div class="country">'.$numClient.'</div>';
		$new_card.='				</div>';
		$new_card.='			</div>';

		$new_card.='			<ul class="friends-harmonic">';
		$new_card.='				<li>';
		$new_card.='					<a href="#">';
		$new_card.='						<img src="img/friend-harmonic5.jpg" alt="friend">';
		$new_card.='					</a>';
		$new_card.='				</li>';
		$new_card.='			</ul>';
		$new_card.='<div class="control-block-button">';
		$new_card.='				<a href="'.$adresseCms.'" class="  btn btn-control bg-blue">';
		$new_card.='					<svg class="olymp-happy-faces-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="icons/icons.svg#olymp-happy-faces-icon"></use></svg>';
		$new_card.='				</a>';

		$new_card.='				<a href="check.php" class="btn btn-control btn-grey-lighter">';
		$new_card.='					<svg class="olymp-settings-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="icons/icons.svg#olymp-settings-icon"></use></svg>';
		$new_card.='				</a>';

		$new_card.='			</div>';
		$new_card.='		</div>';
		$new_card.='	</div>';
		$new_card.='</div>';
		$new_card.='</div>';
		echo $new_card;
		// echo "non existant";
	}else{
		//refus de création
		echo "existant";
	}
}

if (isset($_POST['categorie'])) {
	$categorie=utf8_decode($_POST['categorie']);
	$lien=$_POST['lien'];
	$id_client=$_POST['id_client'];
	$date_achat=$date=date('Y-m-d H:i:s');
	$id_etat_achat=1;
	$id_controleur=0;
	$id_graph=$_SESSION['id_graph'];
	$commentaire_controleur="";
	$lien_we="";
	$query_ins_achat=$bdd->prepare("INSERT INTO achat_photos (categorie, id_client, lien, date_achat, id_graph, id_etat_achat, id_controleur, commentaire_controleur, lien_we) VALUES (?,?,?,?,?,?,?,?,?)");
	$query_ins_achat->bindParam(1, $categorie);
	$query_ins_achat->bindParam(2, $id_client);
	$query_ins_achat->bindParam(3, $lien);
	$query_ins_achat->bindParam(4, $date_achat);
	$query_ins_achat->bindParam(5, $id_graph);
	$query_ins_achat->bindParam(6, $id_etat_achat);
	$query_ins_achat->bindParam(7, $id_controleur);
	$query_ins_achat->bindParam(8, $commentaire_controleur);
	$query_ins_achat->bindParam(9, $lien_we);
	$query_ins_achat->execute();
}

if (isset($_POST['aide'])) {
	$titre=utf8_decode($_POST['titre']);
	$descriptionProblem=utf8_decode($_POST['descriptionProblem']);
	$cms=$_POST['adresse_aide'];
	$capture_arr=$_POST['capture'];
	$capture="";
	$i=0;
	foreach ($capture_arr as $key => $value) {
		if ($i!=0) {
			$capture.=";";
		}
		$capture.=$value;
		$i++;
	}
	$id_etat_aide=1;
	$id_client=$_POST['aide'];
	$date_aide=$date=date('Y-m-d H:i:s');
	$id_graph=$_SESSION['id_graph'];
	$query_ins_aide=$bdd->prepare("INSERT INTO aide (id_client, adresse_cms, titre, description, date_aide, id_user, id_etat_aide, capture) VALUES (?,?,?,?,?,?,?,?)");
	$query_ins_aide->bindParam(1, $id_client);
	$query_ins_aide->bindParam(2, $cms);
	$query_ins_aide->bindParam(3, $titre);
	$query_ins_aide->bindParam(4, $descriptionProblem);
	$query_ins_aide->bindParam(5, $date_aide);
	$query_ins_aide->bindParam(6, $id_graph);
	$query_ins_aide->bindParam(7, $id_etat_aide);
	$query_ins_aide->bindParam(8, $capture);
	$query_ins_aide->execute();
	// echo $query_ins_aide->debugDumpParams();
	// echo "INSERT INTO aide (id_client, adresse_cms, description, date_aide, id_user, id_etat_aide, capture) VALUES ('$id_client','$cms','$descriptionProblem','$date_aide','$id_graph','$id_etat_aide','$capture')";
}