<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    
    <title>ThreadList</title>
</head>

<body>
    <?php  include 'partials/_header.php';?>
    <?php  include 'partials/_dbconnect.php'; ?>
    <?php
      $id=$_GET['threadid'];
      
      $sql="SELECT * FROM threads WHERE thread_id=$id";
      $result=$con->query($sql);
      while($row=mysqli_fetch_assoc($result)){
        $title=$row['thread_title'];
        $desc=$row['thread_desc'];
       

      }

    ?>
     <?php
    $showAlert=false;
      $method=$_SERVER['REQUEST_METHOD'];
       if ($method == 'POST') {
         //INSERT INTO Comment DB
         $comment = $_POST['comment'];
         $sno=$_POST['sno'];
        // echo var_dump($sno);
         $sql="INSERT INTO `comments` (`comment_content`, `thread_id`, `comment_by`, `comment_time`) VALUES ('$comment', '$id', '$sno', current_timestamp())";

         $run = $con->query($sql);
         $showAlert=true;

         if ($showAlert) {
            echo '
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Your Comment has been added 
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
            <h1 class="display-4"> <?php echo $title;?> </h1>
            <p class="lead"><?php echo $desc;?></p>
            <hr class="my-4">
            <p>
                Treat other users with respect, even if you disagree with their opinions.
                Do not harass, discriminate, or bully others based on their race, gender, religion, nationality, sexual
                orientation, or any other characteristic.
                Post content relevant to the forum's intended topic or category.Do not spam the forum with irrelevant
                links, advertisements, or promotional content.
            </p>
            <p>Posted by:<b>Tabarak</b></p>
        </div>
    </div>
    <?php
      if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
       echo '<div class="container">
        <h1 class="py-2">Post Comment</h1>
        
        <form action="'.$_SERVER["REQUEST_URI"].'" method="post">
           
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Type Your Comment</label>
                <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
                <input type="hidden" name="sno" value = "'.$_SESSION["sno"].'">
            </div>
            <button type="submit" class="btn btn-success">Post Comment</button>
        </form>

    </div>'
      
    ;
      }else{
        echo '
        <div class="container">
        <h1 class="py-2">Post Comment</h1>
        <div class="alert alert-warning" role="alert">
         <strong>Hey!</strong> Plese Login First To Coment
       </div>
      </div>
        ';
      }
   ?>
    <div class="container">
        <h1 class="py-2">Discussions</h1>
       <?php
      $id=$_GET['threadid'];
      $sql="SELECT * FROM comments WHERE thread_id=$id";
      $result=$con->query($sql);
      $noResult=true;
      while($row=mysqli_fetch_assoc($result)){
        $noResult=false;
        $id=$row['comment_id'];
        $content=$row['comment_content'];
        $comment_time=$row['comment_time'];
        $dateTime = new DateTime($comment_time);
        $formatdate=$dateTime->format('F j, Y \a\t g:i A');
        $commentby=$row['comment_by'];
        $sql2="SELECT user_name FROM `users` WHERE sno='$commentby'";
        $run=$con->query($sql2);
        $row2=mysqli_fetch_assoc($run);
        
      echo ' <div class="media my-3">
            <img class="mr-3" src="images/user.jpg" width="55px" alt="Generic placeholder image">
            <div class="media-body">
                <p class="font-weight-bold my-0">'.$row2['user_name'].' at '.$formatdate.'</p>
                 '. $content .'
            </div>
        </div>';
    }

    if($noResult){
        echo '
        <div class="jumbotron jumbotron-fluid">
        <div class="container">
          <p class="display-4">Hmm.. No Discussion Right Now</p>
          <p class="lead">Be First To Answer The Question</p>
        </div>
      </div>
        ';
    }

    ?> 

      


       
    </div>

    <?php include_once 'partials/_footer.php';?>

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