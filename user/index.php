<!DOCTYPE html>
<?php
	session_start(); 
	if(isset($_SESSION['id'])){
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Sistem Informasi Apotek</title>

	<link href="../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body style="background-color:white;">
		
	<?php		
		switch ((isset($_GET['contain']) ? $_GET['contain'] : '')) {
			case 'penjualan':
				include "navbar/navbar_menu.php";
				include "contain/submit_penjualan.php";
				break;
			case 'pemesanan_obat':
				include "navbar/navbar_menu.php";
				include "contain/pemesanan_obat.php";
				break;
			case 'tambah_pemesanan':
				include "navbar/navbar_menu_pemesanan.php";
				include "contain/submit_pemesanan.php";
				break;
			case 'pembelian_obat':
				include "navbar/navbar_menu.php";
				include "contain/pembelian_obat.php";
				break;
			case 'proses_pembelian':
				include "navbar/navbar_menu_pembelian.php";
				include "contain/proses_pembelian.php";
				break;
			case 'master_obat':
				include "navbar/navbar_menu.php";
				include "contain/master_obat.php";
				break;
			case 'master_satuan':
				include "navbar/navbar_menu.php";
				include "contain/master_satuan.php";
				break;
			case 'master_supplier':
				include "navbar/navbar_menu.php";
				include "contain/master_supplier.php";
				break;
			case 'laporan_penjualan':
				include "navbar/navbar_menu.php";
				include "contain/laporan_penjualan.php";
				break;
			case 'laporan_pembelian':
				include "navbar/navbar_menu.php";
				include "contain/laporan_pembelian.php";
				break;
			case 'laporan_pemesanan':
				include "navbar/navbar_menu.php";
				include "contain/laporan_pemesanan.php";
				break;
			case 'profile':
				include "navbar/navbar_menu.php";
				include "contain/profile.php";
				break;
			default:
				include "navbar/navbar_default.php";
				include "contain/default.php";
				break;
		}
	?>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="../js/penting.js"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="../js/bootstrap.min.js"></script>
  </body>
</html>
<?php
}else{
	echo '<script languange="javascript">alert ("Silahkan login terlebih dahulu")</script>';
	echo '<script languange="javascript">window.location="../index.php"</script>';
}
?>