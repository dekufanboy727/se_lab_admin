<?php
    include "dbConnection.php";

    $id = $_GET['id']; // get id through query string


    if(isset($id))
    {
        $del = mysqli_query($conn,"delete from cart_temp where cart_id = '$id'"); // delete query
        mysqli_close($conn); // Close connection

        header("location:cart.php"); 
    }   





?>
