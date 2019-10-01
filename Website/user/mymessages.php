<!DOCTYPE html>
<html>
<head>
  <title>Search Results</title>
</head>
<body>
    <font color = "FF0000"><h1>Welcome to Gamaty Search!</h1></font>
      <?php
        $mail=$_COOKIE['userID'];
        //$keyw=$_COOKIE['ser'];
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
     
      echo "<TABLE BORDER=\"5\"    WIDTH=\"70%\"   CELLPADDING=\"4\" CELLSPACING=\"3\">
   <TR>
      <TH COLSPAN=\"4\"><BR><H3>Your Messages</H3>
      </TH>
   </TR>

   <TR>
      <TH>Sender</TH>
      <TH>Reciever</TH>
      
      <TH>Time</TH>
      <TH>Message</TH>
   </TR>";
   $db  = new mysqli('localhost','root','','team62');
    $mail=$_COOKIE['userID'];
      $qur=$db->query("select user1, user2, date_time, message
                      from Messages
                      where user1 = '{$mail}' or user2 = '{$mail}'
                      order by date_time desc");
      if ($qur){
      while ($a1=$qur->fetch_assoc()){
        $s=$a1['user1'];
        $r=$a1['user2'];
        $dt=$a1['date_time'];
        $msg = $a1['message'];
        echo "<TR ALIGN=\"CENTER\">
      <TD>$s</TD>
      <TD>$r</TD>
      <TD>$dt</TD>
      <TD>$msg</TD>
   </TR>";
      }
    }
echo "</TABLE>";

    ?>
  </body>
  </html>