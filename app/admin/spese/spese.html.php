<?php include $_SERVER['DOCUMENT_ROOT'] . $root .'/includes/helpers.inc.php' ;  ?>

<!DOCTYPE html>
<html>
<head>
	<title>Gestione Spese: Risultati di ricerca</title>
	<style type="text/css">
		table, th, td { border: 1px solid black; border-collapse: collapse;}
		th, td { padding: 5px; text-align: left;}
		.none{display: none}
		th.a {width:300px;}
		th.c {width:10px;}
		.inline {display: inline-block; margin-right: 20px;}
		.left {float: left;}
		.right {float: right;}
		.clear { clear: both; }
		.margin {margin-right: 30px;}
	</style>		
</head>
<body>
	<p>GESTIONE SPESE: RISULTATI DI RICERCA</p>
	<br>
		<table style="width:70%">
			<tr>
				<th class="a">ID</th> 
				<th class="a">DESCRIZIONE</th>
				<th class="a">COSTO</th>
				<th class="a">IDUTENTE</th>
				<th class="a">DATA</th>
			</tr>
			<?php foreach($spese as $spesa): ?>
			<form action="?" method="post" >
			<tr>
				<th class="c"><?php htmlout($spesa['id']); ?></th>
				<th class="c"><?php htmlout($spesa['descrizione']); ?></th>
				<th class="c"><?php htmlout($spesa['costo']); ?></th>
				<th class="c"><?php htmlout($spesa['idutente']); ?></th>
				<th class="c"><?php htmlout($spesa['tempo']); ?></th>
				<th class="none c"><input type="hidden" name="id" value="<?php htmlout($spesa['id']);?>"></th>
				<th class="c"><input type="submit" name="action" value="modifica"></th>				
				<th class="c"><input type="submit" name="action" value="cancella"></th>		
			</tr>
			</form>
			<?php  endforeach; ?> 	
		</table>
			
	
	<p><a href="?">Nuova Ricerca</a></p>
	<p><a href="..">Torna indietro</a></p>
	
</body>
</html>