<?php

include "db.php";

$my_id = $_SESSION["user_id"];

$stmt = $db->query("SELECT user_id_1, user_id_2, accept_f FROM friendships WHERE (user_id_1 = $my_id OR user_id_2 = $my_id) AND accept_f = 1");
$like_query = $db->query("SELECT * FROM post_liked");
$like_result = $like_query->fetchAll(PDO::FETCH_ASSOC);

$likes = [];
foreach ($like_result as $likes_result) {
  $likes[] = $likes_result;
}

$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

$users = [];

$ids = array();
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

if (!empty($inClause) && !in_array($my_id, $ids)) {
  $inClause .= ",$my_id";
}

if (!empty($inClause) && !in_array($my_id, $ids)) {
  $stmt2 = $db->prepare("SELECT
    users.is_blocked,
    users.id AS user_id,
    users.username,
    users.name,
    users.photo,
    users.is_online,
    user_posts.title,
    user_posts.user_id AS set_user_id,
    user_posts.text,
    user_posts.id AS post_id,
    user_posts.accept,
    post_liked.liked_user_id,
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
    users.id IN ($inClause)
    AND users.is_blocked = 0
    AND user_posts.accept = 1
    GROUP BY
    users.id,
    user_posts.id
    ORDER BY
    user_posts.id DESC;
  ");
   
  $stmt2->execute();
  $result2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);
} else {
  $stmt2 = $db->prepare("SELECT
    users.is_blocked,
    users.id AS user_id,
    users.username,
    users.name,
    users.photo,
    users.is_online,
    user_posts.title,
    user_posts.user_id AS set_user_id,
    user_posts.text,
    user_posts.id AS post_id,
    user_posts.accept,
    post_liked.liked_user_id,
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
    users.id = $my_id
    AND users.is_blocked = 0
    AND user_posts.accept = 1
    GROUP BY
    users.id,
    user_posts.id
    ORDER BY
    user_posts.id DESC;
  ");
   
  $stmt2->execute();
  $result2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);
}

          

$post_id = null;
?>

<?php if(count($result2)<1):?>
     <div class="card">
      <b>Paylaşım mövcud deyil!</b>
     </div>
<?php endif;?>



<style>
  
.comentdiv {
  max-height: 300px;
  overflow-y: auto;
}
</style>

<!-- post status start -->

<div id="postContainer">
<?php foreach($result2 as $data):?>
   <?php 
       $img = explode(",",$data["photo_tmp_names"]);
    ?>
 <div class="card">
            <!-- post title start -->
            <div class="post-title d-flex align-items-center">
              <!-- profile picture end -->
              <div class="profile-thumb">
                 <a href="#">
                   <figure class="profile-thumb-middle">
                     <img
                       src="<?=$data["photo"]?>"
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

                <div class="post-settings-bar">
                    <span></span>
                    <span></span>
                    <span></span>
                  <div class="post-settings arrow-shape">
                      <ul>
                      <?php if($data["set_user_id"]==$my_id):?>
                          <li><button>Redakte et</button></li>
                      <?php else:?>    
                          <li><button>Şikayət et</button></li>
                      <?php endif;?>    
                      </ul>
                  </div>
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
                   <div class="col-12">
                       <figure class="post-thumb">
                         <a class="gallery-selector" href="./post_images/<?=$img[0] ?>">
                           <img src="./post_images/<?= $img[0] ?>" alt="post image">
                         </a>
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

              <div class="post-meta">
              <button class="post-heart" id="heartIcon" data-post-id="<?=$data['post_id']?>" data-liked-id="<?=$my_id?>">
                  <i class="<?php
                           $check = false; 
                           foreach($likes as $check_user){
                              if($check_user["liked_user_id"]==$my_id && $check_user["post_id"]==$data["post_id"]){
                                $check = true;
                              }
                           }
                           if($check){
                            echo 'bi-heart-fill';
                           }
                           else{
                            echo 'bi-heart';
                           }
                  ?>" id="heartIcon_" style="color:red;font-size:20px"></i>
                  <span>
                    <?=$data["likes_count"]>0?$data["likes_count"]:0?>
                  </span>
              </button>
                <ul class="comment-share-meta">
                  <li>
                    <button class="post-comment"
                    data-setName = "<?=$my_name?>"
                    data-setPhoto = "<?=$my_photo?>"
                    data-user-id="<?=$my_id?>"
                    data-id="<?=$data["post_id"]?>"
                    data-user_name="<?=$data["name"]?>"
                    data-user_img="<?=$data["photo"]?>"
                    data-post_title="<?=$data["title"]?>"
                    data-post_text="<?=$data["text"]?>"
                    data-post_img="post_images/<?=$img[0]?>">
                      <i class="bi bi-chat-dots"></i>
                      <span></span>
                    </button>
                  </li>
                </ul>
              </div>
            </div>
 </div>

 <?php endforeach;?>
</div>


<div class="modal" id="postModal" tabindex="-1" role="dialog" aria-labelledby="postModalLabel"  aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <figure class="profile-thumb-middle">
                    <img src="" alt="profile picture" id="modalProfilePicture">
                </figure>
                <h5 class="modal-title username" id="postModalLabelUsername" style="padding-left: 10px; font-size: 1rem;"></h5>
                <button href="http://localhost/social%20M/index.php?timeline"  type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <input type="hidden" name="user_post_id" value=>
                <h5 class="modal-title" id="postModalLabelTitle" style="padding-bottom: 10px; font-size: 1.2rem;"></h5>
                <p class="post-decs" style="font-size: 0.9rem;" id="postModalText"></p>
                <img src="#" alt="post image" id="modalPostImage">
                <!-- comment div -->
               <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
                <div class="container bootdey">
                  <div class="col-md-12 bootstrap snippets">
                      <div class="panel">
                        <div class="panel-body">
                          <textarea class="form-control" rows="2" name="post_comment_text" placeholder="Paylaşım haqqında nə düşünürsüz?"></textarea>
                          <div class="mar-top clearfix">
                            <button class="btn btn-sm pull-right" name="comment_post"><i class="fa fa-pencil fa-fw"></i>Paylaş</button>
                          </div>
                        </div>
                      </div>
                  </div>
                </div>
                <!-- end comment div -->
            </div>
            <div class="modal-footer">
                <a href="" type="button" class="btn btn-secondary" id="close" data-dismiss="modal">Close</a>
            </div>
        </div>
    </div>
</div>



          <!-- post status end -->


