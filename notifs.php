<?php

include('connexion_session.php');

$id_graph=$_COOKIE['id_graph'];

$bdd->exec('SET NAMES utf8');
$query_select=$bdd->prepare("SELECT * FROM notifications where id_user = ?");
$query_select->bindParam(1, $id_graph);
$query_select->execute();
$result=$query_select->fetch();

if(isset($_POST['code'])){
	if($result['notif_A']==0){
		$query_notif_code=$bdd->prepare("SELECT * FROM code where accept_code = 1 order by id_code DESC limit 1");
		$query_notif_code->execute();
		$result_notif_code=$query_notif_code->fetch();
		$dernier=$result_notif_code['id_code'];
		$query_inser_code=$bdd->prepare("UPDATE notifications set notif_A = ? where id_user = ?");
		$query_inser_code->bindParam(1, $dernier);
		$query_inser_code->bindParam(2, $id_graph);
		$query_inser_code->execute();
	}else{
		$dernier=$result['notif_A'];
		$query_notif_code=$bdd->prepare("SELECT description, titre, photo_avatar, categorie_code.categorie_code, code.id_code FROM code inner join user on code.id_user = user.id_user inner join categorie_code on code.categorie_code = categorie_code.id_categorie_code WHERE id_code > ? and accept_code = 1 order by id_code DESC");
		$query_notif_code->bindParam(1, $dernier);
		$query_notif_code->execute();
		$notif_code = $query_notif_code->fetchAll();
		print_r(json_encode($notif_code));
	}
}
if(isset($_POST['code_admin'])){
	if($result['notif_A']==0){
		$query_notif_code=$bdd->prepare("SELECT * FROM code where accept_code = 0 order by id_code DESC limit 1");
		$query_notif_code->execute();
		$result_notif_code=$query_notif_code->fetch();
		$dernier=$result_notif_code['id_code'];
		$query_inser_code=$bdd->prepare("UPDATE notifications set notif_A = ? where id_user = ?");
		$query_inser_code->bindParam(1, $dernier);
		$query_inser_code->bindParam(2, $id_graph);
		$query_inser_code->execute();
	}else{
		$dernier=$result['notif_A'];
		$query_notif_code=$bdd->prepare("SELECT description, titre, photo_avatar, categorie_code.categorie_code, code.id_code FROM code inner join user on code.id_user = user.id_user inner join categorie_code on code.categorie_code = categorie_code.id_categorie_code WHERE id_code > ? and accept_code = 0 order by id_code DESC");
		$query_notif_code->bindParam(1, $dernier);
		$query_notif_code->execute();
		$notif_code = $query_notif_code->fetchAll();
		print_r(json_encode($notif_code));
	}
}


if(isset($_POST['veille'])){
	if($result['notif_B']==0){
		$query_notif_code=$bdd->prepare("SELECT * FROM veille where accept_veille = 1 order by id_veille DESC limit 1");
		$query_notif_code->execute();
		$result_notif_code=$query_notif_code->fetch();
		$dernier=$result_notif_code['id_veille'];
		$query_inser_code=$bdd->prepare("UPDATE notifications set notif_B = ? where id_user = ?");
		$query_inser_code->bindParam(1, $dernier);
		$query_inser_code->bindParam(2, $id_graph);
		$query_inser_code->execute();
	}else{
		$dernier=$result['notif_B'];
		$query_notif_code=$bdd->prepare("SELECT description, titre, file, categorie_veille.categorie FROM veille inner join categorie_veille on veille.categorie = categorie_veille.id_categorie_veille WHERE id_veille > ? and accept_veille = 1 order by id_veille DESC");
		$query_notif_code->bindParam(1, $dernier);
		$query_notif_code->execute();
		$notif_code = $query_notif_code->fetchAll();
		print_r(json_encode($notif_code));
	}
}

if(isset($_POST['veille_admin'])){
	if($result['notif_B']==0){
		$query_notif_code=$bdd->prepare("SELECT * FROM veille where accept_veille = 0 order by id_veille DESC limit 1");
		$query_notif_code->execute();
		$result_notif_code=$query_notif_code->fetch();
		$dernier=$result_notif_code['id_veille'];
		$query_inser_code=$bdd->prepare("UPDATE notifications set notif_B = ? where id_user = ?");
		$query_inser_code->bindParam(1, $dernier);
		$query_inser_code->bindParam(2, $id_graph);
		$query_inser_code->execute();
	}else{
		$dernier=$result['notif_B'];
		$query_notif_code=$bdd->prepare("SELECT description, titre, file, categorie_veille.categorie FROM veille inner join categorie_veille on veille.categorie = categorie_veille.id_categorie_veille WHERE id_veille > ? and accept_veille = 0 order by id_veille DESC");
		$query_notif_code->bindParam(1, $dernier);
		$query_notif_code->execute();
		$notif_code = $query_notif_code->fetchAll();
		print_r(json_encode($notif_code));
	}
}

if(isset($_POST['achat'])){
	if($result['notif_C']==0){
		$query_notif_code=$bdd->prepare("SELECT * FROM achat_photos order by id_achat DESC limit 1");
		$query_notif_code->execute();
		$result_notif_code=$query_notif_code->fetch();
		$dernier=$result_notif_code['id_achat'];
		$query_inser_code=$bdd->prepare("UPDATE notifications set notif_C = ? where id_user = ?");
		$query_inser_code->bindParam(1, $dernier);
		$query_inser_code->bindParam(2, $id_graph);
		$query_inser_code->execute();
	}else{
		$dernier=$result['notif_C'];
		$query_notif_code=$bdd->prepare("SELECT id_client, categorie, etat_achat.etat, photo_avatar FROM achat_photos left join user on achat_photos.id_controleur = user.id_user left join etat_achat on achat_photos.id_etat_achat = etat_achat.id_etat_achat WHERE id_achat > ? and (achat_photos.id_etat_achat = 2 or achat_photos.id_etat_achat = 3) order by id_achat DESC");
		$query_notif_code->bindParam(1, $dernier);
		$query_notif_code->execute();
		$notif_code = $query_notif_code->fetchAll();
		print_r(json_encode($notif_code));
	}
}
if(isset($_POST['achat_admin'])){
	if($result['notif_C']==0){
		$query_notif_code=$bdd->prepare("SELECT * FROM achat_photos order by id_achat DESC limit 1");
		$query_notif_code->execute();
		$result_notif_code=$query_notif_code->fetch();
		$dernier=$result_notif_code['id_achat'];
		$query_inser_code=$bdd->prepare("UPDATE notifications set notif_C = ? where id_user = ?");
		$query_inser_code->bindParam(1, $dernier);
		$query_inser_code->bindParam(2, $id_graph);
		$query_inser_code->execute();
	}else{
		$dernier=$result['notif_C'];
		$query_notif_code=$bdd->prepare("SELECT id_client, categorie, etat_achat.etat, photo_avatar FROM achat_photos left join user on achat_photos.id_graph = user.id_user left join etat_achat on achat_photos.id_etat_achat = etat_achat.id_etat_achat WHERE id_achat > ? and achat_photos.id_etat_achat = 1 order by id_achat DESC");
		$query_notif_code->bindParam(1, $dernier);
		$query_notif_code->execute();
		$notif_code = $query_notif_code->fetchAll();
		print_r(json_encode($notif_code));
	}
}

if(isset($_POST['aide'])){
	if($result['notif_D']==0){
		$query_notif_coded=$bdd->prepare("SELECT * FROM aide order by id_aide DESC limit 1");
		$query_notif_coded->execute();
		$result_notif_coded=$query_notif_coded->fetch();
		$dernierd=$result_notif_coded['id_aide'];
		$query_inser_coded=$bdd->prepare("UPDATE notifications set notif_D = ? where id_user = ?");
		$query_inser_coded->bindParam(1, $dernierd);
		$query_inser_coded->bindParam(2, $id_graph);
		$query_inser_coded->execute();
	}else{
		$dernierd=$result['notif_D'];
		$query_notif_coded=$bdd->prepare("SELECT id_client, titre, description, photo_avatar FROM aide inner join user on aide.id_user = user.id_user WHERE id_aide > ? and id_etat_aide = 1 order by id_aide DESC");
		$query_notif_coded->bindParam(1, $dernierd);
		$query_notif_coded->execute();
		$notif_code = $query_notif_coded->fetchAll();
		print_r(json_encode($notif_code));
	}
	
}
if(isset($_POST['aide_admin'])){
	if($result['notif_D']==0){
		$query_notif_coded=$bdd->prepare("SELECT * FROM aide order by id_aide DESC limit 1");
		$query_notif_coded->execute();
		$result_notif_coded=$query_notif_coded->fetch();
		$dernierd=$result_notif_coded['id_aide'];
		$query_inser_coded=$bdd->prepare("UPDATE notifications set notif_D = ? where id_user = ?");
		$query_inser_coded->bindParam(1, $dernierd);
		$query_inser_coded->bindParam(2, $id_graph);
		$query_inser_coded->execute();
	}else{
		$dernierd=$result['notif_D'];
		$query_notif_coded=$bdd->prepare("SELECT id_client, titre, description, photo_avatar FROM aide inner join user on aide.id_user = user.id_user WHERE id_aide > ? and id_etat_aide = 1 order by id_aide DESC");
		$query_notif_coded->bindParam(1, $dernierd);
		$query_notif_coded->execute();
		$notif_code = $query_notif_coded->fetchAll();
		print_r(json_encode($notif_code));
	}
	
}
if(isset($_POST['rem'])){
	$query_notif_rem=$bdd->prepare("SELECT * FROM notifications_remontees inner join user on notifications_remontees.id_user = user.id_user left join remontees on notifications_remontees.id_remontee = remontees.id_remontees left join categorie_remontees on remontees.id_categorie_remontees = categorie_remontees.id_categorie_remontees left join etat_remontees on remontees.accept_remontees = etat_remontees.id_etat_remontees WHERE notifications_remontees.id_user = ? and active = 1");
	$query_notif_rem->bindParam(1, $id_graph);
	$query_notif_rem->execute();
	$notif_code = $query_notif_rem->fetchAll();
	print_r(json_encode($notif_code));
}
if(isset($_POST['rem_news'])){
	$query_notif_rem=$bdd->prepare("SELECT * FROM commentaires_remontees inner join user on commentaires_remontees.id_user = user.id_user left join remontees on commentaires_remontees.id_remontees = remontees.id_remontees left join categorie_remontees on remontees.id_categorie_remontees = categorie_remontees.id_categorie_remontees left join etat_remontees on remontees.accept_remontees = etat_remontees.id_etat_remontees WHERE commentaires_remontees.id_user = ? and notif_com = 1 group by commentaires_remontees.id_remontees");
	$query_notif_rem->bindParam(1, $id_graph);
	$query_notif_rem->execute();
	$notif_code = $query_notif_rem->fetchAll();
	print_r(json_encode($notif_code));
}
if(isset($_POST['rem_news_bis'])){
	$query_notif_rem=$bdd->prepare("SELECT * FROM commentaires_remontees inner join user on commentaires_remontees.id_user = user.id_user left join remontees on commentaires_remontees.id_remontees = remontees.id_remontees left join categorie_remontees on remontees.id_categorie_remontees = categorie_remontees.id_categorie_remontees left join etat_remontees on remontees.accept_remontees = etat_remontees.id_etat_remontees WHERE remontees.id_user = ?  and notif_user = 1  group by commentaires_remontees.id_remontees");
	$query_notif_rem->bindParam(1, $id_graph);
	$query_notif_rem->execute();
	$notif_code = $query_notif_rem->fetchAll();
	print_r(json_encode($notif_code));
}


if(isset($_POST['rem_admin'])){
	$query_notif_rem=$bdd->prepare("SELECT * FROM remontees inner join user on remontees.id_user = user.id_user left join categorie_remontees on remontees.id_categorie_remontees = categorie_remontees.id_categorie_remontees WHERE accept_remontees = 1 ");
	$query_notif_rem->execute();
	$notif_code = $query_notif_rem->fetchAll();
	print_r(json_encode($notif_code));
}

if(isset($_POST['anniv'])){
	$query_notif_rem=$bdd->prepare("SELECT * FROM notification_anniversaire inner join user on notification_anniversaire.id_user_selection = user.id_user inner join statut on user.id_statut = statut.id_statut WHERE notification_anniversaire.id_compte = ? and active = 1 and DATE_FORMAT(NOW(), '%Y-%m-%d')  <=  CONCAT(YEAR(NOW()),'-',DATE_FORMAT(user.date_naissance, '%m-%d')) and DATE_FORMAT(NOW() + INTERVAL 15 DAY, '%Y-%m-%d') >= CONCAT(YEAR(NOW()),'-',DATE_FORMAT(user.date_naissance, '%m-%d'))");
	$query_notif_rem->bindParam(1, $id_graph);
	$query_notif_rem->execute();
	$notif_code = $query_notif_rem->fetchAll();
	print_r(json_encode($notif_code));
}
