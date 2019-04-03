<?php
    //添加轮播图的数据

    $image=$_FILES['image'];
    $text=$_POST['text'];
    $link=$_POST['link'];

    $name=$image['name'];
    $tmp_path=$image['tmp_name'];
    $newname=iconv('utf-8','gbk',$name);
    $new_path="../../uploads/$newname";
    move_uploaded_file($tmp_path,$new_path);
    
    require_once '../tools/phpTools.php';

    $sql="insert into sliders(image,text,link) values('../../uploads/$name','$text','$link')";

    $rows=mysqli_Excute($sql);

    if($rows>0){
        echo '{"code":"10000","msg": "ok"}';
    }else{
        echo '{"code":"10001","msg": "fail"}';
    }
?>