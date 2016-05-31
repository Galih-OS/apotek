<!DOCTYPE html>
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

	<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/signin.css" rel="stylesheet">
	<link href="css/style_captcha.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body style="max-width: 100%; overflow-x: hidden; background-color:lightgrey;">
	
	<div class="container">
      <form class="form-signin" action="include/login.php" method="POST">
        <h2 class="form-signin-heading">Login</h2>
        <label for="username" class="sr-only">Username</label>
			<input type="text" name="username" class="form-control" placeholder="Username" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
			<input type="password" name="password" class="form-control" placeholder="Password" required>
		<div class="form-group">
			<center><img src="include/captcha.php"/>
			<label for="captcha">Input Kode pada Gambar</label></center>
			<input type="text" class="form-control" name="code" id="code">
		</div>
        <button class="btn btn-lg btn-primary btn-block" type="submit" name="login">Sign in</button>
      </form>

    </div>
	
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="js/penting.js"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="js/bootstrap.min.js"></script>
  </body>
</html>
