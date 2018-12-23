<?php
session_start();
?>

<!DOCTYPE HTML>
<html lang="ja">
 <head>
  <meta charset="UTF-8">
  <meta name="viewpoint" content="width=device-width,initial-scale=1">
  <title>アルバム</title>
  <link rel="stylesheet" href="mission_6_album.css">
 </head>

<body>
<header>
 <nav>
  <ul> 
   <li class="li_home"><a class="home" href="mission_6_home.php">ホーム</a></li> <!--これ押すとページのトップに-->
   <li class="li_post"><a class="post" href="mission_6_post2.php">日記をつける</a></li>
   <li class="li_diary"><a class="diary" href="mission_6_diary.php">日記を見る</a></li>   
   <li class="li_album"><a class="album" href="mission_6_album.php">アルバム</a></li>
   <li class="li_mypage"><a class="mypage" href="mission_6_mypage.php">マイページ</a></li>
   <li class="li_setting"><a class="setting" href="mission_6_setting.php">設定</a></li>
  </ul>
</nav>
</header>

<div class="all">
<table class="day_and_image">
<?php
/******画像の一覧表示*******/
//MySQLに接続
$dsn='データベース名';
$user='ユーザー名';
$password='パスワード';
$pdo=new PDO($dsn, $user, $password); //接続

 //12読み込み
   $i=0;
   $toukou=12; 
  $sql='SELECT*FROM tb_diary order by ID desc'; //データをidの昇順で
  $results= $pdo->query($sql);
  foreach ($results as $row){ //1つずつ取り出し
  if($i<=$toukou){
    if($fold<3){
     echo '<td class="album_table"><p class="date_album">'.$row['date'].'</p><br><img class="image_album" src="mission_6_create_image.php?id='.$row["ID"].'"></td>';
     $i++;   
     $fold++;   
    }elseif($fold==3){
     echo "<tr></tr>";//<tr></tr>を挿入して折り返し
     $fold=0; //折り返しカウントリセット（また1から）
    }//elseif
  }
  if($i>=$toukou){
  // $i_num=floor(12/$i); //iを12で割って小数点以下切り捨て
   echo '<td><a class="page_link" href="mission_6_album_2.php?page='.$i.'">'.'次のページ'.'</a></td>';
   break;
  }
 }//foreach

?>
</table>
</div>
</body>
</html>