<?php
    //显示所有文章的数据
    
    // 接收页码
    $pageIndex=$_GET['pageIndex'];
    $pageSize=$_GET['pageSize'];
    $categories=$_GET['categories'];
    $status=$_GET['status'];
    
    #从哪个下标开始
    $page=($pageIndex -1 )*10;

    require_once "../tools/phpTools.php";
    //查询分页的文章（没被删除的）
    $sql="select p.id,p.title,u.nickname,c.name,p.created,p.status from 
    posts p inner join users u on p.user_id = u.id 
    inner join categories c on p.category_id = c.id  where 
    p.status != 'trashed'";

    //做筛选
    if($categories !="所有分类"){
        $sql .="and c.name='$categories'";
    }

    if($status !="所有状态"){
        $sql .="and p.status='$status'";
    }

    // 在分页前先计算总数据
    $sql2=$sql;

    $sql .="order by p.id desc limit $page,$pageSize";

    $arr=mysqli_select($sql);

    // echo json_encode($arr);

    // 查询所有文章

    // $sql2="select * from posts where status != 'trashed'";

    $arr1=mysqli_select($sql2);


    //总数据
    $pageAll=count($arr1);    
    // 总共有多少页
    $totalPage=ceil($pageAll/$pageSize);

    $arrayName = array(
        'data' =>$arr,
        'totalPage' => $totalPage
    );

    echo json_encode($arrayName);
?>