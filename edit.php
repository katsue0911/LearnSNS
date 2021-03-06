<?php 
    require('dbconnect.php');
    require('functions.php');
    v($_GET['feed_id'],"feed_id");

    $feed_id = $_GET['feed_id'];

    $sql= "SELECT `f`.*, `u`.`name`, `u`.`img_name` AS `profile_image` FROM `feeds` AS `f` INNER JOIN `users` AS `u` ON `f`.`user_id` = `u`.`id` WHERE `f`.`id` = ?";
    $data = array($feed_id);
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);

    //取得できた編集対象のデータを$feedに格納
    $feed = $stmt->fetch(PDO::FETCH_ASSOC);

    //更新処理（更新ボタンが押された時発動）
       if (!empty($_POST)) {
        $update_sql = "UPDATE `feeds` SET `feed` = ? WHERE `feeds`.`id` = ?";//変更したつぶやきをDBに上書き保存する。
        //UPDATE 指定したいテーブル名　SET テーブルのカラム名　WHERE テーブルの何を元にUPDATEするか指定
        $data = array($_POST["feed"],$feed_id);//GET送信されたidは$feed_id
        $stmt = $dbh->prepare($update_sql);
        $stmt->execute($data);

        header("Location: timeline.php");
        exit();
    }

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>Learn SNS</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="assets/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body style="margin-top: 60px;">
    <div class="container">
        <div class="row">
            <!-- ここにコンテンツ -->
            <div class="col-xs-4 col-xs-offset-4">
                <form class="form-group" method="post" action="timeline.php">
                    <img src="user_profile_img/<?php echo $feed["profile_image"] ?>"  width="60">
                    <?= $feed['name'] ?><br>
                    <?= $feed['created']?><br>
                    <textarea name="feed" class="form-control"><?= $feed['feed'] ?></textarea>
                    <input type="submit" value="更新" class="btn btn-warning btn-xs">
                </form>
            </div>
        </div>
    </div>
    <script src="assets/js/jquery-3.1.1.js"></script>
    <script src="assets/js/jquery-migrate-1.4.1.js"></script>
    <script src="assets/js/bootstrap.js"></script>
</body>
</html>
