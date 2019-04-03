<?php
    $id=$_GET['id'];

    require_once "../tools/phpTools.php";

    $sql="select * from posts where id=$id";

    $arr=mysqli_select($sql);

    echo json_encode($arr[0]);
?>