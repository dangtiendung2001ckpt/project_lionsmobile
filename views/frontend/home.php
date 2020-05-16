	<div class="wrap" > 
	<div class="header_bottom">
		<div class="header_bottom_left">
			<div class="section group">
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="index.php?control=products&action=cat&catid=2"> <img src="public/common/images/ip.png" alt="" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2>Iphone</h2>
						<p>Vẻ đẹp hoàn thiện,thiết kế sang trọng</p>
						<div class="button"><span><a href="index.php?control=products&action=cat&catid=2">Các sản phẩm</a></span></div>
				   </div>
			   </div>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						  <a href="index.php?control=products&action=cat&catid=1"><img src="public/common/images/ss.jpg" alt="" / ></a>
					</div>
					<div class="text list_2_of_1">
						  <h2>Samsung</h2>
						  <p>Vẻ đẹp của xu hướng,chi tiết tinh xảo</p>
						  <div class="button"><span><a href="index.php?control=products&action=cat&catid=1">Các sản phẩm</a></span></div>
					</div>
				</div>
			</div>
			<div class="section group">
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="index.php?control=products&action=cat&catid=3"> <img src="public/common/images/oppof9.jpg" alt="" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2>Oppo</h2>
						<p>Chuyên gia selfie,Camera dẫn đầu xu thế</p>
						<div class="button"><span><a href="index.php?control=products&action=cat&catid=3">Các sản phẩm</a></span></div>
				   </div>
			   </div>			
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						  <a href="index.php?control=products&action=cat&catid=5"><img src="public/common/images/hw.jpg" alt="" /></a>
					</div>
					<div class="text list_2_of_1">
						  <h2>Huawei</h2>
						  <p>Vẻ đẹp thời thượng,cấu hình mạnh mẽ</p>
						  <div class="button"><span><a href="index.php?control=products&action=cat&catid=5">Các sản phẩm</a></span></div>
					</div>
				</div>
			</div>
		  <div class="clear"></div>
		</div>
			 <div class="header_bottom_right_images">
		   <!-- FlexSlider -->
             
			<section class="slider">
				  <div class="flexslider">
					<ul class="slides">
						<li><img src="public/common/images/iphone11.jpg" alt=""/></li>
						<li><img src="public/common/images/ssnote10.jpg" alt=""/></li>
						<li><img src="public/common/images/oppo11pro.jpg" alt=""/></li>
						<li><img src="public/common/images/huawei.jpg" alt=""/></li>
				    </ul>
				  </div>
	      </section>
<!-- FlexSlider -->
	    </div>
	  <div class="clear"></div>
  </div>	

 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3>Sản phẩm nổi bật</h3>

    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">
              <?php
              foreach ($products as $item){?>
                  <div class="grid_1_of_4 images_1_of_4" style="margin:0.4%;">
                      <a href="index.php?control=products&action=details&id=<?php echo $item['product_id'];?>"><img style="width: 218px;height: 180px;" src="public/common/images/<?php echo $item['img'];?>" alt="" /></a>
                      <h2><?php echo $item['name'];?></h2>
                      <p><span class="price"><?php echo format_currency($item['price']);?>VNĐ</span></p>
                      <span>Phụ kiện: <?php echo $item['phukien'];?></span>
                      <div class="button"><span><a href="index.php?control=products&action=details&id=<?php echo $item['product_id'];?>" class="details">Chi tiết</a></span></div>
                  </div>

                  <?php
              }
              ?>

			</div>
			<div class="content_bottom">
    		<div class="heading">
    		<h3>Sản phẩm mới</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
			<div class="section group">
                <?php
                foreach ($products as $item){?>
                    <div class="grid_1_of_4 images_1_of_4" style="margin:0.4%;">
                        <a href="index.php?control=products&action=details&id=<?php echo $item['product_id'];?>"><img style="width: 218px;height: 180px;" src="public/common/images/<?php echo $item['img'];?>" alt="" /></a>
                        <h2><?php echo $item['name'];?></h2>
                        <p><span class="price"><?php echo format_currency($item['price']);?>VNĐ</span></p>
                        <span>Phụ kiện: <?php echo $item['phukien'];?></span>
                        <div class="button"><span><a href="index.php?control=products&action=details&id=<?php echo $item['product_id'];?>" class="details">Chi tiết</a></span></div>
                    </div>

                    <?php
                }
                ?>
			</div>
    </div>
 </div>
</div>