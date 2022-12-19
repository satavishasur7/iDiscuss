
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>iDiscuss- a coding forum.</title>
  </head>
  <body>
   <?php
    include 'header.php';
   ?>
   
    <?php
    include 'connect.php';
   ?>
   
   <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="./image/caro1.jpeg" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="./image/caro2.jpeg" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="./image/caro3.jpeg" class="d-block w-100" alt="...">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
   

<div class="container-fluid my-5 row d-flex justify-content-center">
    <h1 class=" text-center mb-5 "> Browse Categories: </h1>
<?php
$sql="SELECT * FROM `category`";
$result= mysqli_query($conn,$sql);
while($row= mysqli_fetch_assoc($result))
{
    echo '<div class="card col-md-4 mx-3 my-3" style="width: 18rem;">
    <img src="image/pic-' .$row['cat_id'].'.jpg" class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title">'.$row['cat_title'].'</h5>
      <p class="card-text">' . substr($row['cat_desc'],0 ,90) . '...</p>
      
    </div>
    <a href="threadlist.php?cat_id=' .$row['cat_id'].'" class="btn btn-outline-success">Learn More</a>
  </div>
 ';
}

?>
 </div>



     <?php
    include 'footer.php';
   ?>
  
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

   
  </body>
</html>