<?php  
	// è molto impo che il tag php cominci dalla prima riga, altrimenti il redirect alla home dopo aver aggiunto o rimosso una voce non funziona -> header('Location: .'); 
	try {
		$pdo = NEW PDO('mysql:host=localhost; dbname=mywallet2', 'root', 'root'); 
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    $pdo->exec('SET NAMES "utf8"');
	} catch (PDOException $e) {
		$output = 'Impossibile connettersi al server db. - '. $e->getMessage();
		include 'output.html.php';
		exit();
	}	


	//$output = 'Connessione al database stabilita';
	//include 'output.html.php';

	/* creazione di una tabella	
		try {
			$sql = 'CREATE TABLE mywallet (
					id  INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
					mwdescription TEXT,
					mwdate DATE NOT NULL
					) DEFAULT CHARACTER SET utf8 ENGINE=InnoDB';
			$pdo->exec($sql);
			
		} catch (PDOException $e) {
			$output = 'Errore nella creazione della tabella '. $e->getMessage();
			include 'output.html.php';
			exit();
		}
		$output = 'Tabella creata correttamente';
		include 'output.html.php';


		CREATE TABLE categorie (
	    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	    categoria varchar(255),
	    tag varchar(255)
	    ) DEFAULT CHARACTER SET utf8 ENGINE=INNODB

	*/
	

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
		$sql = 'DELETE FROM categorie WHERE id = :id';
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



	// INSERISCE NEI DB NUOVI COSTI E CATEGORIE
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

	if (isset($_POST['categoria'])) {
		try{
			$sql = 'INSERT INTO categorie SET 
			categoria = :categoria,
			tag = :categoria';
			$s = $pdo->prepare($sql);
			$s->bindValue(':categoria', $_POST['categoria']);
			$s->execute();
		} catch(PDOException $e){
			$error = ' errore nell\'invio del modulo: ' . $e->getMessage();
			include 'error.html.php';
			exit();
		}
		header('Location: .');
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
		$sql = 'SELECT costi.id, costo, descrizione, categoria FROM costi INNER JOIN categorie ON idcategoria = categorie.id';
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
	
	if (isset($_GET['aggiungi_categoria'])){
		include 'aggiungi_categoria.php';
		exit();
	}

	include 'review.html.php';
