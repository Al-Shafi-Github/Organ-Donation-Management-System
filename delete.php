<?php
    $connection = mysqli_connect('localhost','root','','organdb');
    $recv = $_REQUEST['REGISTRATION_ID'];
    $query = "DELETE FROM registration WHERE REGISTRATION_ID = $recv";


    $run_delete_query = mysqli_query($connection,$query);
    if($run_delete_query){
        header("location:dashboard.php?deleted");
    }


?>

