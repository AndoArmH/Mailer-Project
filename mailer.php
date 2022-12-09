<?php
session_start();

    include("connection.php");
    include("functions.php");

    $query = "select * from message where sent = '0' limit 1";
	$result = mysqli_query($con, $query);
    $user_data = mysqli_fetch_assoc($result);
    //found the following code on https://stackoverflow.com/questions/470617/how-do-i-get-the-current-date-and-time-in-php?page=1&tab=scoredesc#tab-top
    date_default_timezone_set('America/Los_Angeles');
    $date = date('Y-m-d H:i:s', time());

    if($result){
        
        if($result && mysqli_num_rows($result) > 0){
            

            
            $msgid = $user_data['msgid'];
            $email = $user_data['email'];
            $message = $user_data['message'];
            $timestamp = $user_data['timestamp'];
           

            
            if($timestamp <= $date){
                
                echo "email sent to $email success";
                

                $query1 = "update message set sent = '1' where msgid = '$msgid'";
                mysqli_query($con,$query1);
                $result = mysqli_query($con, $query);
            
                
                $subject = 'AUTOMATED EMAIL';
                
                $headers = "Content-type: text/html\r\n";
                mail($email,$subject,$message,$headers);

                die;
                
            }

            
        }else{
            die;
        }
    }
   die;
?>