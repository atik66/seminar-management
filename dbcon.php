<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname='lms';
// Create connection
$con = new mysqli($servername, $username, $password,$dbname);

//mysqli_query($con,query:'SET CHARACTER SET utf8 ');

//mysqli_query($con,query:'SET SESSION collation_connection='utf8_general_ci'")


?>