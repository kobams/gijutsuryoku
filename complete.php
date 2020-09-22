<?php

session_start();
session_regenerate_id(true);

mb_language("Japanese");
mb_internal_encoding("UTF-8");

// 管理者へメール送信
$to = 'mshd49@icloud.com';
$title = 'お問い合わせ';
$content = "件名：{$_SESSION['kenmei']}\r\nお名前：{$_SESSION['name']}\r\nメールアドレス：{$_SESSION['email']}\r\n電話番号：{$_SESSION['tel']}\r\n内容：{$_SESSION['message']}";
$send = mb_send_mail($to, $title, $content);

// ユーザへメール送信
if($send) {
    $to = $_SESSION['email'];
    $title = 'メール送信完了';
    $content = "送信内容は以下のようになっております。\r\n件名：{$_SESSION['kenmei']}\r\nお名前：{$_SESSION['name']}\r\nメールアドレス：{$_SESSION['email']}\r\n電話番号：{$_SESSION['tel']}\r\n内容：{$_SESSION['message']}";
    $send = mb_send_mail($to, $title, $content);
}

// データベースへ登録
$pdo = new PDO('mysql:host=localhost;dbname=example;charset=utf8', 'staff', 'Qwerty098!');
$sql = $pdo -> prepare('insert into contact values(null, ?, ?, ?, ?, ?)');
$db = $sql -> execute([$_SESSION['kenmei'], $_SESSION['name'], $_SESSION['email'], $_SESSION['tel'], $_SESSION['message']]);

require './header.php';

if($send) {
    echo '<h2>メールの送信が完了しました。</h2>';
} else {
    echo '<h2>メールの送信に失敗しました。</h2>';
}

if($db) {
    echo '<h2>データベースへの登録が完了しました。</h2>';
} else {
    echo '<h2>データベースへの登録に失敗しました。</h2>';
}

require './footer.php';

session_destroy();