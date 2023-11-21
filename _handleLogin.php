<?php
$logError="false";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  include '_dbconnect.php';
  $login_user=$_POST['loginuser'];
  $email=$_POST['loginEmail'];
  $login_password=$_POST['loginPassword'];
  
   
  $sql="SELECT * FROM users WHERE user_email='$email'";
  $result=$con->query($sql);
  $numrows=mysqli_num_rows($result);
  if ($numrows == 1) {
     $row = mysqli_fetch_assoc($result);
        if(password_verify($login_password,$row['user_pass'])){
           session_start();
           $_SESSION['loggedin'] = true;
           $_SESSION['sno']=$row['sno'];

           $_SESSION['username'] = $login_user;
           $_SESSION['useremail'] = $email;
           echo "loged in " . $email;
          
        
        }
        header("Location: /forum/index.php");
        
     
  }
  header("Location: /forum/index.php");

}

?>