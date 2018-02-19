<?php
/**
 * Created by PhpStorm.
 * User: Rshad
 * Date: 06/05/2017
 * Time: 19:52
 */
   session_start();
   include('../../Tables/users_table/Users.php');

   $email = $_REQUEST["email"];
   $password = $_REQUEST["password"];

   $user_object = new Users();
   $user_object->SignInFunc($email,$password);
?>
