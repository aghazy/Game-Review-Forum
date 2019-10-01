<!DOCTYPE html>
<html>
<head>
  <title>Create a Community!</title>
</head>
<body>
    <font color = "FF0000"><h1>Create a Community</h1></font>
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
<form name="cr"  method = "post"  >
            Name: <input type="text" name="cn"/>
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
          $qur=$db->query("insert into Communities(name, description, user_request)
                           values('{$nm}', '{$ds}', '{$mail}')");
          if ($qur){
            echo"Request submited and pending approval by the admin";
          }

        }
?>

    </body>
    </html>