<!DOCTYPE html>
<html>
<head>
	<title>Review Costi</title>
	<style type="text/css">
		table, th, td { border: 1px solid black; border-collapse: collapse;}
		th, td { padding: 5px; text-align: left;}
		.none{display: none}
		th.a {width:300px;}
		.inline {display: inline-block; margin-right: 20px;}
		.left {float: left;}
		.right {float: right;}
		.clear { clear: both; }
	</style>		
</head>
<body>

<p>ECCO LE SPESE DELLA GIORNATA:</p>
		<table style="width:70%">
		<tr>
			<th class="a">DESCRIZIONE</th>
			<th class="a">COSTO</th>
			<th class="a">CATEGORIA</th>
			<th class="a">DATA</th>
			<th class="a">---</th>
			<th class="a">---</th>
		</tr>
		<tr>
			<?php foreach ($costi as $costo): ?>
			<th class="a"><?php echo htmlspecialchars($costo['descrizione'], ENT_QUOTES, 'UTF-8'); ?></th>
			<th class="a"><?php echo htmlspecialchars($costo['costo'], ENT_QUOTES, 'UTF-8'); ?></th>
			<th class="a"><?php echo htmlspecialchars($costo['categoria'], ENT_QUOTES, 'UTF-8'); ?></th>
			<th class="a"><?php echo htmlspecialchars($costo['tempo'], ENT_QUOTES, 'UTF-8'); ?></th>
			<form action="?cancella_costo" method="POST">
			<th class="none"><input type="hidden" value="<?php echo $costo['id'] ?>" name="id"></th>
			<th><input type="submit" value="cancella"></th>
			</form>
			<form action="?modifica_costo" method="POST">
			<th class="none"><input type="hidden" value="<?php echo $costo['id'] ?>" name="id"></th>
			<th><input type="submit" value="modifica"></th>
			</form>
			<!-- <th><button name="action" value="update">Modifica</button></th> -->
		</tr>
	    <?php endforeach; ?>

		</table>


	<p>ECCO LE CATEGORIE ESISTENTI:</p>
	  <?php  foreach($categorie as $categoria): ?>
		<table style="width:10%">
			<form action="?cancella_categoria" method="post" >
			<tr>
			<th class="a"><?php echo htmlspecialchars($categoria['categoria'], ENT_QUOTES, 'UTF-8'); ?></th>
			<th class="none"><input type="hidden" value="<?php  echo $categoria['id'] ?>" name="id"></th>
			<th><input type="submit" value="cancella"></th>
			</tr>
			</form>
		</table>
	<?php  endforeach; ?> 
<br><br>
<div>
<p><a href="?aggiungi_costo">AGGIUNGI SPESA</a></p>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . $root . '/includes/footer.inc.php' ?>
</body>
</html>