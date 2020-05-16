
<div class="grid_10">
    <div class="box round first grid">
        <h2>Thêm mới chức Tính năng Thiết bị</h2>
        <div class="block copyblock">
            <form  action="<?php
            if (isset($_GET['id']) && !empty($data)){
                echo actions('attribute','updateAttribute',$_GET['id']);
            }else{
                echo pages('attribute','addnewAtribute');
            }
            ?>" method="post">
                <table class="form">
                    <tr>

                        <td>
                            <input type="text" name="attribute" maxlength="40" placeholder="Nhập tên....."
                                   value="<?php if (isset($_GET['id']) && !empty($data)){
                                       echo $data['attribute_name'];
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
