<?php 
	//RETURN UN TESTO HTML
	function html($text){ return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');	}

	//ECHO TESTO HTML
	function htmlout($text){ echo html($text);	}

	//VISUALIZZA COSTI --------------------> (DA METTERE A POSTO VAR COSTI SE NON CI SONO COSTI NEL DB)
	function visualizza_costi(){
		global $pdo, $costi;


		try {
			$result = $pdo->query('SELECT costi.id, costo, descrizione, categoria, tempo FROM costi INNER JOIN categorie ON idcategoria = categorie.id;');
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

	//CONTROLLA SE CI SONO DATI NEL DB
	function visualizza_dati(){
		try{
			$result = $GLOBALS['pdo']->query('SELECT COUNT(*) FROM costi');
		} catch(PDOException $e){
			$error = ' errore nell\'invio del modulo: ' . $e->getMessage();
			include 'error.html.php';
			exit();
		}
		$row = $result->fetch();
		return $row[0];	
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

	//MODIFICA COSTO 
	function modifica_costo(){
		global $pdo;
		try {
			$sql = 'SELECT costi.id, costo, descrizione, categoria, idcategoria 
					FROM costi 
					INNER JOIN categorie
					ON idcategoria = categorie.id
					WHERE costi.id = :id';
			$sql2 = 'SELECT id, categoria FROM categorie';
			$s = $pdo->prepare($sql);
			$s2 = $pdo->prepare($sql2);
			$s->bindValue(':id', $_POST['id']);			
			$s->execute();
			$s2->execute();
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
			$idcategoria = $_POST['categoria'];
			$id = $_POST['id'];

			$sql = "UPDATE costi
					SET descrizione = '$descrizione',
						costo = '$costo',
						idcategoria = '$idcategoria',
						id = '$id'
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

		if (isset($_POST['categoria'])) {
			try{
				$sql = 'INSERT INTO categorie SET 
				categoria = :categoria,
				tag = :categoria;
				INSERT INTO costicategorie SET
				idcategoria = last_insert_id()';
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

	// INSERISCE COSTO
	function inserisci_costo(){
		global $pdo;
		if (isset($_POST['descrizione']) && isset($_POST['costo']) && isset($_POST['idcategoria'])) {
			try{
				$sql = 'INSERT INTO costi SET 
				descrizione=  :descrizione,
				costo = :costo,
				idcategoria = :idcategoria,
				tempo= CURDATE()';
				$s = $pdo->prepare($sql);
				$s->bindValue(':descrizione', $_POST['descrizione']);
				$s->bindValue(':costo', $_POST['costo']);
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
