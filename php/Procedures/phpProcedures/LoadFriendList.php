<?php
/**
 * Created by PhpStorm.
 * User: Rshad
 * Date: 12/05/2017
 * Time: 18:53
 */
include('../../Tables/users_table/Users.php');


$user_object = new Users();
$user_object->GetFriendList();


?>