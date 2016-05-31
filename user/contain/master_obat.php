<h2 style="margin-left:20px;">Data Master</h2>

<div class="panel panel-default">
  <div class="panel-body">
	<ul class="nav nav-tabs">
	  <li role="presentation" class="active"><a href="index.php?contain=master_obat">Obat</a></li>
	  <li role="presentation"><a href="index.php?contain=master_satuan">Satuan</a></li>
	  <li role="presentation"><a href="index.php?contain=master_supplier">Supplier</a></li>
	</ul>
	
	<br/>
	

<?php
if(isset($_POST['edit']))
{
	include "atribut/edit_obat.php";
} else if (isset($_POST['tambah_satuan'])){
	include "atribut/tambah_satuan.php";
} else if (isset($_POST['tambah_obat_satuan'])){
	include "atribut/tambah_obat_satuan.php";
} else if (isset($_POST['cari'])){
	include "atribut/tambah_obat.php";
	
	include "../include/connect.php";
	$pencarian = $_POST['pencarian'];
	
	define('MAX_REC_PER_PAGE', 5);
	$rs = mysql_query("SELECT COUNT(*) FROM obat WHERE nama_obat LIKE '%".$pencarian."%' ") or die("Count query error!");
	list($total) = mysql_fetch_row($rs);
	$total_pages = ceil($total / MAX_REC_PER_PAGE);
	$page = intval(@$_GET["page"]);
	
	if (0 == $page){
		$page = 1;
	}
	$start = MAX_REC_PER_PAGE * ($page - 1);
	$max = MAX_REC_PER_PAGE;
	$rs = mysql_query("SELECT * FROM obat
						JOIN stok ON obat.id_stok = stok.id_stok
						JOIN satuan ON obat.id_satuan = satuan.id_satuan
						WHERE nama_obat LIKE '%".$pencarian."%'
						LIMIT $start, $max ") or die("Query error!");
	echo "<b>Total Data : ".$total."</b>";
?>
	<table border="1" width="95%" align="center" class="table">
		<thead>
			<td class="success" style="text-align:center;">NO.</td>
			<td class="success" style="text-align:center;">ID OBAT</td>
			<td class="success" style="text-align:center;">NAMA OBAT</td>
			<td class="success" style="text-align:center;">STOK SAAT INI</td>
			<td class="success" style="text-align:center;">RE ORDER</td>
			<td class="success" style="text-align:center;">SATUAN</td>
			<td class="success" style="text-align:center;">HARGA BELI</td>
			<td class="success" style="text-align:center;">HARGA JUAL</td>
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
				<?php echo $list['id_obat']; ?>
				<input hidden name='id_obat' value="<?php echo $list['id_obat']?>">
			</td>
			<td align="center">
				<?php echo $list['nama_obat']; ?>
				<input hidden name='nama_obat' value="<?php echo $list['nama_obat']?>">
			</td>
			<td align="center">
				<?php echo $list['jumlah_stok']; ?>
				<input hidden name='jumlah' value="<?php echo $list['jumlah_stok']?>">
			</td>
			<td align="center">
				<?php echo $list['rop']; ?>
				<input hidden name='rop' value="<?php echo $list['rop']?>">
			</td>
			<td align="center">
				<?php echo $list['nama_satuan']; ?>
				<input hidden name='id_satuan' value="<?php echo $list['id_satuan']?>">
				<input hidden name='nama_satuan' value="<?php echo $list['nama_satuan']?>">
			</td>
			<td align="center">
				<?php echo number_format($list['harga_beli']); ?>
				<input hidden name='harga_beli' value="<?php echo $list['harga_beli']?>">
			</td>
			<td align="center">
				<?php echo number_format($list['harga_jual']); ?>
				<input hidden name='harga_jual' value="<?php echo $list['harga_jual']?>">
			</td>
			<td align="center">
				<button type='submit' name='edit' class='btn btn-default btn-sm'>Edit</button>
				<button type='submit' onclick="return confirm('Yakin akan menghapus data ini?');" name='hapus' class='btn btn-danger btn-sm'>Hapus</button>
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
	include "atribut/tambah_obat.php";
?>	

	<?php
		include "../include/connect.php";
		
		define('MAX_REC_PER_PAGE', 5);
		$rs = mysql_query("SELECT COUNT(*) FROM obat") or die("Count query error!");
		list($total) = mysql_fetch_row($rs);
		$total_pages = ceil($total / MAX_REC_PER_PAGE);
		$page = intval(@$_GET["page"]);
		
		if (0 == $page){
			$page = 1;
		}
		$start = MAX_REC_PER_PAGE * ($page - 1);
		$max = MAX_REC_PER_PAGE;
		$rs = mysql_query("SELECT * FROM obat
							JOIN stok ON obat.id_stok = stok.id_stok
							JOIN satuan ON obat.id_satuan = satuan.id_satuan LIMIT $start, $max ") or die("Query error!");
		echo "<b>Total Data : ".$total."</b>";
	?>
	<table border="1" width="95%" align="center" class="table">
		<thead>
			<td class="success" style="text-align:center;">NO.</td>
			<td class="success" style="text-align:center;">ID OBAT</td>
			<td class="success" style="text-align:center;">NAMA OBAT</td>
			<td class="success" style="text-align:center;">STOK SAAT INI</td>
			<td class="success" style="text-align:center;">RE ORDER</td>
			<td class="success" style="text-align:center;">SATUAN</td>
			<td class="success" style="text-align:center;">HARGA BELI</td>
			<td class="success" style="text-align:center;">HARGA JUAL</td>
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
				<?php echo $list['id_obat']; ?>
				<input hidden name='id_obat' value="<?php echo $list['id_obat']?>">
			</td>
			<td align="center">
				<?php echo $list['nama_obat']; ?>
				<input hidden name='nama_obat' value="<?php echo $list['nama_obat']?>">
			</td>
			<td align="center">
				<?php echo $list['jumlah_stok']; ?>
				<input hidden name='jumlah' value="<?php echo $list['jumlah_stok']?>">
			</td>
			<td align="center">
				<?php echo $list['rop']; ?>
				<input hidden name='rop' value="<?php echo $list['rop']?>">
			</td>
			<td align="center">
				<?php echo $list['nama_satuan']; ?>
				<input hidden name='id_satuan' value="<?php echo $list['id_satuan']?>">
				<input hidden name='nama_satuan' value="<?php echo $list['nama_satuan']?>">
			</td>
			<td align="center">
				<?php echo number_format($list['harga_beli']); ?>
				<input hidden name='harga_beli' value="<?php echo $list['harga_beli']?>">
			</td>
			<td align="center">
				<?php echo number_format($list['harga_jual']); ?>
				<input hidden name='harga_jual' value="<?php echo $list['harga_jual']?>">
			</td>
			<td align="center">
				<button type='submit' name='edit' class='btn btn-default btn-sm'>Edit</button>
				<button type='submit' onclick="return confirm('Yakin akan menghapus data ini?');" name='hapus' class='btn btn-danger btn-sm'>Hapus</button>
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
	
  </div>
</div>

<?php
}
?>

<!-- ###################   Modal   ###################### -->
<form class="form-horizontal" action="" method="POST">
	<div class="modal fade" id="ModalTambahSupplier" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel">Tambah Obat</h4>
		  </div>
		  <div class="modal-body">
			<div class="row">
			  <div class="col-md-1"></div>
			  <div class="col-md-10">
				<form action="" method="POST" class="form-inline">
					<?php
						date_default_timezone_set('Asia/Jakarta');
						date('z'); // number day in year
						date('y'); // year
						date('H'); // hour
						date('s'); // secon
						$generate_id = date('z').date('y').date('H').date('s');
					?>
					  <div class="form-group">
						<label for="id_obat">ID Obat</label>
						<input type="text" class="form-control" disabled placeholder="<?php  echo "$generate_id"; ?>">
						<input type="text" name="id_obat" hidden value="<?php  echo "$generate_id"; ?>">
					  </div>
					  <div class="form-group">
						<label for="nama_obat">Nama Obat</label>
						<input type="text" class="form-control" name="nama_obat">
					  </div>
					  <div class="form-group">
						<label for="jumlah">Stok Saat Ini</label>
						<input type="text" class="form-control" name="jumlah">
					  </div>
					  <div class="form-group">
						<label for="username">Satuan</label>
						<button type="submit" name="tambah_satuan" class="btn btn-primary btn-xs">Tambah Satuan</button>
						<select class="form-control" name="id_satuan">
							<option disabled>-- Pilih Satuan --</option>
					  <?php
							include 'include/connect.php';
							$hasil = mysql_query("SELECT * FROM satuan");
							$no=1;
							while($data=mysql_fetch_assoc($hasil)){
					  ?>
							<option value="<?php echo $data['id_satuan']?>"><?php echo $data['nama_satuan']?></option>
					  <?php
							}
					  ?>
						</select>
					  </div>
				</form>
			  </div>
			  <div class="col-md-1"></div>
			</div>
		  </div>
		  <div class="modal-footer">
			<button type="submit" name="tambah" class="btn btn-primary">Simpan</button>
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		  </div>
		</div>
	  </div>
	</div>
</form>

<?php
	if(isset($_POST['tambah']))
	{
		$id_obat = $_POST['id_obat'];
		$nama_obat = strtoupper($_POST['nama_obat']);
		$jumlah = $_POST['jumlah'];
		$id_satuan = $_POST['id_satuan'];
		
		$sql_obat = mysql_query("INSERT INTO obat (id_obat, nama_obat, id_satuan, id_stok)
							VALUES ('".$id_obat."', '".$nama_obat."', '".$id_satuan."', '".$id_obat."') ");
		$sql_stok = mysql_query("INSERT INTO stok (id_stok, jumlah_stok, rop, eoq, lead_time, used)
							VALUES ('".$id_obat."', '".$jumlah."', '0', '0', '0', '0') ");
							
		if ($sql_obat) {
			if ($sql_stok) {
				echo '<script languange="javascript">alert ("Data Sukses Di Tambahkan")</script>';
				echo '<script languange="javascript">window.location="index.php?contain=master_obat"</script>';
			}
		} else {
			echo '<script languange="javascript">alert ("Gagal Di Simpan")</script>';
			echo '<script languange="javascript">window.location="index.php?contain=master_obat"</script>';
		}
	}
	
	if(isset($_POST['simpan_satuan']))
	{
		$id_satuan = $_POST['id_satuan'];
		$nama_satuan = strtoupper($_POST['nama_satuan']);
		
		$sql = mysql_query("INSERT INTO satuan (id_satuan, nama_satuan)
							VALUES ('".$id_satuan."', '".$nama_satuan."') ");
							
		if ($sql) {
			echo '<script languange="javascript">alert ("Data Sukses Di Tambahkan")</script>';
			echo '<script languange="javascript">window.location="index.php?contain=master_obat"</script>';
		} else {
			echo '<script languange="javascript">alert ("Gagal Di Simpan")</script>';
			echo '<script languange="javascript">window.location="index.php?contain=master_obat"</script>';
		}
	}
	
	if(isset($_POST['hapus']))
	{
		$id_obat = $_POST['id_obat'];
				
		$hasil_obat = mysql_query("delete from obat where id_obat='$id_obat'");
		$hasil_stok = mysql_query("delete from stok where id_stok='$id_obat'");
		if($hasil_obat){
			if($hasil_stok){
				echo '<script languange="javascript">alert ("Data Berhasil Di Hapus")</script>';
				echo '<script languange="javascript">window.location="index.php?contain=master_obat"</script>';
			}
		}
	}
	
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