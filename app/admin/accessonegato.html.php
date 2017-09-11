<!DOCTYPE html>
<html>
<head>
	<title>Accesso Negato</title>
</head>
<body>
	<h1>Accesso Negato</h1>
	<p><?php echo $error; ?></p>
	<p><a href="/provePhp/mywallet/app/admin">Torna alla Home</a></p>
	<form action="" method="POST">
	  <div>
	    <input type="hidden" name="action" value="logout">
	    <input type="hidden" name="goto" value="/provePhp/mywallet/app/admin/">
	    <input type="submit" value="Log out">
	  </div>
	</form>
</body>
</html>