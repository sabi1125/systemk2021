<?php
require_once(__DIR__ . '/../libs/init.php');
require_once(__DIR__ . '/../controllers/searchController.php');
session_start();


$search = new SearchLogic();

$template_filename = 'search.twig';
$context = [];
$errors = [];

if(!isset($_SESSION["username"])){
    header("location:index.php");
}

//search by name


//users current user is following
$listOfFollowingUsers = $search->peopleUserIsFollowing();
$context["users"] = $listOfFollowingUsers;
$context["count"] = count($context["users"]);






//users following current user
$listOfUsersFollowingYou = $search->peopleFollowingUser();
$context["followers"] = $listOfUsersFollowingYou;
$context["followersCount"] = count($context["followers"]);;


if(isset($_POST["byname"])){
    $checkIfFilled = $search->checkEmpty($_POST);
    if(!$checkIfFilled){
        array_push($errors, "You cannot search blank");
        $context["errors"] = $errors;
    }else{
        $searchResults = $search->searchByName($_POST);
        if((count($searchResults)) <= 0 ){
            array_push($errors, "There are no results that match this search");
            $context["errors"] = $errors;
        }else{
            $context["profiles"] = $searchResults;
        }
    }
    
}







//search by date

if(isset($_POST["bydate"])){
    $checkIfFilled = $search->checkEmpty($_POST);
    if(!$checkIfFilled){
        array_push($errors, "You have to set a date to search by date");
        $context["errors"] = $errors;
    }else{
        $checkIfValidDate = $search->checkIfValidDate($_POST);
        if(!$checkIfValidDate){
            array_push($errors, "please enter a valid date");
            $context["errors"] = $errors;
        }else{
            $profilesByDate = $search->searchByDate($_POST);
            $context["profiles"]=$profilesByDate;
        }
    }
}




$context["currentProfilePic"] = $_SESSION["profilePic"];
$context["currentUsername"] = $_SESSION["username"];

require_once(BASEPATH . '/libs/fin.php');