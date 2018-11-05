<?php
    session_start();
    require('functions.php');
    require('dbconnect.php');

    // v($_SESSION["id"],'$_SESSION["id"]');

    //ユーザー情報の取得
    $sql = 'SELECT * FROM `users` WHERE `id`=?';
    $data = array($_SESSION["id"]);//WHEREで入れたやつだけでOK
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);
    $signin_user = $stmt->fetch(PDO::FETCH_ASSOC);

    v($signin_user,'$signin_user');
  //練習問題１
  //$validations連想配列を使って、投稿データが空文字の場合、入力欄下に「投稿データを入力してください。」と表示。
  // 投稿データがある場合、メッセージが表示されないようにしましょう。
    $validations=[];

    if(!empty($_POST)){

        $feed = $_POST['feed'];
        if($feed == ''){
          $validations['feed'] = 'blank';
        }else{
          // DBに投稿データを保存する
        $sql = 'INSERT INTO `feeds` SET `user_id`=?, `feed`=?,`created`=NOW()';
        $stmt = $dbh->prepare($sql);//PHPにMYSQLの言語を準備させるコード
        $data = array($signin_user['id'],$feed);
        $stmt->execute($data);//PHPに実行させるコード
        }

    }


  ?>


<!DOCTYPE html>
<html lang="ja">
<head>
  <title></title>
<meta charset="utf-8">
  <style>
    .error_msg{
      color: red;
      font-size: 12px;
    }
  </style>
</head>
<body>
  ユーザー情報[<img width="50" src="user_profile_img/<?php echo $signin_user['img_name'];  ?>" />
  <?php echo $signin_user["name"]; ?>]

  [<a href="signout.php">サインアウト</a>]
  <form method="POST" action="">
  <textarea rows="5" name="feed"></textarea>
  <input type="submit" value="投稿">
  <?php if(isset($validations['feed']) && $validations['feed'] == 'blank'): ?>
  <br>
  <span class="error_msg">投稿データを入力してください。</span>
   <?php endif; ?>
  </form>
</body>
</html>







