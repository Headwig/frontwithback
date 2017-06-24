<?php
    include 'db.php';
    $sender=$_POST['sender'];
    $receiver=$_POST['rec'];
    $message=$_POST['message'];
    $eb=$_POST['veb'];
    $query="INSERT INTO CHIT (sender,receiver,message,eb)values ('$sender','$receiver','$message','$eb')";
    $run = mysql_query($con1,$query);
    if($run)
        echo "<embed loop='false' src='chat.wav' hidden='true' autoplay='true'/>";
?>