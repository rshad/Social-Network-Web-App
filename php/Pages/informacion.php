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
        <link rel="stylesheet" href="../../css/informacionStyle.css">
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

            <section class="RegisteringFormSection">
                <h3 class ="SignUp">
                    My Information
                </h3></br>
                <?php
                    $owner_ID = $user->Get_Owner_ID($_SESSION['OwnerUserName']);
                    if($owner_ID == $id) {
                ?>
                        <form name ="ChangeInfo" onsubmit="return validateInfo()"  class="RegisteringForm" action="../Procedures/phpProcedures/PersonalDataForm.php">
                            <h4 class="UserNameText">
                                <?php echo $user->Get_Owner_NAME($id); ?>
                            </h4>
                            <figure>
                                <img class="UserImage" src="../../Images/Alex.png" width="40" height="40">
                            </figure>
                            <label class="inputfileLabel" for="upload-photo">Browse...</label></br>
                            <input type="file" name="photo" id="upload-photo"/>
                            <label>First Name</label>
                            <input type="text" tabindex="3" placeholder="First Name" name="firstname" class="inputtext"
                                   value="<?php echo $user->Get_Owner_OBJ($id)['first_name']; ?>"></br>
                            <label>Second Name</label>
                            <input type="text" tabindex="4" placeholder="Last Name" name="lastname" class="inputtext"
                                   value="<?php echo $user->Get_Owner_OBJ($id)['last_name']; ?>"></br>
                            <label>email</label>
                            <input type="email" tabindex="5" placeholder="Email" name="email" class="inputtext"
                                   value="<?php echo $user->Get_Owner_OBJ($id)['email']; ?>"></br>
                            <label>Password</label>
                            <input type="password" tabindex="8" placeholder="RepeatPassword" name="passwordPut"
                                   class="inputtext" value = "<?php echo $user->Get_Owner_OBJ($id)['password']; ?>"></br>
                            <label class="GenderLabel">Gender</label>
                            <select class="Gender" name="Gender">
                                <option value="">Other</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select></br>
                            <button type="submit" class="signUpButton">Change</button>
                        </form>
                <?php
                    }
                    else {
                ?>
                        <form class="RegisteringForm">
                            <h4 class="UserNameTextotheruser">
                                <?php echo $user->Get_Owner_NAME($id); ?>
                            </h4>
                            <figure>
                                <img class="UserImage" src="../../Images/Alex.png" width="40" height="40">
                            </figure>
                            <label>FirstName</label>
                            <input type="text" tabindex="3" placeholder="First Name" name="firstname" class="inputtext"
                                   value="<?php echo $user->Get_Owner_OBJ($id)['first_name']; ?>" readonly></br>
                            <label>Last Name</label>
                            <input type="text" tabindex="4" placeholder="Last Name" name="lastname" class="inputtext"
                                   value="<?php echo $user->Get_Owner_OBJ($id)['last_name']; ?>" readonly></br>
                            <label>email</label>
                            <input type="email" tabindex="5" placeholder="Email" name="email" class="inputtext"
                                   value="<?php echo $user->Get_Owner_OBJ($id)['email']; ?>" readonly></br>
                            <label class="GenderLabel">Gender</label>
                            <input type="text" class="inputtext" value="Male" readonly>
                        </form>
                <?php
                    }
                ?>
            </section>
        </section>
        <footer class ="PageFooterOtherUser">
            <a href="../../ContactInfo.html" class="" target="_blank" >Contact Information</a>
            <a href="../../como_se_hizo.pdf" class ="PageDocumentation" target="_blank">look how it was created</a>
        </footer>
    </body>
</html>