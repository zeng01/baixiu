<?php
    // 增加用户

    //接收数据
    $email=$_POST['email'];
    $slug=$_POST['slug'];
    $nickname=$_POST['nickname'];
    $password=$_POST['password'];

    $type=$_POST['type'];

    require_once "../tools/phpTools.php";
    
    if($type=='add'){
        $sql="insert into users(email,slug,nickname,password,avatar,status) 
                values('$email','$slug','$nickname','$password','/uploads/avatar_3.jpg','unactivated')";
    }else{
        $id=$_POST['id'];
        $sql="update users set email='$email',slug='$slug',nickname='$nickname',password='$password',status='activated' where id=$id";
    }
    $rows=mysqli_Excute($sql);

    if($rows>0){
        echo '{"code":"10000","msg": "ok"}';
    }else{
        echo '{"code":"10001","msg": "fail"}';
    }
?>