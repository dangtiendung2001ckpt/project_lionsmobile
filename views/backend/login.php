<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Login</title>
    <link rel="stylesheet" type="text/css" href="public/backend/css/stylelogin.css" media="screen" />
</head>
<body>
<div class="container">
	<section id="content">
		<form action="index.php?module=backend&control=login&action=login" method="post">
			<h1>Đăng nhập admin</h1>
			<div>
				<input type="text" placeholder="Tên tài khoản"  name="username"/>
			</div>
			<div>
				<input type="password" placeholder="Mật khẩu"  name="password"/>
			</div>
			<div>
				<input type="submit" value="Đăng nhập" />
			</div>
		</form><!-- form -->
		<div class="button">
			<?php foreach (getFlashError() as $value){
			    echo $value . ' ';
            }?>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>