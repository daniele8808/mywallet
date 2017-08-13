<?php 	$root = '/provePhp/myWallet/app'; ?> <!-- da rimuovere quando la pagina è ontegrata con le altre-->
<!DOCTYPE html>
<html>
<head>
	<title>Form Add Cost</title>
	<meta charset="utf-8">
	<style type="text/css">
		textarea{display: block; width: 100%}
	</style>
</head>
<body>			


	<h4>AGGIUNGI CATEGORIA</h4>

	<form action="?aggiungi_categoria" method="POST">	
		<label for="categoria">Se occorre aggiungi una nuova categoria</label>
		<input type="text" id="categoria" name="categoria"> 
		<input type="submit" value="Aggiungi">
	</form>
	<br>
	
	<br><br>
	<a href=".">Torna indietro</a>



	</form>
	<?php include $_SERVER['DOCUMENT_ROOT'] . $root . '/includes/footer.inc.php' ?>


</body>
</html>
