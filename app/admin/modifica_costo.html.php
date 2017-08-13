<?php 	$root = '/provePhp/myWallet/app'; ?>

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
	<!-- <?php  //print_r( $row); ?><br>
	<?php  //print_r( $categorie); ?><br>
	<?php  //print_r( $utenti); ?> -->
	<form action="?aggiorna_costo" method="post">
		<div>
			<label for="utente">Aggiungi l'utente che ha effettuato la spesa</label>
			<select name="idutente" id="idutente">
			<option></option>
			<?php foreach($utenti as $utente): ?>
				<option value="<?php htmlout($utente['id']); ?>"><?php htmlout($utente['utente']); ?></option>
			<?php endforeach ?>
			</select>				
			<br>	
			<label for="categoria">A quale categoria apprtiene questa spesa:</label>
			<select name="categoria" id="categoria">
				<option></option>
				<?php foreach($categorie as $categoria): ?>
				<option value="<?php htmlout($categoria['id']);?>"><?php htmlout($categoria['categoria']); ?></option>
				<?php endforeach ?>
			</select>	
			<br>
			<label for="descrizione">Aggiunti la descrizione della spesa</label>
			<input type="text" id="descrizione" name="descrizione" placeholder="<?php htmlout($row['descrizione']); ?>">
			<br>
			<label for="costo">Aggiungi l'importo della tua spesa</label>
			<input type="number" name="costo" id="costo" placeholder="<?php htmlout($row['costo']); ?>">
			<input type="hidden" value="<?php htmlout($row['id']) ?>" name="id">
			<!-- <input type="hidden" value="<?php // htmlout($categoria['id']) ?>" name="idcategoria"> -->
			<br>
			<input type="submit" value="Aggiorna">
		</form>
		<br><br>
		<a href="?">Torna indietro</a>

	</form>
	<?php include $_SERVER['DOCUMENT_ROOT'] . $root . '/includes/footer.inc.php' ?>


</body>
</html>
