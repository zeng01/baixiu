<?php
    //操作评论的数据

    //接受需操作的哪条数据
    $status=$_POST['status'];
    $id=$_POST['id'];

    require_once "../tools/phpTools.php";

    $sql="update comments set status = '$status' where id in ($id)";

    $rows=mysqli_Excute($sql);


    if($rows>0){
        echo '{"code":"10000","msg": "ok"}';

    }else{
        echo '{"code":"10001","msg": "fail"}';
    }

?>