<?php
session_start();
require 'FavListHandler.php';
if ($_SERVER['REQUEST_METHOD']==='POST') {
    if (empty($_SESSION['id']) || empty($_POST['car_id']) || empty($_POST['action']) || empty($_POST['url'])) {
        header('Location: top.php');
    } else {
        if ($_POST['action']=='add') {
            addFavItem($_SESSION['id'],$_POST['car_id']);
            echo '<script>window.location.href = "'. $_POST['url'].'";</script>';
        }elseif ($_POST['action']=='del') {
            delFavItem($_SESSION['id'],$_POST['car_id']);
            echo '<script>window.location.href = "'. $_POST['url'].'";</script>';
        }
    }
} else {
    header('Location: top.php');
}
?>
