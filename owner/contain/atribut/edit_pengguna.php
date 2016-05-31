<?php
	$id_pengguna = $_POST['id_pengguna'];
	
	include "../include/connect.php";
	$rs = mysql_query("SELECT * FROM pengguna WHERE id_pengguna = '".$id_pengguna."' ") or die("Query error!");
	while ($list = mysql_fetch_assoc($rs)) {
?>
	<div class="row">
	  <div class="col-md-2"></div>
	  <div class="col-md-8">
		<div class="panel panel-default">
		  <div class="panel-heading">
			<h3 class="panel-title">Edit Pengguna</h3>
		  </div>
		  <div class="panel-body">
			<form action="" method="POST">
				  <div class="form-group">
					<label for="id_karyawan">ID Pengguna</label>
					<input type="text" class="form-control" disabled placeholder="<?php echo $list['id_pengguna']; ?>">
					<input type="text" name="id_pengguna" hidden value="<?php echo $list['id_pengguna']; ?>">
				  </div>
				  <div class="form-group">
					<label for="nama_karyawan">Nama Pengguna</label>
					<input type="text" class="form-control" name="nama_pengguna" value="<?php echo $list['nama_pengguna']; ?>">
				  </div>
				  <div class="form-group">
					<label for="nama_karyawan">Username</label>
					<input type="text" class="form-control" name="username" value="<?php echo $list['username']; ?>">
				  </div>
				  <div class="form-group">
					<label for="nama_karyawan">Password</label>
					<input type="text" class="form-control" name="password" disabled value="<?php echo $list['password']; ?>">
				  </div>
				  <div class="form-group">
					<label for="password">Status</label>
					<select class="form-control" name="status">
						<option value="<?php echo $list['status_pengguna']; ?>"><?php echo $list['status_pengguna']; ?></option>
						<option disabled>-- Pilih Status Pengguna --</option>
						<option value="ADMIN">ADMIN</option>
						<option value="ASSAPOTEKER">ASSAPOTEKER</option>
						<option value="OWNER">OWNER</option>
					</select>
				  </div>
			<div align="right">
				<button type='submit' name='ubah' class='btn btn-primary btn-sm'>Simpan</button>
				<button type='submit' name='batal' class='btn btn-default btn-sm'>Batal</button>
			</div>
			</form>
		  </div>
		</div>
	  </div>
	  <div class="col-md-2"></div>
	</div>
	<?php
		}
	?>