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


	<h4>AGGIUNGI UTENTE</h4>

	<form action="?aggiungi_utente" method="POST">	
		<label for="utente">Aggiungi un nuovo utente</label>
		<input type="text" id="utente" name="utente"> 
		<br>
		<input type="submit" value="Aggiungi">
	</form>
	<br>
	
	<br><br>
	<a href=".">Torna indietro</a>



	</form>
	<?php include $_SERVER['DOCUMENT_ROOT'] . $root . '/includes/footer.inc.php' ?>


</body>
</html>
