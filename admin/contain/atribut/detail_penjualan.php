<?php
	$id_penjualan = $_POST['id_penjualan'];
	$tanggal = $_POST['tanggal'];
	$nama_pengguna = $_POST['nama_pengguna'];
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
							Detail Penjualan : <b><?php echo $id_penjualan;?></b>
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
				</tr>
			</table>
		  </div>
		  <div class="panel-body">
			<table border="1" width="95%" align="center" class="table">
				<thead>
					<td class="success" style="text-align:center;">NO.</td>
					<td class="success" style="text-align:center;">NAMA OBAT</td>
					<td class="success" style="text-align:center;">JUMLAH</td>
					<td class="success" style="text-align:center;">SUB HARGA</td>
				</thead>
				<?php
					include "../include/connect.php";
					
					$no = 1;
					$rs = mysql_query("SELECT * FROM detail_penjualan
						JOIN obat ON detail_penjualan.id_obat = obat.id_obat
						JOIN penjualan ON detail_penjualan.id_penjualan = penjualan.id_penjualan
						WHERE detail_penjualan.id_penjualan = '".$id_penjualan."' ") or die("Query error!");
					while ($list = mysql_fetch_assoc($rs)) {
				?>
				<tr>
					<td align="center"><?php echo $no;?></td>
					<td align="center">
						<?php echo $list['nama_obat']; ?>
					</td>
					<td align="center">
						<?php echo number_format($list['sub_jumlah_penjualan']); ?>
					</td>
					<td align="center">
						<?php echo number_format($list['sub_harga_penjualan']); ?>
					</td>
				</tr>
				<?php
					$no +=1;
					}
					
					$rs_total = mysql_query("SELECT * FROM detail_penjualan
						JOIN obat ON detail_penjualan.id_obat = obat.id_obat
						JOIN penjualan ON detail_penjualan.id_penjualan = penjualan.id_penjualan
						WHERE detail_penjualan.id_penjualan = '".$id_penjualan."' ") or die("Query error!");
					while ($list_total = mysql_fetch_assoc($rs_total)) {
				?>
				<tr>
					<td colspan="3" align="right">
						TOTAL :
					</td>
					<td align="center">
						<?php echo number_format($list_total['total_penjualan']); ?>
					</td>
				</tr>
				<?php
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