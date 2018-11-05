<?php
    session_start();
    require('functions.php');
    require('dbconnect.php');

    v($_POST, '$_POST');

    $validations = [];

    //POST送信されたら
    if (!empty($_POST)) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        //空バリデーション
        if($email != '' && $password != ''){
            //からじゃなければ
            $sql = 'SELECT * FROM `users`WHERE `email`=?';
            //emailは被らないからemailで検索
            $stmt = $dbh->prepare($sql);
            $data = [$email];
            $stmt->execute($data);
            $record = $stmt->fetch(PDO::FETCH_ASSOC);//SELECTで持ってきたら必ずfetchを持ってくる！

          v($record,'$record');
          //メールアドレスがあっていない時
          if ($record == false) {
              $validations['signin'] = 'failed';
          }else{
              //パスワードの照合をかける
              $verify=password_verify($password, $record['password']);//一致していたらtrue
              if ($verify == true) {
                  //サインイン成功
                  $_SESSION["id"] = $record["id"];
                  header('Location: timeline.php');
                  exit();
              }else{
                  //パスワードミスったら
                  $validations['signin'] = 'failed';
              }

            }



          }else{
              //そうじゃなければblank
              $validations['signin'] = 'blank';
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
      color:red;
    }
  </style>
</head>
<body>
  <h1>サインイン</h1>
  <form method="POST" action="">
    <div>
      メールアドレス<br>
      <input type="email" name="email" value="">
      <?php if(isset($validations['signin'])&& $validations['signin'] == 'blank'): ?>
        <span class="error_msg">メールアドレスとパスワードは正しく入力してください。</span>
      <?php endif; ?>

      <?php if(isset($validations['signin'])&& $validations['signin'] == 'failed'): ?>
        <span class="error_msg">サインインに失敗しました。</span>
      <?php endif; ?>

    </div>

    <div>
      パスワード<br>
      <input type="password" name="password" value="">
    </div>

    <input type="submit" name="サインイン">
  </form>
</body>
</html>