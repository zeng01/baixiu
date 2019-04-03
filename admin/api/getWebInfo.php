<?php
    //导入数据库工具
    require_once "../tools/phpTools.php";

    // -- 查询出所有文章（没有被删除的）
    $sql="select * from posts where status != 'trashed'";
    $res=mysqli_select($sql);
    $wenzhang=count($res);
    
    // -- 查询出所有草稿
    $sql="select * from posts where status = 'drafted'";
    $res=mysqli_select($sql);
    $caogao=count($res);

    // -- 查询出所有评论（没有被删除的）
    $sql="select * from comments where status != 'trashed'";
    $res=mysqli_select($sql);
    $pinglun=count($res);

    // -- 查询出所有分类
    $sql="select * from categories";
    $res=mysqli_select($sql);
    $fenlei=count($res);

    // -- 查询出待审核的评论
    $sql="select * from comments where status = 'held'";
    $res=mysqli_select($sql);
    $weishenhe=count($res);

    $obj=Array(
        "wenzhang" => $wenzhang,
        "caogao" => $caogao,
        "pinglun" => $pinglun,
        "weishenhe" => $weishenhe,
        "fenlei" => $fenlei
    );

    //转换成json

    echo json_encode($obj);
?>