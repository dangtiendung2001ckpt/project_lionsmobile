<?php
  header("Cache-Control: no-cache, must-revalidate");
  header("Pragma: no-cache"); 
  header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
  header("Cache-Control: max-age=2592000");
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>Admin</title>
    <link rel="stylesheet" type="text/css" href="public/backend/css/reset.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="public/backend/css/text.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="public/backend/css/grid.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="public/backend/css/layout.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="public/backend/css/nav.css" media="screen" />
    <link href="public/backend/css/table/demo_page.css" rel="stylesheet" type="text/css" />
    
    <!-- BEGIN: load jquery -->
    <script src="public/backend/js/jquery-1.6.4.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="public/backend/js/jquery-ui/jquery.ui.core.min.js"></script>
    <script src="public/backend/js/jquery-ui/jquery.ui.widget.min.js" type="text/javascript"></script>
    <script src="public/backend/js/jquery-ui/jquery.ui.accordion.min.js" type="text/javascript"></script>
    <script src="public/backend/js/jquery-ui/jquery.effects.core.min.js" type="text/javascript"></script>
    <script src="public/backend/js/jquery-ui/jquery.effects.slide.min.js" type="text/javascript"></script>
    <script src="public/backend/js/jquery-ui/jquery.ui.mouse.min.js" type="text/javascript"></script>
    <script src="public/backend/js/jquery-ui/jquery.ui.sortable.min.js" type="text/javascript"></script>
    <script src="public/backend/js/table/jquery.dataTables.min.js" type="text/javascript"></script>
    <!-- END: load jquery -->
    <script type="text/javascript" src="public/backend/js/table/table.js"></script>
    <script src="public/backend/js/setup.js" type="text/javascript"></script>
	 <script type="text/javascript">
        $(document).ready(function () {
            setupLeftMenu();
		    setSidebarHeight();
        });
    </script>

</head>
<body>
    <div class="container_12">
        <div class="grid_12 header-repeat">
            <div id="branding">
                <div class="floatleft logo">
                    <img src="public/backend/img/livelogo.png" alt="Logo" />
				</div>
				<div class="floatleft middle">
					<h1>Lionsmobile</h1>
				</div>
                <div class="floatright">
                    <?php if (isset($_SESSION['admin'])){
                        echo '<div class="floatleft">
                        <img src="public/backend/img/img-profile.jpg" alt="Profile Pic" /></div>
                    <div class="floatleft marginleft10">
                        <ul class="inline-ul floatleft">
                            <li>Hello Admin</li>
                            <li><a href="index.php?module=backend&control=login&action=logout">Logout</a></li>
                        </ul>
                    </div>';
                    }else{
                        echo '
                            <li><a href="index.php?module=backend&control=login">Đăng nhập</a></li>';
                    }
                    ?>
                </div>
                <div class="clear">
                </div>
            </div>
        </div>
        <div class="clear">
        </div>
        <div class="grid_12">
            <ul class="nav main">
                <li class="ic-dashboard"><a href="<?php echo pages('statistical','')?>"><span>Thống kê</span></a> </li>
				<li class="ic-typography"><a href="<?php echo pages('admin','viewchangepass')?>"><span>Đổi mật khẩu</span></a></li>
				<li class="ic-grid-tables"><a href="<?php echo pages('feedback','')?>"><span>Phản hồi khách hàng</span></a></li>
                <li class="ic-dashboard"><a href="<?php echo pages('chartsl','')?>"><span>Biểu đồ % số lượng sản phẩm bán ra</span></a> </li>
                <li class="ic-dashboard"><a href="<?php echo pages('chartprice','')?>"><span>Biểu đồ % giá sản phẩm bán ra</span></a> </li>
            </ul>
        </div>
        <div class="clear">
        </div>
    