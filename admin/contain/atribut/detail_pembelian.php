<?php
	$id_pembelian = $_POST['id_pembelian'];
	$tanggal = $_POST['tanggal'];
	$nama_pengguna = $_POST['nama_pengguna'];
	$nama_supplier = $_POST['nama_supplier'];
?>
	<div class="row">
	  <div class="col-md-2"></div>
	  <div class="col-md-8">
		<div class="panel panel-default">
		  <div class="panel-heading">
			<table width="100%">
				<tr>
					<td align="left">
						<h3 class="panel-title">
							Detail Pembelian : <b><?php echo $id_pembelian;?></b>
						</h3>
					</td>
					<td align="right">
						<h3 class="panel-title">
							Dibuat Oleh : <b><?php echo $nama_pengguna;?></b>
						</h3>
					</td>
				</tr>
				<tr>
					<td align="left">
						<h3 class="panel-title">
							Dibuat Pada : <b><?php echo $tanggal;?></b>
						</h3>
					</td>
					<td align="right">
						<h3 class="panel-title">
							Ditujukan Untuk : <b><?php echo $nama_supplier;?></b>
						</h3>
					</td>
				</tr>
			</table>
		  </div>
		  <div class="panel-body">
			<table border="1" width="95%" align="center" class="table">
				<thead>
					<td class="success" style="text-align:center;">NO.</td>
					<td class="success" style="text-align:center;">NAMA OBAT</td>
					<td class="success" style="text-align:center;">HARGA</td>
				</thead>
				<?php
					include "../include/connect.php";
					
					$no = 1;
					$rs = mysql_query("SELECT * FROM detail_pembelian
						JOIN obat ON detail_pembelian.id_obat = obat.id_obat
						WHERE id_pembelian = '".$id_pembelian."' ") or die("Query error!");
					while ($list = mysql_fetch_assoc($rs)) {
				?>
				<tr>
					<form action="" method="POST">
					<td align="center"><?php echo $no;?></td>
					<td align="center">
						<?php echo $list['nama_obat']; ?>
					</td>
					<td align="center">
						<?php echo number_format($list['harga']); ?>
					</td>
					</form>
				</tr>
				<?php
					$no +=1;
					}
				?>
			</table>
		  </div>
		  <div class="panel-footer" align="right">
			<form action="" method="POST">
				<input class="btn btn-default" type="submit" name="refresh" value="Kembali">
			</form>
		  </div>
		</div>
	  </div>
	  <div class="col-md-2"></div>
	</div>