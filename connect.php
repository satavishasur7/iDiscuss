<?php
$servername= "localhost";
$username="root";
$password="";
$database="idiscuss";

$conn=mysqli_connect($servername, $username, $password, $database);

if(!$conn)
{
    die("Failed to connect the databade.");
}
?>