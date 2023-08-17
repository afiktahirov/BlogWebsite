<?php

$check_top = $db->query("SELECT
user_posts.id AS post_id,
user_posts.title,
user_posts.text,
users.photo AS user_photo,
users.name AS user_name,
IFNULL((
    SELECT COUNT(*) 
    FROM post_liked 
    WHERE post_liked.post_id = user_posts.id
), 0) AS likes_count
FROM
users
JOIN user_posts ON users.id = user_posts.user_id
JOIN post_photos ON user_posts.id = post_photos.post_id
LEFT JOIN post_liked ON post_liked.post_id = user_posts.id
GROUP BY
user_posts.id
HAVING
likes_count >= 5;");

$result_check = $check_top->fetchAll(PDO::FETCH_ASSOC);




?>

<style>
.unorder-list {
  display: flex;
  align-items: center;
}

.unorder-list-info {
  flex-grow: 1;
}

.heart-icon-container {
  margin-left: auto;
}

</style>


<div class="card widget-item">
              <h4 class="widget-title">Ən çox bəyənilənlər</h4>
              <div class="widget-body">
                <ul class="like-page-list-wrapper">

                 <?php foreach($result_check as $toplike):?>
                  <li class="unorder-list">
                    <!-- profile picture end -->
                    <div class="profile-thumb">
                      <a href="#">
                        <figure class="profile-thumb-small">
                          <img
                            src="<?=$toplike["user_photo"]?>"
                            alt="profile picture"
                          />
                        </figure>
                      </a>
                    </div>
                    <!-- profile picture end -->
                    <div class="unorder-list-info">
                       <h3 class="list-title">
                         <a href="#"><?=$toplike["user_name"]?></a>
                       </h3>
                       <p class="list-subtitle"><a href="#"><?=$toplike["title"]?></a></p>
                     </div>
                     <div class="heart-icon-container">
                        <span><?=$toplike["likes_count"]?></span>
                       <i class="bi-heart-fill" style="color:red"></i>
                     </div>
                  </li>
                 <?php endforeach;?>
                </ul>
              </div>
            </div>