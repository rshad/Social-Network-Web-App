<?php
/**
 * Created by PhpStorm.
 * User: Rshad
 * Date: 05/05/2017
 * Time: 17:10
 */
$data = array(
    "name" => "",
    "first_name" => "",
    "last_name" => "",
    "email" => "",
    "password"=> ""
);
include('../../Tables/users_table/Users.php');

$user_object = new Users($data);
$hashed_password =  password_hash($_REQUEST["passwordPut"], PASSWORD_DEFAULT);
echo $hashed_password;

$user_object->InsertUserData($_REQUEST["firstname"],$_REQUEST["firstname"],$_REQUEST["lastname"],$_REQUEST["email"],$hashed_password);

?>