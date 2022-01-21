<?php

include "db.php";

class SearchLogic extends db {    
    public function checkEmpty($data) {
        foreach($data as $key => $value){
            if($value === ""){
                return false;
            }
        }
        return true;
    }

    public function checkIfValidDate($data){
        $startDate = intval(strtok($data["startDate"] , "-"));
        $endDate = intval(strtok($data["endDate"] , "-"));
        $now = date("Y");
        if(($startDate > $endDate) || ($startDate < 1500 && $startDate > $now ) ||  ($endDate > $now || $endDate < 1500) || ($data["startDate"] === $data["endDate"]) ){
            return false;
        }
        return true;
    
    }
    public function searchByName($data){
        $result = [];
        $listOfUsernames=[];
        $profilePics=[];
        $sql = "SELECT users.id,users.username,profiles.profilePic FROM users INNER JOIN profiles on users.id = profiles.u_id WHERE username LIKE :username AND users.id != :id";
        $stmt = $this->connect()->prepare($sql);
        $objects = [
            ":username" => "%" . $data['name'] . "%",
            ":id" => $_SESSION["id"]
            ];
        $stmt->execute($objects);
        $fetchProfiles = $stmt->fetchAll();
        foreach($fetchProfiles as $values){
            $result[$values["username"]] = $values["profilePic"];
        }
        return $result;
    }

    public function searchByDate($data){
        $sql = "SELECT users.id,users.username,profiles.profilePic FROM users INNER JOIN profiles ON users.id = profiles.u_id WHERE birthday BETWEEN :startDate AND :endDate AND users.id != :id";
        $stmt = $this->connect()->prepare($sql);
        $objects= [
            ":startDate" => $data["startDate"],
            ":endDate" => $data["endDate"],
            ":id" => $_SESSION["id"]
        ];
        $stmt->execute($objects);
        $fetchProfiles = $stmt->fetchAll();
        foreach($fetchProfiles as $values){
            $result[$values["username"]] = $values["profilePic"];
        }
        return $result;
    }

    public function peopleUserIsFollowing(){
        $followedUsers = [];
        $sql = "SELECT users.username FROM users JOIN followers ON users.id = followers.following WHERE followers.following != :id AND followers.follower = :id ORDER BY users.id DESC";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([":id" => $_SESSION["id"]]);
        $result = $stmt->fetchAll();
        foreach($result as $value){
            array_push($followedUsers, $value["username"]);
        }
        return $followedUsers;
    }

    public function peopleFollowingUser(){
        $followedUsers = [];
        $sql = "SELECT users.username FROM users JOIN followers ON users.id = followers.follower  WHERE followers.following = :id AND followers.follower != :id ORDER BY users.id DESC";
        $stmt = $this->connect()->prepare($sql);
        $options = [
            ":id" => $_SESSION["id"]
        ];
        $stmt->execute($options);
        $result = $stmt->fetchAll();
        foreach($result as $value){
            array_push($followedUsers, $value["username"]);
        }
        return $followedUsers;
    
    }
}