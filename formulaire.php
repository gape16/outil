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
		echo "INSERT INTO client (num_client, date_integration, raison_social, date_retour_maquette, date_retour_cq, id_graph_maquette, id_controleur_maquette, id_graph_cq, id_controleur_cq, id_etat, lien_CMS) VALUES ('$numClient', '$date', '$raisonSociale', '$dateRetourMaquette', '$dateRetourCq', '$idGraphMaquette', '$idControleurMaquette', '$idGraphCq', '$idControleurCq', '$idEtat' ,'$adresseCms')";
		// echo "non existant";
	}else{
		//refus de création
		echo "existant";
	}
}