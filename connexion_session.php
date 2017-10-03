<?php
session_start();
/* Connexion à une base ODBC avec l'invocation de pilote */
//$dsn = 'mysql:dbname=hloevenbqua;host=hloevenbqua.mysql.db';
//$user = 'hloevenbqua';
//$password = 'NUy66DcYqKVLmbwm';

$dsn = 'mysql:dbname=nouvelle_charte;host=localhost';
$user = 'root';
$password = 'root';

try {
	$bdd = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
	echo 'Connexion échouée : ' . $e->getMessage();
}

date_default_timezone_set('Europe/Paris');
