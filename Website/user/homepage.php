<!DOCTYPE html>
<html>
<head>
  <title>Gamaty</title>
</head>
<body>

    <font color = "FF0000"><h1>Welcome to Gamaty</h1></font>

    <h2>Login</h2>
        <form name="login"  method = "post"  >
            Email: <input type="text" name="userid"/>
            <br>
            <br>
            Password: <input type="password" name="password"/>
            <br>
            <br>
            <input type="submit" name="login" value="Login"/>
            <input type="reset" value="Cancel"/>
        </form>
        <?php
        $db  = new mysqli('localhost','root','','team62');
        if(isset($_POST['login']))
{
    $mail = $_POST['userid'];
    $pass = $_POST['password'];
    if(!(empty($mail) || empty($pass))){
        if (checkAlreadyExists($mail,$pass)){
            $typ=getUserType($mail);
            if ($typ==1){
                setcookie('userID',$mail);
                 header("Location:normaluserprofile.php");
                       exit;
            }
            else if($typ==2){
                setcookie('userID',$mail);
                header("Location:verifiedprofile.php");
                       exit;
            }
           else{
            setcookie('userID',$mail);
                 header("Location:devteamprofile.php");
                       exit;
            }
        }
        
    }
}
        ?>
      <h2>Sign Up</h2>
        <form name="signup" method = "post">
            Email: <input type="text" name="signuserid"/>
            <br>
            <br>
            Password: <input type="password" name="signpassword"/>
            <br>
            <br>
            Preferred Game Genre: 
            <select name = "game_type">
                  <option value="Sports">Sports</option>
                  <option value="Strategy">Strategy</option>
                  <option value="RPG">RPG</option>
                <option value="Action">Action</option>
                </select>  
            <br>
            <br>
            Choose Member Type:
            <select name = "member_type">
                  <option value="n">Normal User</option>
                  <option value="v">Verified Reviewer</option>
                  <option value="d">Development Team</option>
                </select>  
            <br>
            <br>
            <input type="submit" name="Continue"  value="Continue"/>
            <input type="reset" value="Cancel"/>
        </form>
        <?php
        if (isset($_POST['Continue'])){
            //echo 'badry';
            $game_type = $_POST['game_type'];
            $member_type = $_POST['member_type'];
            echo "email already exists";
            $sp=$_POST['signpassword'];
            $sn=$_POST['signuserid'];
             if(!(empty($sp) || empty($sn))){
                
                     if (!findd($sn)){
                        $db  = new mysqli('localhost','root','','team62');
                        $qur=$db->query("insert into Members(email, password, preferred_game_genre)
                                        values('{$sn}','{$sp}','{$game_type}')");
                        if ($member_type=='n'){
                               setcookie('sinID',$sn);
                 header("Location:normalsignup.php");
                       exit;
                        }
                        if ($member_type=='v'){
                            setcookie('sinID',$sn);
                 header("Location:verifiedsignup.php");
                       exit;
                        }
                        else{
                  setcookie('sinID',$sn);
                 header("Location:devteamsignup.php");
                       exit;
                        }
                            

                     }
             }


        }
        ?>
    </body>
  
</html>
<?php
function checkAlreadyExists($mail,$pass){
    $db  = new mysqli('localhost','root','','team62');
    $val = $db->query("select *
                                from Members
                                where email = '{$mail}' and password = '{$pass}'");
    //echo $val;
    if ($val) {
    echo "Incorrect username or password";
} else {
    echo "Error: " .' '. "<br>" . mysqli_error($db);
}
    return $val->num_rows>0;
}

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
function findd($sn){
    $db  = new mysqli('localhost','root','','team62');
    $val = $db->query("select *
                                from Members
                                where email = '{$sn}'");
    /*if($val){
        echo "email already exists";
    }
    else {
    echo "Error: " .' '. "<br>" . mysqli_error($db);
    }*/
    return $val->num_rows>0;
}

?>