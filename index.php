<!DOCTYPE html>
<?php
    include("config.php");
    session_start();
    $db = mysqli_connect("localhost","root","","login");
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $myusername = mysqli_real_escape_string($db,$_POST['username']);
        $mypassword = mysqli_real_escape_string($db,$_POST['password']); 
        $sql = "SELECT id FROM db WHERE username = '$myusername' and password = '$mypassword'";
        $result = mysqli_query($db,$sql);
        $row=mysqli_fetch_assoc($result);
        $count = mysqli_num_rows($result);
        if(mysqli_num_rows($result)==1)
        {
            echo $myusername . "   <br> ".$mypassword;
            $_SESSION["username"]="$myusername";
            header("location: home.php");
        }
        else {
            $error;
            echo "<div id='error'>";
            echo "Your Username or Password is invalid. Please try again!" ;
            echo "</div>";
        }
    }
?>
<html>
    <head>
        <title>Hedwig Country Login</title>
        <link rel="stylesheet" href="style/countlog.css">
    </head>
    <body id="bod">
        <div id="conlog" class="logo" align="center">
            <h1 style="font-family: Segoe UI">Login</h1>
            <form name="LoginForm" action="" method="post">
                <img src="img/UNLogo.png" style="width:285px; height:255px">
                <table  cellpadding="5" align="center" cellspacing="15">
                    <tr>
                        <td style="font-family: Segoe UI; font-size:120%; font-weight: bold">Username</td>
                        <td><input type="text" name="username" placeholder="committee-country" size="35"></td>    
                    </tr>
                    
                    <tr>
                        <td style="font-family: Segoe UI; font-weight: bold; font-size:120%;">Password</td>
                        <td><input type="password" name="password" size="35"></td>
                    </tr>
                    
                    <tr>
                        <td colspan="2" ><input type="submit" value="Login" ></td>
                    </tr>
                </table>
            </form>
        </div>
    </body>
</html>