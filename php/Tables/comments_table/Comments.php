<?php

/**
 * Created by PhpStorm.
 * User: Rshad
 * Date: 09/05/2017
 * Time: 23:27
 */
include_once $_SERVER['DOCUMENT_ROOT'] . "/php/mainFiles/dataObject_class.php";

class Comments extends dataObject_class
{
    protected $data = array(
        "username" => "",
        "commentText" => ""
    );

    public function __dataArray ($data)
    {
        parent::__dataArray($data);
    }

    public function insertComment($user , $text , $postID){

        $connection = parent::conect();
        $sql =  "INSERT INTO comments (CommentOwner ,commentText,postID) VALUES( :userName, :text, :postID)";
        try {
            $st = $connection->prepare( $sql );
            $st->bindValue( ":userName", $user, PDO::PARAM_STR );
            $st->bindValue( ":text", $text, PDO::PARAM_STR );
            $st->bindValue(":postID" , $postID , PDO::PARAM_INT);

            $st->execute();
            parent::disconnect( $connection );
            header('Location: ../../Pages/PostPage.php?id='.$postID);

        } catch ( PDOException $e ) {
            parent::disconnect( $connection );
            die( "Error Query: " . $e->getMessage() );
        }

    }
    public function getCommentListByPostID($post_id){

        include_once $_SERVER['DOCUMENT_ROOT'] . "/php/Tables/users_table/Users.php";

        $connection = parent::conect();

        $comment_list_sql = "select * from comments where postID = '$post_id'  ";

        $comment_list_sql_result = mysqli_query($GLOBALS['db'], $comment_list_sql);

        if (!$comment_list_sql_result) {
            die('Query failed: ' . mysql_error());
        }
        parent::disconnect($connection);
        return $comment_list_sql_result;

    }
}
