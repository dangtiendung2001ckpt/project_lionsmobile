
<div class="wrap">
    <div class="main" >
        <div class="content">
            <div class="login_panel">
                <h3>Chào mừng bạn đã đến với Lions mobile</h3>
                <form action="<?php $proid = isset($_GET['proid']) ? $_GET['proid'] : '';  echo "index.php?control=user&action=login&proid=$proid";?>" method="post" id="member">
                    <input name="username" type="text" placeholder="Tên đăng nhập">
                    <input name="password" type="password" placeholder="Mật khẩu">
                    <p class="note"></p>
                    <input style="background-color: #444444;color: white;height: 40px;text-align: center;"   type="submit"  value="Đăng nhập">
                    <br/>
                    <span style="color: red;"><?php if (isset($_SESSION['error'])){
                        $error=$_SESSION['error'];
                        echo $error;
                        unset($_SESSION['error']);
                        } ?></span>
            </div>
            </form>

            <div class="register_account">
                <span id="text">Đăng ký tài khoản</span>
                <span style="float: right;padding-right: 150px;">Địa chỉ giao hàng</span>

                <form name="form" action="<?php if (isset($_SESSION['user_id']) && $_GET['action'] == "order"){
                    echo "index.php?control=cart&action=ordercart";
                }else{
                    $proid = isset($_GET['proid']) ? $_GET['proid'] : '';
                    echo "index.php?control=user&action=checkdata&proid=$proid";
                }
                ?>" method="post" onsubmit="return validateForm()" >
                    <table>
                        <tbody>
                        <tr>
                            <td>
                                <div style>
                                    <input type="text" name="username"   maxlength="20" value="<?php if (isset($_SESSION['form_name'])){ echo $_SESSION['form_name'];} ?>"  placeholder="Tên đăng nhập" required>
                                </div>

                                <div  style="padding-top: 5px;">
                                    <input style="width: 356px;height: 28px;" maxlength="8" name="pass" type="password" value="" placeholder="Mật khẩu" required>
                                </div>

                                <div style="padding-top: 10px;">
                                    <input style="width: 356px;height: 28px;" maxlength="8" name="password" type="password" value="" placeholder="Nhập lại mật khẩu" required>
                                </div>
                                <div style="padding-top: 10px;">
                                    <input style="width: 344px;height: 19px;" min="1" max="100000000000" type="number" name="phone" value="<?php if (isset($_SESSION['form_phone'])){ echo $_SESSION['form_phone'];} ?>"  placeholder="Số điện thoại" required>
                                </div>
                            </td>
                            <td>
                                <div>
                                    <select id="provincial" name="provincial"  class="frm-field" required>
                                        <option value="<?php if (isset($_SESSION['form_provincial']) && $_SESSION['form_provincial'] ){ echo $_SESSION['form_provincial'];}?>"><?php if (isset($_SESSION['form_provincial'])){ echo $_SESSION['form_provincial'];}else{ echo "Chọn tỉnh";} ?></option>
                                        <?php
                                        foreach($provincial as $value){
                                            ?>
                                            <option><?php echo $value['provincial_name']; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div >
                                    <input type="text" name="district" maxlength="20"  value="<?php if (isset($_SESSION['form_district'])){ echo $_SESSION['form_district'];} ?>" placeholder="Quận,huyện"  required>
                                </div>
                                <div style>
                                    <input type="text" name="ward" maxlength="20" value="<?php if (isset($_SESSION['form_ward'])){ echo $_SESSION['form_ward'];} ?>" placeholder="Xã,phường"  required>
                                </div>
                                <div style>
                                    <input type="text" name="address" maxlength="30" value="<?php if (isset($_SESSION['form_address'])){ echo $_SESSION['form_address'];} ?>" placeholder="Đường,số nhà" required>
                                </div>
                            </td>


                        </tr>
                        </tbody></table>
                    <input style="background-color: #444444;color: white;height: 40px;text-align: center;"   type="submit" name="submit" value="<?php if (isset($_SESSION['user_id']) && !empty($user) && $_GET['action'] == "order"){ echo "Lưu thay đổi";}else{
                        echo "Tạo tài khoản mới";
                    } ?>">
                </form>
                <span id="error" style="color: red;"><?php if (isset($_SESSION['error_login'])){
                        $error=$_SESSION['error_login'];
                        echo $error;
                        unset($_SESSION['error_login']);
                    } ?></span>
            </div>
            <div class="clear"></div>
        </div>
    </div>
</div>
