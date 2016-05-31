<!DOCTYPE html>
<?php
session_start(); 
if(isset($_SESSION['id']))
{
?>
<head>
	<style type="text/css">
		#form-header {
            font-size: 12px;
			font-family: arial;
        }
		td {
            font-size: 12px;
			text-decoration: none;
			font-family: arial;
        }
	</style>
</head>
<?php
	if(isset($_POST['cetak']))
	{
		$data_bulan = $_POST['data_bulan'];
		$date = strtotime($data_bulan);
		
		header("Content-type: application/vnd.ms-word");
		header("Content-Disposition: attachment;Filename=Laporan-Penjualan-".date('F-Y', $date).".doc");
		echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows-1252\">";
?>
	<table width="100%">
		<tr>
			<td align="center">
				<h3><b>LAPORAN PENJUALAN<br/>
				APOTEK CITRA HUSADA<br/>
				PERIODE <?php echo strtoupper(date('F Y', $date)); ?><br/></b></h3>
				<hr/>
			</td>
		</tr>
	</table>
	<br/>
	<?php
		include "../../../include/connect.php";
		$hasil = mysql_query("SELECT * FROM penjualan
							JOIN pengguna ON penjualan.id_pengguna = pengguna.id_pengguna
							JOIN detail_penjualan ON penjualan.id_penjualan = detail_penjualan.id_penjualan
							WHERE MONTH(penjualan.tanggal_penjualan) = '".substr(date('Y-m', $date), -1, 2)."'
							ORDER BY penjualan.tanggal_penjualan ASC");
	?>
		<table border="1" width="95%" align="center" class="table">
			<thead>
				<td class="success" style="text-align:center;">NO.</td>
				<td class="success" style="text-align:center;">ID PENJUALAN</td>
				<td class="success" style="text-align:center;">TANGGAL TRANSAKSI</td>
				<td class="success" style="text-align:center;">JUMLAH ITEM</td>
				<td class="success" style="text-align:center;">DI TANGANI OLEH</td>
				<td class="success" style="text-align:center;">JUMLAH TRANSAKSI</td>
			</thead>
		<?php
				$no = 1;
				while ($list = mysql_fetch_assoc($hasil)) {
		?>
			<tr>
				<td align="center"><?php echo $no;?></td>
				<td align="center">
					<?php echo $list['id_penjualan']; ?>
				</td>
				<td align="center">
					<?php echo $list['tanggal_penjualan']; ?>
				</td>
				<td align="center">
					<?php echo $list['jumlah']; ?>
				</td>
				<td align="center">
					<?php echo $list['nama_pengguna']; ?>
				</td>
				<td align="center">
					<?php echo $list['total_penjualan']; ?>
				</td>
			</tr>
			<?php
				$no +=1;
				}
			?>
		</table>
		
<?php
	} else {
		echo '<script languange="javascript">alert ("Masukkan Data Dengan Benar<")</script>';
		//echo '<script languange="javascript">window.location="../index.php"</script>';
	}
		
} else{
	echo '<script languange="javascript">alert ("Silahkan login terlebih dahulu")</script>';
	//echo '<script languange="javascript">window.location="../index.php"</script>';
}
?>