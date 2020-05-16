<div class="wrap">
    <div class="main">
        <div  class="content">
            <div class="cartoption">
                <div class="cartpage">
                    <div  style="color: green;font-size: 23px;text-align: center;"> <?php if (isset($_SESSION['cart']) && !empty($_SESSION["cart"])){
                        echo "Giỏ hàng của bạn";
                        }else{
                        echo "Bạn chưa có sản phẩm nào trong giỏ hàng";
                        } ?> </div>
                    <table <?php if (empty($_SESSION["cart"])) { echo "style='display:none'";} ?> class="tblone">
                        <tr>
                            <th width="20%">Sản Phẩm</th>
                            <th width="15%">Giá</th>
                            <th width="15%">Màu</th>
                            <th width="15%">Bộ nhớ</th>
                            <th width="25%">Số lượng</th>
                            <th width="25%">Thành tiền</th>
                            <th width="5%">Xóa</th>
                        </tr>
                        <?php
                        if (isset($_SESSION['cart']) && !empty($_SESSION["cart"])) {
                            foreach ($_SESSION["cart"] as $value) {
                                ?>
                                <tr>
                                    <td><?php echo checkcart($value, 'name'); ?></td>
                                    <td><?php echo format_currency(checkcart($value, 'price'));if (isset($_SESSION['cart']) && !empty($_SESSION["cart"])) { echo " VNĐ";} ?></td>
                                    <td><?php echo checkcart($value, 'mau_sac'); ?></td>
                                    <td><?php echo checkcart($value, 'dung_luong');if (isset($_SESSION['cart']) && !empty($_SESSION["cart"])) { echo "GB";} ?></td>
                                    <td><form action="index.php?control=cart&action=cart&id=<?php echo checkcart($value, 'product_id'); ?>" method="post">
                                            <input type="number" min="1" max="5" name="soluong" value="<?php echo checkcart($value, 'qty'); ?>">
                                            <input type="submit" name="submit" value="Lưu">
                                        </form></td>
                                    <td><?php echo format_currency(checkcart($value, 'tong_gia'));if (isset($_SESSION['cart']) && !empty($_SESSION["cart"])) { echo " VNĐ";}  ?></td>
                                    <td><a href="index.php?control=cart&action=del&id=<?php echo checkcart($value, 'product_id'); ?>">X</a></td>
                                </tr>
                                <?php
                            }
                        }
                        ?>


                    </table>
                    <table style="float:right;text-align:left;" width="40%">

                        <tr>
                            <th></th>
                            <td><?php if (isset($_SESSION['cart']) && !empty($_SESSION["cart"])){
                                    $tong=0;
                                    foreach ($_SESSION['cart'] as $value){
                                        $tong += $value['tong_gia'];
                                    }
                                    echo "Tổng đơn hàng: ".format_currency($tong)." VNĐ";
                                }
                                ?>

                        </tr>
                    </table>
                </div>
                <div style="color: green;font-size: 23px;text-align: center"><?php if (isset($_GET['suc']) && $_GET['suc'] == "suc"){echo "Nhân viên sẽ gọi cho bạn.Cảm ơn bạn đã mua hàng ";} ?></div>
                <div <?php if (empty($_SESSION["cart"])) { echo "style='display:none'";} ?> class="shopping">
                    <div class="shopleft">
                        <a href="index.php?control=products"> <img src="public/common/images/shop.png" alt="" /></a>
                    </div>
                    <div class="shopright">
                        <a href="index.php?control=cart&action=order&int=change"> <img src="public/common/images/check.png" alt="" /></a>
                    </div>
                </div>
            </div>
            <div class="clear"></div>



            <div <?php if (empty($cart)){ echo "style='display:none'";} ?>>
                <div style="padding-top:100px;color: green;font-size: 23px;padding-left: 400px; " >Các sản phẩm bạn đã đặt</div>
                <table style="padding-top: 100px;" class="tblone">

                    <tr>
                        <th>Mã đơn hàng</th>
                        <th width="20%">Sản Phẩm</th>
                        <th width="15%">Màu</th>
                        <th width="15%">Bộ nhớ</th>
                        <th width="5%">Số lượng</th>
                        <th width="25%">Tổng tiền</th>
                        <th width="25%">Trạng thái</th>
                    </tr>
                    <?php
                    if (isset($cart) && !empty($cart)) {
                        foreach ($cart as $value) {
                            ?>
                            <tr>
                                <td><?php echo $value['order_id'];?></td>
                                <td><?php echo $value['name'];?></td>
                                <td><?php echo $value['mau_sac'];?></td>
                                <td><?php echo $value['dung_luong'];echo 'GB';?></td>
                                <td><?php echo $value['sl'];?></td>
                                <td><?php echo format_currency($value['price']);echo "VNĐ";?></td>
                                <td><?php if ($value['trang_thai'] == "chốt đơn"){ echo "Đang chờ sử lý";}else{ echo "Đang giao hàng";} ?> </td>
                                </tr>
                            <?php
                        }
                    }
                    ?>


                </table>
            </div>




        </div>
    </div>
</div>