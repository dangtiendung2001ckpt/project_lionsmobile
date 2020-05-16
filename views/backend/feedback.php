
<div class="grid_10">
    <div class="box round first grid">
        <h2>Phản hồi khách hàng</h2>
        <div class="block">  
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>Nội dung</th>
					<th>Trả lời</th>
					<th>Thao tác</th>
					
				</tr>
			</thead>
			<tbody>
				<?php foreach ($feedback as $value) { ?>
				
				<tr class="odd gradeX" style="text-align: center;">
					<td><?php echo $value['content']; ?></td>
					<td><a style="color: green;" href="index.php?control=products&action=details&id=<?php echo $value['product_id']; ?>">Trả lời</a> </td>
					<td><a style="color: green;" href="<?php if($value['defaults'] == 0){echo actions('feedback','update_cmt',$value['feedback_id']);}else{ echo "#"; }?>"><?php if($value['defaults'] == 0){echo "Cho phép hiển thị";}else{ echo "Đã hiển thị"; }?></a> ||



                        <a onclick="return confirm('Bạn chắc chắn muốn xóa bình luận này?')" style="color: red;" href="<?php echo actions('feedback','del_cmt',$value['feedback_id']); ?>">X</a></td>
				</tr>
				<?php 
				} ?>
				
				<tr>
                    <td></td>
                    <td><?php  numberpages($totalpage,$pages,'feedback'); ?></td>
                    <td></td>
                </tr>
			</tbody>
		</table>

       </div>
    </div>
</div>

