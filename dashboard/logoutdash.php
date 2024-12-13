<?php 

include "../conn123.php";

session_start();
session_destroy();

header("location:../login.php");



 ?>