<?php
	session_start();
	if($_POST['code'] == $_SESSION['rand_code']) {
		unset($_SESSION['rand_code']);
		//session_start(); 		//mulai session, krena kita akan menggunakan session pd file php ini
		include 'connect.php'; 		//hubungkan dengan config.php untuk berhubungan dengan database
		$username=$_POST['username']; 	//tangkap data yg di input dari form login input username
		$password=base64_encode($_POST['password']); 	//tangkap data yg di input dari form login input password
		
		$query=mysql_query("select * from pengguna where username='$username' and password='$password'");	 //melakukan pengampilan data dari database untuk di cocokkan
		$xxx=mysql_num_rows($query);	 //melakukan pencocokan
		if($xxx){ 		// melakukan pemeriksaan kecocokan dengan percabangan.
			while ($row=mysql_fetch_assoc($query)) {
				$dbusername=$row['username'];
				$dbpassword=$row['password'];
				$dbid=$row['id_pengguna'];
				$dbnama=$row['nama_pengguna'];
				$status=$row['status_pengguna'];
			}
			
			if ($username == $dbusername && $password == $dbpassword && $status == 'ADMIN'){
				//session_start();
				$_SESSION['id'] = $dbid;
				$_SESSION['status'] = $status;
				$_SESSION['nama_pengguna'] = $dbnama;
				echo '<script languange="javascript">alert ("Login berhasil, Login Sebagai Admin")</script>';
				echo '<script languange="javascript">window.location="../admin/"</script>';
			} else if ($username == $dbusername && $password == $dbpassword && $status == 'ASSAPOTEKER'){
				//session_start();
				$_SESSION['id'] = $dbid;
				$_SESSION['status'] = $status;
				$_SESSION['nama_pengguna'] = $dbnama;
				echo '<script languange="javascript">alert ("Login berhasil, Login Sebagai Pengguna")</script>';
				echo '<script languange="javascript">window.location="../user/"</script>';
			} else if ($username == $dbusername && $password == $dbpassword && $status == 'OWNER'){
				//session_start();
				$_SESSION['id'] = $dbid;
				$_SESSION['status'] = $status;
				$_SESSION['nama_pengguna'] = $dbnama;
				echo '<script languange="javascript">alert ("Login berhasil, Selamat datang '.$dbnama.'")</script>';
				echo '<script languange="javascript">window.location="../owner/"</script>';
			}
		}else{				//jika tidak tampilkan pesan gagal login
			echo '<script languange="javascript">alert ("Username/Password Salah, Login Gagal")</script>';
			echo '<script languange="javascript">window.location="../index.php"</script>';
		}
	} else {
		echo '<script languange="javascript">alert ("Harap isi dengan benar")</script>';
		echo '<script languange="javascript">window.location="../index.php"</script>';
	}
?>