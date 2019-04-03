<?php
    //编辑分类的数据

    //接受需操作的哪条数据 
    $name=$_POST['name'];
    $slug=$_POST['slug'];
    $type=$_POST['type'];

    require_once "../tools/phpTools.php";
    if($type=="add"){
        $sql="insert into categories(name,slug) values('$name','$slug')";
    }else{
        $id=$_POST['id'];
        $sql="update categories set name='$name',slug='$slug' where id in ($id)";
    }
    $rows=mysqli_Excute($sql);


    if($rows>0){
        echo '{"code":"10000","msg": "ok"}';
    }else{
        echo '{"code":"10001","msg": "fail"}';
    }

?>