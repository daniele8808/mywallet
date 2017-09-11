<?php include $_SERVER['DOCUMENT_ROOT'] . $root .'/includes/helpers.inc.php' ;  ?>

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
	<p>ECCO LE CATEGORIE ESISTENTI:</p>
	<p><a href="?add">Aggiungi categorie</a></p>
		<table style="width:">
			<tr>
				<th class="a">CATEGORIA</th>
			</tr>			
			<?php foreach($categorie as $categoria): ?>		
			<form action="?" method="POST" >
			<tr>
				<th class="c"><?php htmlout($categoria['categoria']); ?></th>
				<th class="none c"><input type="hidden" name="id" value="<?php htmlout($categoria['id']) ?>"></th>
				<th class="c"><input type="submit" name="action" value="modifica"></th>
				<th class="c"><input type="submit" name="action" value="cancella"></th>
			</tr>
			</form>
			<?php  endforeach; ?> 	
		</table>

	<p><a href="..">Torna indietro</a></p>
	
</body>
</html>