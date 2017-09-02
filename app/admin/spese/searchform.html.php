<?php include $_SERVER['DOCUMENT_ROOT'] . '/provePhp/myWallet/app' .'/includes/db.inc.php' ; ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title>Gestione spese</title>
 </head>
 <body>
 	<h1>Gestione spese</h1>
 	<p><a href="?add">Aggiungi una nuova spesa</a></p>
 	<form action="" method="GET">
 		<p>Visualizza le spese che soddisfano questi creiteri:</p>

 		<div>
 			<label>Per utente:</label>
 			<select name="utente" id="utente">
 				<option value="">Qualsiasi utente</option>
 				<?php foreach($utenti as $utente): ?>
 					<option value="<?php htmlout($utente['id']); ?>"><?php htmlout($utente['utente']); ?></option>
 				<?php endforeach; ?>
 			</select>
 		</div>

 		<div>
 			<label>Per categoria:</label>
 			<select name="categoria" id="categoria">
 				<option value="">Qualsiasi categoria</option>
 				<?php foreach($categorie as $categoria): ?>
 					<option value="<?php htmlout($categoria['id']); ?>"><?php htmlout($categoria['categoria']); ?></option>
 				<?php endforeach; ?>
 			</select>
 		</div>

		<div>
			<label>Contententi il testo:</label>
			<input type="text" name="testo" id="testo">
		</div>
		
 		<div>
 			<input type="hidden" name="action" value="search">
 			<input type="submit" value="cerca">
 		</div>

	<p><a href="..">Torna indietro</a></p>

 	</form>
 </body>
 </html>