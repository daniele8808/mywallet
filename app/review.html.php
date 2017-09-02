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
		<?php  
		//echo count($costi);
		//echo '<br>';
		//echo($costi[3]['categoria']) 
		?>
		<p>ECCO LE SPESE DELLA GIORNATA:</p>
		<table style="width:70%">
		<tr>
			<th class="a">ID</th>
			<th class="a">DESCRIZIONE</th>
			<th class="a">COSTO</th>
			<th class="a">IDUTENTE</th>
			<th class="a">DATA</th>
		</tr>
		<?php if (count($spese) != 0): ?>
		<?php // $i = 0; ?>		
		<?php foreach($spese as $spesa): ?>	
		<?php // echo $costo['categoria']?>

		<?php // if($i==10) break; ?>			
		<tr>
			<th class="a"><?php  htmlout($spesa['id']); ?></th>
			<th class="a"><?php  htmlout($spesa['descrizione']); ?></th>
			<th class="a"><?php  htmlout($spesa['costo']); ?></th>
			<th class="a"><?php  htmlout($spesa['idutente']); ?></th>
			<th class="a"><?php  htmlout($spesa['tempo']); ?></th>
		</tr>	
		<?php  //$i++; //echo $i; ?>
		<?php endforeach; ?>
		<?php  else: ?>
			 <tr>
				<td colspan="7">Non ci sono spese</td>
			</tr> 
		<?php endif; ?>

		</table>

<br><br>
<span><a href="admin">GESTISCI SPESE</a></span>


<?php include $_SERVER['DOCUMENT_ROOT'] . $root . '/includes/footer.inc.php' ?>
</body>
</html>