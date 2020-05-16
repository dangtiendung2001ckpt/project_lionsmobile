
<div class="grid_10">
    <div class="box round first grid">
        <h2>Danh Sách sản phẩm</h2>
        <h2> <form action="index.php" method="get" >
                <input type="hidden" name="module" value="backend">
                <input type="hidden" name="control" value="search">
                <input type="text" name="key" value="" required>
                <input type="submit"  value="Tìm kiếm">
            </form></h2>
        <div style="text-align: center;color: red;"><?php echo success() ?>
        </div>
        <div class="block">
            <table class="data display " id="example">
			<thead>
				<tr>
					<th>STT</th>
					<th>Name</th>
					<th>Màu</th>
					<th>Ảnh</th>
					<th>Ram</th>
					<th>Bộ nhớ</th>
                    <th>Pin</th>
                    <th>Số lượng</th>
                    <th>Giá</th>
                    <th>Action</th>
				</tr>
			</thead>
			<tbody style="text-align: center;">
            <?php
            $offset= $offset+1;
            foreach ($products as $value) {
                ?>
                <tr class="odd gradeX">
                    <td><?php echo $offset?></td>
                    <td><?php echo $value["name"];?></td>
                    <td><?php echo $value["mau_sac"];?></td>
                    <td class="center" ><img style="width: 50px;height: 50px;" src="public/common/images/<?php echo $value['img']; ?>"></td>
                    <td><?php echo $value["ram"];?></td>
                    <td><?php echo $value['dung_luong'];?>GB</td>
                    <td><?php echo $value['dl_pin'];?></td>
                    <td><?php echo $value['so_luong'];?></td>
                    <td><?php echo format_currency($value['price']);?>vnđ</td>
                    <td>
                        <a style="color: green;" href="<?php echo actions('products','viewAddnewProduct',$value['product_id'])?>">Edit</a> ||
                        <a style="color: green;" href="<?php echo actions('products','quickAdd',$value['product_id'])?>">Addnew</a> ||
                        <a onclick="return confirm('Bạn chắc chắn muốn xóa sản phẩm này?')" style="color: red;" href="<?php echo actions('products','delproduct',$value['product_id']);?>"> Delete</a></td>
                    </td>
                </tr>
                <?php
                $offset++;
            }
            ?>
                <tr class="odd gradeX">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="center"> </td>
                    <td></td>
                    <td></td>
                    <td><?php  numberpages($totalpage,$pages,'products'); ?></td>
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



