<!DOCTYPE HTML>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1"><!--端末に合わせてブラウザを表示する（初期状態を1とする）-->
<title>会員登録ページ</title>
<link rel="stylesheet" href="mission_6_regi.css"><!--cssファイルを読みこむ-->
</head>
<body>
<!--*******会員登録フォーム*******-->
<form method="post" action="mission_6_registerform.php">
<h1>会員登録フォーム</h1> <!-- 第一見出し -->
 <dl>
  <dt>ユーザー名</dt>
   <dd>
    <input type="text" class="form" name="username_regi" placeholder="ユーザー名を入力" required/><!-- ユーザー名入力欄（requiredで必須項目）-->
   </dd>
</dl>

 <dl>
  <dt>パスワード</dt>
   <dd>
    <input type="password" class="form" name="pass_regi" placeholder="パスワードを入力" required/><!--パスワード入力欄（必須項目）-->
   </dd>
 </dl>

 <dl>
  <dt>ニックネーム</dt>
   <dd>
    <input type="text" class="form" name="nickname_regi" placeholder="ニックネームを入力" required/><!-- ニックネーム入力欄（requiredで必須項目）-->
   </dd>
 </dl>
<div class="regi">
  <button type="submit" class="regibutton" name="submitButton">登録</button><br/> <!--登録ボタン-->
</div>
 <a class="loginlink" href="http://tt-554.99sv-coco.com/mission_6_loginform.php">ログインはこちらから</a> <!--ログインページに飛べるようリンク--><br/>
</form>

<?php

/*****ユーザー新規登録********/
if(isset($_POST['submitButton'])){ //登録ボタン押されたとき
 if(!empty($_POST['username_regi']) && !empty($_POST['pass_regi']) && !empty($_POST['nickname_regi'])){ //空でない時
  //echo "ok";
  $username_regi=$_POST['username_regi'];
  $pass_regi=$_POST['pass_regi'];
  $nickname_regi=$_POST['nickname_regi'];
  //echo $username_regi.$pass_regi. $nickname_regi;

/*******過去に登録済みでないか確認*********/
//MySQLに接続
$dsn='データベース名';
$user='ユーザー名';
$password='パスワード';
$pdo=new PDO($dsn, $user, $password); //接続

 /********登録されていない場合挿入**********/

   //テーブルに投稿内容挿入
      $sql=$pdo->prepare("INSERT INTO tb_users(name,pass,nickname)VALUES (:name,:pass,:nickname)");    
      $sql->bindParam(':name', $username_regi, PDO::PARAM_STR);  //名前を文字列としてパラメータ(:name)に入れる
      $sql->bindParam(':pass', $pass_regi, PDO::PARAM_STR);//パスワード      
      $sql->bindParam(':nickname', $nickname_regi, PDO::PARAM_STR); //ニックネーム
      $username_regi=$_POST['username_regi'];
      $pass_regi=$_POST['pass_regi'];
      $nickname_regi=$_POST['nickname_regi'];
      $executed=$sql->execute();//prepare()内の実行

        if($executed){ //上記実行された場合
         echo "<br/>\n";
         echo "登録しました";
        }else{
         echo "<br/>\n";
         echo "既に登録済みです。ログインページからログインしてください";
        }
 }//if
}//if(isset)
?>

<?php
  //MySQlに接続
/*
//MySQLに接続
$dsn='データベース名';
$user='ユーザー名';
$password='パスワード';
$pdo=new PDO($dsn, $user, $password); //接続
*/

/********テーブルの中身確認*******/
/*$sql='SHOW CREATE TABLE table_users';
$result=$pdo->query($sql);
foreach($result as $row){
 print_r($row);
}
echo "<hr>";*/

/*****テーブルに入っている情報を表示******/
/*
$sql='SELECT*FROM tb_users'; 
$results= $pdo->query($sql);
foreach ($results as $row){ 
 echo "<br/>\n";
 echo $row['id'].',';
 echo $row['name'].',';
 echo $row['pass'].',';
 echo $row['nickname'].'<br>'; 
}//foreach
*/
?>
</body>
</html>