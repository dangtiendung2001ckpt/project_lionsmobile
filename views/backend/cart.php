
<div class="grid_10">
    <div class="box round first grid">
        <h2>Các đơn hàng</h2>
        <div class="block">
            <table class="data display " id="example">
                <thead>
                <tr>
                    <th>Đơn hàng</th>
                    <th>Sản phẩm</th>
                    <th>Màu</th>
                    <th>Bộ nhớ trong</th>
                    <th>Số lượng</th>
                    <th>Giá</th>
                    <th>Khách hàng</th>
                    <th>SĐT</th>
                    <th>Địa chỉ giao hàng</th>
                    <th>Ngày</th>
                    <th>Trạng thái</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody style="text-align: center;">
                <?php
                foreach ($cart as $value) {
                    ?>
                    <tr class="odd gradeX">
                        <td><?php echo $value["order_id"]; ?></td>
                        <td><?php echo $value["name"];?></td>
                        <td><?php echo $value["mau_sac"];?></td>
                        <td><?php echo $value["dung_luong"];?>GB</td>
                        <td><?php echo $value['sl'];?></td>
                        <td><?php echo format_currency($value['price']);?>VNĐ</td>
                        <td><?php echo $value['user_name'];?></td>
                        <td><?php echo $value['phone'];?></td>
                        <td><?php echo $value['provincial'];echo ",";echo $value['district'] ;echo ",";echo $value['ward'];echo ","; echo $value['address']; ?></td>
                        <td><?php echo $value['order_date'];?></td>
                        <td ><a onclick="return confirm('Bạn chắc chắn muốn chốt đơn hàng này?')" style="color: green;"  href="<?php echo actionCart('cart','update',$value['order_id'],$value['trang_thai'])?>"> <?php echo $value['trang_thai'];?></a></td>
                        <td><a onclick="return confirm('Bạn chắc chắn muốn xóa sản phẩm này trong đơn hàng?')" style="color: red;" href="<?php echo actionCart('cart','del',$value['order_detail_id'],$value['order_id']);?>"> X</a>|
                            <a onclick="return confirm('Bạn chắc chắn muốn xóa cả đơn hàng này?')" style="color: red;" href="<?php echo actions('cart','delcart',$value['order_id']);?>"> XX</a>
                        </td>
                    </tr>
                    <?php
                }
                ?>
                <tr class="odd gradeX">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="center"> </td>
                    <td><?php  numberpages($totalpage,$pages,'cart'); ?></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                </tbody>
            </table>

        </div>
    </div>
</div>



