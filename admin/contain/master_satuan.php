<h2 style="margin-left:20px;">Data Master</h2>

<div class="panel panel-default">
  <div class="panel-body">
	<ul class="nav nav-tabs">
	  <li role="presentation"><a href="index.php?contain=master_obat">Obat</a></li>
	  <li role="presentation" class="active"><a href="index.php?contain=master_satuan">Satuan</a></li>
	  <li role="presentation"><a href="index.php?contain=master_supplier">Supplier</a></li>
	  <li role="presentation"><a href="index.php?contain=master_pengguna">Pengguna</a></li>
	</ul>
	
	<br/>
	

<?php
if(isset($_POST['edit']))
{
	include "atribut/edit_satuan.php";
} else if (isset($_POST['tambah_satuan'])){
	
	include "atribut/tambah_satuan.php";
	
} else if (isset($_POST['cari'])){
	include "atribut/cari_satuan.php";
	
	include "../include/connect.php";
	$pencarian = $_POST['pencarian'];
	
	define('MAX_REC_PER_PAGE', 5);
	$rs = mysql_query("SELECT COUNT(*) FROM satuan WHERE nama_satuan LIKE '%".$pencarian."%' ") or die("Count query error!");
	list($total) = mysql_fetch_row($rs);
	$total_pages = ceil($total / MAX_REC_PER_PAGE);
	$page = intval(@$_GET["page"]);
	
	if (0 == $page){
		$page = 1;
	}
	$start = MAX_REC_PER_PAGE * ($page - 1);
	$max = MAX_REC_PER_PAGE;
	$rs = mysql_query("SELECT * FROM satuan WHERE nama_satuan LIKE '%".$pencarian."%'
						ORDER BY nama_satuan ASC LIMIT $start, $max ") or die("Query error!");
	echo "<b>Total Data : ".$total."</b>";
?>
	<table border="1" width="95%" align="center" class="table">
		<thead>
			<td class="success" style="text-align:center;">NO.</td>
			<td class="success" style="text-align:center;">ID SATUAN</td>
			<td class="success" style="text-align:center;">NAMA SATUAN</td>
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
				<?php echo $list['id_satuan']; ?>
				<input hidden name='id_satuan' value="<?php echo $list['id_satuan']?>">
			</td>
			<td align="center">
				<?php echo $list['nama_satuan']; ?>
				<input hidden name='nama_satuan' value="<?php echo $list['nama_satuan']?>">
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
	include "atribut/cari_satuan.php";
?>	

	<?php
		include "../include/connect.php";
		
		define('MAX_REC_PER_PAGE', 5);
		$rs = mysql_query("SELECT COUNT(*) FROM satuan") or die("Count query error!");
		list($total) = mysql_fetch_row($rs);
		$total_pages = ceil($total / MAX_REC_PER_PAGE);
		$page = intval(@$_GET["page"]);
		
		if (0 == $page){
			$page = 1;
		}
		$start = MAX_REC_PER_PAGE * ($page - 1);
		$max = MAX_REC_PER_PAGE;
		$rs = mysql_query("SELECT * FROM satuan
							ORDER BY nama_satuan ASC LIMIT $start, $max ") or die("Query error!");
		echo "<b>Total Data : ".$total."</b>";
	?>
	<table border="1" width="95%" align="center" class="table">
		<thead>
			<td class="success" style="text-align:center;">NO.</td>
			<td class="success" style="text-align:center;">ID SATUAN</td>
			<td class="success" style="text-align:center;">NAMA SATUAN</td>
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
				<?php echo $list['id_satuan']; ?>
				<input hidden name='id_satuan' value="<?php echo $list['id_satuan']?>">
			</td>
			<td align="center">
				<?php echo $list['nama_satuan']; ?>
				<input hidden name='nama_satuan' value="<?php echo $list['nama_satuan']?>">
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


<?php
	if(isset($_POST['simpan_satuan']))
	{
		$id_satuan = $_POST['id_satuan'];
		$nama_satuan = strtoupper($_POST['nama_satuan']);
		
		$sql = mysql_query("INSERT INTO satuan (id_satuan, nama_satuan)
							VALUES ('".$id_satuan."', '".$nama_satuan."') ");
							
		if ($sql) {
			echo '<script languange="javascript">alert ("Data Sukses Di Tambahkan")</script>';
			echo '<script languange="javascript">window.location="index.php?contain=master_satuan"</script>';
		} else {
			echo '<script languange="javascript">alert ("Gagal Di Simpan")</script>';
			echo '<script languange="javascript">window.location="index.php?contain=master_satuan"</script>';
		}
	}
	
	if(isset($_POST['hapus']))
	{
		$id_satuan = $_POST['id_satuan'];
				
		$hasil = mysql_query("delete from satuan where id_satuan='$id_satuan'");
		if($hasil){
			echo '<script languange="javascript">alert ("Data Berhasil Di Hapus")</script>';
			echo '<script languange="javascript">window.location="index.php?contain=master_satuan"</script>';
		}
	}
	
	if(isset($_POST['ubah']))
	{
		$id_satuan = $_POST['id_satuan'];
		$nama_satuan = $_POST['nama_satuan'];
		
		$hasil = mysql_query("UPDATE satuan
								SET nama_satuan = '$nama_satuan'
								WHERE id_satuan='$id_satuan'");
		if($hasil){
			echo '<script languange="javascript">alert ("Data Berhasil Di Ubah")</script>';
			echo '<script languange="javascript">window.location="index.php?contain=master_satuan"</script>';
		}
	}
?>