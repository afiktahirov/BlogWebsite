<?php

$user_id = $_SESSION["user_id"];

$stmt = $db->query("SELECT id, name, gender, photo, is_online, is_blocked FROM users WHERE id != $user_id AND is_blocked != 1");
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

$checkfriend = $db->query("SELECT user_id_1, user_id_2, accept_f FROM friendships WHERE (user_id_1 = $user_id OR user_id_2 = $user_id) AND accept_f = 1");
$checkfriend_result = $checkfriend->fetchAll(PDO::FETCH_ASSOC);

$ids = array();
foreach ($checkfriend_result as $row) {
    $friend_id = ($row['user_id_1'] != $user_id) ? $row['user_id_1'] : $row['user_id_2'];
    $ids[] = $friend_id;
}

$inClause = implode(",", $ids);

$users = array();
if (!empty($ids)) {
    $getUsers = $db->prepare("SELECT id, name, photo FROM users WHERE id IN ($inClause)");
    $getUsers->execute();
  
    $users = $getUsers->fetchAll(PDO::FETCH_ASSOC);
}






$checkfriend_f = $db->query("SELECT user_id_1, user_id_2, accept_f FROM friendships WHERE (user_id_1 = $user_id OR user_id_2 = $user_id) AND accept_f = 0");

$checkfriend_f->execute();

$checkfriend_f_result = $checkfriend_f->fetchAll(PDO::FETCH_ASSOC);

$users = [];


$ids_f = array_column($checkfriend_f_result, 'user_id_1', 'user_id_2');
$ids_f = array_merge(array_keys($ids_f), array_values($ids_f));
$ids_f = array_unique($ids_f);

$index = array_search($user_id, $ids_f);


if ($index !== false) {
    unset($ids_f[$index]);
}

$inClause_f = implode(",", $ids_f);


$users_f[] = $inClause_f;

// var_dump($users_f);

?>



<!-- on hisse -->
<div class="menu-secondary">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="secondary-menu-wrapper secondary-menu-2 bg-white">
                    <div class="page-title-inner">
                        <h4 class="page-title">İstifadəçilər(<?=count($result)?>)</h4>
                    </div>
                    <div class="filter-menu">
                        <button class="active" data-filter="*">Bütün</button>
                        <button data-filter=".relative" class="">Dostun olmayan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- on hissenin sonu -->


<div class="friends-section mt-20">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="content-box friends-zone">
                                <div class="row mt--20 friends-list" style="position: relative; height: 1150px;">
                                <!-- istifadec -->
                                <?php $counter = 0; ?>
                           <?php foreach ($result as $user): ?>
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
                                              <?php if(in_array($user["id"], $ids)): ?>
                                                    <h6 class="btn">
                                                        <i class="bi bi-person-fill"></i> 
                                                    </h6>
                                                <?php elseif(in_array($user["id"], $ids_f)): ?> 
                                                    <p> Dostluq göndərilib</p> 
                                                <?php else: ?>
                                                    <button class="btn btn-primary add-frnd" data-s_id=<?=$user_id?> data-userid="<?=$user["id"]?>">
                                                        <i class="bi bi-person-plus-fill"></i> 
                                                        Dostluk Gönder
                                                    </button>
                                                <?php endif; ?>
                                          </div>
                                      </div>
                                  </div>
                               <?php $counter++; ?>
                            <?php endforeach; ?>
                                 <!-- istfiadec olan hissenin sonu     -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>

<script src="assets/js/app.js"></script>