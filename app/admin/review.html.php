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

<span class="margin"><a href="?inserisci_costo">INSERISCI COSTO</a></span>
<span class="margin"><a href="?inserisci_categoria">INSERISCI CATEGORIA</a></span>
<span class="margin"><a href="?inserisci_utente">INSERISCI UTENTE</a></span>
<span><a href="../">ESCI</a></span>
</div>
<br><br><br><br>

<p>ECCO LE SPESE DELLA GIORNATA:</p>
		<table style="width:70%">
		<tr>
			<th class="a">DESCRIZIONE</th>
			<th class="a">COSTO</th>
			<th class="a">CATEGORIA</th>
			<th class="a">UTENTE</th>			
			<th class="a">DATA</th>
			<th class="b">---</th>
			<th class="b">---</th>
		</tr>
		<?php if (count($costi) != 0): ?>
		<?php $i = 0; ?>
		<?php foreach ($costi as $costo): ?>
			<?php if($i==10) break; ?>
			<tr>
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
			<?php $i++; //echo $i; ?>
			
	    <?php endforeach; ?>
		<?php else: ?>
			<tr>
				<td colspan="7">Non ci sono costi</td>
			</tr>
		<?php endif; ?>
		</table>



	<p>ECCO LE CATEGORIE ESISTENTI:</p>
	<?php if (count($categorie) != 0): ?>
	<?php  foreach($categorie as $categoria): ?>
		<table style="width:10%">
			<form action="?cancella_categoria" method="post" >
			<tr>
			<th class="a"><?php htmlout($categoria['categoria']); ?></th>
			<th class="none"><input type="hidden" value="<?php  htmlout($categoria['id']);?>" name="id"></th>
			<th><input type="submit" value="cancella"></th>
			</tr>
			</form>
		</table>
	<?php  endforeach; ?>
	<?php else: ?>
		<p>non ci sono categorie</p>
	<?php endif; ?> 
	<?php  ?>

	<p>ECCO GLI UTENTI ESISTENTI:</p>
	<?php if (count($utenti) != 0): ?>	
	<?php  foreach($utenti as $utente): ?>
		<table style="width:10%">
			<form action="?cancella_utente" method="post" >
			<tr>
			<th class="a"><?php htmlout($utente['utente']); ?></th>
			<th class="none"><input type="hidden" value="<?php  htmlout($utente['id']);?>" name="id"></th>
			<th><input type="submit" value="cancella"></th>
			</tr>
			</form>
		</table>
	<?php  endforeach; ?> 	
	<?php else: ?>
		<p>non ci sono utenti registrati</p>
	<?php endif; ?>



<?php include $_SERVER['DOCUMENT_ROOT'] . $root . '/includes/footer.inc.php' ?>
</body>
</html>