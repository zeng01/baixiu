<?php


    // 处理点赞数
    $id=$_POST['id'];

    require_once "../tools/phpTools.php";

    $sql="select id,likes from posts where status='published' and id=$id";
    $arr=mysqli_select($sql)[0];
    $likes=$arr['likes'];
    $likes=$likes + 1;

    $sql2="update posts set likes=$likes where id=$id";

    $rows=mysqli_Excute($sql2);

    if($rows){
        echo $likes;
    }else{
        echo 'fali';
    }
?>