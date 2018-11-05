<?php
    session_start();
    require('../functions.php');


    v($_POST,'$_POST');

    //①バリデーション格納用の配列を用意
    $validations = array();
    $name = '';
    $email = '';

    if (!empty($_POST)) {

      $name = $_POST['name'];
      $email = $_POST['email'];
      $password = $_POST['password'];

        if ($name == '') {
            $validations['name'] = 'blank'; //②もしユーザーが何も入力しなければ配列にblankが入る
        }

        if ($email == '') {
            $validations['email'] = 'blank'; //②もしユーザーが何も入力しなければ配列にblankが入る
        }

        $c = strlen($password);
        if ($password == '') {
            $validations['password'] = 'blank'; //②もしユーザーが何も入力しなければ配列にblankが入る

        }elseif ($c < 4 || 16 <$c) {  //elseif出なく、ifにしたら、前のifを上書きする形になるので、必ずelseifにする。
            $validations['password'] = 'length';
        }
        //画像の選択
        $file_name = $_FILES['img_name']['name'];
        v($file_name, '$file_name');
        if ($file_name == '') {
          $validations['img_name'] = 'blank';
        }




        if (empty($validations)) {      //③ということは、配列内に何も入ってなければ、ユーザーが入れているから次のページに飛ぶ
            
            v($_FILES, '$_FILES');
            //move_uploaded_file(送りたいファイル、送信先)
            $tmp_file = $_FILES['img_name']['tmp_name'];//選択した画像データ
            $file_name=date('YmdHis') . $_FILES['img_name']['name'];
            $destination = '../user_profile_img/' . $file_name;
            //どこに、何を入れたいかを指定（登録先と保存名）下でinputで指定した名前のファイル名、という配列を入れる→時間でファイル名が被らないように、$file_nameを定義する。
            move_uploaded_file($tmp_file, $destination);


            $_SESSION['46_LearnSNS']['name'] = $name;  //$_SESSIONを使う時に入力　二次元のデーターベースにしておく。
            $_SESSION['46_LearnSNS']['email'] = $email;  //$_SESSIONを使う時に入力　二次元のデーターベースにしておく。
            $_SESSION['46_LearnSNS']['password'] = $password;  //$_SESSIONを使う時に入力　二次元のデーターベースにしておく。
            $_SESSION['46_LearnSNS']['file_name'] = $file_name;  //$_SESSIONを使う時に入力　二次元のデーターベースにしておく。

           header('Location: check.php'); //headerは、リンクタグと同じ動きをする。
           exit();
        }

    }
?>


<!DOCTYPE html>
<html lang="ja"><head>
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
  <h1>ユーザー登録</h1>
  <form method="POST" action="" enctype="multipart/form-data">
    <div>
      ユーザー名<br>
      <input type="text" name="name" value="<?=$name; ?>">
      <?php if(isset($validations['name']) && $validations['name'] == 'blank'): ?>
        <span class="error_msg">ユーザー名を入力してください</span>
      <?php endif; ?>

    </div>

    <div>
      メールアドレス<br>
      <input type="email" name="email" value="<?=$email; ?>">
      <?php if(isset($validations['email']) && $validations['email'] == 'blank'): ?>
      <span class="error_msg">Emailを入力してください</span>
      <?php endif; ?>

    </div>

    <div>
      パスワード<br>
      <input type="password" name="password" value="">
      <?php if(isset($validations['password']) && $validations['password'] == 'blank'): ?>
      <span class="error_msg">passwordを入力してください</span>
      <?php elseif(isset($validations['password']) && $validations['password'] == 'length'): ?>
      <span class="error_msg">パスワードは４〜１６文字で設定してください。</span>
      <?php endif; ?>
    </div>

    <div>
      プロフィール画像<br>
      <input type="file" name="img_name" accept="image/*">
      <!-- nameはDBのカラム名と合わせると楽 -->
      <?php if(isset($validations['img_name']) && $validations['img_name'] == 'blank'): ?>
      <span class="error_msg">画像を選択してください。</span>
      <?php endif; ?>

    </div>

    <input type="submit" value="確認">
  </form>
</body>
</html>



















