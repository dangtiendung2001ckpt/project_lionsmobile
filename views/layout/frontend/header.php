<!DOCTYPE HTML>
<head>
    <title>Lions điện thoại di động cho mọi người</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link href="public/frontend/css/style.css" rel="stylesheet" type="text/css" media="all"/>
    <link href="public/frontend/css/menu.css" rel="stylesheet" type="text/css" media="all"/>
    <script src="public/frontend/js/jquerymain.js"></script>
    <script src="public/frontend/js/script.js" type="text/javascript"></script>
    <script type="text/javascript" src="public/frontend/js/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="public/frontend/js/nav.js"></script>
    <script type="text/javascript" src="public/frontend/js/move-top.js"></script>
    <script type="text/javascript" src="public/frontend/js/easing.js"></script>
    <script type="text/javascript" src="public/frontend/js/nav-hover.js"></script>
    <script type="text/javascript" src="public/frontend/js/paging.js"></script>
    <link href='http://fonts.googleapis.com/css?family=Monda' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Doppio+One' rel='stylesheet' type='text/css'>
    <script type="text/javascript">
        $(document).ready(function($){
            $('#dc_mega-menu-orange').dcMegaMenu({rowItems:'4',speed:'fast',effect:'fade'});
        });
    </script>
</head>
<body class=" <?php echo getCurrentControl(); ?> " >

<div class="wrap"  >
		<div class="header_top">
			<div class="logo">
				<a href="index.php"><img style="height:150px;" src="public/common/images/logolions1.jpg" alt="" /></a>
			</div>
			  <div class="header_top_right">
			    <div class="search_box">
				    <form action="index.php" method="get">
				    	<input type="text" name="key" value="" placeholder="Bạn tìm gì...." onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '';}">
                        <input type="hidden" name="control" value="products">
                        <input type="hidden" name="action" value="searchPro">
                        <input type="submit"  value="Tìm kiếm">
				    </form>
			    </div>
			    <div class="shopping_cart">
					<div style="width: 100%;" class="cart">
						<a style="width: 100%;" href="index.php?control=cart" title="View my shopping cart" rel="nofollow">
								<span class="cart_title">Giỏ hàng của bạn</span>
							</a>
						</div>
			      </div>
		    <?php if (isset($_SESSION['username'])){
                echo ' <div class="login"><a style="font-size: 17px;" href="index.php?control=login&action=logout">Đăng xuất</a></div>';
            }else{
              echo ' <div class="login"><a style="font-size: 16px;" href="index.php?control=login">Đăng nhập</a></div>';
            }  ?>
		 <div class="clear"></div>
                  <span style="float: right;color: red;padding-top: 5px;"><?php if (isset($_SESSION['username'])){ echo 'Xin chào : '.$_SESSION["username"].'';} ?></span>
	 </div>
	 <div class="clear"></div>
 </div>
</div>