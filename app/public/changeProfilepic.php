<?php
require_once(__DIR__ . '/../libs/init.php');
require_once(__DIR__ . '/../controllers/profileController.php');

session_start();


$profile = new ProfileLogic();

$template_filename = 'changeProfilepic.twig';
$context = [];
if(!isset($_SESSION["username"])){
    header("location:index.php");
}

if(isset($_POST["submit"])){
    $data= [];
    $data["image_base64"] = $_POST["image_base64"];
    $data["uid"] = $_SESSION["id"];
    $profile->upsertProfilePicture($data);
    header("location:profile.php");
}






$context["currentProfilePic"] = $_SESSION["profilePic"];
$context["currentUsername"] = $_SESSION["username"];
require_once(BASEPATH . '/libs/fin.php');