	<ul class="nav nav-tabs">
		<li role="presentation" class="active"><a href="index.php?side=login">Login</a></li>
		<li role="presentation" class=""><a href="index.php?side=register">Registrasi</a></li>
	</ul>
<div class="panel panel-default">
  <div class="panel-body">
	<form action="include/login.php" method="POST">
	  <div class="form-group">
		<label for="username">Username</label>
		<input type="text" class="form-control" name="username" placeholder="" autofocus>
	  </div>
	  <div class="form-group">
		<label for="password">Password</label>
		<input type="password" class="form-control" name="password" placeholder="">
	  </div>
	  <div class="form-group">
		<img src="include/captcha.php"/><br/>
		<label for="captcha">Input Kode Gambar</label>
		<input type="text" class="form-control" name="code" id="code">
	  </div>
	  <div align="right">
		<button type="submit" name="" class="btn btn-success">Login</button>
	  </div>
	</form>
  </div>
</div>