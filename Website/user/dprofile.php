<!DOCTYPE html>
<html>
<head>
  <title>Welcome to My Profile!</title>
</head>
<body>
    <font color = "FF0000"><h1>Welcome to My Profile!</h1></font>
      <?php
        $mail=$_COOKIE['userID'];
        $keyw=$_GET['id'];
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
    
    <br>
    <?php
     $db  = new mysqli('localhost','root','','team62');
      $mail=$_GET['id'];
     $qur=$db->query("select d.email, d.team_name, d.company, m.preferred_game_genre, d.formation_date, d.verified
                      from Members m, Development_Teams d
                      where d.email = '{$mail}' and m.email = '{$mail}'");
     echo "<TABLE BORDER=\"5\"    WIDTH=\"70%\"   CELLPADDING=\"4\" CELLSPACING=\"3\">
   <TR>
      <TH COLSPAN=\"2\"><BR><H3>My Information</H3>
      </TH>
   </TR>

   <TR>
      <TH>Attribute</TH>
      <TH>Value</TH>
   </TR>";
   $valu =$qur->fetch_assoc();
   $mail=$valu['email'];
   $tn=$valu['team_name'];
   $c=$valu['company'];
   $pgg=$valu['preferred_game_genre'];
   $fd=$valu['formation_date'];
   $v=$valu['verified'];
   $flag='No';
   if ($v==1)$flag = 'Yes';
  echo "<TR ALIGN=\"CENTER\">
      <TD>Email</TD>
      <TD>$mail</TD>
   </TR>
       <TR ALIGN=\"CENTER\">
      <TD>Team Name</TD>
      <TD>$tn</TD>
   </TR>
         <TR ALIGN=\"CENTER\">
      <TD>Company Name</TD>
      <TD>$c</TD>
   </TR>
         <TR ALIGN=\"CENTER\">
      <TD>Preferred Game Genre</TD>
      <TD>$pgg</TD>
   </TR>
         <TR ALIGN=\"CENTER\">
      <TD>Formation Date</TD>
      <TD>$fd</TD>
   </TR>
       
       <TR ALIGN=\"CENTER\">
      <TD>Verification</TD>
      <TD>$flag</TD>
   </TR>
       

</TABLE>"
     
   ?>
    
   <!--  <TABLE BORDER="5"    WIDTH="70%"   CELLPADDING="4" CELLSPACING="3">
   <TR>
      <TH COLSPAN="2"><BR><H3>My Information</H3>
      </TH>
   </TR>

   <TR>
      <TH>Attribute</TH>
      <TH>Value</TH>
   </TR>
   <TR ALIGN="CENTER">
      <TD>Email</TD>
      <TD>Data 2</TD>
   </TR>
       <TR ALIGN="CENTER">
      <TD>Team Name</TD>
      <TD>Data 2</TD>
   </TR>
         <TR ALIGN="CENTER">
      <TD>Company Name</TD>
      <TD>Data 2</TD>
   </TR>
         <TR ALIGN="CENTER">
      <TD>Preferred Game Genre</TD>
      <TD>Data 2</TD>
   </TR>
         <TR ALIGN="CENTER">
      <TD>Formation Date</TD>
      <TD>Data 2</TD>
   </TR>
       
       <TR ALIGN="CENTER">
      <TD>Verification</TD>
      <TD>Data 2</TD>
   </TR> 
       

</TABLE> <-->
    
    
    </body>
    

  
</html>