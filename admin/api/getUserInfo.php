<?php

    //用户头像和昵称显示出来

    session_start();

    $userInfo=$_SESSION['userInfo'];

    echo json_encode($userInfo);
?>