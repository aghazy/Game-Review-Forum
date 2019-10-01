<!DOCTYPE html>
<html>
<head>
  <title>Normal User Sign Up</title>
</head>
<body>
    <font color = "FF0000"><h1>Normal User Sign Up</h1></font>
    <h4>"You are about to sign up as a Normal User"</h4>

        <form name="normalusersignup" method = "post">
            <!--Email: <input type="text" name="userid"/>
            <br><br> -->
            First Name: <input type="text" name="firstname"/>
            <br><br>
            Last Name: <input type="text" name="lastname"/>
            <br><br>
            Date of Birth: <input type="date" name="bday">
            <br><br>
            <input type="submit" name="sign"  value="Sign Up"/>
            <input type="reset" value="Cancel"/>
        </form>
        <?php
        if(isset($_POST['sign'])){
             $fn = $_POST['firstname'];
            $ln = $_POST['lastname'];
            $dob =$_POST['bday'];
            $mail=$_COOKIE['sinID'];
            if(!(empty($fn) || empty($ln) || empty($dob))){
                $db  = new mysqli('localhost','root','','team62');
                     $qur=$db->query("insert into Normal_Users(email, first_name, last_name, date_of_birth)
                                        values('{$mail}','{$fn}','{$ln}','{$dob}')");
                     header("Location:homepage.php");
            }

        }
        ?>
    </body>
  
</html>