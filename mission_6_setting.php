<?php
session_start();
?>
<!DOCTYPE HTML>
<html lang="ja">
 <head>
  <meta charset="UTF-8">
  <meta name="viewpoint" content="width=device-width,initial-scale=1">
  <title>ユーザー情報の編集</title>
  <link rel="stylesheet" href="mission_6_set.css">
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
<h3>パスワードを変更する</h3>
 <form method="post" class="pass_edit" action="mission_6_setting.php">
 <p class="edit_p">現在のパスワード</p><br>
  <input type="text" class="edit_post" name="oldpass1" placeholder="現在のパスワードを入力"   /><br/> 
 <p class="edit_p">新しいパスワード</p><br>
 <input type="text"  class="edit_post" name ="newpass" placeholder="新しいパスワードを入力" /><br/>
  <button type="submit" class="pass_button" name="pass_button" value="ボタン">送信</button>
 </form>

<h3>ニックネームを変更する</h3>
 <form method="post" class="nickname_edit" action="mission_6_setting.php">
  <p class="edit_p">現在のパスワード</p><br>
   <input type="text" class="edit_post" name="oldpass2" placeholder="現在のパスワードを入力"  /><br/> 
  <p class="edit_p">現在のニックネーム</p><br>
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
     echo '<p class="oldnickname">'.$row['nickname'].'</p>'.'<br>'; 
    }
   }
   ?>
  <p class="edit_p">新しいニックネーム</p><br>
   <input type="text"  class="edit_post" name ="newnickname" placeholder="新しいニックネームを入力" /><br/>
   <button type="submit" class="nickname_button" name="nickname_button" value="ボタン">送信</button>
 </form>





<div class="hyouji">
<?php
/*********パスワード変更********/
if(isset($_POST['pass_button'])){    
 if(!empty($_POST['oldpass1']) and !empty($_POST['newpass'])){ 
   $session_user=$_SESSION['user'];
   $oldpass1=$_POST['oldpass1'];        //古いパス  
   $newpass=$_POST['newpass'];          //新しいパス

//MySQLに接続
$dsn='データベース名';
$user='ユーザー名';
$password='パスワード';
$pdo=new PDO($dsn, $user, $password); //接続

  /******データを取り出す******/

   $sql='SELECT*FROM tb_users'; //selectで全てのデータを取得
    $results=$pdo->query($sql);
    foreach($results as $row){  //ループ処理（1つずつ取り出し)
     if($row['pass']==$oldpass1){     //投稿番号と編集番号,パス同士一致するとき
        $sql="update tb_users set pass='$newpass' where name ='$session_user'";//上書き
        $results=$pdo->query($sql);
        if($results){
         echo '<p class="edit_hyouji">'.'新しいパスワードを'.$newpass.'に変更しました'.'</p>'.'<br>'; 
        }else{
            echo '<p class="edit_hyouji">'.'変更できませんでした'.'</p>'.'<br>';
        }
     }
    }
  }
}
?>
<?php
/*********ニックネーム変更********/
if(isset($_POST['nickname_button'])){    
 if(!empty($_POST['oldpass2']) and !empty($_POST['newnickname'])){ 
   $session_user=$_SESSION['user'];
   $oldpass2=$_POST['oldpass2'];        //古いパス  
   $newnickname=$_POST['newnickname'];          //新しいパス

//MySQLに接続
$dsn='データベース名';
$user='ユーザー名';
$password='パスワード';
$pdo=new PDO($dsn, $user, $password); //接続

  /******データを取り出す******/

   $sql='SELECT*FROM tb_users'; //selectで全てのデータを取得
    $results=$pdo->query($sql);
    foreach($results as $row){  //ループ処理（1つずつ取り出し)
     if($row['pass']==$oldpass2){     //投稿番号と編集番号,パス同士一致するとき
        $sql="update tb_users set nickname='$newnickname' where name ='$session_user'";//上書き
        $results=$pdo->query($sql);
          if($results){
            echo '<p class="edit_hyouji">'.'ニックネームを'.$newnickname.'に変更しました'.'</p>'.'<br>'; 
          }else{
            echo '<p class="edit_hyouji">'.'変更できませんでした'.'</p>'.'<br>';
          }
      }
    }
  }
}
?>
</div>
</body>
</html>
