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
 			<input type="hidden" name="id" value="<?php htmlout($id); ?>">
 			<input type="submit" value="<?php htmlout($button); ?>">
 		</div>


 	</form>
 </body>
 </html>