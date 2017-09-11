<?php  
	$root = '/provePhp/myWallet/app';
	include $_SERVER['DOCUMENT_ROOT'] . $root .'/includes/access.inc.php';
	include $_SERVER['DOCUMENT_ROOT'] . $root .'/includes/db.inc.php' ;
	
	if(!userIsLoggedIn()){ 
		include '../login.html.php';
		exit();
	}
	
	if(!userHasRole('amministratore')){ 
		$error = 'Solo gli amministratori possono accedere a quest\'area';
		include '../accessonegato.html.php'; 
		exit();
	}	

	if (isset($_GET['add'])) {
		$pagetitle = 'Nuova Categoria';
		$action = 'addform';
		$categoria = '';
		$id = '';
  		$button = 'Aggiungi Categoria';

		include 'form.html.php';
		exit();
	}

	if (isset($_GET['addform'])) {

		try {
			$sql = 'INSERT INTO categorie 
					SET categoria = :categoria';
			$s = $pdo->prepare($sql);
			$s->bindValue(':categoria', $_POST['categoria']);
			$s->execute();			
		} catch (PDOException $e) {
		    $error = 'Error fetching author details.';
		    include 'error.html.php';
		    exit();				
		}

		header('Location: .');
		exit();
	}

	if (isset($_POST['action']) and $_POST['action'] == 'modifica') {		
		
		try {
			$sql = 'SELECT id, categoria FROM categorie WHERE id = :id';			
			$s = $pdo->prepare($sql);
			$s->bindValue(':id', $_POST['id']);			
			$s->execute();	
		} catch (PDOException $e) {
			$error = 'Errore nel recupero della categoria selezionata';
		    include 'error.html.php';
		    exit();		
		}


		$row = $s->fetch();

		$pagetitle = 'Modifica Categoria';
		$action = 'editform';
		$categoria = $row['categoria'];
		$id = $row['id'];
  		$button = 'Modifica Categoria';

		include 'form.html.php';
		exit();		
	}

	if (isset($_GET['editform'])) {

		try {
			$sql = 'UPDATE categorie SET categoria = :categoria WHERE id = :id';
			$s = $pdo->prepare($sql);
			$s->bindValue(':id', $_POST['id']);
			$s->bindValue(':categoria', $_POST['categoria']);
			$s->execute();						
		} catch (PDOException $e) {
			$error = 'Error fetching author details.' . $e;
		    include 'error.html.php';
		    exit();		
		}
		header('Location: .');
		exit();
	}		

	if (isset($_POST['action']) and $_POST['action'] == 'cancella') {

		//Elimina associazioni dei costi con le categorie
		try {
			$sql = 'DELETE FROM costicategorie WHERE categorieid = :id';
			$s = $pdo->prepare($sql);
		 	$s->bindValue(':id', $_POST['id']);
		 	$s->execute();
		} catch (PDOException $e) {
		 	$error = 'Error fetching author details.';
		 	include 'error.html.php';
		 	exit();		
		}

		//Elimina La categoria
		try {
			$sql = 'DELETE FROM categorie WHERE id = :id';
			$s = $pdo->prepare($sql);
		 	$s->bindValue(':id', $_POST['id']);
		 	$s->execute();
		} catch (PDOException $e) {
		 	$error = 'Error fetching author details.';
		 	include 'error.html.php';
		 	exit();		
		}	
	}

	try {
		 $result = $pdo->query('SELECT id, categoria FROM categorie');
	} catch (PDOException $e) {
	 	$error = 'Error fetching author details.';
	 	include 'error.html.php';
	 	exit();		
	}	

	foreach ($result as $row) {
		$categorie[] = array('id'=>$row['id'], 'categoria'=>$row['categoria']);
	}

	include 'categorie.html.php';
