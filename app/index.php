<?php  
	$root = '/provePhp/myWallet/app';
	include $_SERVER['DOCUMENT_ROOT'] . $root .'/includes/db.inc.php' ;
	include $_SERVER['DOCUMENT_ROOT'] . $root .'/includes/helpers.inc.php' ;


	$costi = visualizza_costi();
	$dati = visualizza_dati();
	
	//	VISUALIZZA O NO DATI SE PRESENTI NEL DB
	if ($dati != 0) {
		include 'review.html.php';
	} else {
		include 'no_data.html.php';
	}