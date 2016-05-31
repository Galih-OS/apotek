<?php
if(isset($_POST['tambah']))
{
	session_start();
	if($_POST['code'] == $_SESSION['rand_code']) {
		include 'connect.php';
		$query = mysql_query ("select max(no)+1 AS jum from master_karyawan");
		$jum = mysql_fetch_array($query);
		$jum = $jum['jum'];
		if ($jum < 1) {
			$jum = 1;
		}
	
		$nama_karyawan = strtoupper($_POST['nama_karyawan']);
		$username = $_POST['username'];
		$password = $_POST['password'];
		$id_departemen = $_POST['id_departemen'];
		$status = $_POST['status'];
		
		$sql = mysql_query ("INSERT INTO master_karyawan (no, id_karyawan, nama_karyawan, username, password, status, id_departemen)
								VALUES ('".$jum."', 'kar".$jum."', '".$nama_karyawan."', '".$username."', '".$password."', '".$status."', '".$id_departemen."')");
		
		if ($sql) {
				unset($_SESSION['rand_code']);
				echo '<script languange="javascript">alert ("Data Sukses Di Tambahkan")</script>';
				echo '<script languange="javascript">window.location="../index.php?contain=home"</script>';
			} else {
				echo '<script languange="javascript">alert ("Data Gagal Di Simpan")</script>';
				echo '<script languange="javascript">window.location="../index.php?contain=home"</script>';
			}
	} else {
		echo '<script languange="javascript">alert ("Input Captcha dengan benar")</script>';		
		echo '<script languange="javascript">window.location="../index.php?side=register"</script>';
	}
}
?>