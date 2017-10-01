<?php 
	$root = '/provePhp/myWallet/app';
	//include $_SERVER['DOCUMENT_ROOT'] . $root .'/includes/helpers.inc.php' ;
	include $_SERVER['DOCUMENT_ROOT'] . $root .'/includes/db.inc.php' ;
	include $_SERVER['DOCUMENT_ROOT'] . $root .'/includes/access.inc.php';

	if(!userIsLoggedIn()){ 
		include '../login.html.php';
		exit();
	}

	if(!userHasRole('amministratore')){ 
		$error = 'Solo gli amministratori possono accedere a quest\'area';
		include '../accessonegato.html.php'; 
		exit();
	}
 
 	//Quando elimino un utente, automaticamente elimino anche i costi ad esso associati e la tabella associativa

	if (isset($_GET['add'])) {
	
		$pagetitle = 'Nuovo utente';
		$action = 'addform';
		$utente = '';
		$mail = '';
		$password = '';
		$ruoloid['ruoloid'] = array();
		$id = '';
		$button = 'Aggiungi utente';

		try {
			$sql = 'SELECT id FROM ruoli';
			$s = $pdo->prepare($sql);
			$s->execute();
		} catch (PDOException $e){
			$error = 'Errore nel recupero dei ruoli' . $e;
			include 'error.html.php';
			exit();			
		}
		
		foreach ($s as $row) {
			$ruoli[] = array('id' => $row['id']);
		}

		include 'form.html.php';
		exit();
	}

	if (isset($_GET['addform'])) {
	 	//include $_SERVER['DOCUMENT_ROOT'] . '/provePhp/myWallet/app' .'/includes/db.inc.php' ;
		try {
			$sql = 'INSERT INTO utenti SET
					utente = :utente,
					mail = :mail,
					password = :password';
			$s = $pdo->prepare($sql);
			$s->bindValue(':utente', $_POST['utente']);
			$s->bindValue(':mail', $_POST['mail']);
			$s->bindValue(':password', md5($_POST['password']));
			$s->execute();
		} catch (PDOException $e) {
			$error = 'Errore nel recupero dei dati da eliminare' . $e;
			include 'error.html.php';
			exit();				
		}	

		$utenteid = $pdo->lastInsertId();

		try {
			$sql = 'INSERT INTO utentiruoli SET
					utenteid = :utenteid,
					ruoloid = :ruoloid';
			$s = $pdo->prepare($sql);
			$s->bindValue(':utenteid', $utenteid);
			$s->bindValue(':ruoloid', $_POST['ruolo'] );
			$s->execute();
		} catch (PDOException $e) {
			$error = 'Errore nell\'associazione del ruolo utente '. $e;
			include 'error.html.php';
			exit();				
		}			

		header('Location: .');
		exit();
	}

	if (isset($_POST['action']) and $_POST['action'] == 'modifica') {
		//recupero nome, mail e id
		try {
			$sql = 'SELECT id, utente, mail, password FROM utenti WHERE id = :id';
			$s = $pdo->prepare($sql);
			$s->bindValue(':id', $_POST['id']);
			$s->execute();			
		} catch (PDOException $e) {
			$error = 'Errore nel recupero dei dati da eliminare' . $e;
			include 'error.html.php';
			exit();					
		}

		$row = $s->fetch();

		//recupero i ruoli
		try {
			$sql = 'SELECT id FROM ruoli';
			$s = $pdo->prepare($sql);
			$s->execute();
		} catch (PDOException $e){
			$error = 'Errore nel recupero dei ruoli' . $e;
			include 'error.html.php';
			exit();			
		}
		
		foreach ($s as $row2) {
			$ruoli[] = array('id' => $row2['id']);
		}		

		try {
			$sql = 'SELECT utenteid, ruoloid FROM utentiruoli WHERE utenteid = :id';
			$s = $pdo->prepare($sql);
			$s->bindValue(':id', $_POST['id']);
			$s->execute();			
		} catch (PDOException $e) {
			$error = 'Errore nel recupero degli ID utenti' . $e;
			include 'error.html.php';
			exit();		
		}

		$ruoloid = $s->fetch();
		
		$pagetitle = 'Modifica utente';
		$action = 'editform';
		$utente = $row['utente'];
		$mail = $row['mail'];
		$password = $row['password'];
		$id = $row['id'];
		$button = 'Modifica utente';	
		
		include 'form.html.php';
		exit();
	}

	if (isset($_GET['editform'])) {

		try {
			$sql = 'UPDATE utenti 
					SET utente = :utente,
						mail = :mail,
						password = :password 
					WHERE id = :id';
			$s = $pdo->prepare($sql);
			$s->bindValue(':id', $_POST['id']);
			$s->bindValue(':utente', $_POST['utente']);
			$s->bindValue(':mail', $_POST['mail']);
			$s->bindValue(':password', md5($_POST['password']));
			$s->execute();			
		} catch (PDOException $e) {
			$error = 'Errore nel recupero dei dati da eliminare' . $e;
			include 'error.html.php';
			exit();					
		}

		try {
			$sql = 'UPDATE utentiruoli
					SET utenteid = :utenteid,
						ruoloid = :ruoloid 
					WHERE utenteid = :utenteid';
			$s = $pdo->prepare($sql);
			$s->bindValue(':utenteid', $_POST['id']);
			$s->bindValue(':ruoloid', $_POST['ruolo']);
			$s->execute();			
		} catch (PDOException $e) {
			$error = 'Errore nel recupero dei dati da eliminare' . $e;
			include 'error.html.php';
			exit();					
		}		
		
  		header('Location: .');
		exit();
	}

	if (isset($_POST['action']) && $_POST['action'] == 'cancella'){

		//OTTIENI LE SPESE APPARTENENTI ALL'UTENTE
		try {
			$sql = 'SELECT id FROM costi WHERE idutente = :id';
			$s = $pdo->prepare($sql);
			$s->bindValue(':id', $_POST['id']);
			$s->execute();
		} catch (PDOExeption $e){
			$error = 'Errore nel recupero dei dati da eliminare' . $e;
			include 'error.html.php';
			exit();
		}

		$result = $s->fetchAll();

		//ELIMINA DATI DA TABELLA COSTICATEGORIE (l'utente associato a determinati costi e categorie scompare -> la categorie rimangono intatte ed anche i costi, scompare il tra le die cose)
		try {
			$sql = 'DELETE FROM costicategorie WHERE costiid = :id';
			$s = $pdo->prepare($sql);

			foreach ($result as $row) {
				$costiid = $row['id'];			
				$s->bindValue(':id', $costiid);
				$s->execute();
			}
		} catch (PDOExeption $e){
			$error = 'Errore nel recupero dei dati da eliminare' . $e;
			include 'error.html.php';
			exit();
		}

		//ELIMINA DATI UTENTE DALLA TB COSTI
		try {
			$sql = 'DELETE FROM costi WHERE idutente = :id';
			$s = $pdo->prepare($sql);
			$s->bindValue(':id', $_POST['id']);
			$s->execute();
		} catch (PDOExeption $e){
			$error = 'Errore nel recupero dei dati da eliminare' . $e;
			include 'error.html.php';
			exit();
		}

		//ELIMINA L'UTENTE
		try {
			$sql = 'DELETE FROM utenti WHERE id = :id';
			$s = $pdo->prepare($sql);
			$s->bindValue(':id', $_POST['id']);
			$s->execute();
		} catch (PDOExeption $e){
			$error = 'Errore nel recupero dei dati da eliminare' . $e;
			include 'error.html.php';
			exit();
		}

		//ELIMINA I DATI DALLA TB UTENTIRUOLI
		try {
			$sql = 'DELETE FROM utentiruoli WHERE utenteid = :id';
			$s = $pdo->prepare($sql);
			$s->bindValue(':id', $_POST['id']);
			$s->execute();
		} catch (PDOExeption $e){
			$error = 'Errore nell\' eliminazione dei dati in utentiruoli' . $e;
			include 'error.html.php';
			exit();
		}
  		header('Location: .');
  		exit();  		
	}

	//VISUALIZZA GLI UTENTI NELLA PAGINA UTENTI
	try {
		$result = $pdo->query('SELECT id, utente FROM utenti');
	} catch (PDOExeption $e){
		$error = 'Errore nel recupero dei dati da eliminare' . $e;
		include 'error.html.php';
		exit();
	}

	foreach ($result as $row) {
		$utenti[] = array('id'=> $row['id'], 'utente'=>$row['utente']);
	}
	include 'utenti.html.php';


