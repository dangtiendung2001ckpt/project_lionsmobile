<?php
include_once "models/showdata.php";
class StatisticalController extends ShowData
{
    protected $_module = 'backend';
    function homes()
    {
        if (isset($_POST['submit']) && $_POST['cat'] != "" ){
            $cat=$_POST['cat'];
            $year=isset($_GET['pages']) ? $_GET['pages'] : 2020 ;

            $t1=$this->statistical($year,01,01,31,'product.category_id',$cat);

            $t2=$this->statistical($year,02,01,29,'product.category_id',$cat);

            $t3=$this->statistical($year,03,01,31,'product.category_id',$cat);

            $t4=$this->statistical($year,04,01,30,'product.category_id',$cat);

            $t5=$this->statistical($year,05,01,31,'product.category_id',$cat);

            $t6=$this->statistical($year,06,01,30,'product.category_id',$cat);

            $t7=$this->statistical($year,07,01,31,'product.category_id',$cat);

            $t8=$this->statistical($year,8,01,31,'product.category_id',$cat);

            $t9=$this->statistical($year,9,01,30,'product.category_id',$cat);

            $t10=$this->statistical($year,10,01,31,'product.category_id',$cat);

            $t11=$this->statistical($year,11,01,30,'product.category_id',$cat);

            $t12=$this->statistical($year,12,01,31,'product.category_id',$cat);
            $category= $this->getAllData('category');
            $cat_name = $this->getData('category','category_id',$cat);
            return $this->render('statistical',$year,['cat'=>$cat_name,'category'=>$category,'t1'=>$t1,'t2'=>$t2,'t3'=>$t3,'t4'=>$t4,'t5'=>$t5,'t6'=>$t6,'t7'=>$t7,'t8'=>$t8,'t9'=>$t9,'t10'=>$t10,'t11'=>$t11,'t12'=>$t12]);


        }else{
            $year=isset($_GET['pages']) ? $_GET['pages'] : 2020 ;
            $t1=$this->statistical($year,01,01,31,1,1);

            $t2=$this->statistical($year,02,01,29,1,1);

            $t3=$this->statistical($year,03,01,31,1,1);

            $t4=$this->statistical($year,04,01,30,1,1);

            $t5=$this->statistical($year,05,01,31,1,1);

            $t6=$this->statistical($year,06,01,30,1,1);

            $t7=$this->statistical($year,07,01,31,1,1);

            $t8=$this->statistical($year,8,01,31,1,1);

            $t9=$this->statistical($year,9,01,30,1,1);

            $t10=$this->statistical($year,10,01,31,1,1);

            $t11=$this->statistical($year,11,01,30,1,1);

            $t12=$this->statistical($year,12,01,31,1,1);
            $category= $this->getAllData('category');

            return $this->render('statistical',$year,['category'=>$category,'t1'=>$t1,'t2'=>$t2,'t3'=>$t3,'t4'=>$t4,'t5'=>$t5,'t6'=>$t6,'t7'=>$t7,'t8'=>$t8,'t9'=>$t9,'t10'=>$t10,'t11'=>$t11,'t12'=>$t12]);
        }
    }
    public function render($file,$year,$data=[])
    {
        extract($data);
        include_once 'views/layout/' . $this->_module . '/header.php';
        include_once 'views/layout/' . $this->_module . '/sidebar.php';
        include_once 'views/' . $this->_module . '/' . $file . '.php';
        include_once 'views/layout/' . $this->_module . '/footer.php';
    }
    function statistical($year,$month1,$day1,$day2,$dk,$dk1){
        $date1=$year.'-'.$month1.'-'.$day1;
        $date2=$year.'-'.$month1.'-'.$day2;
        $month= $this->getStatistical('sl','order_detail.price',$date1,$date2,$dk,$dk1);
        return $month;
    }

}
?>