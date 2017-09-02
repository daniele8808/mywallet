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
		.inline {display: inline-block; margin-right: 20px;}
		.left {float: left;}
		.right {float: right;}
		.clear { clear: both; }
		.margin {margin-right: 30px;}
	</style>		
</head>
<body>
	<!-- GESTIONE UTENTI-->
	<p>ECCO GLI UTENTI ESISTENTI:</p>
	<p><a href="?add">Aggiungi un nuovo utente</a></p>
		<table style="width:">
			<form action="" method="POST">
			<tr>
				<th class="a">UTENTI</th>
			<?php foreach($utenti as $utente): ?>
			<tr>
				<th class="c"><?php htmlout($utente['utente']); ?></th>
				<th class="none c"><input type="hidden" value="<?php htmlout($utente['id']);?>" name="id"></th>
				<th class="c"><input type="submit" name="action" value="modifica"></th>
				<th class="c"><input type="submit" name="action" value="cancella"></th>
			</tr>
			<?php  endforeach; ?> 	
			</form>
		</table>

	<p><a href="..">Torna indietro</a></p>
</body>
</html>