<?php 
include "../db.php";

$user_count = $db->query("SELECT COUNT(*) FROM users");
$result_user = $user_count->fetchColumn();

$comment = $db->query("SELECT COUNT(*) FROM comment");
$result_comment = $comment->fetchColumn();

$like = $db->query("SELECT COUNT(*) FROM post_liked");
$result_like = $like->fetchColumn();

$post = $db->query("SELECT COUNT(*) FROM user_posts");
$result_post = $post->fetchColumn();






echo $result_comment;
?>

<div class="countainer_main">

        <div class="user-info box">
           <h3>İstifadəçi Sayı</h3> 
          <div class="user-profile">
          <i class="fas fa-user"></i>
          </div>
          <div class="user-details">
            <h4><?php
                  if($result_user<1){
                    echo 0;
                  }
                  else{
                    echo $result_user;
                  }
                  ?></h4>
          </div>
        </div>
        
        <!-- Gönderi Bilgisi -->
        <div class="post-info box">
        <h3>Paylaşım Sayı</h3> 
        <div class="post-info-details">
          <i class="fas fa-share"></i>
        </div>
          <h4><?php
                  if($result_post<1){
                    echo 0;
                  }
                  else{
                    echo $result_post;
                  }
                  ?></h4>
        </div>
        
        <!-- Yorum Bilgisi -->
        <div class="comment-info box">
        <h3>Ümumi Rəy Sayı</h3> 
          <div class="comment-icon">
            <i class="fas fa-comment"></i>
          </div>
          <div class="comment-details">
            <h4><?php
                  if($result_comment<1){
                    echo 0;
                  }
                  else{
                    echo $result_comment;
                  }
                  ?></h4>
          </div>
        </div>
        
        <!-- Beğeni Bilgisi -->
        <div class="like-info box">
        <h3>Bəyəni Sayı</h3> 
          <div class="like-icon">
            <i class="fas fa-thumbs-up"></i>
          </div>
          <div class="like-details">
            <h4><?php
                  if($result_like<1){
                    echo 0;
                  }
                  else{
                    echo $result_like;
                  }
                  ?></h4>
          </div>
        </div>


</div>

