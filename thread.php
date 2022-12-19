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

<body>
  <?php
  include 'connect.php';
  ?>
  <?php
  include 'header.php';
  ?>
 

  <?php
  $id = $_GET['threadid'];
  $sql = "SELECT * FROM `thread` WHERE `thread_id`='$id'";
  $result = mysqli_query($conn, $sql);
  while ($row = mysqli_fetch_assoc($result)) {
    $postedby = $row['thread_user_id'];
    $sql3 = "SELECT * FROM `login` WHERE user_id=$postedby";
    $result3 = mysqli_query($conn, $sql3);
    $row3 = mysqli_fetch_assoc($result3);
    
    $threadTitle = $row['thread_title'];
    $threadDesc = $row['thread_desc'];
    $name = $row3['username'];
  }
  ?>
  <?php
  $method = $_SERVER['REQUEST_METHOD'];
  $comment = false;
  if ($method == 'POST') {
    $userid = $_POST['sno'];
    $comment_desc = $_POST['comment_desc'];
    
    $comment_desc = str_replace("<","&lt;",  $comment_desc);
    $comment_desc = str_replace(">","&gt;",  $comment_desc);
     
     $commentcheck=0;
    $sqlverify= "SELECT * FROM `comment`";
    $resultverify= mysqli_query($conn,$sqlverify);
    $numverify= mysqli_num_rows($resultverify);
    if ($numverify>0)
    {
      while ($rowverify = mysqli_fetch_assoc($resultverify))
      {
        $existcomment= $rowverify['comment_desc'];
        
        if ($comment_desc!=$existcomment)
        {
          $commentcheck=1;
        }
      }
    }
  if($commentcheck==1){
    $sql2 = "INSERT INTO `comment` ( `comment_desc`, `thread_id`, `comment_user_id`) VALUES ( '$comment_desc', '$id', '$userid')";
    $result2 = mysqli_query($conn, $sql2);
    $comment = true;
  
  if ($comment) {
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
        <div class="h-100 p-5 text-dark bg-light rounded-3">
            <h2 ><?php echo $threadDesc ?></h2>
            <p><?php echo $threadDesc ?></p>
            <p class="my-2">Posted by- <b><?php echo $name ?></b></p>
        </div>
    </div>

</div>

  <div class="container">
    <h2>Add a comment.</h2>
    <?php
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
      echo
      '<form action="' . $_SERVER["REQUEST_URI"] . '" method="POST">
  
  <div>
  <input type="hidden" name="sno" value="'. $_SESSION["id"]. '">
  
  </div>
  <div class="mb-3">
  <label for="comment_desc" class="form-label">Enter your comment:</label>
  <textarea class="form-control" name="comment_desc" id="comment_desc" rows="3"></textarea>
</div>
  <button type="submit" class="btn btn-success">Submit</button>
</form>
  </div>';
    } else {
      echo '
   
    <P class=lead>Please login to add a comment.</p>';
    }
    ?>
  </div>
    <div class="container">
      <h2 class="my-3">Comments</h2>

      <?php
      $sql1 = "SELECT * FROM `comment` WHERE thread_id=$id";
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
        while ($row = mysqli_fetch_assoc($result1)) {

          $commentby = $row['comment_user_id'];
          $sql3 = "SELECT * FROM `login` WHERE user_id=$commentby";
          $result3 = mysqli_query($conn, $sql3);
          $row3 = mysqli_fetch_assoc($result3);
          echo '
                    <div class="d-flex fs-5 text-muted pt-3">
                    <img src="image/user5.png" height="40" width="40" >
                    
                    <div class="d-flex flex-column pb-3 mb-0 mx-2 small lh-sm border-bottom">
                    ' . $row['comment_desc'] . '
                    <strong class="d-block text-gray-dark my-1">Posted by - <b>' . $row3['username'] . '</b></strong>
                    <div>
                    '.$row['dt'].' at '.$row['time'].'
                    </div>
                    </div>
                    
                    </div>';
        }
      ?>
    </div>

    <?php
    include 'footer.php';
    ?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>