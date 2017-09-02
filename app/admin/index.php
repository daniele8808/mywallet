<?php  
	$root = '/provePhp/myWallet/app';
	include $_SERVER['DOCUMENT_ROOT'] . $root .'/includes/db.inc.php' ;
	include $_SERVER['DOCUMENT_ROOT'] . $root .'/includes/helpers.inc.php' ;
	$costi;
	$categorie;

	
	// INSERISCE NUOVI COSTI 
	if (isset($_GET['aggiungi_costo'])) { inserisci_costo();}

	//CANCELLA COSTO
	if (isset($_GET['cancella_costo'])) { cancella_costo();	}

	$costi = visualizza_costi(); /* visualizza in homepage una review degli ultimi costi*/
	
	//SE CLICK SU MODIFICA COSTO
	if (isset($_GET['modifica_costo'])) { modifica_costo();	}

	//AGGIORNA COSTO --> viene eseguito dopo aver inviato il form di aggiornamento costo
	if (isset($_GET['aggiorna_costo'])) { aggiorna_costo();	}
	
	//SE CLICK SU AGGIUNGI COSTO
	if (isset($_GET['inserisci_costo'])) {	include 'inserisci_costo.php'; exit();	}


	//SE NON CI SONO/NON CI SONO DATI NEL DB
	//if ($costi[0] != 0) {
	include 'review.html.php';
	//} else {
	//	include 'no_data.html.php';
	//}

	