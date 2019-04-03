<?php
    // 删除session
    session_start();
    unset($_SESSION['userInfo']);

    // 返回首页
    header('location:../login.html');
    
?>