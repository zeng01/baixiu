<?php
    //添加分类的数据

    //接收数据
    $name=$_POST['name'];
    $slug=$_POST['slug'];

    // 引入数据库
    require_once "../tools/phpTools.php";

    // 添加sql
    $sql="insert into categories(name,slug) values('$name','$slug')";
    $rows=mysqli_Excute($sql);

    if($rows>0){
        echo '{"code":"10000","msg": "ok"}';
    }else{
        echo '{"code":"10001","msg": "fail"}';
    }

?>