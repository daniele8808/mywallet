<?php 
	include 'form.html.php';

if (!isset($_REQUEST['user'])) {

} else{
	$user = $_REQUEST['user'];
	$password = $_REQUEST['password'];


	if ($nome == 'Daniele') {
		$output = "Bentornato capo";
	} else {
		echo "Benvenuto nel nostro sito " . 
		htmlspecialchars($user, ENT_QUOTES, 'UTF-8')." " .
		htmlspecialchars($password, ENT_QUOTES, 'UTF-8');
	}
	include 'welcome.html.php';

} 


	try {
		$pdo = NEW PDO('mysql:host=localhost; dbname=mywallet', 'mywalletuser', 'mywalletpassword'); 
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    $pdo->exec('SET NAMES "utf8"');
	} catch (PDOException $e) {
		$output = 'Impossibile connettersi al server db. - '. $e->getMessage();
		include 'output.html.php';
		exit();
	}	

	$nome = !isset($_POST['nome']);
	$mail = !isset($_POST['mail']);
	$password = !isset($_POST['password']);

	
	if (isset($_POST['register'])) {
		header('Location: .');
	
	if ($nome || $mail || $password) {
		echo "Devi compilare tutti i campi";
	} else{
		echo "cazzo";
	}
	
	}