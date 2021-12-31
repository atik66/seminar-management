<?php

 require_once '../dbcon.php';



if(isset($_GET['bookdelete'])){

    
     $id=base64_decode($_GET['bookdelete']);
     mysqli_query($con,query:"DELETE FROM `book_individual` WHERE `barcode`='$id'");

     header('location:manage-book.php');


}
?>