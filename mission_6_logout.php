<?php
session_start();
//MySQLに接続
$dsn='データベース名';
$user='ユーザー名';
$password='パスワード';
$pdo=new PDO($dsn, $user, $password); //接続
/******このページに飛んだユーザーをログアウト*******/
 session_destroy();
 unset($_SESSION['user']); //セッションを削除？
 header("Location:mission_6_loginform.php"); //ログインページに飛ぶ
 exit();

?>