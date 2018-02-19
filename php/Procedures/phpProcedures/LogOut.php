<?php
/**
 * Created by PhpStorm.
 * User: Rshad
 * Date: 24/05/2017
 * Time: 2:28
 */
session_start();
include('../../Tables/users_table/Users.php');
unset($_SESSION['OwnerUserName']);  // where $_SESSION["nome"] is your own variable. if you do not have one use only this as follow **session_unset();**
header("Location: ../../Pages/index.php");