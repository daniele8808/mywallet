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
	
	<h4>MODIFICA COSTO</h4>
	<form action="?aggiorna_costo" method="post">
		<div>
			<label for="categoria">A quale categoria apprtiene questa spesa:</label>
			<select name="categoria" id="categoria">
				<option></option>
				<?php foreach($categorie as $categoria): ?>
				<option value="<?php echo htmlspecialchars($categoria['id'], ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($categoria['categoria'], ENT_QUOTES, 'UTF-8'); ?></option>
				<?php endforeach ?>
			</select>	
			<br>
			<label for="descrizione">Aggiunti la descrizione della spesa</label>
			<input type="text" id="descrizione" name="descrizione" placeholder="<?php echo htmlspecialchars($row['descrizione'], ENT_QUOTES, 'UTF-8'); ?>">
			<br>
			<label for="costo">Aggiungi l'importo della tua spesa</label>
			<input type="number" name="costo" id="costo" placeholder="<?php echo htmlspecialchars($row['costo'], ENT_QUOTES, 'UTF-8'); ?>">
			<input type="hidden" value="<?php echo $row['id'] ?>" name="id">
			<input type="hidden" value="<?php echo $row['idcategoria'] ?>" name="idcategoria">
			<br>
			<input type="submit" value="Aggiorna">
		</form>
		<br><br>
		<a href="?">Torna indietro</a>

	</form>
	<?php include $_SERVER['DOCUMENT_ROOT'] . $root . '/includes/footer.inc.php' ?>


</body>
</html>
