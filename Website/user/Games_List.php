<!DOCTYPE html>
<html>
<head>
  <title>Games List</title>
</head>
<body>
    <font color = "FF0000"><h1>Games List</h1></font>
      <?php
        $mail=$_COOKIE['userID'];
        //$keyw=$_GET['id'];
        $val=getUserType($mail);
        $prof="devteamprofile.php";
        $upprof="updatedevteam.php";
        if ($val==1){
        $prof="normaluserprofile.php";
        $upprof="updatenormaluser.php";
        }
        else if ($val==2){
        $prof="verifiedprofile.php";
        $upprof="updateverified.php";
        }
      echo "<a href=$prof>My Profile</a> | <a href=$upprof>Update Profile</a> | <a href=\"homepage.php\">Logout</a
       
    <ul>
  <li><a href=$prof>Home</a></li>
  <li><a href=\"Games_List.php\">Games</a></li>
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

      echo "<TABLE BORDER=\"5\"    WIDTH=\"70%\"   CELLPADDING=\"4\" CELLSPACING=\"3\">
   <TR>
      <TH COLSPAN=\"2\"><BR><H3>Games List</H3>
      </TH>
   </TR>

   <TR>
      <TH>Name</TH>
      <TH>Type</TH>
   </TR>";
   $db  = new mysqli('localhost','root','','team62');
    $mail=$_COOKIE['userID'];
    $qur=$db->query("select name
                      from Games");
      if ($qur){
      while ($a1=$qur->fetch_assoc()){
        $game = $a1['name'];
        $gtype = getGameType($game);
        echo "<TR ALIGN=\"CENTER\">
      <TD><a href = \"game.php?id=$game\">$game</a></TD>
      <TD>$gtype</TD>
   </TR>";
      }
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
   </body>
   </html>