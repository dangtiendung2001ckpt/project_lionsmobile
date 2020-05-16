<style>

    ul li{

        list-style-type: none;
    }
    a{
        text-decoration: none;
        color: black;
        display: inline-block;
    }
    .pagination {
        display: flex;
    }
    .page-link{
        position: relative;
        display: block;
        padding: 0.5rem 0.75rem;
        margin-left: -1px;
        line-height: 1.25;
        border-radius:2px 0px 2px 0px;
        background-color: #fff;
        border: 1px solid #dee2e6;
    }
    #pagination ul{

        margin-top:20px;}
    #pagination ul li a.page-link{
        color:#333333;}
    #pagination ul li a.page-link:hover{
        background:#EB1F27;
        color:#FFF;
        border: blue;}
    #pagination ul li.active a{
        background:#EB1F27;
        border-color:#dee2e6;
        color:#FFF;}
    a#cat:hover{
        background-color: #FFD700;
    }


</style>
<div class="wrap">
<div class="main">
    <div class="content">
    	<div style="padding-bottom: 20px;" >
            <ul style="padding-left: 10px;">
                    <?php
                    foreach ($category as $value){ ?>
                        <a id="cat" style="float: left;width:12%;border: 1px solid #eee;text-align: center;height: 100px;height: 30px; margin: 0 0 -1px -1px;padding-top:11px;border-radius: 20px;" href="index.php?control=products&action=cat&catid=<?php echo $value["category_id"];?>" ><?php echo $value["category_name"];?></a>

                     <?php
                    }
                    ?>
            </ul>
            <form action="index.php" >
                <input type="hidden" name="control" value="products">
                <input type="hidden" name="action" value="searchPrice">
                <select name="catid" style="margin-top: 10px;margin-left: 10px;height: 30px;" >
                    <option value="">Chọn mức giá</option>
                    <option value="1">Dưới 5 triệu </option>
                    <option value="2">5 triệu -> 10 triệu </option>
                    <option value="3">10 triệu-> 15 triệu </option>
                    <option value="4">15 triệu-> 20 triệu </option>
                    <option value="5">Trên 20 triệu </option>
                </select>


                <input type="submit" value="Tìm kiếm">
            </form>
    	</div>
	      <div class="section group">
              <?php
              foreach ($products as $item){?>
                  <div class="grid_1_of_4 images_1_of_4" style="margin:0.4%;">
                      <a href="index.php?control=products&action=details&id=<?php echo $item['product_id'];?>"><img style="width: 218px;height: 180px;" src="public/common/images/<?php echo $item['img'];?>" alt="" /></a>
                      <h2><?php echo $item['name'];?></h2>
                      <p><span class="price"><?php echo format_currency($item['price']);?>VNĐ</span></p>
                      <span>Phụ kiện: <?php echo $item['phukien'];?></span>
                      <div class="button"><span><a href="index.php?control=products&action=details&id=<?php echo $item['product_id'];?>" class="details">Chi tiết</a></span></div>
                  </div>
              <?php
              }
              ?>
			</div>
        <div>
            <div id="pagination" >
                <ul class="pagination">
                    <?php
                    $action = isset($_GET['action']) ? $_GET['action'] : '';
                    $id = isset($_GET['catid']) ? $_GET['catid']: "";
                    $id = substr($id, 0, 2);
                    pagination($totalpage,$pages,'products',$action,$id);
                    ?>

                </ul>
            </div>
        </div>
    </div>
 </div>
</div>
