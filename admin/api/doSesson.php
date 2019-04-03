<?php

    //判断有没有session
    session_start();

    if(isset($_SESSION['userInfo'])){
        // 有
        echo '{"code":"10000","msg": "ok"}';
    }else{
        // 没有
        echo '{"code":"10001","msg": "fail"}';
    }
    
?>