<?php try {
	$pdo = NEW PDO('mysql:host=localhost; dbname=mywallet', 'root', 'root'); 
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec('SET NAMES "utf8"');
} catch (PDOException $e) {
	$output = 'Impossibile connettersi al server db. - '. $e->getMessage();
	include 'output.html.php';
	exit();
}	