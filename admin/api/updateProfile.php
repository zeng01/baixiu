<?php
    //更新个人信息

    $email=$_POST['email'];
    
    $avatar=$_FILES['avatar'];
    $slug=$_POST['slug'];
    $nickname=$_POST['nickname'];
    $bio=$_POST['bio'];

    $name=$avatar['name'];
    $tmp_path=$avatar['tmp_name'];
    $newname=iconv('utf-8','gbk',$name);
    $new_path="../../uploads/$newname";
    move_uploaded_file($tmp_path,$new_path);

    require_once '../tools/phpTools.php';

    if($name==""){
        $sql="update users set slug='$slug',nickname='$nickname',bio='$bio' where email='$email'";
    }else{
        $sql="update users set avatar='../../uploads/$name',slug='$slug',nickname='$nickname',bio='$bio' where email='$email'";
    }

    $rows=mysqli_Excute($sql);

    if($rows>0){
        session_start();
        $_SESSION['userInfo']['slug']=$slug;
        $_SESSION['userInfo']['nickname']=$nickname;
        $_SESSION['userInfo']['bio']=$bio;
        if($name !='')
            $_SESSION['userInfo']['avatar']="../../uploads/$name";
        echo '{"code":"10000","msg": "ok"}';
    }else{
        echo '{"code":"10001","msg": "fail"}';
    }
?>