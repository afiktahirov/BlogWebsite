<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbName = "social";
$db = new PDO("mysql:host=$servername;dbname=$dbName", $username, $password);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  session_start();
  $id = $_POST["post_id"];
  $comment= $_POST["comment"];
  $user_id = $_SESSION['user_id'];

  $add_comment = $db->prepare("INSERT INTO comment (user_id, comment,post_id) VALUES (?,?,?)");
  $add_comment->execute([$user_id, $comment,$id]);
  $response = ["success"=>true];
  header('Content-Type: application/json');

  echo json_encode($response);
}


?>



