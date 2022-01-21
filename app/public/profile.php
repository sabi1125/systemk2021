<?php
require_once(__DIR__ . '/../libs/init.php');
require_once(__DIR__ . '/../controllers/profileController.php');

session_start();

$profile = new ProfileLogic();

$template_filename = 'profile.twig';
$context = [];

if(!isset($_SESSION["username"])){
    header("location:index.php");
}

if($_GET){
    if(isset($_GET["s"])){
    $wantedProfile = $profile->getProfileWithUsername($_GET["s"]);
    $checkIfFollowed = $profile->checkIfFollowing($_GET["s"]);
    $context["username"] = $wantedProfile["username"];
    $context["bio"] = $wantedProfile["bio"];
    $context["profilePic"] = $wantedProfile["profilePic"];
    $context["owner"] = false;
    if($checkIfFollowed){
        $context["follow"] = true;
    }else{
        $context["follow"] = false;
    }
    }if(isset($_GET["f"])){
        $username = $_GET['f'];
        $profile->followProfile($username);
        header("location:profile.php?s=$username");
    }

}else {

        $context["username"] = $_SESSION["username"];
        $context["owner"] = true;
        $data = $profile->getProfile($_SESSION["id"]);

    if($data === null){
        $context["bio"] = null;
        $context["profilePic"] = null;
        $_SESSION["profilePic"] = null;
    }else{
        $context["bio"] = $data["bio"];
        $context["profilePic"] = $data["profilePic"];
        $_SESSION["profilePic"] = $data["profilePic"];
    }
}



require_once(BASEPATH . '/libs/fin.php');