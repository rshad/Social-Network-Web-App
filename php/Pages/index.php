<!DOCTYPE html>
<html>
<?php session_start() ;

 if(isset($_SESSION['WrongEmailOrPassword']) && $_SESSION['WrongEmailOrPassword'] == true){
     $_SESSION['WrongEmailOrPassword'] = false;
     echo "<script> alert('Wrong email or password'); </script>";
 }
?>
    <head>
        <title>
            Start Page
        </title>

        <link rel="stylesheet" href="../../css/indexStyle.css">
        <link rel="stylesheet" href="../../css/CommonStyle.css">
        <script src="../Procedures/JavaScriptProcedures/FunctionsJS.js"></script>

    </head>
    <body>
    <!-- SignIn form -->
    <header class ="PageHeader">

        <section class="LogoImageSection">
            <a class ="logoImageBorder" href="index.php">
                <img src="../../Images/logo.PNG" class ="logoImage" width="40" height="40">
            </a>
        </section>

        <section class ="LogoText">
            <a href="index.php">MyStory</a>
        </section>

        <section class="SignInFormSection">
            <form method="get" onsubmit="return validateSignInForm()" action="../Procedures/phpProcedures/SignIn.php" class ="SignIn" name="SignInForm" >
                <table border="0" style="border:none">
                    <tr>
                        <td >
                            <input type="text" tabindex="1"  class ="emailRegister" placeholder="Email or Phone" name="email" class="inputtext radius1" value="">
                        </td>
                        <td >
                            <input type="password" tabindex="2" class ="pass" placeholder="Password" name="password" class="inputtext radius1" >
                        </td>
                        <td >
                            <!-- <a hrPortada.phphtml" class="button">Log In</a> -->
                            <button type="submit"  name="id" class ="signUpButton">log in</button>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>
                                <input class ="persist_box" type="checkbox" name="persistent" value="1" checked="1" class="checkText"/>
                                <span style="color:#ccc;" class="checkText">Keep me logged in</span>
                            </label>
                        </td>
                        <td>
                            <label>
                                <a href="" style="color:#ccc; text-decoration:none">forgot your password?</a>
                            </label>
                        </td>
                    </tr>
                </table>
            </form>
        </section>
    </header>

    <section class ="MiddleBody">

        <img class="imageFigure" src="../../Images/red-foto.jpg" width="510" height="370">

        <!-- Registering form -->
        <section class="RegisteringFormSection">

            <form class ="RegisteringForm" onsubmit="return validateSignUpForm()" action="../Procedures/phpProcedures/SignUp.php" name="SingUpForm" >
                <h3 class ="SignUp">
                    Sign Up and Tell Us Your Story !
                </h3></br>
                <table border="0" style="border:none">
                    <tr>
                        <td >
                            <input type="text" tabindex="3"  placeholder="First Name" name="firstname" class="inputtext" value="">
                        </td>
                        <td >
                            <input type="text" tabindex="4"   placeholder="Last Name" name="lastname" class="inputtext" value="">
                        </td>
                    </tr>
                    <tr>
                        <td >
                            <input type="email" tabindex="5"   placeholder="Email" name="email" class="inputtext" value="">
                        </td>
                        <td >
                            <input type="email" tabindex="6"   placeholder="Repeat Email" name="email2" class="inputtext" value="">
                        </td>
                    </tr>
                    <tr>
                        <td >
                            <input type="password" tabindex="7"  placeholder="Password" name="passwordPut" class="inputtext" value="">
                        </td>
                        <td >
                            <input type="password" tabindex="8"  placeholder="RepeatPassword" name="password2" class="inputtext" value="">
                        </td>
                    </tr>
                    <tr>
                        <td >
                            <label class ="GenderLabel">Gender</label>
                            <select class ="Gender" name="Gender">
                                <option value="">Other</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <button type="submit" class ="signUpButton">Sign Up</button>
                        </td>
                    </tr>
                </table>
            </form>
        </section>




    </section>


    <!-- The footer of this page  -->
    <footer class ="PageFooter">
        <a href="../../ContactInfo.html" class="" target="_blank" >Contact Information</a>
        <a href="../../como_se_hizo.pdf" class ="PageDocumentation" target="_blank">look how it was created</a>
    </footer>





    </body>
</html>