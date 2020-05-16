
<div class="grid_10">
    <div class="box round first grid">
        <h2>Thêm mới tài khoản</h2>
        <div class="block">
            <form action="<?php echo pages('admin','addnew')?>" method="post" >
                <table class="form">

                    <tr>
                        <td>
                            <label>Tên tài khoản</label>
                        </td>
                        <td>
                            <input type="text" name="name" maxlength="30" placeholder="Tên tài khoản..." class="medium" required />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Mật khẩu</label>
                        </td>
                        <td>
                            <input type="password" maxlength="10"  placeholder="Nhập mật khẩu....." name="pass" class="medium" required />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Nhập lại mật khẩu</label>
                        </td>
                        <td>
                            <input type="password" maxlength="10" placeholder="Nhập mật khẩu....." name="repass" class="medium" required  />
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="submit"  Value="Save" />
                        </td>
                    </tr>
                    <tr>
                    <td></td>
                    <td>
                        <span style="color: red;"><?php echo convert();?> </span>
                        <span style="color: green;"><?php echo success();?> </span>
                    </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>


