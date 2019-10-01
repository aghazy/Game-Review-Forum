<!DOCTYPE html>
<html>
<head>
  <title>Update My Profile!</title>
</head>
<body>
    <font color = "FF0000"><h1>Update My Profile!</h1></font>
    <a href="devteamprofile.php">My Profile</a> | <a href="updatedevteam.php">Update Profile</a> | <a href="homepage.php">Logout</a>
       
    <ul>
  <li><a href="devteamprofile.php">Home</a></li>
  <li><a href="game_list.php\">Games</a></li>
  <li><a href="comhomepage.php\">Communities</a></li>
  
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
    
    <TABLE BORDER="5"    WIDTH="70%"   CELLPADDING="4" CELLSPACING="3">
   <TR>
      <TH COLSPAN="2"><BR><H3>Update Information</H3>
      </TH>
   </TR>
   <TR>
      <TH>Attribute</TH>
      <TH>Value</TH>
   </TR>
        <TR ALIGN="CENTER">
      <TD>Password</TD>
      <form method="post">
      <TD><input type="text" name="upass"/> <input type="submit" name="u1" value="Update"/></TD>
    </form>
    <?php
    if(isset($_POST['u1'])){
      $db  = new mysqli('localhost','root','','team62');
             $p = $_POST['upass'];
             $mail=$_COOKIE['userID'];
            if(!empty($p)){
              $qur=$db->query("Update Members set password = '{$p}' where email ='{$mail}'");
              if ($qur) {
   /* echo "Incorrect username or password";*/
} else {
    echo "Error: " .' '. "<br>" . mysqli_error($db);
}
            }
           }
    ?>
   </TR>
       <TR ALIGN="CENTER">
      <TD>Team Name</TD>
      
<form method="post">
      <TD><input type="text" name="uteam"/> <input type="submit" name="u2" value="Update"/></TD>
    </form>
    <?php
    if(isset($_POST['u2'])){
      $db  = new mysqli('localhost','root','','team62');
             $t = $_POST['uteam'];
             $mail=$_COOKIE['userID'];
            if(!empty($t)){
              $qur=$db->query("Update Development_Teams set team_name = '{$t}' where email = '{$mail}'");
            }
           }
    ?>


   </TR>
         <TR ALIGN="CENTER">
      <TD>Company Name</TD>
      
<form method="post">
      <TD><input type="text" name="ucompany"/> <input type="submit" name="u3" value="Update"/></TD>
    </form>
    <?php
    if(isset($_POST['u3'])){
      $db  = new mysqli('localhost','root','','team62');
             $c = $_POST['ucompany'];
             $mail=$_COOKIE['userID'];
            if(!empty($c)){
              $qur=$db->query("Update Development_Teams set company = '{$c}' where email = '{$mail}'");
            }
           }
    ?>


   </TR>
         <TR ALIGN="CENTER">
      <TD>Preferred Game Genre</TD>
      <form method = "post">
      <TD><select name = "gameType">
                  <option value="Sports">Sports</option>
                  <option value="Strategy">Strategy</option>
                  <option value="RPG">RPG</option>
                <option value="Action">Action</option>
                </select>
             <input type="submit" name = "u4" value="Update"/></TD>
           </form>

           <?php
    if(isset($_POST['u4'])){
      $db  = new mysqli('localhost','root','','team62');
             $pgg = $_POST['gameType'];
             $mail=$_COOKIE['userID'];
            if(!empty($pgg)){
              $qur=$db->query("Update Members set preferred_game_genre = '{$pgg}' where email = '{$mail}'");
            }
           }
    ?>
   </TR>
         <TR ALIGN="CENTER">
      <TD>Formation Date</TD>
     <form method="post">
      <TD><input type="date" name="udate"/> <input type="submit" name="u5" value="Update"/></TD>
    </form>
    <?php
    if(isset($_POST['u5'])){
      $db  = new mysqli('localhost','root','','team62');
             $fd = $_POST['udate'];
             $mail=$_COOKIE['userID'];
            if(!empty($fd)){
              $qur=$db->query("Update Development_Teams set formation_date = '{$fd}' where email = '{$mail}'");
            }
           }
    ?>
   </TR>
          
</TABLE>
    
    
    </body>
    

  
</html>