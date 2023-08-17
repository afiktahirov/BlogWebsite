<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbName = "social";
$db = new PDO("mysql:host=$servername;dbname=$dbName", $username, $password);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$result_array = [];
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $id = $_POST["post_id"];
  $check_comment = $db->prepare("SELECT * FROM comment WHERE post_id = ?");
  $check_comment->execute([$id]);
  $result_array = $check_comment->fetchAll(PDO::FETCH_ASSOC);
  foreach($result_array as &$item){
    $ownersql = $db->prepare("SELECT name,photo,username FROM users WHERE id = ? LIMIT 1");
    $ownersql->execute([$item["user_id"]]);
    $owner = $ownersql->fetch(PDO::FETCH_ASSOC);
    $item["user"] = $owner;
  }
}
$response = json_encode($result_array);
header('Content-Type: application/json');
echo $response;
?>



