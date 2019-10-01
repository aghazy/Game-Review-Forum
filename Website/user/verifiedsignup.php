<!DOCTYPE html>
<html>
<head>
  <title>Verified Reviewer Sign Up</title>
</head>
<body>
    <font color = "FF0000"><h1>Verified Reviewer Sign Up</h1></font>
    <h4>"You are about to sign up as a Verfied Reviewer"</h4>

        <form name="verifiedsignup" method="post">
            <br><br>
            First Name: <input type="text" name="firstname"/>
            <br><br>
            Last Name: <input type="text" name="lastname"/>
            <br><br>
            Start Date: <input type="date" name="startdate">
            <br><br>
            <input type="submit" name="sign" value="Sign Up"/>
            <input type="reset" value="Cancel"/>
        </form>
        <?php
        if(isset($_POST['sign'])){
             $fn = $_POST['firstname'];
            $ln = $_POST['lastname'];
            $dob =$_POST['startdate'];
            $mail=$_COOKIE['sinID'];
            if(!(empty($fn) || empty($ln) || empty($dob))){
                $db  = new mysqli('localhost','root','','team62');
                     $qur=$db->query("insert into Verified_Reviewers(email, first_name, last_name, start_date)
                                        values('{$mail}','{$fn}','{$ln}','{$dob}')");
                     header("Location:homepage.php");
            }

        }
        ?>
    </body>
  
</html>