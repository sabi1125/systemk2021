<?php
require_once(__DIR__ . '/../libs/init.php');
require_once(__DIR__ . '/../controllers/profileController.php');
session_start();

$profile = new ProfileLogic();


$template_filename = 'editProfile.twig';
$context = [];
$errors = [];
$data = [];


if(isset($_POST["submit"])){
    $checkIfFilled = $profile->checkEmpty($_POST);
    if(!$checkIfFilled){
        array_push($errors, "You cant submit blank");
        $context["errors"] = $errors;
    }else{
        $data["bio"] = $_POST["bio"];
        $data["uid"] = $_SESSION["id"];
        $insert = $profile-> insert($data);
        if($insert){
            header("location:profile.php");
        }
    }
}




$context["currentProfilePic"] = $_SESSION["profilePic"];
$context["currentUsername"] = $_SESSION["username"];
require_once(BASEPATH . '/libs/fin.php');