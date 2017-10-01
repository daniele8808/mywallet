<!DOCTYPE html>
<html>
<head>
	<title>Admin Panel</title>
	<style type="text/css">
		table, th, td { border: 1px solid black; border-collapse: collapse;}
		th, td { padding: 5px; text-align: left;}
		.none{display: none}
		th.a {width:300px;}
		th.c {width:10px;}
		.inline {display: inline-block; margin-right: 20px;}
		.left {float: left;}
		.right {float: right;}
		.clear { clear: both; }
		.margin {margin-right: 30px;}
	</style>	
</head>
<body>
<h3>ADMIN PANEL</h3>

<?php if(isset($_SESSION['mail'])): ?>
	<?php echo "Ciao ". $_SESSION['mail']; ?>
<?php endif ?>

<div>
	<p><a href="spese">GESTISCI SPESE</a></p>
	<p><a href="categorie">GESTISCI CATEGORIA</a></p>
	<p><a href="utenti">GESTISCI UTENTI</a></p>
	<span><a href="../">ESCI</a></span>
	<br><br>
</div>


	<!-- 
	<p>GESTIONE SPESE: RISULTATI DI RICERCA</p>
	<br>
		<table style="width:70%">
			<tr>
				<th class="a">ID</th> 
				<th class="a">DESCRIZIONE</th>
				<th class="a">COSTO</th>
				<th class="a">IDUTENTE</th>
				<th class="a">DATA</th>
			</tr>
			<?php foreach($spese as $spesa): ?>	
			<form action="?" method="post" >
			<tr>
				<th class="c"><?php htmlout($spesa['id']); ?></th>
				<th class="c"><?php htmlout($spesa['descrizione']); ?></th>
				<th class="c"><?php htmlout($spesa['costo']); ?></th>
				<th class="c"><?php htmlout($spesa['idutente']); ?></th>
				<th class="c"><?php htmlout($spesa['tempo']); ?></th>
				<th class="none c"><input type="hidden" name="id" value="<?php htmlout($spesa['id']);?>"></th>		
			</tr>
			</form>
			<?php  endforeach; ?> 	
		</table>
 		-->
 		<?php include $_SERVER['DOCUMENT_ROOT'] . $root . '/includes/footer.inc.php';
			//include 'logout.html.php';
 		?>
 	
</body>
</html>