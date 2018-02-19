<?php

/**
 * Created by PhpStorm.
 * User: Rshad
 * Date: 24/05/2017
 * Time: 14:12
 */
//include "C:/Users/Rshad/WebstormProjects/redsocial/php/mainFiles/dataObject_class.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/php/mainFiles/dataObject_class.php";

class POSTS extends dataObject_class {
    protected $data_post = array(
        "userName" => "",
        "postTitle" => "",
        "postText" => ""
    );

    public function __dataArray ($data)
    {
        parent::__dataArray($data);
    }

    public function insertPost($postOwner , $post_Title , $postText ){

        $connection = parent::conect();
        $sql =  "INSERT INTO posts (userName , postTitle , postText) 
                 VALUES( :postOwner , :postTitle , :postText  )";
        try {
            $st = $connection->prepare( $sql );

            $st->bindValue( ":postOwner", $postOwner, PDO::PARAM_STR );
            $st->bindValue( ":postTitle", $post_Title, PDO::PARAM_STR );
            $st->bindValue( ":postText", $postText, PDO::PARAM_STR );

            $st->execute();

            parent::disconnect( $connection );
            header('Location: ../../Pages/active.php');

        } catch ( PDOException $e ) {
            parent::disconnect( $connection );
            die( "Error Query: " . $e->getMessage() );
        }

    }
    public function GetPostList($owner_id , $ActivePage){
        include_once $_SERVER['DOCUMENT_ROOT'] . "/php/Tables/users_table/Users.php";
        $connection = parent::conect();

        $user = new Users();
        $user_name = $_SESSION["OwnerUserName"];
        $user_id_session_owner = $user->Get_Owner_ID($_SESSION['OwnerUserName']);
        $user_name_not_session_owner = $user->Get_Owner_NAME($owner_id);
        if($ActivePage == false) {
            if ($owner_id == $user_id_session_owner) {
                $post_list_sql = "select * from posts where userName <> '$user_name'  ";
            } else {
                $post_list_sql = "select * from posts where userName = '$user_name_not_session_owner' ";
            }
        }
        else{
            $post_list_sql = "select * from posts where userName = '$user_name' ";
        }

        $post_list_sql_result = mysqli_query($GLOBALS['db'], $post_list_sql);

        if (!$post_list_sql_result) {
            die('Query failed: ' . mysql_error());
        }
        parent::disconnect($connection);
        return $post_list_sql_result;

    }
    public function GetPostList_DescBox($owner_id){
        include_once $_SERVER['DOCUMENT_ROOT'] . "/php/Tables/users_table/Users.php";

        $connection = parent::conect();

        $user = new Users();
        $user_name = $user->Get_Owner_NAME($owner_id);
        $post_list_sql = "select * from posts where userName = '$user_name' ";

        $post_list_sql_result = mysqli_query($GLOBALS['db'], $post_list_sql);

        if (!$post_list_sql_result) {
            die('Query failed: ' . mysql_error());
        }
        parent::disconnect($connection);
        return $post_list_sql_result;

    }
    public function Get_POST_BY_ID($post_ID){
        $connection = parent::conect();

        $post_sql = "select * from posts where postID = '$post_ID' ";
        $post_sql_result = mysqli_query($GLOBALS['db'], $post_sql);

        if (!$post_sql_result) {
            die('Query failed: ' . mysql_error());
        }
        parent::disconnect($connection);
        return $post_sql_result;
    }
}