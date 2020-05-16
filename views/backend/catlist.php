
     <div class="grid_10">
            <div class="box round first grid">
                <h2>Danh mục loại sản phẩm</h2>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>STT</th>
							<th>Tên danh mục</th>
							<th>Thao tác</th>
						</tr>
					</thead>
					<tbody style="text-align: center;">

						<?php
						$offset= $offset+1;
						foreach ($category as $value) {
						?>
						<tr class="odd gradeX">
							<td><?php echo $offset; ?></td>
							<td><?php echo $value['category_name']; ?></td>
							<td><a style="color: green;" href="<?php echo actions('category','addnew',$value['category_id'])?>">Edit</a> ||
                                <a onclick="return confirm('Bạn chắc chắn muốn xóa hãng điện thoại này?')" style="color: red;" href="<?php echo actions('category','delcat',$value['category_id']);?>"> Delete</a></td>
						</tr>
						<?php
						$offset++;
					}
						?>
                        <tr class="odd gradeX">
                            <th></th>
                            <th><?php  numberpages($totalpage,$pages,'category'); ?></th>
                            <th></th>
                        </tr>
					</tbody>
				</table>
               </div>
                <div style="text-align: center;color: red;"><?php echo success() ?></div>
            </div>
        </div>


