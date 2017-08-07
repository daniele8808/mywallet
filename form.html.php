<!DOCTYPE html>
<html>
<head>
	<title>My Wallet</title>
	<style type="text/css">
		.inline {display: inline-block; width: 40%}
	</style>
</head>
<body>
	<h2>MY WALLET</h2>
	<p>Effettua il login o registrati per accedere:</p>
	
	<div class="inline">
	<h3>LOGIN</h3>
	<form action="login" method="post">
		<div><label for="user">User<input type="text" name="user" id="user"></label></div>
		<div><label for="password">Password<input type="password" name="password" id="password"></label></div>
		<div><input type="submit" name="vai"></div>
		</div>		
	</form>
	</div>


	<div class="inline">
	<h3>REGISTER</h3>
	<form action="register" method="post">
		<div><label for="nome">Nome<input type="text" name="nome" id="nome"></label></div>
		<div><label for="mail">Mail<input type="mail" name="mail" id="mail"></label></div>
		<div><label for="reg_password">Password<input type="text" name="reg_password" id="reg_password"></label></div>
		<div><label for="conf_password">Conferma password<input type="text" name="conf_password" id="conf_password"></label></div>
		<div><input type="submit" name="vai"></div>
		</div>		
	</form>
	</div>


</body>
</html>