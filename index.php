<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    
    <title>DevNest</title>

    
</head>

<body>

    <?php
    
    include 'partials/_header.php';
     ?>
    <?php include 'partials/_dbconnect.php';?>
    <!---Slider Starts Here-->

    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active ">
                <img class="d-block w-100"  src="images/dosomething.jpg" width="1600px" height="600px" alt="First slide">
                <div class="carousel-caption d-none d-md-block">
                    <h5>WelCome To DevNest Coding Forums</h5>
                    <p>We're more than just a forum we're a vibrant community of passionate individuals who share a
                        common love for coding and technology.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="images/laptop.jpg" width="1600px" height="600px"
                    alt="Second slide">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Join the Coding Conversation</h5>
                    <p>
                        Dive into the heart of the coding world by joining our online forum. Here, you'll discover a
                        diverse range of topics, from JavaScript to Python, web development to data science, and so much
                        more. Share your coding challenges, get feedback on your projects, or simply engage in
                        enlightening conversations with fellow enthusiasts. Whether you're looking for answers, seeking
                        inspiration, or just want to connect with like-minded individuals, our coding forum is the place
                        to be.
                    </p>
                </div>
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="images/htmllines.jpg" width="1600px" height="600px"
                    alt="Third slide">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Get Ready to Elevate Your Coding Journey</h5>
                    <p>
                        Are you ready to elevate your coding journey to new heights? Our coding forum is the ideal
                        platform to embark on this thrilling adventure. With a supportive community, expert advice, and
                        a treasure trove of resources, you'll have the tools you need to excel in the world of coding.
                        So, what are you waiting for? Join us and take your coding skills to the next level today!
                    </p>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <!---Slider Ends Here--->


    <!---Ctegorey Container Starts Here-->
    <div class="container my-4">
        <h2 class="text-center">DevNest Catagories</h2>

        <div class="row my-3">
            <!--Using Php to fetch all categories And using Loop to iterate through categories-->

             <?php
               $sql="SELECT *  FROM  categories";


               $result = $con->query($sql);
               
               while($row=mysqli_fetch_assoc($result)){
                $id=$row['categorey_id'];
              //  $_SESSION['catid']=$id;
                $cat = $row['categorey_name'];
                $desc=$row['categorey_description'];
                 echo '
                 <div class="col-md-4 my-3">
                 <div class="card" style="width: 18rem;">
                     <img  src="images/card-'.$id.'.jpg" class="card-img-top"
                         alt="Card image cap">
                     <div class="card-body">
                         <h5 class="card-title"><a href="threadlist.php?catid='.$id.'">'.$cat.'</a></h5>
                         <p class="card-text">'.substr($desc,0,90).'....</p>
                         <a href="threadlist.php" class="btn btn-primary">View Threads</a>
                     </div>
                 </div>
             </div>
                 ';
               }
             ?>
           

       






















        </div>
    </div>
    <?php include 'partials/_footer.php'; ?>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
</body>

</html>