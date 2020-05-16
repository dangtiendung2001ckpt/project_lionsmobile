<?php
include_once 'models/addnew.php';
class FeedbackController extends Addnew {
    /*
    function homes()
    {
        if (isset($_GET["id"]) && $_GET["id"] != ""){
            $id=$_GET["id"];
            if ($_POST["content"] == ""){
                header("location:index.php?control=products&action=details&id=$id");
            }else{
                if (isset($_SESSION["user_id"]) && $_SESSION["user_id"] == 18) {
                    $row=$this->row('product','product_id',$id);
                    if ($row == 1){
                        $content=$_POST["content"];
                        $admin=$_SESSION["user_id"];
                        $this->insertFeedback($admin,$id,$content,1);
                        header("location:index.php?control=products&action=details&id=$id");
                    }else{
                        header("location:index.php?control=products&action=details&id=$id");
                    }
                }else{
                    $user_id= isset($_SESSION["user_id"]) ? $_SESSION["user_id"] : 12;
                    $row=$this->row('product','product_id',$id);
                    if ($row == 1){
                        $content=$_POST["content"];
                        $this->insertFeedback($user_id,$id,$content,0);
                        header("location:index.php?control=products&action=details&id=$id&str=1");
                    }else{
                        header("location:index.php?control=products&action=details&id=$id");
                    }
                }
            }
        }else{
            header("location:index.php?control=products");
        }
    }
*/
    function addnew(){
        if ($_POST["content"] != ""){
            $html="";
            $text ="";
            $id = $_POST['product_id'];
            if (isset($_SESSION["user_id"]) && $_SESSION["user_id"] == 18) {
                $row=$this->row('product','product_id',$id);
                if ($row == 1){
                    $content=$_POST["content"];
                    $admin=$_SESSION["user_id"];
                    $this->insertFeedback($admin,$id,$content,1);
                    $html = true;
                }else{
                    $text = "";
                }
            }else{
                $user_id= isset($_SESSION["user_id"]) ? $_SESSION["user_id"] : 12;
                $row=$this->row('product','product_id',$id);
                if ($row == 1){
                    $content=$_POST["content"];
                    $this->insertFeedback($user_id,$id,$content,0);
                    $text = "Bình luận của bạn đang được xét duyệt.Xin cảm ơn bạn đã đánh giá.";

                }else{
                    $text = "";
                }
            }
        }else{
            $text = "";
        }
        $r = [
            'html' => $html,
            'text' => $text,
        ];
        echo json_encode($r);

    }
}
?>