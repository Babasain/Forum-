<?php
session_start();

 echo ' <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
 <a class="navbar-brand" href="/forum">DevNest</a>
 <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
   <span class="navbar-toggler-icon"></span>
 </button>

 <div class="collapse navbar-collapse" id="navbarSupportedContent">
   <ul class="navbar-nav mr-auto">
     <li class="nav-item active">
       <a class="nav-link" href="/forum">Home <span class="sr-only">(current)</span></a>
     </li>
     <li class="nav-item">
       <a class="nav-link" href="about.php">About</a>
     </li>
     <li class="nav-item dropdown">
       <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         Catagories
       </a>
       <div class="dropdown-menu" aria-labelledby="navbarDropdown">
         <a class="dropdown-item" href="#">Action</a>
         <a class="dropdown-item" href="#">Another action</a>
         <div class="dropdown-divider"></div>
         <a class="dropdown-item" href="#">Something else here</a>
       </div>
     </li>
     <li class="nav-item">
       <a class="nav-link" tabindex="-1" href="contact.php">Contact</a>
     </li>
   </ul>
   <div class=" row mx-2">';
   if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
    echo '
    <form class="form-inline my-2 my-lg-0">
    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
    <button class="btn btn-success my-2 my-sm-0" type="submit">Search</button>
    
   <p class="text-light my-0 mx-2" > Welcome '.$_SESSION['username'].'
   </p>
   <a href="partials/_logout.php" class="btn btn-outline-success ml-2">Logout</a>

  </form>
    ';
   }else{
     
   echo'
   <form class="form-inline my-2 my-lg-0">
    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
    <button class="btn btn-success my-2 my-sm-0" type="submit">Search</button>
    </form>
      <button class="btn btn-outline-success ml-2"  data-toggle="modal" data-target="#loginModal">Login</button>
   
   <button class="btn btn-outline-success mx-2" data-toggle="modal" data-target="#signupModal">SignUp</button>';
   }
echo '</div>

   
  
 </div>
</nav>';

include 'partials/_loginModal.php';
include 'partials/_signupModal.php';
if (isset($_GET['signupsuccess']) &&  $_GET['signupsuccess'] == "true") {
   echo '
   <div class="alert alert-primary my-0 alert-dismissible fade show" role="alert">
  <strong>Thats All!</strong> You can now login
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
   ';
}

$error=isset($_GET['error']) ? $_GET['error'] : '';

if (!empty($error)) {
  echo '
  <div class="alert alert-danger my-0 alert-dismissible fade show" role="alert">
 <strong>Error!</strong> '.$error.'
 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
   <span aria-hidden="true">&times;</span>
 </button>
</div>
  ';
}



?>