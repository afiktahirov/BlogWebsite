<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbName = "social";
$db = new PDO("mysql:host=$servername;dbname=$dbName", $username, $password);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $accepter = $_POST["accepter"];
    $sender = $_POST["sender"];
    
    $updateStmt = $db->prepare("UPDATE friendships SET accept_f = 1 WHERE user_id_2 = :sender AND user_id_1 = :accepter");
    $updateStmt->execute([':sender' => $sender, ':accepter' => $accepter]);
    
    $updateStmt1 = $db->prepare("UPDATE friendships SET accept_f = 1 WHERE user_id_1 = :sender AND user_id_2 = :accepter");
    $updateStmt1->execute([':sender' => $sender, ':accepter' => $accepter]);

}
?>
