<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <title>ThreadList</title>
</head>

<body>
    <?php
  
    include 'partials/_header.php';?>
    <?php  include 'partials/_dbconnect.php'; ?>
    <?php
      $id=$_GET['catid'];
      $sql="SELECT * FROM categories WHERE categorey_id=$id";
      $result=$con->query($sql);
      
      while($row=mysqli_fetch_assoc($result)){
        $catname=$row['categorey_name'];
        $catdesc=$row['categorey_description'];

      }

    ?>

    <?php
    $showAlert=false;
      $method=$_SERVER['REQUEST_METHOD'];
       if ($method == 'POST') {
         //INSERT INTO THREAD DB
         $th_title = $_POST['title'];
         $th_desc = $_POST['desc'];
        $userid= $_SESSION['sno'];
         $sql = "INSERT INTO `threads` (`thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `timestamp`) VALUES ('$th_title', '$th_desc', '$id', '$userid', current_timestamp())";
         $run = $con->query($sql);
         $showAlert=true;

         if ($showAlert) {
            echo '
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Your thread has been added plese wait for community reponse 
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
            ';
         }else{
            echo 'not inserted';
         }
       }

     ?>

    <div class="container my-4">
        <div class="jumbotron">
            <h1 class="display-4">WelCome To <?php echo $catname;?> Forum</h1>
            <p class="lead"><?php echo $catdesc;?></p>
            <hr class="my-4">
            <p>
                Treat other users with respect, even if you disagree with their opinions.
                Do not harass, discriminate, or bully others based on their race, gender, religion, nationality, sexual
                orientation, or any other characteristic.
                Post content relevant to the forum's intended topic or category.Do not spam the forum with irrelevant
                links, advertisements, or promotional content.
            </p>
            <p class="lead">
                <a class="btn btn-success btn-lg" href="#" role="button">Learn more</a>
            </p>
        </div>
    </div>
    <!--Question Container Starts-->
    <?php
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
    echo '<div class="container">
        <h1 class="py-2">Start Discussion</h1>

        <form action="' .$_SERVER["REQUEST_URI"].'" method="post">
            <div class="form-group">
                <label for="exampleInputEmail1">Problem Title</label>
                <input type="text" class="form-control" id="title" name="title" aria-describedby="title"
                    placeholder="Enter Title">
                <small id="emailHelp" class="form-text text-muted">keep your title short and relative
                </small>
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Ellaborate Your Concern</label>
                <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-success">Submit</button>
        </form>

    </div>
    ';
    }else{
      echo '
      <div class="container">
      <h1 class="py-2">Start Discussion</h1>
      <div class="alert alert-warning" role="alert">
       <strong>Hey!</strong> Plese Login First To Question
     </div>
    </div>
      ';
    }
    ?>
    <!--Question Container End--->

    <!--Browse Question Container Starts--->
    <div class="container">
        <h1 class="py-2">Browse Questions</h1>
        <?php
      $id=$_GET['catid'];
      $sql="SELECT * FROM threads WHERE thread_cat_id=$id";
      $result=$con->query($sql);
      $noResult=true;
      while($row=mysqli_fetch_assoc($result)){
        $noResult=false;
        $id=$row['thread_id'];
        $title=$row['thread_title'];
        $desc=$row['thread_desc'];
        $thread_time = $row['timestamp'];   
        $thread_date_time = new DateTime($thread_time);
        $format_date_time=$thread_date_time->format('F j, Y \a\t g:i A');
        $thread_id=$row['thread_user_id'];
        $sql2="SELECT user_name FROM `users` WHERE sno=$thread_id";
        $result2=$con->query($sql2);
        $row2=mysqli_fetch_assoc($result2);
      

      echo ' <div class="media p-2  my-3">
            <img class="mr-3" src="images/user.jpg" width="55px" alt="Generic placeholder image">
            <div class="media-body">
            <p class="font-weight-bold my-0">'.$row2['user_name'].' '.$format_date_time.'</p>
                <h5 class="mt-0"><a class="text-dark" href="thread.php?threadid='.$id.'">'.$title.'</a></h5>
                 '. $desc .'
            </div>
            <a class="mx-2" href="partials/_handeldelete.php?delid='.$id.'"><i class="ri-delete-bin-6-line"></i></a>
            <a href="partials/_handelupdate.php?updateid='.$id.'"><i class="ri-edit-line"></i></a>

        </div>';
    }
     //echo var_dump($noResult);
     if($noResult){
        echo '
        <div class="jumbotron jumbotron-fluid">
        <div class="container">
          <p class="display-4">Hmm.. No Questions Right Now</p>
          <p class="lead">Be First To Question</p>
        </div>
      </div>
        ';
     }
    ?>




    </div>
    <!--Browse Question Container Ends--->

    <?php  include_once 'partials/_footer.php'; ?>

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