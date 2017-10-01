<?php 
 	//include $_SERVER['DOCUMENT_ROOT'] . $root . '/includes/db.inc.php' ;
 	include $_SERVER['DOCUMENT_ROOT'] . $root . '/includes/helpers.inc.php' ;

 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title><?php htmlout($pagetitle);?></title>
 </head>
 <body>
 	<h1><?php htmlout($pagetitle); ?></h1>
 	<form action="?<?php htmlout($action); ?>" method="POST">
 		<div>
 			<label for="nome">Utente: <input type="text" name="utente" id="utente" value="<?php htmlout($utente); ?>"></label>
 		</div>
 		<div>
 			<label for="mail">Mail: <input type="text" name="mail" id="mail" value="<?php htmlout($mail); ?>"></label>
 		</div>
 		<div>
 			<label for="ruoli">Ruolo:
 				<select name="ruolo" id="ruolo">
 					<option value="">seleziona</option>
 					<?php foreach($ruoli as $ruolo): ?>
 						<option value="<?php echo($ruolo['id']); ?>" <?php if($ruolo['id'] == $ruoloid['ruoloid']) { echo " selected";}?> >
 							<?php echo($ruolo['id']); ?>		
 						</option>
 						<?php endforeach; ?>
 				</select>
 				
 			</label>
 		</div>
 		<div>
 			<label for="password">Password: <input size="35" type="text" name="password" id="password" value="<?php htmlout($password); ?>"></label> 			
 		</div>
 		<br>
 		<div>
 			<input type="hidden" name="id" value="<?php htmlout($id); ?>">
 			<input type="submit" value="<?php htmlout($button); ?>">
 		</div>


 	</form>
 </body>
 </html>