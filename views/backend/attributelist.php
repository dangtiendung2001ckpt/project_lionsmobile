
<div class="grid_10">
    <div class="box round first grid">
        <h2>Thiết bị,chức năng hỗ trợ</h2>
        <div class="block">
            <table class="data display datatable" id="example">
                <thead>
                <tr>
                    <th>STT</th>
                    <th>Name</th>
                    <th>Thao tác</th>
                </tr>
                </thead>
                <tbody style="text-align: center;">

                <?php
                $offset= $offset+1;
                foreach ($attribute as $value) {
                    ?>
                    <tr class="odd gradeX">
                        <td><?php echo $offset; ?></td>
                        <td><?php echo $value['attribute_name']; ?></td>
                        <td><a style="color: green;" href="<?php echo actions('attribute','viewAddAttribute',$value['attribute_id'])?>">Edit</a> ||
                            <a onclick="return confirm('Bạn chắc chắn muốn xóa danh mục này?')" style="color: red;" href="<?php echo actions('attribute','delattribute',$value['attribute_id']);?>"> Delete</a></td>
                    </tr>
                    <?php
                    $offset++;
                }
                ?>
                <tr class="odd gradeX">
                    <th></th>
                    <th><?php  numberpages($totalpage,$pages,'attribute'); ?></th>
                    <th></th>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>


