<!DOCTYPE html>
<html>
<head>
  <title>Development Team Sign Up</title>
</head>
<body>
    <font color = "FF0000"><h1>Development Team Sign Up</h1></font>
    <h4>"You are about to sign up as a Development Team"</h4>

        <form name="devteamsignup" method = "post">
            <br><br>
            Formation Date: <input type="date" name="fdate">
            <br><br>
            Team Name: <input type="text" name="teamname"/>
            <br><br>
            Company: <input type="text" name="companyname"/>
            <br><br>
            <input type="submit" name ="sign" value="Sign Up"/>
            <input type="reset" value="Cancel"/>
        </form>
        <?php
        if(isset($_POST['sign'])){
             $tn = $_POST['teamname'];
            $cn = $_POST['companyname'];
            $dob =$_POST['fdate'];
            $mail=$_COOKIE['sinID'];
            if(!(empty($tn) || empty($dob))){
                $db  = new mysqli('localhost','root','','team62');
                     $qur=$db->query("insert into Development_Teams(email, company, team_name, formation_date)
                                        values('{$mail}','{$cn}','{$tn}','{$dob}')");
                     header("Location:homepage.php");
            }

        }
        ?>
    </body>


  
</html>