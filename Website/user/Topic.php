<!DOCTYPE html>
<html>
<head>
  <title>Topic</title>
</head>
<body>
    <font color = "FF0000"><h1>Topic</h1></font>
      <?php
        $mail=$_COOKIE['userID'];
        $keyw=$_GET['id'];
       // $game = $_COOKIE['suser'];
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
  <li><a href=\"games_list.php\">Games</a></li>
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
    $mail=$_COOKIE['userID'];
    $keyw=$_GET['id'];
    $flg = $_GET['flg'];
    if($flg==1){
      $dt = $_GET['dat'];
      $db  = new mysqli('localhost','root','','team62');
      $qur = $db->query("delete from topic_comments
                       where member_email = '{$mail}' and topic_id = '{$keyw}' and date_time = '{$dt}'");
       if ($qur) {
} else {
    echo "Error: " .' '. "<br>" . mysqli_error($db);
}

      //header("Location:game_review.php?id=$keyw&flg=0");
    }
      echo "<form method=\"post\">
      <input type=\"submit\" name =\"del\" value=\"Delete Topic\"></form>";
      if (isset($_POST['del'])){
        $db  = new mysqli('localhost','root','','team62');
    $qur = $db->query("select *
                       from Topics
                       where member_email = '{$mail}' and id = '{$keyw}'");
     if ($qur->num_rows>0){
      $qur = $db->query("select *
                        from Topics
                        where id = '{$keyw}'");
      $valu =$qur->fetch_assoc();
      $qcid = $valu['community_id'];
      $qur = $db->query("delete from Topics
                       where member_email = '{$mail}' and id = '{$keyw}'");
      if ($qur) {
      header("Location:community.php?id=$qcid");
     exit();
} else {
    echo "Error: " .' '. "<br>" . mysqli_error($db);
}
     }



    }
    $db  = new mysqli('localhost','root','','team62');
    $qur = $db->query("select *
                        from Topics
                        where id = '{$keyw}'");
    $valu =$qur->fetch_assoc();
    $qid = $valu['id'];
    $qtitle = $valu['title'];
    $qdesc = $valu['description_text'];
    $qme = $valu['member_email'];
    $qcid = $valu['community_id'];
    echo "<TABLE BORDER=\"5\"    WIDTH=\"70%\"   CELLPADDING=\"4\" CELLSPACING=\"3\">
   <TR>
      <TH COLSPAN=\"4\"><BR><H3>Topic information</H3>
      </TH>
   </TR>
      <tr>
        <td>Writer's email</td>";
        $utype = getUserType($qme);
        if($utype ==1){
          echo "<td><a href = \"nuprofile.php?id=$qme \">$qme</a></td>";
        }
        if($utype ==2){
          echo "<td><a href = \"vprofile.php?id=$qme \">$qme</a></td>";
        }
       if($utype ==3){
          echo "<td><a href = \"dprofile.php?id=$qme \">$qme</a></td>";
        }
        echo "<td>Title</td>
        <td>$qtitle</td>
      </tr>
      <tr COLSPAN=\"1\"\>
        <td>$qdesc</td>
      </tr>
    </table>
    <br><br>
    <TABLE BORDER=\"5\"    WIDTH=\"70%\"   CELLPADDING=\"4\" CELLSPACING=\"3\">
   <TR>
      <TH COLSPAN=\"4\"><BR><H3>Comments</H3>
      </TH>
   </TR>
   <tr>
      <th>User's email</th>
      <th>Date</th>
      <th>Comment</th>
      <th>Delete</th>
   </tr>
    ";
      $db  = new mysqli('localhost','root','','team62');
      $mail=$_COOKIE['userID'];
      $qur=$db->query("select member_email, date_time, comments
                      from topic_comments
                      where topic_id = '{$keyw}'
                      order by date_time");
      if ($qur){
      while ($a1=$qur->fetch_assoc()){
        $me=$a1['member_email'];
        $c=$a1['comments'];
        $dt=$a1['date_time'];
        echo "<TR ALIGN=\"CENTER\">
      <TD>$me</TD>
      <TD>$dt</TD>
      <TD>$c</TD>";
      if($mail == $me)echo "<TD><a href=\"topic.php?id=$keyw&dat=$dt&flg=1\">Delete</a></TD>";
        else echo"<TD></TD>";
   echo "</TR>";
      }
    }
    echo "</table>";
    echo "<br>";
     echo "<p>Add Comment</p>
      <form method=\"post\">
      <textarea  rows =3 cols= 50 name=\"msg\"> </textarea> <input type=\"submit\" name=\"send\" value=\"Comment\"/>   
      </form>";
      if (isset($_POST['send'])){
        $ms=$_POST['msg'];
        if (!empty($ms)){
          
             $qur=$db->query("insert into topic_comments(member_email, topic_id, date_time, comments)
                              values('{$mail}', '{$keyw}', current_timestamp(), '{$ms}')");
            //echo "message send";
              if ($qur) {
     echo "Comment added";
     header("Location:topic.php?id=$keyw&flg=0");
     exit();
} else {
    echo "Error: " .' '. "<br>" . mysqli_error($db);
}
}
          else{
           
            //echo "Error: " .' '. "<br>" . mysqli_error($db);
          }

        }
    ?>
    <?php
      function MyComment($usr, $cid){
      $db  = new mysqli('localhost','root','','team62');
      $mail=$_COOKIE['userID'];
      $keyw=$_GET['id'];
      $qur=$db->query("select *
                      from game_review_comments
                      where game_review_id = '{$keyw}' and member_email = '{$mail}'");
      return ($qur->num_rows>0);
       

      }
    ?>
  </body>
  </html>