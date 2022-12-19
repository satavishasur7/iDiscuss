<?php
  $insert = false;
  $insertError = false;

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'connect.php';
    $username = $_POST['username'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $existSql = "SELECT * FROM `login` WHERE `username`='$username'";
    $result= mysqli_query($conn,$existSql);
    $num= mysqli_num_rows($result);

    if($num==1){
      $insertError = "Give a different username";
    }
    else{
      if ($password == $cpassword ) {
        $hash=password_hash($password, PASSWORD_DEFAULT );
        $sql = "INSERT INTO `login` ( `username`, `password`, `dt`) VALUES ('$username', '$hash', current_timestamp())";
        $result = mysqli_query($conn, $sql);
        if ($result) {
          $insert = true;
          header("Location: /forum/index.php");
          exit;
        }
      } 
    
    else {
        $insertError = "Password did not match";
        header("Location: /forum/index.php");
        exit;
      }
    }
    }
  ?>