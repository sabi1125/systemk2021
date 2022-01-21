<?php
require_once(__DIR__ . '/../libs/init.php');
require_once(__DIR__ . '/../controllers/signupController.php');

$signup = new SignupLogic();


$template_filename = 'signup.twig';
$context = [];
$errors = [];


if(isset($_POST["submit"])){
    $checkIfFilled = $signup->checkEmpty($_POST);
    $checkLength = $signup->lengthChecks($_POST);
    $matchPasswords = $signup->confirmPassword($_POST["password"], $_POST["confirmPassword"]);

    if(!$checkIfFilled){
        array_push($errors, "all the feilds are required to be filled");
        $context["errors"] = $errors;
    }else if($checkLength != null ){
        $context["errors"] = $checkLength;
    }else if(!$matchPasswords){
        array_push($errors, "password Doesnt match");
        $context["errors"] = $errors;
    }else{
        $insert =$signup->insert($_POST);
        if($insert !== true){
            $context["errors"] = $insert;
        }else{
            header("location:registerFin.php");
        }
    }
}



require_once(BASEPATH . '/libs/fin.php');