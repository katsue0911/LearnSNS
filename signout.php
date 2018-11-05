<?php 
    session_start();


    //SESSION変数の破棄（箱の中身のクリア）
    $_SESSION = [];

    //サーバー内の$_SESSION変数のクリア(箱ごとのクリア)
    session_destroy();


    // signin.phpへの移動
    header("Location:signin.php");
    exit(); //これ以降の処理を行わない（ここで終了する）



?>