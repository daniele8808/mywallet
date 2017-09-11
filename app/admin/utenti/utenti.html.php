<?php include $_SERVER['DOCUMENT_ROOT'] . $root .'/includes/helpers.inc.php' ; ?>

<!DOCTYPE html>
<html>
<head>
	<title>Review Costi</title>
	<style type="text/css">
		table, th, td { border: 1px solid black; border-collapse: collapse;}
		th, td { padding: 5px; text-align: left;}
		.none{display: none}
		th.a {width:300px;}
		th.c {width:60px;}
	</style>		
</head>
<body>
	<!-- GESTIONE UTENTI-->
	<p>ECCO GLI UTENTI ESISTENTI:</p>
	<p><a href="?add">Aggiungi un nuovo utente</a></p>
		<table style="width:">
			<tr>
				<th class="a">UTENTI</th>
			<?php foreach($utenti as $utente): ?>
			<form action="" method="POST">				
			<tr>
				<th class="c"><?php htmlout($utente['utente']); ?></th>
				<th class="none c"><input type="hidden" value="<?php htmlout($utente['id']);?>" name="id"></th>
				<th class="c"><input type="submit" name="action" value="modifica"></th>
				<th class="c"><input type="submit" name="action" value="cancella"></th>
			</tr>
			</form>
			<?php  endforeach; ?> 	
		</table>

	<p><a href="..">Torna indietro</a></p>
</body>
</html>