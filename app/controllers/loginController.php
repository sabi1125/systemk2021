<?php
include "db.php";
session_start();

class LoginLogic extends db {

    public function checkEmpty($data) {
        foreach($data as $key => $value){
            if($value === ""){
                return false;
            }
        }
        return true;
    }

    public function login($data){
        $sql = "select * from users where username=:username";
                $stmt=$this->connect()->prepare($sql);
                $stmt->execute(["username"=>$data["username"]]);
                $count=$stmt->rowCount();
                if($count>0){
                    $row=$stmt->fetch();
                    $hash = password_verify($data["password"],$row["password"]);
                    if($hash){
                        $_SESSION["id"]=$row["id"];
                        $_SESSION["username"]=$row["username"];

                        return true;
                    }else{

                        return false;
                    }
                }else{
                    return false;
                }

            }
        }