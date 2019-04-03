<?php
    //增删改
    function mysqli_Excute($sql){
        //连接数据库
        $link=mysqli_connect("127.0.0.1","root","root","baixiu");
        //执行sql语句
        mysqli_query($link,$sql);

        $rows=mysqli_affected_rows($link);//返回受影响的行数

        //关闭数据库
        mysqli_close($link);

        return $rows;
    }

    //查
    function mysqli_select($sql){
        //连接数据库
        $link=mysqli_connect("127.0.0.1","root","root","baixiu");
        //执行sql语句
        $select=mysqli_query($link,$sql);

        //执行查询的结果
        $arr=mysqli_fetch_all($select,1);

        //关闭数据库
        mysqli_close($link);

        return $arr;
    }
?>