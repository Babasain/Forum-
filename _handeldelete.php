
<?php
 include_once '_dbconnect.php';

 $delete_id=$_GET['delid'];

 $sql="DELETE FROM threads WHERE `threads`.`thread_id` = $delete_id";
 $result=$con->query($sql);
  if($result){
   // header("location: ../threadlist.php");
    echo '
    <div class="alert alert-danger" role="alert">
    Thread deleted
  </div>
    ';
    
  }else{

  }
 

?>