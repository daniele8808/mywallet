<?php 
	//RETURN UN TESTO HTML
	function html($text){ return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');	}

	//ECHO TESTO HTML
	function htmlout($text){ echo html($text);	}

	//VISUALIZZA COSTI 
	function visualizza_costi(){
		global $pdo, $costi;


		try {
			$result = $pdo->query('
				SELECT costi.id, costo, descrizione, categoria, tempo, utente
				FROM costi 
				INNER JOIN costicategorie 
				ON costi.id = costiid 
				INNER JOIN categorie 
				ON categorieid = categorie.id 
				INNER JOIN utenti 
				ON costi.idutente = utenti.id
				WHERE TRUE');
		} catch (PDOException $e) {
			$error = 'errore nel recupero del dato '. $e->getMessage();
			include 'error.html.php';
			exit();
		}	
		
		//PER RECUPERARE LE RIGHE DEL RESULT SET POSSIAMO USARE ENTRAMBI I CICLI WHILE E FOREACH -> DI SEGUITO I DUE ESEMPI
		//WILE
		//while ($row = $result->fetch()) {
			//$spese[] = $row['mwdescription'];
			//$costi[] = array("descrizione"=>$row['descrizione'], "costo"=>$row['costo'], "categoria"=>$row['categoria'], "id"=>$row['id']);
		//}
		
		//FOREACH
		foreach ($result as $row) {
			$costi[] = array(
				"id"=>$row['id'],
				"costo"=>$row['costo'],
				"descrizione"=>$row['descrizione'],
				"categoria"=>$row['categoria'],
				"utente"=>$row['utente'],
				"tempo"=>$row['tempo']
			);
		}

		return($costi);
	}

	// VISUALIZZA CATEGORIE
	function visualizza_categorie(){
		global $pdo, $categorie;

		try {
			$sql = 'SELECT id, categoria FROM categorie';
			$result = $pdo->query($sql);
		} catch (PDOException $e) {
			$error = 'errore nel recupero del dato '. $e->getMessage();
			include 'error.html.php';
			exit();
		}	

		while ($row = $result->fetch()) {
			$categorie[] = array("categoria"=>$row['categoria'], "id"=>$row['id']);
		}		
		return $categorie;
	}

	// VISUALIZZA UTENTI
	function visualizza_utenti(){
		global $pdo, $utenti;

		try {
			$sql = 'SELECT id, utente FROM utenti';
			$result = $pdo->query($sql);
		} catch (PDOException $e) {
			$error = 'errore nel recupero del dato '. $e->getMessage();
			include 'error.html.php';
			exit();
		}	

		while ($row = $result->fetch()) {
			$utenti[] = array("id"=>$row['id'], "utente"=>$row['utente']);
		}		
		return $utenti;
	}

	//CANCELLA COSTO
	function cancella_costo(){
		global $pdo;
		try {
			$sql = 'DELETE FROM costi WHERE id = :id';
			$s = $pdo->prepare($sql);
			$s->bindValue(':id', $_POST['id']);
			$s->execute();
		} catch (PDOException $e) {
			$error = "impossibile eliminare la spesa" . $e->getMessage();
			include '$error.html.php';
			exit();			
			}
			header('Location: .');
			exit();
	}

	//CANCELLA CATEGORIA
	function cancella_categoria(){
		global $pdo;
		try {
			$sql = 'DELETE categorie, costi 
				FROM categorie, costi
				WHERE categorie.id = costi.idcategoria 
				AND categorie.id = :id;
				DELETE FROM categorie 
				WHERE id = :id';
			$s = $pdo->prepare($sql);
			$s->bindValue(':id', $_POST['id']);
			$s->execute();
		} catch (PDOException $e) {
			$error = "impossibile eliminare la spesa" . $e->getMessage();
			include 'error.html.php';
			exit();			
		}
		header('Location: .');
		exit();
	}

	//CANCELLA UTENTE
	function cancella_utente(){
		global $pdo;
		try {
			$sql = 'DELETE utenti, costi 
				FROM utenti, costi 
				WHERE utenti.id = costi.idutente
				AND utenti.id = :id;
				DELETE FROM utent
				WHERE id = :id';
			$s = $pdo->prepare($sql);
			$s->bindValue(':id', $_POST['id']);
			$s->execute();
		} catch (PDOException $e) {
			$error = "impossibile eliminare la spesa" . $e->getMessage();
			include 'error.html.php';
			exit();			
		}
		header('Location: .');
		exit();
	}

	//MODIFICA COSTO 
	function modifica_costo(){
		global $pdo;
		try {
			$sql = 'SELECT costi.id, costo, descrizione, categoria, idcategoria, idutente
					FROM costi 
					INNER JOIN categorie
					ON idcategoria = categorie.id
					INNER JOIN utenti
					ON idutente = utenti.id
					WHERE costi.id = :id';
			$sql2 = 'SELECT id, categoria FROM categorie';
			$sql3 = 'SELECT id, utente FROM utenti';
			$s = $pdo->prepare($sql);
			$s2 = $pdo->prepare($sql2);
			$s3 = $pdo->prepare($sql3);
			$s->bindValue(':id', $_POST['id']);			
			$s->execute();
			$s2->execute();
			$s3->execute();
		} catch (Exception $e) {
			$error = 'errore nel recupero del dato '. $e->getMessage();
			include 'error.html.php';
			exit();				
		}
		
		$row = $s->fetch();
		//print_r($row) ;

		foreach ($s2 as $row2) {
			$categorie[] = array(
				"categoria"=>$row2['categoria'],
				"id"=>$row2['id']
				);
			}
		foreach ($s3 as $row3) {
			$utenti[] = array(
				"utente"=>$row3['utente'],
				"id"=>$row3['id']
				);
			}			
		//return $row;
		include 'modifica_costo.html.php'; 
		exit();
	}
	
	//AGGIORNA COSTO 
	function aggiorna_costo(){
		global $pdo;
		
		//print_r($_POST);		
		try {
			$descrizione = $_POST['descrizione'];
			$costo = $_POST['costo'];
			$idutente = $_POST['idutente'];
			$idcategoria = $_POST['categoria'];
			$id = $_POST['id'];

			$sql = "UPDATE costi
					SET descrizione = '$descrizione',
						costo = '$costo',
						idcategoria = '$idcategoria',
						idutente = '$idutente'
					WHERE id = '$id'";
			//$sql2 = 'SELECT categoria FROM categorie';
			$s = $pdo->prepare($sql);
			//$s2 = $pdo->prepare($sql2);
			$s->execute();
			//$s2->execute();
		} catch (Exception $e) {
			$error = 'errore nel recupero del dato '. $e->getMessage();
			include 'error.html.php';
			exit();	
		}	
		//echo "aggiornamento eseguito";	
		header('Location: .');		
	}

	// INSERISCE NUOVE CATEGORIE
	function inserisci_categoria(){
		global $pdo;
		//print_r( $_POST);

		if (isset($_POST['categoria']) && isset($_POST['tag'])) {
			try{
				$sql = 'INSERT INTO categorie SET 
				categoria = :categoria,
				tag = :categoria;';
				$s = $pdo->prepare($sql);
				$s->bindValue(':categoria', $_POST['categoria']);
				$s->execute();
			} catch(PDOException $e){
				$error = ' errore nell\'invio del modulo: ' . $e->getMessage();
				include 'error.html.php';
				exit();
			}
			header('Location: .');		
			//exit();
		}		
	}

	// INSERISCE NUOVI UTENTI
	function inserisci_utente(){
		global $pdo;
		//print_r( $_POST);

		if (isset($_POST['utente'])) {
			try{
				$sql = 'INSERT INTO utenti SET 
				utente = :utente';
				$s = $pdo->prepare($sql);
				$s->bindValue(':utente', $_POST['utente']);
				$s->execute();
			} catch(PDOException $e){
				$error = ' errore nell\'invio del modulo: ' . $e->getMessage();
				include 'error.html.php';
				exit();
			}
			header('Location: .');		
			//exit();
		}		
	}	

	// INSERISCE COSTO
	function inserisci_costo(){
		global $pdo;
		if (isset($_POST['descrizione']) && isset($_POST['costo']) && isset($_POST['idcategoria']) && isset($_POST['idutente'])) {
			try{
				$sql = 'INSERT INTO costi SET 
				descrizione=  :descrizione,
				costo = :costo,
				idcategoria = :idcategoria,
				idutente = :idutente,
				tempo = CURRENT_TIMESTAMP()';
				$s = $pdo->prepare($sql);
				$s->bindValue(':descrizione', $_POST['descrizione']);
				$s->bindValue(':costo', $_POST['costo']);
				$s->bindValue(':idutente', $_POST['idutente']);
				$s->bindValue(':idcategoria', $_POST['idcategoria']);
				$s->execute();
			} catch(PDOException $e){
				$error = ' errore nell\'invio del modulo: ' . $e->getMessage();
				include 'error.html.php';
				exit();
			}
			header('Location: .');
			exit();
		} 		
	}
