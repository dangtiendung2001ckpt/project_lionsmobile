<?php
function numberpages($totalpage,$pages,$control){
    if ($pages >3){
        $first_page=1;
        echo " <a style='color: green;border: 1px cadetblue ridge;font-size: 19px;' href='index.php?module=backend&control=" . $control . "&pages=" . $first_page . "'> Đầu</a>";
    }
    for ($num = 1; $num <= $totalpage;$num++){
        if ($num != $pages) {
            if ($num > $pages -3 && $num < $pages +3){
                echo " <a style='color: green;border: 1px cadetblue ridge;font-size: 19px;' href='index.php?module=backend&control=" . $control . "&pages=" . $num . "'> $num</a>";
            }
        }else{
            echo "<strong style='border: 1px solid green;font-size: 19px;color: white;background-color: red;'> $num </strong>";
        }
    }
    if ($pages < $totalpage -3){
        $end_page=$totalpage;
        echo " <a style='color: green;border: 1px cadetblue ridge;font-size: 19px;' href='index.php?module=backend&control=" . $control . "&pages=" . $end_page . "'> Cuối</a>";
    }
}




function pagination($totalpage,$pages,$control,$action,$catid){

    if ($pages >3){
        $first_page=1;
        echo " <li class='page-item '>
                        <a href='index.php?control=" . $control . "&action=" . $action . "&catid=" .$catid. " &pages=" . $first_page . "' class='page-link '>Trang đầu </a>
                    </li>";
    }
    for ($num = 1; $num <= $totalpage;$num++){
        if ($num != $pages) {
            if ($num > $pages -3 && $num < $pages +3){
                echo " <li class='page-item '>
                        <a href='index.php?control=" . $control . "&action=" . $action . "&catid=" . $catid . " &pages=" . $num . "' class='page-link '>$num </a>
                    </li>";
            }
        }else{
            echo " <li class='page-item '>
                        <span class='page-link ' style='background-color: red;' >$num</span>
                    </li>";
        }
    }
    if ($pages < $totalpage -3){
        $end_page=$totalpage;
        echo "<li class='page-item '>
                        <a href='index.php?control=" . $control . "&action=".$action."&catid=".$catid." &pages=" . $end_page . "' class='page-link '>Trang cuối </a>
                    </li> ";
    }
}
function years($pages,$control){
    $date=getdate();
    $year=$date['year'] + 3;
    if ($pages >2024){
        $first_page=2020;
        echo " <a style='color: green;border: 1px cadetblue ridge;font-size: 19px;' href='index.php?module=backend&control=" . $control . "&pages=" . $first_page . "'> Đầu </a>";
    }
    for ($num = 2020; $num <= $year;$num++){
        if ($num != $pages) {
            if ($num > $pages -3 && $num < $pages +3){
                echo " <a style='color: green;border: 1px cadetblue ridge;font-size: 19px;' href='index.php?module=backend&control=" . $control . "&pages=" . $num . "'> $num</a>";
            }
        }else{
            echo "<strong style='border: 1px solid green;font-size: 19px;color: white;background-color: red;'> $num </strong>";
        }
    }
    if ($pages < $year -3){
        $end_page=$year;
        echo " <a style='color: green;border: 1px cadetblue ridge;font-size: 19px;' href='index.php?module=backend&control=" . $control . "&pages=" . $end_page . "'> Cuối</a>";
    }
}
?>



