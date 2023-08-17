<?php


$username = $_SESSION["username"];
$stmt = $db->prepare("SELECT * FROM users WHERE username =?");
$stmt->execute([$username]);

$result = $stmt->fetch(PDO::FETCH_ASSOC);

if($result["is_blocked"]==1){
    include "blockPage.php";
    exit;
}

$my_name =$_SESSION["my_name"] = $result["name"];
$my_photo =$_SESSION["my_photo"] = $result["photo"];

if(isset($_GET["timeline"])){
    $page = "timeline";
}
else if(isset($_GET["myposts"])){
    $page = "myposts";
}
else if(isset($_GET["friends"])){
    $page = "friends";
}
else if(isset($_GET["allusers"])){
    $page = "allusers";
}
else{
    $page = "home";
}

?>

<body>
<style>
    .uploaded-photos {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
}

.uploaded-photo {
  width: 100px;
  height: 100px;
  object-fit: cover;
  margin: 5px;
}
</style>
    <!-- header area start -->
    <header>
        <div class="header-top sticky bg-white d-none d-lg-block">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-5">
                        <!-- header top navigation start -->
                        <div class="header-top-navigation">
                            <nav>
                                <ul>
                                    <li class="<?= $page=="home"?"active":""?>"><a href="http://localhost/social%20M/">Əsas Səhifə</a></li>
                                    <li class="msg-trigger"><a class="msg-trigger-btn" href="#a">Bildirişlər</a>

                                        <div class="message-dropdown" id="a">
                                            <div class="dropdown-title">
                                                <p class="recent-msg">recent message</p>
                                                <div class="message-btn-group">
                                                    <button>New group</button>
                                                    <button>New Message</button>
                                                </div>
                                            </div>
                                            <ul class="dropdown-msg-list">
                                                <li class="msg-list-item d-flex justify-content-between">
                                                    <!-- profile picture end -->
                                                    <div class="profile-thumb">
                                                        <figure class="profile-thumb-middle">
                                                            <img src="<?$result['photo']?>" alt="profile picture">
                                                        </figure>
                                                    </div>
                                                    <!-- profile picture end -->

                                                    <!-- message content start -->
                                                    <div class="msg-content">
                                                        <h6 class="author"><a href="http://localhost/social%20M/index.php?timeline">Mili Raoulin</a></h6>
                                                        <p>Many desktop publishing packages and web page editors now use Lorem Ipsum as their default</p>
                                                    </div>
                                                    <!-- message content end -->

                                                    <!-- message time start -->
                                                    <div class="msg-time">
                                                        <p>25 Apr 2019</p>
                                                    </div>
                                                    <!-- message time end -->
                                                </li>
                                            </ul>
                                            <div class="msg-dropdown-footer">
                                                <button>See all in messenger</button>
                                                <button>Mark All as Read</button>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                        <!-- header top navigation start -->
                    </div>

                    <div class="col-md-2">
                        <!-- brand logo start -->
                        <div class="brand-logo text-center">
                            <a href="http://localhost/social%20M/">
                                <img src="assets/images/logo/logo.png" alt="brand logo">
                            </a>
                        </div>
                        <!-- brand logo end -->
                    </div>

                    <div class="col-md-5">
                        <div class="header-top-right d-flex align-items-center justify-content-end">
                            <!-- header top search start -->
                            <div class="header-top-search">
                                <form class="top-search-box">
                                    <input type="text" placeholder="Search" class="top-search-field">
                                    <button class="top-search-btn"><i class="flaticon-search"></i></button>
                                </form>
                            </div>
                            <!-- header top search end -->

                            <!-- profile picture start -->
                            <div class="profile-setting-box">
                                <div class="profile-thumb-small">
                                    <a href="javascript:void(0)" class="profile-triger">
                                        <figure>
                                            <img src="<?=$result["photo"]?>" alt="profile picture">
                                        </figure>
                                    </a>
                                    <div class="profile-dropdown">
                                        <div class="profile-head">
                                            <h5 class="name"><a href="#"><?=$result["name"]?></a></h5>
                                            <a class="mail" href="#"><?=$result["email"]?></a>
                                        </div>
                                        <div class="profile-body">
                                            <ul>
                                                <li><a href="http://localhost/social%20M/index.php?timeline"><i class="flaticon-user"></i>Profil</a></li>
                                                <li><a href="#"><i class="flaticon-message"></i>Gələnlər</a></li>
                                                <li><a href="#"><i class="flaticon-document"></i>Fəaliyyətlər</a></li>
                                            </ul>
                                            <ul>
                                                <li><a href="index.php?settings"><i class="flaticon-settings"></i>Parametrlər</a></li>
                                                <li><a href="index.php?exit"><i class="flaticon-unlock"></i>Çıxış</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- profile picture end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- header area end -->
    <div class="main-wrapper">
    <div
      class="profile-banner-large bg-img"
      data-bg="assets/images/banner/profile-banner.jpg"
    ></div>
    <div class="profile-menu-area bg-white">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-3 col-md-3">
            <div class="profile-picture-box">
              <figure class="profile-picture">
                <a href="http://localhost/social%20M/index.php?timeline">
                  <img src="<?=$result["photo"]?>" alt="profile picture"
                  class="img-fluid" style="max-width: 250px; max-height:
                  250px;">
                </a>
              </figure>
            </div>
          </div>
          <div class="col-lg-6 col-md-6 offset-lg-1">
            <div class="profile-menu-wrapper">
              <div class="main-menu-inner header-top-navigation">
                <nav>
                  <ul class="main-menu">
                    <li class="<?= $page== "timeline"?"active":""?>"><a href="http://localhost/social%20M/index.php?timeline">Səhifəm</a></li>
                    <li class="<?= $page== "myposts"?"active":""?>"><a href="http://localhost/social%20M/index.php?myposts">Paylaşımlarım</a></li>
                    <li class="<?= $page== "friends"?"active":""?>"><a href="http://localhost/social%20M/index.php?friends">Dostlar</a></li>
                    <li class="<?= $page== "allusers"?"active":""?>"><a href="http://localhost/social%20M/index.php?allusers">Bütün İstifadəçilər</a></li>
                  </ul>
                </nav>
              </div>
            </div>
          </div>
          <div class="col-lg-2 col-md-3 d-none d-md-block">
            <div class="profile-edit-panel">
              <button class="edit-btn"><a style="color:white;" href="http://localhost/social%20M/index.php?settings">Profili düzənlə</a></button>
            </div>
          </div>
        </div>
      </div>
    </div>

      

    



 