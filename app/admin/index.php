<?php  
	$root = '/provePhp/myWallet/app';
	include $_SERVER['DOCUMENT_ROOT'] . $root .'/includes/db.inc.php' ;
	include $_SERVER['DOCUMENT_ROOT'] . $root .'/includes/helpers.inc.php' ;

	//try {
	//	$sql = 'SELECT id, descrizione, costo, idutente, tempo FROM costi';
	//	$s = $pdo->prepare($sql);
	//	$s->execute();								
	//} catch (PDOException $e) {
	//	$error = 'Errore nel recupero dei dati costo da modificare.' . $e;
	//    include 'error.html.php';
	//    exit();		
	//}
	//
	//foreach ($s as $row) {	
	//	$spese[] = array('id'=>$row['id'], 'descrizione'=>$row['descrizione'], 'costo'=>$row['costo'], 'idutente'=>$row['idutente'],'tempo'=>$row['tempo']); 
	//}

	//Se click su logout


	//SE NON CI SONO/NON CI SONO DATI NEL DB
	//if ($costi[0] != 0) {
	include 'review.html.php';

	//} else {
	//	include 'no_data.html.php';
	//}
