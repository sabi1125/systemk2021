<?php

require_once(__DIR__ . '/../controllers/postsController.php');

session_start();
$seed = new PostsLogic();
for($i = 0; $i < 10; $i++){
    $data["u_id"] = 2;
    $data["post"] = "test post test post test post test post test posttest post test post test post test post test post test post test post test post";
    $data["image"] = null;
    $seed->insertPost($data);
}