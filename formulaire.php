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
	$pass = $_POST['newPassword'];
	$mail = $_POST['mailNewPassword'];
	$query_insert_user = $bdd->prepare("UPDATE user SET mdp = ? where email = ?");
	$query_insert_user->bindParam(1, $pass);
	$query_insert_user->bindParam(2, $mail);
	$query_insert_user->execute();
	echo ;
}
