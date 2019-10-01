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
<form method="post">
  <input type="submit" name="send" value="Send Friend Request"/> 
  </form>
  <?php
  $u1=$_COOKIE['userID'];
  $u2=$_GET['id'];
  if (isset($_POST['send'])){
    if (notfriends()){
       if (getUserType($u1)==1){
            $db  = new mysqli('localhost','root','','team62');
          $qur=$db->query("insert into Normal_Users_AddFriendship_Normal_Users(user1,user2)
                          values('{$u1}', '{$u2}')"); 
          echo "request sent";
       }
    }
  }
  ?>
      <br>
      <p>Recomend a Game to this user</p>
      <form method="post">
      <input  type = "text" name="msg" /><input type="submit" name="send2" value="Recommend"/>   
      </form> 
      <?php
      if (isset($_POST['send2'])){
        $ms=$_POST['msg'];
        if (!empty($ms)){
          $u1=$_GET['id'];
          $u2=$_COOKIE['userID'];
          $db  = new mysqli('localhost','root','','team62');
             $qur=$db->query("insert into games_recommendedby_normal_users(game_name, recommender_email, reciever_email)
                              values('{$ms}', '{$u2}' , '{$u1}')");
             
              if ($qur) {
     echo "Game recommended";
} else {
     echo "sorry you can not recomend the game";
}

          }
        }

      ?>  
      <br>
      <p>Send a Message</p>
      <form method="post">
      <textarea  rows =3 cols= 50 name="msg"> </textarea> <input type="submit" name="send3" value="Send"/>   
      </form> 
      <?php
      if (isset($_POST['send3'])){
        $ms=$_POST['msg'];
        if (!empty($ms)){
          $u1=$_GET['id'];
          $u2=$_COOKIE['userID'];
          $db  = new mysqli('localhost','root','','team62');
          $qur=$db->query("select *
                            from Normal_Users_AddFriendship_Normal_Users
                            where (user1 = '{$u1}' and user2 = '{$u2}' and approved = 1)
                            or (user2 = '{$u1}' and user1 = '{$u2}' and approved = 1)");
          if ($qur->num_rows>0){
          //  echo "da5l";
             $qur=$db->query("insert into Messages(user1, user2, message, date_time)
                              values('{$u2}' , '{$u1}', '{$ms}' , current_timestamp())");
             echo "message send";
              
          }
          else{
            echo "sorry you can not send this message";
          }

        }

      }
//       function getUserType($mail){
//     $db  = new mysqli('localhost','root','','team62');
//     $val = $db->query("select *
//                                 from Normal_users
//                                 where email = '{$mail}'");
//     if ($val->num_rows>0)return 1;
//     $val = $db->query("select *
//                                 from Verified_reviewers
//                                 where email = '{$mail}'");
//      if ($val->num_rows>0)return 2;
   
//      else return 3;
// }
      ?>
      <?php
      function notfriends(){
        $u1=$_COOKIE['userID'];
        $u2=$_GET['id'];
        $db  = new mysqli('localhost','root','','team62');
          $qur=$db->query("select *
                          from Normal_Users_AddFriendship_Normal_Users
                          where (user1 = '{$u1}' and user2 = '{$u2}')
                                or (user1 = '{$u2}' and user2 = '{$u1}')");
           if ($qur) {
} else {
    echo "Error: " .' '. "<br>" . mysqli_error($db);
}
        if ($qur->num_rows==0)return true;
        else return false;

      }
      ?>
      

    </body>
    

  
</html>