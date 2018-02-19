<?php
/**
 * Created by PhpStorm.
 * User: Rshad
 * Date: 10/05/2017
 * Time: 10:45
 */
include('../../Tables/comments_table/Comments.php');
session_start();

$user = $_SESSION['OwnerUserName'];
$text = $_REQUEST['commentText'];
$post_ID = $_SESSION['Actual_POST_ID'];

$comment_object = new Comments();
$comment_object->insertComment($user,$text,$post_ID);
