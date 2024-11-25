<?php 
require('kanrisya_session.php'); 
require_once '../DBconnect.php';

$pdo = getDb();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['delete_images']) && is_array($_POST['delete_images'])) {
        foreach ($_POST['delete_images'] as $image_id) {
            $sql = $pdo->prepare('DELETE FROM image WHERE image_id = ?');
            $sql->execute([$image_id]);
        }
    }
}

header('Location: ' . $_SERVER['HTTP_REFERER']);
exit();
