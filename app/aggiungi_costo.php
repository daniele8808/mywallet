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

	<form action="?" method="post">
		<div>
			<!-- <label for="addcost">Aggiungi qui la tua spesa:</label>
			<input id="addcost" name="addcost" rows="4" cols="30"></input> -->
			<label for="descrizione">Aggiunti la descrizione della spesa</label>
			<input type="text" id="descrizione" name="descrizione"> 
			<br>
			<label for="costo">Aggiungi l'importo della tua spesa</label>
			<input type="text" name="costo" id="costo">
			<br>
			<label for="id_categoria">A quale categoria apprtiene questa spesa:</label>
			<select name="idcategoria" id="idcategoria">
			<?php foreach($categorie as $categoria): ?>
				<option value="<?php echo htmlspecialchars($categoria['id'], ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($categoria['categoria'], ENT_QUOTES, 'UTF-8'); ?></option>
			<?php endforeach ?>
			</select>		
			</div>
		<div><input type="submit" value="Aggiungi"></div>
	</form>

</body>
</html>
