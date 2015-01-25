<?php
ob_start();
session_start();
session_destroy();
//header("Location:http://cs-server.usc.edu:9046/CSCI571HW/mainPage.php");
header("Location:http://cs-server.usc.edu:9046/CSCI571HW/CodeIgniter_2.2.0/index.php/mainPage_c");
?>