<?php

session_start();

    include("connection.php");
    include("functions.php");

    //check to see if user clicked sign up button
    if($_SERVER['REQUEST_METHOD']== "POST"){

        //user clicked sign up, check credentials
        $username = $_POST['username'];
        $password = $_POST['password'];

        if(!empty($username) && !empty($password)){

            //save to db
            $salted = "dfjhg584967y98ehg75498y".$password."fdsjghiuo54jyi";
            $hashed = hash('sha512',$salted);
            $userid = random_num(20);
            $query = "insert into user (userid,username,password) values ('$userid','$username','$hashed')";
           //save into db
            mysqli_query($con,$query);

            //redirect user to login
            header("Location: login.php");
            die;


        }else{
            echo "Please enter both fields";
        }

    }//end if
    

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>
</head>
<body>

    <div>
        <form method="POST">
            <h2>Sign up</h2>
            <label for="username">Username:</label>
            <input type = "text" name="username"><br><br>
            <label for="password">Password:</label>
            <input type = "password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*?[#?!@$%^&*-\]\[]).{8,}" title="The password must be 8 characters, at least one letter, one number, and one special character."><br><br>
            <p style="color:red;">The password must be 8 characters, at least one letter, one number, and one special character.</p>
            <input type = "submit" value="Sign Up"><br><br>

            <a href="login.php">Already have an account? Log in</a><br><br>


        </form>

    </div>

</body>
</html>