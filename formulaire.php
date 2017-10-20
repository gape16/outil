<?php
include('connexion_session.php');

// truncate string at word
function shapeSpace_truncate_string_at_word($string, $limit, $break = ".", $pad = "...") {  
	
	if (strlen($string) <= $limit) return $string;
	
	if (false !== ($max = strpos($string, $break, $limit))) {

		if ($max < strlen($string) - 1) {
			
			$string = substr($string, 0, $max) . $pad;
			
		}
		
	}
	
	return $string;
	
}


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
	$exploded=explode('cms.site-privilege.pagesjaunes.fr/workflow/service/', $adresseCms);
	$idgpp= end($exploded);
	$idgpp = rtrim($idgpp, '/');
	//test savoir si client existe déjà ou non
	$query_test_client = $bdd->prepare("SELECT id_client FROM client where IDGPP = ?");
	$query_test_client->bindParam(1, $idgpp);
	$query_test_client->execute();
	$test_client= $query_test_client->fetch();
	$nb_client=$query_test_client->rowCount();
	$envoi_maquette = 0;
	// echo $nb_cligitteent;
	if($nb_client==0){
		//création du client
		// echo "INSERT INTO client (num_client, date_integration, raison_social, date_retour_maquette, date_retour_cq, id_graph_maquette, id_controleur_maquette, id_graph_cq, id_controleur_cq, id_etat, lien_CMS) VALUES ('$numClient', '$date', '$raisonSociale', '$dateRetourMaquette', '$dateRetourCq', '$idGraphMaquette', '$idControleurMaquette', '$idGraphCq', '$idControleurCq', '$idEtat' ,'$adresseCms')";
		$query_ins_client = $bdd->prepare("INSERT INTO client (num_client, date_integration, raison_social, date_retour_maquette, date_retour_cq, id_graph_maquette, id_controleur_maquette, id_graph_cq, id_controleur_cq, id_etat, lien_CMS, IDGPP, envoi_maquette) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ? ,?, ?, ?)");
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
		$query_ins_client->bindParam(13, $envoi_maquette);
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
		$new_card.='				<a href="'.$adresseCms.'" target="_blank" class="btn btn-control bg-blue">';
		$new_card.='					<svg class="olymp-happy-faces-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="icons/icons.svg#olymp-happy-faces-icon"></use></svg>';
		$new_card.='				</a>';

		$new_card.='				<a href="check.php?idgpp='.$idgpp.'" class="btn btn-control btn-grey-lighter">';
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
		$tab[$key]['date_aide'] = $value['date_aide'];
		$tab[$key]['capture'] = utf8_encode($value['capture']);
		$tab[$key]['nom'] = utf8_encode($value['nom']);
		$tab[$key]['prenom'] = utf8_encode($value['prenom']);
		$tab[$key]['photo'] = $value['photo'];
		$tab[$key]['etat_aide'] = utf8_encode($value['etat_aide']);
		$tab[$key]['couleur'] = utf8_encode($value['couleur']);
	}
	

	$query_com_aide = $bdd->prepare("SELECT * FROM commentaires_aide inner join user on commentaires_aide.id_user=user.id_user where id_aide = ? order by date_commentaire ASC");
	$query_com_aide->bindParam(1, $id_aide);
	$query_com_aide->execute();
	foreach ($query_com_aide as $key_com => $value_com)
	{
		$tab[$key_com+1]['nom_commentaire'] = utf8_encode($value_com['prenom']." ".$value_com['nom']);
		$tab[$key_com+1]['commentaire'] = utf8_encode($value_com['commentaire']);
		$tab[$key_com+1]['date_commentaire'] = $value_com['date_commentaire'];
		$tab[$key_com+1]['id_commentaires_aide'] = $value_com['id_commentaires_aide'];
		$tab[$key_com+1]['photo'] = $value_com['photo'];
		$tab[$key_com+1]['like'] = $value_com['like_com'];
		$query_sel_lik = $bdd->prepare("SELECT id_like from like_com where id_graph = ? and id_com = ?");
		$query_sel_lik->bindParam(1, $_SESSION['id_graph']);
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
	$id_graph=$_SESSION['id_graph'];
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

	// $query_com_aide = $bdd->prepare("SELECT * FROM commentaires_aide inner join user on commentaires_aide.id_user=user.id_user where id_aide = ? order by date_commentaire ASC");
	// $query_com_aide->bindParam(1, $id_aide);
	// $query_com_aide->execute();
	// foreach ($query_com_aide as $key_com => $value_com)
	// {
	// 	$tabf[$key_com]['nom_commentaire'] = utf8_encode($value_com['prenom']." ".$value_com['nom']);
	// 	$tabf[$key_com]['commentaire'] = utf8_encode($value_com['commentaire']);
	// 	$tabf[$key_com]['date_commentaire'] = $value_com['date_commentaire'];
	// 	$tabf[$key_com]['id_commentaires_aide'] = $value_com['id_commentaires_aide'];
	// 	$tabf[$key_com]['photo'] = $value_com['photo'];
	// 	$tabf[$key_com]['like'] = $value_com['like_com'];
	// 	$query_sel_lik = $bdd->prepare("SELECT id_like from like_com where id_graph = ? and id_com = ?");
	// 	$query_sel_lik->bindParam(1, $_SESSION['id_graph']);
	// 	$query_sel_lik->bindParam(2, $value_com['id_commentaires_aide']);
	// 	$query_sel_lik->execute();
	// 	$nb_lik = $query_sel_lik->rowCount();
	// 	if($nb_lik ==0){
	// 		$tabf[$key_com]['like_test'] = "";
	// 	}else{
	// 		$tabf[$key_com]['like_test'] = "style=\"fill: #ff5e3a;color: #ff5e3a;\"";
	// 	}
	// }
	// print_r(json_encode($tabf));
}

if(isset($_POST['logOut'])){
	unset($_SESSION['id_statut']);
	unset($_SESSION['id_graph']);
}

if(isset($_POST['likelecommentaire'])){
	$id_com=$_POST['likelecommentaire'];
	$nb_like=$_POST['nb_like']+1;
	$id_graph=$_SESSION['id_graph'];
	$query_sel_lik = $bdd->prepare("SELECT id_like from like_com where id_graph = ? and id_com = ?");
	$query_sel_lik->bindParam(1, $id_graph);
	$query_sel_lik->bindParam(2, $id_com);
	$query_sel_lik->execute();
	$nb_lik = $query_sel_lik->rowCount();
	// echo $nb_lik;
	if($nb_lik ==0){
		$query_ins_lik = $bdd->prepare("INSERT INTO like_com (id_graph, id_com) VALUES (?, ?)");
		$query_ins_lik->bindParam(1, $id_graph);
		$query_ins_lik->bindParam(2, $id_com);
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
	$id_graph=$_SESSION['id_graph'];
	$query_sel_lik = $bdd->prepare("SELECT id_like from like_veille where id_graph = ? and id_veille = ?");
	$query_sel_lik->bindParam(1, $id_graph);
	$query_sel_lik->bindParam(2, $id_veille);
	$query_sel_lik->execute();
	$nb_lik = $query_sel_lik->rowCount();
	// echo $nb_lik;
	if($nb_lik ==0){
		$query_ins_lik = $bdd->prepare("INSERT INTO like_veille (id_graph, id_veille) VALUES (?, ?)");
		$query_ins_lik->bindParam(1, $id_graph);
		$query_ins_lik->bindParam(2, $id_veille);
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
		$tabf[$key_com]['date_commentaire'] = $value_com['date_commentaire'];
		$tabf[$key_com]['id_commentaires_aide'] = $value_com['id_commentaires_aide'];
		$tabf[$key_com]['photo'] = $value_com['photo'];
		$tabf[$key_com]['like'] = $value_com['like_com'];
		$query_sel_lik = $bdd->prepare("SELECT id_like from like_com where id_graph = ? and id_com = ?");
		$query_sel_lik->bindParam(1, $_SESSION['id_graph']);
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
	$idGpp = $_POST['idGpp'];
	$valueCheck = $_POST['valueCheck'];
	$idCheck = $_POST['idCheck'];
	$etatFinal = $_POST['etatFinal'];
	$id_graph=$_SESSION['id_graph'];
	$com_contr=$_POST['com_contr'];
	$com_graph=$_POST['com_graph'];
	$date = date('Y-m-d H:i:s');
	$envoi=$_POST['envoi'];
	$pret=0;
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
			$query_up_cl=$bdd->prepare("UPDATE client SET envoi_maquette=?, id_etat = ? where IDGPP = ?");
			$query_up_cl->bindParam(1, $pret);
			$query_up_cl->bindParam(2, $fin);
			$query_up_cl->bindParam(3, $idGpp);
			$query_up_cl->execute();
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
				if($etatFinal == 2 && $envoi=="ok"){
					$etat=4;
					$query_up_cl=$bdd->prepare("UPDATE client SET date_retour_maquette = ?, id_controleur_maquette = ?,envoi_maquette=?,id_etat = ? where IDGPP = ?");
					$query_up_cl->bindParam(1, $date);
					$query_up_cl->bindParam(2, $id_graph);
					$query_up_cl->bindParam(3, $pret);
					$query_up_cl->bindParam(4, $etat);
					$query_up_cl->bindParam(5, $idGpp);
					$query_up_cl->execute();
				}elseif($etatFinal == 2 && $envoi=="retour"){
					$etat=3;
					$query_up_cl=$bdd->prepare("UPDATE client SET date_retour_maquette = ?, id_controleur_maquette = ?, envoi_maquette=?, id_etat = ? where IDGPP = ?");
					$query_up_cl->bindParam(1, $date);
					$query_up_cl->bindParam(2, $id_graph);
					$query_up_cl->bindParam(3, $pret);
					$query_up_cl->bindParam(4, $etat);
					$query_up_cl->bindParam(5, $idGpp);
					$query_up_cl->execute();
				}elseif($etatFinal == 3){
					$etat=2;
					$query_up_cl=$bdd->prepare("UPDATE client SET date_retour_maquette = ?, id_controleur_maquette = ?, envoi_maquette=?, id_etat = ? where IDGPP = ?");
					$query_up_cl->bindParam(1, $date);
					$query_up_cl->bindParam(2, $id_graph);
					$query_up_cl->bindParam(3, $pret);
					$query_up_cl->bindParam(4, $etat);
					$query_up_cl->bindParam(5, $idGpp);
					$query_up_cl->execute();
				}
			}elseif ($etatFinal > 4 && $etatFinal < 7) {
				$etat_cont=4;
				$query_ins_checked=$bdd->prepare("UPDATE controle SET commentaire_controleur = ?, commentaire_graph = ? where id_gpp = ? and id_check = ? and etat = ?");
				$query_ins_checked->bindParam(1, $commentaire_controleur);
				$query_ins_checked->bindParam(2, $commentaire_graph);
				$query_ins_checked->bindParam(3, $idGpp);
				$query_ins_checked->bindParam(4, $idCheck[$key]);
				$query_ins_checked->bindParam(5, $etat_cont);
				$query_ins_checked->execute();
				if($etatFinal == 5 && $envoi=="ok"){
					$etat=7;
					$query_up_cl=$bdd->prepare("UPDATE client SET date_retour_maquette = ?, id_controleur_maquette = ?, envoi_maquette=?, id_etat = ? where IDGPP = ?");
					$query_up_cl->bindParam(1, $date);
					$query_up_cl->bindParam(2, $id_graph);
					$query_up_cl->bindParam(3, $pret);
					$query_up_cl->bindParam(4, $etat);
					$query_up_cl->bindParam(5, $idGpp);
					$query_up_cl->execute();
				}elseif($etatFinal == 5 && $envoi=="retour"){
					$etat=6;
					$query_up_cl=$bdd->prepare("UPDATE client SET date_retour_maquette = ?, id_controleur_maquette = ?, envoi_maquette=?, id_etat = ? where IDGPP = ?");
					$query_up_cl->bindParam(1, $date);
					$query_up_cl->bindParam(2, $id_graph);
					$query_up_cl->bindParam(3, $pret);
					$query_up_cl->bindParam(4, $etat);
					$query_up_cl->bindParam(5, $idGpp);
					$query_up_cl->execute();
				}
			}

		}
		// $valueCheck[$key];
	}
}

if (isset($_POST['ancienPasswordAccount'])) {
	$ancien = $_POST['ancienPasswordAccount'];
	// echo $ancien;
	$mdp=password_hash($_POST['newPasswordAccount'], PASSWORD_DEFAULT);
	$id_graph=$_SESSION['id_graph'];
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
	$numClient = $_POST['numClient_controleur'];
	$lienMaquette = $_POST['lienMaquette'];
	$idUser = $_POST['idUser'];
	$accept = 0;
	$note = 0;
	$idgpp = $_POST['idgpp_check'];
	$date_ajout_controleur = date('Y-m-d H:i:s');
	$requete_proposition = $bdd->prepare("INSERT INTO proposition_design (date_proposition, num_client, lien_maquette, id_user, accept, note, id_gpp)	VALUES (?, ?, ?, ?, ?, ?, ?)");
	$requete_proposition->bindParam(1, $date_ajout_controleur);
	$requete_proposition->bindParam(2, $numClient);
	$requete_proposition->bindParam(3, $lienMaquette);
	$requete_proposition->bindParam(4, $idUser);
	$requete_proposition->bindParam(5, $accept);
	$requete_proposition->bindParam(6, $note);
	$requete_proposition->bindParam(7, $idgpp);
	$requete_proposition->execute();
	$requete_proposition_ok = $bdd->prepare("SELECT date_proposition, num_client, lien_maquette, nom, prenom, proposition_design.id_user FROM proposition_design INNER JOIN user ON proposition_design.id_user = user.id_user WHERE date_proposition=?");
	$requete_proposition_ok->bindParam(1, $date_ajout_controleur);
	$requete_proposition_ok->execute();
	$tab_requete_proposition = $requete_proposition_ok->fetch();
	$date_tab=explode("-", $tab_requete_proposition['date_proposition']);
	$jour_tab=explode(" ",$date_tab[2]);
	$jour=$jour_tab[0];
	$m=$date_tab[1];
	$months = array (1=>'Jan',2=>'Fev',3=>'Mar',4=>'Avr',5=>'Mai',6=>'Juin',7=>'Juil',8=>'Aout',9=>'Sept',10=>'Oct',11=>'Nov',12=>'Dec');
	$lignetableau = '';
	$lignetableau.= '<tr class="event-item">';
	$lignetableau.= '<td class="upcoming">';
	$lignetableau.= '<div class="date-event">';
	$lignetableau.= '<svg class="olymp-small-calendar-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="icons/icons.svg#olymp-small-calendar-icon"></use></svg>';
	$lignetableau.= '<span class="day">'. $jour .'</span>';
	$lignetableau.= '<span class="month">'. $months[(int)$m] .'</span>';
	$lignetableau.= '</div>';
	$lignetableau.= '</td>';
	$lignetableau.= '<td class="author">';
	$lignetableau.= '<div class="event-author inline-items">';
	$lignetableau.= '<div class="author-thumb">';
	$lignetableau.= '<img src="img/avatar43-sm.jpg" alt="author" style="width:45px !important;">';
	$lignetableau.= '</div>';
	$lignetableau.= '<div class="author-date">';
	$lignetableau.= '<a class="author-name h6">'. $tab_requete_proposition['num_client'] .'</a>';
	$lignetableau.= '<time class="published">'. utf8_encode($tab_requete_proposition['nom']).' '. utf8_encode($tab_requete_proposition['prenom']) .'</time>';
	$lignetableau.= '</div>';
	$lignetableau.= '</div>';
	$lignetableau.= '</td>';
	$lignetableau.= '<td class="location">';
	$lignetableau.= '<div class="place inline-items">';
	$lignetableau.= '	<svg class="olymp-add-a-place-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="icons/icons.svg#olymp-add-a-place-icon"></use></svg>';
	$lignetableau.= '	<a href="'. $tab_requete_proposition['lien_maquette'] .'" target="_blank" style="color:inherit;">Lien de la maquette</a>';
	$lignetableau.= '</div>';
	$lignetableau.= '</td>';
	$lignetableau.= '<td class="add-event">';
	$lignetableau.= '	<a class="btn btn-breez btn-sm check_proposition" data-toggle="modal" data-user="'. $tab_requete_proposition['id_user'] .'" data-id="'. $tab_requete_proposition['id_user'] .'" target="#checkpropal" style="background:#9a9fbf;color:white;">En cours</a>';
	$lignetableau.= '</td>';
	$lignetableau.= '</tr>';
	echo $lignetableau;
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
	$search = $_POST['search'];
	$varsearch = "%" . $search . "%";
	$requete_search = $bdd->prepare("SELECT * FROM aide inner join user on aide.id_user=user.id_user inner join etat_aide on aide.id_etat_aide = etat_aide.id_etat_aide where titre LIKE ? order by date_aide DESC");
	$requete_search->bindParam(1, $varsearch);
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
			$date_tab=explode("-", $value['date_aide']);
			$jour_tab=explode(" ",$date_tab[2]);
			$jour=$jour_tab[0];

			$m=$date_tab[1];
			$months = array (1=>'Jan',2=>'Fev',3=>'Mar',4=>'Avr',5=>'Mai',6=>'Juin',7=>'Juil',8=>'Aout',9=>'Sept',10=>'Oct',11=>'Nov',12=>'Dec');

			?>
			<tr class="event-item">
				<td class="upcoming">
					<div class="date-event">
						<svg class="olymp-small-calendar-icon"><use xlink:href="icons/icons.svg#olymp-small-calendar-icon"></use></svg>
						<span class="day"><?php echo $jour;?></span>
						<span class="month"><?php echo $months[(int)$m]; ?></span>
					</div>
				</td>
				<td class="author">
					<div class="event-author inline-items">
						<div class="author-thumb">
							<img src="img/avatar43-sm.jpg" alt="author" style="width:45px !important;">
						</div>
						<div class="author-date">
							<a class="author-name h6"><?php echo utf8_encode($value['titre']);?></a>
							<time class="published"><?php echo utf8_encode($value['prenom']." ".$value['nom']);?></time>
						</div>
					</div>
				</td>
				<td class="location">
					<div class="place inline-items">
						<svg class="olymp-add-a-place-icon"><use xlink:href="icons/icons.svg#olymp-add-a-place-icon"></use></svg>
						<a target="_blank" style="color:inherit;"><?php echo $value['id_client'];?></a>
					</div>
				</td>
				<td class="description">
					<p class="description"><span style="font-weight: bold;">Description</span>: <?php echo shapeSpace_truncate_string_at_word(utf8_encode($value['description']),50);?></p>
				</td>
				<td class="add-event">
					<a class="btn btn-breez btn-sm moproblem" data-toggle="modal" data-user="<?php echo utf8_encode($value['prenom'].' '.$value['nom']);?>" data-id="<?php echo utf8_encode($value['id_aide']);?>" data-target="#problemos" style="background:<?php echo $value['couleur'];?>;color:white;"><?php echo utf8_encode($value['etat_aide']);?></a>
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
		$date_tab=explode("-", $value['date_aide']);
		$jour_tab=explode(" ",$date_tab[2]);
		$jour=$jour_tab[0];

		$m=$date_tab[1];
		$months = array (1=>'Jan',2=>'Fev',3=>'Mar',4=>'Avr',5=>'Mai',6=>'Juin',7=>'Juil',8=>'Aout',9=>'Sept',10=>'Oct',11=>'Nov',12=>'Dec');

		?>
		<tr class="event-item">
			<td class="upcoming">
				<div class="date-event">
					<svg class="olymp-small-calendar-icon"><use xlink:href="icons/icons.svg#olymp-small-calendar-icon"></use></svg>
					<span class="day"><?php echo $jour;?></span>
					<span class="month"><?php echo $months[(int)$m]; ?></span>
				</div>
			</td>
			<td class="author">
				<div class="event-author inline-items">
					<div class="author-thumb">
						<img src="img/avatar43-sm.jpg" alt="author" style="width:45px !important;">
					</div>
					<div class="author-date">
						<a class="author-name h6"><?php echo utf8_encode($value['titre']);?></a>
						<time class="published"><?php echo utf8_encode($value['prenom']." ".$value['nom']);?></time>
					</div>
				</div>
			</td>
			<td class="location">
				<div class="place inline-items">
					<svg class="olymp-add-a-place-icon"><use xlink:href="icons/icons.svg#olymp-add-a-place-icon"></use></svg>
					<a target="_blank" style="color:inherit;"><?php echo $value['id_client'];?></a>
				</div>
			</td>
			<td class="description">
				<p class="description"><span style="font-weight: bold;">Description</span>: <?php echo shapeSpace_truncate_string_at_word(utf8_encode($value['description']),50);?></p>
			</td>
			<td class="add-event">
				<a class="btn btn-breez btn-sm moproblem" data-toggle="modal" data-user="<?php echo utf8_encode($value['prenom'].' '.$value['nom']);?>" data-id="<?php echo utf8_encode($value['id_aide']);?>" data-target="#problemos" style="background:<?php echo $value['couleur'];?>;color:white;"><?php echo utf8_encode($value['etat_aide']);?></a>
			</td>

		</tr>
		<?php
	}
}

if(isset($_POST['admin_search'])){
	$search = $_POST['admin_search'];
	$varsearch = "%" . $search . "%";
	$requete_search = $bdd->prepare("SELECT * FROM client WHERE raison_social LIKE ? or num_client LIKE ? order by date_integration DESC");
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

		?>
		<div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-6 change_card projet_<?php echo $value['id_client'];?> qualif_<?php echo $value['id_etat'];?>">
			<div class="ui-block" data-mh="friend-groups-item">
				<div class="friend-item friend-groups resetmh">
					<div class="friend-item-content">
						<div class="more">
							<svg class="olymp-three-dots-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="icons/icons.svg#olymp-three-dots-icon"></use></svg>
							<ul class="more-dropdown">
								<li>
									<a class="modifier" data-toggle="modal" data-target="#change" href="#">Modifier la carte</a>
								</li>
								<li>
									<a class="delete" href="#">Supprimer la carte</a>
								</li>
							</ul>
						</div>
						<div class="friend-avatar">
							<div class="author-thumb">
								<img src="img/crea_maquette.png" alt="Olympus">
							</div>
							<div class="author-content">
								<a href="#" class="h5 author-name raisonsocial"><?php echo $value['raison_social'];?></a>
								<div class="country numclient"><?php echo $value['num_client'];?></div>
							</div>
						</div>
						<ul class="friends-harmonic">
							<p>NOM DU GRAPH</p>
						</ul>
						<div class="control-block-button">
							<a href="<?php echo $value['lien_CMS'];?><" target="_blank" class="cms btn btn-control bg-blue">
								<svg class="olymp-happy-faces-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="icons/icons.svg#olymp-happy-faces-icon"></use></svg>
							</a>
							<a href="check.php?idgpp=<?php echo $value['IDGPP'];?><" class="btn btn-control btn-grey-lighter">
								<svg class="olymp-settings-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="icons/icons.svg#olymp-settings-icon"></use></svg>
							</a>
							<input type="hidden" class="idgpp" value="<?php echo $value['IDGPP'];?>">
							<input type="hidden" class="graph" value="<?php echo $value['id_graph_maquette'];?>">
						</div>
					</div>
				</div>
			</div>
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

if(isset($_POST['lienveille'])){
	$lienveille = $_POST['lienveille'];
	$titreveille = $_POST['titreveille'];
	$categorie = $_POST['categorie_veille'];
	$file_arr = $_POST['file_veille'];
	$file="";
	$i=0;
	foreach ($file_arr as $key => $value) {
		if ($i!=0) {
			$file.=";";
		}
		$file.=$value;
		$i++;
	}
	$like_veille = 0;
	$date_veille = date('Y-m-d H:i:s');
	$description = $_POST['description_veille'];
	$requete_veille = $bdd->prepare("INSERT INTO veille (titre, categorie, file, description, lien, date_veille, like_veille)	VALUES (?, ?, ?, ?, ?, ?, ?)");
	$requete_veille->bindParam(1, $titreveille);
	$requete_veille->bindParam(2, $categorie);
	$requete_veille->bindParam(3, $file);
	$requete_veille->bindParam(4, $description);
	$requete_veille->bindParam(5, $lienveille);
	$requete_veille->bindParam(6, $date_veille);
	$requete_veille->bindParam(7, $like_veille);
	$requete_veille->execute();

	$requete_show_veille = $bdd->prepare("SELECT * from veille order by id_veille desc limit 1");
	$requete_show_veille->execute();
	foreach ($requete_show_veille as $key => $value) {?>
	<div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-xs-12 sorting-item <?php echo($value['categorie']) ?>">
		<div class="ui-block">
			<article class="hentry blog-post">

				<div class="post-thumb">
					<img src="uploads/veille/<?php echo($value['file']) ?>" alt="photo">
				</div>

				<div class="post-content">
					<a href="#" class="h4 post-title"><?php echo($value['titre']) ?></a>
					<p><?php echo($value['description']) ?>											</p>

					<div class="author-date not-uppercase">
						<div class="post__date">
							<time class="published" datetime="2017-03-24T18:18">
								<?php echo($value['date_veille']) ?>
							</time>
						</div>
					</div>
					<a href="#" class="post-add-icon inline-items" style="fill: #ff5e3a;color: #ff5e3a;"><svg class="olymp-heart-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="icons/icons.svg#olymp-heart-icon"></use></svg><span><?php echo($value['like_veille']) ?></span></a>
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
	$id_graph=$_SESSION['id_graph'];
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
	$query_modif = $bdd->prepare("UPDATE client set num_client = ?, raison_social = ?, lien_CMS = ?, id_graph_maquette = ?, id_etat = ? WHERE id_client = ?");
	$query_modif->bindParam(1, $modif_num);
	$query_modif->bindParam(2, $modif_rs);
	$query_modif->bindParam(3, $modif_cms);
	$query_modif->bindParam(4, $modif_graph);
	$query_modif->bindParam(5, $modif_qualif);
	$query_modif->bindParam(6, $get_id_client);
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
			<div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-xs-12 sorting-item <?php echo($value['categorie_code']) ?>">
				<div class="ui-block">
					<article class="hentry blog-post">
						<a class="opencode" target="_blank" href="code.php">
							<div class="post-content">
								<p class="post-category bg-blue-light"><?php echo utf8_encode($value['categorie_code']);?></p>
								<h4><?php echo utf8_encode($value['titre']);?></h4>
								<p><?php echo utf8_encode($value['description']);?></p>

								<div class="author-date">
									<p class="h6 post__author-name fn"><?php echo utf8_encode($value['prenom']);?> <?php echo utf8_encode($value['nom']);?></p>
									<div class="post__date">
										<time class="published">
											<?php echo utf8_encode($value['date_code']);?>
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
		<div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-xs-12 sorting-item <?php echo($value['categorie_code']) ?>">
			<div class="ui-block">
				<article class="hentry blog-post">
					<a class="opencode" target="_blank" href="code.php">
						<div class="post-content">
							<p class="post-category bg-blue-light"><?php echo utf8_encode($value['categorie_code']);?></p>
							<h4><?php echo utf8_encode($value['titre']);?></h4>
							<p><?php echo utf8_encode($value['description']);?></p>

							<div class="author-date">
								<p class="h6 post__author-name fn"><?php echo utf8_encode($value['prenom']);?> <?php echo utf8_encode($value['nom']);?></p>
								<div class="post__date">
									<time class="published">
										<?php echo utf8_encode($value['date_code']);?>
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
	$id_user = $_SESSION['id_graph'];
	$date = date('Y-m-d H:i:s');
	$accept_remontees = 0;
	$commentaires = '';
	$requete_remontee = $bdd->prepare("INSERT INTO remontees (titre, description, id_categorie_remontees, date_remontees, id_user, accept_remontees, commentaires) VALUES (?,?,?,?,?,?,?)");
	$requete_remontee->bindParam(1, $titre_remontees);
	$requete_remontee->bindParam(2, $description_remontees);
	$requete_remontee->bindParam(3, $categorie_remontees);
	$requete_remontee->bindParam(4, $date);
	$requete_remontee->bindParam(5, $id_user);
	$requete_remontee->bindParam(6, $accept_remontees);
	$requete_remontee->bindParam(7, $commentaires);
	$requete_remontee->execute();
}

if (isset($_POST['commentaire_remontees'])) {
	$accept_remontees = 1;
	$id_remontees = utf8_decode($_POST['id_remontees']);
	$commentaire = utf8_decode($_POST['commentaire_remontees']);
	$requete_accept_remontee = $bdd->prepare("UPDATE remontees SET accept_remontees = ?, commentaires = ? where id_remontees = ?");
	$requete_accept_remontee->bindParam(1, $accept_remontees);
	$requete_accept_remontee->bindParam(2, $commentaire);
	$requete_accept_remontee->bindParam(3, $id_remontees);
	$requete_accept_remontee->execute();
}

if (isset($_POST['commentaire_remontees_refus'])) {
	$decline_remontees = 0;
	$id_remontees = utf8_decode($_POST['id_remontees']);
	$commentaire = utf8_decode($_POST['commentaire_remontees_refus']);
	$requete_decline_remontee = $bdd->prepare("UPDATE remontees SET accept_remontees = ?, commentaires = ? where id_remontees = ?");
	$requete_decline_remontee->bindParam(1, $decline_remontees);
	$requete_decline_remontee->bindParam(2, $commentaire);
	$requete_decline_remontee->bindParam(3, $id_remontees);
	$requete_decline_remontee->execute();
}

