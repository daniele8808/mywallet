<!DOCTYPE html>
<html>
<head>
	<title>Review Costi</title>
	<style type="text/css">
		table, th, td { border: 1px solid black; border-collapse: collapse;}
		th, td { padding: 5px; text-align: left;}
		.none{display: none}
		th.a {width:200px;}*/
		.inline {display: inline-block; margin-right: 20px;}
		span {margin-right: 30px;}
	</style>		
</head>
<body>

<div>
<span><a href="?aggiungi_costo">AGGIUNGI SPESA</a></span>
<span><a href="?aggiungi_categoria">AGGIUNGI CATEGORIA</a></span>
</div>


<p>ECCO LE SPESE DELLA GIORNATA:</p>
<div class="inline">
	<?php foreach ($costi as $costo): ?>

		<table style="width:40%">
		<form action="?cancella_costo" method="POST" >
		<tr>
			<th class="a"><?php echo htmlspecialchars($costo['descrizione'], ENT_QUOTES, 'UTF-8'); ?></th>
			<th class="a"><?php echo htmlspecialchars($costo['costo'], ENT_QUOTES, 'UTF-8'); ?></th>
			<th class="a"><?php echo htmlspecialchars($costo['categoria'], ENT_QUOTES, 'UTF-8'); ?></th>
			<th class="none"><input type="hidden" value="<?php echo $costo['id'] ?>" name="id"></th>
			<th><input type="submit" value="cancella"></th>
			<!-- <th><button name="action" value="update">Modifica</button></th> -->
		</tr>
					
		</form>
		</table>
    <?php endforeach; ?>


</div>

<p>ECCO L'ELENCO DELLE CATEGORIE ESISTENTI:</p>
<div class="inline">
<?php foreach($categorie as $categoria): ?>
	<table style="width:20%">
	<form action="?cancella_categoria" method="post" >
		<tr>
			<th class="a"><?php echo htmlspecialchars($categoria['categoria'], ENT_QUOTES, 'UTF-8'); ?></th>
			<th class="none"><input type="hidden" value="<?php echo $categoria['id'] ?>" name="id"></th>
			<th><input type="submit" value="cancella"></th>
		</tr>
	</form>
	</table>
<?php endforeach; ?>
</div>

</body>
</html>