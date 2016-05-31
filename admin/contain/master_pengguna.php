<h2 style="margin-left:20px;">Data Master</h2>

<div class="panel panel-default">
  <div class="panel-body">
	<ul class="nav nav-tabs">
	  <li role="presentation"><a href="index.php?contain=master_obat">Obat</a></li>
	  <li role="presentation"><a href="index.php?contain=master_satuan">Satuan</a></li>
	  <li role="presentation"><a href="index.php?contain=master_supplier">Supplier</a></li>
	  <li role="presentation" class="active"><a href="index.php?contain=master_pengguna">Pengguna</a></li>
	</ul>
	
	<br/>
	

<?php
if(isset($_POST['edit']))
{
	include "atribut/edit_pengguna.php";
} else if (isset($_POST['cari'])){
	include "atribut/tambah_pengguna.php";
	
	include "../include/connect.php";
	$pencarian = $_POST['pencarian'];
	
	define('MAX_REC_PER_PAGE', 5);
	$rs = mysql_query("SELECT COUNT(*) FROM pengguna WHERE nama_pengguna LIKE '%".$pencarian."%' ") or die("Count query error!");
	list($total) = mysql_fetch_row($rs);
	$total_pages = ceil($total / MAX_REC_PER_PAGE);
	$page = intval(@$_GET["page"]);
	
	if (0 == $page){
		$page = 1;
	}
	$start = MAX_REC_PER_PAGE * ($page - 1);
	$max = MAX_REC_PER_PAGE;
	$rs = mysql_query("SELECT * FROM pengguna WHERE nama_pengguna LIKE '%".$pencarian."%'
						ORDER BY nama_pengguna ASC LIMIT $start, $max ") or die("Query error!");
	echo "<b>Total Data : ".$total."</b>";
?>
	<table border="1" width="95%" align="center" class="table">
		<thead>
			<td class="success" style="text-align:center;">NO.</td>
			<td class="success" style="text-align:center;">ID PENGGUNA</td>
			<td class="success" style="text-align:center;">NAMA PENGGUNA</td>
			<td class="success" style="text-align:center;">USERNAME</td>
			<td class="success" style="text-align:center;">PASSWORD</td>
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
				<?php echo $list['id_pengguna']; ?>
				<input hidden name='id_pengguna' value="<?php echo $list['id_pengguna']?>">
			</td>
			<td align="center">
				<?php echo $list['nama_pengguna']; ?>
				<input hidden name='nama_pengguna' value="<?php echo $list['nama_pengguna']?>">
			</td>
			<td align="center">
				<?php echo $list['username']; ?>
				<input hidden name='username' value="<?php echo $list['username']?>">
			</td>
			<td align="center">
				<?php echo $list['password']; ?>
				<input hidden name='password' value="<?php echo $list['password']?>">
			</td>
			<td align="center">
				<?php echo $list['status_pengguna']; ?>
				<input hidden name='status_pengguna' value="<?php echo $list['status_pengguna']?>">
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
	include "atribut/tambah_pengguna.php";
?>	

	<?php
		include "../include/connect.php";
		
		define('MAX_REC_PER_PAGE', 5);
		$rs = mysql_query("SELECT COUNT(*) FROM pengguna") or die("Count query error!");
		list($total) = mysql_fetch_row($rs);
		$total_pages = ceil($total / MAX_REC_PER_PAGE);
		$page = intval(@$_GET["page"]);
		
		if (0 == $page){
			$page = 1;
		}
		$start = MAX_REC_PER_PAGE * ($page - 1);
		$max = MAX_REC_PER_PAGE;
		$rs = mysql_query("SELECT * FROM pengguna
							ORDER BY nama_pengguna ASC LIMIT $start, $max ") or die("Query error!");
		echo "<b>Total Data : ".$total."</b>";
	?>
	<table border="1" width="95%" align="center" class="table">
		<thead>
			<td class="success" style="text-align:center;">NO.</td>
			<td class="success" style="text-align:center;">ID PENGGUNA</td>
			<td class="success" style="text-align:center;">NAMA PENGGUNA</td>
			<td class="success" style="text-align:center;">USERNAME</td>
			<td class="success" style="text-align:center;">PASSWORD</td>
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
				<?php echo $list['id_pengguna']; ?>
				<input hidden name='id_pengguna' value="<?php echo $list['id_pengguna']?>">
			</td>
			<td align="center">
				<?php echo $list['nama_pengguna']; ?>
				<input hidden name='nama_pengguna' value="<?php echo $list['nama_pengguna']?>">
			</td>
			<td align="center">
				<?php echo $list['username']; ?>
				<input hidden name='username' value="<?php echo $list['username']?>">
			</td>
			<td align="center">
				<?php echo $list['password']; ?>
				<input hidden name='password' value="<?php echo $list['password']?>">
			</td>
			<td align="center">
				<?php echo $list['status_pengguna']; ?>
				<input hidden name='status_pengguna' value="<?php echo $list['status_pengguna']?>">
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
			<h4 class="modal-title" id="myModalLabel">Tambah Supplier</h4>
		  </div>
		  <div class="modal-body">
			<div class="row">
			  <div class="col-md-1"></div>
			  <div class="col-md-10">
				<form action="" method="POST">
					<?php
						date_default_timezone_set('Asia/Jakarta');
						date('z'); // number day in year
						date('y'); // year
						date('H'); // hour
						date('s'); // secon
						$generate_id = date('z').date('y').date('H').date('s');
					?>
					  <div class="form-group">
						<label for="id_karyawan">ID Pengguna</label>
						<input type="text" class="form-control" disabled placeholder="<?php  echo "$generate_id"; ?>">
						<input type="text" name="id_pengguna" hidden value="<?php  echo "$generate_id"; ?>">
					  </div>
					  <div class="form-group">
						<label for="nama_karyawan">Nama Pengguna</label>
						<input type="text" class="form-control" name="nama_pengguna">
					  </div>
					  <div class="form-group">
						<label for="username">Username</label>
						<input type="text" class="form-control" name="username">
					  </div>
					  <div class="form-group">
						<label for="password">Password</label>
						<input type="password" class="form-control" name="password">
					  </div>
					  <div class="form-group">
						<label for="status">Status</label>
						<select class="form-control" name="status">
							<option disabled>-- Pilih Status Pengguna --</option>
							<option value="ADMIN">ADMIN</option>
							<option value="ASSAPOTEKER">ASSAPOTEKER</option>
							<option value="OWNER">OWNER</option>
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
		$id_pengguna = $_POST['id_pengguna'];
		$nama_pengguna = $_POST['nama_pengguna'];
		$username = $_POST['username'];
		$password = base64_encode($_POST['password']);
		$status = $_POST['status'];
		
		$sql = mysql_query("INSERT INTO pengguna (id_pengguna, nama_pengguna, username, password, status_pengguna)
							VALUES ('".$id_pengguna."', '".$nama_pengguna."', '".$username."', '".$password."', '".$status."') ");
							
		if ($sql) {
			echo '<script languange="javascript">alert ("Data Sukses Di Tambahkan")</script>';
			echo '<script languange="javascript">window.location="index.php?contain=master_pengguna"</script>';
		} else {
			echo '<script languange="javascript">alert ("Gagal Di Simpan")</script>';
			echo '<script languange="javascript">window.location="index.php?contain=master_pengguna"</script>';
		}
	}
	
	if(isset($_POST['hapus']))
	{
		$id_pengguna = $_POST['id_pengguna'];
				
		$hasil = mysql_query("delete from pengguna where id_pengguna='$id_pengguna'");
		if($hasil){
			echo '<script languange="javascript">alert ("Data Berhasil Di Hapus")</script>';
			echo '<script languange="javascript">window.location="index.php?contain=master_pengguna"</script>';
		}
	}
	
	if(isset($_POST['ubah']))
	{
		$id_pengguna = $_POST['id_pengguna'];
		$nama_pengguna = $_POST['nama_pengguna'];
		$username = $_POST['username'];
		$status = $_POST['status'];
		
		$hasil = mysql_query("UPDATE pengguna
								SET nama_pengguna = '".$nama_pengguna."', username = '".$username."', status_pengguna = '".$status."'
								WHERE id_pengguna='".$id_pengguna."' ");
		if($hasil){
			echo '<script languange="javascript">alert ("Data Berhasil Di Ubah")</script>';
			echo '<script languange="javascript">window.location="index.php?contain=master_pengguna"</script>';
		} else {
			echo '<script languange="javascript">alert ("Gagal")</script>';
		}
	}
?>