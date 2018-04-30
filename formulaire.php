<?php
include('connexion_session.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'src/PHPMailer.php';
require 'src/SMTP.php';
require 'src/Exception.php';


// truncate string at word
function shapeSpace_truncate_string_at_word($string, $limit, $break = " ", $pad = "...") {

	if (strlen($string) <= $limit) return $string;

	if (false !== ($max = strpos($string, $break, $limit))) {
		if ($max < strlen($string) - 1) {

			$string = substr($string, 0, $max) . $pad;

		}

	}

	return $string;

}

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

if(isset($_POST['email_first'])){
	$email_first=$_POST['email_first'];
	$token_first=$_POST['token_first'];
	$query_first=$bdd->prepare("SELECT token FROM user where email = ?");
	$query_first->bindParam(1, $email_first);
	$query_first->execute();
	$first=$query_first->fetch();
	if($query_first->rowCount()==0){
		echo "email introuvable";
	}else{
		if($first['token']!=$token_first){
			echo "Code invalide";
		}else{
			echo "ok";
		}
	}
}
if(isset($_POST['email_first_mdp'])){
	$email_first=$_POST['email_first_mdp'];
	$token_first=$_POST['token_first'];
	$mdp=password_hash($_POST['mdp1'], PASSWORD_DEFAULT);
	$query_first=$bdd->prepare("UPDATE user set mdp = ?, token = '' where email = ?");
	$query_first->bindParam(1, $mdp);
	$query_first->bindParam(2, $email_first);
	$query_first->execute();
}
if(isset($_POST['achat_client'])){
	$id_client=$_POST['achat_client'];
	$id_achat=$_POST['achat'];
	$lien_wetrans=$_POST['lien_wetrans'];
	$commentaire_achat=utf8_decode($_POST['commentaire_achat']);
	$etat_achat=$_POST['etat_achat'];
	$id_control=$_COOKIE['id_graph'];
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
	$email=$_POST['idForgot'];
	$query_test_mail=$bdd->prepare("SELECT * FROM user where email = ?");
	$query_test_mail->bindParam(1, $email);
	$query_test_mail->execute();
	$nb_mail = $query_test_mail->rowCount();
	$code = substr(md5(rand()),0,5);
	$query_insert_user = $bdd->prepare("UPDATE user SET token = ? where email = ?");
	$query_insert_user->bindParam(1, $code);
	$query_insert_user->bindParam(2, $email);
	$query_insert_user->execute();
	if($nb_mail > 0){
		$mail = new PHPMailer(true);                             
		try {
			$mail->SMTPDebug = 0;                                 
			$mail->isSMTP();                                      
			$mail->Host = 'solocalms-fr.mail.protection.outlook.com';  
			$mail->SMTPAuth = false;                               
			$mail->Username = 'gaylord.petit@solocalms.fr';              
			$mail->Password = 'fripon02!!!';                        
			$mail->SMTPSecure = 'tls';                           
			$mail->Port = 25;                                    

			$mail->setFrom('gaylord.petit@solocalms.fr', 'Gaylord PETIT');
			$mail->addAddress($email);    
			$mail->addReplyTo('gaylord.petit@solocalms.fr');

			$mail->isHTML(true);                                  
			$mail->Subject = utf8_decode('Récupération mot de passe');
			$mail->Body    = utf8_decode('Bonjour, Vous avez demandé le renouvellement de mot de passe suite à un oubli ! <br>Voici le code à fournir lors de la vérification:'.$code);
			$mail->send();
		} catch (Exception $e) {

		}
		echo $code;
	}
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
	$raisonSociale=utf8_decode($_POST['raisonSociale']);
	$dateRetourMaquette=NULL;
	$dateRetourCq=NULL;
	$idGraphMaquette=$_COOKIE['id_graph'];
	$idControleurMaquette=0;
	$idGraphCq=0;
	$idControleurCq=0;
	$idEtat=1;
	$adresseCms=utf8_decode($_POST['adresseCms']);
	$soprod=utf8_decode($_POST['soprod']);
	$exploded=explode('cms.site-privilege.pagesjaunes.fr/workflow/service/', $adresseCms);
	$idgpp= end($exploded);
	$idgpp = rtrim($idgpp, '/');
	//test savoir si client existe déjà ou non
	$query_test_client = $bdd->prepare("SELECT id_client FROM client where IDGPP = ?");
	$query_test_client->bindParam(1, $idgpp);
	$query_test_client->execute();
	$test_client= $query_test_client->fetch();
	$nb_client=$query_test_client->rowCount();
	// echo $nb_cligitteent;
	if($nb_client==0){
		//création du client
		// echo "INSERT INTO client (num_client, date_integration, raison_social, date_retour_maquette, date_retour_cq, id_graph_maquette, id_controleur_maquette, id_graph_cq, id_controleur_cq, id_etat, lien_CMS) VALUES ('$numClient', '$date', '$raisonSociale', '$dateRetourMaquette', '$dateRetourCq', '$idGraphMaquette', '$idControleurMaquette', '$idGraphCq', '$idControleurCq', '$idEtat' ,'$adresseCms')";
		$query_ins_client = $bdd->prepare("INSERT INTO client (num_client, date_integration, raison_social, date_retour_maquette, date_retour_cq, id_graph_maquette, id_controleur_maquette, id_graph_cq, id_controleur_cq, id_etat, lien_CMS, IDGPP, envoi_maquette, soprod) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ? ,?, ?, ?, ?)");
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
		$query_ins_client->bindParam(12, $idgpp);
		$query_ins_client->bindParam(13, $idGraphMaquette);
		$query_ins_client->bindParam(14, $soprod);
		$query_ins_client->execute();
		$class_etat="crea-maquette";
		$new_card="";
		$class_img="img/Crea-maquette.png";
		$new_card.='<div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-6">';
		$new_card.='	<div class="ui-block hauteur-card" data-mh="friend-groups-item">';
		$new_card.='		<div class="friend-item friend-groups '.$class_etat.'">';
		$new_card.='			<div class="friend-item-content">';
		$new_card.='				<div class="friend-avatar entete-card">';
		$new_card.='					<div class="author-thumb etat-card">';
		$new_card.='						<img src="'.$class_img.'" alt="Olympus">';
		$new_card.='					</div>';
		$new_card.='					<div class="author-content texte-card">';
		$new_card.='						<a href="#" class="h5 author-name">'.utf8_encode($raisonSociale).'</a>';
		$new_card.='						<div class="country">'.$numClient.'</div>';
		$new_card.='					</div>';
		$new_card.='				</div>';
		$new_card.='				<div class="control-block-button bouton-check">';
		$new_card.='					<a href="'.utf8_encode($adresseCms).'" target="_blank" class="  btn btn-control bg-blue bouton-icone1">';
		$new_card.='						<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="35%" version="1.1" height="35%" viewBox="0 0 64 64" enable-background="new 0 0 64 64">';
		$new_card.='							<path d="m60.135,3.875c-5.156-5.166-13.545-5.168-18.697,0l-11.576,11.619c-0.788,0.791-0.788,2.074 0,2.865 0.79,0.792 2.067,0.792 2.856,0l11.576-11.618c3.578-3.589 9.401-3.587 12.984,0 3.578,3.591 3.578,9.435 0,13.024l-15.292,15.339c-1.732,1.739-4.038,2.697-6.49,2.697-2.451,0-4.758-0.959-6.492-2.697-0.789-0.792-2.067-0.792-2.857,0-0.788,0.791-0.788,2.074 0,2.865 2.499,2.505 5.818,3.885 9.35,3.885s6.848-1.381 9.347-3.885l15.292-15.338c5.152-5.17 5.152-13.584-0.001-18.756z" fill="#FFFFFF"/>';
		$new_card.='							<path d="m31.015,45.904l-11.312,11.346c-1.732,1.739-4.039,2.697-6.491,2.697-2.451,0-4.759-0.958-6.489-2.697-3.578-3.591-3.578-9.434 0-13.023l15.289-15.338c3.582-3.588 9.406-3.588 12.983,0 0.789,0.793 2.067,0.793 2.856,0 0.789-0.791 0.789-2.072 0-2.864-5.152-5.17-13.541-5.17-18.697,0l-15.288,15.336c-5.155,5.17-5.155,13.584 4.44089e-16,18.754 2.497,2.506 5.816,3.885 9.346,3.885 3.531,0 6.853-1.379 9.348-3.885l11.31-11.345c0.79-0.791 0.79-2.074 0-2.865-0.788-0.792-2.067-0.792-2.855-0.001z" fill="#FFFFFF"/>';
		$new_card.='						</svg>';
		$new_card.='					</a>';
		$new_card.='					<a href="check.php?idgpp='.utf8_encode($idgpp).'" class="btn btn-control btn-grey-lighter bouton-icone2">';
		$new_card.='						<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" width="35%" height="35%" viewBox="0 0 394.893 394.893" style="enable-background:new 0 0 394.893 394.893;" xml:space="preserve">';
		$new_card.='							<path d="M344.426,191.963c-6.904,0-12.5,5.597-12.5,12.5V350.91H25V43.982h246.57c6.904,0,12.5-5.597,12.5-12.5    c0-6.903-5.596-12.5-12.5-12.5H12.5c-6.903,0-12.5,5.597-12.5,12.5V363.41c0,6.903,5.597,12.5,12.5,12.5h331.926    c6.902,0,12.5-5.597,12.5-12.5V204.463C356.926,197.56,351.33,191.963,344.426,191.963z" fill="#FFFFFF"/>';
		$new_card.='							<path d="M391.23,27.204c-4.881-4.881-12.795-4.881-17.678,0L169.957,230.801l-50.584-50.584c-4.882-4.881-12.796-4.881-17.678,0    c-4.881,4.882-4.881,12.796,0,17.678l59.423,59.423c2.441,2.44,5.64,3.661,8.839,3.661c3.199,0,6.398-1.221,8.839-3.661    L391.23,44.882C396.113,40,396.113,32.086,391.23,27.204z" fill="#FFFFFF"/>';
		$new_card.='						</svg>';
		$new_card.='					</a>';
		$new_card.='				</div>';
		$new_card.='			</div>';
		$new_card.='		</div>';
		$new_card.='	</div>';
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
	$id_graph=$_COOKIE['id_graph'];
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
	$token=$_POST['token'];
	$capture_arr=$_POST['capture'];
	$capture="";
	$i=0;
	foreach ($capture_arr as $key => $value) {
		if ($i!=0) {
			$capture.=";";
		}
		$capture.=$token.$value;
		$i++;
	}
	$id_etat_aide=1;
	$id_client=$_POST['aide'];
	$code = $_POST['code'];
	$best_answer = NULL;
	$categorie = $_POST['categorie'];
	$date_aide=$date=date('Y-m-d H:i:s');
	$id_graph=$_COOKIE['id_graph'];
	$query_ins_aide=$bdd->prepare("INSERT INTO aide (id_client, adresse_cms, titre, description, date_aide, id_user, id_etat_aide, capture, code_aide, categorie, id_meilleure_reponse) VALUES (?,?,?,?,?,?,?,?,?, ?, ?)");
	$query_ins_aide->bindParam(1, $id_client);
	$query_ins_aide->bindParam(2, $cms);
	$query_ins_aide->bindParam(3, $titre);
	$query_ins_aide->bindParam(4, $descriptionProblem);
	$query_ins_aide->bindParam(5, $date_aide);
	$query_ins_aide->bindParam(6, $id_graph);
	$query_ins_aide->bindParam(7, $id_etat_aide);
	$query_ins_aide->bindParam(8, $capture);
	$query_ins_aide->bindParam(9, $code);
	$query_ins_aide->bindParam(10, $categorie);
	$query_ins_aide->bindParam(11, $best_answer);
	$query_ins_aide->execute();
// echo $query_ins_aide->debugDumpParams();
// echo "INSERT INTO aide (id_client, adresse_cms, description, date_aide, id_user, id_etat_aide, capture) VALUES ('$id_client','$cms','$descriptionProblem','$date_aide','$id_graph','$id_etat_aide','$capture')";
}
if(isset($_POST['popup_aide'])){
	$id_aide=$_POST['popup_aide'];
	$tab=array();
	$query_popup_aide = $bdd->prepare("SELECT * FROM aide inner join user on aide.id_user=user.id_user inner join etat_aide on aide.id_etat_aide = etat_aide.id_etat_aide where id_aide = ?");
	$query_popup_aide->bindParam(1, $id_aide);
	$query_popup_aide->execute();
	foreach ($query_popup_aide as $key => $value)
	{
		$tab[$key]['id_client'] = $value['id_client'];
		$tab[$key]['adresse_cms'] = $value['adresse_cms'];
		$tab[$key]['titre'] = utf8_encode($value['titre']);
		$tab[$key]['description'] = utf8_encode($value['description']);
		$tab[$key]['date_aide'] = time_elapsed_string($value['date_aide']);
		$tab[$key]['capture'] = utf8_encode($value['capture']);
		$tab[$key]['nom'] = utf8_encode($value['nom']);
		$tab[$key]['prenom'] = utf8_encode($value['prenom']);
		$tab[$key]['photo_avatar'] = $value['photo_avatar'];
		$tab[$key]['photo'] = $value['photo'];
		$tab[$key]['etat_aide'] = utf8_encode($value['etat_aide']);
		$tab[$key]['couleur'] = utf8_encode($value['couleur']);
	}
	$query_com_aide = $bdd->prepare("SELECT * FROM commentaires_aide inner join user on commentaires_aide.id_user=user.id_user where id_aide = ? order by like_com DESC");
	$query_com_aide->bindParam(1, $id_aide);
	$query_com_aide->execute();
	foreach ($query_com_aide as $key_com => $value_com)
	{
		$tab[$key_com+1]['nom_commentaire'] = utf8_encode($value_com['prenom']." ".$value_com['nom']);
		$tab[$key_com+1]['commentaire'] = utf8_encode($value_com['commentaire']);
		$tab[$key_com+1]['date_commentaire'] = time_elapsed_string($value_com['date_commentaire']);
		$tab[$key_com+1]['id_commentaires_aide'] = $value_com['id_commentaires_aide'];
		$tab[$key_com+1]['photo_avatar'] = '../'.$value_com['photo_avatar'];
		$tab[$key_com+1]['like'] = $value_com['like_com'];
		$query_sel_lik = $bdd->prepare("SELECT id_like from like_com where id_graph = ? and id_com = ?");
		$query_sel_lik->bindParam(1, $_COOKIE['id_graph']);
		$query_sel_lik->bindParam(2, $value_com['id_commentaires_aide']);
		$query_sel_lik->execute();
		$nb_lik = $query_sel_lik->rowCount();
		if($nb_lik ==0){
			$tab[$key_com+1]['like_test'] = "";
		}else{
			$tab[$key_com+1]['like_test'] = "style=\"fill: #ff5e3a;color: #ff5e3a;\"";
		}
	}
	print_r(json_encode($tab));
}
if (isset($_POST['envoi_com_aide'])) {
	$commentaire=utf8_decode($_POST['envoi_com_aide']);
	$id_graph=$_COOKIE['id_graph'];
	$id_aide = $_POST['id_aide_com'];
	$date_com=$date=date('Y-m-d H:i:s');
	$like=0;
	$tabf=array();
	$query_ins_com = $bdd->prepare("INSERT INTO commentaires_aide (id_aide, commentaire, id_user, date_commentaire, like_com) VALUES (?, ?, ?, ?, ?)");
	$query_ins_com->bindParam(1, $id_aide);
	$query_ins_com->bindParam(2, $commentaire);
	$query_ins_com->bindParam(3, $id_graph);
	$query_ins_com->bindParam(4, $date_com);
	$query_ins_com->bindParam(5, $like);
	$query_ins_com->execute();
	$query_com_aide = $bdd->prepare("SELECT * FROM commentaires_aide inner join user on commentaires_aide.id_user=user.id_user where id_aide = ? order by date_commentaire ASC");
	$query_com_aide->bindParam(1, $id_aide);
	$query_com_aide->execute();
	foreach ($query_com_aide as $key_com => $value_com)
	{
		$tabf[$key_com]['nom_commentaire'] = utf8_encode($value_com['prenom']." ".$value_com['nom']);
		$tabf[$key_com]['commentaire'] = utf8_encode($value_com['commentaire']);
		$tabf[$key_com]['date_commentaire'] = time_elapsed_string($value_com['date_commentaire']);
		$tabf[$key_com]['id_commentaires_aide'] = $value_com['id_commentaires_aide'];
		$tabf[$key_com]['photo'] = '../'.$value_com['photo'];
		$tabf[$key_com]['like'] = $value_com['like_com'];
		$query_sel_lik = $bdd->prepare("SELECT id_like from like_com where id_graph = ? and id_com = ?");
		$query_sel_lik->bindParam(1, $_COOKIE['id_graph']);
		$query_sel_lik->bindParam(2, $value_com['id_commentaires_aide']);
		$query_sel_lik->execute();
		$nb_lik = $query_sel_lik->rowCount();
		if($nb_lik ==0){
			$tabf[$key_com]['like_test'] = "";
		}else{
			$tabf[$key_com]['like_test'] = "style=\"fill: #ff5e3a;color: #ff5e3a;\"";
		}
	}
	print_r(json_encode($tabf));
}
if(isset($_POST['logOut'])){
	unset($_SESSION['id_statut']);
	unset($_SESSION['id_graph']);
	unset($_COOKIE['id_statut']);
	setcookie('id_statut', '', time() - 3600, '/');
	unset($_COOKIE['id_statut']);
	setcookie('id_statut', '', time() - 3600, '/');
}
if(isset($_POST['likelecommentaire'])){
	$id_com=$_POST['likelecommentaire'];
	$nb_like=$_POST['nb_like']+1;
	$id_graph=$_COOKIE['id_graph'];
	$query_sel_lik = $bdd->prepare("SELECT id_like from like_com where id_graph = ? and id_com = ?");
	$query_sel_lik->bindParam(1, $id_graph);
	$query_sel_lik->bindParam(2, $id_com);
	$query_sel_lik->execute();
	$nb_lik = $query_sel_lik->rowCount();
// echo $nb_lik;
	if($nb_lik ==0){
		$date_come=date('Y-m-d H:i:s');
		$query_ins_lik = $bdd->prepare("INSERT INTO like_com (id_graph, id_com, date_like_com) VALUES (?, ?,?)");
		$query_ins_lik->bindParam(1, $id_graph);
		$query_ins_lik->bindParam(2, $id_com);
		$query_ins_lik->bindParam(3, $date_come);
		$query_ins_lik->execute();
		echo "ok";
		$query_up_lik = $bdd->prepare("UPDATE commentaires_aide SET like_com = ? where id_commentaires_aide = ?");
		$query_up_lik->bindParam(1, $nb_like);
		$query_up_lik->bindParam(2, $id_com);
		$query_up_lik->execute();
	}
}
if(isset($_POST['likelaveille'])){
	$id_veille=$_POST['likelaveille'];
	$nb_like=$_POST['nb_like_veille']+1;
	$id_graph=$_COOKIE['id_graph'];
	$query_sel_lik = $bdd->prepare("SELECT id_like from like_veille where id_graph = ? and id_veille = ?");
	$query_sel_lik->bindParam(1, $id_graph);
	$query_sel_lik->bindParam(2, $id_veille);
	$query_sel_lik->execute();
	$nb_lik = $query_sel_lik->rowCount();
// echo $nb_lik;
	if($nb_lik ==0){
		$date_veil=date('Y-m-d H:i:s');
		$query_ins_lik = $bdd->prepare("INSERT INTO like_veille (id_graph, id_veille,date_like_veille) VALUES (?, ?,?)");
		$query_ins_lik->bindParam(1, $id_graph);
		$query_ins_lik->bindParam(2, $id_veille);
		$query_ins_lik->bindParam(3, $date_veil);
		$query_ins_lik->execute();
		echo "ok";
		$query_up_lik = $bdd->prepare("UPDATE veille SET like_veille = ? where id_veille = ?");
		$query_up_lik->bindParam(1, $nb_like);
		$query_up_lik->bindParam(2, $id_veille);
		$query_up_lik->execute();
	}
}
if (isset($_POST['id_timer_aide'])) {
	$id_aide=$_POST['id_timer_aide'];
	$id_com=$_POST['id_timer_com'];
	$query_com_aide = $bdd->prepare("SELECT * FROM commentaires_aide inner join user on commentaires_aide.id_user=user.id_user where id_aide = ? and id_commentaires_aide > ? order by date_commentaire ASC");
	$query_com_aide->bindParam(1, $id_aide);
	$query_com_aide->bindParam(2, $id_com);
	$query_com_aide->execute();
	$tabf=array();
	foreach ($query_com_aide as $key_com => $value_com)
	{
		$tabf[$key_com]['nom_commentaire'] = utf8_encode($value_com['prenom']." ".$value_com['nom']);
		$tabf[$key_com]['commentaire'] = utf8_encode($value_com['commentaire']);
		$tabf[$key_com]['date_commentaire'] = time_elapsed_string($value_com['date_commentaire']);
		$tabf[$key_com]['id_commentaires_aide'] = $value_com['id_commentaires_aide'];
		$tabf[$key_com]['photo_avatar'] = $value_com['photo_avatar'];
		$tabf[$key_com]['like'] = $value_com['like_com'];
		$query_sel_lik = $bdd->prepare("SELECT id_like from like_com where id_graph = ? and id_com = ?");
		$query_sel_lik->bindParam(1, $_COOKIE['id_graph']);
		$query_sel_lik->bindParam(2, $value_com['id_commentaires_aide']);
		$query_sel_lik->execute();
		$nb_lik = $query_sel_lik->rowCount();
		if($nb_lik ==0){
			$tabf[$key_com]['like_test'] = "";
		}else{
			$tabf[$key_com]['like_test'] = "style=\"fill: #ff5e3a;color: #ff5e3a;\"";
		}
	}
	print_r(json_encode($tabf));
}
if (isset($_POST['changement_etat_id_ok'])) {
	$etat=2;
	$id_aide=$_POST['changement_etat_id_ok'];
	$query_up_aide_etat = $bdd->prepare("UPDATE aide SET id_etat_aide = ? where id_aide = ?");
	$query_up_aide_etat->bindParam(1, $etat);
	$query_up_aide_etat->bindParam(2, $id_aide);
	$query_up_aide_etat->execute();
}
if (isset($_POST['changement_etat_id_cours'])) {
	$etat=1;
	$id_aide=$_POST['changement_etat_id_cours'];
	$query_up_aide_etat = $bdd->prepare("UPDATE aide SET id_etat_aide = ? where id_aide = ?");
	$query_up_aide_etat->bindParam(1, $etat);
	$query_up_aide_etat->bindParam(2, $id_aide);
	$query_up_aide_etat->execute();
}
if (isset($_POST['changement_etat_id_non'])) {
	$etat=3;
	$id_aide=$_POST['changement_etat_id_non'];
	$query_up_aide_etat = $bdd->prepare("UPDATE aide SET id_etat_aide = ? where id_aide = ?");
	$query_up_aide_etat->bindParam(1, $etat);
	$query_up_aide_etat->bindParam(2, $id_aide);
	$query_up_aide_etat->execute();
}
if (isset($_POST['idGpp'])){
	$idGpp = utf8_decode($_POST['idGpp']);
	$valueCheck = $_POST['valueCheck'];
	$idCheck = $_POST['idCheck'];
	$etatFinal = $_POST['etatFinal'];
	$id_graph=$_COOKIE['id_graph'];
	$com_contr=$_POST['com_contr'];
	$com_graph=$_POST['com_graph'];
	$date = date('Y-m-d H:i:s');
	$envoi=$_POST['envoi'];
	$pret=$id_graph;
	if($etatFinal > 1 && $etatFinal < 4){
		if($etatFinal == 2 && $envoi=="ok"){
			$date_stat=date("Y-m-d");
			$query_stat_control=$bdd->prepare("SELECT nb_validation_maquette FROM stat_controle where date_stat_control = ? and id_controleur = ?");
			$query_stat_control->bindParam(1, $date_stat);
			$query_stat_control->bindParam(2, $id_graph);
			$query_stat_control->execute();
			$nb_stat=$query_stat_control->rowCount();
			$result_stat=$query_stat_control->fetch();
			$zero=0;
			$un=1;
			$new_stat=$result_stat['nb_validation_maquette'] + 1;
			if($nb_stat==0){
				$query_ins_stat_control=$bdd->prepare("INSERT INTO stat_controle (date_stat_control, id_controleur, nb_validation_maquette, nb_retour_maquette, nb_validation_cq, nb_retour_cq) VALUES (?,?,?,?,?,?)");
				$query_ins_stat_control->bindParam(1, $date_stat);
				$query_ins_stat_control->bindParam(2, $id_graph);
				$query_ins_stat_control->bindParam(3, $un);
				$query_ins_stat_control->bindParam(4, $zero);
				$query_ins_stat_control->bindParam(5, $zero);
				$query_ins_stat_control->bindParam(6, $zero);
				$query_ins_stat_control->execute();
			}else{
				$query_ins_stat_control=$bdd->prepare("UPDATE stat_controle SET nb_validation_maquette = ? where  date_stat_control = ? and id_controleur = ?");
				$query_ins_stat_control->bindParam(1, $new_stat);
				$query_ins_stat_control->bindParam(2, $date_stat);
				$query_ins_stat_control->bindParam(3, $id_graph);
				$query_ins_stat_control->execute();
			}
		}elseif($etatFinal == 2 && $envoi=="retour"){
			$date_stat=date("Y-m-d");
			$query_stat_control=$bdd->prepare("SELECT nb_retour_maquette FROM stat_controle where date_stat_control = ? and id_controleur = ?");
			$query_stat_control->bindParam(1, $date_stat);
			$query_stat_control->bindParam(2, $id_graph);
			$query_stat_control->execute();
			$nb_stat=$query_stat_control->rowCount();
			$result_stat=$query_stat_control->fetch();
			$zero=0;
			$un='1';
			$new_stat=$result_stat['nb_retour_maquette'] + 1;
			if($nb_stat==0){
				$query_ins_stat_control=$bdd->prepare("INSERT INTO stat_controle (date_stat_control, id_controleur, nb_validation_maquette, nb_retour_maquette, nb_validation_cq, nb_retour_cq) VALUES (?,?,?,?,?,?)");
				$query_ins_stat_control->bindParam(1, $date_stat);
				$query_ins_stat_control->bindParam(2, $id_graph);
				$query_ins_stat_control->bindParam(3, $zero);
				$query_ins_stat_control->bindParam(4, $un);
				$query_ins_stat_control->bindParam(5, $zero);
				$query_ins_stat_control->bindParam(6, $zero);
				$query_ins_stat_control->execute();
			}else{
				$query_ins_stat_control=$bdd->prepare("UPDATE stat_controle SET nb_retour_maquette = ? where date_stat_control = ? and id_controleur = ?");
				$query_ins_stat_control->bindParam(1, $new_stat);
				$query_ins_stat_control->bindParam(2, $date_stat);
				$query_ins_stat_control->bindParam(3, $id_graph);
				$query_ins_stat_control->execute();
			}
		}
	}elseif ($etatFinal > 4 && $etatFinal < 7) {
		if($etatFinal == 5 && $envoi=="ok"){
			$date_stat=date("Y-m-d");
			$query_stat_control=$bdd->prepare("SELECT nb_validation_cq FROM stat_controle where date_stat_control = ? and id_controleur = ?");
			$query_stat_control->bindParam(1, $date_stat);
			$query_stat_control->bindParam(2, $id_graph);
			$query_stat_control->execute();
			$nb_stat=$query_stat_control->rowCount();
			$result_stat=$query_stat_control->fetch();
			$zero=0;
			$un=1;
			$new_stat=$result_stat['nb_validation_cq'] + 1;
			if($nb_stat==0){
				$query_ins_stat_control=$bdd->prepare("INSERT INTO stat_controle (date_stat_control, id_controleur, nb_validation_maquette, nb_retour_maquette, nb_validation_cq, nb_retour_cq) VALUES (?,?,?,?,?,?)");
				$query_ins_stat_control->bindParam(1, $date_stat);
				$query_ins_stat_control->bindParam(2, $id_graph);
				$query_ins_stat_control->bindParam(3, $un);
				$query_ins_stat_control->bindParam(4, $zero);
				$query_ins_stat_control->bindParam(5, $zero);
				$query_ins_stat_control->bindParam(6, $zero);
				$query_ins_stat_control->execute();
			}else{
				$query_ins_stat_control=$bdd->prepare("UPDATE stat_controle SET nb_validation_cq = ? where date_stat_control = ? and id_controleur = ?");
				$query_ins_stat_control->bindParam(1, $new_stat);
				$query_ins_stat_control->bindParam(2, $date_stat);
				$query_ins_stat_control->bindParam(3, $id_graph);
				$query_ins_stat_control->execute();
			}
		}elseif($etatFinal == 5 && $envoi=="retour"){
			$date_stat=date("Y-m-d");
			$query_stat_control=$bdd->prepare("SELECT nb_retour_cq FROM stat_controle where date_stat_control = ? and id_controleur = ?");
			$query_stat_control->bindParam(1, $date_stat);
			$query_stat_control->bindParam(2, $id_graph);
			$query_stat_control->execute();
			$nb_stat=$query_stat_control->rowCount();
			$result_stat=$query_stat_control->fetch();
			$zero=0;
			$un=1;
			$new_stat=$result_stat['nb_retour_cq'] + 1;
			if($nb_stat==0){
				$query_ins_stat_control=$bdd->prepare("INSERT INTO stat_controle (date_stat_control, id_controleur, nb_validation_maquette, nb_retour_maquette, nb_validation_cq, nb_retour_cq) VALUES (?,?,?,?,?,?)");
				$query_ins_stat_control->bindParam(1, $date_stat);
				$query_ins_stat_control->bindParam(2, $id_graph);
				$query_ins_stat_control->bindParam(3, $un);
				$query_ins_stat_control->bindParam(4, $zero);
				$query_ins_stat_control->bindParam(5, $zero);
				$query_ins_stat_control->bindParam(6, $zero);
				$query_ins_stat_control->execute();
			}else{
				$query_ins_stat_control=$bdd->prepare("UPDATE stat_controle SET nb_retour_cq = ? where  date_stat_control = ? and id_controleur = ?");
				$query_ins_stat_control->bindParam(1, $new_stat);
				$query_ins_stat_control->bindParam(2, $date_stat);
				$query_ins_stat_control->bindParam(3, $id_graph);
				$query_ins_stat_control->execute();
			}
		}
	}
	foreach ($valueCheck as $key => $value) {
		$commentaire_controleur=utf8_decode($com_contr[$key]);
		$commentaire_graph=utf8_decode($com_graph[$key]);
		$query_test_checked=$bdd->prepare("SELECT id_controle FROM controle WHERE id_check = ? and id_gpp = ?");
		$query_test_checked->bindParam(1, $idCheck[$key]);
		$query_test_checked->bindParam(2, $idGpp);
		$query_test_checked->execute();
		$nb_query = $query_test_checked->rowCount();
		if($etatFinal == 1 || $etatFinal == 4){
			$query_ins_checked=$bdd->prepare("INSERT INTO controle (id_gpp, id_check, reponse, id_graph, etat, commentaire_controleur, commentaire_graph) VALUES (?,?,?,?,?,?,?)");
			$query_ins_checked->bindParam(1, $idGpp);
			$query_ins_checked->bindParam(2, $idCheck[$key]);
			$query_ins_checked->bindParam(3, $valueCheck[$key]);
			$query_ins_checked->bindParam(4, $id_graph);
			$query_ins_checked->bindParam(5, $etatFinal);
			$query_ins_checked->bindParam(6, $commentaire_controleur);
			$query_ins_checked->bindParam(7, $commentaire_graph);
			$query_ins_checked->execute();
			$fin=$etatFinal+1;
			$query_up_cl=$bdd->prepare("UPDATE client SET id_etat = ? where IDGPP = ?");
			$query_up_cl->bindParam(1, $fin);
			$query_up_cl->bindParam(2, $idGpp);
			$query_up_cl->execute();
			if($etatFinal==4){
				$query_up_cl2=$bdd->prepare("UPDATE client SET id_graph_cq=? where IDGPP = ?");
				$query_up_cl2->bindParam(1, $id_graph);
				$query_up_cl2->bindParam(2, $idGpp);
				$query_up_cl2->execute();
			}
		}else{
			if($etatFinal > 1 && $etatFinal < 4){
				$etat_cont=1;
				$query_ins_checked=$bdd->prepare("UPDATE controle SET commentaire_controleur = ?,commentaire_graph = ? where id_gpp = ? and id_check = ? and etat = ?");
				$query_ins_checked->bindParam(1, $commentaire_controleur);
				$query_ins_checked->bindParam(2, $commentaire_graph);
				$query_ins_checked->bindParam(3, $idGpp);
				$query_ins_checked->bindParam(4, $idCheck[$key]);
				$query_ins_checked->bindParam(5, $etat_cont);
				$query_ins_checked->execute();
			}elseif ($etatFinal > 4 && $etatFinal < 7) {
				$etat_cont=4;
				$query_ins_checked=$bdd->prepare("UPDATE controle SET commentaire_controleur = ?, commentaire_graph = ? where id_gpp = ? and id_check = ? and etat = ?");
				$query_ins_checked->bindParam(1, $commentaire_controleur);
				$query_ins_checked->bindParam(2, $commentaire_graph);
				$query_ins_checked->bindParam(3, $idGpp);
				$query_ins_checked->bindParam(4, $idCheck[$key]);
				$query_ins_checked->bindParam(5, $etat_cont);
				$query_ins_checked->execute();

			}
		}
// $valueCheck[$key];
	}
	if($etatFinal == 2 && $envoi=="ok"){
		$etat=4;
		$query_up_cl=$bdd->prepare("UPDATE client SET date_retour_maquette = ?, id_controleur_maquette = ?,id_etat = ? where IDGPP = ?");
		$query_up_cl->bindParam(1, $date);
		$query_up_cl->bindParam(2, $id_graph);
		$query_up_cl->bindParam(3, $etat);
		$query_up_cl->bindParam(4, $idGpp);
		$query_up_cl->execute();
	}elseif($etatFinal == 2 && $envoi=="retour"){
		$etat=3;
		$query_up_cl=$bdd->prepare("UPDATE client SET date_retour_maquette = ?, id_controleur_maquette = ?, id_etat = ? where IDGPP = ?");
		$query_up_cl->bindParam(1, $date);
		$query_up_cl->bindParam(2, $id_graph);
		$query_up_cl->bindParam(3, $etat);
		$query_up_cl->bindParam(4, $idGpp);
		$query_up_cl->execute();
	}elseif($etatFinal == 3){
		$etat=2;
		$query_up_cl=$bdd->prepare("UPDATE client SET id_etat = ? where IDGPP = ?");
		$query_up_cl->bindParam(1, $etat);
		$query_up_cl->bindParam(2, $idGpp);
		$query_up_cl->execute();
	}
	if($etatFinal == 5 && $envoi=="ok"){
		$etat=7;
		$query_up_cl=$bdd->prepare("UPDATE client SET date_retour_cq = ?, id_controleur_cq = ?, id_etat = ? where IDGPP = ?");
		$query_up_cl->bindParam(1, $date);
		$query_up_cl->bindParam(2, $id_graph);
		$query_up_cl->bindParam(3, $etat);
		$query_up_cl->bindParam(4, $idGpp);
		$query_up_cl->execute();
	}elseif($etatFinal == 5 && $envoi=="retour"){
		$etat=6;
		$query_up_cl=$bdd->prepare("UPDATE client SET date_retour_cq = ?, id_controleur_cq = ?, id_etat = ? where IDGPP = ?");
		$query_up_cl->bindParam(1, $date);
		$query_up_cl->bindParam(2, $id_graph);
		$query_up_cl->bindParam(3, $etat);
		$query_up_cl->bindParam(4, $idGpp);
		$query_up_cl->execute();
	}
	elseif($etatFinal == 6){
		$etat=5;
		$query_up_cl=$bdd->prepare("UPDATE client SET id_etat = ? where IDGPP = ?");
		$query_up_cl->bindParam(1, $etat);
		$query_up_cl->bindParam(2, $idGpp);
		$query_up_cl->execute();
		// echo "UPDATE client SET id_etat = '$etat' where IDGPP = '$idGpp'";
	}
}
if (isset($_POST['ancienPasswordAccount'])) {
	$ancien = $_POST['ancienPasswordAccount'];
// echo $ancien;
	$mdp=password_hash($_POST['newPasswordAccount'], PASSWORD_DEFAULT);
	$id_graph=$_COOKIE['id_graph'];
	$query_test_user = $bdd->prepare("SELECT mdp FROM user WHERE id_user = ?");
	$query_test_user->bindParam(1, $id_graph);
	$query_test_user->execute();
	$test_user = $query_test_user->fetch();
	if(password_verify($ancien, $test_user['mdp'])){
		$query_update_user = $bdd->prepare("UPDATE user set mdp = ? WHERE id_user = ?");
		$query_update_user->bindParam(1, $mdp);
		$query_update_user->bindParam(2, $id_graph);
		$query_update_user->execute();
		echo "ok";
	}
}
if(isset($_POST['numClient_controleur'])){
	$tab_proposition=array();
	$date_ajout_controleur = date('Y-m-d H:i:s');
	$numClient = $_POST['numClient_controleur'];
	$lienMaquette = $_POST['lienMaquette'];
	$idUser = $_POST['idUser'];
	$requete_proposition = $bdd->prepare("INSERT INTO proposition_design (date_proposition, num_client, lien_maquette, id_user)	VALUES (?, ?, ?, ?)");
	$requete_proposition->bindParam(1, $date_ajout_controleur);
	$requete_proposition->bindParam(2, $numClient);
	$requete_proposition->bindParam(3, $lienMaquette);
	$requete_proposition->bindParam(4, $idUser);
	$requete_proposition->execute();
}
if(isset($_POST['showWeek'])){
	echo date('W');
}
if(isset($_POST['note'])){
	$note = $_POST['note'];
	$id = $_POST['numClientId'];
	$idgpp = $_POST['idgpp_check'];
	$accept = 1;
	$requete_accept = $bdd->prepare("UPDATE proposition_design set accept = ?, note = ? WHERE id_gpp = ?");
	$requete_accept->bindParam(1, $accept);
	$requete_accept->bindParam(2, $note);
	$requete_accept->bindParam(3, $idgpp);
	$requete_accept->execute();
}
if(isset($_POST['search'])){
	$search = utf8_decode($_POST['search']);
	$varsearch = "%" . $search . "%";
	$requete_search = $bdd->prepare("SELECT * FROM aide inner join user on aide.id_user=user.id_user inner join etat_aide on aide.id_etat_aide = etat_aide.id_etat_aide WHERE titre LIKE ? or description LIKE ? or id_client LIKE ? order by date_aide DESC");
	$requete_search->bindParam(1, $varsearch);
	$requete_search->bindParam(2, $varsearch);
	$requete_search->bindParam(3, $varsearch);
	$requete_search->execute();
	$nb_result = $requete_search->rowCount();
	$tab_search = array();
	if ($nb_result == 0) {?>
	<tr class="event-item">
		<td class="upcoming">
			<div class="date-event">
				<h2>Aucun résultat n'a été trouvé</h2>
			</div>
		</td>
	</tr>
	<?php }else{
		foreach ($requete_search as $key => $value) {
			$id_aide=$value['id_aide'];
			$query_commentaire_nb=$bdd->prepare("SELECT id_commentaires_aide FROM commentaires_aide where id_aide = ?");
			$query_commentaire_nb->bindParam(1, $id_aide);
			$query_commentaire_nb->execute();
			$query_nb_com=$query_commentaire_nb->rowCount();
			$query_last_com=$bdd->prepare("SELECT * FROM commentaires_aide inner join user on commentaires_aide.id_user = user.id_user where id_aide = ? order by date_commentaire DESC limit 1");
			$query_last_com->bindParam(1, $id_aide);
			$query_last_com->execute();
			$last= $query_last_com->fetch();
			$date_tab=explode("-", $value['date_aide']);
			$jour_tab=explode(" ",$date_tab[2]);
			$jour=$jour_tab[0];

			$m=$date_tab[1];
			$months = array (1=>'Jan',2=>'Fev',3=>'Mar',4=>'Avr',5=>'Mai',6=>'Juin',7=>'Juil',8=>'Aout',9=>'Sept',10=>'Oct',11=>'Nov',12=>'Dec');
			?>
			<tr>
				<td class="forum">
					<div class="forum-item">
						<div class="content">
							<a href="help_open.php?post=<?php echo $value['id_aide'];?>" class="h6 title"><?php echo utf8_encode($value['titre']);?></a>
							<!-- <p class="text"><?php echo shapeSpace_truncate_string_at_word(utf8_encode($value['description']),50);?></p> -->
						</div>
					</div>
				</td>
				<td class="topics">
					<a href="<?php echo $value['adresse_cms'];?>" target="_blank" class="h6 count"><?php echo $value['id_client'];?></a>
				</td>
				<td class="posts">
					<a href="help_open.php?post=<?php echo $value['id_aide'];?>" class="h6 count"><?php echo $query_nb_com;?></a>
				</td>
				<td class="freshness">
					<div class="author-freshness">
						<div class="author-thumb">
							<?php if($query_nb_com==0){
								echo "Pas de message";
							}else{?>
							<img src="../<?php echo utf8_encode($last['photo']);?>" alt="author">
							<?php }?>
						</div>
						<?php if($query_nb_com!=0){?>
						<a href="#" class="h6 title"><?php echo utf8_encode($last['prenom'].$last['nom']);?></a>
						<time class="entry-date updated" datetime="2017-06-24T18:18"><?php echo time_elapsed_string($last['date_commentaire']);?></time>
						<?php }?>
					</div>
				</td>
			</tr>
			<?php
		}
	}
}
if(isset($_POST['search_empty'])){
	$requete_search = $bdd->prepare("SELECT * FROM aide inner join user on aide.id_user=user.id_user inner join etat_aide on aide.id_etat_aide = etat_aide.id_etat_aide order by date_aide DESC");
	$requete_search->execute();
	$nb_result = $requete_search->rowCount();
	$tab_search = array();
	foreach ($requete_search as $key => $value) {
		$id_aide=$value['id_aide'];
		$query_commentaire_nb=$bdd->prepare("SELECT id_commentaires_aide FROM commentaires_aide where id_aide = ?");
		$query_commentaire_nb->bindParam(1, $id_aide);
		$query_commentaire_nb->execute();
		$query_nb_com=$query_commentaire_nb->rowCount();
		$query_last_com=$bdd->prepare("SELECT * FROM commentaires_aide inner join user on commentaires_aide.id_user = user.id_user where id_aide = ? order by date_commentaire DESC limit 1");
		$query_last_com->bindParam(1, $id_aide);
		$query_last_com->execute();
		$last= $query_last_com->fetch();
		$date_tab=explode("-", $value['date_aide']);
		$jour_tab=explode(" ",$date_tab[2]);
		$jour=$jour_tab[0];

		$m=$date_tab[1];
		$months = array (1=>'Jan',2=>'Fev',3=>'Mar',4=>'Avr',5=>'Mai',6=>'Juin',7=>'Juil',8=>'Aout',9=>'Sept',10=>'Oct',11=>'Nov',12=>'Dec');
		?>
		<tr>
			<td class="forum">
				<div class="forum-item">
					<div class="content">
						<a href="help_open.php?post=<?php echo $value['id_aide'];?>" class="h6 title"><?php echo utf8_encode($value['titre']);?></a>
						<!-- <p class="text"><?php echo shapeSpace_truncate_string_at_word(utf8_encode($value['description']),50);?></p> -->
					</div>
				</div>
			</td>
			<td class="topics">
				<a href="<?php echo $value['adresse_cms'];?>" target="_blank" class="h6 count"><?php echo $value['id_client'];?></a>
			</td>
			<td class="posts">
				<a href="help_open.php?post=<?php echo $value['id_aide'];?>" class="h6 count"><?php echo $query_nb_com;?></a>
			</td>
			<td class="freshness">
				<div class="author-freshness">
					<div class="author-thumb">
						<?php if($query_nb_com==0){
							echo "Pas de message";
						}else{?>
						<img src="../<?php echo utf8_encode($last['photo']);?>" alt="author">
						<?php }?>
					</div>
					<?php if($query_nb_com!=0){?>
					<a href="#" class="h6 title"><?php echo utf8_encode($last['prenom'].$last['nom']);?></a>
					<time class="entry-date updated" datetime="2017-06-24T18:18"><?php echo time_elapsed_string($last['date_commentaire']);?></time>
					<?php }?>
				</div>
			</td>
		</tr>
		<?php
	}
}
if(isset($_POST['admin_search'])){
	$search = $_POST['admin_search'];
	$varsearch = "%" . $search . "%";
	$requete_search = $bdd->prepare("SELECT * FROM client inner join etat on client.id_etat = etat.id_etat WHERE raison_social LIKE ? or num_client LIKE ? order by date_integration DESC");
	$requete_search->bindParam(1, $varsearch);
	$requete_search->bindParam(2, $varsearch);
	$requete_search->execute();
	$nb_result = $requete_search->rowCount();
	$tab_search = array();
	foreach ($requete_search as $key => $value) {
		$date_tab=explode("-", $value['date_integration']);
		$jour_tab=explode(" ",$date_tab[2]);
		$jour=$jour_tab[0];
		$m=$date_tab[1];
		$months = array (1=>'Jan',2=>'Fev',3=>'Mar',4=>'Avr',5=>'Mai',6=>'Juin',7=>'Juil',8=>'Aout',9=>'Sept',10=>'Oct',11=>'Nov',12=>'Dec');
		if($value['id_etat']==1){
			$class_etat="crea-maquette";
			$class_img="img/Crea-maquette.png";
		}elseif ($value['id_etat']==2) {
			$class_etat="ctrl-maquette";
			$class_img="img/Ctrl-maquette.png";
		}elseif ($value['id_etat']==3) {
			$class_etat="retour-crea";
			$class_img="img/Retour-crea.png";
		}elseif ($value['id_etat']==4) {
			$class_etat="crea-graphique";
			$class_img="img/Crea-graphique.png";
		}elseif ($value['id_etat']==5) {
			$class_etat="ctrl-design";
			$class_img="img/Ctrl-design.png";
		}elseif ($value['id_etat']==6) {
			$class_etat="retour-crea";
			$class_img="img/Retour-graphique.png";
		}elseif ($value['id_etat']==7) {
			$class_etat="site-valide";
			$class_img="img/Site-valide.png";
		}

		?>
		<div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-6 change_card projet_<?php echo $value['id_client'];?> qualif_<?php echo $value['id_etat'];?>">
			<div class="ui-block hauteur-card" data-mh="friend-groups-item">
				<div class="friend-item friend-groups  <?php echo $class_etat;?>">
					<div class="friend-item-content">
						<div class="more">
							<svg class="olymp-three-dots-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="../icons/icons.svg#olymp-three-dots-icon"></use></svg>
							<ul class="more-dropdown">
								<li>
									<a class="modifier" data-toggle="modal" data-target="#change" href="#">Modifier la carte</a>
								</li>
								<li>
									<a class="delete" href="#">Supprimer la carte</a>
								</li>
							</ul>
						</div>
						<div class="friend-avatar entete-card">
							<div class="author-thumb etat-card">
								<img src="<?php echo $class_img;?>" alt="Olympus">
							</div>
							<div class="author-content texte-card">
								<a href="#" class="h5 author-name"><?php echo utf8_encode($value['raison_social']);?></a>
								<div class="country"><?php echo $value['num_client'];?></div>
							</div>
						</div>
						<div class="control-block-button bouton-check">
							<a href="<?php echo utf8_encode($value['lien_CMS']);?>" target="_blank" class="liencms btn btn-control bg-blue bouton-icone1">
								<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="35%" version="1.1" height="35%" viewBox="0 0 64 64" enable-background="new 0 0 64 64">
									<path d="m60.135,3.875c-5.156-5.166-13.545-5.168-18.697,0l-11.576,11.619c-0.788,0.791-0.788,2.074 0,2.865 0.79,0.792 2.067,0.792 2.856,0l11.576-11.618c3.578-3.589 9.401-3.587 12.984,0 3.578,3.591 3.578,9.435 0,13.024l-15.292,15.339c-1.732,1.739-4.038,2.697-6.49,2.697-2.451,0-4.758-0.959-6.492-2.697-0.789-0.792-2.067-0.792-2.857,0-0.788,0.791-0.788,2.074 0,2.865 2.499,2.505 5.818,3.885 9.35,3.885s6.848-1.381 9.347-3.885l15.292-15.338c5.152-5.17 5.152-13.584-0.001-18.756z" fill="#FFFFFF"/>
									<path d="m31.015,45.904l-11.312,11.346c-1.732,1.739-4.039,2.697-6.491,2.697-2.451,0-4.759-0.958-6.489-2.697-3.578-3.591-3.578-9.434 0-13.023l15.289-15.338c3.582-3.588 9.406-3.588 12.983,0 0.789,0.793 2.067,0.793 2.856,0 0.789-0.791 0.789-2.072 0-2.864-5.152-5.17-13.541-5.17-18.697,0l-15.288,15.336c-5.155,5.17-5.155,13.584 4.44089e-16,18.754 2.497,2.506 5.816,3.885 9.346,3.885 3.531,0 6.853-1.379 9.348-3.885l11.31-11.345c0.79-0.791 0.79-2.074 0-2.865-0.788-0.792-2.067-0.792-2.855-0.001z" fill="#FFFFFF"/>
								</svg>
							</a>
							<a href="check.php?idgpp=<?php echo utf8_encode($value['IDGPP']);?>" class="btn btn-control btn-grey-lighter bouton-icone2">
								<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" width="35%" height="35%" viewBox="0 0 394.893 394.893" style="enable-background:new 0 0 394.893 394.893;" xml:space="preserve">
									<path d="M344.426,191.963c-6.904,0-12.5,5.597-12.5,12.5V350.91H25V43.982h246.57c6.904,0,12.5-5.597,12.5-12.5    c0-6.903-5.596-12.5-12.5-12.5H12.5c-6.903,0-12.5,5.597-12.5,12.5V363.41c0,6.903,5.597,12.5,12.5,12.5h331.926    c6.902,0,12.5-5.597,12.5-12.5V204.463C356.926,197.56,351.33,191.963,344.426,191.963z" fill="#FFFFFF"/>
									<path d="M391.23,27.204c-4.881-4.881-12.795-4.881-17.678,0L169.957,230.801l-50.584-50.584c-4.882-4.881-12.796-4.881-17.678,0    c-4.881,4.882-4.881,12.796,0,17.678l59.423,59.423c2.441,2.44,5.64,3.661,8.839,3.661c3.199,0,6.398-1.221,8.839-3.661    L391.23,44.882C396.113,40,396.113,32.086,391.23,27.204z" fill="#FFFFFF"/>
								</svg>
							</a>
						</div>
					</div>
				</div>
			</div>
			<input type="hidden" class="idgpp" value="<?php echo $value['IDGPP'];?>">
			<input type="hidden" class="graph" value="<?php echo $value['id_graph_maquette'];?>">
			<input type="hidden" class="id_client" value="<?php echo $value['id_client'];?>">
			<input type="hidden" class="soprod" value="<?php echo $value['soprod'];?>">
		</div>
		<?php
	}
}
if(isset($_POST['admin_search_empty'])){
	$requete_search = $bdd->prepare("SELECT * FROM client order by date_integration DESC");
	$requete_search->execute();
	$nb_result = $requete_search->rowCount();
	$tab_search = array();
	foreach ($requete_search as $key => $value) {
		$date_tab=explode("-", $value['date_integration']);
		$jour_tab=explode(" ",$date_tab[2]);
		$jour=$jour_tab[0];
		$m=$date_tab[1];
		$months = array (1=>'Jan',2=>'Fev',3=>'Mar',4=>'Avr',5=>'Mai',6=>'Juin',7=>'Juil',8=>'Aout',9=>'Sept',10=>'Oct',11=>'Nov',12=>'Dec');
	}
}

if(isset($_POST['file_avatar'])){
	$file_arr = $_POST['file_avatar'];
	$file="";
	$i=0;
	$token = $_POST['token'];
	foreach ($file_arr as $key => $value) {
		if ($i!=0) {
			$file.=";";
		}
		$file.=$token.$value;
		$i++;
	}
	$id_graph=$_COOKIE['id_graph'];
	$file=utf8_decode("uploads/avatar/".$file);
	$requ=$bdd->prepare("UPDATE user set photo_avatar = ? where id_user = ?");
	$requ->bindParam(1,$file);
	$requ->bindParam(2, $id_graph);
	$requ->execute();
}

if(isset($_POST['lienveille'])){
	$lienveille = $_POST['lienveille'];
	$titreveille = $_POST['titreveille'];
	$categorie = $_POST['categorie_veille'];
	$file_arr = $_POST['file_veille'];
	$token = $_POST['token'];
	$file="";
	$i=0;
	foreach ($file_arr as $key => $value) {
		if ($i!=0) {
			$file.=";";
		}
		$file.=$token.$value;
		$i++;
	}
	$like_veille = 0;
	$accept_veille = 0;
	$date_veille = date('Y-m-d H:i:s');
	$description = $_POST['description_veille'];
	$requete_veille = $bdd->prepare("INSERT INTO veille (titre, categorie, file, description, lien, date_veille, like_veille,accept_veille)	VALUES (?, ?, ?, ?, ?, ?, ?,?)");
	$requete_veille->bindParam(1, $titreveille);
	$requete_veille->bindParam(2, $categorie);
	$requete_veille->bindParam(3, $file);
	$requete_veille->bindParam(4, $description);
	$requete_veille->bindParam(5, $lienveille);
	$requete_veille->bindParam(6, $date_veille);
	$requete_veille->bindParam(7, $like_veille);
	$requete_veille->bindParam(8, $accept_veille);
	$requete_veille->execute();
	$requete_show_veille = $bdd->prepare("SELECT * from veille order by id_veille desc limit 1");
	$requete_show_veille->execute();
	foreach ($requete_show_veille as $key => $value) {?>
	<div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 col-xs-12 sorting-item <?php echo($value['categorie']) ?>">
		<div class="ui-block">
			<article class="hentry blog-post">

				<div class="post-thumb">
					<img src="uploads/veille/<?php echo($value['file']) ?>" alt="photo">
				</div>

				<div class="post-content">
					<a class="h4 post-title"><?php echo($value['titre']) ?></a>
					<p><?php echo($value['description']) ?>											</p>

					<div class="author-date not-uppercase">
						<div class="post__date">
							<time class="published" datetime="2017-03-24T18:18">
								<?php echo($value['date_veille']) ?>
							</time>
						</div>
					</div>
					<a class="post-add-icon inline-items" style="fill: #ff5e3a;color: #ff5e3a;"><svg class="olymp-heart-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="../icons/icons.svg#olymp-heart-icon"></use></svg><span><?php echo($value['like_veille']) ?></span></a>
				</div>
			</article>
		</div>
	</div>
	<?php
}
}
if(isset($_POST['titre_code'])){
	$titre_code=utf8_decode($_POST['titre_code']);
	$description_code=utf8_decode($_POST['description_code']);
	$categorie=utf8_decode($_POST['categorie_code']);
	$codeHTML=utf8_decode($_POST['codeHTML']);
	$codeCSS=utf8_decode($_POST['codeCSS']);
	$codeJS=utf8_decode($_POST['codeJS']);
	$date_code = date('Y-m-d H:i:s');
	$id_graph=$_COOKIE['id_graph'];
	$accept_code = 0;
	$query_code = $bdd->prepare("INSERT INTO code (code_html, code_css, code_js, titre, description, date_code, id_user, categorie_code, accept_code)	VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
	$query_code->bindParam(1, $codeHTML);
	$query_code->bindParam(2, $codeCSS);
	$query_code->bindParam(3, $codeJS);
	$query_code->bindParam(4, $titre_code);
	$query_code->bindParam(5, $description_code);
	$query_code->bindParam(6, $date_code);
	$query_code->bindParam(7, $id_graph);
	$query_code->bindParam(8, $categorie);
	$query_code->bindParam(9, $accept_code);
	$query_code->execute();
}
if(isset($_POST['titre_code_edit'])){
	$titre_code=utf8_decode($_POST['titre_code_edit']);
	$description_code=utf8_decode($_POST['description_code']);
	$codeHTML=utf8_decode($_POST['codeHTML']);
	$codeCSS=utf8_decode($_POST['codeCSS']);
	$codeJS=utf8_decode($_POST['codeJS']);
	$date_code = date('Y-m-d H:i:s');
	$id_graph=$_COOKIE['id_graph'];
	$id_code=$_POST['id_code'];
	$query_code = $bdd->prepare("UPDATE code set code_html = ?, code_css = ?, code_js = ?, titre = ?, description = ? WHERE id_code = ?");
	$query_code->bindParam(1, $codeHTML);
	$query_code->bindParam(2, $codeCSS);
	$query_code->bindParam(3, $codeJS);
	$query_code->bindParam(4, $titre_code);
	$query_code->bindParam(5, $description_code);
	$query_code->bindParam(6, $id_code);
	$query_code->execute();
}
if(isset($_POST['delete'])){
	$idgpp=$_POST['admin_idgpp'];
	$query_select = $bdd->prepare("SELECT * FROM client WHERE IDGPP = ?");
	$query_select->bindParam(1, $idgpp);
	$query_select->execute();
	$select_result = $query_select->fetch();
	echo $select_result['id_client'];
	$query_delete = $bdd->prepare("DELETE FROM client WHERE IDGPP LIKE ?");
	$query_delete->bindParam(1, $idgpp);
	$query_delete->execute();
}
if(isset($_POST['modifier_num'])){
	$modif_num=$_POST['modifier_num'];
	$modif_rs=$_POST['modifier_rs'];
	$modif_cms=$_POST['modifier_cms'];
	$modif_graph=$_POST['modifier_graph'];
	$modif_qualif=$_POST['modifier_qualif'];
	$get_id_client=$_POST['getIdClient'];
	$query_modif = $bdd->prepare("UPDATE client set num_client = ?, raison_social = ?, lien_CMS = ?, id_graph_maquette = ?, id_etat = ?, envoi_maquette = ? WHERE IDGPP = ?");
	$query_modif->bindParam(1, $modif_num);
	$query_modif->bindParam(2, $modif_rs);
	$query_modif->bindParam(3, $modif_cms);
	$query_modif->bindParam(4, $modif_graph);
	$query_modif->bindParam(5, $modif_qualif);
	$query_modif->bindParam(6, $modif_graph);
	$query_modif->bindParam(7, $get_id_client);
	$query_modif->execute();
	var_dump($query_modif);
}
if(isset($_POST['clic_accept'])){
	$accept_code = 1;
	$id_code=$_POST['id_code'];
	$query_accept_code = $bdd->prepare("UPDATE code set accept_code = ? WHERE id_code = ?");
	$query_accept_code->bindParam(1, $accept_code);
	$query_accept_code->bindParam(2, $id_code);
	$query_accept_code->execute();
}
if(isset($_POST['clic_deny'])){
	$id_code=$_POST['id_code'];
	$query_delete_code=$bdd->prepare("DELETE FROM code where id_code = ?");
	$query_delete_code->bindParam(1, $id_code);
	$query_delete_code->execute();
}
if(isset($_POST['search_code'])){
	$search = $_POST['search_code'];
	$varsearch = "%" . $search . "%";
	$requete_search_code = $bdd->prepare("SELECT * FROM code inner join user on code.id_user = user.id_user inner join categorie_code on code.categorie_code = categorie_code.id_categorie_code WHERE titre LIKE  ? or description LIKE ? order by date_code DESC");
	$requete_search_code->bindParam(1, $varsearch);
	$requete_search_code->bindParam(2, $varsearch);
	$requete_search_code->execute();
	$nb_result = $requete_search_code->rowCount();
	$tab_search = array();
	if ($nb_result == 0) {?>
	<tr class="event-item">
		<td class="upcoming">
			<div class="date-event">
				<h2>Aucun résultat n'a été trouvé</h2>
			</div>
		</td>
	</tr>
	<?php }else{
		foreach ($requete_search_code as $key => $value) {
			$date_tab=explode("-", $value['date_code']);
			$jour_tab=explode(" ",$date_tab[2]);
			$jour=$jour_tab[0];
			$m=$date_tab[1];
			$months = array (1=>'Jan',2=>'Fev',3=>'Mar',4=>'Avr',5=>'Mai',6=>'Juin',7=>'Juil',8=>'Aout',9=>'Sept',10=>'Oct',11=>'Nov',12=>'Dec');
			?>
			<div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 col-xs-12 sorting-item <?php echo($value['categorie_code']) ?>">
				<div class="ui-block">
					<article class="first-code hentry blog-post">
						<a class="opencode" target="_blank" href="code.php?id_code=<?php echo utf8_encode($value['id_code']);?>">
							<p class="post-category bg-blue-light"><?php echo utf8_encode($value['categorie_code']);?></p>
							<div class="post-content">
								<h4><?php echo utf8_encode($value['titre']);?></h4>
								<p><?php echo utf8_encode($value['description']);?></p>

								<div class="author-date">
									<p class="h6 post__author-name fn"><?php echo utf8_encode($value['prenom']);?> <?php echo utf8_encode($value['nom']);?></p>
									<div class="post__date">
										<time class="published">
											<?php echo time_elapsed_string($value['date_code']);?>
										</time>
									</div>
								</div>
							</div>
							<input class="id_code" type="hidden" value="<?php echo utf8_encode($value['id_code']);?>">
						</a>
					</article>
				</div>

			</div>
			<?php
		}
	}
}
if(isset($_POST['search_code_empty'])){
	$requete_search_code_empty = $bdd->prepare("SELECT * FROM code inner join user on code.id_user = user.id_user inner join categorie_code on code.categorie_code = categorie_code.id_categorie_code order by date_code DESC");
	$requete_search_code_empty->execute();
	$nb_result = $requete_search_code_empty->rowCount();
	$tab_search = array();
	foreach ($requete_search_code_empty as $key => $value) {
		$date_tab=explode("-", $value['date_code']);
		$jour_tab=explode(" ",$date_tab[2]);
		$jour=$jour_tab[0];
		$m=$date_tab[1];
		$months = array (1=>'Jan',2=>'Fev',3=>'Mar',4=>'Avr',5=>'Mai',6=>'Juin',7=>'Juil',8=>'Aout',9=>'Sept',10=>'Oct',11=>'Nov',12=>'Dec');
		?>
		<div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 col-xs-12 sorting-item <?php echo($value['categorie_code']) ?>">
			<div class="ui-block">
				<article class="first-code hentry blog-post">
					<a class="opencode" target="_blank" href="code.php?id_code=<?php echo utf8_encode($value['id_code']);?>">
						<p class="post-category bg-blue-light"><?php echo utf8_encode($value['categorie_code']);?></p>
						<div class="post-content">
							<h4><?php echo utf8_encode($value['titre']);?></h4>
							<p><?php echo utf8_encode($value['description']);?></p>

							<div class="author-date">
								<p class="h6 post__author-name fn"><?php echo utf8_encode($value['prenom']);?> <?php echo utf8_encode($value['nom']);?></p>
								<div class="post__date">
									<time class="published">
										<?php echo time_elapsed_string($value['date_code']);?>
									</time>
								</div>
							</div>
						</div>
						<input class="id_code" type="hidden" value="<?php echo utf8_encode($value['id_code']);?>">
					</a>
				</article>
			</div>

		</div>
		<?php
	}
}
if(isset($_POST['categorie_remontees'])){
	$categorie_remontees = $_POST['categorie_remontees'];
	$titre_remontees = utf8_decode($_POST['titre_remontees']);
	$description_remontees = utf8_decode($_POST['description_remontees']);
	$id_user = $_COOKIE['id_graph'];
	$date = date('Y-m-d H:i:s');
	$accept_remontees = 1;
	$commentaires = '';
	$kats = '';
	$file_arr = $_POST['file'];
	$token = $_POST['token'];
	$id_rep = 0;
	$file="";
	$i=0;
	foreach ($file_arr as $key => $value) {
		if ($i!=0) {
			$file.=";";
		}
		$file.=$token.$value;
		$i++;
	}
	$requete_remontee = $bdd->prepare("INSERT INTO remontees (titre, description, id_categorie_remontees, date_remontees, id_user, accept_remontees, commentaires, kats, file, id_rep, ref) VALUES (?,?,?,?,?,?,?,?,?,?,?)");
	$requete_remontee->bindParam(1, $titre_remontees);
	$requete_remontee->bindParam(2, $description_remontees);
	$requete_remontee->bindParam(3, $categorie_remontees);
	$requete_remontee->bindParam(4, $date);
	$requete_remontee->bindParam(5, $id_user);
	$requete_remontee->bindParam(6, $accept_remontees);
	$requete_remontee->bindParam(7, $commentaires);
	$requete_remontee->bindParam(8, $kats);
	$requete_remontee->bindParam(9, $file);
	$requete_remontee->bindParam(10, $id_rep);
	$requete_remontee->bindParam(11, $token);
	$requete_remontee->execute();
}

if (isset($_POST['id_remontees_refus'])) {
	$decline_remontees = 2;
	$id_remontees = utf8_decode($_POST['id_remontees_refus']);
	$kats = $_POST['kats'];
	$id_rep = $_COOKIE['id_graph'];
	$requete_decline_remontee = $bdd->prepare("UPDATE remontees SET accept_remontees = ?, kats = ?, id_rep = ? where id_remontees = ?");
	$requete_decline_remontee->bindParam(1, $decline_remontees);
	$requete_decline_remontee->bindParam(2, $kats);
	$requete_decline_remontee->bindParam(3, $id_rep);
	$requete_decline_remontee->bindParam(4, $id_remontees);
	$requete_decline_remontee->execute();

	$requete_use = $bdd->prepare("SELECT * FROM remontees where id_remontees = ?");
	$requete_use->bindParam(1, $id_remontees);
	$requete_use->execute();
	$fetch_user=$requete_use->fetch();

	$requete_notif = $bdd->prepare("SELECT * FROM notifications_remontees where id_remontees = ?");
	$requete_notif->bindParam(1, $id_remontees);
	$requete_notif->execute();
	$nb_not=$requete_notif->rowCount();
	$leuser=$fetch_user['id_user'];
	$active = 1;
	if($nb_not==0){
		$requet = $bdd->prepare("INSERT INTO notifications_remontees (id_remontee,id_user, active) VALUES (?,?,?)");
		$requet->bindParam(1, $id_remontees);
		$requet->bindParam(2, $leuser);
		$requet->bindParam(3, $active);
		$requet->execute();
	}else{
		$requet = $bdd->prepare("UPDATE notifications_remontees SET active = 1 where id_remontees = ?");
		$requet->bindParam(1, $id_remontees);
		$requet->execute();
	}
}

if (isset($_POST['id_remontees_traitement'])) {
	$decline_remontees = 3;
	$id_remontees = utf8_decode($_POST['id_remontees_traitement']);
	$kats = $_POST['kats'];
	$id_rep = $_COOKIE['id_graph'];
	$requete_traitement_remontee = $bdd->prepare("UPDATE remontees SET accept_remontees = ?, kats = ?, id_rep = ? where id_remontees = ?");
	$requete_traitement_remontee->bindParam(1, $decline_remontees);
	$requete_traitement_remontee->bindParam(2, $kats);
	$requete_traitement_remontee->bindParam(3, $id_rep);
	$requete_traitement_remontee->bindParam(4, $id_remontees);
	$requete_traitement_remontee->execute();

	$requete_use = $bdd->prepare("SELECT * FROM remontees where id_remontees = ?");
	$requete_use->bindParam(1, $id_remontees);
	$requete_use->execute();
	$fetch_user=$requete_use->fetch();
	$leuser=$fetch_user['id_user'];
	$requete_notif = $bdd->prepare("SELECT * FROM notifications_remontees where id_remontees = ?");
	$requete_notif->bindParam(1, $id_remontees);
	$requete_notif->execute();
	$nb_not=$requete_notif->rowCount();
	$active = 1;
	if($nb_not==0){
		$requet = $bdd->prepare("INSERT INTO notifications_remontees (id_remontee,id_user, active) VALUES (?,?,?)");
		$requet->bindParam(1, $id_remontees);
		$requet->bindParam(2, $leuser);
		$requet->bindParam(3, $active);
		$requet->execute();
	}else{
		$requet = $bdd->prepare("UPDATE notifications_remontees SET active = 1 where id_remontees = ?");
		$requet->bindParam(1, $id_remontees);
		$requet->execute();
	}
}

if (isset($_POST['id_remontees_accept'])) {
	$decline_remontees = 4;
	$id_remontees = utf8_decode($_POST['id_remontees_accept']);
	$kats = $_POST['kats'];
	$id_rep = $_COOKIE['id_graph'];
	$requete_accept_remontee = $bdd->prepare("UPDATE remontees SET accept_remontees = ?, kats = ?, id_rep = ? where id_remontees = ?");
	$requete_accept_remontee->bindParam(1, $decline_remontees);
	$requete_accept_remontee->bindParam(2, $kats);
	$requete_accept_remontee->bindParam(3, $id_rep);
	$requete_accept_remontee->bindParam(4, $id_remontees);
	$requete_accept_remontee->execute();
	
	$requete_use = $bdd->prepare("SELECT * FROM remontees where id_remontees = ?");
	$requete_use->bindParam(1, $id_remontees);
	$requete_use->execute();
	$fetch_user=$requete_use->fetch();
	$leuser=$fetch_user['id_user'];

	$requete_notif = $bdd->prepare("SELECT * FROM notifications_remontees where id_remontees = ?");
	$requete_notif->bindParam(1, $id_remontees);
	$requete_notif->execute();
	$nb_not=$requete_notif->rowCount();
	$active = 1;
	if($nb_not==0){
		$requet = $bdd->prepare("INSERT INTO notifications_remontees (id_remontee,id_user, active) VALUES (?,?,?)");
		$requet->bindParam(1, $id_remontees);
		$requet->bindParam(2, $leuser);
		$requet->bindParam(3, $active);
		$requet->execute();
	}else{
		$requet = $bdd->prepare("UPDATE notifications_remontees SET active = 1 where id_remontees = ?");
		$requet->bindParam(1, $id_remontees);
		$requet->execute();
	}
}
if (isset($_POST['newLeader'])) {
	$newLeader=$_POST['newLeader'];
	$newGraph=$_POST['newGraph'];
	$query_up_us=$bdd->prepare("UPDATE user SET id_manager = ? where id_user = ?");
	$query_up_us->bindParam(1, $newLeader);
	$query_up_us->bindParam(2, $newGraph);
	$query_up_us->execute();
}
if (isset($_POST['newLeader_control'])) {
	$newLeader="15";
	$newGraph=$_POST['newGraph'];
	$ancien_statut=$_POST['ancien_statut'];
	$query_up_us=$bdd->prepare("UPDATE user SET id_manager = ?, id_statut = '4', temp_statut = ? where id_user = ?");
	$query_up_us->bindParam(1, $newLeader);
	$query_up_us->bindParam(2, $ancien_statut);
	$query_up_us->bindParam(3, $newGraph);
	$query_up_us->execute();
}
if (isset($_POST['ancienLeader_control'])) {
	$newLeader=$_POST['ancienLeader_control'];
	$newGraph=$_POST['newGraph'];
	$ancien_statut=$_POST['ancien_statut'];
	$temp="0";
	$query_up_us=$bdd->prepare("UPDATE user SET id_manager = ?, id_statut = ?, temp_statut = ? where id_user = ?");
	$query_up_us->bindParam(1, $newLeader);
	$query_up_us->bindParam(2, $ancien_statut);
	$query_up_us->bindParam(3, $temp);
	$query_up_us->bindParam(4, $newGraph);
	$query_up_us->execute();
}
if (isset($_POST['search_user_moderation'])) {
	$search_user_moderation=$_POST['search_user_moderation'];
	$varsearch = "%" . $search_user_moderation . "%";
	$query_user=$bdd->prepare("SELECT id_user FROM user where nom like ? or prenom like ?");
	$query_user->bindParam(1, $varsearch);
	$query_user->bindParam(2, $varsearch);
	$query_user->execute();
	$tab=array();
	foreach ($query_user as $value) {
		$tab[]=$value['id_user'];
	}
	print_r(json_encode($tab));
}
if (isset($_POST['moderation_modif_user'])) {
	$moderation_modif_user=$_POST['moderation_modif_user'];
	$query_moderation=$bdd->prepare("SELECT * FROM user inner join statut on user.id_statut = statut.id_statut where user.id_user = ?");
	$query_moderation->bindParam(1, $moderation_modif_user);
	$query_moderation->execute();
	$result=$query_moderation->fetch();
	$mon_statut=$result['id_statut'];
	$query_statut=$bdd->prepare("SELECT * FROM statut where id_statut != ?");
	$query_statut->bindParam(1, $mon_statut);
	$query_statut->execute();
	$mon_leader=$result['id_manager'];
	$query_leader=$bdd->prepare("SELECT * FROM user where id_user = ?");
	$query_leader->bindParam(1, $mon_leader);
	$query_leader->execute();
	$result_leader=$query_leader->fetch();
	if($result['id_statut']==3 || $result['id_statut']==4){
		$query_leader2=$bdd->prepare("SELECT * FROM user where id_user != ? and id_statut = '5'");
		$query_leader2->bindParam(1, $mon_leader);
		$query_leader2->execute();
	}elseif ($result['id_statut']==1 || $result['id_statut']==2) {
		$query_leader2=$bdd->prepare("SELECT * FROM user where id_user != ? and id_statut = '3'");
		$query_leader2->bindParam(1, $mon_leader);
		$query_leader2->execute();
	}
	?>
	<form method="post" action="moderation_user.php" class="form_user">
		<div class="row">
			<input type="hidden" value="<?php echo $moderation_modif_user;?>" name="le_id" id="le_id">
			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
				<div class="form-group label-floating">
					<label class="control-label">Nom</label>
					<input class="form-control" placeholder="" name="nom" type="text" value="<?php echo utf8_encode($result['nom']);?>">
				</div>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
				<div class="form-group label-floating">
					<label class="control-label">Prenom</label>
					<input class="form-control" placeholder="" name="prenom" type="text" value="<?php echo utf8_encode($result['prenom']);?>">
				</div>
			</div>
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="form-group label-floating">
					<label class="control-label">Email</label>
					<input class="form-control email" placeholder="" name="email" type="email" value="<?php echo utf8_encode($result['email']);?>">
				</div>
				<div class="form-group">
					<select name="le_statut">
						<option value="<?php echo utf8_encode($result['id_statut']);?>" selected="selected"><?php echo utf8_encode($result['nom_statut']);?></option>
						<?php foreach ($query_statut as $key => $value) {?>
						<option value="<?php echo utf8_encode($value['id_statut']);?>"><?php echo utf8_encode($value['nom_statut']);?></option>
						<?php }?>
					</select>
				</div>

				<div class="form-group">
					<select name="le_leader">
						<option value="<?php echo utf8_encode($result_leader['id_user']);?>" selected="selected"><?php echo utf8_encode($result_leader['prenom']);?> <?php echo utf8_encode($result_leader['nom']);?></option>
						<?php foreach ($query_leader2 as $key => $value2) {?>
						<option value="<?php echo utf8_encode($value2['id_user']);?>"><?php echo utf8_encode($value2['prenom']);?> <?php echo utf8_encode($value2['nom']);?></option>
						<?php }?>
					</select>
				</div>
				<button class="btn btn-primary btn-lg remove_us" style="float:left;width: 33%;">Supprimer l'utilisateur</button>

				<a class="btn btn-primary btn-lg send_mail" style="float:left;width: 33%; background: grey">Envoyer l'email</a>

				<button class="btn btn-primary btn-lg  modif_us" style="float:left;width:33%;background: #1ed760;color: white;">Modifier l'utilisateur</button>
			</div>


		</div>

	</form>
	<?php
}

if (isset($_POST['send_mail'])) {
	$id = $_POST['send_mail'];
	$mail = $_POST['mail'];
	$token = substr(md5(rand()),0,5);
	$query_token = $bdd->prepare("UPDATE user SET token = ? where id_user = ?");
	$query_token->bindParam(1, $token);
	$query_token->bindParam(2, $id);
	$query_token->execute();

	//envoi du mail de récupération
	$to      = $mail;
	$subject = 'Création de mot de passe';
	$message = 'Bonjour, <br>
	Vous avez demandé la création du mot de passe <br>
	Rendez-vous ici : hloevenbruck.ovh/nouvelle_charte/login.php?token='.$token;
	$headers = 'From: info@example.com' . "\r\n" .
	'Reply-To: info@example.com' . "\r\n" .
	'X-Mailer: PHP/' . phpversion();
	mail($to, $subject, $message, $headers);
}


if (isset($_GET['page'])) {
	$get=$_GET['page'];
	$query_get=$bdd->prepare("SELECT lien FROM pointcheck where id_check = ?");
	$query_get->bindParam(1, $get);
	$query_get->execute();
	$page=$query_get->fetch();
	echo $page['lien'];
}

if(isset($_POST['stat_controleur'])){
	$stat_controleur=$_POST['stat_controleur'];
	// $date_control=date('Y-m-d');
	$debut_tempo = $_POST['debut_cont'];
	$fin_tempo = $_POST['fin_cont'];
	$date_tempo = str_replace('/', '-', $debut_tempo);
	$debut =  date('Y-m-d', strtotime($date_tempo));
	$date_tempo = str_replace('/', '-', $fin_tempo);
	$fin =  date('Y-m-d', strtotime($date_tempo));
	$query_stats_control=$bdd->prepare("SELECT user.id_user, prenom, nom, sum(nb_validation_maquette) as nb_validation_maquette, sum(nb_retour_maquette) as nb_retour_maquette, sum(nb_validation_cq) as nb_validation_cq, sum(nb_retour_cq) as nb_retour_cq FROM stat_controle inner join user on stat_controle.id_controleur = user.id_user where date_stat_control >= ? and date_stat_control <= ? group by id_controleur");
	$query_stats_control->bindParam(1, $debut);
	$query_stats_control->bindParam(2, $fin);
	$query_stats_control->execute();
	foreach ($query_stats_control as $key => $value) {
		$total_control=$value['nb_validation_maquette']+$value['nb_retour_maquette']+$value['nb_validation_cq']+$value['nb_retour_cq'];
		?>
		<div class="col-xl-4 col-lg-4 col-md-5 col-sm-12 col-xs-12 graphique_control">
			<input type="hidden" value="<?php echo $value['id_user'];?>" class="controleur">
			<div class="ui-block" data-mh="pie-chart">
				<div class="ui-block-title">
					<div class="h6 title">Stats Controles <?php echo utf8_encode($value['prenom']);?></div>
					<a href="#" class="more"><svg class="olymp-three-dots-icon"><use xlink:href="../icons/icons.svg#olymp-three-dots-icon"></use></svg></a>
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
		<?php
	}
	$query_stats_control_total=$bdd->prepare("SELECT sum(nb_validation_maquette) as nb_validation_maquette, sum(nb_retour_maquette) as nb_retour_maquette, sum(nb_validation_cq) as nb_validation_cq, sum(nb_retour_cq) as nb_retour_cq FROM stat_controle where date_stat_control >= ? and date_stat_control <= ?");
	$query_stats_control_total->bindParam(1, $debut);
	$query_stats_control_total->bindParam(2, $fin);
	$query_stats_control_total->execute();
	foreach ($query_stats_control_total as $key => $value) {
		$total_control=$value['nb_validation_maquette']+$value['nb_retour_maquette']+$value['nb_validation_cq']+$value['nb_retour_cq'];
		?>
		<div class="col-xl-4 col-lg-4 col-md-5 col-sm-12 col-xs-12 graphique_control_total">
			<input type="hidden" class="controleur">
			<div class="ui-block" data-mh="pie-chart">
				<div class="ui-block-title">
					<div class="h6 title">Stats Controles Total</div>
					<a href="#" class="more"><svg class="olymp-three-dots-icon"><use xlink:href="../icons/icons.svg#olymp-three-dots-icon"></use></svg></a>
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
							<canvas id="pie-color-chart-total" width="180" height="180"></canvas>
							<div class="general-statistics"><?php echo $total_control;?>
								<span>Actions totales</span>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
		<?php }
// $result=$query_stats_control->fetchAll();
// print_r(json_encode($result));
	}
	if(isset($_POST['stat_controleur_dessin'])){
	// $date_control=date('Y-m-d');
		$control=$_POST['stat_controleur_dessin'];
		$debut_tempo = $_POST['debut_cont'];
		$fin_tempo = $_POST['fin_cont'];
		$date_tempo = str_replace('/', '-', $debut_tempo);
		$debut =  date('Y-m-d', strtotime($date_tempo));
		$date_tempo = str_replace('/', '-', $fin_tempo);
		$fin =  date('Y-m-d', strtotime($date_tempo));
		$query_stats_control=$bdd->prepare("SELECT user.id_user, prenom, nom, sum(nb_validation_maquette) as nb_validation_maquette, sum(nb_retour_maquette) as nb_retour_maquette, sum(nb_validation_cq) as nb_validation_cq, sum(nb_retour_cq) as nb_retour_cq FROM stat_controle inner join user on stat_controle.id_controleur = user.id_user where date_stat_control >= ? and date_stat_control <= ? and id_controleur = ? group by id_controleur");
		$query_stats_control->bindParam(1, $debut);
		$query_stats_control->bindParam(2, $fin);
		$query_stats_control->bindParam(3, $control);
		$query_stats_control->execute();
		$result=$query_stats_control->fetch();
		print_r(json_encode($result));
	}
	if(isset($_POST['stat_controleur_dessin_total'])){
	// $date_control=date('Y-m-d');
		$debut_tempo = $_POST['debut_cont'];
		$fin_tempo = $_POST['fin_cont'];
		$date_tempo = str_replace('/', '-', $debut_tempo);
		$debut =  date('Y-m-d', strtotime($date_tempo));
		$date_tempo = str_replace('/', '-', $fin_tempo);
		$fin =  date('Y-m-d', strtotime($date_tempo));
		$query_stats_control=$bdd->prepare("SELECT sum(nb_validation_maquette) as nb_validation_maquette, sum(nb_retour_maquette) as nb_retour_maquette, sum(nb_validation_cq) as nb_validation_cq, sum(nb_retour_cq) as nb_retour_cq FROM stat_controle where date_stat_control >= ? and date_stat_control <= ?");
		$query_stats_control->bindParam(1, $debut);
		$query_stats_control->bindParam(2, $fin);
		$query_stats_control->execute();
		$result=$query_stats_control->fetch();
		print_r(json_encode($result));
	}

	if(isset($_POST['stat_controleur_total'])){
// $date_control=date('Y-m-d');
		$debut_tempo = $_POST['debut_cont'];
		$fin_tempo = $_POST['fin_cont'];
		$date_tempo = str_replace('/', '-', $debut_tempo);
		$debut =  date('Y-m-d', strtotime($date_tempo));
		$date_tempo = str_replace('/', '-', $fin_tempo);
		$fin =  date('Y-m-d', strtotime($date_tempo));
		$query_stats_control_total=$bdd->prepare("SELECT sum(nb_validation_maquette) as val_maquette_toto, sum(nb_retour_maquette) as retour_maquette_toto, sum(nb_validation_cq) as val_cq_toto, sum(nb_retour_cq) as retour_cq_toto FROM stat_controle where date_stat_control >= ? and date_stat_control <= ?");
		$query_stats_control_total->bindParam(1, $debut);
		$query_stats_control_total->bindParam(2, $fin);
		$query_stats_control_total->execute();
		$resultat_total_control=$query_stats_control_total->fetch();
		print_r(json_encode($resultat_total_control));
	}

	if (isset($_POST['code_stat'])) {
		$id_graph=$_COOKIE['id_graph'];
		$annee=date('Y');
		$tableau = array();
		for ($i=1; $i <= 12; $i++) {
			if($i<10){
				$u="0".$i;
			}else{
				$u=$i;
			}
			$varsearch = "%" . $annee . "-". $u ."%";
			$query=$bdd->prepare("SELECT id_code FROM code where date_code like ? and id_user = ? and accept_code = 1");
			$query->bindParam(1, $varsearch);
			$query->bindParam(2, $id_graph);
			$query->execute();
			$tableau[]= $query->rowCount();
		}
		print_r(json_encode($tableau));
	}

	if (isset($_POST['achat_stat'])) {
		$id_graph=$_COOKIE['id_graph'];
		$annee=date('Y');
		$tableau = array();
		for ($i=1; $i <= 12; $i++) {
			if($i<10){
				$u="0".$i;
			}else{
				$u=$i;
			}
			$varsearch = "%" . $annee . "-". $u ."%";
			$query=$bdd->prepare("SELECT id_achat FROM achat_photos where date_achat like ? and id_graph = ?");
			$query->bindParam(1, $varsearch);
			$query->bindParam(2, $id_graph);
			$query->execute();
			$tableau[]= $query->rowCount();
		}
		print_r(json_encode($tableau));
	}

	if (isset($_POST['aide_stat'])) {
		$id_graph=$_COOKIE['id_graph'];
		$annee=date('Y');
		$tableau = array();
		for ($i=1; $i <= 12; $i++) {
			if($i<10){
				$u="0".$i;
			}else{
				$u=$i;
			}
			$varsearch = "%" . $annee . "-". $u ."%";
			$query=$bdd->prepare("SELECT id_aide FROM aide where date_aide like ? and id_user = ?");
			$query->bindParam(1, $varsearch);
			$query->bindParam(2, $id_graph);
			$query->execute();
			$tableau[]= $query->rowCount();
		}
		print_r(json_encode($tableau));
	}

	if(isset($_POST['stat_total'])){
		$id_graph=$_COOKIE['id_graph'];
		$annee=date('Y');
		$tableau = array();
		$varsearch = "%" . $annee . "-%";
		$query=$bdd->prepare("SELECT id_code FROM code where date_code like ? and id_user = ? and accept_code = 1");
		$query->bindParam(1, $varsearch);
		$query->bindParam(2, $id_graph);
		$query->execute();
		$tableau[]= $query->rowCount();
		$query=$bdd->prepare("SELECT id_achat FROM achat_photos where date_achat like ? and id_graph = ?");
		$query->bindParam(1, $varsearch);
		$query->bindParam(2, $id_graph);
		$query->execute();
		$tableau[]= $query->rowCount();
		$query=$bdd->prepare("SELECT id_aide FROM aide where date_aide like ? and id_user = ?");
		$query->bindParam(1, $varsearch);
		$query->bindParam(2, $id_graph);
		$query->execute();
		$tableau[]= $query->rowCount();
		print_r(json_encode($tableau));
	}
	if (isset($_POST['code_stat_date'])) {
		$id_graph=$_COOKIE['id_graph'];
		$annee=$_POST['code_stat_date'];
		$tableau = array();
		for ($i=1; $i <= 12; $i++) {
			if($i<10){
				$u="0".$i;
			}else{
				$u=$i;
			}
			$varsearch = "%" . $annee . "-". $u ."%";
			$query=$bdd->prepare("SELECT id_code FROM code where date_code like ? and id_user = ? and accept_code = 1");
			$query->bindParam(1, $varsearch);
			$query->bindParam(2, $id_graph);
			$query->execute();
			$tableau[]= $query->rowCount();
		}
		print_r(json_encode($tableau));
	}

	if (isset($_POST['achat_stat_date'])) {
		$id_graph=$_COOKIE['id_graph'];
		$annee=$_POST['achat_stat_date'];
		$tableau = array();
		for ($i=1; $i <= 12; $i++) {
			if($i<10){
				$u="0".$i;
			}else{
				$u=$i;
			}
			$varsearch = "%" . $annee . "-". $u ."%";
			$query=$bdd->prepare("SELECT id_achat FROM achat_photos where date_achat like ? and id_graph = ?");
			$query->bindParam(1, $varsearch);
			$query->bindParam(2, $id_graph);
			$query->execute();
			$tableau[]= $query->rowCount();
		}
		print_r(json_encode($tableau));
	}

	if (isset($_POST['aide_stat_date'])) {
		$id_graph=$_COOKIE['id_graph'];
		$annee=$_POST['aide_stat_date'];
		$tableau = array();
		for ($i=1; $i <= 12; $i++) {
			if($i<10){
				$u="0".$i;
			}else{
				$u=$i;
			}
			$varsearch = "%" . $annee . "-". $u ."%";
			$query=$bdd->prepare("SELECT id_aide FROM aide where date_aide like ? and id_user = ?");
			$query->bindParam(1, $varsearch);
			$query->bindParam(2, $id_graph);
			$query->execute();
			$tableau[]= $query->rowCount();
		}
		print_r(json_encode($tableau));
	}

	if(isset($_POST['stat_total_date'])){
		$id_graph=$_COOKIE['id_graph'];
		$annee=$_POST['stat_total_date'];
		$tableau = array();
		$varsearch = "%" . $annee . "-%";
		$query=$bdd->prepare("SELECT id_code FROM code where date_code like ? and id_user = ? and accept_code = 1");
		$query->bindParam(1, $varsearch);
		$query->bindParam(2, $id_graph);
		$query->execute();
		$tableau[]= $query->rowCount();
		$query=$bdd->prepare("SELECT id_achat FROM achat_photos where date_achat like ? and id_graph = ?");
		$query->bindParam(1, $varsearch);
		$query->bindParam(2, $id_graph);
		$query->execute();
		$tableau[]= $query->rowCount();
		$query=$bdd->prepare("SELECT id_aide FROM aide where date_aide like ? and id_user = ?");
		$query->bindParam(1, $varsearch);
		$query->bindParam(2, $id_graph);
		$query->execute();
		$tableau[]= $query->rowCount();
		print_r(json_encode($tableau));
	}

	if(isset($_POST['nb_code'])){
		$id_graph=$_COOKIE['id_graph'];
		$annee=$_POST['nb_code'];
		$varsearch = "%" . $annee . "-%";
		$query=$bdd->prepare("SELECT id_code FROM code where date_code like ? and id_user = ? and accept_code = 1");
		$query->bindParam(1, $varsearch);
		$query->bindParam(2, $id_graph);
		$query->execute();
		echo $query->rowCount();
	}

	if(isset($_POST['nb_achat'])){
		$id_graph=$_COOKIE['id_graph'];
		$annee=$_POST['nb_achat'];
		$varsearch = "%" . $annee . "-%";
		$query=$bdd->prepare("SELECT id_achat FROM achat_photos where date_achat like ? and id_graph = ?");
		$query->bindParam(1, $varsearch);
		$query->bindParam(2, $id_graph);
		$query->execute();
		echo $query->rowCount();
	}

	if(isset($_POST['nb_aide'])){
		$id_graph=$_COOKIE['id_graph'];
		$annee=$_POST['nb_aide'];
		$varsearch = "%" . $annee . "-%";
		$query=$bdd->prepare("SELECT id_aide FROM aide where date_aide like ? and id_user = ?");
		$query->bindParam(1, $varsearch);
		$query->bindParam(2, $id_graph);
		$query->execute();
		echo $query->rowCount();
	}
// stat.php pour chaque graph
	if (isset($_POST['code_stat_date_graph'])) {
		$id_graph=$_COOKIE['id_graph'];
		$annee=$_POST['code_stat_date_annee'];
		$graph=$_POST['code_stat_date_graph'];
		$tableau = array();
		for ($i=1; $i <= 12; $i++) {
			if($i<10){
				$u="0".$i;
			}else{
				$u=$i;
			}
			$varsearch = "%" . $annee . "-". $u ."%";
			$query=$bdd->prepare("SELECT id_code FROM code where date_code like ? and id_user = ? and accept_code = 1");
			$query->bindParam(1, $varsearch);
			$query->bindParam(2, $graph);
			$query->execute();
			$tableau[]= $query->rowCount();
		}
		print_r(json_encode($tableau));
	}

	if (isset($_POST['achat_stat_date_graph'])) {
		$id_graph=$_COOKIE['id_graph'];
		$annee=$_POST['achat_stat_date_annee'];
		$graph=$_POST['achat_stat_date_graph'];
		$tableau = array();
		for ($i=1; $i <= 12; $i++) {
			if($i<10){
				$u="0".$i;
			}else{
				$u=$i;
			}
			$varsearch = "%" . $annee . "-". $u ."%";
			$query=$bdd->prepare("SELECT id_achat FROM achat_photos where date_achat like ? and id_graph = ?");
			$query->bindParam(1, $varsearch);
			$query->bindParam(2, $graph);
			$query->execute();
			$tableau[]= $query->rowCount();
		}
		print_r(json_encode($tableau));
	}

	if (isset($_POST['aide_stat_date_graph'])) {
		$id_graph=$_COOKIE['id_graph'];
		$annee=$_POST['aide_stat_date_annee'];
		$graph=$_POST['aide_stat_date_graph'];
		$tableau = array();
		for ($i=1; $i <= 12; $i++) {
			if($i<10){
				$u="0".$i;
			}else{
				$u=$i;
			}
			$varsearch = "%" . $annee . "-". $u ."%";
			$query=$bdd->prepare("SELECT id_aide FROM aide where date_aide like ? and id_user = ?");
			$query->bindParam(1, $varsearch);
			$query->bindParam(2, $graph);
			$query->execute();
			$tableau[]= $query->rowCount();
		}
		print_r(json_encode($tableau));
	}

	if(isset($_POST['stat_total_date_graph'])){
		$id_graph=$_COOKIE['id_graph'];
		$annee=$_POST['stat_total_date_annee'];
		$graph=$_POST['stat_total_date_graph'];
		$tableau = array();
		$varsearch = "%" . $annee . "-%";
		$query=$bdd->prepare("SELECT id_code FROM code where date_code like ? and id_user = ? and accept_code = 1");
		$query->bindParam(1, $varsearch);
		$query->bindParam(2, $graph);
		$query->execute();
		$tableau[]= $query->rowCount();
		$query=$bdd->prepare("SELECT id_achat FROM achat_photos where date_achat like ? and id_graph = ?");
		$query->bindParam(1, $varsearch);
		$query->bindParam(2, $graph);
		$query->execute();
		$tableau[]= $query->rowCount();
		$query=$bdd->prepare("SELECT id_aide FROM aide where date_aide like ? and id_user = ?");
		$query->bindParam(1, $varsearch);
		$query->bindParam(2, $graph);
		$query->execute();
		$tableau[]= $query->rowCount();
		print_r(json_encode($tableau));
	}

	if(isset($_POST['nb_code_graph'])){
		$id_graph=$_COOKIE['id_graph'];
		$annee=$_POST['nb_code_annee'];
		$graph=$_POST['nb_code_graph'];
		$varsearch = "%" . $annee . "-%";
		$query=$bdd->prepare("SELECT id_code FROM code where date_code like ? and id_user = ? and accept_code = 1");
		$query->bindParam(1, $varsearch);
		$query->bindParam(2, $graph);
		$query->execute();
		echo $query->rowCount();
	}

	if(isset($_POST['nb_achat_graph'])){
		$id_graph=$_COOKIE['id_graph'];
		$annee=$_POST['nb_achat_annee'];
		$graph=$_POST['nb_achat_graph'];
		$varsearch = "%" . $annee . "-%";
		$query=$bdd->prepare("SELECT id_achat FROM achat_photos where date_achat like ? and id_graph = ?");
		$query->bindParam(1, $varsearch);
		$query->bindParam(2, $graph);
		$query->execute();
		echo $query->rowCount();
	}

	if(isset($_POST['nb_aide_graph'])){
		$id_graph=$_COOKIE['id_graph'];
		$annee=$_POST['nb_aide_annee'];
		$graph=$_POST['nb_aide_graph'];
		$varsearch = "%" . $annee . "-%";
		$query=$bdd->prepare("SELECT id_aide FROM aide where date_aide like ? and id_user = ?");
		$query->bindParam(1, $varsearch);
		$query->bindParam(2, $graph);
		$query->execute();
		echo $query->rowCount();
	}


	if(isset($_POST['remontees_search'])){
		$search = utf8_decode($_POST['remontees_search']);
		$varsearch = "%" . $search . "%";
		$requete_search = $bdd->prepare("SELECT * FROM remontees left join user on remontees.id_user=user.id_user left join categorie_remontees on remontees.id_categorie_remontees = categorie_remontees.id_categorie_remontees left join etat_remontees on remontees.accept_remontees = etat_remontees.id_etat_remontees WHERE titre LIKE ? or description LIKE ? or ref LIKE ? or nom LIKE ? or prenom LIKE ? order by date_remontees DESC");
		$requete_search->bindParam(1, $varsearch);
		$requete_search->bindParam(2, $varsearch);
		$requete_search->bindParam(3, $varsearch);
		$requete_search->bindParam(4, $varsearch);
		$requete_search->bindParam(5, $varsearch);
		$requete_search->execute();
		$nb_result = $requete_search->rowCount();
		$tab_search = array();
		if ($nb_result == 0) {?>
		<tr class="event-item">
			<td class="upcoming">
				<div class="date-event">
					<h2>Aucun résultat n'a été trouvé</h2>
				</div>
			</td>
		</tr>
		<?php }else{
			foreach ($requete_search as $key => $value) { 
				$id_remontees=$value['id_remontees'];
				$query_get_number = $bdd->prepare("SELECT * FROM commentaires_remontees WHERE id_remontees = ?");
				$query_get_number->bindParam(1, $id_remontees);
				$query_get_number->execute();
				$result = $query_get_number->rowCount();
				?>
				<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12 grid-item sorting-item cat_<?php echo($value['id_categorie_remontees']) ?>  etat_<?php echo($value['id_etat_remontees']) ?>">
					<!-- Post -->
					<article class="hentry post video no-padd" data-id="<?php echo $value['id_remontees'] ?>">
						<div class="post__author author vcard inline-items">
							<div class="wrapper">
								<div class="infos">
									<img src="../<?php echo utf8_encode($value['photo_avatar']);?>" alt="author">
									<div class="author-date">
										<p class="h6 post__author-name fn"><?php echo utf8_encode($value['nom'].' '.$value['prenom']);?></p>
										<div class="post__date">
											<time class="published">
												<?php echo time_elapsed_string($value['date_remontees']);?>
											</time>
										</div>
									</div>
									<?php if ($_COOKIE['id_statut'] == 4 || $_COOKIE['id_statut'] == 5 && empty($value['kats'])) { ?>
									<a href="" class="show_kats" data-toggle="modal" data-target="#kats">AJOUTER KATS</a>
									<?php } ?>
									<p class="categorie_remontees h6 post__author-name fn"><?php echo utf8_encode($value['categorie_remontees']);?></p>
									<?php 	if ($id_graph == $value['id_user'] || $_COOKIE['id_statut'] == 4 || $_COOKIE['id_statut'] == 5) {?>
									<div class="more">
										<svg class="olymp-three-dots-icon">
											<use xlink:href="../icons/icons.svg#olymp-three-dots-icon"></use>
										</svg>
										<ul class="more-dropdown">
											<li>
												<a class="edit_remontees">Modifier le ticket</a>
											</li>
											<li>
												<a class="delete_remontees">Supprimer le ticket</a>
											</li>
										</ul>
									</div>
									<?php } ?>
								</div>

								<div class="wrapper_content" contenteditable="false">
									<?php if (!empty($value['file'])) { ?>
									<a data-fancybox="gallery" href="../uploads/remontees/<?php echo utf8_decode($value['file']);?>"><img class="img_remontees" src="../uploads/remontees/<?php echo utf8_decode($value['file']);?>"></a>
									<?php } ?>
									<h4 class="titre"><?php echo utf8_encode($value['titre']);?></h4>
									<p><?php echo htmlentities(utf8_encode($value['description']));?></p>
								</div>
								<p class="ref">Réference : <?php echo utf8_encode($value['ref']);?></p>
							</div>
							<div class="post-additional-info inline-items chat">
								<div class="comments-shared">
									<a class="post-add-icon inline-items">
										<svg class="olymp-speech-balloon-icon">
											<use xlink:href="../icons/icons.svg#olymp-speech-balloon-icon"></use>
										</svg>
										<span><?php echo $result; ?></span>
									</a>
								</div>
								<div class="comments_wrapper">
									<ul>
									</ul>
									<form class="comment-form inline-items pt">
										<div class="post__author author vcard inline-items">
											<img src="../<?php echo utf8_encode($result_user['photo_avatar']);?>" alt="author">
											<div class="form-group with-icon-right ">
												<textarea class="form-control commentaires" ></textarea>
												<div class="add-options-message ajout_com_remontees>">
													<a class="options-message">
														<svg class="olymp-chat---messages-icon"><use xlink:href="../icons/icons.svg#olymp-chat---messages-icon"></use></svg>
													</a>
												</div>
											</div>
										</div>
									</form>								
								</div>
							</div>
							<input type="hidden" class="id_remontees" value="<?php echo $value['id_remontees'] ?>">
							<input type="hidden" class="etat" value="<?php echo $value['accept_remontees'] ?>">
							<?php if ($_COOKIE['id_statut'] == 4 || $_COOKIE['id_statut'] == 5) { ?>
							<div class="control-block-button post-control-button">
								<a href="#" class="btn btn-control refuser_remontees" data-toggle="tooltip" data-placement="right" data-original-title="Refuser remontées">
									<svg class="olymp-like-post-icon">
										<use xlink:href="../icons/icons.svg#olymp-close-icon"></use>
									</svg>
								</a>
								<a href="#" class="btn btn-control traitement_remontees" data-toggle="tooltip" data-placement="right" data-original-title="Traitement remontées">
									<svg class="olymp-comments-post-icon">
										<use xlink:href="../icons/icons.svg#olymp-three-dots-icon"></use>
									</svg>
								</a>
								<a href="#" class="btn btn-control accepter_remontees" data-toggle="tooltip" data-placement="right" data-original-title="Accepeter remontées">
									<svg class="olymp-share-icon">
										<use xlink:href="../icons/icons.svg#olymp-check-icon"></use>
									</svg>
								</a>
								<?php if (!empty($value['kats'])) { ?>
								<a href="<?php echo utf8_encode($value['kats']);?>" class="btn btn-control kats"  data-toggle="tooltip" data-placement="right" data-original-title="Kats">
									K
								</a>
								<?php } ?>
							</div>
							<?php }else {
								if($value['id_etat_remontees'] == 1){ ?>
								<div class="control-block-button post-control-button">
									<a href="#" class="btn btn-control pending_remontees" data-toggle="tooltip" data-placement="right" data-original-title="Remontée en attente">
										<svg class="olymp-like-post-icon">
											<use xlink:href="../icons/icons.svg#olymp-popup-right-arrow"></use>
										</svg>
									</a>
								</div>
								<?php }else if ($value['id_etat_remontees'] == 2) { ?>
								<div class="control-block-button post-control-button">
									<a href="#" class="btn btn-control refuser"  data-toggle="tooltip" data-placement="right" data-original-title="Remontée refusée">
										<svg class="olymp-like-post-icon">
											<use xlink:href="../icons/icons.svg#olymp-close-icon"></use>
										</svg>
									</a>
								</div>
								<?php	}else if($value['id_etat_remontees'] == 3){?>
								<div class="control-block-button post-control-button">
									<a href="#" class="btn btn-control traitement"  data-toggle="tooltip" data-placement="right" data-original-title="Remontées en cours de traitement">
										<svg class="olymp-comments-post-icon">
											<use xlink:href="../icons/icons.svg#olymp-three-dots-icon"></use>
										</svg>
									</a>
								</div>
								<?php }else{ ?>
								<div class="control-block-button post-control-button">
									<a href="#" class="btn btn-control accepter"  data-toggle="tooltip" data-placement="right" data-original-title="Remontée traitée">
										<svg class="olymp-share-icon">
											<use xlink:href="../icons/icons.svg#olymp-check-icon"></use>
										</svg>
									</a>
								</div>
								<?php } if (!empty($value['kats'])) { ?>
								<div class="control-block-button post-control-button kats-btn">
									<a href="<?php echo utf8_encode($value['kats']);?>" class="btn btn-control kats"  data-toggle="tooltip" data-placement="right" data-original-title="Lien du KATS">
										K
									</a>
								</div>
								<?php }} ?>
							</article>
							<!-- .. end Post -->
						</div>
						<?php
					}
				}
			}

			if(isset($_POST['remontees_search_empty'])){
				$requete_search = $bdd->prepare("SELECT * FROM remontees left join user on remontees.id_user=user.id_user left join categorie_remontees on remontees.id_categorie_remontees = categorie_remontees.id_categorie_remontees left join etat_remontees on etat_remontees.id_etat_remontees = remontees.accept_remontees order by date_remontees DESC");
				$requete_search->execute();
				$nb_result = $requete_search->rowCount();
				$tab_search = array();
				foreach ($requete_search as $key => $value) {
					$id_remontees=$value['id_remontees'];
					$query_get_number = $bdd->prepare("SELECT * FROM commentaires_remontees WHERE id_remontees = ?");
					$query_get_number->bindParam(1, $id_remontees);
					$query_get_number->execute();
					$result = $query_get_number->rowCount();
					?>
					<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12 grid-item sorting-item cat_<?php echo($value['id_categorie_remontees']) ?>  etat_<?php echo($value['id_etat_remontees']) ?>">
						<!-- Post -->
						<article class="hentry post video no-padd" data-id="<?php echo $value['id_remontees'] ?>">
							<div class="post__author author vcard inline-items">
								<div class="wrapper">
									<div class="infos">
										<img src="../<?php echo utf8_encode($value['photo_avatar']);?>" alt="author">
										<div class="author-date">
											<p class="h6 post__author-name fn"><?php echo utf8_encode($value['nom'].' '.$value['prenom']);?></p>
											<div class="post__date">
												<time class="published">
													<?php echo time_elapsed_string($value['date_remontees']);?>
												</time>
											</div>
										</div>
										<?php if ($_COOKIE['id_statut'] == 4 || $_COOKIE['id_statut'] == 5 && empty($value['kats'])) { ?>
										<a href="" class="show_kats" data-toggle="modal" data-target="#kats">AJOUTER KATS</a>
										<?php } ?>
										<p class="categorie_remontees h6 post__author-name fn"><?php echo utf8_encode($value['categorie_remontees']);?></p>
										<?php 	if ($id_graph == $value['id_user'] || $_COOKIE['id_statut'] == 4 || $_COOKIE['id_statut'] == 5) {?>
										<div class="more">
											<svg class="olymp-three-dots-icon">
												<use xlink:href="../icons/icons.svg#olymp-three-dots-icon"></use>
											</svg>
											<ul class="more-dropdown">
												<li>
													<a class="edit_remontees">Modifier le ticket</a>
												</li>
												<li>
													<a class="delete_remontees">Supprimer le ticket</a>
												</li>
											</ul>
										</div>
										<?php } ?>
									</div>

									<div class="wrapper_content" contenteditable="false">
										<?php if (!empty($value['file'])) { ?>
										<a data-fancybox="gallery" href="../uploads/remontees/<?php echo utf8_decode($value['file']);?>"><img class="img_remontees" src="../uploads/remontees/<?php echo utf8_decode($value['file']);?>"></a>
										<?php } ?>
										<h4 class="titre"><?php echo utf8_encode($value['titre']);?></h4>
										<p><?php echo htmlentities(utf8_encode($value['description']));?></p>
									</div>
									<p class="ref">Réference : <?php echo utf8_encode($value['ref']);?></p>
								</div>
								<div class="post-additional-info inline-items chat">
									<div class="comments-shared">
										<a class="post-add-icon inline-items">
											<svg class="olymp-speech-balloon-icon">
												<use xlink:href="../icons/icons.svg#olymp-speech-balloon-icon"></use>
											</svg>
											<span><?php echo $result; ?></span>
										</a>
									</div>
									<div class="comments_wrapper">
										<ul>
										</ul>
										<form class="comment-form inline-items pt">
											<div class="post__author author vcard inline-items">
												<img src="../<?php echo utf8_encode($result_user['photo_avatar']);?>" alt="author">
												<div class="form-group with-icon-right ">
													<textarea class="form-control commentaires" ></textarea>
													<div class="add-options-message ajout_com_remontees>">
														<a class="options-message">
															<svg class="olymp-chat---messages-icon"><use xlink:href="../icons/icons.svg#olymp-chat---messages-icon"></use></svg>
														</a>
													</div>
												</div>
											</div>
										</form>								
									</div>
								</div>
								<input type="hidden" class="id_remontees" value="<?php echo $value['id_remontees'] ?>">
								<input type="hidden" class="etat" value="<?php echo $value['accept_remontees'] ?>">
								<?php if ($_COOKIE['id_statut'] == 4 || $_COOKIE['id_statut'] == 5) { ?>
								<div class="control-block-button post-control-button">
									<a href="#" class="btn btn-control refuser_remontees" data-toggle="tooltip" data-placement="right" data-original-title="Refuser remontées">
										<svg class="olymp-like-post-icon">
											<use xlink:href="../icons/icons.svg#olymp-close-icon"></use>
										</svg>
									</a>
									<a href="#" class="btn btn-control traitement_remontees" data-toggle="tooltip" data-placement="right" data-original-title="Traitement remontées">
										<svg class="olymp-comments-post-icon">
											<use xlink:href="../icons/icons.svg#olymp-three-dots-icon"></use>
										</svg>
									</a>
									<a href="#" class="btn btn-control accepter_remontees" data-toggle="tooltip" data-placement="right" data-original-title="Accepeter remontées">
										<svg class="olymp-share-icon">
											<use xlink:href="../icons/icons.svg#olymp-check-icon"></use>
										</svg>
									</a>
									<?php if (!empty($value['kats'])) { ?>
									<a href="<?php echo utf8_encode($value['kats']);?>" class="btn btn-control kats"  data-toggle="tooltip" data-placement="right" data-original-title="Kats">
										K
									</a>
									<?php } ?>
								</div>
								<?php }else {
									if($value['id_etat_remontees'] == 1){ ?>
									<div class="control-block-button post-control-button">
										<a href="#" class="btn btn-control pending_remontees" data-toggle="tooltip" data-placement="right" data-original-title="Remontée en attente">
											<svg class="olymp-like-post-icon">
												<use xlink:href="../icons/icons.svg#olymp-popup-right-arrow"></use>
											</svg>
										</a>
									</div>
									<?php }else if ($value['id_etat_remontees'] == 2) { ?>
									<div class="control-block-button post-control-button">
										<a href="#" class="btn btn-control refuser"  data-toggle="tooltip" data-placement="right" data-original-title="Remontée refusée">
											<svg class="olymp-like-post-icon">
												<use xlink:href="../icons/icons.svg#olymp-close-icon"></use>
											</svg>
										</a>
									</div>
									<?php	}else if($value['id_etat_remontees'] == 3){?>
									<div class="control-block-button post-control-button">
										<a href="#" class="btn btn-control traitement"  data-toggle="tooltip" data-placement="right" data-original-title="Remontées en cours de traitement">
											<svg class="olymp-comments-post-icon">
												<use xlink:href="../icons/icons.svg#olymp-three-dots-icon"></use>
											</svg>
										</a>
									</div>
									<?php }else{ ?>
									<div class="control-block-button post-control-button">
										<a href="#" class="btn btn-control accepter"  data-toggle="tooltip" data-placement="right" data-original-title="Remontée traitée">
											<svg class="olymp-share-icon">
												<use xlink:href="../icons/icons.svg#olymp-check-icon"></use>
											</svg>
										</a>
									</div>
									<?php } if (!empty($value['kats'])) { ?>
									<div class="control-block-button post-control-button kats-btn">
										<a href="<?php echo utf8_encode($value['kats']);?>" class="btn btn-control kats"  data-toggle="tooltip" data-placement="right" data-original-title="Lien du KATS">
											K
										</a>
									</div>
									<?php }} ?>
								</article>
								<!-- .. end Post -->
							</div>
							<?php
						}
					}

					if(isset($_POST['remove_user_moderation'])){
						$id_user=$_POST['remove_user_moderation'];
						$query=$bdd->prepare("DELETE FROM user where id_user = ?");
						$query->bindParam(1, $id_user);
						$query->execute();
					}

					if(isset($_POST['admin_help_search'])){
						$search = utf8_decode($_POST['admin_help_search']);
						$varsearch = "%" . $search . "%";
						$requete_search_admin = $bdd->prepare("SELECT * FROM aide left join user on aide.id_user=user.id_user inner join etat_aide on aide.id_etat_aide = etat_aide.id_etat_aide WHERE titre LIKE ? or description LIKE ? or id_client LIKE ? order by date_aide DESC");
						$requete_search_admin->bindParam(1, $varsearch);
						$requete_search_admin->bindParam(2, $varsearch);
						$requete_search_admin->bindParam(3, $varsearch);
						$requete_search_admin->execute();
						$nb_result = $requete_search_admin->rowCount();
						$tab_search = array();
						if ($nb_result == 0) {?>
						<tr class="event-item">
							<td class="upcoming">
								<div class="date-event">
									<h2>Aucun résultat n'a été trouvé</h2>
								</div>
							</td>
						</tr>
						<?php }else{
							foreach ($requete_search_admin as $key => $value) {
								$date_tab=explode("-", $value['date_aide']);
								$jour_tab=explode(" ",$date_tab[2]);
								$jour=$jour_tab[0];
								$m=$date_tab[1];
								$months = array (1=>'Jan',2=>'Fev',3=>'Mar',4=>'Avr',5=>'Mai',6=>'Juin',7=>'Juil',8=>'Aout',9=>'Sept',10=>'Oct',11=>'Nov',12=>'Dec');
								?>
								<tr class="event-item">
									<td class="upcoming">
										<div class="date-event">
											<svg class="olymp-small-calendar-icon"><use xlink:href="../icons/icons.svg#olymp-small-calendar-icon"></use></svg>
											<span class="day"><?php echo $jour;?></span>
											<span class="month"><?php echo $months[(int)$m]; ?></span>
										</div>
									</td>
									<td class="author">
										<div class="event-author inline-items">
											<div class="author-date">
												<a class="author-name h6"><?php echo utf8_encode($value['titre']);?></a>
											</div>
										</div>
									</td>
									<td class="location">
										<div class="place inline-items">
											<svg class="olymp-add-a-place-icon"><use xlink:href="../icons/icons.svg#olymp-add-a-place-icon"></use></svg>
											<a target="_blank" style="color:inherit;"><?php echo $value['id_client'];?></a>
										</div>
									</td>
									<td class="description">
										<p class="description"><span style="font-weight: bold;">Description</span>: <?php echo shapeSpace_truncate_string_at_word(utf8_encode($value['description']),50);?></p>
									</td>
									<td class="add-event">
										<a class="btn btn-breez btn-sm moproblem" data-toggle="modal" data-user="<?php echo utf8_encode($value['prenom'].' '.$value['nom']);?>" data-id="<?php echo utf8_encode($value['id_aide']);?>" data-target="#problemos" style="background:<?php echo $value['couleur'];?>;color:white;">Ouvrir</a>
									</td>
								</tr>
								<?php
							}

						}
					}

					if(isset($_POST['admin_help_search_empty'])){
						$requete_help_empty_search = $bdd->prepare("SELECT * FROM aide left join user on aide.id_user=user.id_user inner join etat_aide on aide.id_etat_aide = etat_aide.id_etat_aide order by date_aide DESC");
						$requete_help_empty_search->execute();
						$nb_result = $requete_help_empty_search->rowCount();
						$tab_search = array();
						foreach ($requete_help_empty_search as $key => $value) {
							$date_tab=explode("-", $value['date_aide']);
							$jour_tab=explode(" ",$date_tab[2]);
							$jour=$jour_tab[0];
							$m=$date_tab[1];
							$months = array (1=>'Jan',2=>'Fev',3=>'Mar',4=>'Avr',5=>'Mai',6=>'Juin',7=>'Juil',8=>'Aout',9=>'Sept',10=>'Oct',11=>'Nov',12=>'Dec');
							?>
							<tr class="event-item">
								<td class="upcoming">
									<div class="date-event">
										<svg class="olymp-small-calendar-icon"><use xlink:href="../icons/icons.svg#olymp-small-calendar-icon"></use></svg>
										<span class="day"><?php echo $jour;?></span>
										<span class="month"><?php echo $months[(int)$m]; ?></span>
									</div>
								</td>
								<td class="author">
									<div class="event-author inline-items">
										<div class="author-date">
											<a class="author-name h6"><?php echo utf8_encode($value['titre']);?></a>
										</div>
									</div>
								</td>
								<td class="location">
									<div class="place inline-items">
										<svg class="olymp-add-a-place-icon"><use xlink:href="../icons/icons.svg#olymp-add-a-place-icon"></use></svg>
										<a target="_blank" style="color:inherit;"><?php echo $value['id_client'];?></a>
									</div>
								</td>
								<td class="description">
									<p class="description"><span style="font-weight: bold;">Description</span>: <?php echo shapeSpace_truncate_string_at_word(utf8_encode($value['description']),50);?></p>
								</td>
								<td class="add-event">
									<a class="btn btn-breez btn-sm moproblem" data-toggle="modal" data-user="<?php echo utf8_encode($value['prenom'].' '.$value['nom']);?>" data-id="<?php echo utf8_encode($value['id_aide']);?>" data-target="#problemos" style="background:<?php echo $value['couleur'];?>;color:white;">Ouvrir</a>
								</td>
							</tr>
							<?php
						}
					}

// CHANGEMENT DATE DE NAISSANCE
					if (isset($_POST['date_naissance'])) {
						$date_naissance = $_POST['date_naissance'];
						$date_tempo = str_replace('/', '-', $date_naissance);
						$debut =  date('Y-m-d', strtotime($date_tempo));
						$id_graph = $_COOKIE['id_graph'];
						$requete_changer_date = $bdd->prepare("UPDATE user SET date_naissance = ? where id_user = ?");
						$requete_changer_date->bindParam(1, $debut);
						$requete_changer_date->bindParam(2, $id_graph);
						$requete_changer_date->execute();
						echo "UPDATE user SET date_naissance = '$debut' where id_user = '$id_graph'";
					}


					if(isset($_POST['popup_anniversaire'])){
						$id_anniversaire=$_POST['popup_anniversaire'];
						$tab=array();
						$query_com_anniversaire = $bdd->prepare("SELECT * FROM commentaires_anniversaire inner join user on commentaires_anniversaire.id_user=user.id_user where id_user_anniversaire = ? order by date_commentaire DESC");
						$query_com_anniversaire->bindParam(1, $id_anniversaire);
						$query_com_anniversaire->execute();
						foreach ($query_com_anniversaire as $key_com => $value_com)
						{
							$tab[$key_com]['nom_commentaire'] = utf8_encode($value_com['prenom']." ".$value_com['nom']);
							$tab[$key_com]['commentaire'] = utf8_encode($value_com['commentaire']);
							$tab[$key_com]['date_commentaire'] = $value_com['date_commentaire'];
							$tab[$key_com]['id_commentaires_anniversaire'] = $value_com['id_commentaires_anniversaire'];
							$tab[$key_com]['photo_avatar'] = $value_com['photo_avatar'];
							$tab[$key_com]['like'] = $value_com['like_com'];
						}
						print_r(json_encode($tab));
					}

					if (isset($_POST['com_anniversaire'])) {
						$commentaire=utf8_decode($_POST['envoi_com_anniversaire']);
						$id_graph=$_COOKIE['id_graph'];
						$id_anniversaire = $_POST['id_anniversaire_com'];
						$date_com=$date=date('Y-m-d H:i:s');
						$like=0;
						$tabf=array();
						$query_ins_com = $bdd->prepare("INSERT INTO commentaires_anniversaire (id_user_anniversaire, commentaire, id_user, date_commentaire, like_com) VALUES (?, ?, ?, ?, ?)");
						$query_ins_com->bindParam(1, $id_anniversaire);
						$query_ins_com->bindParam(2, $commentaire);
						$query_ins_com->bindParam(3, $id_graph);
						$query_ins_com->bindParam(4, $date_com);
						$query_ins_com->bindParam(5, $like);
						$query_ins_com->execute();
					}

					if (isset($_POST['id_timer_anniversaire'])) {
						$id_anniversaire=$_POST['id_timer_anniversaire'];
						$id_com=$_POST['id_timer_com'];
						$query_com_aide = $bdd->prepare("SELECT * FROM commentaires_anniversaire inner join user on commentaires_anniversaire.id_user=user.id_user where id_user_anniversaire = ? and id_commentaires_anniversaire > ? order by date_commentaire ASC");
						$query_com_aide->bindParam(1, $id_anniversaire);
						$query_com_aide->bindParam(2, $id_com);
						$query_com_aide->execute();
						$tabf=array();
						foreach ($query_com_aide as $key_com => $value_com)
						{
							$tabf[$key_com]['nom_commentaire'] = utf8_encode($value_com['prenom']." ".$value_com['nom']);
							$tabf[$key_com]['commentaire'] = utf8_encode($value_com['commentaire']);
							$tabf[$key_com]['date_commentaire'] = $value_com['date_commentaire'];
							$tabf[$key_com]['id_commentaires_anniversaire'] = $value_com['id_commentaires_anniversaire'];
							$tabf[$key_com]['photo_avatar'] = $value_com['photo_avatar'];
							$tabf[$key_com]['like'] = $value_com['like_com'];
						}
						print_r(json_encode($tabf));
					}

					if (isset($_POST['categorie_template'])) {
						$categorie=$_POST['categorie_template'];
						$titre=utf8_decode($_POST['titre']);
						$shortcode=utf8_decode($_POST['shortcode']);
						$description=utf8_decode($_POST['description_template']);
						$date_com=$date=date('Y-m-d H:i:s');
						$id_graph=$_COOKIE['id_graph'];
						$accept=0;
						$previsualisation=$_POST['visu'];
						$token = $_POST['token'];
						$file="";
						$i=0;
						foreach ($previsualisation as $key => $value) {
							if ($i!=0) {
								$file.=";";
							}
							$file.=utf8_decode($token.$value);
							$i++;
						}
						$betheme=$_POST['betheme'];
						$file_betheme="";
						$i=0;
						foreach ($betheme as $key => $value) {
							if ($i!=0) {
								$file_betheme.=";";
							}
							$file_betheme.=$token.$value;
							$i++;
						}
						$slider=$_POST['slider'];
						$file_slider="";
						$i=0;
						foreach ($slider as $key => $value) {
							if ($i!=0) {
								$file_slider.=";";
							}
							$file_slider.=$token.$value;
							$i++;
						}
						$query_template = $bdd->prepare("INSERT INTO template (categorie, titre, shortcode, betheme, previsualisation, id_user, date_template, accept_template, slider, description) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
						$query_template->bindParam(1, $categorie);
						$query_template->bindParam(2, $titre);
						$query_template->bindParam(3, $shortcode);
						$query_template->bindParam(4, $file_betheme);
						$query_template->bindParam(5, $file);
						$query_template->bindParam(6, $id_graph);
						$query_template->bindParam(7, $date);
						$query_template->bindParam(8, $accept);
						$query_template->bindParam(9, $file_slider);
						$query_template->bindParam(10, $description);
						$query_template->execute();
					}

					if (isset($_POST['id_template'])) {
						$accept=1;
						$id_template=$_POST['id_template'];
						$query_accept_template = $bdd->prepare("UPDATE template SET accept_template = ? where id_template = ?");
						$query_accept_template->bindParam(1, $accept);
						$query_accept_template->bindParam(2, $id_template);
						$query_accept_template->execute();
					}

					if (isset($_POST['refus_template'])) {
						$id_template=$_POST['id_template'];
						$query_delete_template = $bdd->prepare("DELETE FROM template where id_template = ?");
						$query_delete_template->bindParam(1, $id_template);
						$query_delete_template->execute();
					}

					if (isset($_POST['lecontenu'])) {
						$lecontenu=utf8_decode($_POST['lecontenu']);
						$id_graph=$_COOKIE['id_graph'];
						$date_news=date("Y-m-d H:i:s");
						$cat=1;
						$requette_news=$bdd->prepare("INSERT INTO newsletter (id_user, content, date_creation, categorie_news) VALUES (?,?,?,?)");
						$requette_news->bindParam(1, $id_graph);
						$requette_news->bindParam(2, $lecontenu);
						$requette_news->bindParam(3, $date_news);
						$requette_news->bindParam(4, $cat);
						$requette_news->execute();
						$requette_user=$bdd->prepare("SELECT prenom, nom, photo_avatar, id_user from user where id_user = ? ");
						$requette_user->bindParam(1, $id_graph);
						$requette_user->execute();
						$result_user=$requette_user->fetch();

						$test=$bdd->prepare("SELECT id_news FROM newsletter where id_user = ? and date_creation = ?");
						$test->bindParam(1, $id_graph);
						$test->bindParam(2, $date_news);
						$test->execute();
						$id_c=$test->fetch();
						?>

						<div class="ui-block">
							<article class="hentry post">
								<input type="hidden" class="news_id" value="<?php echo $id_c['id_news'];?>">
								<div class="post__author author vcard inline-items">
									<img src="<?php echo utf8_encode($result_user['photo_avatar']);?>" alt="author">

									<div class="author-date">
										<a class="h6 post__author-name fn" href="#"><?php echo utf8_encode($result_user['prenom'].' '.$result_user['nom']);?></a>
										<div class="post__date">
											<time class="published" datetime="2004-07-24T18:18">
												<?php echo time_elapsed_string($date_news);?>
											</time>
										</div>
									</div>
									<?php
									if($result_user['id_user']==$id_graph){
										?>
										<div class="more"><svg class="olymp-three-dots-icon"><use xlink:href="../icons/icons.svg#olymp-three-dots-icon"></use></svg>
											<ul class="more-dropdown">
												<li>
													<a class="edit_news">Modifier l'article</a>
												</li>
												<li>
													<a class="delete_news">Supprimer l'article</a>
												</li>
											</ul>
										</div>
										<?php }?>
									</div>

									<?php echo utf8_encode($lecontenu);?>

									<div class="post-additional-info inline-items">

										<a href="#" class="post-add-icon inline-items">
											<svg class="olymp-heart-icon"><use xlink:href="../icons/icons.svg#olymp-heart-icon"></use></svg>
											<span>0</span>
										</a>

										<ul class="friends-harmonic">

										</ul>

										<div class="names-people-likes">

										</div>

										<div class="comments-shared">
											<a href="#" class="post-add-icon inline-items ajouter_com">
												<svg class="olymp-speech-balloon-icon"><use xlink:href="../icons/icons.svg#olymp-speech-balloon-icon"></use></svg>
												<span>0</span>
											</a>
										</div>


									</div>

								</article>

								<ul class="comments-list comments_<?php echo $id_c['id_news'];?>" style="display: none;">

								</ul>

								<form class="comment-form inline-items">
									<div class="post__author author vcard inline-items">
										<img src="<?php echo utf8_encode($result_user['photo_avatar']);?>" alt="author">
										<div class="form-group with-icon-right ">
											<textarea class="form-control" placeholder=""  class="text_news"></textarea>
											<div class="add-options-message">
												<a href="#" class="options-message">
													<svg class="olymp-chat---messages-icon"><use xlink:href="../icons/icons.svg#olymp-chat---messages-icon"></use></svg>
												</a>
											</div>
										</div>
									</div>
								</form>
							</div>

							<?php
						}

						if(isset($_POST['id_comment_news'])){
							$id=$_POST['id_comment_news'];
							$id_graph=$_COOKIE['id_graph'];
							$com_news=$bdd->prepare("SELECT * FROM commentaires_news inner join user on commentaires_news.id_user=user.id_user where id_news = ?");
							$com_news->bindParam(1, $id);
							$com_news->execute();
							foreach ($com_news as $key => $value) {
								$lecom=$value['id_commentaires_news'];
								$com_news_test=$bdd->prepare("SELECT * FROM like_com_news where id_com = ? and id_graph = ?");
								$com_news_test->bindParam(1, $lecom);
								$com_news_test->bindParam(2, $id_graph);
								$com_news_test->execute();
								$nb_l=$com_news_test->rowCount();
								?>
								<li class="liste_com com_like_<?php echo $value['id_commentaires_news'];?>">
									<div class="post__author author vcard inline-items">
										<img src="<?php echo $value['photo_avatar'];?>" alt="author">

										<div class="author-date">
											<a class="h6 post__author-name fn" href="#"><?php echo utf8_encode($value['prenom']." ".$value['nom']);?></a>
											<div class="post__date">
												<time class="published" datetime="2004-07-24T18:18">
													<?php echo time_elapsed_string($value['date_commentaire']);?>
												</time>
											</div>
										</div>

									</div>

									<p><?php echo utf8_encode($value['commentaire']);?></p>

									<a class="post-add-icon inline-items liker_com_news">
										<svg class="olymp-heart-icon" <?php if($nb_l != "0"){echo "style='fill: #ff5e3a;color: #ff5e3a;'";}?>><use xlink:href="../icons/icons.svg#olymp-heart-icon"></use></svg>
										<span <?php if($nb_l != "0"){echo "style='color:#ff5e3a;'";}?>><?php echo $value['like_com'];?></span>
									</a>
								</li>
								<?php }
							}


							if (isset($_POST['description_date'])) {
								$titre_event=utf8_decode($_POST['titre_event']);
								$lieu_event=utf8_decode($_POST['lieu_event']);
								$heure_event=$_POST['heure_event'];
								$description_date=utf8_decode($_POST['description_date']);
								$date_event=$_POST['date_event']." ".$heure_event.":00";
								$id_graph=$_COOKIE['id_graph'];
								$date_creation=date("Y-m-d H:i:s");
								$event=$bdd->prepare("INSERT INTO calendrier (id_user, date_event, date_creation, titre, description, lieu) VALUES (?,?,?,?,?,?)");
								$event->bindParam(1, $id_graph);
								$event->bindParam(2, $date_event);
								$event->bindParam(3, $date_creation);
								$event->bindParam(4, $titre_event);
								$event->bindParam(5, $description_date);
								$event->bindParam(6, $lieu_event);
								$event->execute();
								$list=$bdd->prepare("SELECT *  FROM calendrier where id_user = ? group by CAST(date_event AS DATE)");
								$list->bindParam(1, $id_graph);
								$list->execute();
								$i=0;
								foreach ($list as $key => $value) {
									$heure_temp=explode(" ", $value['date_event']);
									$heure=substr($heure_temp[1],0,5);
									$toto="%".$heure_temp[0]."%";
									$date_temp=explode("-", $heure_temp[0]);
									$year=$date_temp[0];
									$mois=$date_temp[1];
									$jour=$date_temp[2];
									if($jour<10){
										$jour = substr($jour, 1);
									}
									?>

									<div role="tablist" aria-multiselectable="true" class="day-event" date-month="<?php echo $mois;?>" date-day="<?php echo $jour;?>">
										<div class="ui-block-title ui-block-title-small">
											<h6 class="title"><?php echo utf8_encode($value['titre']);?></h6>
										</div>
										<?php
										$list_bis=$bdd->prepare("SELECT *  FROM calendrier where id_user = ? and date_event like ?");
										$list_bis->bindParam(1, $id_graph);
										$list_bis->bindParam(2, $toto);
										$list_bis->execute();
										foreach ($list_bis as $key => $value_bis) {
											$i++;
											$heure_temp_bis=explode(" ", $value_bis['date_event']);
											$heure_bis=substr($heure_temp_bis[1],0,5);
											?>
											<div class="card delete_<?php echo $value_bis['id_calendrier'];?>">
												<div class="card-header" role="tab" id="headingOne-1">
													<div class="event-time">
														<span class="circle"></span>
														<time datetime="2004-07-24T18:18"><?php echo $heure_bis;?></time>
														<div class="more" style="float: right;">
															<svg class="olymp-three-dots-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="../icons/icons.svg#olymp-three-dots-icon"></use></svg>
															<ul class="more-dropdown">
																<li>
																	<a class="delete" href="#">Supprimer la carte</a>
																</li>
															</ul>
														</div>
													</div>
													<h5 class="mb-0">
														<a <?php if($value_bis['description']!=""){?> data-toggle="collapse" data-parent="#accordion" href="#collapseOne-<?php echo $i;?>" aria-expanded="true" aria-controls="collapseOne-<?php echo $i;?>" <?php }?>>
															<?php echo utf8_encode($value_bis['titre']);?><?php if($value_bis['description']!=""){?><svg class="olymp-dropdown-arrow-icon"><use xlink:href="../icons/icons.svg#olymp-dropdown-arrow-icon"></use></svg><?php }?>
														</a>
													</h5>
												</div>

												<div id="collapseOne-<?php echo $i;?>" class="collapse" role="tabpanel" >
													<div class="card-body">
														<?php echo utf8_encode($value_bis['description']);?>
													</div>
													<div class="place inline-items">
														<svg class="olymp-add-a-place-icon"><use xlink:href="../icons/icons.svg#olymp-add-a-place-icon"></use></svg>
														<span><?php echo utf8_encode($value_bis['lieu']);?></span>
													</div>
												</div>
											</div>

											<?php }?>
											<a href="#" class="check-all" data-toggle="modal" data-target="#event_cre">Créer un évenement</a>
										</div>
										<?php }?>
										<div role="tablist" aria-multiselectable="true" class="day-event vide">
											<div class="ui-block-title ui-block-title-small">
												<h6 class="title">TODAY’S EVENTS</h6>
											</div>
											<div class="card">
											</div>

											<a href="#" class="check-all" data-toggle="modal" data-target="#event_cre">Créer un évenement</a>
										</div>
										<?php }

										if (isset($_POST['suppression_event'])) {
											$suppression_event=$_POST['suppression_event'];
											$suppress=$bdd->prepare("DELETE FROM calendrier where id_calendrier = ?");
											$suppress->bindParam(1, $suppression_event);
											$suppress->execute();
										}

										if(isset($_POST['liker_news'])){
											$liker_news=$_POST['liker_news'];
											$id_graph=$_COOKIE['id_graph'];
											$date_news=date("Y-m-d H:i:s");
											$lik_news=$bdd->prepare("SELECT id_like FROM like_news where id_graph = ? and id_news = ?");
											$lik_news->bindParam(1, $id_graph);
											$lik_news->bindParam(2, $liker_news);
											$lik_news->execute();
											$nb_like=$lik_news->rowCount();
											if($nb_like==0){
												$lik_news_ins=$bdd->prepare("INSERT INTO like_news (id_graph, id_news, date_like_news) VALUES (?,?,?)");
												$lik_news_ins->bindParam(1, $id_graph);
												$lik_news_ins->bindParam(2, $liker_news);
												$lik_news_ins->bindParam(3, $date_news);
												$lik_news_ins->execute();
												echo "ok";
											}
										}

										if(isset($_POST['liker_news_com'])){
											$liker_news=$_POST['liker_news_com'];
											$id_graph=$_COOKIE['id_graph'];
											$date_news=date("Y-m-d H:i:s");
											$lik_news=$bdd->prepare("SELECT id_like FROM like_com_news where id_graph = ? and id_com = ?");
											$lik_news->bindParam(1, $id_graph);
											$lik_news->bindParam(2, $liker_news);
											$lik_news->execute();
											$lik_news_c=$bdd->prepare("SELECT like_com FROM commentaires_news where id_commentaires_news = ?");
											$lik_news_c->bindParam(1, $liker_news);
											$lik_news_c->execute();
											$result_com=$lik_news_c->fetch();
											$nb=$result_com['like_com']*1 + 1*1;
											$nb_like=$lik_news->rowCount();
											if($nb_like==0){
												$lik_news_ins=$bdd->prepare("INSERT INTO like_com_news (id_graph, id_com, date_like_com) VALUES (?,?,?)");
												$lik_news_ins->bindParam(1, $id_graph);
												$lik_news_ins->bindParam(2, $liker_news);
												$lik_news_ins->bindParam(3, $date_news);
												$lik_news_ins->execute();
												$lik_news_up=$bdd->prepare("UPDATE commentaires_news SET like_com = ? where id_commentaires_news=?");
												$lik_news_up->bindParam(1, $nb);
												$lik_news_up->bindParam(2, $liker_news);
												$lik_news_up->execute();
												echo "ok";
											}
										}

										if(isset($_POST['text_ajout_news'])){
											$texte=utf8_decode($_POST['text_ajout_news']);
											$id=$_POST['id_text_news'];
											$id_graph=$_COOKIE['id_graph'];
											$now_news=date("Y-m-d H:i:s");
											$like=0;
											$lik_com_news_ins=$bdd->prepare("INSERT INTO commentaires_news (id_news, commentaire, id_user, date_commentaire, like_com) VALUES (?,?,?,?,?)");
											$lik_com_news_ins->bindParam(1, $id);
											$lik_com_news_ins->bindParam(2, $texte);
											$lik_com_news_ins->bindParam(3, $id_graph);
											$lik_com_news_ins->bindParam(4, $now_news);
											$lik_com_news_ins->bindParam(5, $like);
											$lik_com_news_ins->execute();

											$sel_com=$bdd->prepare("SELECT * FROM commentaires_news inner join user on commentaires_news.id_user = user.id_user where id_news = ? and commentaires_news.id_user = ? order by id_commentaires_news DESC limit 1");
											$sel_com->bindParam(1, $id);
											$sel_com->bindParam(2, $id_graph);
											$sel_com->execute();
											foreach ($sel_com as $key => $value) {
												?>
												<li class="liste_com com_like_<?php echo $value['id_commentaires_news'];?>">
													<div class="post__author author vcard inline-items">
														<img src="<?php echo $value['photo_avatar'];?>" alt="author">

														<div class="author-date">
															<a class="h6 post__author-name fn" href="#"><?php echo utf8_encode($value['prenom']." ".$value['nom']);?></a>
															<div class="post__date">
																<time class="published" datetime="2004-07-24T18:18">
																	<?php echo time_elapsed_string($value['date_commentaire']);?>
																</time>
															</div>
														</div>
													</div>

													<p><?php echo utf8_encode($value['commentaire']);?></p>

													<a class="post-add-icon inline-items liker_com_news">
														<svg class="olymp-heart-icon"><use xlink:href="../icons/icons.svg#olymp-heart-icon"></use></svg>
														<span><?php echo $value['like_com'];?></span>
													</a>
												</li>
												<?php 
											}
										}


										if(isset($_POST['commentaire_anniv'])){
											$com=utf8_decode($_POST['commentaire_anniv']);
											$id_graph=$_COOKIE['id_graph'];
											$id_receveur=$_POST['receveur'];
											$date_msg=date("Y-m-d H:i:s");
											$query_com_anniv=$bdd->prepare("INSERT INTO commentaires_anniversaire (id_emetteur, id_receveur, commentaire, date_com) VALUES (?,?,?,?)");
											$query_com_anniv->bindParam(1, $id_graph);
											$query_com_anniv->bindParam(2, $id_receveur);
											$query_com_anniv->bindParam(3, $com);
											$query_com_anniv->bindParam(4, $date_msg);
											$query_com_anniv->execute();
										}


										if(isset($_POST['receveur_chef_anniv'])){
											$id_receveur=$_POST['receveur_chef_anniv'];
											$date_fin=$_POST['date_bday'];
											$msg= utf8_decode(trim($_POST['message_anniv']));
											$id_graph=$_COOKIE['id_graph'];
											$query_chef_anniv=$bdd->prepare("INSERT INTO gestion_anniversaire (id_emetteur, id_receveur, message, date_fin) VALUES (?,?,?,?)");
											$query_chef_anniv->bindParam(1, $id_graph);
											$query_chef_anniv->bindParam(2, $id_receveur);
											$query_chef_anniv->bindParam(3, $msg);
											$query_chef_anniv->bindParam(4, $date_fin);
											$query_chef_anniv->execute();

											foreach ($query_chef_anniv as $key => $value) {
												echo utf8_encode($value['message']);
											}
										}

										if(isset($_POST['msg_chef_anniv'])){
											$id_receveur=utf8_encode($_POST['msg_chef_anniv']);
											$tab=array();
											$query_msg_anniv=$bdd->prepare("SELECT * FROM gestion_anniversaire where id_receveur = ?");
											$query_msg_anniv->bindParam(1, $id_receveur);
											$query_msg_anniv->execute();

											foreach ($query_msg_anniv as $key => $value) {
												$tab[]=utf8_encode($value['message']);
												$tab[]=utf8_encode($value['date_fin']);
											}
											print_r(json_encode($tab));
										}

										if(isset($_POST['receveur_gestion'])){
											$id_receveur=$_POST['receveur_gestion'];
											$query_msg_anniv=$bdd->prepare("SELECT * FROM gestion_anniversaire where id_receveur = ?");
											$query_msg_anniv->bindParam(1, $id_receveur);
											$query_msg_anniv->execute();

											$table_msg_anniv= $query_msg_anniv->fetch();

											if ($table_msg_anniv['message'] != '') {
												echo "0";
											}else{
												echo "1";
											}
										}

										if(isset($_POST['modif_msg'])){
											$id_receveur=$_POST['modif_msg'];
											$id_graph=$_COOKIE['id_graph'];

											$query_check_gestion=$bdd->prepare("SELECT * from gestion_anniversaire where id_receveur = ? and id_emetteur = ?");
											$query_check_gestion->bindParam(1, $id_receveur);
											$query_check_gestion->bindParam(2, $id_graph);
											$query_check_gestion->execute();

											$tab_check_gestion= $query_check_gestion->fetch();

											if ($tab_check_gestion['message'] != '') {
												echo "1";
											}else{
												echo "0";
											}

										}

										if(isset($_POST['msg_after_edit'])){
											$id_receveur=$_POST['receveur_after_edit'];
											$id_graph=$_COOKIE['id_graph'];
											$msg=utf8_decode($_POST['msg_after_edit']);
											$date=$_POST['date'];

											$query_check_gestion=$bdd->prepare("UPDATE gestion_anniversaire SET message = ?, date_fin = ? where id_receveur = ? and id_emetteur = ?");
											$query_check_gestion->bindParam(1, $msg);
											$query_check_gestion->bindParam(2, $date);
											$query_check_gestion->bindParam(3, $id_receveur);
											$query_check_gestion->bindParam(4, $id_graph);
											$query_check_gestion->execute();

										}

										if(isset($_POST['user_gestion'])){
											$id_receveur=$_POST['user_gestion'];
											$id_graph=$_COOKIE['id_graph'];

											$query_check_user_gestion=$bdd->prepare("SELECT * from gestion_anniversaire where id_receveur = ? and id_emetteur = ?");
											$query_check_user_gestion->bindParam(1, $id_receveur);
											$query_check_user_gestion->bindParam(2, $id_graph);
											$query_check_user_gestion->execute();
											$tab_check_user_gestion= $query_check_user_gestion->fetch();

											if ($tab_check_user_gestion['message'] != '') {
												echo "1";
											}else{
												echo "0";
											}
										}

										if (isset($_POST['charger_com'])) {
											$id_receveur=$_POST['charger_com'];
											$id_com=$_POST['id_com'];
											$query_com_aide = $bdd->prepare("SELECT * FROM commentaires_anniversaire inner join user on commentaires_anniversaire.id_emetteur=user.id_user where id_receveur = ? and id_commentaires > ? order by date_com ASC");
											$query_com_aide->bindParam(1, $id_receveur);
											$query_com_aide->bindParam(2, $id_com);
											$query_com_aide->execute();
											$tabf=array();
											foreach ($query_com_aide as $key_com => $value_com)
											{
												$tabf[$key_com]['nom'] = utf8_encode($value_com['prenom']." ".$value_com['nom']);
												$tabf[$key_com]['msg'] = utf8_encode($value_com['commentaire']);
												$tabf[$key_com]['date'] = time_elapsed_string($value_com['date_com']);
												$tabf[$key_com]['id_commentaires'] = utf8_encode($value_com['id_commentaires']);
												$tabf[$key_com]['photo_avatar'] = '../'.utf8_encode($value_com['photo_avatar']);
											}

											print_r(json_encode($tabf));
										}

								// modif news
										if (isset($_POST['newsId'])) {
											$id_news=$_POST['newsId'];
											$author=$_POST['author'];
											$content=$_POST['content'];
											$query_modif_news = $bdd->prepare("UPDATE newsletter SET content = ? where id_user = ? and id_news = ?");
											$query_modif_news->bindParam(1, $content);
											$query_modif_news->bindParam(2, $author);
											$query_modif_news->bindParam(3, $id_news);
											$query_modif_news->execute();
										}
								// suppr news
										if (isset($_POST['newsId_suppr'])) {
											$id_news=$_POST['newsId_suppr'];
											$author=$_POST['author'];
											$query_suppr_news = $bdd->prepare("DELETE FROM newsletter where id_user = ? and id_news = ?");
											$query_suppr_news->bindParam(1, $author);
											$query_suppr_news->bindParam(2, $id_news);
											$query_suppr_news->execute();
											var_dump($author);
										}

							//add log
										if (isset($_POST['categorie_log'])) {
											$categorie=utf8_decode($_POST['categorie_log']);
											$titre=utf8_decode($_POST['titre']);
											$description=utf8_decode($_POST['description']);
											$date_log=date("Y-m-d H:i:s");
											$previsualisation_log=$_POST['file_log'];
											$token = $_POST['token'];
											$id_graph=$_COOKIE['id_graph'];
											$file="";
											$i=0;
											foreach ($previsualisation_log as $key => $value) {
												if ($i!=0) {
													$file.=";";
												}
												$file.=utf8_decode($token.$value);
												$i++;
												echo $file;
											}
											$query_add_log = $bdd->prepare("INSERT INTO log (categorie, titre, description, file, date_log, auteur) VALUES (?,?,?,?,?, ?)");
											$query_add_log->bindParam(1, $categorie);
											$query_add_log->bindParam(2, $titre);
											$query_add_log->bindParam(3, $description);
											$query_add_log->bindParam(4, $file);
											$query_add_log->bindParam(5, $date_log);
											$query_add_log->bindParam(6, $id_graph);
											$query_add_log->execute();
										}

										if(isset($_POST['statut_change'])){
											$statut_change=$_POST['statut_change'];
											if($statut_change==1 || $statut_change==2){
												$new_lead=3;
											}else{
												$new_lead=5;
											}
											$query_add_log = $bdd->prepare("SELECT * FROM user where id_statut = ?");
											$query_add_log->bindParam(1, $new_lead);
											$query_add_log->execute();
											foreach ($query_add_log as $value) {
												?>
												<option value="<?php echo utf8_encode($value['id_user']);?>"><?php echo utf8_encode($value['prenom']);?> <?php echo utf8_encode($value['nom']);?></option>
												<?php 
											}
										}

										if (isset($_POST['id_anniv_notif'])) {
											$id_anniv_notif=$_POST['id_anniv_notif'];
											$id_user = $_COOKIE['id_graph'];
											$active_anniv=$_POST['active_anniv'];
											$query_test=$bdd->prepare("SELECT * FROM notification_anniversaire where id_compte = ? and id_user_selection = ?");
											$query_test->bindParam(1, $id_user);
											$query_test->bindParam(2, $id_anniv_notif);
											$query_test->execute();
											$nb_retour=$query_test->rowCount();
											if($nb_retour == 0){
												$query_test=$bdd->prepare("INSERT INTO notification_anniversaire (id_compte, id_user_selection, active) VALUES (?,?,1)");
												$query_test->bindParam(1, $id_user);
												$query_test->bindParam(2, $id_anniv_notif);
												$query_test->execute();
											}else{
												$query_test=$bdd->prepare("UPDATE notification_anniversaire SET active = ? where id_compte = ? and id_user_selection = ?");
												$query_test->bindParam(1, $active_anniv);
												$query_test->bindParam(2, $id_user);
												$query_test->bindParam(3, $id_anniv_notif);
												$query_test->execute();
											}
										}


										if (isset($_POST['best_answer_aide'])) {
											$id_aide = $_POST['best_answer_aide'];
											$id_com = $_POST['best_answer'];
											$query_best_answer=$bdd->prepare("UPDATE aide SET id_meilleure_reponse = ? where id_aide = ?");
											$query_best_answer->bindParam(1, $id_com);
											$query_best_answer->bindParam(2, $id_aide);
											$query_best_answer->execute();
										}
										if (isset($_POST['cancel_best_answer'])) {
											$id_aide = $_POST['cancel_best_answer'];
											$id_com = NULL;
											$query_cancel_best_answer=$bdd->prepare("UPDATE aide SET id_meilleure_reponse = ? where id_aide = ?");
											$query_cancel_best_answer->bindParam(1, $id_com);
											$query_cancel_best_answer->bindParam(2, $id_aide);
											$query_cancel_best_answer->execute();
										}

										if (isset($_POST['id_rep_remontees'])) {
											$id_rep = $_POST['id_rep_remontees'];
											$id_remontees = $_POST['id_remontees'];
											$query_get_rep=$bdd->prepare("SELECT * from remontees inner join user on remontees.id_rep = user.id_user WHERE id_rep = ? and id_remontees = ?");
											$query_get_rep->bindParam(1, $id_rep);
											$query_get_rep->bindParam(2, $id_remontees);
											$query_get_rep->execute();
											foreach ($query_get_rep as $key => $value) {
												echo $value['nom']." ".$value['prenom'];
											}
										}

										if (isset($_POST['id_remontees_ajout_com'])) {
											$id_remontees = $_POST['id_remontees_ajout_com'];
											$commentaires = utf8_decode($_POST['commentaires']);
											$id_user = $_COOKIE['id_graph'];
											$date = date('Y-m-d H:i:s');
											$query_add_rep=$bdd->prepare("INSERT INTO commentaires_remontees (id_remontees, id_user, commentaire, date_com_remontees) VALUES (?,?,?,?)");
											$query_add_rep->bindParam(1, $id_remontees);
											$query_add_rep->bindParam(2, $id_user);
											$query_add_rep->bindParam(3, $commentaires);
											$query_add_rep->bindParam(4, $date);
											$query_add_rep->execute();

											$select_com_remontees=$bdd->prepare("SELECT * from user WHERE id_user= ?");
											$select_com_remontees->bindParam(1, $id_user);
											$select_com_remontees->execute();
											$result = $select_com_remontees->fetch();

											$update_commentaires_notif=$bdd->prepare('UPDATE commentaires_remontees SET notif_com = 1 WHERE id_remontees = ? and id_user != ?');
											$update_commentaires_notif->bindParam(1, $id_remontees);
											$update_commentaires_notif->bindParam(2, $id_user);
											$update_commentaires_notif->execute();

											$update_commentaires_notif_reponse=$bdd->prepare('UPDATE remontees SET notif_user = 1 WHERE id_remontees = ? and id_user != ?');
											$update_commentaires_notif_reponse->bindParam(1, $id_remontees);
											$update_commentaires_notif_reponse->bindParam(2, $id_user);
											$update_commentaires_notif_reponse->execute();

											$comment = '<li class="liste_com">';
											$comment .=	'<div class="post__author author vcard inline-items">';
											$comment .=	'<img src="../'.$result['photo_avatar'].'" alt="author">';
											$comment .=	'<div class="author-date">';
											$comment .=	'<a class="h6 post__author-name fn" href="#">'. utf8_encode($result['prenom'].' '.$result['nom']).'</a>';
											$comment .=	'<div class="post__date">';
											$comment .=	'<time class="published">';
											$comment .=	time_elapsed_string($date);
											$comment .=	'</time>';
											$comment .=	'</div>';
											$comment .=	'</div>';
											$comment .=	'</div>';
											$comment .=	'<p>'.utf8_encode($commentaires).'</p>';
											$comment .=	'</li>';

											echo $comment;

										}

										if (isset($_POST['search_com'])) {
											$id_remontees = $_POST['search_com'];

											$select_com_this=$bdd->prepare('SELECT * from commentaires_remontees inner join user on commentaires_remontees.id_user = user.id_user where id_remontees = ?');
											$select_com_this->bindParam(1, $id_remontees);
											$select_com_this->execute();

											$comment = '';

											foreach ($select_com_this as $key => $value) {
												$comment .= '<pre class="break">';
												$comment .= '<li class="liste_com">';
												$comment .=	'<div class="post__author author vcard inline-items">';
												$comment .=	'<img src="../'.$value['photo_avatar'].'" alt="author">';
												$comment .=	'<div class="author-date">';
												$comment .=	'<a class="h6 post__author-name fn" href="#">'. utf8_encode($value['prenom'].' '.$value['nom']).'</a>';
												$comment .=	'<div class="post__date">';
												$comment .=	'<time class="published">';
												$comment .=	time_elapsed_string($value['date_com_remontees']);
												$comment .=	'</time>';
												$comment .=	'</div>';
												$comment .=	'</div>';
												$comment .=	'</div>';
												$comment .=	'<p>'.utf8_encode($value['commentaire']).'</p>';
												$comment .=	'</li>';
												$comment .=	'</pre>';
											}

											echo $comment;
										}

										if (isset($_POST['delete_remontees'])) {
											$id_remontees = $_POST['delete_remontees'];
											$delete_remontees=$bdd->prepare('DELETE from remontees where id_remontees = ?');
											$delete_remontees->bindParam(1, $id_remontees);
											$delete_remontees->execute();
										}


										if (isset($_POST['edit_remontees'])) {
											$id_remontees = $_POST['edit_remontees'];
											$titre = utf8_decode($_POST['titre']);
											$text = utf8_decode($_POST['text']);
											$edit_remontees=$bdd->prepare('UPDATE remontees SET titre = ?, description = ? WHERE id_remontees = ?');
											$edit_remontees->bindParam(1, $titre);
											$edit_remontees->bindParam(2, $text);
											$edit_remontees->bindParam(3, $id_remontees);
											$edit_remontees->execute();
										}

										if (isset($_POST['valider_edit_remontee'])) {
											$id_remontees = $_POST['valider_edit_remontee'];
											$titre = utf8_decode($_POST['titre']);
											$text = utf8_decode($_POST['text']);
											$edit_remontees=$bdd->prepare('UPDATE remontees SET titre = ?, description = ? WHERE id_remontees = ?');
											$edit_remontees->bindParam(1, $titre);
											$edit_remontees->bindParam(2, $text);
											$edit_remontees->bindParam(3, $id_remontees);
											$edit_remontees->execute();
										}





										if(isset($_POST['titreperle'])){
											$titre_perle = utf8_decode($_POST['titreperle']);
											$file_arr = $_POST['file_perle'];
											$token = $_POST['token_perle'];
											$file="";
											$i=0;
											foreach ($file_arr as $key => $value) {
												if ($i!=0) {
													$file.=";";
												}
												$file.=$token.$value;
												$i++;
											}
											$like_veille = 0;
											$accept_veille = 1;
											$date_perle = date('Y-m-d H:i:s');
											$description = utf8_decode($_POST['description_perle']);
											$id_user=$_COOKIE['id_graph'];
											$requete_veille = $bdd->prepare("INSERT INTO perles (id_user, date_perle, titre_perle, description_perle, img_perle)	VALUES (?, ?, ?, ?,?)");
											$requete_veille->bindParam(1, $id_user);
											$requete_veille->bindParam(2, $date_perle);
											$requete_veille->bindParam(3, $titre_perle);
											$requete_veille->bindParam(4, $description);
											$requete_veille->bindParam(5, $file);
											$requete_veille->execute();
											$requete_show_veille = $bdd->prepare("SELECT * from perles inner join user on perle.id_user = user.id_user order by idperles desc limit 1");
											$requete_show_veille->execute();
											foreach ($requete_show_veille as $key => $value) {?>
											<li class="twitter-item">
												<div class="author-folder">
													<img src="<?php echo $value['photo_avatar'];?>" alt="avatar">
													<div class="author">
														<a href="#" class="author-name"><?php echo utf8_encode($value['titre_perle']);?></a>
														<a href="#" class="group">@<?php echo utf8_encode($value['prenom']." ".$value["nom"]);?></a>
													</div>
												</div>
												<p><?php echo utf8_encode($value['description_perle']);?></p>
												<span class="post__date">
													<time class="published" datetime="2017-03-24T18:18">
														<?php echo time_elapsed_string($value["date_perle"]);?>
													</time>
												</span>
											</li>
											<?php
										}
									}


									if (isset($_POST['accept_veille'])) {
										$id_veille = $_POST['accept_veille'];
										$accept_veille=$bdd->prepare('UPDATE veille SET accept_veille = 1 WHERE id_veille = ?');
										$accept_veille->bindParam(1, $id_veille);
										$accept_veille->execute();
									}
									if (isset($_POST['refuser_veille'])) {
										$id_veille = $_POST['refuser_veille'];
										$refuser_veille=$bdd->prepare('DELETE from veille where id_veille = ?');
										$refuser_veille->bindParam(1, $id_veille);
										$refuser_veille->execute();
									}


									if (isset($_POST['veille_search'])) {
										$search = utf8_decode($_POST['veille_search']);
										$varsearch = "%" . $search . "%";
										$search_veille = $bdd->prepare("SELECT * FROM veille WHERE titre LIKE ? or description LIKE ? or lien LIKE ? order by date_veille DESC");
										$search_veille->bindParam(1, $varsearch);
										$search_veille->bindParam(2, $varsearch);
										$search_veille->bindParam(3, $varsearch);
										$search_veille->execute();
										$nb_result = $search_veille->rowCount();
										$tab_search = array();
										if ($nb_result == 0) {?>
										<h2>Aucun résultat n'a été trouvé</h2>
										<?php }else{
											foreach ($search_veille as $key => $value) { ?>
											<div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 col-xs-12 element-item <?php echo($value['categorie']) ?>">
												<div class="ui-block">
													<article class="hentry blog-post">
														<div class="post-thumb">
															<a  target="_blank" href="<?php echo($value['lien']) ?>"><img src="../uploads/veille/<?php echo($value['file']) ?>" alt="photo"></a>
														</div>
														<div class="post-content">
															<a  target="_blank" href="<?php echo($value['lien']) ?>" class="h4 post-title"><?php echo($value['titre']) ?></a>
															<p><?php echo($value['description']) ?></p>
															<div class="wrapper_date">
																<div class="author-date not-uppercase">
																	<div class="post__date">
																		<time class="published">
																			<?php echo time_elapsed_string($value['date_veille']);?>
																		</time>
																	</div>
																</div>
																<a class="post-add-icon inline-items like_veille_<?php echo($value['id_veille']) ?>" <?php if($value['like_veille'] != "0"){echo "style='fill: #ff5e3a;color: #ff5e3a;'";}?>><svg class="olymp-heart-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="../icons/icons.svg#olymp-heart-icon"></use></svg><span><?php echo($value['like_veille']) ?></span></a>
															</div>
														</div>
													</article>
												</div>
											</div>
											<?php	}}} 


											if (isset($_POST['remove_search_veille'])) {
												$show_all_veille=$bdd->prepare('SELECT * FROM veille');
												$show_all_veille->execute();
												foreach ($show_all_veille as $key => $value) { ?>
												<div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 col-xs-12 element-item <?php echo($value['categorie']) ?>">
													<div class="ui-block">
														<article class="hentry blog-post">
															<div class="post-thumb">
																<a  target="_blank" href="<?php echo($value['lien']) ?>"><img src="../uploads/veille/<?php echo($value['file']) ?>" alt="photo"></a>
															</div>
															<div class="post-content">
																<a  target="_blank" href="<?php echo($value['lien']) ?>" class="h4 post-title"><?php echo($value['titre']) ?></a>
																<p><?php echo($value['description']) ?></p>
																<div class="wrapper_date">
																	<div class="author-date not-uppercase">
																		<div class="post__date">
																			<time class="published">
																				<?php echo time_elapsed_string($value['date_veille']);?>
																			</time>
																		</div>
																	</div>
																	<a class="post-add-icon inline-items like_veille_<?php echo($value['id_veille']) ?>" <?php if($value['like_veille'] != "0"){echo "style='fill: #ff5e3a;color: #ff5e3a;'";}?>><svg class="olymp-heart-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="../icons/icons.svg#olymp-heart-icon"></use></svg><span><?php echo($value['like_veille']) ?></span></a>
																</div>
															</div>
														</article>
													</div>
												</div>
												<?php }
											}

											if (isset($_POST['id_perle_note'])) {
												$id_perle=$_POST['id_perle_note'];
												$id_user=$_COOKIE['id_graph'];
												$note=$_POST['note'];
												$date_perle=date('Y-m-d H:i:s');
												$query_note_perle=$bdd->prepare("INSERT INTO note_perles (id_perles, id_user, note_perles, date_note_perles) VALUES (?,?,?,?)");
												$query_note_perle->bindParam(1, $id_perle);
												$query_note_perle->bindParam(2, $id_user);
												$query_note_perle->bindParam(3, $note);
												$query_note_perle->bindParam(4, $date_perle);
												$query_note_perle->execute();
											}


											

