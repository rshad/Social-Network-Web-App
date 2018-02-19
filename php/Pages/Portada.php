<!DOCTYPE html>
<?php
    session_start();
    include_once '../Tables/posts_table/POSTS.php';
    $post = new POSTS();

?>
<html>
    <head>
        <title>
            Portrada
        </title>
        <link rel="stylesheet" href="../../css/CommonStyle.css">
        <link rel="stylesheet" href="../../css/PortadaStyle.css">
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
                    $user =new Users();
                    if(isset($_GET['id'])) {
                        $id = $_GET['id'];
                    }
                    else{
                        $id =  $user->Get_Owner_ID($_SESSION['OwnerUserName']);
                    }
                    ?>
                    <li><a class="active" href="Portada.php?id=<?php echo $id; ?>">Biografia</a></li>
                    <li><a href="fotos.html">Fotos</a></li>
                    <li><a href="informacion.php?id=<?php echo $id; ?>">Informacion</a></li>
                </ul>
            </nav>
        </header>
        <section class="FriendsSection">

            <header class="FriendListHeader">
                <h3 class="FriendListHeaderTitle">Friends</h3>
            </header>

            <article class="FriendsTableArticle" style="position: relative">

                <table class="FriendsTable">

                    <?php

                    $Friends_SQL_Result = $user->GetFriendList($id);
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
                                <td class="cellOfLineofFriends" style="position: relative">
                                    <a class="FriendsTable" style="position: absolute" href="Portada.php?id=<?php echo $friend_id;?>"><?php echo $friend_name; ?></br>
                                        <img src="../../Images/Alex.png" height="40" width="40" id="<?php echo $friend_id ?>" onmouseover=showDescriptionBox("<?php echo $friend_name; ?>","<?php echo $friend_id; ?>") >
                                    </br>
                                    <article class="DescriptionBox" style="display: none" id='<?php echo $friend_name; ?>' >
                                        <h4>Posts de <?php echo $friend_name; ?> </h4>
                                        <ul>
                                        <?php
                                            $Friend_Posts_SQL = $post->GetPostList_DescBox($friend_id);
                                            mysqli_data_seek($Friend_Posts_SQL, 0);
                                            While ($POST = $Friend_Posts_SQL->fetch_array(MYSQLI_ASSOC)) {
                                        ?>
                                            <p> <?php echo $POST['postTitle'] ?> </p>
                                        <?php
                                            }
                                        ?>
                                        </ul>
                                    </article>
                                    </a>
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
            <section class="PostsSection">
                <header class="PostSectionHeader">
                    <h3 class="PostSectionHeaderTitle">Friends Posts</h3>
                </header>

                <table class="TableOfPosts">
                    <?php
                        $salto_linea = 0;
                        $post_sql_result = $post->GetPostList($id,false);

                        $max_posts_per_line = 3;
                        $posts_num = mysqli_num_rows($post_sql_result);


                        if($posts_num> $max_posts_per_line) {
                            $int_num_posts_table_lines = intval($posts_num/ $max_posts_per_line);
                            if($int_num_posts_table_lines > $posts_num / $max_posts_per_line){
                                $int_num_posts_table_lines += 1;
                            }
                        }
                        else{
                            $int_num_posts_table_lines = 1;
                        }
                        $posts_numerated = $post_sql_result->fetch_array(MYSQLI_NUM);
                      /*
                        for($i=0 ; $i<$posts_num ; $i++){
                            printf($posts_numerated[$i]);
                        }
                      */

                        mysqli_data_seek($post_sql_result, 0);
                            While ($post = $post_sql_result->fetch_array(MYSQLI_ASSOC)) {
                    ?>
                            <?php
                                 if($salto_linea%3 == 0 && $salto_linea>=3) {
                                   echo"hola";
                                   echo ' <tr class="lineOfPostTableCell"> ';
                                }
                            ?>

                            <?php
                                $post_owner = $post['userName'];
                                $post_title = $post['postTitle'];
                                $post_text = $post['postText'];
                                $post_id = $post['postID'];
                             ?>
                            <td class="PostTableCell">
                                <article class="FiendPostArticle">
                                    <a class="linkToPost" href="PostPage.php?id=<?php echo $post_id;?>">
                                        <?php echo $post_owner; echo '</br>' ?>
                                        <img class="postImage" src="../../Images/Maria.png" height="40" width="40"></br>
                                        <h3 class="postTitle"><?php echo $post_title ?></h3>
                                        <p class="PostText"><?php echo $post_text ?></p>
                                    </a>
                                </article>
                            </td>
                    <?php
                        if($salto_linea%3 == 0 && $salto_linea>=3) {
                            echo "salto";

                            echo '</tr>';
                        }
                    ?>
                    <?php
                         $salto_linea++;
                         }
                    ?>
                </table>

                <footer class="PostsPartFooter">
                    <a class="changePostPageArrow" href="">&#8678;</a>
                    <a class="changePostPageArrow" href="">&#8680;</a>
                </footer>
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
    <!-- The footer of this page  -->
    <footer class ="PageFooter">
        <a href="../../ContactInfo.html" class="" target="_blank" >Contact Information</a>
        <a href="../../como_se_hizo.pdf" class ="PageDocumentation" target="_blank">look how it was created</a>
    </footer>
    </body>
</html>