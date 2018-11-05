<?php
    // echoのカスタマイズ
    function e($val) {
        // 開発中はエラー探しのために表示。
        // リリース時には非表示。
        if (true) {
            echo $val;
        }
    }

    // var_dumpのカスタマイズ
    function v($val,$var_name) {
        if (true) {
            echo '<pre>';
            echo $var_name . '=';
            var_dump($val);
            echo '</pre>';
        }
    }

    // $hoge = array('hoge', 'fuga');
    // var_dump($hoge); // 普通にvar_dump

    // echo '<pre>';
    // var_dump($hoge); // 普通にpreで囲ってvar_dump
    // echo '</pre>';

    // v($hoge); // v関数


    // htmlspecialcharsのカスタマイズ
    function h($val) {
        return htmlspecialchars($val);
    }

    // echo '<h1>ほげ</h1>'; // 普通に出力した場合
    // echo htmlspecialchars('<h1>ほげ</h1>'); // 普通にhtmlspeacialcharsを使った場合
    // echo h('<h1>ほげ</h1>'); // h関数を使った場合
?>