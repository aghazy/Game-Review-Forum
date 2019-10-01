<!DOCTYPE html>
<html>
<head>
  <title>Search Results</title>
</head>
<body>
    <font color = "FF0000"><h1>Welcome to Gamaty Search!</h1></font>
      <?php
        $mail=$_COOKIE['userID'];
        $keyw=$_COOKIE['ser'];
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
  <li><a href=\"game_list.php\">Games</a></li>
  <li><a href=\"comhomepage.php\">Communities</a></li>
  <li><a href=\"about.asp\">About</a></li>
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
  <?php
   $db  = new mysqli('localhost','root','','team62');
      $keyw=$_COOKIE['ser'];
echo "<TABLE BORDER=\"5\"    WIDTH=\"70%\"   CELLPADDING=\"4\" CELLSPACING=\"3\">
   <TR>
      <TH COLSPAN=\"3\"><BR><H3>Your Search Results</H3>
      </TH>
   </TR>

   <TR>
      <TH>Type</TH>
      <TH>Name</TH>
      <TH>Go</TH>
   </TR>";
      $qurnu=$db->query("select email, first_name, last_name
                        from Normal_users
                        where last_name = '{$keyw}' or first_name = '{$keyw}' ");
      $qurv=$db->query("select email, first_name, last_name
                        from Verified_reviewers
                        where first_name = '{$keyw}' or last_name = '{$keyw}'");
      $qurd=$db->query("select email, team_name
                        from Development_Teams
                        where team_name = '{$keyw}'");
      $qurg=$db->query("select name
                        from Games
                        where name = '{$keyw}'");
      $qurc=$db->query("select id, name
                        from Communities
                        where name = '{$keyw}' and admin_approved is not null");
      $qurconf=$db->query("select name
                        from conferences
                        where name = '{$keyw}'");
      if ($qurnu){
        $arr=array();
      while ($a1=$qurnu->fetch_assoc()){
        $m=$a1['email'];
        $fn=$a1['first_name'];
        $ln=$a1['last_name'];
        echo "<TR ALIGN=\"CENTER\">
      <TD>Normal User</TD>
      <TD>$fn $ln</TD>
      <TD>
      <a href =\"nuprofile.php?id=$m\"><input type=\"button\" name=\"$m\" id=\"rbr\" value=\"Go\"/></a>
      </TD>
   </TR>";
      }

    }
    if ($qurv){
       while ($a2=$qurv->fetch_assoc()){
        $m=$a2['email'];
        $fn=$a2['first_name'];
        $ln=$a2['last_name'];
        echo "<TR ALIGN=\"CENTER\">
      <TD>Verified Reviewer</TD>
      <TD>$fn $ln</TD>
      <TD>
      <a href =\"vprofile.php?id=$m\"><input type=\"button\" name=\"$m\" id=\"rbr\" value=\"Go\"/></a>
      </TD>
   </TR>";
      }
    }
    if ($qurd){
      while ($a3=$qurd->fetch_assoc()){
        $m=$a3['email'];
        $tn=$a3['team_name'];
        echo "<TR ALIGN=\"CENTER\">
      <TD>Development Team</TD>
      <TD>$tn</TD>
      <TD>
      <a href =\"dprofile.php?id=$m\"><input type=\"button\" name=\"$m\" id=\"rbr\" value=\"Go\"/></a>
      </TD>
   </TR>";
      }
  }
    if ($qurg){
       while ($a4=$qurg->fetch_assoc()){
        $m=$a4['name'];
        echo "<TR ALIGN=\"CENTER\">
      <TD>Game</TD>
      <TD>$m</TD>
      <TD>
      <form method =\"post\" > 
      <input type=\"submit\" name=\"go\" value=\"Go\"/></form>
      </TD>
   </TR>";
    if (isset($_POST['go'])){
      setcookie('suser',$m);
      header("Location:Game.php?id=$m");
    }
      }
    }
    if ($qurc){
       while ($a5=$qurc->fetch_assoc()){
        $m=$a5['id'];
        $n=$a5['name'];
        echo "<TR ALIGN=\"CENTER\">
      <TD>Community</TD>
      <TD>$n</TD>
      <TD>
      <form method =\"post\" > 
      <input type=\"submit\" name=\"go\" value=\"Go\"/></form>
      </TD>
   </TR>";
    if (isset($_POST['go'])){
      setcookie('suser',$m);
      header("Location:Community.php?id=$m");
    }
      }
    }
    if ($qurc){
       while ($a6=$qurconf->fetch_assoc()){
        $n=$a6['name'];
        echo "<TR ALIGN=\"CENTER\">
      <TD>Conference</TD>
      <TD>$n</TD>
      <TD>
      </TD>
   </TR>";
      }
    }
       

echo "</TABLE>";


  ?>

</body>
</html>