<!DOCTYPE html>
<html>
<head>
  <title>Welcome to My Profile!</title>
</head>
<body>
    <font color = "FF0000"><h1>Welcome to My Profile!</h1></font>
    <a href="verifiedprofile.php">My Profile</a> | <a href="updateverified.php">Update Profile</a> | <a href="homepage.php">Logout</a>
       
    <ul>
  <li><a href="verifiedprofile.php">Home</a></li>
  <li><a href="game_list.php">Games</a></li>
  <li><a href="comhomepage.php">Communities</a></li>
</ul>
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
     $qur=$db->query("select m.email, v.first_name, v.last_name, m.preferred_game_genre, v.start_date, v.verified,v.experience_years
                      from Members m, Verified_Reviewers v
                      where v.email = '{$mail}' and m.email = '{$mail}'");
     $valu =$qur->fetch_assoc();
   $mail=$valu['email'];
   $fn=$valu['first_name'];
   $ln=$valu['last_name'];
   $pgg=$valu['preferred_game_genre'];
   $sd=$valu['start_date'];
   $v=$valu['verified'];
   $ey=$valu['experience_years'];
   $flag='No';
   if ($v==1)$flag = 'Yes';
    echo "<TABLE BORDER=\"5\"    WIDTH=\"70%\"   CELLPADDING=\"4\" CELLSPACING=\"3\">
   <TR>
      <TH COLSPAN=\"2\"><BR><H3>My Information</H3>
      </TH>
   </TR>
   <TR>
      <TH>Attribute</TH>
      <TH>Value</TH>
   </TR>
   <TR ALIGN=\"CENTER\">
      <TD>Email</TD>
      <TD>$mail</TD>
   </TR>
       <TR ALIGN=\"CENTER\">
      <TD>First Name</TD>
      <TD>$fn</TD>
   </TR>
         <TR ALIGN=\"CENTER\">
      <TD>Last Name</TD>
      <TD>$ln</TD>
   </TR>
         <TR ALIGN=\"CENTER\">
      <TD>Preferred Game Genre</TD>
      <TD>$pgg</TD>
   </TR>
         <TR ALIGN=\"CENTER\">
      <TD>Start Date</TD>
      <TD>$sd</TD>
   </TR>
       
      <TR ALIGN=\"CENTER\">
      <TD>Verification</TD>
      <TD>$flag</TD>
   </TR>
       
       <TR ALIGN=\"CENTER\">
      <TD>Exeperience Years</TD>
      <TD>$ey</TD>
   </TR>
</TABLE>"
?>
    
    
    </body>
    

  
</html>