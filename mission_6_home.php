<?php

session_start();
//MySQLに接続
$dsn='データベース名';
$user='ユーザー名';
$password='パスワード';
$pdo=new PDO($dsn, $user, $password); //接続

/******セッションにない？場合、ログインページに戻る*******/
if(!isset($_SESSION['user'])){
  header("Location: mission_6_loginform.php");
  exit();
}else{
  /*****ユーザー名を取り出す******/
  $sessionname=$_SESSION['user'];
  $sql="SELECT*FROM tb_users"; //selectで全てのデータを取得
  $results= $pdo->query($sql);
   foreach ($results as $row){  //ループ処理（1つずつ取り出し)
    if($row['name']==$sessionname){
      $username=$row['name']; //ユーザー名を取り出し
      $nickname=$row['nickname']; //ニックネームの取り出し
    }
   }
}
?>


<!DOCTYPE HTML>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta name="viewpoint" content="width=device-width,initial-scale=1">
<title>マイページ</title>
<link rel="stylesheet" href="mission_6_home.css">
</head>

<body>

<header>
 <nav>
  <ul> 
   <li class="li_home"><a class="home" href="#">ホーム</a></li> <!--これ押すとページのトップに-->
   <li class="li_post"><a class="post" href="mission_6_post2.php">日記をつける</a></li>
   <li class="li_diary"><a class="diary" href="mission_6_diary.php">日記を見る</a></li>   
   <li class="li_album"><a class="album" href="mission_6_album.php">アルバム</a></li>
   <li class="li_mypage"><a class="mypage" href="mission_6_mypage.php">マイページ</a></li>
   <li class="li_setting"><a class="setting" href="mission_6_setting.php">設定</a></li>
  </ul>
</nav>
</header>

<div class="notheader">

<div class="hyoushi">
  <ul>
   <li><?php echo $nickname; ?>'s Diary</li>
  </ul>
 </div>


</div>
</body>
</html>

