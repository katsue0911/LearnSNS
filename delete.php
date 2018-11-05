<?php
// DBに接続
    require('dbconnect.php');
    require('functions.php');
    v($_GET['feed_id'],"feed_id");

// 削除したいFeedのIDを取得
    $feed_id = $_GET['feed_id'];


// Delete文作成
    $sql = "DELETE FROM `feeds` WHERE `feeds`. `id` =?";



// Delete文実行(SQLインジェクションを防ぐ)
    $data = array($feed_id);//消したいデータ全部を何を使って引っ張ってくるか？の指定
    $stmt = $dbh->prepare($sql); //SQL文を用意。
    $stmt->execute($data);//$dataのデータを元に、全部消去！



// タイムライン一覧にもどる
    header('Location: timeline.php');
    exit();




?>