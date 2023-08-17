<?php
$servername = '192.168.1.8';
$username = 'root';
$password = '';
$dbName = 'social';
$db = new PDO("mysql:host=$servername;dbname=$dbName", $username, $password);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_POST['user_id'];
    $select = $_POST['select_id'];

    $stmt = $db->prepare('INSERT INTO friendships (user_id_1, user_id_2) VALUES (?, ?)');
    $stmt->execute([$userId, $select]);

    $response = ['success' => true, 'message' => 'Data bazaya yazildi.'];
    echo json_encode($response);
}
?>
