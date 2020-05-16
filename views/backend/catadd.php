
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Thêm mới loại sản phẩm</h2>
               <div class="block copyblock"> 
                 <form  action="<?php
                 if (isset($_GET['id']) && !empty($data)){
                     echo actions('category','updatecat',$_GET['id']);
                 }else{
                     echo pages('category','addnewcat');
                 }
                 ?>" method="post">
                    <table class="form">
                        <tr>

                            <td>
                                <input type="text" name="cat" maxlength="20" placeholder="Nhập tên loại sản phẩm....."
                                           value="<?php if (isset($_GET['id']) && !empty($data)){
                                               echo $data['category_name'];
                                           } ?>" class="medium" required />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit"  Value="Save" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span style="color: red;"><?php echo replace();?></span>
                                <span style="color: green;"><?php echo success();?></span>
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
