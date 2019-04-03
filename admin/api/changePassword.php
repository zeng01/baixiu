<?php
    //判断旧密码
    $oldPwd=$_POST['oldPwd'];

    session_start();


    if($oldPwd != $_SESSION['userInfo']['password'] ){
        echo '{"code":"10001","msg": "旧密码输入错误！"}';
        return;
    }

    $newPwd=$_POST['newPwd'];
    $id=$_SESSION['userInfo']['id'];

    require_once '../tools/phpTools.php';

    $sql="update users set password='$newPwd' where id=$id";

    $rows=mysqli_Excute($sql);

    if($rows){
        echo '{"code":"10000","msg": "密码修改成功！"}';
    }else{
        echo '{"code":"10002","msg": "密码修改失败！"}';
    }
?>