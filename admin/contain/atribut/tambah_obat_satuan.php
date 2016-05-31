<form class="form-horizontal" action="" method="POST">
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
							include "../include/connect.php";
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
			<button type="submit" name="batal" class="btn btn-default" data-dismiss="modal">Batal</button>
		  </div>
		</div>
	  </div>
</form>