<!DOCTYPE html>
<html>
<head>
  <title>Communities List</title>
</head>
<body>
    <font color = "FF0000"><h1>Communities List</h1></font>
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
      <TH COLSPAN=\"2\"><BR><H3>Communities List</H3>
      </TH>
   </TR>

   <TR>
      <TH>Name</TH>
      <TH>Owner</TH>
   </TR>";
   $db  = new mysqli('localhost','root','','team62');
    $mail=$_COOKIE['userID'];
    $qur=$db->query("select id, name, user_request
                      from Communities
                      where admin_approved is not null");
      if ($qur){
      while ($a1=$qur->fetch_assoc()){
        $name = $a1['name'];
        $owner = $a1['user_request'];
        $qid = $a1['id'];
        echo "<TR ALIGN=\"CENTER\">
      <TD><a href = \"community.php?id=$qid\">$name</a></TD>
      <TD>$owner</TD>
   </TR>";
      }
    }
echo "</TABLE>";

     ?>
   </body>
   </html>