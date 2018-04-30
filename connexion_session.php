<?php
ini_set('session.gc_maxlifetime', 30000*60);
ini_set('session.gc_probability', 0);
session_start();
/* Connexion à une base ODBC avec l'invocation de pilote */
// $dsn = 'mysql:dbname=hloevenbqua;host=hloevenbqua.mysql.db';
// $user = 'hloevenbqua';
// $password = 'NUy66DcYqKVLmbwm';

$dsn = 'mysql:dbname=Factory_Rec;host=factory-rec.solocalms.intra';
$user = 'uFactoryRec';
$password = 'OkqAgPt87zQ#';

try {
	$bdd = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
	echo 'Connexion échouée : ' . $e->getMessage();
}

date_default_timezone_set('Europe/Paris');

if(!isset($_COOKIE['event'])) {
	setcookie("event", 1, 2147483647);
}else{
	setcookie("event", $_COOKIE['event'] + 1, 2147483647);
}