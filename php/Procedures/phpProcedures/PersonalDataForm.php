<?php
/**
 * Created by PhpStorm.
 * User: Rshad
 * Date: 16/06/2017
 * Time: 17:42
 */
session_start();
include('../../Tables/users_table/Users.php');
$user = new Users();


$firstname = $_REQUEST['firstname'];
$lastname = $_REQUEST['lastname'];
$email = $_REQUEST['email'];
$pass = $_REQUEST['passwordPut'];
$user_id = $user->Get_Owner_ID($_SESSION['OwnerUserName']);
$user = new Users();
$user->ChangeInfo($user_id,$firstname,$lastname,$email,$pass);