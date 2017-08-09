<?php  
	// è molto impo che il tag php cominci dalla prima riga, altrimenti il redirect alla home dopo aver aggiunto o rimosso una voce non funziona -> header('Location: .'); 
	try {
		$pdo = NEW PDO('mysql:host=localhost; dbname=mywallet', 'root', 'root'); 
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    $pdo->exec('SET NAMES "utf8"');
	} catch (PDOException $e) {
		$output = 'Impossibile connettersi al server db. - '. $e->getMessage();
		include 'output.html.php';
		exit();
	}	

	//CANCELLA COSTI E CATEGORIE
	if (isset($_GET['cancella_costo'])) {
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

	
	if (isset($_GET['cancella_categoria'])) 
	{
	try {
		//$sql = 'DELETE FROM categorie WHERE id = :id; DELETE FROM costi WHERE id = idcategoria';
		$sql = 'DELETE categorie, costi FROM categorie, costi WHERE categorie.id = costi.idcategoria AND categorie.id = :id';
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


	// INSERISCE NEI DB NUOVI COSTI 
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
	
	// INSERISCE NEI DB NUOVE CATEGORIE
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
	

	// VISUALIZZA COSTI E CATEGORIE
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

	try {
		$sql = 'SELECT costi.id, costo, descrizione, categoria FROM costi INNER JOIN categorie ON idcategoria = categorie.id; ';
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

	if (isset($_GET['aggiungi_costo'])) {
		include 'aggiungi_costo.php';
		exit();
	}
	
	include 'review.html.php';
