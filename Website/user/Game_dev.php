<!DOCTYPE html>
<html>
<head>
  <title>Games!</title>
</head>
<body>
    <font color = "FF0000"><h1>Games!</h1></font>
      <?php
        $mail=$_COOKIE['userID'];
        $keyw=$_COOKIE['ser'];
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
        $g=$_COOKIE['suser'];
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
      <TD>$sc</TD>
       </TR>";
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
      <TD>$gp</TD>
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
      <TD>$id</TD>
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
    if ($val->num_rows>0)return "Sport Game";
    $val = $db->query("select *
                        from Action_games
                        where name = '{$name}'");
     if ($val->num_rows>0)return "Action Game";
        $val = $db->query("select *
                        from RPG_games
                        where name = '{$name}'");
   if ($val->num_rows>0)return "RPG Game";
     else return "Strategy Game";
    }
?>
    </body>
    

  
</html>