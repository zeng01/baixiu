<?php
    // 显示分类的数据
    require_once "../tools/phpTools.php";

    $sql="select * from categories";
    $arr=mysqli_select($sql);
    
    echo json_encode($arr);
?>