<?php
    //显示所有文章的数据
    // 接收页码
    // $pageIndex=$_GET['pageIndex'];
    // // 一页显示多少条
    // $pageSize=$_GET['pageSize'];

    $pageIndex=0;
    // 一页显示多少条
    $pageSize=10;

    #从哪个下标开始
    $page=($pageIndex -1 )*10;

    require_once "../tools/phpTools.php";
    //查询所有文章（没被删除的）
    $sql="select p.id,p.slug,p.title,p.created,p.status,c.name from 
    posts p inner join categories c on p.category_id = c.id  where 
    p.status != 'trashed' order by p.id asc limit 0,10";
    $arr=mysqli_select($sql);
    var_dump($arr);
    //总数据
    $pageAll=count($arr);    
    // 总共有多少页
    $page=ceil($pageAll/$pageSize);

    $str=Array();
    for ($i=0; $i <$page ; $i++) { 
        array_push($i);
    }
    echo $str;
        
?>