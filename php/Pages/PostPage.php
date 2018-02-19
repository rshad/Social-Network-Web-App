<!DOCTYPE html>
<?php
session_start();
?>
<html>
<head>
    <title>
        Portrada
    </title>
    <link rel="stylesheet" href="../../css/CommonStyle.css">
    <link rel="stylesheet" href="../../css/EntradaStyle.css">
    <script src="../Procedures/JavaScriptProcedures/FunctionsJS.js"></script>
</head>
<body>
<header class="PageHeader">
    <figure class="LogoImageFigure">
        <a class="logoImageLink" href="Portada.php">
            <img src="../../Images/logo.PNG" width="50" height="50">
        </a>
    </figure>

    <section class="PageHeaderLogoText">
        <h3 class="logo">
            <a class="logoTexLink" href="Portada.php">MyStory</a>
        </h3>
    </section>

    <section class="PageHeaderUserNameProfileImage">
        <a class="" href="active.php">
            <h4 class="PageHeaderUserNameText"><?php echo $_SESSION['OwnerUserName'] ?></h4></br>
            <img class="PageHeaderUserImage" src="../../Images/Active.jpg" height="40" width="40">
        </a>
    </section>
    <section class="LogOut">
        <a class="LogOutLink" href="../Procedures/phpProcedures/LogOut.php">Log Out</a>
    </section>
</header>
<section class="mainBody">
    <header class="mainBodyHeader">
        <nav class="navegationBar">
            <ul class="topnav">
                <?php
                include_once "../Tables/users_table/Users.php";
                include_once "../Tables/posts_table/POSTS.php";

                $post = new POSTS();
                if(isset($_GET['id'])) {
                    $id = $_GET['id'];
                }
                $post_sql = $post->Get_POST_BY_ID($id);
                $row = mysqli_fetch_array($post_sql, MYSQLI_ASSOC);
                $post_owner = $row['userName'];

                $user = new Users();
                $user_id = $user->Get_Owner_ID($post_owner);

                ?>
                <li><a class="active" href="Portada.php?id=<?php echo $user_id; ?>">Biografia</a></li>
                <li><a href="fotos.html">Fotos</a></li>
                <li><a href="informacion.php?id=<?php echo $user_id; ?>">Informacion</a></li>
            </ul>
        </nav>
    </header>
    <section class="mainBody">
        <section class="FriendsSection">

            <header class="FriendListHeader">
                <h3 class="FriendListHeaderTitle">Friends</h3>
            </header>

            <article class="FriendsTableArticle">

                <table class="FriendsTable">

                    <?php

                    $Friends_SQL_Result = $user->GetFriendList($user_id);
                    $num_friends = mysqli_num_rows($Friends_SQL_Result);
                    $max_cells_per_line = 6;
                    if($num_friends > $max_cells_per_line) {
                        $int_num_table_lines = intval($num_friends / $max_cells_per_line);
                        if($int_num_table_lines > $num_friends / $max_cells_per_line){
                            $int_num_table_lines += 1;
                        }
                    }
                    else{
                        $int_num_table_lines = 1;
                    }
                    ?>
                    <?php
                    for($i = 0 ; $i<$int_num_table_lines;$i++) {
                        ?>
                        <tr class="lineOfFriends">
                            <?php
                            mysqli_data_seek($Friends_SQL_Result, 0);
                            While ($Friends = $Friends_SQL_Result->fetch_array(MYSQLI_ASSOC)) {
                                $friend_name = $Friends['userName'];
                                $friend_id = $Friends['user_id'];
                                ?>
                                <td class="cellOfLineofFriends">
                                    <a class="FriendsTable" href="Portada.php?id=<?php echo $friend_id;?>"><?php echo $friend_name ?></br><img
                                                src="../../Images/Alex.png" height="40" width="40"></a>
                                </td>
                                <?php
                            }
                            ?>
                        </tr>
                        <?php
                    }
                    ?>
                </table>
            </article>
        </section>

        <section class="middleBody">
                <section class="PostSection">
                    <header class="PostSectionHeader">
                        <h3 class="PostSectionHeaderTitle">
                            Post
                        </h3>
                    </header>
                    <article class="PostArticle">
                        <article class="UserNameImageDate">
                            <h4 class="PostUserName">
                                <?php
                                    $post = new POSTS();
                                    $row = mysqli_fetch_array($post->Get_POST_BY_ID($id), MYSQLI_ASSOC);
                                    $PostOwner = $row['userName'];
                                    echo $PostOwner;
                                ?>
                            </h4>
                            <h6 class="hour" style="display: inline ;"><?php
                                $dt = new DateTime();
                                echo $dt->format('Y-m-d H:i:s');
                                ?></h6>
                            </br>
                            <img class="PostUserProfileImage" src="../../Images/Alex.png" width="40" height="40">

                        </article>
                        <p class="PostTextContent">
                            <?php
                                $post = new POSTS();
                                $row = mysqli_fetch_array($post->Get_POST_BY_ID($id), MYSQLI_ASSOC);
                                echo $row['postText'];
                            ?>
                        </p>
                        <img class="PostImage" src="../../Images/Alex_20171704_1533_01.jpg" width="500" height="300">
                    </article>

                    <ol class="listOfComments">

                        <?php

                            include_once '../Tables/comments_table/Comments.php';
                            $comment_obj = new Comments();
                            $comment_sql_result = $comment_obj->getCommentListByPostID($id);

                            While($comment = $comment_sql_result->fetch_array(MYSQLI_ASSOC)) {
                                $comment_Owner = $comment['CommentOwner'];
                                $commentText = $comment['commentText'];
                        ?>
                                <li class="PostComment">
                                    <article class="UserNameImageDate">
                                        <a href="Portada.php">
                                            <img class="CommentUserProfileImage" src="../../Images/Alex.png" width="40"
                                                 height="40">
                                            <h4 class="CommentUserName">
                                                <?php echo $comment_Owner ?>
                                            </h4>
                                        </a>
                                    </article>
                                    <p class="CommentTextContent">
                                        <?php echo $commentText ?>
                                    </p>
                                </li>

                    <?php
                            }
                    ?>
                    </ol>
                    <form onsubmit="return  validateComments()" name = "WriteComment" class="PutCommentForm" action="../Procedures/phpProcedures/InsertComment.php">
                        <?php
                            $_SESSION['Actual_POST_ID'] = $id;
                        ?>
                        <img class="PutCommentProfileImage" src="../../Images/Alex.png" width="40" height="40">
                        <input class="PutCommentBoxShadow" name="commentText" type="text">
                        <input type="submit">
                    </form>
                </section>
            <section class="ActiveUsersSection" >
                <header class="ActiveUseresSectionaHeader">
                    <h3 class="ActiveUseresSectionaHeaderTitle">Active Users</h3>
                </header>

                <ol class="ActiveUsersList">
                    <li>
                        Alex</br><img src="../../Images/Alex.png" height="40" width="40">
                    </li>
                    <li>
                        Maria</br><img src="../../Images/Maria.png" height="40" width="40">
                    </li>
                </ol>
            </section>
            </section>
        </section>
        <footer class ="PageFooter">
            <a href="../../ContactInfo.html" class="" target="_blank" >Contact Information</a>
            <a href="../../como_se_hizo.pdf" class ="PageDocumentation" target="_blank">look how it was created</a>
        </footer>
    </body>
</html>