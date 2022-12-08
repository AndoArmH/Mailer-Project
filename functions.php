<?php

function check_login($con)
{
    //checking to see if the user id is in db and if session is 
    //logged in thru this user id
    if(isset($_SESSION['Userid']))
    {
        $id = $_SESSION['Userid'];
        $query = "select * from user where Userid = '$id' limit 1";

        $result = mysqli_query($con,$query);
        if($result && mysqli_num_rows($result) > 0){
            $user_data = mysqli_fetch_assoc($result);
            return $user_data;
        }

    }//end if

    //redirect to login if fails 
    header("Location: login.php");
    die;
}//close check_login

function random_num($num){

    $text = "";

    $len = rand(4,$num);

    for($i=0; $i<$len; $i++){

        $text .= rand(0,9);

    }
    return $text;

}

function debug_to_console($data) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}