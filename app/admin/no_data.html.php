<!DOCTYPE html>
<html>
<head>
	<title>Review Costi</title>
		
</head>
<body>
<?php echo$costi  ?>
<h3>ADMIN PANEL</h3>
<div>
<span class="margin"><a href="?inserisci_costo">INSERISCI COSTO</a></span>
<span class="margin"><a href="?inserisci_categoria">INSERISCI CATEGORIA</a></span>
<span><a href="../">ESCI</a></span>
</div>
<br><br><br><br>

<p>NON CI SONO SPESE REGISTRATE:</p>

<?php include $_SERVER['DOCUMENT_ROOT'] . $root . '/includes/footer.inc.php' ?>
</body>
</html>