<?php
/**
 * Created by PhpStorm.
 * User: Rshad
 * Date: 24/05/2017
 * Time: 14:32
 */
session_start();
include('../../Tables/posts_table/POSTS.php');


$post_Owner = $_SESSION['OwnerUserName'];
$post_Title = $_REQUEST['postTitle'];
$post_Text = $_REQUEST['postText'];

$post = new POSTS();
$post->insertPost($post_Owner,$post_Title,$post_Text);


