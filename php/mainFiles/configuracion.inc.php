<?php
/**
 * Created by PhpStorm.
 * User: Rshad
 * Date: 05/05/2017
 * Time: 11:48
 */
    define("DB_DSN", "mysql:host=localhost;dbname=pw_Y2944240R" );
    //define("DB_USER","pw_Y2944240R");
    define("DB_USER","root");
    define("DB_PASSWORD", "holamundo" );
    define("TABLE_USERS", "users" );
    define("TABLE_COMMENTS", "comments" );
    define("TABLE_PSOTS", "posts" );
    define("db_mysqli" , "localhost");
    define("db_name_mysqli" , "pw_Y2944240R");
    global $db;
    $db = mysqli_connect(db_mysqli,DB_USER,DB_PASSWORD,db_name_mysqli);

    global $ActiveUsers;
    $ActiveUsers = array();



?>