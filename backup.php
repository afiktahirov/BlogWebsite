
<!-- profilde doslarin ve ozunun postu gorunecek -->
<?php

include "db.php";

$my_id = $_SESSION["user_id"];

$stmt = $db->query("SELECT user_id_1, user_id_2, accept_f FROM friendships WHERE (user_id_1 = $my_id OR user_id_2 = $my_id) AND accept_f = 1");

$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

$users = [];

$ids = array_column($result, 'user_id_1', 'user_id_2');
$ids = array_merge(array_keys($ids), array_values($ids));
$ids = array_unique($ids);

$inClause = implode(",", $ids);

var_dump($inClause);


$stmt2 = $db->prepare("SELECT 
    users.id,
    users.username,
    users.name,
    users.photo,
    users.is_online,
    users.is_blocked,
    user_posts.title,
    user_posts.text,
    user_posts.id,
    GROUP_CONCAT(post_photos.tmp_name) AS photo_tmp_names
FROM
    users
JOIN user_posts ON users.id = user_posts.user_id
JOIN post_photos ON user_posts.id = post_photos.post_id
WHERE
    users.id IN ($inClause)
GROUP BY
    users.id,
    user_posts.id");

$stmt2->execute();
$result2 = $stmt2->fetchAll(PDO::FETCH_ASSOC); ?>


<!-- burda ise butun postlar gorunecek -->

<?php 

include "db.php";

$stmt = $db->query("SELECT 
users.id,
users.username,
users.name,
users.photo,
users.is_online,
users.is_blocked,
user_posts.title,
user_posts.text,
user_posts.id,
GROUP_CONCAT(post_photos.tmp_name) AS photo_tmp_names
FROM
users
JOIN user_posts ON users.id = user_posts.user_id
JOIN post_photos ON user_posts.id = post_photos.post_id
GROUP BY
users.id,
user_posts.id;");

$result = $stmt->fetchAll(PDO::FETCH_ASSOC);



?>


<div class="panel">
                      <div class="panel-body" style="max-height: 400px; overflow-y: auto;">
                        <!-- Newsfeed Content -->
                        <!--===================================================-->
                
                		       <div class="media-block">
                                  <a class="media-left" href="#"><img class="img-circle img-sm" alt="Profile Picture" src="https://bootdey.com/img/Content/avatar/avatar3.png"></a>
                                         <div class="media-body">
                                               <div class="mar-btm">
                                                  <a href="#" class="btn-link text-semibold media-heading box-inline">Lucy Moon</a>
                                                  <p class="text-muted text-sm"><i class="fa fa-globe fa-lg"></i> - From Web - 2 min ago</p>
                                               </div>
                                               <p>Duis autem vel eum iriure dolor in hendrerit in vulputate ?</p>
                                              <div class="pad-ver">
                                               <div class="btn-group">
                                                 <a class="btn btn-sm btn-default btn-hover-success" href="#"><i class="fa fa-thumbs-up"></i></a>
                                                 <a class="btn btn-sm btn-default btn-hover-danger" href="#"><i class="fa fa-thumbs-down"></i></a>
                                                </div>
                                              <a class="btn btn-sm btn-default btn-hover-primary" href="#">Comment</a>
                                              </div>
                                              <hr>
                		       		         <!-- buraya bu  reye olunan rey gelecek -->
                		       			 
                                         </div>
                            </div>
                        <!--===================================================-->
                        <!-- End Newsfeed Content -->
                      </div>
                    </div>