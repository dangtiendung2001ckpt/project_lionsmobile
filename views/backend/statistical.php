
<div class="grid_10">
    <div class="box round first grid">
        <h2>Thống kê  <form action="index.php?module=backend&control=statistical&pages=<?php echo $year;?>" method="post">
                <select name="cat" >
                    <option value="<?php if (isset($cat) && !empty($cat)){ echo $cat['category_id'];}else{echo "";} ?>" ><?php if (isset($cat) && !empty($cat)){ echo $cat['category_name'];}else{echo "Thống kê theo hãng";} ?></option>
                    <?php foreach ($category as $value){ ?>
                    <option value="<?php echo $value['category_id'];?>"><?php echo $value['category_name'];?></option>
                  <?php }?>
                </select>
                <input type="submit" name="submit" value="Chọn">
            </form>
        </h2>
        <div class="block">
            <table class="data display datatable" id="example">
                <thead>
                <tr>
                    <th>Tháng</th>
                    <th>Tổng sản phẩm bán ra</th>
                    <th>Tổng doanh thu</th>
                </tr>
                </thead>
                <tbody>
                <tr class="odd gradeX" style="text-align: center;">
                    <td>1</td>
                    <td><?php echo revenue($t1['sum(sl)']) ;?></td>
                    <td><?php echo revenue($t1['sum(order_detail.price)']) ;?></td>
                </tr>
                <tr class="odd gradeX" style="text-align: center;">
                    <td>2</td>
                    <td><?php echo revenue($t2['sum(sl)']) ;?></td>
                    <td><?php echo revenue($t2['sum(order_detail.price)']) ;?></td>
                </tr>
                <tr class="odd gradeX" style="text-align: center;">
                    <td>3</td>
                    <td><?php echo revenue($t3['sum(sl)']) ;?></td>
                    <td><?php echo revenue($t3['sum(order_detail.price)']) ;?></td>
                </tr>
                <tr class="odd gradeX" style="text-align: center;">
                    <td>4</td>
                    <td><?php echo revenue($t4['sum(sl)']) ;?></td>
                    <td><?php echo revenue($t4['sum(order_detail.price)'])  ;?></td>
                </tr>
                <tr class="odd gradeX" style="text-align: center;">
                    <td>5</td>
                    <td><?php echo revenue($t5['sum(sl)']) ;?></td>
                    <td><?php echo revenue($t5['sum(order_detail.price)'])  ;?></td>
                </tr>
                <tr class="odd gradeX" style="text-align: center;">
                    <td>6</td>
                    <td><?php echo revenue($t6['sum(sl)']) ;?></td>
                    <td><?php echo revenue($t6['sum(order_detail.price)'])  ;?></td>
                </tr>
                <tr class="odd gradeX" style="text-align: center;">
                    <td>7</td>
                    <td><?php echo revenue($t7['sum(sl)']) ;?></td>
                    <td><?php echo revenue($t7['sum(order_detail.price)'])  ;?></td>
                </tr>
                <tr class="odd gradeX" style="text-align: center;">
                    <td>8</td>
                    <td><?php echo revenue($t8['sum(sl)']) ;?></td>
                    <td><?php echo revenue($t8['sum(order_detail.price)'])  ;?></td>
                </tr>
                <tr class="odd gradeX" style="text-align: center;">
                    <td>9</td>
                    <td><?php echo revenue($t9['sum(sl)']) ;?></td>
                    <td><?php echo revenue($t9['sum(order_detail.price)'])  ;?></td>
                </tr>
                <tr class="odd gradeX" style="text-align: center;">
                    <td>10</td>
                    <td><?php echo revenue($t10['sum(sl)']) ;?></td>
                    <td><?php echo revenue($t10['sum(order_detail.price)'])  ;?></td>
                </tr>
                <tr class="odd gradeX" style="text-align: center;">
                    <td>11</td>
                    <td><?php echo revenue($t11['sum(sl)']) ;?></td>
                    <td><?php echo revenue($t11['sum(order_detail.price)'])  ;?></td>
                </tr>
                <tr class="odd gradeX" style="text-align: center;">
                    <td>12</td>
                    <td><?php echo revenue($t12['sum(sl)']) ;?></td>
                    <td><?php echo revenue($t12['sum(order_detail.price)']) ;?></td>
                </tr>
                <tr class="odd gradeX" style="text-align: center;">
                    <td>Quý 1</td>
                    <td><?php $sl1=$t1['sum(sl)'] + $t2['sum(sl)'] +$t3['sum(sl)'];echo revenue($sl1);?></td>
                    <td><?php $price1=$t1['sum(order_detail.price)'] + $t2['sum(order_detail.price)'] +$t3['sum(order_detail.price)'];echo revenue($price1); ?></td>
                </tr>
                <tr class="odd gradeX" style="text-align: center;">
                    <td>Quý 2</td>
                    <td><?php $sl2=$t4['sum(sl)'] + $t5['sum(sl)'] +$t6['sum(sl)'];echo revenue($sl2);?></td>
                    <td><?php $price2=$t4['sum(order_detail.price)'] + $t5['sum(order_detail.price)'] +$t6['sum(order_detail.price)'];echo revenue($price2); ?></td>
                    </tr>
                <tr class="odd gradeX" style="text-align: center;">
                    <td>Quý 3</td>
                    <td><?php $sl3=$t7['sum(sl)'] + $t8['sum(sl)'] +$t9['sum(sl)'];echo revenue($sl3);?></td>
                    <td><?php $price3=$t7['sum(order_detail.price)'] + $t8['sum(order_detail.price)'] +$t9['sum(order_detail.price)'];echo revenue($price3); ?></td>
                </tr>
                <tr class="odd gradeX" style="text-align: center;">
                    <td>Quý 4</td>
                    <td><?php $sl4=$t10['sum(sl)'] + $t11['sum(sl)'] +$t12['sum(sl)'];echo revenue($sl4);?></td>
                    <td><?php $price4=$t10['sum(order_detail.price)'] + $t11['sum(order_detail.price)'] +$t12['sum(order_detail.price)'];echo revenue($price4); ?></td>
                </tr>
                <tr class="odd gradeX" style="text-align: center;">
                    <td>Năm:<?php echo $year;?></td>
                    <td><?php $sl5=$t1['sum(sl)'] + $t2['sum(sl)'] +$t3['sum(sl)'] + $t4['sum(sl)'] +$t5['sum(sl)'] + $t6['sum(sl)'] +$t7['sum(sl)'] + $t8['sum(sl)'] +$t9['sum(sl)'] + $t10['sum(sl)'] + $t11['sum(sl)'] +$t12['sum(sl)'];echo revenue($sl5);?></td>
                    <td><?php $price5=$t1['sum(order_detail.price)'] + $t2['sum(order_detail.price)'] +$t3['sum(order_detail.price)'] + $t4['sum(order_detail.price)'] +$t5['sum(order_detail.price)'] + $t6['sum(order_detail.price)'] +$t7['sum(order_detail.price)'] + $t8['sum(order_detail.price)'] +$t9['sum(order_detail.price)'] + $t10['sum(order_detail.price)'] +$t11['sum(order_detail.price)']  +$t12['sum(order_detail.price)'];echo revenue($price5); ?></td>
                </tr>
                <tr class="odd gradeX" style="text-align: center;">
                    <td></td>
                    <td><?php years($year,'statistical'); ?></td>
                    <td></td>
                </tr>

                </tbody>
            </table>
        </div>
    </div>
</div>


