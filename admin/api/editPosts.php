<?php
    
    //修改文章的数据

    // 接收数据
    $onceId=$_POST['id'];
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
        $newName=iconv('utf-8', 'gbk', $tmpName);

        //新路径
        $newPath="../../uploads/$newName";
        move_uploaded_file($tmpPath, $newPath);

        // 获取user_id
        session_start();
        $id=$_SESSION['userInfo']['id'];

        require_once "../tools/phpTools.php";

    //判断头像有没有修改,头像名是否为空
    if (strlen($tmpName)) {
        // 有修改头像，就需处理头像
        $sql="update posts set title='$title',content='$content',slug='$slug',feature='../../uploads/$tmpName',                      category_id='$category',created='$created',status='$status',user_id='$id' where id=$onceId";
    } else {
        // 没有修改头像，修改其他
        $sql="update posts set title='$title',content='$content',slug='$slug',category_id='$category',
            created='$created',status='$status',user_id='$id' where id=$onceId";
    }
        $rows=mysqli_Excute($sql);

        if ($rows>0) {
            echo '{"code":"10000","msg": "ok"}';
        } else {
            echo '{"code":"10001","msg": "fail"}';
        }
