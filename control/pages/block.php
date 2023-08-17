<?php
  include "../db.php";

if(isset($_GET["blocked_id"])){
  $user_id = $_GET["blocked_id"];

  $stmt = $db->prepare("UPDATE users SET is_blocked = 1 WHERE id = $user_id");
  $stmt->execute();
}
if(isset($_GET["unblock_id"])){
  $user_id = $_GET["unblock_id"];
  $stmt = $db->prepare("UPDATE users SET is_blocked = 0 WHERE id = $user_id");
  $stmt->execute();
}  

header("Location: http://localhost/social%20M/control/index.php?users");


?>