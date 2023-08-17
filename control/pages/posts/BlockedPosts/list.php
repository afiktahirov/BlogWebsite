<?php

$showPosts = $db->prepare("SELECT
users.is_blocked,
users.id as user_id,
users.username,
users.name,
users.photo,
users.is_online,
user_posts.title,
user_posts.text,
user_posts.id as post_id,
post_liked.liked_user_id,
user_posts.accept,
IFNULL((
    SELECT COUNT(*) 
    FROM post_liked 
    WHERE post_liked.post_id = user_posts.id
), 0) AS likes_count,
GROUP_CONCAT(post_photos.tmp_name) AS photo_tmp_names
FROM
    users
JOIN user_posts ON users.id = user_posts.user_id
JOIN post_photos ON user_posts.id = post_photos.post_id
LEFT JOIN post_liked ON post_liked.post_id = user_posts.id
WHERE
user_posts.accept = 2
AND
users.is_blocked = 0

GROUP BY
    users.id,
    user_posts.id;");

$showPosts->execute();

$result= $showPosts->fetchAll(PDO::FETCH_ASSOC);








?>

<style>
    .post-thumb{
        display:flex;
        gap:10px;
    }
    .btn{
        
        width:250px;
        height:40px;
        color:white;
    }
    .buttons{
        display:flex;
        justify-content:center;
        align-items:center;
        gap:15px;
    }
</style>

<?php if(count($result)<1):?>
    <div class="card">
        <p><b>Hal-hazırda bloklanan paylaşım yoxdur.</b></p>
    </div>
<?php endif;?>    
<?php foreach($result as $data):?>

    <?php 
       $img = explode(",",$data["photo_tmp_names"]);
    ?>

<div class="card" >
            <!-- post title start -->
            <div class="post-title d-flex align-items-center">
              <!-- profile picture end -->
              <div class="profile-thumb">
                 <a href="#">
                   <figure class="profile-thumb-middle">
                     <img
                       src="http://localhost/social%20M/<?=$data["photo"]?>"
                       alt="profile picture"
                     />
                   </figure>
                 </a>
               </div>
              <!-- profile picture end -->

               <div class="posted-author">
                  <h6 class="author"><a href="profile.html"><?=$data["name"]?></a></h6>
                  <span class="post-time"><?=$data["title"]?></span>
               </div>

            </div>
            <!-- post title start -->
            <div class="post-content">
              <p class="post-desc">
                <?=$data["text"]?>
              </p>
      <?php if(strlen($img[0])>16):?>  
              <div class="post-thumb-gallery img-gallery">
                 <div class="row g-0">
                   <div class="col-12 row-12">
                       <figure class="post-thumb" style="width: 200px;">
                       <?php foreach($img  as $i):?>
                           <img src="http://localhost/social%20M/post_images/<?= $i ?>" alt="post image">
                         <?php endforeach;?>  
                       </figure>
                  </div>
               </div>
        <?php for($i=0; $i<count($img); $i++) : ?>
        <div class="col-4">
            <div class="row">
                <?php for ($i = 1; $i < count($img); $i++) : ?>
                    <div class="col-12">
                        <figure class="post-thumb">
                            <a class="gallery-selector" href="./post_images/<?= $img[$i] ?>">
                                <img src="./post_images/<?= $img[$i] ?>" alt="post image" style="display: none;">
                            </a>
                        </figure>
                    </div>
                <?php endfor; ?>
            </div>
        </div>
           <?php endfor; ?>
       </div>
    <?php endif;?>
            </div>
            <div class="buttons">
            <a href="http://localhost/social%20M//control/pages/posts/PostOptions/accept.php?post_id=<?=$data["post_id"]?>" class='btn btn-info' style="color:white">Paylaşıma icazə ver</a>
            <a href="http://localhost/social%20M//control/pages/posts/PostOptions/accept.php?deletePost_id=<?=$data["post_id"]?>" class='btn btn-danger' style="color:white">Paylaşımı sil</a>
            <a href="http://localhost/social%20M//control/pages/posts/PostOptions/accept.php?block_user=<?=$data["user_id"]?>" class='btn btn-warning' style="color:white">İstifadəçini blokla</a>
            </div>
</div>
<?php endforeach;?>
