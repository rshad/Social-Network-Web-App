<!DOCTYPE html>
<?php
    session_start();
?>

<html>
    <head>
        <title>
            Entrada
        </title>
        <link rel="stylesheet" href="../../css/CommonStyle.css">
        <link rel="stylesheet" href="../../css/ProfileStyle.css">
        <script src="../Procedures/JavaScriptProcedures/FunctionsJS.js"></script>
    </head>

    <body>
        <header class="PageHeader">
            <figure class="LogoImageFigure">
                <a class="logoImageLink" href="index.php">
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

                <article class="FriendsTableArticle">

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
                                        <td class="cellOfLineofFriends">
                                            <a class="FriendsTable" href="Portada.php?id=<?php echo $friend_id;?>"><?php echo $friend_name; ?></br><img
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
                <section class="LeftMainBody">
                        <section class="MakePost">
                            <article class="UserNameProfileImage">
                                <h4 class="UserNameText"><?php echo $_SESSION['OwnerUserName'] ?></h4>
                                <figure class="userImageFigure">
                                    <img class="postImage" src="../../Images/Active.jpg" height="40" width="40">
                                </figure>
                            </article>
                            <article class="PostMaterialPart">
                                <h4 class="MakePostMaterialTilte">Introduce tu entrada</h4>
                                <form name="WritePost" onsubmit="return  validatePost()" class="PostTextImageForm" action="../Procedures/phpProcedures/InsertPOST.php">
                                    <input type="text" placeholder="POST TITLE" name="postTitle"></br>
                                    <input type="text" placeholder="right something and tell ur story" name="postText"></br>
                                    <label class="inputfileLabel" for="upload-photo">Browse...</label>
                                    <input type="file" name="photo" id="upload-photo" />
                                    <input type="submit" class="PostSubmit" >
                                </form>
                            </article>
                        </section>

                        <section class="PostsSection">
                            <header class="PostSectionHeader">
                                <h3 class="PostSectionHeaderTitle">My Posts</h3>
                            </header>

                            <table class="TableOfPosts">
                            <?php
                                include_once '../Tables/posts_table/POSTS.php';
                                $salto_linea = 0;
                                $post = new POSTS();
                                $post_sql_result = $post->GetPostList($id,true);

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
                                    if( ($salto_linea==0) || ($salto_linea%3 == 0 && $salto_linea>=3) ) {
                                        echo ' <tr class="lineOfPostTableCell"> ';
                                    }
                                    ?>

                                    <?php
                                    $post_owner = $post['userName'];
                                    $post_title = $post['postTitle'];
                                    $post_text = $post['postText'];
                                    $post_ID = $post['postID'];
                                    ?>
                                    <td class="PostTableCell">
                                        <article class="FiendPostArticle">
                                            <a class="linkToPost" href="PostPage.php?id=<?php echo $post_ID;?>">
                                                <?php echo $post_owner; echo '</br>' ?>
                                                <img class="postImage" src="../../Images/Active.jpg" height="40" width="40"></br>
                                                <h3 class="postTitle"><?php echo $post_title ?></h3>
                                                <p class="PostText"><?php echo $post_text ?></p>
                                            </a>
                                        </article>
                                    </td>
                                <?php
                                    $salto_linea++;
                                    if($salto_linea%3 == 0 && $salto_linea==3) {
                                        echo '</tr>';
                                        $salto_linea = 0;
                                    }
                                }
                                ?>
                            </table>
                            <?php
                                $salto_linea = 0;
                            ?>
                            <footer class="PostsPartFooter">
                                <a class="changePostPageArrow" href="">&#8678;</a>
                                <a class="changePostPageArrow" href="">&#8680;</a>
                            </footer>
                        </section>
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
        </section>
        <footer class ="PageFooter">
            <a href="../../ContactInfo.html" class="" target="_blank" >Contact Information</a>
            <a href="../../como_se_hizo.pdf" class ="PageDocumentation" target="_blank">look how it was created</a>
        </footer>

    </body>
</html>