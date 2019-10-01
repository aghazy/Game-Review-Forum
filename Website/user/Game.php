<!DOCTYPE html>
<html>
<head>
  <title>Games!</title>
</head>
<body>
    <font color = "FF0000"><h1>Games!</h1></font>
      <?php
        $mail=$_COOKIE['userID'];
        //$keyw=$_COOKIE['ser'];
        $val=getUserType($mail);
        $prof="/user/devteamprofile.php";
        $upprof="/user/updatedevteam.php";
        if ($val==1){
        $prof="/user/normaluserprofile.php";
        $upprof="/user/updatenormaluser.php";
        }
        else if ($val==2){
        $prof="/user/verifiedprofile.php";
        $upprof="/user/updateverified.php";
        }
      echo "<a href=$prof>My Profile</a> | <a href=$upprof>Update Profile</a> | <a href=\"homepage.php\">Logout</a
       
    <ul>
  <li><a href=$prof>Home</a></li>
  <li><a href=\"game_list.php\">Games</a></li>
  <li><a href=\"comhomepage.php\">Communities</a></li>
</ul>";
function getUserType($mail){
    $db  = new mysqli('localhost','root','','team62');
    $val = $db->query("select *
                                from Normal_users
                                where email = '{$mail}'");
    if ($val->num_rows>0)return 1;
    $val = $db->query("select *
                                from Verified_reviewers
                                where email = '{$mail}'");
     if ($val->num_rows>0)return 2;
   
     else return 3;
}
      ?>

    <!-- HTML for SEARCH BAR -->
  <div id="tfheader">
    <form id="globalsearch" method="post">
            <input type="text"  name="s" size="21" maxlength="120"><input type="submit" name ="sub" value="Search">
    </form>
    <?php
       if (isset($_POST['sub'])){
        $w=$_POST['s'];

        setcookie('ser',$w);
        header("Location:search.php");

       }
    ?>
  <div class="tfclear"></div>
  </div>
    
    
    <br>
    
    <?php
     $db  = new mysqli('localhost','root','','team62');
        $mail=$_COOKIE['userID'];
        $g=$_GET['id'];
      $val = getUserType($mail);
      if($val == 1){
        echo"
          <p><a href = \"rating.php?id=$g \">Rate</a></p>
        ";
      }
      else if ($val == 2) {
        echo"
          <p><a href = \"rating.php?id=$g \">Rate</a></p><p>
        ";
      }
      else{
        echo"
          <p><a href = \"rating.php?id=$g \">Rate</a></p>
          <form method =\"post\" action=\"\"><input type=\"submit\" name =\"teto\" value=\"Add Game to Developed\"></form>

        ";
         if (isset($_POST['teto'])){
          $qur=$db->query("select *
                            from Development_Teams
                            where email = '{$mail}' and verified = 1");
          if ($qur->num_rows>0){
            $qur=$db->query("update Games
                              set developer_email = '{$mail}'
                              where developer_email is null and name = '{$g}'");
          }

         }
      }
     $qur=$db->query("select name, rating, release_date, age_limit, developer_email
                      from Games
                      where name = '{$g}'");
   $valu =$qur->fetch_assoc();
   $name=$valu['name'];
   $rating=$valu['rating'];
   $rd=$valu['release_date'];
   $al=$valu['age_limit'];
   $dev=$valu['developer_email'];
   $t = getGameType($name);
    echo "<TABLE BORDER=\"5\"    WIDTH=\"70%\"   CELLPADDING=\"4\" CELLSPACING=\"3\">
   <TR>
      <TH COLSPAN=\"2\"><BR><H3>Game Information</H3>
      </TH>
   </TR>
   <TR>
      <TH>Attribute</TH>
      <TH>Value</TH>
   </TR>
   <TR ALIGN=\"CENTER\">
      <TD>Name</TD>
      <TD>$name</TD>
   </TR>
       <TR ALIGN=\"CENTER\">
      <TD>Rating</TD>
      <TD>$rating /5</TD>
   </TR>
         <TR ALIGN=\"CENTER\">
      <TD>Release Date</TD>
      <TD>$rd</TD>
   </TR>
         <TR ALIGN=\"CENTER\">
      <TD>Age Limit</TD>
      <TD>$al</TD>
   </TR>
    <TR ALIGN=\"CENTER\">
      <TD>Game Type</TD>
      <TD>$t</TD>
   </TR>
         <TR ALIGN=\"CENTER\">
      <TD>Developer</TD>
      <TD>$dev</TD>
   </TR>
     
</TABLE>";
echo "<br>";
echo "<br>";
echo "<TABLE BORDER=\"5\"    WIDTH=\"70%\"   CELLPADDING=\"4\" CELLSPACING=\"3\">
   <TR>
      <TH COLSPAN=\"1\"><BR><H3>Screenshot</H3>
      </TH>
   </TR>";
$qur=$db->query("select screenshot
                      from Game_Screenshots
                      where name = '{$g}'");
   while($valu =$qur->fetch_assoc()){
   $sc=$valu['screenshot'];
       echo "<TR ALIGN=\"CENTER\">
      <TD><img src =$sc /> </TD>
       </TR>";
        //header("Location:$sc");
   }
   
echo "</TABLE>";
echo "<br>";
echo "<br>";
echo "<TABLE BORDER=\"5\"    WIDTH=\"70%\"   CELLPADDING=\"4\" CELLSPACING=\"3\">
   <TR>
      <TH COLSPAN=\"3\"><BR><H3>Game Play</H3>
      </TH>
   </TR>";
$qur=$db->query("select gameplay
                      from Game_Gameplays
                      where name = '{$g}'");
   while($valu =$qur->fetch_assoc()){
   $gp=$valu['gameplay'];
       echo "<TR ALIGN=\"CENTER\">
      <TD>
       <video width=\"320\" height=\"240\" controls>
  <source src=$gp type=\"video/mp4\">
  
Your browser does not support the video tag.
</video> 
      </TD>
       </TR>";
   }
 echo "</TABLE>";
 echo "<br>";
 echo "<br>";
 echo "<TABLE BORDER=\"5\"    WIDTH=\"70%\"   CELLPADDING=\"4\" CELLSPACING=\"3\">
   <TR>
      <TH COLSPAN=\"3\"><BR><H3>Reviews</H3>
      </TH>
   </TR>
   <TR>
      <TH>ID</TH>
      <TH>Writer's email</TH>
      <TH>Time</TH>
   </TR>
   ";
$qur=$db->query("select id, writer_email, date
                      from Game_Reviews
                      where game_name = '{$g}'");
   while($valu =$qur->fetch_assoc()){
   $id=$valu['id'];
   $we=$valu['writer_email'];
   $d=$valu['date'];
       echo "<TR ALIGN=\"CENTER\">
      <TD><a href=\"game_review.php?id=$id&flg=0&id2=$g \">$id</a></TD>
      <TD>$we</TD>
      <TD>$d</TD>
       </TR>";
   }
 echo "</TABLE>";
?>
<?php
    function getGameType($name){
         $db  = new mysqli('localhost','root','','team62');
    $val = $db->query("select *
                        from Sport_games
                        where name = '{$name}'");
    if ($val->num_rows>0){
      $valu =$val->fetch_assoc();
      $sportType = $valu['sport_type'];
      return "Sport Game ($sportType)";
    }
    $val = $db->query("select *
                        from Action_games
                        where name = '{$name}'");
     if ($val->num_rows>0){
      $valu =$val->fetch_assoc();
      $actionType = $valu['sub_genere'];
      return "Action Game ($actionType)";
    }
        $val = $db->query("select *
                        from RPG_games
                        where name = '{$name}'");
   if ($val->num_rows>0){
    $valu =$val->fetch_assoc();
    $rt = $valu['pvp'];
    if($rt = 1)$rtt = "(PvP)";
    else $rtt = "";
    return "RPG Game $rtt";
 }
     else{
      $valu =$val->fetch_assoc();
      $rt = $valu['real_time'];
      if($rt = 1)$rtt = "(Real Time)";
      else $rtt = "";
      return "Strategy Game $rtt";
   }
    }
?>
 <br>
      <?php
      $mail = $_COOKIE['userID'];
      $game = $_GET['id'];
      if(getUserType($mail) == 2){
      echo "<p>Add Review</p>
      <form method=\"post\">
      <textarea  rows =3 cols= 50 name=\"msg\"> </textarea> <input type=\"submit\" name=\"send\" value=\"Write\"/>   
      </form>";
      if (isset($_POST['send'])){
        $ms=$_POST['msg'];
        if (!empty($ms)){
          $db  = new mysqli('localhost','root','','team62');
          $qur=$db->query("select *
                            from Verified_reviewers
                            where (email = '{$mail}' and verified = 1)");
          if ($qur->num_rows>0){
            //echo "da5l";
             $qur=$db->query("insert into Game_Reviews(review, date, writer_email, game_name)
                              values('{$ms}' , current_timestamp(), '{$mail}', '{$game}')");
            //echo "message send";
              if ($qur) {
     echo "Review added";
     header("Location:game.php?id=$game");
     exit();
} else {
    echo "Error: " .' '. "<br>" . mysqli_error($db);
}

          }
          else{
            echo "sorry you can not add a game review";
            //echo "Error: " .' '. "<br>" . mysqli_error($db);
          }

        }

      }
}
      ?>
    </body>
    

  
</html>