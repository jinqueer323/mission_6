<?php
session_start();
?>

<!DOCTYPE HTML>
<html lang="ja">
 <head>
  <meta charset="UTF-8">
  <meta name="viewpoint" content="width=device-width,initial-scale=1">
  <title>日記を記入する</title>
  <link rel="stylesheet" href="mission_6_mypage.css">
 </head>

<body>
<header>
 <nav>
  <ul> 
   <li class="li_home"><a class="home" href="mission_6_home.php">ホーム</a></li> <!--これ押すとページのトップに-->
   <li class="li_post"><a class="post" href="mission_6_post2.php">日記をつける</a></li>
   <li class="li_diary"><a class="diary" href="mission_6_diary.php">日記を見る</a></li>   
   <li class="li_album"><a class="album" href="mission_6_album.php">アルバム</a></li>
   <li class="li_mypage"><a class="mypage" href="#">マイページ</a></li>
   <li class="li_setting"><a class="setting" href="mission_6_setting.php">設定</a></li>
  </ul>
</nav>
</header>

<div class="all">
<h3>ユーザー情報</h3>
<div class="user_info">
<p class="user_info_p1">ユーザー名</p><br>
  <p class="user_info_p2"><?php echo $_SESSION['user']; ?></p><br>
<p class="user_info_p1">ニックネーム</p><br>

<?php
//MySQLに接続
$dsn='データベース名';
$user='ユーザー名';
$password='パスワード';
$pdo=new PDO($dsn, $user, $password); //接続

$session_user=$_SESSION['user'];
$sql='SELECT*FROM tb_users'; //selectで全てのデータを取得
$results= $pdo->query($sql);
foreach ($results as $row){  //ループ処理（1つずつ取り出し)
 if($row['name']==$session_user){     //ユーザー名とパス同士一致するとき
  echo '<p class="user_info_p2">'.$row['nickname'].'</p>'.'<br>'; 
 }
}
?>
</div>

<a class="logoutlink" href="mission_6_logout.php">ログアウトする</a> <!--ログインページに飛べるようリンク--><br/>

</div>

</body>
</html>
