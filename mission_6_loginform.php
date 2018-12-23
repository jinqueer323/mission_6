<!DOCTYPE HTML>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1"><!--端末に合わせてブラウザを表示する（初期状態を1とする）-->
<title>ログインページ</title>
<link rel="stylesheet" href="mission_6_loginform.css"><!--cssファイルを読みこむ-->
</head>
<body>
<!--*******ログインフォーム*******-->
<form method="post">
<h1>ログインフォーム</h1> <!-- 第一見出し -->
<div class="form-group1"><!-- フォームの第一グループ -->
 <input type="text" class="form" name="username_log" placeholder="ユーザー名を入力" required/><br/><!-- ユーザー名入力欄（requiredで必須項目）-->
</div>
<div class="form-group1"><!-- フォームの第二グループ-->
 <input type="password" class="form" name="pass_log" placeholder="パスワードを入力" required/><br/><!--パスワード入力欄（必須項目）-->
</div>
<div class="login">
<button class="loginbutton" type="submit"name="submit-button">ログイン</button><br/> <!--ログインボタン-->
</div>
<a class="regilink" href="http://tt-554.99sv-coco.com/mission_6_registerform.php">新規会員登録はこちらから</a> <!--会員登録ページに飛べるようリンク-->
</form>

<?php
/******セッション開始*******/
session_start();

/******ユーザー名とパスが一致していたらログイン********/
//エラーメッセージの初期化（？）
$errorMessage="";
if(isset($_POST['submit-button'])){ //ログインボタン押されたとき
 if(empty($_POST['username_log'])){
 $errorMessage='ユーザー名が未入力です';
 }elseif(empty($_POST['pass_log'])){
 $errorMessage="パスワードが未入力です";
 }
 if(strlen($_POST['username_log'])>0 && strlen($_POST['pass_log'])>0){
  $name_log=$_POST['username_log'];
  $pass_log=$_POST['pass_log'];

//MySQLに接続
$dsn='データベース名';
$user='ユーザー名';
$password='パスワード';
$pdo=new PDO($dsn, $user, $password); //接続

/******データを取り出す******/
    $sql='SELECT*FROM tb_users'; //selectで全てのデータを取得
    $results= $pdo->query($sql);
    foreach ($results as $row){  //ループ処理（1つずつ取り出し)
     if($row['name']==$name_log and $row['pass']==$pass_log){     //ユーザー名とパス同士一致するとき
     $_SESSION['user']=$row['name']; //ユーザーのテーブル内のidをセッションに入れる？
     header("Location: mission_6_home.php"); //homeに
     exit(); //処理終了
     }else{ ?>
     <div class="alert alert-danger" role="alert">ユーザー名とパスワードが一致しません</div><?php
     exit();
     }
    }
 }//if(strlen)
}//if(isset)
?>
</body>
</html>
