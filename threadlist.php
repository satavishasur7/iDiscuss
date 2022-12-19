<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <title>iDiscuss-threads</title>
</head>

  <?php
  include 'connect.php';
  ?>
<body>
  <?php
  include 'header.php';
  ?>
  <?php
   $id = $_GET['cat_id'];
   $sql = "SELECT * FROM `category` WHERE `cat_id`='$id'";
   $result = mysqli_query($conn, $sql);
   while ($row = mysqli_fetch_assoc($result)) {
    $catTitle = $row['cat_title'];
    $catDesc = $row['cat_desc'];
   }
  ?>
    <?php
    $method = $_SERVER['REQUEST_METHOD'];
    $_SESSION['error'] = false;
    $insert = false;
    if ($method == 'POST') {
  
      $thread_title = $_POST['thread_title'];
      $thread_desc = $_POST['thread_desc'];
  
      $thread_desc = str_replace("<", "&lt;",  $thread_desc);
      $thread_desc = str_replace(">", "&gt;",  $thread_desc);
  
      $thread_title = str_replace("<", "&lt;",  $thread_title);
      $thread_title = str_replace(">", "&gt;",  $thread_title);
  
  
      $userid = $_POST['sno'];
      
      $sqlverify= "SELECT * FROM `thread`";
      $resultverify= mysqli_query($conn,$sqlverify);
      $numverify= mysqli_num_rows($resultverify);
      if ($numverify>0)
      {
        while ($rowverify = mysqli_fetch_assoc($resultverify))
        {
          $existthread= $rowverify['thread_title'];
          $existthreaddesc= $rowverify['thread_desc'];
          
          
        }
      }
      $check = 1;

      $status = 0;
      if ($check == 1) {
        if (($thread_desc == $existthread) and ($thread_title != $existthread)) {
            $status = 1;
        } elseif (($thread_desc != $existthread) and ($thread_title == $existthread)) {
            $status = 1;
        } elseif (($thread_desc != $existthread) and ($thread_title != $existthread)) {
            $status = 1;
        } else {
            $status = 0;
          }

        }
      
    
      
if ($status==1)
      {
        
        $sql2 = "INSERT INTO `thread` (`thread_title`, `thread_desc`, `cat_id`, `thread_user_id`) VALUES ('$thread_title', '$thread_desc', '$id',  '$userid')";
        $result2 = mysqli_query($conn, $sql2);
        $insert = true;

    if ($insert) {
      echo '
      <div class="alert alert-success alert-dismissible fade show my-0"  role="alert">
      <strong>Success ! </strong> Your data has inserted succesfully. 
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    } 
  
  }
}
?>
  <div class="container my-5 ">
    <div class="col-md-12">
        <div class="h-100 p-5 text-white bg-dark rounded-3">
            <h2 class= text-center>Welcome to the platform of <?php echo $catTitle ?></h2>
            <p class= text-success> <?php echo $catDesc ?></p>
        </div>
    </div>

</div>;

  <div class="container">
    <h2>Add a discussion.</h2>
    <?php
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
      echo
      '<form action="' . $_SERVER["REQUEST_URI"] . '" method="POST">
            <div class="mb-3">
            <label for="thread_title" class="form-label">Enter your query:</label>
            <input type="text" class="form-control" name="thread_title" id="thread_title" aria-describedby="emailHelp">
            
            </div>
            <input type="hidden" name="sno" value="' . $_SESSION["id"] . '">
            <div class="mb-3">
            <label for="thread_desc" class="form-label">Describe your query:</label>
            <textarea class="form-control" name="thread_desc" id="thread_desc" rows="3"></textarea>
          </div>
            <button type="submit" class="btn btn-success">Submit</button>
          </form>
            </div>';
    } else {
      echo '
            
            <P class=lead>Please login to add a discussion.</p>
            ';
    }
    ?>
  </div>
  <div class="container">
    <h2 class="my-3">Browse Questions</h2>

    <?php
    $sql1 = "SELECT * FROM `thread` WHERE cat_id=$id";
    $result1 = mysqli_query($conn, $sql1);
    $num = mysqli_num_rows($result1);

    if ($num == 0) {
      echo '
  <div class="container my-5 text-center">
        <div class="col-md-12">
            <div class="h-100 p-5 text-black bg-light rounded-3">
                <h2>No discussions found.</h2>
                <p>Be the first one to start a discussion.</p>
                
            </div>
        </div>

    </div>';
    } else
      while ($row = mysqli_fetch_assoc($result1)) { {
          $postedby = $row['thread_user_id'];
          $sql3 = "SELECT * FROM `login` WHERE user_id=$postedby";
          $result3 = mysqli_query($conn, $sql3);
          $row3 = mysqli_fetch_assoc($result3);
          echo '<div class="d-flex fs-5 text-muted pt-3">
              <img src="image/user5.png" height="40" width="40">

              <div class="d-flex flex-column pb-3 mb-0 small lh-sm border-bottom mx-2">
                <a href="thread.php?threadid=' . $row['thread_id'] . '" class="text-decoration-none"><strong class="d-block text-success">' . $row['thread_title'] . '</strong></a>
                ' . $row['thread_desc'] . '
                <div>
                Posted by- <b>' . $row3['username'] . '</b>
                </div>
                <div>
                ' . $row['dt'] . ' at ' . $row['time'] . '
                </div>
              </div>
   </div>';
        }
      }
    ?>
  </div>
  <?php include 'footer.php'; ?>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
  </script>
</body>

</html>