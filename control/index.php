<link rel="stylesheet" href="assets/css/material-dashboard.min.css">
<link rel="stylesheet" href="assets/css/nucleo-icons.css">
<link rel="stylesheet" href="assets/css/nucleo-svg.css">
<link rel="stylesheet" href="assets/css/style.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css"> 
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <!-- CSS
	============================================ -->
    <!-- google fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../assets/css/vendor/bootstrap.min.css">
    <!-- Icon Font CSS -->
    <link rel="stylesheet" href="../assets/css/vendor/bicon.min.css">
    <!-- Flat Icon CSS -->
    <link rel="stylesheet" href="../assets/css/vendor/flaticon.css">
    <!-- audio & video player CSS -->
    <link rel="stylesheet" href="../assets/css/plugins/plyr.css">
    <!-- Slick CSS -->
    <link rel="stylesheet" href="../assets/css/plugins/slick.min.css">
    <!-- nice-select CSS -->
    <link rel="stylesheet" href="../assets/css/plugins/nice-select.css">
    <!-- perfect scrollbar css -->
    <link rel="stylesheet" href="../assets/css/plugins/perfect-scrollbar.css">
    <!-- light gallery css -->
    <link rel="stylesheet" href="../assets/css/plugins/lightgallery.min.css">
    <!-- Main Style CSS -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <link rel="stylesheet" href="assets/css/comment.css">

    <link rel="stylesheet" href="./assets/css/main.css">


<?php
include "db.php";


session_start();

if (isset($_SESSION["user_id"])) {
   include "partials/head.php";
   include "partials/aside.php";

   if (isset($_GET["users"])) {
       include "pages/users/list.php";
   } elseif (isset($_GET["allposts"])) {
       include "pages/posts/list.php";
   } elseif (isset($_GET["blocked_users"])) {
       include "pages/blocked/list.php";
   } elseif (isset($_GET["showPosts"])) {
       include "pages/posts/list.php";
   } elseif (isset($_GET["activePosts"])) {
       include "pages/posts/ActivePosts/list.php";
   } elseif (isset($_GET["blockedPosts"])) {
       include "pages/posts/BlockedPosts/list.php";
   } else {
       include "partials/main.php";
   }
} else {
   include "pages/login.php";
}



?>



<script src="assets/js/app.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/buttons.js"></script>
<script src="assets/js/datatables.js"></script>
<script src="assets/js/dragula.min.js"></script>
<script src="assets/js/jkanban.js"></script>
<script src="assets/js/material-dashboard.min.js"></script>
<script src="assets/js/perfect-scrollbar.min.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/smooth-scrollbar.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>