
<div class="grid_10">
    <div class="box round first grid">
        <h2>Thay đổi mật khẩu</h2>
        <div class="block">               
         <form action="<?php echo pages('admin','changepassword')?>" method="post">
            <table class="form">					
                <tr>
                    <td>
                        <label>Mật khẩu cũ</label>
                    </td>
                    <td>
                        <input type="password" maxlength="30" placeholder="Nhập mật khẩu..."  name="passold" class="medium" />
                    </td>
                </tr>
				 <tr>
                    <td>
                        <label>Mật khẩu mới</label>
                    </td>
                    <td>
                        <input type="password" maxlength="30" placeholder="Mật khẩu mới..." name="newpass" class="medium" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Nhập lại mật khẩu mới</label>
                    </td>
                    <td>
                        <input type="password" maxlength="30" placeholder="Nhập lại mật khẩu mới..." name="renewpass" class="medium" />
                    </td>
                </tr>
				
				 <tr>
                    <td>
                    </td>
                    <td>
                        <input type="submit" name="submit" Value="Sửa" />
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <span style="color: red;"><?php echo replace();?> </span>
                        <span style="color: green;"><?php echo success();?>  </span>
                    </td>
                </tr>
            </table>
            </form>
        </div>
    </div>
</div>
