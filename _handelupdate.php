<?php
include_once "_dbconnect.php";

$ID = isset($_GET['updateid']) ? $_GET['updateid'] : 0;

if (isset($_POST['submit'])) {
    $update_title = isset($_POST['updatetitle']) ? $_POST['updatetitle'] : '';
    $update_description = isset($_POST['updatedesc']) ? $_POST['updatedesc'] : '';

    // Use prepared statements to prevent SQL injection
    $updatequery = $con->prepare("UPDATE threads SET thread_title=?, thread_desc=? WHERE thread_id=?");
    $updatequery->bind_param("ssi", $update_title, $update_description, $ID);

    if ($updatequery->execute()) {
        echo '
        <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Updated!</strong> Thread is updated
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        ';
    } else {
        echo 'Update failed';
    }

    $updatequery->close();
}

?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
          crossorigin="anonymous">

    <title>Update</title>
</head>
<body>
<div class="container">
    <form method="post" action="">
        <div class="form-group">
            <label for="updatetitle">Update Title</label>
            <input type="text" class="form-control" id="updatetitle" name="updatetitle"
                   aria-describedby="emailHelp" placeholder="Enter title">
        </div>
        <div class="form-group">
            <label for="updatedesc">Update Description</label>
            <textarea class="form-control" id="updatedesc" name="updatedesc" rows="3"></textarea>
        </div>

        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
</body>
</html>