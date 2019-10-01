<!DOCTYPE html>
<html>
<head>
  <title>Games!</title>
</head>
<body>
    <font color = "FF0000"><h1>Rate the game!</h1></font>
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
    $game = $_GET['id'];
    $mail = $_COOKIE['userID'];
    echo " <form method =\"post\" >
    <h1>$game</h1>
        <p>Rate each component with values between 0 and 5</p>
        <table>
            <tr>
                <td>Graphics</td>
                <td><select name = \"graphics\">
                    <option value=0>0</option>
                    <option value=1>1</option>
                    <option value=2>2</option>
                    <option value=3>3</option>
                    <option value=4>4</option>
                    <option value=5>5</option>
                </select></td>
            </tr>
            <tr>
                <td>Interactivity</td>
                <td><select name = \"interactivity\">
                    <option value=0>0</option>
                    <option value=1>1</option>
                    <option value=2>2</option>
                    <option value=3>3</option>
                    <option value=4>4</option>
                    <option value=5>5</option>
                </select></td>
            </tr>
            <tr>
                <td>Uniqueness</td>
                <td><select name= \"uniqueness\">
                    <option value=0>0</option>
                    <option value=1>1</option>
                    <option value=2>2</option>
                    <option value=3>3</option>
                    <option value=4>4</option>
                    <option value=5>5</option>
                </select></td>
            </tr>
            <tr>
                <td>Level Design</td>
                <td><select name= \"level_design\">
                    <option value=0>0</option>
                    <option value=1>1</option>
                    <option value=2>2</option>
                    <option value=3>3</option>
                    <option value=4>4</option>
                    <option value=5>5</option>
                </select></td>
            </tr>
        </table>
       <input type=\"submit\" name =\"teto\" value=\"Rate\"></form>";
        if (isset($_POST['teto'])){
            $val1 = $_POST['graphics'];
            $val2 = $_POST['interactivity'];
            $val3 = $_POST['uniqueness'];
            $val4 = $_POST['level_design'];
            echo $val1;
            echo $val2;
            echo $val3;
            echo $val4;
            $qur=$db->query("call `rate_game` ('{$game}', '{$mail}', '{$val1}', '{$val2}', '{$val3}', '{$val4}')");//ma4ta8lt4
            if ($qur) {
                header("Location:game.php?id=$game");
} else {
    echo "You already rated this game before";
}

        }
        
       ?>
    </body>
</html>