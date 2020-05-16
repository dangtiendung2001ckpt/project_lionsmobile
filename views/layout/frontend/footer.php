 <div class="footer">
   	  <div class="wrapper">	
	     <div class="section group">
				<div class="col_1_of_4 span_1_of_4">
						<h4>Mở đầu</h4>
						<ul>
						<li><a href="#">Cảm ơn bạn đã sử dụng dịch vụ của chúng tôi</a></li>
						<li><a href="#">Sự hài lòng của quý vị là nguồn động lực to lớn đối với chúng tôi</a></li>
						<li><a href="#">Chúng tôi cam kết mang đến cho người dùng sản phẩm chất lượng và mức giá tốt nhất</a></li>
						</ul>
					</div>
				<div class="col_1_of_4 span_1_of_4">
					<h4>Giới thiệu</h4>
						<ul>
						<li><a href="#">Là cửa hàng tiên phog trong lĩnh vực công nghệ</a></li>
						<li><a href="#">Liên kết với các doanh nghiệp lớn</a></li>
						<li><a href="#">Đảm bảo chất lượng tốt nhất đến tay người dùng</a></li>
						<li><a href="#">Địa chỉ: 19 Nguyễn Trãi, Ngã Tư Sở, Đống Đa, Hà Nội </a></li>
						</ul>
				</div>
				<div class="col_1_of_4 span_1_of_4">
					<h4>Tiêu chí </h4>
						<ul>
							<li><a href="#">Cung cấp sản phẩm chất lượng</a></li>
							<li><a href="#">Giá cả ưu đãi</a></li>
							<li><a href="#">Phục vụ nhiệt tình chu đáo</a></li>
							<li><a href="#">Lấy sự tin tưởng và hài lòng của khách hàng đặt lên hàng đầu
							</a></li>
							<li><a href="#">Kiếm tìm những vẻ đẹp công nghệ mới đưa tới tay người sử dụng</a></li>
						</ul>
				</div>
				<div class="col_1_of_4 span_1_of_4">
					<h4>Hỗ trợ</h4>
						<ul>
							<li><span>+88-01713458599</span></li>
							<li><span>+88-01813458552</span></li>
						</ul>
						<div class="social-icons">
							<h4>Follow Us</h4>
					   		  <ul>
							      <li class="facebook"><a href="#" target="_blank"> </a></li>
							      <li class="twitter"><a href="#" target="_blank"> </a></li>
							      <li class="googleplus"><a href="#" target="_blank"> </a></li>
							      <li class="contact"><a href="#" target="_blank"> </a></li>
							      <div class="clear"></div>
						     </ul>
   	 					</div>
				</div>
			</div>
			<div class="copy_right">
				<p>Training with live project &amp; All rights Reseverd </p>
		   </div>
     </div>
    </div>
    <script type="text/javascript">
		$(document).ready(function() {
			/*
			var defaults = {
	  			containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 1200,
				easingType: 'linear' 
	 		};
			*/
			
			$().UItoTop({ easingType: 'easeOutQuart' });
			
		});
	</script>
    <a href="#" id="toTop" style="display: block;"><span id="toTopHover" style="opacity: 1;"></span></a>
    <link href="public/frontend/css/flexslider.css" rel='stylesheet' type='text/css' />
	  <script defer src="public/frontend/js/jquery.flexslider.js"></script>
	  <script type="text/javascript">
		$(function(){
		  SyntaxHighlighter.all();
		});
		$(window).load(function(){
		  $('.flexslider').flexslider({
			animation: "slide",
			start: function(slider){
			  $('body').removeClass('loading');
			}
		  });
		});
	  </script>





 <!-- Load Facebook SDK for JavaScript -->
 <div id="fb-root"></div>
 <script>
     window.fbAsyncInit = function() {
         FB.init({
             xfbml            : true,
             version          : 'v7.0'
         });
     };

     (function(d, s, id) {
         var js, fjs = d.getElementsByTagName(s)[0];
         if (d.getElementById(id)) return;
         js = d.createElement(s); js.id = id;
         js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
         fjs.parentNode.insertBefore(js, fjs);
     }(document, 'script', 'facebook-jssdk'));</script>

 <!-- Your customer chat code -->
 <div class="fb-customerchat"
      attribution=setup_tool
      page_id="109536534085096"
      logged_in_greeting="Chào bạn! Chúng tôi có thể giúp gì cho bạn?"
      logged_out_greeting="Chào bạn! Chúng tôi có thể giúp gì cho bạn?">
 </div>
 </body>
 </html>