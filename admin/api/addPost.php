<?php

    //添加文章的数据

    // 接收数据
    $title=$_POST['title'];
    $content=$_POST['content'];
    $slug=$_POST['slug'];
    $feature=$_FILES['feature'];
    $category=$_POST['category'];
    $created=$_POST['created'];
    $status=$_POST['status'];

    //临时路径
    $tmpPath=$feature['tmp_name'];
    //文件名
    $tmpName=$feature['name'];
    $newName=iconv('utf-8','gbk',$tmpName);

    //新路径
    $newPath="../../uploads/$newName";
    move_uploaded_file($tmpPath,$newPath);

    // 获取user_id
    session_start();
    $id=$_SESSION['userInfo']['id'];

    require_once "../tools/phpTools.php";

    $sql="insert into posts(title,content,slug,feature,category_id,created,status,user_id) 
            values('$title','$content','$slug','../../uploads/$tmpName','$category','$created','$status','$id')";
    $rows=mysqli_Excute($sql);

    if($rows>0){
        echo '{"code":"10000","msg": "ok"}';
    }else{
        echo '{"code":"10001","msg": "fail"}';
    }
?>