<?php

//MySQLに接続
//MySQLに接続
$dsn='データベース名';
$user='ユーザー名';
$password='パスワード';
$pdo=new PDO($dsn, $user, $password); //接続

/*****テーブルを削除******/
$sql="DROP TABLE tb_diary";
$stmt=$pdo->query($sql);

?>
