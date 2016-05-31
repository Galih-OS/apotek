<h2 style="margin-left:20px;">Laporan</h2>

<div class="panel panel-default">
  <div class="panel-body">
	<ul class="nav nav-tabs">
	  <li role="presentation" class="active"><a href="index.php?contain=laporan_pemesanan">Pemesanan</a></li>
	  <li role="presentation"><a href="index.php?contain=laporan_pembelian">Pembelian</a></li>
	  <li role="presentation"><a href="index.php?contain=laporan_penjualan">Penjualan</a></li>
	</ul>
	
	<br/>

<?php
if(isset($_POST['edit']))
{
	include "atribut/edit_obat.php";
} else if (isset($_POST['detail'])){
	include "atribut/detail_pemesanan.php";
} else if (isset($_POST['cari'])){
	
	include "../include/connect.php";
	$bulan = $_POST['pencarian'];
	$mydate = strtotime($bulan);
?>
	<form class="form-horizontal" action="" method="POST">
	  <div class="form-group">
		<div class="col-sm-8 col-md-6 col-xs-8">
			<div class="input-group">
				<div class="input-group-addon">
					Lihat data pada : 
				</div>
				<input type="month" class="form-control input-lg" name="pencarian" placeholder="Pencarian Nama Obat" autofocus>
			</div>
		</div>
		<div class="col-sm-4 col-md-4 col-xs-4" style="margin-left:-10px; margin-bottom:10px;" align="left">
			<button type="submit" name="cari" class="btn btn-primary btn-lg">Cari</button>
			<button type="submit" name="refresh" class="btn btn-default btn-lg">Refresh</button>
		</div>
	</form>
	<form class="form-horizontal" action="contain/atribut/cetak_pemesanan.php" method="POST">
		<div class="col-sm-12 col-md-2 col-xs-12" style="margin-top:0px;" align="right">
			<button type="submit" name="cetak" class="btn btn-success btn-lg btn-block">Cetak</button>
			<input type="text" hidden name="data_bulan" value="<?php echo date('Y-F', $mydate); ?>">
		</div>
	  </div>
	</form>
	
	<div class="panel panel-default">
	  <div class="panel-heading">
		<h3 class="panel-title" align="center">Laporan Pemesanan Bulan <?php echo date('F Y', $mydate); ?></h3>
	  </div>
	  <div class="panel-body">
	  
<?php	
	define('MAX_REC_PER_PAGE', 10);
	$rs = mysql_query("SELECT COUNT(*) FROM pemesanan
						WHERE MONTH(pemesanan.tanggal) = substr('".$bulan."', -1, 2) ") or die("Count query error!");
	list($total) = mysql_fetch_row($rs);
	$total_pages = ceil($total / MAX_REC_PER_PAGE);
	$page = intval(@$_GET["page"]);
	
	if (0 == $page){
		$page = 1;
	}
	$start = MAX_REC_PER_PAGE * ($page - 1);
	$max = MAX_REC_PER_PAGE;
	
	$rs = mysql_query("SELECT * FROM pemesanan
						JOIN pengguna ON pemesanan.id_pengguna = pengguna.id_pengguna
						JOIN supplier ON pemesanan.id_supplier = supplier.id_supplier
						WHERE MONTH(pemesanan.tanggal) = substr('".$bulan."', -1, 2)
						ORDER BY pemesanan.tanggal ASC
						LIMIT $start, $max ") or die("Query error!");
	echo "<b>Total Data : ".$total."</b>";
?>	
	<table border="1" width="95%" align="center" class="table">
		<thead>
			<td class="success" style="text-align:center;">NO.</td>
			<td class="success" style="text-align:center;">ID PEMESANAN</td>
			<td class="success" style="text-align:center;">TANGGAL PEMESANAAN</td>
			<td class="success" style="text-align:center;">NAMA SUPPLIER</td>
			<td class="success" style="text-align:center;">JUMLAH</td>
			<td class="success" style="text-align:center;">DI ORDER OLEH</td>
			<td class="success" style="text-align:center;">STATUS</td>
			<td class="success" style="text-align:center;">ACTION</td>
		</thead>
		<?php
			$no = 1;
			while ($list = mysql_fetch_assoc($rs)) {
		?>
		<tr>
			<form action="" method="POST">
			<td align="center"><?php echo $no;?></td>
			<td align="center">
				<?php echo $list['id_pemesanan']; ?>
				<input hidden name='id_pemesanan' value="<?php echo $list['id_pemesanan']?>">
			</td>
			<td align="center">
				<?php echo $list['tanggal']; ?>
				<input hidden name='tanggal' value="<?php echo $list['tanggal']?>">
			</td>
			<td align="center">
				<?php echo $list['nama_supplier']; ?>
				<input hidden name='nama_supplier' value="<?php echo $list['nama_supplier']?>">
			</td>
			<td align="center">
				<?php echo $list['jumlah']; ?>
				<input hidden name='jumlah' value="<?php echo $list['jumlah']?>">
			</td>
			<td align="center">
				<?php echo $list['nama_pengguna']; ?>
				<input hidden name='id_pengguna' value="<?php echo $list['id_pengguna']?>">
				<input hidden name='nama_pengguna' value="<?php echo $list['nama_pengguna']?>">
			</td>
			<td align="center">
				<?php echo $list['status_pemesanan']; ?>
				<input hidden name='jumlah' value="<?php echo $list['status_pemesanan']?>">
			</td>
			<td align="center">
				<input class="btn btn-default btn-xs" type="submit" name="detail" value="View Detail">
			</td>
			</form>
		</tr>
		<?php
			$no +=1;
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
						$txt = "<a href=\"" . $_SERVER["PHP_SELF"] . "?contain=laporan_pemesanan&page=$i\">$txt</a>";
			?>
				<strong><?= $txt ?></strong>
			
			<?php
				}
			?>
				</h4>
			</td>
		</tr>
	</table>

	  </div>
	</div>	
	
<?php
} else {
?>	
	<form class="form-horizontal" action="" method="POST">
	  <div class="form-group">
		<div class="col-sm-8 col-md-6 col-xs-8">
			<div class="input-group">
				<div class="input-group-addon">
					Lihat data pada : 
				</div>
				<input type="month" class="form-control input-lg" name="pencarian" placeholder="Pencarian Nama Obat" autofocus>
			</div>
		</div>
		<div class="col-sm-4 col-md-4 col-xs-4" style="margin-left:-10px; margin-bottom:10px;" align="left">
			<button type="submit" name="cari" class="btn btn-primary btn-lg">Cari</button>
			<button type="submit" name="refresh" class="btn btn-default btn-lg">Refresh</button>
		</div>
	</form>
	<form class="form-horizontal" action="contain/atribut/cetak_pemesanan.php" method="POST">
		<div class="col-sm-12 col-md-2 col-xs-12" style="margin-top:0px;" align="right">
			<input type="text" hidden name="data_bulan" value="<?php echo date('Y-F'); ?>" >
			<button type="submit" name="cetak" class="btn btn-success btn-lg btn-block">Cetak</button>
		</div>
	  </div>
	</form>
	
	<div class="panel panel-default">
	  <div class="panel-heading">
		<h3 class="panel-title" align="center">Laporan Pemesanan Bulan <?php echo date('F Y'); ?></h3>
	  </div>
	  <div class="panel-body">
		
	<?php
		include "../include/connect.php";
		
		define('MAX_REC_PER_PAGE', 10);
		$rs = mysql_query("SELECT COUNT(id_pemesanan) FROM pemesanan
							JOIN pengguna ON pemesanan.id_pengguna = pengguna.id_pengguna
							JOIN supplier ON pemesanan.id_supplier = supplier.id_supplier
							WHERE MONTH(pemesanan.tanggal) = DATE_FORMAT(NOW(),'%m')
							ORDER BY pemesanan.tanggal ASC") or die("Count query error!");
		list($total) = mysql_fetch_row($rs);
		$total_pages = ceil($total / MAX_REC_PER_PAGE);
		$page = intval(@$_GET["page"]);
		
		if (0 == $page){
			$page = 1;
		}
		$start = MAX_REC_PER_PAGE * ($page - 1);
		$max = MAX_REC_PER_PAGE;
		$rs = mysql_query("SELECT * FROM pemesanan
							JOIN pengguna ON pemesanan.id_pengguna = pengguna.id_pengguna
							JOIN supplier ON pemesanan.id_supplier = supplier.id_supplier
							WHERE MONTH(pemesanan.tanggal) = DATE_FORMAT(NOW(),'%m')
							ORDER BY pemesanan.tanggal ASC
						LIMIT $start, $max ") or die("Query error!");
		echo "<b>Total Data : ".$total."</b>";
	?>
	<table border="1" width="95%" align="center" class="table">
		<thead>
			<td class="success" style="text-align:center;">NO.</td>
			<td class="success" style="text-align:center;">ID PEMESANAN</td>
			<td class="success" style="text-align:center;">TANGGAL PEMESANAAN</td>
			<td class="success" style="text-align:center;">NAMA SUPPLIER</td>
			<td class="success" style="text-align:center;">JUMLAH</td>
			<td class="success" style="text-align:center;">DI ORDER OLEH</td>
			<td class="success" style="text-align:center;">STATUS</td>
			<td class="success" style="text-align:center;">ACTION</td>
		</thead>
		<?php
			$no = 1;
			while ($list = mysql_fetch_assoc($rs)) {
		?>
		<tr>
			<form action="" method="POST">
			<td align="center"><?php echo $no;?></td>
			<td align="center">
				<?php echo $list['id_pemesanan']; ?>
				<input hidden name='id_pemesanan' value="<?php echo $list['id_pemesanan']?>">
			</td>
			<td align="center">
				<?php echo $list['tanggal']; ?>
				<input hidden name='tanggal' value="<?php echo $list['tanggal']?>">
			</td>
			<td align="center">
				<?php echo $list['nama_supplier']; ?>
				<input hidden name='nama_supplier' value="<?php echo $list['nama_supplier']?>">
			</td>
			<td align="center">
				<?php echo $list['jumlah']; ?>
				<input hidden name='jumlah' value="<?php echo $list['jumlah']?>">
			</td>
			<td align="center">
				<?php echo $list['nama_pengguna']; ?>
				<input hidden name='id_pengguna' value="<?php echo $list['id_pengguna']?>">
				<input hidden name='nama_pengguna' value="<?php echo $list['nama_pengguna']?>">
			</td>
			<td align="center">
				<?php echo $list['status_pemesanan']; ?>
				<input hidden name='jumlah' value="<?php echo $list['status_pemesanan']?>">
			</td>
			<td align="center">
				<input class="btn btn-default btn-xs" type="submit" name="detail" value="View Detail">
			</td>
			</form>
		</tr>
		<?php
			$no +=1;
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
						$txt = "<a href=\"" . $_SERVER["PHP_SELF"] . "?contain=laporan_pemesanan&page=$i\">$txt</a>";
			?>
				<strong><?= $txt ?></strong>
			
			<?php
				}
			?>
				</h4>
			</td>
		</tr>
	</table>

	  </div>
	</div>	
	
  </div>
</div>

<?php
}
?>

<?php
	if(isset($_POST['ubah']))
	{
		$id_obat = $_POST['id_obat'];
		$nama_obat = strtoupper($_POST['nama_obat']);
		$jumlah = $_POST['jumlah'];
		$id_satuan = $_POST['id_satuan'];
		$harga_beli = $_POST['harga_beli'];
		$harga_jual = $_POST['harga_jual'];
	
		if($harga_beli < $harga_jual){
			$ubah_obat = mysql_query("UPDATE obat
								SET nama_obat = '$nama_obat', id_satuan = '$id_satuan', harga_jual = '$harga_jual'
								WHERE id_obat='$id_obat'");
			$ubah_stok = mysql_query("UPDATE stok
									SET jumlah_stok = '$jumlah'
									WHERE id_stok='$id_obat'");
			if($ubah_obat){
				if($ubah_stok){
					echo '<script languange="javascript">alert ("Data Berhasil Di Ubah")</script>';
					echo '<script languange="javascript">window.location="index.php?contain=master_obat"</script>';
				}
			}
		} else {
			echo '<script languange="javascript">alert ("HARGA JUAL TIDAK BOLEH KURANG DARI HARGA BELI")</script>';
		}
		
	}
?>