<?php
include_once 'models/delete.php';
class ChartslController extends DeleteValue {
    protected $_module='backend';
    protected $_control="products";
    function homes(){
        $day1=01;
        $day2=31;
        $month1=01;
        $month2=12;
        $year=isset($_GET['pages']) ? $_GET['pages'] : 2020 ;
        $date1=$year.'-'.$month1.'-'.$day1;
        $date2=$year.'-'.$month2.'-'.$day2;
        $cat1 = $this->getChart('sl','order_detail.price',$date1,$date2,1);
        $cat2 = $this->getChart('sl','order_detail.price',$date1,$date2,2);
        $cat3 = $this->getChart('sl','order_detail.price',$date1,$date2,3);
        $cat4 = $this->getChart('sl','order_detail.price',$date1,$date2,4);
        $cat5 = $this->getChart('sl','order_detail.price',$date1,$date2,5);
        $cat6 = $this->getChart('sl','order_detail.price',$date1,$date2,6);
        $cat7 = $this->getChart('sl','order_detail.price',$date1,$date2,7);
        $cat8 = $this->getChart('sl','order_detail.price',$date1,$date2,8);
        $cat9 = $this->getChart('sl','order_detail.price',$date1,$date2,9);
        $cat10 = $this->getChart('sl','order_detail.price',$date1,$date2,16);
        $cat = $this->getAllData('category');

        $name0 = $cat[0]['category_name'];
        $sl0= !empty($cat1['sum(sl)']) ? $cat1['sum(sl)'] : 0 ;
        $category1 ="['$name0', $sl0],";

        $name1 = $cat[1]['category_name'];
        $sl1= !empty($cat2['sum(sl)']) ? $cat2['sum(sl)'] : 0 ;
        $category2 ="['$name1', $sl1],";

        $name2 = $cat[2]['category_name'];
        $sl2= !empty($cat3['sum(sl)']) ? $cat3['sum(sl)'] : 0 ;
        $category3 ="['$name2', $sl2],";

        $name3 = $cat[3]['category_name'];
        $sl3= !empty($cat4['sum(sl)']) ? $cat4['sum(sl)'] : 0 ;
        $category4 ="['$name3', $sl3],";

        $name4 = $cat[4]['category_name'];
        $sl4= !empty($cat5['sum(sl)']) ? $cat5['sum(sl)'] : 0 ;
        $category5 ="['$name4', $sl4],";

        $name5 = $cat[5]['category_name'];
        $sl5= !empty($cat6['sum(sl)']) ? $cat6['sum(sl)'] : 0 ;
        $category6 ="['$name5', $sl5],";

        $name6 = $cat[6]['category_name'];
        $sl6= !empty($cat7['sum(sl)']) ? $cat7['sum(sl)'] : 0 ;
        $category7 ="['$name6', $sl6],";

        $name7 = $cat[7]['category_name'];
        $sl7= !empty($cat8['sum(sl)']) ? $cat8['sum(sl)'] : 0 ;
        $category8 ="['$name7', $sl7],";


        $name8= $cat[8]['category_name'];
        $sl8= !empty($cat9['sum(sl)']) ? $cat9['sum(sl)'] : 0 ;
        $category9 ="['$name8', $sl8],";

        $name9= $cat[9]['category_name'];
        $sl9= !empty($cat10['sum(sl)']) ? $cat10['sum(sl)'] : 0 ;
        $category10 ="['$name9', $sl9],";
        return $this->render('chartsl',$year,$category1,$category2,$category3,$category4,$category5,$category6,$category7,$category8,$category9,$category10,[]);

    }

    public function render($file,$year,$category1,$category2,$category3,$category4,$category5,$category6,$category7,$category8,$category9,$category10,$data=[])
    {
        extract($data);
        include_once 'views/layout/' . $this->_module . '/header.php';
        include_once 'views/layout/' . $this->_module . '/sidebar.php';
        include_once 'views/' . $this->_module . '/' . $file . '.php';
        include_once 'views/layout/' . $this->_module . '/footer.php';
    }


}
?>


