<?php
/********バイナリデータを描画するファイル*********/
session_start();

/*****データベースに入っている情報を表示******/

//MySQLに接続
$dsn='データベース名';
$user='ユーザー名';
$password='パスワード';
$pdo=new PDO($dsn, $user, $password); //接続

//URLパラメータ
$id=$_GET['id'];
//SQL分を準備
$sql='SELECT*FROM tb_diary WHERE ID="'.$id.'" order by date desc'; //selectで降順にすべてのデータ取得
$prepare= $pdo->query($sql);
//結果をカラム名をキーとした？連想配列？で取得(p.688)
$result=$prepare->fetch(PDO::FETCH_ASSOC);
if($result){
 header("Content-Type:".$row['mime']);
 echo $result['picture'];
}else{
 echo "miss";
}
?>