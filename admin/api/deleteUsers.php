<?php
    //删除用户

    //接受id
    $id=$_POST['id'];

    require_once "../tools/phpTools.php";

    $sql="update users set status = 'trashed' where id in ($id)";

    $rows=mysqli_Excute($sql);


    if($rows>0){
        echo '{"code":"10000","msg": "ok"}';
    }else{
        echo '{"code":"10001","msg": "fail"}';
    }

?>