<?php 
 	include $_SERVER['DOCUMENT_ROOT'] . '/provePhp/myWallet/app' .'/includes/db.inc.php' ;
 	include $_SERVER['DOCUMENT_ROOT'] . '/provePhp/myWallet/app' .'/includes/helpers.inc.php' ;
 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title><?php htmlout($pagetitle)?></title>
 </head>
 <body>
 	<h1><?php htmlout($pagetitle); ?></h1>
 	<form action="?<?php htmlout($action); ?>" method="POST">
 		<div>
 			<label for="categoria">Categoria: <input type="text" name="categoria" id="categoria" value="<?php htmlout($categoria); ?>"></label>
 		</div>
 		<div>
 			<input type="hidden" name="id" value="<?php htmlout($id); ?>">
 			<input type="submit" value="<?php htmlout($button); ?>">
 		</div>
 	</form>
 </body>
 </html>