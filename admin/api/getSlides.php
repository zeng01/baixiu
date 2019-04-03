<?php
    //显示轮播图的数据
    require_once '../tools/phpTools.php';

    $sql='select * from sliders';

    $arr=mysqli_select($sql);
    
    echo json_encode($arr);
?>