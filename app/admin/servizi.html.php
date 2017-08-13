<?php  	$root = '/provePhp/myWallet/app';?>

<!DOCTYPE html>
<html>
<head>
	<title>Review Costi</title>
	<style type="text/css">
		table, th, td { border: 1px solid black; border-collapse: collapse;}
		th, td { padding: 5px; text-align: left;}
		.none{display: none}
		th.a {width:300px;}
		.inline {display: inline-block; margin-right: 20px;}
		.left {float: left;}
		.right {float: right;}
		.clear { clear: both; }
		.margin {margin-right: 30px;}

	</style>		
</head>
<body>

		<h3>SELEZIONA UNA DELLE FUNZIONI:</h3>
		<blockquote>
		<p><a href="costi">Modifica Costi</a></p>
		<p><a href="costi">Modifica Categorie</a></p>
		<p><a href="costi">Modifica utenti</a></p>
		<br><br>
		<span><a href="../">ESCI</a></span>
		</blockquote>


<br><br>



<?php include $_SERVER['DOCUMENT_ROOT'] . $root . '/includes/footer.inc.php' ?>
</body>
</html>