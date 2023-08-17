<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbName = "social";
$db = new PDO("mysql:host=$servername;dbname=$dbName", $username, $password);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$siteUrl = "http://localhost/social%20M/";



if(isset($_GET["post_id"])){
    $post_id = $_GET["post_id"];
    $post_op = $db->prepare("UPDATE user_posts SET accept=1 WHERE id =$post_id");
    $post_op->execute();

}
if(isset($_GET["block_id"])){
    $block_id = $_GET["block_id"];
    $post_op = $db->prepare("UPDATE user_posts SET accept=2 WHERE id =$block_id");
    $post_op->execute();

}
if(isset($_GET["block_user"])){
    $user_id = $_GET["block_user"];
    $stmt = $db->prepare("UPDATE users SET is_blocked = 1 WHERE id = $user_id");
    $stmt->execute();
}
if(isset($_GET["deletePost_id"])){
    $post_id = $_GET["deletePost_id"];
    $stmt = $db->prepare("DELETE user_posts, post_photos, post_liked, comment
    FROM user_posts
    LEFT JOIN post_photos ON user_posts.id = post_photos.post_id
    LEFT JOIN comment ON user_posts.id = comment.post_id
    LEFT JOIN post_liked ON post_liked.post_id = user_posts.id
    WHERE user_posts.id = $post_id;");
    $stmt->execute();
}



// header("Location: http://localhost/social%20M/control/index.php?showPosts#");
header("Location: " . $_SERVER['HTTP_REFERER']);




?>