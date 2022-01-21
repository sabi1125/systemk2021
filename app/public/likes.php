<?php
require_once(__DIR__ . '/../controllers/postsController.php');

$likes = new PostsLogic();

session_start();

if(isset($_GET["id"])){
    $check =  $likes->checkIfLiked($_GET["id"]);
    $likes->like($_GET["id"]);
    $id = $_GET["id"];
    header("location:postsCounts.php?id=$id");
}