<?php
include "./db.php";

$stmt = $db->query("SELECT * FROM admins ");
$result = $stmt->fetch(PDO::FETCH_ASSOC);


?>
<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="">
            <img src="http://localhost/social%20M/control/assets/images/logo-ct.png" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-1 font-weight-bold text-white">İdarəetmə paneli</span>
        </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto h-auto"  style="overflow-x: hidden;" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item mb-2 mt-0">
                <a data-bs-toggle="collapse" href="#ProfileNav" class="nav-link text-white" aria-controls="ProfileNav" role="button" aria-expanded="false">
                    <i class="material-icons-round opacity-10">person_pin</i>
                    <span class="nav-link-text ms-2 ps-1"><?=$result["name"]?></span>
                </a>
                <div class="collapse" id="ProfileNav" style>
                    <ul class="nav ">
                        <li class="nav-item">
                            <a class="nav-link text-white" href="../../../pages/authentication/signin/basic.html">
                                <span class="sidenav-mini-icon"> L </span>
                                <span class="sidenav-normal  ms-3  ps-1"> Logout </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <hr class="horizontal light mt-0">
            <li class="nav-item">
                 <a class="nav-link" href="<?=$siteUrl?>/control/">
                           <i class="material-icons-round" style="font-size: 25px; line-height: 30px; width: 20px;">home</i>
                           <span class="nav-link-text ms-2 ps-1" style="margin-left: -5px;">Ana Səhifə</span>
                 </a>
           </li>
            <!-- <li class="nav-item">
                <a data-bs-toggle="collapse" href="#dashboardsExamples" class="nav-link text-white" aria-controls="dashboardsExamples" role="button" aria-expanded="false">
                    <i class="material-icons-round opacity-10">home</i>
                    <span class="nav-link-text ms-2 ps-1">Ana Səhifə</span>
                </a>
                <div class="collapse " id="dashboardsExamples">
                    <ul class="nav">
                        <li class="nav-item ">
                            <a class="nav-link" href="http://localhost/social%20M//control/">
                                <span class="sidenav-mini-icon">S</span>
                                <span class="sidenav-normal  ms-2  ps-1">Slider</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li> -->
            <li class="nav-item">
                 <a class="nav-link" href="<?=$siteUrl?>/control/index.php?users">
                           <i class="material-icons-round" style="font-size: 25px; line-height: 30px; width: 20px;">person_rounded</i>
                           <span class="nav-link-text ms-2 ps-1" style="margin-left: -5px;">Bütün İstifadəçilər</span>
                 </a>
           </li>
           <li class="nav-item">
                 <a class="nav-link" href="<?=$siteUrl?>/control/index.php?blocked_users">
                           <i class="material-icons-round" style="font-size: 25px; line-height: 20px; width: 20px;">block</i>
                           <span class="nav-link-text ms-2 ps-1" style="margin-left: -5px;">Bloklanan İstifadəçilər</span>
                 </a>
           </li>

            <li class="nav-item">
                <a class="nav-link" href="<?=$siteUrl?>/control/index.php?showPosts">
                    <i class="material-icons-round" style="font-size: 25px; line-height: 20px; width: 20px;">schedule_send</i>
                    <span class="nav-link-text ms-2 ps-1">Göndərilən Paylaşımlar</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?=$siteUrl?>/control/index.php?activePosts">
                    <i class="material-icons-round" style="font-size: 25px; line-height: 20px; width: 20px;">send</i>
                    <span class="nav-link-text ms-2 ps-1">Aktiv olan Paylaşımlar</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?=$siteUrl?>/control/index.php?blockedPosts">
                    <i class="material-icons-round" style="font-size: 25px; line-height: 20px; width: 20px;">cancel_schedule_send</i>
                    <span class="nav-link-text ms-2 ps-1">Bloklanan Paylaşımlar</span>
                </a>
            </li>
        </ul>
    </div>
</aside>
<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <nav class="navbar navbar-main navbar-expand-lg position-sticky mt-4 top-1 px-0 mx-4 shadow-none border-radius-xl z-index-sticky" id="navbarBlur" data-scroll="true">
        <div class="container-fluid py-1 px-3">
            <div class="sidenav-toggler sidenav-toggler-inner d-xl-block d-none ">
                <a href="javascript:;" class="nav-link text-body p-0">
                    <div class="sidenav-toggler-inner">
                        <i class="sidenav-toggler-line"></i>
                        <i class="sidenav-toggler-line"></i>
                        <i class="sidenav-toggler-line"></i>
                    </div>
                </a>
            </div>
            <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                <ul class="ms-md-auto navbar-nav  justify-content-end">
                    <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                        <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                            <div class="sidenav-toggler-inner">
                                <i class="sidenav-toggler-line"></i>
                                <i class="sidenav-toggler-line"></i>
                                <i class="sidenav-toggler-line"></i>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>