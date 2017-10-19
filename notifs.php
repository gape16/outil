<?php

include('connexion_session.php');

$id_graph=$_SESSION['id_graph'];

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
		$query_notif_code=$bdd->prepare("SELECT description, titre, photo, categorie_code.categorie_code FROM code inner join user on code.id_user = user.id_user inner join categorie_code on code.categorie_code = categorie_code.id_categorie_code WHERE id_code > ? and accept_code = 1 order by id_code DESC");
		$query_notif_code->bindParam(1, $dernier);
		$query_notif_code->execute();
		$notif_code = $query_notif_code->fetchAll();
		print_r(json_encode($notif_code));
	}
}


if(isset($_POST['veille'])){
	if($result['notif_B']==0){
		$query_notif_code=$bdd->prepare("SELECT * FROM veille order by id_veille DESC limit 1");
		$query_notif_code->execute();
		$result_notif_code=$query_notif_code->fetch();
		$dernier=$result_notif_code['id_veille'];
		$query_inser_code=$bdd->prepare("UPDATE notifications set notif_B = ? where id_user = ?");
		$query_inser_code->bindParam(1, $dernier);
		$query_inser_code->bindParam(2, $id_graph);
		$query_inser_code->execute();
	}else{
		$dernier=$result['notif_B'];
		$query_notif_code=$bdd->prepare("SELECT description, titre, file, categorie_veille.categorie FROM veille inner join categorie_veille on veille.categorie = categorie_veille.id_categorie_veille WHERE id_veille > ? order by id_veille DESC");
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
		$query_notif_code=$bdd->prepare("SELECT id_client, categorie, etat_achat.etat, photo FROM achat_photos inner join user on achat_photos.id_controleur = user.id_user inner join etat_achat on achat_photos.id_etat_achat = etat_achat.etat WHERE id_achat > ? order by id_achat DESC");
		$query_notif_code->bindParam(1, $dernier);
		$query_notif_code->execute();
		$notif_code = $query_notif_code->fetchAll();
		print_r(json_encode($notif_code));
	}
}

