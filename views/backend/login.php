<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Login</title>
    <link rel="stylesheet" type="text/css" href="public/backend/css/stylelogin.css" media="screen" />
</head>
<body>
<div class="container">
	<section id="content">
		<form action="index.php?module=backend&control=user&action=login" method="post">
			<h1>Đăng nhập admin</h1>
			<div>
				<input type="text" placeholder="Tên tài khoản" required="" name="username"/>
			</div>
			<div>
				<input type="password" placeholder="Mật khẩu" required="" name="password"/>
			</div>
			<div>
				<input type="submit" value="Đăng nhập" />
			</div>
		</form><!-- form -->
		<div class="button">
			<?php echo replace();?>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>