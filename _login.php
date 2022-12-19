<?php
    $loggedin= false;
    $logError= false;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'connect.php';
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sqlLog="SELECT * FROM `login` WHERE `username`='$username' ";
    $result= mysqli_query($conn,$sqlLog);
    $numLog= mysqli_num_rows($result);
    if($numLog==1){
      while($rowLog = mysqli_fetch_assoc($result))
      { 
        $userid=$rowLog['user_id'];
        if(password_verify($password, $rowLog['password']))
        {
          $loggedin= true;
          session_start();
          $_SESSION['loggedin']= true;
          $_SESSION['username']= $username;
          $_SESSION["id"]= $userid;
          header ( "location: /forum/index.php");
        }
        else{
          $logError ="Invalid Credentials";
        }
      }
    }
    else{
      $logError ="Invalid Credentials";
    }
  }
    ?>
   