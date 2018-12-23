<?php
session_start();
?>

<!DOCTYPE HTML>
<html lang="ja">
 <head>
  <meta charset="UTF-8">
  <meta name="viewpoint" content="width=device-width,initial-scale=1">
  <title>日記を記入する</title>
  <link rel="stylesheet" href="mission_6_post.css">
 </head>

<body>
<header>
 <nav>
  <ul> 
   <li class="li_home"><a class="home" href="mission_6_home.php">ホーム</a></li> <!--これ押すとページのトップに-->
   <li class="li_post"><a class="post" href="#">日記をつける</a></li>
   <li class="li_diary"><a class="diary" href="mission_6_diary.php">日記を見る</a></li>   
   <li class="li_album"><a class="album" href="mission_6_album.php">アルバム</a></li>
   <li class="li_mypage"><a class="mypage" href="mission_6_mypage.php">マイページ</a></li>
   <li class="li_setting"><a class="setting" href="mission_6_setting.php">設定</a></li>
  </ul>
</nav>
</header>

<div class="form_all">

  <!--カレンダーフォーム-->
  <div class="calender_all">
    <form class="select" method="post" action="#">
     <div class="selectbox">
      <select name="years">
       <option value="">--</option>
       <option value="2017">2017</option>
       <option value="2018">2018</option>
       <option value="2019">2019</option>
      </select>
      <select name="months">
       <option value="<?php if(isset($_POST['select_ym'])){ echo $_POST['months'];}?>">--</option>
       <option value="01">01</option>
       <option value="02">02</option>
       <option value="03">03</option>
       <option value="04">04</option>
       <option value="05">05</option>
       <option value="06">06</option>
       <option value="07">07</option>
       <option value="08">08</option>
       <option value="09">09</option>
       <option value="10">10</option>
       <option value="11">11</option>
       <option value="12">12</option>
      </div>
      <input type="submit" class="select_ym" name="select_ym" value="表示"/><br/>
   <?php 
   if(isset($_POST['select_ym'])){
      if(!empty($_POST['years']) && !empty($_POST['months'])){
       $_SESSION['year']=$_POST['years'];
       $_SESSION['month']=$_POST['months'];
       $year=$_SESSION['year'];
       $month=$_SESSION['month'];
       //echo $year.$month;
      }
   }else{
       /*$_SESSION['year']=date("Y");
       $_SESSION['month']=date("n");*/
       $year=$_SESSION['year'];
       $month=$_SESSION['month'];
       //echo $year.$month;
   }
?>
      <p class="years"><?php echo $year."年";?></p>
      <p class="months"><?php echo $month."月";?></p>
    </form>

<form class="day_post" method="post" name="day_post" action="mission_6_post2.php">
    <table class="calender">
      <tr>
        <td class="week">月</td>
        <td class="week">火</td>
        <td class="week">水</td>
        <td class="week">木</td>
        <td class="week">金</td>
        <td class="week">土</td>
        <td class="week">日</td>
      </tr>

<?php
    if(isset($_POST['select_ym'])){
      if(!empty($_POST['years']) && !empty($_POST['months'])){
       $_SESSION['year']=$_POST['years'];
       $_SESSION['month']=$_POST['months'];
       $year=$_SESSION['year'];
       $month=$_SESSION['month'];
      //echo $year.$month;
       $week_start= date("N", mktime(0, 0, 0, $month, 1, $year)); //mktimeで曜日を取得
   
        if($week_start!=1){//指定月の１日目が月曜でなければ
         for($i=2; $i<=$week_start; $i++){ //2からスタートし、1より小さい値まで、1ずつ足していく
           echo '<td class="no-day"></td>'; //空セル入れる
           $fold++;
         }//for
        }//ifweek
         for($day=1; checkdate($month, $day, $year); $day++){ //checkdateで日付正しいか確認 checkdate(月,日,年),1ずつ日にち足していく
         if($day<10){
          $day_0=sprintf('%02d',$day);
          echo '<td class="day"><a href="mission_6_postday.php?d='.$day_0.'">'.$day_0.'</a></td>';
          }else{
          echo '<td class="day"><a href="mission_6_postday.php?d='.$day.'">'.$day.'</a></td>';
          }
            $fold++;
              if($fold==7){ //7まで言った時に
              echo "<tr></tr>";//<tr></tr>を挿入して折り返し
              $fold=0; //折り返しカウントリセット（また1から）
              }
         }//for
         if($fold!=0){ //折り返しカウントが0じゃない＝日曜終わりじゃない時
            while($fold<7){
            echo '<td class="no-day"></td>';  //空セル
            $fold++;
            }
         }
      }//ifempty  
    }else{
    $year=$_SESSION['year'];
    $month=$_SESSION['month'];

    $week_start= date("N", mktime(0, 0, 0, $month, 1, $year)); //mktimeで曜日を取得
   
        if($week_start!=1){//指定月の１日目が月曜でなければ
         for($i=2; $i<=$week_start; $i++){ //2からスタートし、1より小さい値まで、1ずつ足していく
           echo '<td class="no-day"></td>'; //空セル入れる
           $fold++;
         }//for
        }//ifweek
         for($day=1; checkdate($month, $day, $year); $day++){ //checkdateで日付正しいか確認 checkdate(月,日,年),1ずつ日にち足していく?
          if($day<10){
          $day_0=sprintf('%02d',$day);
          echo '<td class="day"><a href="mission_6_postday.php?d='.$day_0.'">'.$day_0.'</a></td>';
          }else{
          echo '<td class="day"><a href="mission_6_postday.php?d='.$day.'">'.$day.'</a></td>';
          }
            $fold++;
              if($fold==7){ //7まで言った時に
              echo "<tr></tr>";//<tr></tr>を挿入して折り返し
              $fold=0; //折り返しカウントリセット（また1から）
              }
         }
         if($fold!=0){ //折り返しカウントが0じゃない＝日曜終わりじゃない時
            while($fold<7){
            echo '<td class="no-day"></td>';  //空セル
            $fold++;
            }
         }
    }
    ?>
    </table>
</form>
</div>



<?php
 if(isset($_POST['day_button'])){ 
   /*foreach($_POST['day'] as $value){
     echo "{$value}";
    
    }*/
   $year=$_SESSION['year'];
   $month=$_SESSION['month'];
    //echo $year;
    //echo $month;
 }else{
   $date_today=date("Y").'年'.date("m").'月'.date("d").'日';
   $date_id=date("Y").date("m").date("d");
}

?>

<!--投稿フォーム-->
<div class="post_all">
 <form class="post" enctype="multipart/form-data" method="post" action="mission_6_post2.php">
 
    <div class="time">
    <input type="text" class="post_date" name="post_date" value="<?php if(isset($_POST['select_ym'])){ echo $_SESSION['year'].'年'.$_SESSION['month'].'月'.$_SESSION['day'].'日';}else{echo $date_today;} ?>" readonly/>
    <input type="hidden" class="post_date_hid" name="post_date_hid" value="<?php  if(isset($_POST['select_ym'])){ echo $_SESSION['year'].$_SESSION['month'].$_SESSION['day'];}else{echo $date_id;}?>" readonly/>
    </div>

    <div class="post_formgroup"> 
    <input type="hidden" class="username_post" name="username_post" value="<?php echo $_SESSION['user']; ?>" readonly/>

     <div class="weather">
      <dl>
       <dt>心の空模様</dt>
        <dd>
         <input id="rainbow" type="radio" class="weather" name="weather" value="虹">
          <label class="weather_lab" for="rainbow"><img class="weather_pic" src="image/rainbow.png"></label>

         <input id="sun" type="radio" class="weather" name="weather" value="晴れ"> 
          <label class="weather_lab" for="sun"><img class="weather_pic" src="image/sunny.not.png"></label>

         <input id="cloud" type="radio" class="weather" name="weather" value="くもり">
          <label class="weather_lab" for="cloud"><img class="weather_pic" src="image/cloudy.not.png"></label>

         <input id="rain" type="radio" class="weather" name="weather" value="雨">
         <label class="weather_lab" for="rain"><img class="weather_pic" src="image/rainy.not.png"></label>  

        </dd>
      </dl>
     </div>
 

     <dl>
       <dt>画像</dt>
        <dd>
         <label for="picture" class="picture_lab">
         <input id="picture" type="file" class="picture" name="picture"/>
         </label>
        </dd>
     </dl>

     <dl>
      <dt>コメント</dt>
       <dd>
        <textarea class="comment" name="comment" rows="20" cols="30"></textarea>
       </dd>
      </dl>
    <button type="submit" class="post_button" name="post_button" value="送信ボタン">送信</button>
 </form>
</div>


<?php

//MySQLに接続
$dsn='データベース名';
$user='ユーザー名';
$password='パスワード';
$pdo=new PDO($dsn, $user, $password); //接続

if(isset($_POST['post_button'])){
  if(empty($_POST['post_date'])){
    echo "日付を指定してください";
  }
  elseif(empty($_POST['username_post'])){
    echo "ユーザー名が空です";
  }
  elseif(empty($_POST['weather'])){
    echo "天気が選択されていません";
  }
  elseif(!empty($_POST['post_date']) && !empty($_POST['username_post']) && !empty($_POST['weather'])){ /*日付、ユーザー名、天気が最低限入力されていればいい*/

    $ID=$_POST['post_date_hid'];
    $post_date=$_POST['post_date'];
    $username=$_POST['username_post'];
    $weather=$_POST['weather'];
    $comment=$_POST['comment'];
    $upfile=$_FILES['picture']['tmp_name'];
    //var_dump($upfile);
  /****画像ファイル***/
   //バイナリデータ
    $fp=fopen($upfile, "rb");
    $imgdat=fread($fp, filesize($upfile));
    fclose($fp);
    //$imgdat=mysql_real_escape_string($imgdat);
   //拡張子を取得
    $dat=pathinfo($_FILES['picture']['name']);
    $extension=$dat['extension'];
   //MIMEタイプ
    if($extension=="jpg" or $extension=="jpeg"){ 
    $mime="image/jpeg";
    }elseif($extension=="gif"){
    $mime="image/gif";
    }elseif($extension=="png"){
    $mime="image/png";
    }

     /******テーブルに投稿内容挿入(画像以外）*******/
     $sql=$pdo->prepare("INSERT INTO tb_diary(ID,date,name,weather,picture,mime,comment)VALUES (:ID,:date,:name,:weather,:picture,:mime,:comment)");
     $sql->bindParam(':ID', $ID, PDO::PARAM_STR);//日時
     $sql->bindParam(':date', $post_date, PDO::PARAM_STR);//日時
     $sql->bindParam(':name', $username, PDO::PARAM_STR);  //名前
     $sql->bindParam(':weather', $weather, PDO::PARAM_STR);//天気 
     $sql->bindParam(':picture', $imgdat, PDO::PARAM_STR); //画像
     $sql->bindParam(':mime', $mime, PDO::PARAM_STR); //mime
     $sql->bindParam(':comment', $comment, PDO::PARAM_STR); //コメント
     $sql->execute();//クエリの実行

    }//elseifpost
}//ifbutton
?>
</body>
</html>