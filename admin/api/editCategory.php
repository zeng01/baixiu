<?php
    $id=$_REQUEST['id'];
   
    
    require_once "../tools/phpTools.php";

    $sql="select * from categories where id=$id";

    $arr=mysqli_select($sql);

    echo json_encode($arr);
?>