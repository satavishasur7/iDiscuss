<?php
session_start();


echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand text-success" href="index.php">iDiscuss</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="about.php">About</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Categories
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="/forum/threadlist.php?cat_id=1">Python</a></li>
              <li><a class="dropdown-item" href="/forum/threadlist.php?cat_id=2">Java</a></li>
              <li><a class="dropdown-item" href="/forum/threadlist.php?cat_id=3">C++</a></li>
              <li><a class="dropdown-item" href="/forum/threadlist.php?cat_id=4">C</a></li>
              <li><a class="dropdown-item" href="/forum/threadlist.php?cat_id=5">React</a></li>
              <li><a class="dropdown-item" href="/forum/threadlist.php?cat_id=6">Angular Js</a></li>
              
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="contactus.php">Contact Us</a>
          </li>
        </ul>';

        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
          echo '
            <form class=" d-flex" method="get" action="search.php">
            <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success me-2" type="submit">Search</button>

            </form>
            <p class="text-white me-2 my-0"> Welcome - <b>'.$_SESSION['username'].'</b> </p>
            <a href="_logout.php" class="btn btn-outline-success  me-2" type="submit">Log out</a>';
        }
        
        else {
          echo '
          <form class=" d-flex"  method="get" action="search.php">
            <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success me-2" type="submit">Search</button>
            
            </form>
        <button class="btn btn-success  me-2" type="submit"  data-bs-toggle="modal" data-bs-target="#LoginModal">Login</button>
        <button class="btn btn-success" type="submit"  data-bs-toggle="modal" data-bs-target="#SigninModal">Sign In</button>';
      }
      echo '
      </div>
    </div>
  </nav>';
  
include '_signinModal.php';
include '_loginModal.php';