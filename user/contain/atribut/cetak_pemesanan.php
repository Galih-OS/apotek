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
		header("Content-Disposition: attachment;Filename=Laporan-Pemesanan-".date('F-Y', $date).".doc");
		echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows-1252\">";
?>
	<table width="100%">
		<tr>
			<td align="center">
				<h3><b>LAPORAN PEMESANAN<br/>
				APOTEK CITRA HUSADA<br/>
				PERIODE <?php echo strtoupper(date('F Y', $date)); ?><br/></b></h3>
				<hr/>
			</td>
		</tr>
	</table>
	<br/>
	<?php
		include "../../../include/connect.php";
		$hasil = mysql_query("SELECT * FROM pemesanan
								JOIN pengguna ON pemesanan.id_pengguna = pengguna.id_pengguna
								JOIN supplier ON pemesanan.id_supplier = supplier.id_supplier
								WHERE MONTH(pemesanan.tanggal) = '".substr(date('Y-m', $date), -1, 2)."'
								ORDER BY pemesanan.tanggal ASC");
	?>
		<table border="1" width="95%" align="center" class="table">
			<thead>
				<td class="success" style="text-align:center;">NO.</td>
				<td class="success" style="text-align:center;">ID PEMESANAN</td>
				<td class="success" style="text-align:center;">TANGGAL PEMESANAAN</td>
				<td class="success" style="text-align:center;">NAMA SUPPLIER</td>
				<td class="success" style="text-align:center;">JUMLAH</td>
				<td class="success" style="text-align:center;">DI ORDER OLEH</td>
				<td class="success" style="text-align:center;">STATUS</td>
			</thead>
		<?php
				$no = 1;
				while ($list = mysql_fetch_assoc($hasil)) {
		?>
			<tr>
				<td align="center"><?php echo $no;?></td>
				<td align="center">
					<?php echo $list['id_pemesanan']; ?>
				</td>
				<td align="center">
					<?php echo $list['tanggal']; ?>
				</td>
				<td align="center">
					<?php echo $list['nama_supplier']; ?>
				</td>
				<td align="center">
					<?php echo $list['jumlah']; ?>
				</td>
				<td align="center">
					<?php echo $list['nama_pengguna']; ?>
				</td>
				<td align="center">
					<?php echo $list['status_pemesanan']; ?>
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