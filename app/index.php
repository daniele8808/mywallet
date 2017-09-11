<?php  

	$root = '/provePhp/myWallet/app';
	include $_SERVER['DOCUMENT_ROOT'] . $root .'/includes/db.inc.php' ;
	include $_SERVER['DOCUMENT_ROOT'] . $root .'/includes/helpers.inc.php' ;
	include $_SERVER['DOCUMENT_ROOT'] . $root .'/includes/cookie.php' ;

	$spese = array();


	try {
		$sql = 'SELECT id, descrizione, costo, idutente, tempo FROM costi';
		$s = $pdo->prepare($sql);
		$s->execute();								
	} catch (PDOException $e) {
		$error = 'Errore nel recupero dei dati costo da modificare.' . $e;
	    include 'error.html.php';
	    exit();		
	}

	foreach ($s as $row) {	
		$spese[] = array('id'=>$row['id'], 'descrizione'=>$row['descrizione'], 'costo'=>$row['costo'], 'idutente'=>$row['idutente'],'tempo'=>$row['tempo']); 
	}

	//	VISUALIZZA O NO DATI SE PRESENTI NEL DB
	if (count($spese) == 0) {
		include 'no_data.html.php';
		exit();
	} else {
		include 'review.html.php';
		exit();
	}	