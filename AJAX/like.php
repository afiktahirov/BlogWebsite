<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbName = "social";
$db = new PDO("mysql:host=$servername;dbname=$dbName", $username, $password);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


$likes = 0;
$like =0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $post_id = $_POST['post_id'];
    $liked = $_POST['liked'] === 'true';
    $likedId = $_POST["likedId"];

    
    $response = array('success' => true);
    if ($liked) {
        $response['likes'] = $likes + 1; 
        $response['liked'] = true;
    } else {
        $response['likes'] = $likes - 1;
        $response['liked'] = false;
    }
    
    if($liked){
        $like+=1;
    }
    else{
        $like-=1;
    }


    $stmt = $db->prepare("SELECT liked_user_id,post_id FROM post_liked WHERE liked_user_id =? AND post_id=?");
    $stmt->execute([$likedId,$post_id]);
    $existinglike = $stmt->fetch(PDO::FETCH_ASSOC);
    if(!$existinglike){
        $post_likedID = $db->prepare("INSERT INTO post_liked (liked_user_id,post_id) VALUES(?,?)");
        $post_likedID->execute([$likedId,$post_id]);
    
    }
    else{
        $deleteStmt = $db->prepare("DELETE FROM post_liked WHERE liked_user_id = ? AND post_id = ?");
        $deleteStmt->execute([$existinglike["liked_user_id"],$post_id]);
    }
    
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>
