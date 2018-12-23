<?php
/******テーブル作成*******/
//MySQLに接続
$dsn='データベース名';
$user='ユーザー名';
$password='パスワード';
$pdo=new PDO($dsn, $user, $password); //接続

//テーブル作成
$sql="CREATE TABLE tb_diary"//テーブル作成
."("
."ID INT not null primary key,"
."date TEXT," //日付
."name char(32)," //ユーザー名
."weather TEXT," //パスワード
."picture MEDIUMBLOB," //画像
."mime VARCHAR(64)," //MIMEタイプ
."comment TEXT" //ニックネーム
.");";
$stmt=$pdo->query($sql);
?>

<?php
/*******データベースにテーブル作成されているか確認******/
$sql='SHOW TABLES';
$result=$pdo->query($sql);
foreach($result as $row){
 echo $row[0];
 echo '<br>';
} //foreach
echo "<hr>";
?>

<?php
/********テーブルの中身確認*******/
$sql='SHOW CREATE TABLE tb_diary';
$result=$pdo->query($sql);
foreach($result as $row){
 print_r($row);
} //foreach
echo "<hr>";


/*****データベースに入っている情報を表示******/

//データベースに入っているデータを表示（3-6)
$sql='SELECT*FROM tb_diary'; //selectですべてのデータ取得
$results= $pdo->query($sql);
foreach ($results as $row){ //1つずつ取り出し
 echo $row['ID'].'<br>';
 //echo $row['picture'].',';
 //echo $row['comment'].'<br>'; 
}//foreach

$sql='SELECT*FROM tb_diary order by ID asc'; //selectですべてのデータ取得
$results= $pdo->query($sql);
foreach ($results as $row){ //1つずつ取り出し
 echo $row['ID'].'<br>';
 //echo $row['picture'].',';
 //echo $row['comment'].'<br>'; 
}//foreach
?>
