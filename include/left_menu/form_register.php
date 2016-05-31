	<ul class="nav nav-tabs">
		<li role="presentation" class=""><a href="index.php?side=login">Login</a></li>
		<li role="presentation" class="active"><a href="index.php?side=register">Registrasi</a></li>
	</ul>

<div class="panel panel-default">
  <div class="panel-body">
	<form action="include/register.php" method="POST">
	  <div class="form-group">
		<label for="nama_karyawan">Nama Karyawan</label>
		<input type="text" class="form-control" name="nama_karyawan" id="nama_karyawan" autofocus>
	  </div>
	  <div class="form-group">
		<label for="username">Username</label>
		<input type="text" class="form-control" name="username" id="username">
	  </div>
	  <div class="form-group">
		<label for="password">Password</label>
		<input type="password" class="form-control" name="password" id="password">
	  </div>
	  <div class="form-group">
		<label for="departemen">Departemen</label>
		<select name="id_departemen" class="form-control">
		  <?php
			include 'include/connect.php';
			$hasil = mysql_query("SELECT * FROM master_departemen");
			$no=1;
			while($data=mysql_fetch_assoc($hasil)){
		  ?>
			<option value="<?php echo $data['id_departemen']?>"><?php echo $data['nama_departemen']?></option>
		  <?php
			}
		  ?>
		</select>
	  </div>
	  <div class="form-group">
		<label for="status">Daftar Sebagai</label>
		<select name="status" class="form-control">
			<option value="TEKNISI">TEKNISI</option>
			<option value="FRONT OFFICE">FRONT OFFICE</option>
		</select>
	  </div>
	  <div class="form-group">
		<img src="include/captcha.php"/><br/>
		<label for="captcha">Input Kode Gambar</label>
		<input type="text" class="form-control" name="code" id="code">
	  </div>
	  <div align="right">
		<button type="submit" name="tambah" class="btn btn-success">Submit</button>
	  </div>
	</form>
  </div>
</div>