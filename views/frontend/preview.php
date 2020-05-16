
  <div class="wrap">
 <div class="main">
    <div class="content">
    	<div class="section group">
				<div class="cont-desc span_1_of_2">				
					<div class="grid images_3_of_2">
						<img src="public/common/images/<?php echo $product['img'];?>" alt="" />
					</div>
				<div class="desc span_3_of_2">
					<h2><?php echo $product['name'];?></h2>
                    <h2>Màu sắc:<?php echo $product['mau_sac'];?></h2>
                    <h2>Bộ nhớ trong:<?php echo $product['dung_luong'];?>GB</h2>
					<div class="price">
						<p>Giá: <span><?php echo format_currency($product['price']);?> VNĐ</span></p>
						<p>Màu sắc:
                            <br/>
                        <form action="index.php" method="get">
                            <input type="hidden" name="control" value="products" >
                            <input type="hidden" name="action" value="details">
                            <input type="hidden" name="id" value="<?php echo $product['product_id'];?>">
                            <?php
                            foreach ($color as $value){?>
                                <input type="submit" name="mau"  value="<?php echo $value['mau_sac'];?>">
                                <?php
                            }
                            ?>
                        </form>
                        </p>
                        <p>Dung lượng: <form action="index.php" method="get">
                            <input type="hidden" name="control" value="products" >
                            <input type="hidden" name="action" value="details">
                            <input type="hidden" name="id" value="<?php echo $product['product_id'];?>">
                            <?php
                            foreach ($data as $value){?>
                                <input type="submit" name="dung_luong" value="<?php echo $value['dung_luong'];?>GB">
                                <?php
                            }
                            ?>
                        </form>

                            </p>
					</div>
				<div class="add-cart">
					<form action="index.php?control=cart&action=cart&id=<?php echo $product['product_id']; ?>" method="post">
						<input type="number" style="width: 150px;" min="1" max="5" class="buyfield" name="soluong" value="1"/>
						<?php
                        if ($product['so_luong'] >0){
                            echo '<input type="submit" class="buysubmit" name="submit" value="Mua Ngay"/>';
                        }else{
                            echo '<input type="button" class="buysubmit"  value="Đã hết hàng"/>';
                        }
                        ?>
					</form>
				</div>
			</div>
	</div>
				<div class="rightsidebar span_3_of_1">
					<h2>Thông số kỹ thuật</h2>
					<ul>
                        <li><a href="">Hãng: <?php echo $product['category_name'];?></a></li>
				      <li><a href="">Màn hình: <?php echo $product['man_hinh'];?></a></li>
				      <li><a href="">Hệ điều hành: <?php echo $product['he_dieu_hanh'];?></a></li>
				      <li><a href="">Camera sau: <?php echo $product['camera_sau'];?></a></li>
                      <li><a href="">Camera trước: <?php echo $product['camera_truoc'];?></a></li>
                        <li><a href="">CPU: <?php echo $product['cpu'];?></a></li>
                        <li><a href="">RAM: <?php echo $product['ram'];?></a></li>
                        <li><a href="">Bộ nhớ trong: <?php echo $product['dung_luong'];?>GB</a></li>
                        <li><a href="">Dung lượng pin: <?php echo $product['dl_pin'];?></a></li>
                        <li><a href="">Bảo hành : 12 tháng</a></li>
                        <li><a href="">Hỗ trợ :<?php  foreach ($attribute as $value){
                                    echo $value['attribute_name']; echo ",";;
                                }
                                ?></a></li>
                    </ul>

 				</div>
 		</div>
 	</div>
     <div class="product-desc">
         <h2>Các sản phẩm tương tự</h2>
     </div>
     <div class="section group">
         <?php
         foreach ($offer as $item){?>
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

     <div class="product-desc">

         <h2>Bình luận đáng giá</h2>
         <div id="text" style="padding-top: 10px;"></div>
         <div class="section group" style="padding-left: 0px;">
             <div class="col span_2_of_3">
                 <div class="contact-form">


                         <span><label>Nội dung</label></span>
                         <input id="contentcmt" maxlength="300" type="text"   required pattern="\S+.*"/>
                         <div>
                             <input onclick="feeback()" type="button" value="Gửi">
                         </div>
                 </div>
             </div>
         </div>
         <?php foreach ($feedback as $value) { ?>
             <div class="div"    style="border-bottom: 1px dotted grey;padding-top: 10px;">
                 <span style="font-size: 15px;"><?php echo $value['user_name'];?>:</span>
                 <p style="font-family: arial;padding: 10px 0px 10px 10px;"> - <?php echo $value['content'];?></p>
             </div>
             <?php
         }
         ?>
         <div id="demo" class="demo"></div>
         <input id="pro_id" type="hidden" value="<?php echo $_GET['id']?>">
        <div style="padding-top: 10px;padding-bottom: 10px;"><input id="button" <?php if ($totalpage < 2){ echo 'style= "display : none"';} ?> onclick="load_ajax()" type="button" value="Xem thêm bình luận"> </div>

     </div>
	</div>
  </div>




<script>
    function load_ajax() {

        $.ajax({
            url : "index.php?control=products&action=test",
            type : "post",
            dataType : "json",
            data : {
                    product_id: $('#pro_id').val(),
                    offset: $('.div').length,
            },
            success : function (response){
                console.log('r:');
                console.log(response);
                if (!response){
                    return;
                }
                if (response.is_last === true){
                    console.log('xoa_button');
                    document.getElementById("button").style.display = 'none';
                }
                return load(response.html ? response.html : '');
            },
            error: function(xhr, status, error) {
                console.log('error')
                console.log(error)
            }
        });

    }

    function feeback() {
        $.ajax({
            url : "index.php?control=feedback&action=addnew",
            type : "post",
            dataType:"json",
            data : {
                product_id: $('#pro_id').val(),
                content: $('#contentcmt').val(),
            },
            success : function (result){
                if (result.html === true ){
                  return   location.reload();
                }else {
                    return content(result.text);
                }

            }
        });

    }

    function content(key) {
        document.getElementById('contentcmt').value = "";
        document.getElementById("text").innerHTML = key;
    }


    var div=$(".demo");
   function load(key) {
       div.after(key);
   }
</script>