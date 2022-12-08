<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "lab4";

//connect to database
//if statement if connection fails

if(!$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname))
{
    die("failed to connect");
}