<?php

$my_id = $_SESSION["user_id"];

$stmt = $db->query("SELECT user_id_1, user_id_2, accept_f FROM friendships WHERE (user_id_1 = $my_id OR user_id_2 = $my_id) AND accept_f = 1");

$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

$users = [];

$ids = [];

foreach ($result as $row) {
    $user_id_1 = $row['user_id_1'];
    $user_id_2 = $row['user_id_2'];

    if ($user_id_1 != $my_id) {
        $ids[] = $user_id_1;
    }

    if ($user_id_2 != $my_id) {
        $ids[] = $user_id_2;
    }
}

$inClause = implode(",", $ids);

$user = [];

if (!empty($result)){
    $getUsers = $db->prepare("SELECT id, name, photo FROM users WHERE id IN ($inClause)");
    $getUsers->execute();
  
    $users = $getUsers->fetchAll(PDO::FETCH_ASSOC);
}


?>
<div class="menu-secondary">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="secondary-menu-wrapper secondary-menu-2 bg-white">
                                <div class="page-title-inner">
                                    <h4 class="page-title">Dostlar(<?=count($users)?>)</h4>
                                </div>
                                <div class="filter-menu">
                                    <button class="active" data-filter="*">Hamsı</button>
                                    <button data-filter=".recently" class="">Dostluq Göndərilənlər</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="friends-section mt-20">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="content-box friends-zone">
                                <div class="row mt--20 friends-list" style="position: relative; height: 1150px;">
                                <?php $counter = 0; ?>
                                <?php foreach($users as $user):?>
                                    <?php
                                          $row = floor($counter / 4); 
                                          $column = $counter % 4;
                            
                                          $left = $column * 285; 
                                          $top = $row * 125;
                                    ?>
                                    <div class="col-lg-3 col-sm-6 recently request" style="position: absolute; left: <?=$left?>px; top: <?=$top?>px;">
                                        <div class="friend-list-view">
                                            <!-- profile picture end -->
                                            <div class="profile-thumb">
                                                <a href="#">
                                                    <figure class="profile-thumb-middle">
                                                        <img src="./<?=$user["photo"]?>" alt="profile picture">
                                                    </figure>
                                                </a>
                                            </div>
                                            <!-- profile picture end -->

                                            <div class="posted-author">
                                                <h6 class="author"><a href="profile.html"><?=$user["name"]?></a></h6>
                                            </div>
                                        </div>
                                    </div>
                                   <?php $counter++; ?> 
                                <?php endforeach;?>    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>            