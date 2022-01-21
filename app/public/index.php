<?php
require_once(__DIR__ . '/../libs/init.php');
require_once(__DIR__ . '/../controllers/loginController.php');

if(isset($_SESSION["username"])){
    header("location:profile.php");
}



$login = new LoginLogic();
$template_filename = 'index.twig';
$context = [];
$errors = [];

if(isset($_POST["submit"])){
    $checkIfFilled = $login->checkEmpty($_POST);

    if(!$checkIfFilled){
        array_push($errors, "all the feilds are required to be filled");
        $context["errors"] = $errors;
    }else{
        $loginCheck = $login->login($_POST);
        if($loginCheck) {
            header("location:profile.php");
        }else{
            array_push($errors, "invalid username or password");
            $context["errors"] = $errors;
        }
    }
}

require_once(__DIR__ . '/../libs/fin.php');