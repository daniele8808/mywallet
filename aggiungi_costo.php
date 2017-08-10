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
	<h4>AGGIUNGI SPESA</h4>
	<form action="?aggiungi_costo" method="post">
		<div>
			<label for="id_categoria">A quale categoria apprtiene questa spesa:</label>
			<select name="idcategoria" id="idcategoria">
			<option></option>
			<?php foreach($categorie as $categoria): ?>
				<option value="<?php echo htmlspecialchars($categoria['id'], ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($categoria['categoria'], ENT_QUOTES, 'UTF-8'); ?></option>
			<?php endforeach ?>
			</select>	
			<br>
			<label for="descrizione">Aggiunti la descrizione della spesa</label>
			<input type="text" id="descrizione" name="descrizione"> 
			<br>
			<label for="costo">Aggiungi l'importo della tua spesa</label>
			<input type="number" name="costo" id="costo">
			<br>


			<input type="submit" value="Aggiungi">
		</form>
		<br><br>
		<a href="?">Torna indietro</a>



	</form>
	<?php include $_SERVER['DOCUMENT_ROOT'] . $root . '/includes/footer.inc.php' ?>


</body>
</html>
