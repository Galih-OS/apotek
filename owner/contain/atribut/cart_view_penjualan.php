<table width="100%" border="1" cellspacing="0" cellpadding="0" class="viewer">
  <tr>
    <th style="text-align:center;" scope="col">Kode Obat</th>
    <th style="text-align:center;" scope="col">Nama Obat</th>
    <th style="text-align:center;" scope="col">Satuan</th>
    <th style="text-align:center;" scope="col">Kuantitas</th>
    <th style="text-align:center;" scope="col">Aksi</th>
  </tr>
  <?php
		
  if (isset($_SESSION['itemproduk'])) {
		include '../include/connect.php';
        foreach ($_SESSION['itemproduk'] as $key => $val){
            $query = mysql_query ("SELECT id_obat, nama_obat, nama_satuan FROM obat
									JOIN satuan ON obat.id_satuan = satuan.id_satuan WHERE id_obat = '$key'");
			$rs = mysql_fetch_array ($query);			
  ?>
  <tr>
    <td align="center"><?php echo $rs['id_obat']; ?></td>
    <td align="center"><?php echo $rs['nama_obat']; ?></td>
    <td align="center"><?php echo $rs['nama_satuan']; ?></td>
    <td align="center"><?php echo number_format($val); ?></td>
    <td align="center">
		<a class="btn btn-default btn-sm" style="font-size:px;" href="contain/atribut/cart.php?act=plus&amp;barang_id=<?php echo $key; ?>&amp;ref=../../index.php?contain=penjualan"><b>+</b></a>
		<a class="btn btn-default btn-sm" style="font-size:px;" href="contain/atribut/cart.php?act=plussepuluh&amp;barang_id=<?php echo $key; ?>&amp;ref=../../index.php?contain=penjualan"><b>+10</b></a>
		<a class="btn btn-default btn-sm" style="font-size:px;" href="contain/atribut/cart.php?act=min&amp;barang_id=<?php echo $key; ?>&amp;ref=../../index.php?contain=penjualan"><b>-</b></a>
		<a class="btn btn-default btn-sm" style="font-size:px;" href="contain/atribut/cart.php?act=minsepuluh&amp;barang_id=<?php echo $key; ?>&amp;ref=../../index.php?contain=penjualan"><b>-10</b></a>
		<a class="btn btn-danger btn-sm" href="contain/atribut/cart.php?act=del&amp;barang_id=<?php echo $key; ?>&amp;ref=../../index.php?contain=penjualan">Hapus</a>
	</td>
  </tr>
  <?php
            mysql_free_result($query);
        }
  }
  ?>
  <tr>
	<td colspan="5" style="">&nbsp</td>
  </tr>
  <!--
  <tr>
	<td align="right" colspan="3"><strong>TOTAL :
		<?php
			if (!isset($_SESSION['itemproduk'])) {
				$total = 0;
			} else {
				$total = 0;
				foreach ($_SESSION['itemproduk'] as $key2 => $val){
					$query = mysql_query ("select * from obat where id_obat = '$key2'");
					$rs = mysql_fetch_array ($query);
					$total += $val;
				}
			}
		?>
		</strong>
	</td>
	<td align="center"><?php echo $total; ?></td>
	<td></td>
  </tr>
  -->
  <tr>
  
	<form action="" method="POST" class="form-horizontal">
    <td colspan="3">
	  <div class="form-group">
		<!-- <label for="suppp" class="col-sm-4 control-label" style="margin-top:5px;">Pemesanan untuk Supplier : </label>
		<div class="col-sm-8">
			<select class="form-control" name="id_supplier">
				<option disabled>-- Pilih Satuan --</option>
		  <?php
				$hasil = mysql_query("SELECT * FROM supplier");
				$no=1;
				while($data=mysql_fetch_assoc($hasil)){
		  ?>
				<option value="<?php echo $data['id_supplier']?>"><?php echo $data['nama_supplier']?></option>
		  <?php
				}
		  ?>
			</select>
		</div>
		-->
	  </div>
	</td>
    <td align="center" colspan="2">
			<input class="btn btn-primary btn-sm" name="simpan" type="submit" value="Simpan">
			<a class="btn btn-danger btn-sm" href="contain/atribut/cart.php?act=clear&amp;ref=../../index.php?contain=penjualan">Batal</a>
	</td>
	</form>
  </tr>
</table>

<?php
	if(isset($_POST['simpan'])){
		include '../include/connect.php';
		$no = 1;
		date_default_timezone_set('Asia/Jakarta');
		$today = date('Y-m-d');
		$generate_id = date('z').date('y').date('H').date('s');
		$generate_id_fix = $generate_id;
		
		// MENCATAT KEDALAM TABEL PERMINTAAN_PRODUKSI
		$query2 = mysql_query ("INSERT INTO penjualan
								VALUES ('".$generate_id_fix."', '".$today."', ".$total.", '".$_SESSION['id']."') ");
		
		if ($query2 == 1)
		{
			echo '<script languange="javascript">alert ("Penjualan Berhasil Di Inputkan")</script>';
		
			// MENCARI NOMOR TERAKHIR ID_DET_PERMINTAAN_PROD
			$query = mysql_query ("SELECT COUNT(*)+1 AS jum FROM detail_penjualan");
			$jum = mysql_fetch_array($query);
			$jum = $jum['jum'];
		
			foreach ($_SESSION['itemproduk'] as $key => $val){
				$sub_total = 0;
				$stok = 0;
				$query = mysql_query ("SELECT id_obat, nama_obat FROM obat WHERE id_obat = '$key'");
				$rs = mysql_fetch_array ($query);
				
				// MENCATAT KEDALAM TABEL DETAIL_PERMINTAAN_PRODUKSI
				$query3 = mysql_query ("INSERT INTO detail_penjualan
										VALUES (".$jum.",'".$generate_id_fix."','".$rs['id_obat']."', ".$val.") ");

				// MENGHITUNG TOTAL PENJUALAN
				$query_stok_obat = mysql_query("SELECT SUM(detail_penjualan.sub_jumlah) AS sub_jumlah FROM penjualan
													JOIN detail_penjualan ON penjualan.id_penjualan = detail_penjualan.id_penjualan
												WHERE id_obat = '".$rs['id_obat']."' AND MONTH(tanggal_penjualan) = MONTH(CURDATE()) ") or die("Query error!");
											
				$sub_jumlah = mysql_fetch_array($query_stok_obat);
				$sub_jumlah = $sub_jumlah['sub_jumlah'];
				
				// UPDATE DATA pada USED - STOK
				$update_leadtime = mysql_query("UPDATE stok
								SET used = '".$sub_jumlah."'
								WHERE id_stok='".$rs['id_obat']."' ");
				
				// UPDATE NILAI ROP
					// ambil data total used
					$query_used = mysql_query("SELECT used AS total_used FROM stok
								WHERE id_stok = '".$rs['id_obat']."' ") or die("Query used eror!");
					$total_used = mysql_fetch_array($query_used);
					$total_used = $total_used['total_used'];
					// ambil data total lead time
					$query_leadtime = mysql_query("SELECT lead_time AS lead_time FROM stok
								WHERE id_stok = '".$rs['id_obat']."' ") or die("Query used eror!");
					$lead_time = mysql_fetch_array($query_leadtime);
					$lead_time = $lead_time['lead_time'];
				
					$new_rop = ($total_used * $lead_time) + 2;
					
					$update_leadtime = mysql_query("UPDATE stok
													SET rop = '".$new_rop."'
													WHERE id_stok='".$rs['id_obat']."' ");
				
				// _______________________________________
				$jum += 1;
			}
			
			
			
			
			
			// HAPUS LIST CART
			if (isset($_SESSION['itemproduk'])) {
				foreach ($_SESSION['itemproduk'] as $key => $val) {
					unset($_SESSION['itemproduk'][$key]);
				}
				unset($_SESSION['itemproduk']);
			}
			
		// PERHITUNGAN ROP
		
		// END ####### PERHITUNGAN ROP
		
		} else {
			echo '<script languange="javascript">alert ("Penjualan Gagal di Proses")</script>';
		}
		echo '<script languange="javascript">window.location="index.php?contain=penjualan"</script>';
	}
?>