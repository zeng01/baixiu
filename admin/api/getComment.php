<?php
    //显示所有评论的数据
    
    // 接收页码
    $pageIndex=$_GET['pageIndex'];
    $pageSize=$_GET['pageSize'];

    #从哪个下标开始
    $page=($pageIndex -1 )*10;

    require_once "../tools/phpTools.php";
    //查询评论（分页）
    $sql="select c.id,c.author,c.content,p.title,c.created,c.status from 
    comments c inner join posts p on c.post_id = p.id  where 
    c.status != 'trashed' order by c.id asc limit $page,$pageSize";
    $arr=mysqli_select($sql);

    // echo json_encode($arr);

    //查询所有评论
    $sql2="select c.id,c.author,c.content,p.title,c.created,c.status from 
    comments c inner join posts p on c.post_id = p.id  where 
    c.status != 'trashed'";

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