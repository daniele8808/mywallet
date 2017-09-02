<?php $costi; $categorie; $utenti;?>
<!DOCTYPE html>
<html>
<head>
	<title>Review Costi</title>
	<style type="text/css">
		table, th, td { border: 1px solid black; border-collapse: collapse;}
		th, td { padding: 5px; text-align: left;}
		.none{display: none}
		th.a {width:300px;}
		th.b {width:50px;}
		th.c {width:60px;}
		.inline {display: inline-block; margin-right: 20px;}
		.left {float: left;}
		.right {float: right;}
		.clear { clear: both; }
		.margin {margin-right: 30px;}
	</style>		
</head>
<body>
<h3>ADMIN PANEL</h3>
<?php // echo $_POST['idcategoria'] ?>
<div>

<span class="margin"><a href="spese">GESTISCI SPESE</a></span>
<span class="margin"><a href="categorie">GESTISCI CATEGORIA</a></span>
<span class="margin"><a href="utenti">GESTISCI UTENTI</a></span>
<span><a href="../">ESCI</a></span>
</div>
<br><br><br><br>

<p>ECCO LE SPESE DELLA GIORNATA:</p>
		<table style="width:70%">
		<tr>
			<th class="a">ID</th>
			<th class="a">DESCRIZIONE</th>
			<th class="a">COSTO</th>
			<th class="a">CATEGORIA</th>
			<th class="a">UTENTE</th>			
			<th class="a">DATA</th>
			<th class="b">---</th>
			<th class="b">---</th>
		</tr>
		<?php foreach ($costi as $costo): ?>
			<tr>

				<th class="a"><?php  htmlout($costo['id']); ?></th>
				<th class="a"><?php  htmlout($costo['descrizione']); ?></th>
				<th class="a"><?php  htmlout($costo['costo']); ?></th>
				<th class="a"><?php  htmlout($costo['categoria']); ?></th>
				<th class="a"><?php  htmlout($costo['utente']); ?></th>
				<th class="a"><?php  htmlout($costo['tempo']); ?></th>
				<form action="?cancella_costo" method="POST">
				<th class="none"><input type="hidden" value="<?php htmlout($costo['id']); ?>" name="id"></th>
				<th><input type="submit" value="cancella"></th>
				</form>
				<form action="?modifica_costo" method="POST">
				<th class="none"><input type="hidden" value="<?php htmlout($costo['id']); ?>" name="id"></th>
				<th><input type="submit" value="modifica"></th>
				</form>
			</tr>				
			
	    <?php endforeach; ?>

		</table>




<?php include $_SERVER['DOCUMENT_ROOT'] . $root . '/includes/footer.inc.php' ?>
</body>
</html>