<!DOCTYPE html>
<html>
<head>
  <title>Friends</title>
</head>
<body>
  <?php
  if ($_GET['flg']>0){
    $db  = new mysqli('localhost','root','','team62');
    $name=$_GET['id'];
    $mail=$_COOKIE['userID'];
    echo $name;
    echo $mail;

    if ($_GET['flg']==1){
         $qur=$db->query("update Normal_Users_AddFriendship_Normal_Users
                        set approved = 1
                        where user1 = '{$name}' and user2 = '{$mail}'");
    }
    else{
          $qur=$db->query("update Normal_Users_AddFriendship_Normal_Users
                        set approved = 0
                        where user1 = '{$name}' and user2 = '{$mail}'");
    }
    }
  ?>
    <font color = "FF0000"><h1>Welcome to Gamaty!</h1></font>
      <?php
        $mail=$_COOKIE['userID'];
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
      $mail=$_COOKIE['userID'];
echo "<TABLE BORDER=\"5\"    WIDTH=\"70%\"   CELLPADDING=\"4\" CELLSPACING=\"3\">
   <TR>
      <TH COLSPAN=\"3\"><BR><H3>Your Friends</H3>
      </TH>
   </TR>

   <TR>
      <TH>Friend</TH>
      <TH>status</TH>
      <TH>View Profile</TH>
   </TR>";
      $qurf1=$db->query("select user2
                        from Normal_Users_AddFriendship_Normal_Users
                        where user1 = '{$mail}' and approved = 1");
      $qurf2=$db->query("select user1
                        from Normal_Users_AddFriendship_Normal_Users
                        where user2 = '{$mail}' and approved = 1");
      $qurf3=$db->query("select user2
                        from Normal_Users_AddFriendship_Normal_Users
                        where user1 = '{$mail}' and approved is null");
      $qurf4=$db->query("select user1
                        from Normal_Users_AddFriendship_Normal_Users
                        where user2 = '{$mail}' and approved is null");

      if ($qurf1){
      while ($a1=$qurf1->fetch_assoc()){
        $name=$a1['user2'];
        echo "<TR ALIGN=\"CENTER\">
      <TD>$name</TD>
      <TD>Friends</TD>
      <TD>
      <a href =\"nuprofile.php?id=$name\"><input type=\"button\" name=\"$name\" id=\"rbr\" value=\"View\"/></a>
      </TD>
   </TR>";
      }

    }
    if ($qurf2){
       while ($a2=$qurf2->fetch_assoc()){
         $name=$a2['user1'];
        echo "<TR ALIGN=\"CENTER\">
      <TD>$name</TD>
      <TD>Friends</TD>
      <TD>
      <a href =\"nuprofile.php?id=$name\"><input type=\"button\" name=\"$name\" id=\"rbr\" value=\"View\"/></a>
      </TD>
   </TR>";
      }
    }
    if ($qurf3){
      while ($a3=$qurf3->fetch_assoc()){
        $name=$a3['user2'];
        echo "<TR ALIGN=\"CENTER\">
      <TD>$name</TD>
      <TD>Pending</TD>
      <TD>
<a href =\"nuprofile.php?id=$name\"><input type=\"button\" name=\"$name\" id=\"rbr\" value=\"View\"/></a>
      </TD>
   </TR>";
      }
  }
  echo "</table>";
  echo "<br>";
  echo "<br>";
  echo "<TABLE BORDER=\"5\"    WIDTH=\"70%\"   CELLPADDING=\"4\" CELLSPACING=\"3\">
   <TR>
      <TH COLSPAN=\"3\"><BR><H3>Your Friend Requests</H3>
      </TH>
   </TR>

   <TR>
      <TH>Friend</TH>
      <TH>Approve/Reject</TH>
      <TH>View Profile</TH>
   </TR>";
    if ($qurf4){
       while ($a4=$qurf4->fetch_assoc()){
        $name=$a4['user1'];
        echo "<TR ALIGN=\"CENTER\">
      <TD>$name</TD>
      <TD>
      <a href =\"?id=$name&flg=1\"><input type=\"button\" name=\"acc\" id=\"rbr\" value=\"Accept\"/></a>
      <a href =\"?id=$name&flg=2\"><input type=\"button\" name=\"rej\" id=\"rbr\" value=\"Reject\"/></a>
      </TD>
      <TD>
      <a href =\"nuprofile.php?id=$name\"><input type=\"button\" name=\"$name\" id=\"rbr\" value=\"View\"/></a>
      </TD>
   </TR>";
      }
    }
echo "</TABLE>";
?>

</body>
</html>