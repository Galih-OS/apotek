<h2 style="margin-left:20px;">Pembelian Obat</h2>

<div class="panel panel-default">
  <div class="panel-body">
	<ul class="nav nav-tabs">
	  <li role="presentation" class="active"><a href="index.php?contain=pemesanan_obat">Pemesanan</a></li>
	  <li role="presentation"><a href="index.php?contain=pembelian_obat">Pembelian</a></li>
	</ul>
	<br/>

<?php
if(isset($_POST['tambah_pemesanan']))
{
	include "submit_pemesanan.php";
} else if (isset($_POST['detail'])){
	include "atribut/detail_pemesanan.php";
} else if (isset($_POST['cari'])){
	include "atribut/tambah_pemesanan.php";
	
	include "../include/connect.php";
	$pencarian = $_POST['pencarian'];
	
	define('MAX_REC_PER_PAGE', 5);
	$rs = mysql_query("SELECT COUNT(*) FROM pemesanan WHERE tanggal LIKE '%".$pencarian."%' AND status_pemesanan = 'PENDING' ") or die("Count query error!");
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
						WHERE pemesanan.tanggal LIKE '%".$pencarian."%' AND status_pemesanan = 'PENDING'
						ORDER BY pemesanan.tanggal DESC
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
				<input class="btn btn-default btn-xs" type="submit" name="detail" value="View Detail">
				<!--
				<button type='submit' name='edit' class='btn btn-default btn-sm'>Edit</button>
				<button type='submit' name='hapus' class='btn btn-danger btn-sm'>Hapus</button>
				-->
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
		include "atribut/tambah_pemesanan.php";
	
		include "../include/connect.php";
		
		define('MAX_REC_PER_PAGE', 5);
		$rs = mysql_query("SELECT COUNT(*) FROM pemesanan WHERE status_pemesanan = 'PENDING' ") or die("Count query error!");
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
							WHERE status_pemesanan = 'PENDING'
							ORDER BY pemesanan.tanggal DESC LIMIT $start, $max ") or die("Query error!");
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
				<input class="btn btn-default btn-xs" type="submit" name="detail" value="View Detail">
				<!--
				<button type='submit' name='edit' class='btn btn-default btn-sm'>Edit</button>
				<button type='submit' name='hapus' class='btn btn-danger btn-sm'>Hapus</button>
				-->
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
  </div>
</div>