<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Sistem Informasi Apotek</title>

	<link href="../../../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="../../../css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body style="background-color:white;">
	<!-- #################################################### -->
	<!-- #################################################### -->
	<!-- #################################################### -->
	<table width="100%">
	<tr>
		<td>
			<h2>List Obat</h2>
		</td>
		<td align="right">
		<form action="" method="POST">
			<input type="text" size="10" name="nama_obat" placeholder="Nama Obat" />
			<input type="submit" name="cari" value="Cari" />
		</form>
		</td>
	</tr>
	</table>
	<hr/>
	<br/>
	<?php
		if(isset($_POST['cari']))
		{
	?>
		<table width="100%" border="1" cellspacing="0" cellpadding="0">
		  <tr>
			<td align="center"><strong>ID Obat</strong></td>
			<td align="center"><strong>Nama Obat</strong></td>
			<td align="center"><strong>Aksi</strong></td>
		  </tr>
		  <?php
			include '../../../include/connect.php';
			
			define('MAX_REC_PER_PAGE', 10);
			$rs = mysql_query("SELECT COUNT(*) FROM obat WHERE nama_obat LIKE '%".$_POST['nama_obat']."%' ") or die("Count query error!");
			list($total) = mysql_fetch_row($rs);
			$total_pages = ceil($total / MAX_REC_PER_PAGE);
			$page = intval(@$_GET["page"]);
			
			if (0 == $page){
				$page = 1;
			}
			$start = MAX_REC_PER_PAGE * ($page - 1);
			$max = MAX_REC_PER_PAGE;
			$query = mysql_query("SELECT * FROM obat WHERE nama_obat LIKE '%".$_POST['nama_obat']."%'
								ORDER BY nama_obat ASC LIMIT $start, $max ") or die("Query error!");
			echo "<b>Total Data : ".$total."</b>";
			
			while ($rs = mysql_fetch_array ($query)) {
		  ?>
		  <tr>
			<td><?php echo $rs['id_obat']; ?></td>
			<td>
			  <?php echo $rs['nama_obat']; ?>
			</td>
			<td align="center">
			  <a class="btn btn-default"
			  href="cart.php?act=add&amp;barang_id=<?php echo $rs['id_obat']; ?>&amp;ref=back.php"
			  onclick="closeWin()" role="button">Add to List</a>
			</td>
		  </tr>
		  <?php
			}
		  ?>
		</table>
		
		<table border="0" cellpadding="5" align="center">
			<tr>
				<td>
					<h4>
					<strong>Halaman : </strong>
				<?php
					for ($i = 1; $i <= $total_pages; $i++) {
						$txt=$i;
						if ($page != $i)
							$txt = "<a href=\"" . $_SERVER["PHP_SELF"] . "?contain=view_ticket&page=$i\">$txt</a>";
				?>
					<strong><?= $txt ?></strong>
				
				<?php
					}
				?>
					</h4>
				</td>
			</tr>
		</table>
	<?php
		} else {
	?>
		<table width="100%" border="1" cellspacing="0" cellpadding="0">
		  <tr>
			<td align="center"><strong>ID Obat</strong></td>
			<td align="center"><strong>Nama Obat</strong></td>
			<td align="center"><strong>Aksi</strong></td>
		  </tr>
		  <?php
			include '../../../include/connect.php';
			
			define('MAX_REC_PER_PAGE', 10);
			$rs = mysql_query("SELECT COUNT(*) FROM obat") or die("Count query error!");
			list($total) = mysql_fetch_row($rs);
			$total_pages = ceil($total / MAX_REC_PER_PAGE);
			$page = intval(@$_GET["page"]);
			
			if (0 == $page){
				$page = 1;
			}
			$start = MAX_REC_PER_PAGE * ($page - 1);
			$max = MAX_REC_PER_PAGE;
			$query = mysql_query("SELECT * FROM obat
								ORDER BY nama_obat ASC LIMIT $start, $max ") or die("Query error!");
			echo "<b>Total Data : ".$total."</b>";
		
			while ($rs = mysql_fetch_array ($query)) {
		  ?>
		  <tr>
			<td><?php echo $rs['id_obat']; ?></td>
			<td>
			  <?php echo $rs['nama_obat']; ?>
			</td>
			<td align="center">
			  <a class="btn btn-info"
			  href="cart.php?act=add&amp;barang_id=<?php echo $rs['id_obat']; ?>&amp;ref=back.php"
			  onclick="closeWin()" role="button">Add to List</a>
			</td>
		  </tr>
		  <?php
			}
		  ?>
		</table>
		
		<table border="0" cellpadding="5" align="center">
			<tr>
				<td>
					<h4>
					<strong>Halaman : </strong>
				<?php
					for ($i = 1; $i <= $total_pages; $i++) {
						$txt=$i;
						if ($page != $i)
							$txt = "<a href=\"" . $_SERVER["PHP_SELF"] . "?contain=view_ticket&page=$i\">$txt</a>";
				?>
					<strong><?= $txt ?></strong>
				
				<?php
					}
				?>
					</h4>
				</td>
			</tr>
		</table>
	  <?php
		}
	  ?>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="../../../js/penting.js"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="../../../js/bootstrap.min.js"></script>
  </body>
</html>