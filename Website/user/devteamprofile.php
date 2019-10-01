<!DOCTYPE html>
<html>
<head>
  <title>Welcome to My Profile!</title>
</head>
<body>
    <font color = "FF0000"><h1>Welcome to My Profile!</h1></font
<a href="devteamprofile.php">My Profile</a> | <a href="updatedevteam.php">Update Profile</a> | <a href="homepage.php">Logout</a>
    
       
    <ul>
  <li><a href="devteamprofile.php">Home</a></li>
  <li><a href="games_list.php">Games</a></li>
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