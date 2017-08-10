<?php  
	$root = '/provePhp/myWallet';
	include $_SERVER['DOCUMENT_ROOT'] . $root .'/includes/db.inc.php' ;

	//MODIFICA COSTO
	if (isset($_GET['modifica_costo'])) {
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

		foreach ($s2 as $row2) {
			$categorie[] = array(
				"categoria"=>$row2['categoria'],
				"id"=>$row2['id']
				);
			}
		//print_r($categorie);
	}

	//SE CLICK SU MODIFICA COSTO
	if (isset($_GET['modifica_costo'])) {
		include 'modifica_costo.html.php';
		exit();
	}
	
	//AGGIORNA COSTO
	if (isset($_GET['aggiorna_costo'])) {
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
	
	//CANCELLA COSTO
	if (isset($_GET['cancella_costo'])) {
		try {
			$sql = 'DELETE FROM costi 
					WHERE id = :id';
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
	if (isset($_GET['cancella_categoria'])) {
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

	// INSERISCE NUOVI COSTI 
	if (isset($_GET['aggiungi_costo'])) {
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


	// INSERISCE NUOVE CATEGORIE
	if (isset($_GET['aggiungi_categoria'])) {
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
			header('Location: ?aggiungi_costo');
			exit();
		}
	}



	//CONTROLLA SE CI SONO DATI NEL DB
	try{
		$sql = 'SELECT COUNT(*) FROM costi';
		$s = $pdo->prepare($sql);
		$s->execute();
	} catch(PDOException $e){
		$error = ' errore nell\'invio del modulo: ' . $e->getMessage();
		include 'error.html.php';
		exit();
	}
	$db_data = $s->fetch();

	// VISUALIZZA COSTI E CATEGORIE
	try {
		$sql = 'SELECT id, categoria 
				FROM categorie';
		$result = $pdo->query($sql);
	} catch (PDOException $e) {
		$error = 'errore nel recupero del dato '. $e->getMessage();
		include 'error.html.php';
		exit();
	}	

	while ($row = $result->fetch()) {
		$categorie[] = array("categoria"=>$row['categoria'], "id"=>$row['id']);
	}

	try {
		$sql = 'SELECT costi.id, costo, descrizione, categoria 
				FROM costi 
				INNER JOIN categorie 
				ON idcategoria = categorie.id; ';
		$result = $pdo->query($sql);
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
			"categoria"=>$row['categoria']
		);
	}
	
	//SE CLICK SU AGGIUNGI COSTO
	if (isset($_GET['aggiungi_costo'])) {
		include 'aggiungi_costo.php';
		exit();
	}


	//SE NON CI SONO/NON CI SONO DATI NEL DB
	if ($db_data[0] != 0) {
		include 'review.html.php';
	} else {
		include 'no_data.html.php';
	}