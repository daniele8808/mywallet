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
		<h2>MY WALLET APP</h2>
		<br>
		<p>ECCO LE SPESE DELLA GIORNATA:</p>
		<table style="width:70%">
		<tr>
			<th class="a">DESCRIZIONE</th>
			<th class="a">COSTO</th>
			<th class="a">CATEGORIA</th>
			<th class="a">DATA</th>
		</tr>
		<?php foreach ($costi as $costo): ?>
		<tr>
			<th class="a"><?php  htmlout($costo['descrizione']); ?></th>
			<th class="a"><?php  htmlout($costo['costo']); ?></th>
			<th class="a"><?php  htmlout($costo['categoria']); ?></th>
			<th class="a"><?php  htmlout($costo['tempo']); ?></th>
		</tr>	
		<?php endforeach; ?>

		</table>

<br><br>
<span><a href="admin">GESTISCI SPESE</a></span>


<?php include $_SERVER['DOCUMENT_ROOT'] . $root . '/includes/footer.inc.php' ?>
</body>
</html>