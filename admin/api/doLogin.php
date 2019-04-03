<?php
    
    //接收数据
    $email=$_REQUEST['email'];
    $password=$_REQUEST['password'];

    //导入数据库工具
    include_once "../tools/phpTools.php";
    // 执行sql
    $sql="select * from users where email='$email' and password='$password' ";

    $arr=mysqli_select($sql);

    if(count($arr)>0){
        echo '{"code":"10000","msg": "ok"}';
        //开启session
        session_start();
        $_SESSION['userInfo']=$arr[0];
    }else{
        //账户或者密码错误
        echo '{"code":"10001","msg": "fail"}';
    }

?>