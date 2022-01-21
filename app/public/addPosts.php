<?php
require_once(__DIR__ . '/../libs/init.php');
require_once(__DIR__ . '/../controllers/postsController.php');

session_start();

$post = new PostsLogic();

$template_filename = 'addPosts.twig';
$context = [];
$errors = [];


if(!isset($_SESSION["username"])){
    header("location:index.php");
}

if(isset($_POST["submit"])){
    $checkIfFilled = $post->checkEmpty($_POST);
    if(!$checkIfFilled) {
        array_push($errors, "You have to add a post / you cannot just post an image without a post");
        $context["errors"] = $errors;
    }else{
        $post->insertPost($_POST);
    }

}




$context["currentProfilePic"] = $_SESSION["profilePic"];
$context["currentUsername"] = $_SESSION["username"];
require_once(BASEPATH . '/libs/fin.php');