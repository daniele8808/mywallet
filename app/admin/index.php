<?php  
	$root = '/provePhp/myWallet/app';
	include $_SERVER['DOCUMENT_ROOT'] . $root .'/includes/db.inc.php' ;
	include $_SERVER['DOCUMENT_ROOT'] . $root .'/includes/helpers.inc.php' ;

	//SE NON CI SONO/NON CI SONO DATI NEL DB
	//if ($costi[0] != 0) {
	include 'review.html.php';
	//} else {
	//	include 'no_data.html.php';
	//}

	