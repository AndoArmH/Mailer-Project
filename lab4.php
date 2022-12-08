<?php
//session is a variable that can be accessed from by any page
//superglobal variable
session_start();
   
    //we put user id on session on every page to make sure
    //its the same user on every page and theyre logged in
    

    include("connection.php");
    include("functions.php");

    $user_data = check_login($con);
    //function that will take user data and check if theyre logged in
    //$con is connection to database

    date_default_timezone_set('America/Los_Angeles');
    $date = date('Y-m-d h:i:s', time());
    echo "$date";
    if($_SERVER['REQUEST_METHOD']== "POST")
    {
        $userid = $_SESSION['Userid'];
        $email = $_POST['email'];
        $message = $_POST['message'];
        $timestamp = $_POST['timestamp'];
        $msgid = random_num(20);


        if(!empty($email) && !empty($message) && !empty($timestamp))
        {

            //save to db

            $query = "insert into message (msgid,userid,email,message,timestamp) values ('$msgid','$userid','$email','$message','$timestamp')";
           //save into db
            mysqli_query($con,$query);

            //redirect user to saved
            header("Location: saved.php");
            die;


        }else{
            echo "Please enter all fields";
        }
    }

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<a href="logout.php">Logout</a>    
<h2>Home Page</h2>
<br><br>
<div>
        <form method="post">
            <h3>Mail Form</h3>
            <p>Please enter the email address you want your message sent to:</p>


            <input type = "email" name="email"><br><br>
            <p>Enter the message to be sent:</p><br>
            <textarea name="message" rows="10" cols="30"></textarea><br><br>
            <p>Specify date-time by clicking icon on the right:</p><br>
            <input type="datetime-local" name="timestamp"><br><br>


            <input type = "submit" value="Save"><br><br>



        </form>

    </div>

    
</body>
</html>