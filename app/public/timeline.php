<?php
require_once(__DIR__ . '/../libs/init.php');
require_once(__DIR__ . '/../controllers/postsController.php');

$timeline = new PostsLogic();

session_start();

$template_filename = 'timeline.twig';
$context = [];
$errors = [];
$likes = [];
$totalLikes = [];
$totalComments = [];

if(!isset($_SESSION["username"])){
    header("location:index.php");
}

$countOfAllPosts = $timeline->getTotalPostsForCurrentProfile();

if(isset($_POST["limit"])){
    $userAndPost = $timeline->getFollowingPosts($_POST["limit"]);
}
else{
    $userAndPost = $timeline->getFollowingPosts(5);
}

$numOfItems = count($userAndPost);
$context["userAndPost"] = $userAndPost;


foreach($userAndPost as $value){
    $check = $timeline->checkIfLiked($value["id"]);
    $numberOfLikes = $timeline->totalLikes($value["id"]);
    $cmtsCount = $timeline->totalComments($value["id"]);
    $commentsCount = [$value["id"] => $cmtsCount];
    $likeResult = [$value["id"] => $check];
    $likesCount = [$value["id"] => count($numberOfLikes)];
    array_push($likes,$likeResult);
    array_push($totalLikes,$likesCount);
    array_push($totalComments,$commentsCount);
}



if(isset($_POST["like"])){
    $check = $timeline->checkIfLiked($_POST["postid"]);
    $timeline->like($_POST["postid"]);
    header("location:timeline.php");
}

$context["commentCount"] = $totalComments;
$context["count"]=count($userAndPost);
$context["likes"] = $likes;
$context["likesCount"] = $totalLikes;
$context["currentProfilePic"] = $_SESSION["profilePic"];
$context["currentUsername"] = $_SESSION["username"];
$context["allPostCount"] = $countOfAllPosts;


require_once(BASEPATH . '/libs/fin.php');