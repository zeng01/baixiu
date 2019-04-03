<?php
    
    //查询所有用户

    require_once "../tools/phpTools.php";

    $sql="select * from users where status != 'trashed'";

    $arr=mysqli_select($sql);

    echo json_encode($arr);
    
?>