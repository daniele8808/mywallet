<?php 
 	include $_SERVER['DOCUMENT_ROOT'] . '/provePhp/myWallet/app' .'/includes/db.inc.php' ;
	include $_SERVER['DOCUMENT_ROOT'] . '/provePhp/myWallet/app' .'/includes/helpers.inc.php' ;
 
 	//Quando elimino un utente, automaticamente elimino anche i costi ad esso associati e la tabella associativa

	if (isset($_GET['add'])) {
	
		$pagetitle = 'Nuovo utente';
		$action = 'addform';
		$utente = '';
		$mail = '';
		$id = '';
		$button = 'Aggiungi utente';

		include 'form.html.php';
		exit();
	}

	if (isset($_GET['addform'])) {
	 	//include $_SERVER['DOCUMENT_ROOT'] . '/provePhp/myWallet/app' .'/includes/db.inc.php' ;
		try {
			$sql = 'INSERT INTO utenti SET
					utente = :utente,
					mail = :mail';
			$s = $pdo->prepare($sql);
			$s->bindValue(':utente', $_POST['utente']);
			$s->bindValue(':mail', $_POST['mail']);
			$s->execute();
		} catch (PDOException $e) {
			$error = 'Errore nel recupero dei dati da eliminare' . $e;
			include 'error.html.php';
			exit();				
		}	
		header('Location: .');
		exit();
	}



	if (isset($_POST['action']) and $_POST['action'] == 'modifica') {

		try {
			$sql = 'SELECT id, utente, mail FROM utenti WHERE id = :id';
			$s = $pdo->prepare($sql);
			$s->bindValue(':id', $_POST['id']);
			$s->execute();			
		} catch (PDOException $e) {
			$error = 'Errore nel recupero dei dati da eliminare' . $e;
			include 'error.html.php';
			exit();					
		}

		$row = $s->fetch();
		
		$pagetitle = 'Modifica utente';
		$action = 'editform';
		$utente = $row['utente'];
		$mail = $row['mail'];
		$id = $row['id'];
		$button = 'Modifica utente';	
		
		include 'form.html.php';
		exit();
	}

	if (isset($_GET['editform'])) {

		try {
			$sql = 'UPDATE utenti 
					SET utente = :utente,
						mail = :mail 
					WHERE id = :id';
			$s = $pdo->prepare($sql);
			$s->bindValue(':id', $_POST['id']);
			$s->bindValue(':utente', $_POST['utente']);
			$s->bindValue(':mail', $_POST['mail']);
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

		////ELIMINA L'UTENTE
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
