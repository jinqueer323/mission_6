<?php
session_start();
?>

<!DOCTYPE HTML>
<html lang="ja">
 <head>
  <meta charset="UTF-8">
  <meta name="viewpoint" content="width=device-width,initial-scale=1">
  <title>日記を見る</title>
  <link rel="stylesheet" href="mission_6_diary.css">
 </head>

<body>
<header>
 <nav>
  <ul> 
    <li class="li_home"><a class="home" href="mission_6_home.php">ホーム</a></li> <!--これ押すとページのトップに-->
   <li class="li_post"><a class="post" href="mission_6_post2.php">日記をつける</a></li>
   <li class="li_diary"><a class="diary" href="#">日記を見る</a></li>   
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
       <option value="0s9">09</option>
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
      }
    }else{
       $_SESSION['year']=date("Y");
       $_SESSION['month']=date("m");
       $year=$_SESSION['year'];
       $month=$_SESSION['month'];

    }
    ?>
      <p class="years"><?php echo $year."年";?></p>
      <p class="months"><?php echo $month."月";?></p>
    </form>

    <form class="day_post" method="post" name="day_post" action="mission_6_diary.php">
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
     session_start();
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
          echo '<td class="day"><a href="mission_6_diaryday.php?d='.$day_0.'">'.$day_0.'</a></td>';
          }else{
          echo '<td class="day"><a href="mission_6_diaryday.php?d='.$day.'">'.$day.'</a></td>';
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
          echo '<td class="day"><a href="mission_6_diaryday.php?d='.$day_0.'">'.$day_0.'</a></td>';
          }else{
          echo '<td class="day"><a href="mission_6_diaryday.php?d='.$day.'">'.$day.'</a></td>';
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


  <div class="dis_all">



  <!-- 表示 -->

  <?php
   /*****データベースに入っている情報を表示******/
//MySQLに接続
$dsn='データベース名';
$user='ユーザー名';
$password='パスワード';
$pdo=new PDO($dsn, $user, $password); //接続

   //1つだけ読み込み
   $i=0;
   $toukou=3;
   //データベースに入っているデータを表示（3-6)
   $sql='SELECT*FROM tb_diary order by date desc'; //selectで降順にすべてのデータ取得
   $results= $pdo->query($sql);
   foreach ($results as $row){ //1つずつ取り出し

   if($i>=$toukou){
    break;
   }else{
   $today=date("Y").'年'.date("m").'月'.date("d").'日';
    if($row['date']==$today){
     echo '<p class="date">'.$row['date'].'</p>'.'<br>';
     echo '<p class="weather">'.'心の天気は'.$row['weather'].'でした'.'</p>'.'<br>';
      if($row['weather']=="虹"){
       echo '<img class="weather_pic" src="image/rainbow.png">'.'<br>';
      }elseif($row['weather']=="晴れ"){
       echo '<img class="weather_pic" src="image/sunny.not.png">'.'<br>';
      }elseif($row['weather']=="くもり"){
       echo '<img class="weather_pic" src="image/cloudy.not.png">'.'<br>';
      }elseif($row['weather']=="雨"){
       echo '<img class="weather_pic" src="image/rainy.not.png">'.'<br>';
      }
 //画像s
     echo '<img class="image_diary" src="mission_6_create_image.php?id='.$row["ID"].'">'.'<br>';
     
     echo '<p class="comment">'.$row['comment'].'</p><br>'; 

     $i++;
    }
    }
   }//foreach

   ?>
 </div>

</div>
</body>
</html>
