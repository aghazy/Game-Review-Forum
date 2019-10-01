<!DOCTYPE html>
<html>
<head>
  <title>Welcome to My Profile!</title>
</head>
<body>
    <font color = "FF0000"><h1>Welcome to My Profile!</h1></font>
    <a href="normaluserprofile.php">My Profile</a> | <a href="updatenormaluser.php">Update Profile</a> | <a href="homepage.php">Logout</a>
       
    <ul>
  <li><a href="normaluserprofile.php">Home</a></li>
  <li><a href="mymessages.php">My Messages</a></li>
  <li><a href="Games_List.php">Games</a></li>
  <li><a href="Recommend.php">Recommended Games</a></li>
  <li><a href="createcom.php">Create a Community</a></li>
  <li><a href="comhomepage.php">Communities</a></li>
  <li><a href="friends.php?flg=0">Friends</a></li>
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
     $qur=$db->query("select m.email, n.first_name, n.last_name, m.preferred_game_genre, n.date_of_birth, n.age
                      from Members m, Normal_Users n
                      where n.email = '{$mail}' and m.email = '{$mail}'");
     $valu =$qur->fetch_assoc();
   $mail=$valu['email'];
   $fn=$valu['first_name'];
   $ln=$valu['last_name'];
   $pgg=$valu['preferred_game_genre'];
   $dob=$valu['date_of_birth'];
   $age=$valu['age'];
  
   
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
      <TD>Date of Birth</TD>
      <TD>$dob</TD>
   </TR>
       
      <TR ALIGN=\"CENTER\">
      <TD>Age</TD>
      <TD>$age</TD>
   </TR>
     
</TABLE>"
?>
 <!--         
      <br>
      <p>Send a Message</p>
      <form method="post">
      <textarea  rows =3 cols= 50 name="msg"> </textarea> <input type="submit" name="message" value="Send"/>   
      </form>  -->  
      

    </body>
    

  
</html>