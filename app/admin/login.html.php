<?php  
	$root = '/provePhp/myWallet/app';
	include $_SERVER['DOCUMENT_ROOT'] . $root .'/includes/db.inc.php' ;
	include $_SERVER['DOCUMENT_ROOT'] . $root .'/includes/helpers.inc.php' ; 
?>


<!DOCTYPE html>
<html>
	<head>
		<title>Log In</title>
	</head>
	<body>
		<h1>Log In</h1>	
		<p>Effettuare il login per visualizzare la pagina richiesta</p>
		<?php if (isset($loginError)) : ?>
			<p><?php htmlout($loginError); ?></p>
		<?php endif; ?>

		<form action="" method="post">
			<div>
				<label for="mail">Email:
					<input type="text" name="mail" id="mail">
				</label>
			</div>
			<div>
				<label for="password">Password:
					<input type="password" name="password" id="password">
				</label>
			</div>			
			<div>
				<input type="hidden" name="action" value="login">
				<input type="submit" value="Log In">
			</div>			
		</form>
		<p><a href="/provePhp/mywallet/app/admin">Torna alla Home</a></p>
	</body>
</html>
	