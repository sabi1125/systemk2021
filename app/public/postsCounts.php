<?php
require_once(__DIR__ . '/../libs/init.php');
require_once(__DIR__ . '/../controllers/postsController.php');


$detail = new PostsLogic();


session_start();

$template_filename = 'postCount.twig';
$context = [];
$errors = [];

$post = $detail->postById($_GET["id"]);
$ifLiked = $detail->checkIfLiked($_GET["id"]);
$id = $_GET["id"];

$comments = $detail->getComments($id);



if(isset($_POST["submit"])){
    $comment["comment"] = $_POST["comment"];
    $checkIfFilled = $detail->normalEmptyCheck($comment);

    if(!$checkIfFilled){
        array_push($errors, "You cant submit blank");
        $context["errors"] = $errors;
    }else{
        $data["postId"] = $_GET["id"];
        $data["comment"] = $_POST["comment"];
        $data["poster"] = $_SESSION["id"];
        $detail->createComments($data);
        header("Location:postsCounts.php?id=$id");
    }
}

$context["comments"] = $comments;
$context["id"] = $_GET["id"];
$context["post"] = $post["post"];
$context["image"] = $post["image"];
$context["liked"] = $ifLiked;
$context["currentProfilePic"] = $_SESSION["profilePic"];
$context["currentUsername"] = $_SESSION["username"];

require_once(BASEPATH . '/libs/fin.php');