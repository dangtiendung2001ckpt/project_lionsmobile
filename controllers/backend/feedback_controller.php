<?php
include_once 'Models/delete.php';
class FeedbackController extends DeleteValue
{
    protected $_module = 'backend';
    function homes()
    {
        $limit=10;
        $pages= isset($_GET['pages']) ? $_GET['pages'] : 1;
        $offset=($pages - 1) * $limit;
        $feedbacks=$this->getDatas('feedback','feedback_id','DESC',$limit,$offset);
        $totalpage = $this->num_rowTable('feedback');
        $totalpage =ceil($totalpage / $limit);

        return $this->render('feedback',$totalpage,$offset,$pages,['feedback'=>$feedbacks]);

    }
    public function render($file,$totalpage,$offset,$pages,$data=[])
    {
        extract($data);
        include_once 'views/layout/' . $this->_module . '/header.php';
        include_once 'views/layout/' . $this->_module . '/sidebar.php';
        include_once 'views/' . $this->_module . '/' . $file . '.php';
        include_once 'views/layout/' . $this->_module . '/footer.php';
    }






    function update_cmt(){
        if ( isset($_GET['id']) && $_GET['id'] != ""){
            $pages = isset($_GET['page']) ? $_GET['page'] : 1;
            $id = $_GET['id'];
            $this->updateValue('feedback','defaults',1,'feedback_id',$id);
            header("location:index.php?module=$this->_module&control=feedback&pages=$pages");
        }else{
            header("location:index.php?module=$this->_module&control=feedback");
        }
    }

    function del_cmt(){
        if ( isset($_GET['id']) && $_GET['id'] != ""){
            $id= $_GET['id'];
            $pages= isset($_GET['page']) ? $_GET['page'] : 1;
            $this->delete('feedback','feedback_id',$id);
            header("location:index.php?module=$this->_module&control=feedback&pages=$pages");
        }else{
            header("location:index.php?module=$this->_module&control=feedback");
        }

    }

}
?>