<?php

/**
 * Created by PhpStorm.
 * User: Rshad
 * Date: 05/05/2017
 * Time: 15:52
 */
//include("../../../php/mainFiles/dataObject_class.php");
include_once $_SERVER['DOCUMENT_ROOT'] . "/php/mainFiles/dataObject_class.php";

class Users extends dataObject_class {
    protected $data = array(
        "name" => "",
        "first_name" => "",
        "last_name" => "",
        "email" => "",
        "password"=> ""
    );


    /**
     * @param $name
     * @param $first_name
     * @param $last_name
     * @param $email
     * @param $password
     */
    public function __dataArray ($data)
    {
        parent::__dataArray($data);
    }

    public function InsertUserData($name , $first_name , $last_name , $email , $password){
        session_start();

        $connection = parent::conect();
        $sql =  "INSERT INTO users (userName,first_name,last_name,email,password) 
                 VALUES( :userName , :first_name ,:last_name , :email , :password )";
        try {
            $st = $connection->prepare( $sql );

            $st->bindValue( ":userName", $name, PDO::PARAM_STR );
            $st->bindValue( ":first_name", $first_name, PDO::PARAM_STR );
            $st->bindValue( ":last_name", $last_name, PDO::PARAM_STR );
            $st->bindValue( ":email", $email, PDO::PARAM_STR );
            $st->bindValue( ":password", $password, PDO::PARAM_STR );

            $st->execute();

            parent::disconnect( $connection );
            header('Location: ../../Pages/index.php');

        } catch ( PDOException $e ) {
            parent::disconnect( $connection );
            die( "Error Query: " . $e->getMessage() );
        }

    }

    public function SignInFunc( $activeEmail , $activePassword )
    {
        $connection = parent::conect();

        $sql_pass = "SELECT * FROM users WHERE email = '$activeEmail'";
        $pass_result=mysqli_query($GLOBALS['db'], $sql_pass);
        $row_pass =  mysqli_fetch_array($pass_result, MYSQLI_ASSOC);
        $hashed_password = $row_pass['password'];

        if ( password_verify($activePassword, $hashed_password) ){
            $sql = "SELECT userName FROM users WHERE email = '$activeEmail' and password = '$hashed_password'";
            $result=mysqli_query($GLOBALS['db'], $sql);
            $row_count=mysqli_num_rows($result);

            //correct query's result
            if ( ($result) && $row_count == 1  )
            {

                // Return the number of rows in result set
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                //echo $row['userName'];
                $_SESSION['OwnerUserName'] = $row['userName'];

                //Update the list of active users
                array_push($GLOBALS['ActiveUsers'], $row['userName']);


                $_SESSION['ActiveUsersList'] = $GLOBALS['ActiveUsers'];
            /*
                foreach($_SESSION['ActiveUsersList'] as $key=>$value)
                {
                    // and print out the values
                    echo 'The value of $_SESSION['."'".$key."'".'] is '."'".$value."'".' <br />';
                }
             */
                //redirect to the wall page after a correct log in
                header('Location: ../../Pages/Portada.php');

                // Free result set
                mysqli_free_result($result);
            }
        }
        else{
                $_SESSION['WrongEmailOrPassword'] = true;
                echo "Helloooo";
                header('Location: ../../Pages/index.php');

        }
        parent::disconnect($connection);

    }
    public function GetFriendList($owner_id){

        $connection = parent::conect();
        $friend_list_sql = "select * from users where user_id <> '$owner_id' ";
        $friend_list_sql_result = mysqli_query($GLOBALS['db'], $friend_list_sql);

        if (!$friend_list_sql_result) {
            die('Query failed: ' . mysql_error());
        }

        parent::disconnect($connection);

        return $friend_list_sql_result;



    }
    public function Get_Owner_ID($user_name){
        $connection = parent::conect();
        $user_id_sql = "select user_id from users where userName = '$user_name' ";
        $user_id_sql_result = mysqli_query($GLOBALS['db'], $user_id_sql);

        if (!$user_id_sql_result) {
            die('Query failed: ' . mysql_error());
        }
        else {
            $row = mysqli_fetch_array($user_id_sql_result, MYSQLI_ASSOC);
        }
        parent::disconnect($connection);

        return $row['user_id'];

    }
    public function Get_Owner_NAME($userID){
        $connection = parent::conect();
        $user_name_sql = "select * from users where user_id = '$userID' ";
        $user_name_sql_result = mysqli_query($GLOBALS['db'], $user_name_sql);
        $row = mysqli_fetch_array($user_name_sql_result, MYSQLI_ASSOC);

        parent::disconnect($connection);
        return $row['userName'];

    }
    public function Get_Owner_OBJ($userID){
        $connection = parent::conect();
        $user_name_sql = "select * from users where user_id = '$userID' ";
        $user_name_sql_result = mysqli_query($GLOBALS['db'], $user_name_sql);
        $row = mysqli_fetch_array($user_name_sql_result, MYSQLI_ASSOC);
        parent::disconnect($connection);
        return $row;
    }
    public function ChangeInfo($user_id , $firstName , $secondName , $email , $pass ){
        $connection = parent::conect();
        $sql = "UPDATE users 
                SET first_name = '$firstName' , last_name = '$secondName' , email = '$email' , password = '$pass' 
                WHERE user_id = '$user_id' ";
        $Execute_SQL=mysqli_query($GLOBALS['db'], $sql);
        if(!mysqli_query($GLOBALS['db'], $sql) ){
            echo "No UPDATE was executed";
        }
        header('Location: ../../Pages/informacion.php?id='.$user_id);
        parent::disconnect($connection);
    }

}
