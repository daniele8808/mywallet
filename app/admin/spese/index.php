<?php  
	$root = '/provePhp/myWallet/app';
	include $_SERVER['DOCUMENT_ROOT'] . $root .'/includes/db.inc.php' ;
	include $_SERVER['DOCUMENT_ROOT'] . $root .'/includes/helpers.inc.php' ;

	if (isset($_GET['add'])) {
		$pagetitle = 'Nuova Spesa';
		$action = 'addform';
		$descrizione = '';
		$idutente = '';
		$costo = '';
		$id = '';
		$button = 'Aggiungi Spesa';

		//recupero i dati degli utenti
		try {
			 $result = $pdo->query('SELECT id, utente FROM utenti');
		} catch (PDOException $e) {
		 	$error = 'Errore nel recupero dei dati utente.' .$e;
		 	include 'error.html.php';
		 	exit();		
		}	

		foreach ($result as $row) {
			$utenti[] = array('id'=>$row['id'], 'utente'=>$row['utente']);
		}
		
		//recupero i dati delle categorie
		try {
			 $result = $pdo->query('SELECT id, categoria FROM categorie');
		} catch (PDOException $e) {
		 	$error = 'Errore nel recupero dei dati categoria.'.$e;
		 	include 'error.html.php';
		 	exit();
		}	

		foreach ($result as $row) {	
			$categorie[] = array(
				'id'=>$row['id'],
				'categoria'=>$row['categoria'],
				'selected'=> FALSE);
		}

		include 'form.html.php';
		exit();
	}

	//AGGIUNGE UN COSTO AL DB
	if (isset($_GET['addform'])) {

		if ($_POST['utente'] == '') {
		    $error = 'Devi selezionare un \'utene.';
		    include 'error.html.php';
		    exit();					    
		}

		try {
			$sql = 'INSERT INTO costi 
					SET 
					costo = :costo,
					descrizione = :descrizione,
					idutente = :idutente,
					tempo = CURRENT_TIMESTAMP()';
			$s = $pdo->prepare($sql);
			$s->bindValue(':costo', $_POST['costo']);
			$s->bindValue(':descrizione', $_POST['descrizione']);
			$s->bindValue(':idutente', $_POST['utente']);
			$s->execute();			
		} catch (PDOException $e) {
		    $error = 'Errore nell\'inserimento dei dati utente'.$e;
		    include 'error.html.php';
		    exit();				
		}


		$costoid = $pdo->lastInsertId();

		if (isset($_POST['categorie'])) {

			try {
				$sql = 'INSERT INTO costicategorie SET 
						costiid = :costiid,
						categorieid = :categorieid';
			
				$s = $pdo->prepare($sql);

				foreach ($_POST['categorie'] as $categorieid) {
					$s->bindValue(':costiid', $costoid);
					$s->bindValue(':categorieid', $categorieid); // --> non trova la variabile categorieid\ 
					$s->execute();								
				}
			} catch (PDOException $e) {
				$error = 'Errore nel recupero dei dati costo da modificare.' . $e;
			    include 'error.html.php';
			    exit();		
			}
		}

		header('Location: .');
		exit();
	}

	//SE CLICK SU MODIFICA COSTO
	if (isset($_POST['action']) and $_POST['action'] == 'modifica') {

		//$output = $_POST['id']
		//include 'output.html.php';

		try {
			$sql = 'SELECT id, descrizione, costo, idutente FROM costi WHERE id = :id';
			$s = $pdo->prepare($sql);
			$s->bindValue(':id', $_POST['id']);
			$s->execute();								
		} catch (PDOException $e) {
			$error = 'Errore nel recupero dei dati costo da modificare.' . $e;
		    include 'error.html.php';
		    exit();		
		}

		$row = $s->fetch();
		
		$pagetitle = 'Modifica Spesa';
		$action = 'editform';
		$descrizione = $row['descrizione'];
		$idutente = $row['idutente'];
		$costo = $row['costo'];
		$id = $row['id'];
		$button = 'Aggiorna Spesa';		

		//$output = $row['id'];
		//include 'output.html.php';

		try {
			 $result = $pdo->query('SELECT id, utente FROM utenti');
		} catch (PDOException $e) {
		 	$error = 'Errore nel recupero dei dati utente.' .$e;
		 	include 'error.html.php';
		 	exit();		
		}	

		foreach ($result as $row) {	$utenti[] = array('id'=>$row['id'], 'utente'=>$row['utente']); }

		//Ottiene l'elenco delle categorie di questo costo
		try {
			$sql = 'SELECT categorieid FROM costicategorie WHERE costiid = :id';
			$s = $pdo->prepare($sql);
			// 	$s->bindValue(':id', $_POST['id']);
		    $s->bindValue(':id', $id);
		 	$s->execute();			 
		} catch (PDOException $e) {
		 	$error = 'Errore nel recupero delle categorie selezionate.'.$e;
		 	include 'error.html.php';
		 	exit();		
		}	
		
		$categorieselezionate = array();
		
		//ciclo che recupera tutte le categorie solozionate
		foreach ($s as $row) 
		{ 
			$categorieselezionate[] = $row['categorieid'];
		}

		try {
			$result = $pdo->query('SELECT id, categoria FROM categorie');
		} catch (PDOException $e) {
		 	$error = 'Errore nel recuperare l\'elenco delle categorie.' . $e;
		 	include 'error.html.php';
		 	exit();		
		}		
			
		foreach ($result as $row) 
		{
			$categorie[] = array(
				'id'=>$row['id'], 
				'categoria'=>$row['categoria'],
				'selected' => in_array($row['id'], $categorieselezionate)); 
		}

		include 'form.html.php';
		exit();	
	}		

	//INVIA IL FORM DI MODIFICA
	if (isset($_GET['editform'])) {

		//Se il campo utente è vuoto
		if ($_POST['utente'] == '') {
			$error = 'Devi selezionare un utente per modificare';
			include 'error.html.php';
			exit();			
		}
		
		try {
			$sql = 'UPDATE costi
					SET descrizione = :descrizione,
					costo = :costo,
					tempo = CURRENT_TIMESTAMP(),
					idutente = :idutente
					WHERE
					id = :id';
			$s = $pdo->prepare($sql);
			$s->bindValue(':id', $_POST['id']);
			$s->bindValue(':costo', $_POST['costo']);
			$s->bindValue(':descrizione', $_POST['descrizione']);
			$s->bindValue(':idutente', $_POST['utente']);
		 	$s->execute();				

		} catch (PDOException $e) {
		 	$error = 'Errore nell aggiornamento del costo'. $e;
		 	include 'error.html.php';
		 	exit();		
		}		
	
		try {
			$sql = 'DELETE FROM costicategorie WHERE costiid = :costiid';
				$s = $pdo->prepare($sql);
			    $s->bindValue(':costiid', $_POST['id']);
				$s->execute();
		} catch (PDOException $e) {
		 	$error = 'Errore nell\'aggiornamento del costo'. $e;
		 	include 'error.html.php';
		 	exit();		
		}		

		//SE l'utente il categoria utente è vuoto
		if (isset($_POST['categorie'])) { 
			
			try {
				$sql = 'INSERT INTO costicategorie SET 
						costiid = :costiid,
						categorieid = :categorieid';
			
				$s = $pdo->prepare($sql);

				foreach ($_POST['categorie'] as $categorieid){
					$s->bindValue(':costiid', $_POST['id']);
					$s->bindValue(':categorieid', $categorieid); 
					$s->execute();								
				}
			} catch (PDOException $e) {
				$error = 'Errore nel recupero dei dati costo da modificare.' . $e;
			    include 'error.html.php';
			    exit();		
			}
		}

		header('Location: .');		
		exit();
	}		

	//CANCELLA UN COSTO DAL DB
	if (isset($_POST['action']) and $_POST['action'] == 'cancella') {

		//Elimina associazioni dei costi con le categorie
		try {
			$sql = 'DELETE FROM costicategorie WHERE costiid = :id';
			$s = $pdo->prepare($sql);
		 	$s->bindValue(':id', $_POST['id']);
		 	$s->execute();
		} catch (PDOException $e) {
		 	$error = 'Errore nell\'elimoinazione del costo.';
		 	include 'error.html.php';
		 	exit();		
		}

		//Elimina La categoria
		try {
			$sql = 'DELETE FROM costi WHERE id = :id';
			$s = $pdo->prepare($sql);
		 	$s->bindValue(':id', $_POST['id']);
		 	$s->execute();
		} catch (PDOException $e) {
		 	$error = 'Error fetching author details.';
		 	include 'error.html.php';
		 	exit();		
		}	
	}

	//CERCA DEI COSTI NEL DB
	if (isset($_GET['action']) and $_GET['action'] == 'search') {

		$select = 'SELECT id, costo, descrizione, tempo, idutente';
		$from = ' FROM costi';
		$where = ' WHERE TRUE';

		$placeolders = array();

		if ($_GET['utente'] != '') {
			$where .= " AND idutente = :idutente";
			$placeolders[':idutente'] = $_GET['utente'];
		}

		if ($_GET['categoria'] != '') {
			$from .= ' INNER JOIN costicategorie ON id = costiid';
			$where .= " AND categorieid = :categorieid";
			$placeolders[':categorieid'] = $_GET['categoria'];
		}

		if ($_GET['testo'] != '') {
			$where .= ' AND descrizione LIKE :testo';
			$placeolders[':testo'] = '%'. $_GET['testo'] . '%';
		}

		try {
			$sql = $select . $from . $where;
			$s = $pdo->prepare($sql);
			$s->execute($placeolders);						
		} catch (PDOException $e) {
			$error = 'Errore nel recupero dei dati' .$e;
		    include 'error.html.php';
		    exit();		
		}

		foreach ($s as $row) {
			$spese[] = array(
				'id'=>$row['id'], 
				'costo'=>$row['costo'],				
				'descrizione'=>$row['descrizione'],
				'tempo'=>$row['tempo'],
				'idutente'=>$row['idutente']
			);
		}

		include 'spese.html.php';
		exit();		
	}	

	//visualizza il modulo di ricerca vuoto
	try {
		 $result = $pdo->query('SELECT id, utente FROM utenti');
	} catch (PDOException $e) {
	 	$error = 'Errore nel recupero dei dati utente.' .$e;
	 	include 'error.html.php';
	 	exit();		
	}	

	foreach ($result as $row) {
		$utenti[] = array('id'=>$row['id'], 'utente'=>$row['utente']);
	}

	try {
		 $result = $pdo->query('SELECT id, categoria FROM categorie');
	} catch (PDOException $e) {
	 	$error = 'Errore nel recupero dei dati categoria.'.$e;
	 	include 'error.html.php';
	 	exit();		
	}	

	foreach ($result as $row) {
		$categorie[] = array('id'=>$row['id'], 'categoria'=>$row['categoria']);
	}

	include 'searchform.html.php';
