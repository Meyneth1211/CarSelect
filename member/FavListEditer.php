<?php
session_start();
require 'FavListHandler.php';
if ($_SERVER['REQUEST_METHOD']==='POST') {
    if (empty($_SESSION['id']) || empty($_POST['car_id']) || empty($_POST['action'])) {
        header('Location: top.php');
    } else {
        if ($_POST['action']=='add') {
            addFavItem($_SESSION['id'],$_POST['car_id']);
        }elseif ($_POST['action']=='del') {
            delFavItem($_SESSION['id'],$_POST['car_id']);
        }
    }
} else {
    header('Location: top.php');
}
?>
