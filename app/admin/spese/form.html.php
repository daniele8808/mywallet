<?php 
 	include $_SERVER['DOCUMENT_ROOT'] . '/provePhp/myWallet/app' .'/includes/db.inc.php' ;
 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title><?php htmlout($pagetitle)?></title>
 </head>
 <body>
 	<h1><?php htmlout($pagetitle); ?></h1>
 	<form action="?<?php htmlout($action); ?>" method="POST">

		<?php // echo $_POST['id']; ?>
 		<p><?php //echo $id; ?></p>
 		<p><?php //print_r($row); ?></p>
 		<p><?php //print_r($utenti); ?></p>
 		<p><?php // print_r($categorie); ?></p>
 		
 		<div>
 			<label for="descrizione">Descrizione:</label>
 			<textarea type="text" id="descrizione" name="descrizione" rows="3" cols="327"><?php htmlout($descrizione) ?></textarea>
 		</div>
 		<div>
 			<label for="costo">Costo:
 			<input type="costo" id="costo" name="costo" value="<?php htmlout($costo); ?>"></label>
 		</div> 		
 		<div>
 			<label for="utente">Utente:</label>
 			<select name="utente" id="utente">
 				<option value="">Seleziona</option>
 				<?php foreach ($utenti as $utente): ?>
 					<option value="<?php htmlout($utente['id'])?>" <?php if ($utente['id'] == $idutente) { echo " selected"; } ?>><?php htmlout($utente['utente']) ?></option>
 				<?php endforeach; ?>
 			</select>
 		</div>
 		<div>
 			<fieldset>
 				<legend>Categoria:</legend>
 				<?php foreach ($categorie as $categoria): ?>
 				<div>
					<label for="categoria<?php htmlout($categoria['id']);?>">
					<input type="checkbox" name="categorie[]" id="categoria<?php htmlout($categoria['id']);?>" 
					value="<?php htmlout($categoria['id']);?>" <?php if ($categoria['selected']) { echo ' checked'; } ?>>
						<?php htmlout($categoria['categoria']); ?>
 					</label> 	
 				</div>
				<?php endforeach; ?>
 			</fieldset>
 		</div> 		
      	<br> 		
 		<div>
 			<input type="hidden" name="id" value="<?php htmlout($id); ?>">
 			<input type="submit" value="<?php htmlout($button); ?>">
 		</div>
 	</form>
 </body>
 </html>