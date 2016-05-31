<?php
		include "../include/connect.php";
		if(isset($_GET['id_pemesanan'])){
			$_SESSION['id_pemesanan'] = $_GET['id_pemesanan'];
			$_SESSION['tanggal'] = $_GET['tanggal'];			
			$_SESSION['nama_supplier'] = $_GET['nama_supplier'];			
			$_SESSION['id_supplier'] = $_GET['id_supplier'];			
		} else {
			
		}
		
		$query_cek_pembelian = mysql_query("SELECT COUNT(*) as total_cek_pembelian FROM pembelian
											WHERE id_pembelian = '".$_SESSION['id_pemesanan'] ."' ");
		$value_cek_pembelian = mysql_fetch_assoc($query_cek_pembelian);
		if($value_cek_pembelian['total_cek_pembelian'] != 0){
			
		} else {
			//$sub_total = 0;
			$sql_pembelian = mysql_query("INSERT INTO pembelian (id_pembelian, tanggal_diterima, jumlah, id_pengguna, id_supplier)
							VALUES ('".$_SESSION['id_pemesanan']."', '', 0, '', '".$_SESSION['id_supplier']."') ");
		}
		
		$rs = mysql_query("SELECT * FROM detail_pemesanan
							JOIN obat ON detail_pemesanan.id_obat = obat.id_obat
							JOIN stok ON obat.id_stok = stok.id_stok
							WHERE id_pemesanan = '".$_SESSION['id_pemesanan']."' ") or die("Query error!");
							
		$query_data_1 = mysql_query("SELECT COUNT(*) AS total_data_1 FROM detail_pemesanan
							JOIN obat ON detail_pemesanan.id_obat = obat.id_obat
							WHERE id_pemesanan = '".$_SESSION['id_pemesanan']."' ") or die("Query error!");
		$total_data_1 = mysql_fetch_array($query_data_1);
		$total_data_1 = $total_data_1['total_data_1'];
?>
	<h4>ID Pemesanan : <?php echo $_SESSION['id_pemesanan'] ;?></h4>
	<h4>Tgl. Pemesanan : <?php echo $_SESSION['tanggal'];?></h4>
	<h4>Nama Supplier : <?php echo $_SESSION['nama_supplier'];?></h4>
	<table border="1" width="95%" align="center" class="table">
		<thead>
			<td class="success" style="text-align:center;">NO.</td>
			<td class="success" style="text-align:center;">ID OBAT</td>
			<td class="success" style="text-align:center;">NAMA OBAT</td>
			<td class="success" style="text-align:center;">JUMLAH</td>
			<td class="success" style="text-align:center;">HARGA</td>
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
				<input hidden name='id_stok' value="<?php echo $list['id_stok']?>">
				<input hidden name='id_pemesanan' value="<?php echo $_SESSION['id_pemesanan'];?>">
				<input name='tanggal' value="<?php echo $_SESSION['tanggal'];?>">
			</td>
			<td align="center">
				<?php echo $list['nama_obat']; ?>
				<input hidden name='nama_obat' value="<?php echo $list['nama_obat']?>">
			</td>
			<td align="center">
				<?php echo $list['jumlah']; ?>
				<input hidden name='jumlah' value="<?php echo number_format($list['jumlah'])?>">
			</td>
			<td align="center">
			<?php
				$query_cek = mysql_query("SELECT COUNT(*) as total FROM detail_pembelian
							WHERE id_obat= '".$list['id_obat']."' AND id_pembelian = '".$_SESSION['id_pemesanan'] ."' ");
				$value = mysql_fetch_assoc($query_cek);
				
				$query_cek_harga = mysql_query("SELECT harga FROM detail_pembelian
							WHERE id_obat = '".$list['id_obat']."' AND id_pembelian = '".$_SESSION['id_pemesanan'] ."' ");
				$value_harga = mysql_fetch_assoc($query_cek_harga);
				
				if($value['total'] != 0){
			?>
				Rp. <input name='harga' disabled type="text" min="0" max="100000000" size="11" value="<?php echo number_format($value_harga['harga']);?>">
					<input name='harga' hidden type="text" min="0" max="100000000" size="11" value="<?php echo number_format($value_harga['harga']);?>">
					<button type='submit' disabled="disabled" name='check' class='btn btn-primary'>Checklist</button>
			<?php
				} else {
			?>
				Rp. <input name='harga' type="number" min="0" max="100000000" value="0">
					<button type='submit' name='check' class='btn btn-primary'>Checklist</button>
			<?php
				}
			?>
			</td>
			</form>
		</tr>
		<?php
			$no +=1;
			}
		?>
	</table>
		<div align="right">
	<?php
		$query_data_2 = mysql_query("SELECT COUNT(*) AS total_data_2 FROM detail_pembelian
							WHERE id_pembelian = '".$_SESSION['id_pemesanan']."' ") or die("Query error!");
		$total_data_2 = mysql_fetch_array($query_data_2);
		$total_data_2 = $total_data_2['total_data_2'];
		
		if ($total_data_1 > $total_data_2){
	?>
			<!-- <a class="btn btn-default" href="index.php?contain=pembelian_obat">Kembali</a> -->
	<?php
		} else {
	?>
		<form action="" method="POST">
			<button type='submit' name='proses_bayar' class='btn btn-primary'>Proses</button>
			<!-- <a class="btn btn-default" href="index.php?contain=pembelian_obat">Kembali</a> -->
		</form>
	<?php
		}
	?>
		</div>
	
<?php
	if(isset($_POST['check']))
	{
		$id_pemesanan = $_POST['id_pemesanan'];
		$id_obat = $_POST['id_obat'];
		$id_stok = $_POST['id_stok'];
		$nama_obat = $_POST['nama_obat'];
		$tanggal = $_POST['tanggal'];
		$jumlah = $_POST['jumlah'];
		$harga = $_POST['harga'];
		
		//$sub_total += $jumlah * $harga;
		
		// MENCARI NOMOR TERAKHIR ID_DET_PERMINTAAN_PROD
			$query = mysql_query ("SELECT COUNT(*)+1 AS jum FROM detail_pembelian");
			$jum = mysql_fetch_array($query);
			$jum = $jum['jum'];
		
		$sql_obat = mysql_query("INSERT INTO detail_pembelian (id_det_pembelian, id_pembelian, id_obat, harga)
							VALUES ('".$jum."', '".$id_pemesanan."', '".$id_obat."', '".$harga."') ");
							
		// MENCARI STOK OBAT
		$query_stok_obat = mysql_query("SELECT jumlah AS stok_obat FROM stok
							WHERE id_stok = '".$id_stok."' ") or die("Query error!");
		$stok_obat = mysql_fetch_array($query_stok_obat);
		$stok_obat = $stok_obat['stok_obat'];
		
				
		// MENAMBAH STOK OBAT dengan PESANAN
		$total_stok_obat = $stok_obat + $jumlah;
		$ubah_stok = mysql_query("UPDATE stok
								SET jumlah = '$total_stok_obat'
								WHERE id_stok='$id_obat'");
		
		// _________________________________________________
		// MENCARI SELISIH LEAD TIME dan UPDATE NILAI LEAD TIME
			date_default_timezone_set('Asia/Jakarta');
			$today = strtotime(date('Y-m-d'));
			$date_today = strtotime($_SESSION['tanggal']);
			
			$lead_time = ($today - $date_today)/86400;
		
			$update_leadtime = mysql_query("UPDATE stok
								SET lead_time = '".$lead_time."'
								WHERE id_stok='".$id_obat."' ");
		
		// UPDATE NILAI ROP
			// ambil data total used
			$query_used = mysql_query("SELECT used AS total_used FROM stok
							WHERE id_stok = '".$id_obat."' ") or die("Query used eror!");
			$total_used = mysql_fetch_array($query_used);
			$total_used = $total_used['total_used'];
			
			$new_rop = ($total_used * $lead_time) + 2;
			
			$update_leadtime = mysql_query("UPDATE stok
								SET rop = '".$new_rop."'
								WHERE id_stok='".$id_obat."' ");
		
		
		if ($query_stok_obat) {
			echo '<script languange="javascript">alert ("Pembelian Berhasil di Proses")</script>';
			echo '<script languange="javascript">window.location="index.php?contain=proses_pembelian"</script>';
		} else {
			echo '<script languange="javascript">alert ("Gagal")</script>';
			echo '<script languange="javascript">window.location="index.php?contain=proses_pembelian"</script>';
		}
	}
	
	if(isset($_POST['proses_bayar']))
	{	
		/*$rs = mysql_query("SELECT jumlah, harga FROM detail_pembelian
							JOIN obat ON detail_pembelian.id_obat = obat.id_obat
							JOIN detail_pemesanan ON obat.id_obat = detail_pemesanan.id_obat
							WHERE id_pembelian = '".$_SESSION['id_pemesanan']."' AND id_pemesanan = '".$_SESSION['id_pemesanan']."' ") or die("Query error!");
		$total = 0;
		while ($list = mysql_fetch_assoc($rs)) {
			$sub_total += jumlah * harga;
		}
		*/
		$update_pembelian = mysql_query("UPDATE pembelian
								SET tanggal_diterima = '".date('Y-m-d')."', jumlah = '0', id_pengguna = '".$_SESSION['id_supplier']."'
								WHERE id_pembelian='".$_SESSION['id_pemesanan']."' ");
								
		$update_pemesanan = mysql_query("UPDATE pemesanan
								SET status_pemesanan = 'DITERIMA'
								WHERE id_pemesanan='".$_SESSION['id_pemesanan']."' ");
		
		if($update_pembelian){
			echo '<script languange="javascript">alert ("Data Obat Berhasil Di Proses")</script>';
			echo '<script languange="javascript">window.location="index.php?contain=pembelian_obat"</script>';		
		}
		
		
	}
?>