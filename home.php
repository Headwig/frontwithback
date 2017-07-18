<?php
    include 'db.php';
    session_start();
    $con = mysqli_connect("localhost","root","","login");
    $count = 0;
    if(!$con)
    {
        echo"Failed to connect to database: ",mysqli_connect_error();
        $count .= 1;
        die();
    }
                    
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="style/Home.css">
        <script src="js/home.js" type="text/javascript"></script>
        <script src="js/jquery.min.js"></script>
        <title>Home</title>
    </head>
    <body>
        <ul id="navlist">
            <li id="navitem"><a href="GSL.php">General Speaker List</a></li>
            <li id="navitem"><a href="ROP.php">Rules of Procedure</a></li>
            <li id="navitem"><a href="modc.php">Moderated Caucus</a></li>
            <li id="navitem" style="float: right;"><a href="logout.php">Logout</a></li>
        </ul>
        <div id="contact_count">
            <div id="new_chat_bar">
                <input type="button" value="New Chat" id="new_chat" style="float: right;" onclick="showCountries()">
            </div>
        </div>
        <div id="count_list" class="count_trans" style="display:none">
            <div id="contact_back_bar">
                <input type="button" id="contact_back" value="Back" style="float: right;" onclick="hideCountries()">
            </div>
            <div id="clist">    
                <?php
                    $myusername=$_SESSION["username"];
                    $qry = "SELECT username FROM db WHERE NOT (username = '$myusername')";
                    $res = mysqli_query($con, $qry);
                    if(mysqli_num_rows($res)>0){
                        while($row0=mysqli_fetch_assoc($res)){
                            echo "<input class='countries_l' type='button' value='" . $row0['username'] . "' onclick='setUser(this)'>" ;
                        }
                    }
                ?>
            </div>
        </div>
        <div id="msgbox">
            <div id="selected">
                
            </div>
            <div id="user_inf">
                <?php
                    if($count == 0)
                    {
                        $sql="SELECT fname , username , email FROM db WHERE username = '$myusername'";
                        $result=mysqli_query($con,$sql);
                        if(mysqli_num_rows($result)>0)
                        {
                            while($row=mysqli_fetch_assoc($result))
                            {            
                                echo "Name : ".$row['fname'] . " <br> Username : ".$row['username']." <br> Email : ".$row['email']."</br>";            
                            }


                        }
                        else
                        {
                            echo "0 results " ;
                        }

                    }
                ?>
            </div>
            <?php
                $rec = $_POST['receive'];
                //echo $rec;
                $query="SELECT *  FROM chit where sender='".$myusername."' and receiver='".$rec."' ORDER BY id";
                $run=mysqli_query($con1,$query);
                if(mysqli_num_rows($result)>0){
                    while($row=mysqli_fetch_assoc($result)){
            ?>
            <div id="chat_data">
                <span style="color:green"><?php echo $row['name']?></span>:
                <span style="color:brown"><?php echo $row['message']?></span>
                <span style="float:right"><?php echo formatDate($row['date'])?></span>
            </div>
            <?php
                    }
                }
                else{
                    echo "Nothing to display!";
                }
            ?>
        </div>
        <div id="textarea">
            <?php echo "<input type='hidden' name='sender' id='sender' value='".$myusername."'>" ?>
            <?php echo "<input type='hidden' name='rec' id='rec' value='".$rec."'>" ?>
            <textarea type="text" name="message" id="message" value=""></textarea>
            <input type="checkbox" name="veb" id="via" value="1">
            <label id="chktxt">Via Executive Board</label>
            <input type="button" id="sndmsg" name="submit" value="SEND" onclick="sendMessage()">
        </div>
    </body>
</html>