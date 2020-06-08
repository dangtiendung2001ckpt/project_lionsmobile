
<div class="grid_10">
    <div class="box round first grid">
        <h2>Thêm mới Sản phẩm</h2>
        <div class="block">

         <form action="<?php
         if ($_GET['action'] == "quickAdd"){
             echo pages('products','addnewProduct');
         }elseif (isset($_GET['id']) && !empty($data)){
             echo actions('product','updateProduct',$_GET['id']);
         }else{
             echo pages('product','addNew');
         }
         ?>" method="post" enctype="multipart/form-data">
            <table class="form">
               
                <tr>
                    <td>
                        <label>Tên sản phẩm</label>
                    </td>
                    <td>
                        <input type="text" maxlength="50" name="name" placeholder="Tên sản phẩm..." value="<?php echo checked($product,'name'); ?>" class="medium"    />
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Hãng</label>
                    </td>
                    <td>
                        <select id="select" name="category" onchange="change_country(this.value)"   >
                            <option value="<?php echo checked($product,'category_id');?>"><?php if (isset($_GET["id"]) && !empty($product)){ echo checked($product,'category_id'); }else{ echo "Chọn hãng điện thoại";} ?></option>
                            <?php
                                foreach ($category as $value) {
                                    ?>
                                    <option value="<?php echo $value['category_id'];?>"><?php echo $value['category_name'];?></option>
                                    <?php
                                }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Số lượng</label>
                    </td>
                    <td>
                        <input type="number" max="100000" name="sl" value="<?php echo checked($product,'so_luong');?>" placeholder="Nhập số lượng..." class="medium"    />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Màu sắc</label>
                    </td>
                    <td>
                        <input type="text" maxlength="20" name="color" value="<?php echo checked($product,'mau_sac');?>" placeholder="Nhập màu sắc..." class="medium"    />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Ảnh</label>
                    </td>
                    <td>
                        <input name="image" type="file" value=""   />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Bộ nhớ trong</label>
                    </td>
                    <td>
                        <select id="select" name="data"   >
                            <option value="<?php echo checked($product,'dung_luong');?>"><?php echo checked($product,'dung_luong').'GB'; ?></option>
                            <option value="16">16GB</option>
                            <option value="32">32GB</option>
                            <option value="64">64GB</option>
                            <option value="128">128GB</option>
                            <option value="256">256GB</option>
                            <option value="512">512GB</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Ram</label>
                    </td>
                    <td>
                        <input type="text" maxlength="10" name="ram" value="<?php echo checked($product,'ram');?>" placeholder="Nhập..." <?php addnewpro(); ?> class="medium"    />
                    </td>
                <tr>
                    <td>
                        <label>Giá</label>
                    </td>
                    <td>
                        <input type="number" max="100000000000" name="price" value="<?php echo checked($product,'price');?>" placeholder="Nhập giá..." class="medium"   />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Màn hình</label>
                    </td>
                    <td>
                        <input type="text" maxlength="100" name="manhinh" value="<?php echo checked($product,'man_hinh');?>" placeholder="Nhập..." <?php addnewpro(); ?> class="medium"   />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Hệ điều hành</label>
                    </td>
                    <td>
                        <select id="select" name="hdh"   >
                            <option value="<?php echo checked($product,'he_dieu_hanh');?>"><?php if (isset($_GET["id"]) && !empty($product)){ echo checked($product,'he_dieu_hanh'); }else{ echo "Chọn hệ điều hành";} ?></option>
                            <option value="Android">Android</option>
                            <option value="IOS">IOS</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>CPU</label>
                    </td>
                    <td>
                        <input type="text" maxlength="50" name="cpu" value="<?php echo checked($product,'cpu');?>" placeholder="Nhập..." class="medium" <?php addnewpro(); ?>    />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Dung lượng pin</label>
                    </td>
                    <td>
                        <input type="text" maxlength="50" name="pin" value="<?php echo checked($product,'dl_pin');?>" placeholder="Nhập..." class="medium" <?php addnewpro(); ?>   />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Camera trước</label>
                    </td>
                    <td>
                        <input type="text" maxlength="50" name="cameratruoc" value="<?php echo checked($product,'camera_truoc');?>" placeholder="Nhập..." class="medium" <?php addnewpro(); ?>    />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Camera sau</label>
                    </td>
                    <td>
                        <input type="text" maxlength="50" name="camerasau"  value="<?php echo checked($product,'camera_sau');?>" placeholder="Nhập..." class="medium" <?php addnewpro(); ?>    />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Phụ kiện đi kèm</label>
                    </td>
                    <td>
                        <input type="text" maxlength="200" name="phukien" value="<?php echo checked($product,'phukien');?>" placeholder="Nhập..." class="medium" <?php addnewpro(); ?>   />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Thiết bị hỗ trợ mới nếu có</label>
                    </td>
                    <td>
                        <?php
                        foreach ($attribute as $value) {
                            ?>
                            <input name="attribute[]" value="<?php echo $value['attribute_id'];?>" type="checkbox" /><?php echo $value['attribute_name'];?>
                            <?php
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Mặc định</label>
                    </td>
                    <td>
                        <input  name="defaults" type="checkbox" <?php $defaults=0; if (isset($_GET['id']) && !empty($product)){$defaults=checked($product,'defaults');if($defaults == 1){echo 'checked="checked"';}} ?>  />Sản phẩm xuất hiện
                    </td>
                </tr>
				<tr>
                    <td></td>
                    <td>
                        <input  type="submit"  name="submit" Value="Save" />
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <span style="color:red;"><?php foreach (getFlashError() as $value){
                            echo $value;
                            }?></span>
                    </td>
                </tr>
            </table>
            </form>
        </div>
    </div>
</div>


