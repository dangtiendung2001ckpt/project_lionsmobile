
 <div class="wrap">
 <div class="main" >
    <div class="content">
    	 <div class="login_panel">
        	<h3>Chào mừng bạn đã đến với Lions mobile</h3>
        	<form action="<?php $proid = isset($_GET['proid']) ? $_GET['proid'] : '';  echo "index.php?control=login&action=login&proid=$proid";?>" method="post" id="member">
                	<input name="username" type="text" placeholder="Tên đăng nhập">
                    <input name="password" type="password" placeholder="Mật khẩu">
                    <p class="note"></p>
                     <input style="background-color: #444444;color: white;height: 40px;text-align: center;"   type="submit"  value="Đăng nhập">
                     <br/>
                <span style="color: red;"><?php echo replace();?></span>
                    </div>
                 </form>
                 
    	<div class="register_account">

    		<span style="float: right;padding-right: 150px;">Địa chỉ giao hàng</span>

    		<form name="form" action="<?php if (isset($_SESSION['user_id']) && $_GET['action'] == "order"){
    		    echo "index.php?control=cart&action=ordercart";
            }else{
    		    $proid = isset($_GET['proid']) ? $_GET['proid'] : '';
    		    echo "index.php?control=login&action=checkdata&proid=$proid";
            }
            ?>" method="post" >
		   			 <table>
		   				<tbody>
						<tr>
						<td>
							<div style>
							<input type="text" name="username"   maxlength="20" value="<?php if (isset($user)){echo checked($user,'user_name');}?>"  placeholder="Tên đăng nhập" >
							</div>
							
							<div  style="padding-top: 5px;">
							   <input style="width: 356px;height: 28px;" maxlength="8" name="pass" type="password" placeholder="Mật khẩu">
							</div>
							
							<div style="padding-top: 10px;">
							   <input style="width: 356px;height: 28px;" maxlength="8" name="password" type="password" placeholder="Nhập lại mật khẩu">
							</div>
							<div style="padding-top: 10px;">
								<input style="width: 344px;height: 19px;" min="1" max="100000000000" type="number" name="phone" value="<?php if (isset($user)){echo checked($user,'phone');}?>"  placeholder="Số điện thoại">
							</div>
		    			 </td>
		    			 <td>
		    			 	<div>
						<select id="provincial" name="provincial" onchange="change_country(this.value)" class="frm-field required">
							<option value="<?php if (isset($user)){echo checked($user,'provincial');} ?>"><?php if (isset($user)){echo checked($user,'provincial');}else{echo "Tỉnh,Thành phố"; } ?></option>
							<?php
							foreach($provincial as $value){
							?>	
								<option><?php echo $value['provincial_name']; ?></option>
								<?php
								}
								?>
		         </select>
				 </div>	
				 <div style>
							<input type="text" name="district" maxlength="20"  value="<?php if (isset($user)){echo checked($user,'district');}?>" placeholder="Quận,huyện" >
							</div>
				 <div style>
							<input type="text" name="ward" maxlength="20" value="<?php if (isset($user)){echo checked($user,'ward');}?>" placeholder="Xã,phường" >
							</div>
							<div style>
							<input type="text" name="address" maxlength="30" value="<?php if (isset($user)){echo checked($user,'address');}?>" placeholder="Đường,số nhà" >
							</div>	        	        
		    			 </td>
		    			
		    			
		    </tr> 
		    </tbody></table> 
		    <input style="background-color: #444444;color: white;height: 40px;text-align: center;"   type="submit" name="submit" value="<?php if (isset($_SESSION['user_id']) && !empty($user) && $_GET['action'] == "order"){ echo "Lưu địa chỉ giao hàng";}else{
		        echo "Tạo tài khoản mới";
            } ?>">
		    </form>
            <span style="color: red;"><?php echo convert(); ?></span>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
</div>
