<?php
$showError="false";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include '_dbconnect.php';
    $user_name=$_POST['signUpuser'];
    $user_email=$_POST['signupEmail'];
    $user_password=$_POST['signUpPassword'];
    $cpass=$_POST['signUpcPassword'];

    //Check weather email exist or not...

    $existSql="SELECT * FROM users WHERE user_email='$user_email'";
    $result=$con->query($existSql);
    $numrows=mysqli_num_rows($result);

    if($numrows > 0){
        $showError = "Email already in use";

    }else{
        if($user_password == $cpass){
            $hash = password_hash($user_password,PASSWORD_DEFAULT);
            $sql = "INSERT INTO `users` (`user_name` , `user_email`, `user_pass`, `timestamp`) VALUES ('$user_name','$user_email', '$hash', current_timestamp())";
            $result = $con->query($sql);
            if ($result) {
                $showAlert=true;
                header("Location: /forum/index.php?signupsuccess=true");
                exit();

            }

        }else{
            $showError = "password do not match";


        }
    }
    header("Location: /forum/index.php?signupsuccess=false&error=" . urlencode($showError));

}

?>