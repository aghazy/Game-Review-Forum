<!DOCTYPE html>
<html>
<head>
  <title>Games!</title>
</head>
<body>
    <font color = "FF0000"><h1>Games!</h1></font>
      <?php
        $mail=$_COOKIE['userID'];
       // $keyw=$_COOKIE['ser'];
        $val=getUserType($mail);
        $prof="/user/devteamprofile.php";
        $upprof="/user/updatedevteam.php";
        if ($val==1){
        $prof="/user/normaluserprofile.php";
        $upprof="/user/updatenormaluser.php";
        }
        else if ($val==2){
        $prof="/user/verifiedprofile.php";
        $upprof="/user/updateverified.php";
        }
      echo "<a href=$prof>My Profile</a> | <a href=$upprof>Update Profile</a> | <a href=\"homepage.php\">Logout</a
       
    <ul>
  <li><a href=$prof>Home</a></li>
  <li><a href=\"news.asp\">Games</a></li>
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
        $mail=$_COOKIE['userID'];
        $g=$_GET['id'];
      $val = getUserType($mail);
      $qur=$db->query("select *
                            from communities_joinedby_members
                            where member_email = '{$mail}' and community_id = '{$g}'");
          if ($qur->num_rows==0){
      echo"
          <form method =\"post\" action=\"\"><input type=\"submit\" name =\"join\" value=\"Join\"></form>

        ";
         if (isset($_POST['join'])){
            $qur=$db->query("insert into communities_joinedby_members(member_email, community_id)
                             values ('{$mail}', '{$g}')");
            header("Location:community.php?id=$g");
          }
        }
     $qur=$db->query("select name, description, user_request
                      from Communities
                      where id = '{$g}'");
   $valu =$qur->fetch_assoc();
   $name=$valu['name'];
   $desc=$valu['description'];
   $ur=$valu['user_request'];
    echo "<TABLE BORDER=\"5\"    WIDTH=\"70%\"   CELLPADDING=\"4\" CELLSPACING=\"3\">
   <TR>
      <TH COLSPAN=\"2\"><BR><H3>Community Information</H3>
      </TH>
   </TR>
   <TR>
      <TH>Attribute</TH>
      <TH>Value</TH>
   </TR>
   <TR ALIGN=\"CENTER\">
      <TD>Name</TD>
      <TD>$name</TD>
   </TR>
       <TR ALIGN=\"CENTER\">
      <TD>Owner</TD>
      <TD><a href = \"nuprofile.php?id=$ur\">$ur</a></TD>
   </TR>
         <TR ALIGN=\"CENTER\">
      <TD>Description</TD>
      <TD>$desc</TD>
   </TR>
</TABLE>";
echo "<br>";
echo "<br>";
 echo "<TABLE BORDER=\"5\"    WIDTH=\"70%\"   CELLPADDING=\"4\" CELLSPACING=\"3\">
   <TR>
      <TH COLSPAN=\"1\"><BR><H3>Topics</H3>
      </TH>
   </TR>
   <TR>
      <TH>Title</TH>
   </TR>
   ";
$qur=$db->query("select id, title
                      from Topics
                      where community_id = '{$g}'");
   while($valu =$qur->fetch_assoc()){
   $id=$valu['id'];
   $title=$valu['title'];
       echo "<TR ALIGN=\"CENTER\">
      <TD><a href=\"topic.php?id=$id&flg=0 \">$title</a></TD>
       </TR>";
   }
 echo "</TABLE>";
 echo "<br>";
echo "<br>";
 echo "<TABLE BORDER=\"5\"    WIDTH=\"70%\"   CELLPADDING=\"4\" CELLSPACING=\"3\">
   <TR>
      <TH COLSPAN=\"1\"><BR><H3>Members</H3>
      </TH>
   </TR>
   <TR>
      <TH>Member</TH>
   </TR>
   ";
$qur=$db->query("select member_email
                      from communities_joinedby_members
                      where community_id = '{$g}'");
   while($valu =$qur->fetch_assoc()){
   $mem=$valu['member_email'];
       echo "<TR ALIGN=\"CENTER\">
      <TD>$mem</TD>
       </TR>";
   }
 echo "</TABLE>";
?>
 <br>
<h2>add topic</h2>
  <br>
<form name="cr"  method = "post"  >
            Title: <input type="text" name="cn"/>
            <br>
            <br>
            Description: <textarea  rows =3 cols= 50 name="msg"> </textarea>
            <input type="submit" name="create" value="Create"/>
            <input type="reset" value="Cancel"/>
        </form>
        <?php
        $db  = new mysqli('localhost','root','','team62');
        if(isset($_POST['create'])){
          $nm=$_POST['cn'];
          $ds=$_POST['msg'];
          if (!(empty($nm)||empty($ds))){
          $qur=$db->query("call `post_topic`('{$g}', '{$mail}', '{$nm}', '{$ds}')");
          header("Location:community.php?id=$g");
        }
         // if ($qur){
         //   echo"Topic posted";
         // }
         // else
          //  echo "You need to be a member of this community to be able to post a topic";
        }
?>
    </body>
    

  
</html>