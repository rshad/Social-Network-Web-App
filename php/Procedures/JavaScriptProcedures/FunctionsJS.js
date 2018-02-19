/**
 * Created by Rshad on 17/06/2017.
 */

var script = document.createElement('script');
script.src = './jquery-3.2.1.min.js';
script.type = 'text/javascript';

function showDescriptionBox(friend_name,ID) {

    var e = document.getElementById(ID);
    e.onmouseover = function() {
        document.getElementById(friend_name).style.display = 'block';
        document.getElementById(friend_name).style.border = '2px solid red';
        document.getElementById(friend_name).style.boxShadow = '1px 1px 1px' ;
        document.getElementById(friend_name).style.width = '200px';
        document.getElementById(friend_name).style.height = '30% ';
        document.getElementById(friend_name).style.margin = '0px 0px 0px 0px';
        document.getElementById(friend_name).style.zIndex='99999';



    }
    e.onmouseout = function() {
        document.getElementById(friend_name).style.display = 'none';
    }
}
function validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}

function validateSignInForm() {
    var email = document.forms["SignInForm"]["email"].value;
    if (email == "") {
        alert("email must be filled out");
        document.forms["SignInForm"]["email"].style.border = "1px solid red";
        return false;
    }
    var password = document.forms["SignInForm"]["password"].value;
    if (password == "") {
        alert("password must be filled out");
        document.forms["SignInForm"]["password"].style.border = "1px solid red";
        return false;
    }
}

function validateSignUpForm() {
    var firstname =  document.forms["SingUpForm"]["firstname"].value;
    var lastname =  document.forms["SingUpForm"]["lastname"].value;
    var email1 = document.forms["SingUpForm"]["email"].value;
    var email2 = document.forms["SingUpForm"]["email2"].value;
    var password1 = document.forms["SingUpForm"]["passwordPut"].value;
    var password2 = document.forms["SingUpForm"]["password2"].value;

    if( firstname == "" || lastname == "" || email1 == "" || (email2 == "" || email2 != email1) || (password1 == "" || password1.length <4 || password1.length >12   ) || (password2 == "" || password2 != password1) ){
        if (firstname == "") {
            alert("firstname must be filled out");
            document.forms["SingUpForm"]["firstname"].style.border = "1px solid red";
            return false;
        }
        if (lastname == "") {
            alert("lastname must be filled out");
            document.forms["SingUpForm"]["lastname"].style.border = "1px solid red";
            return false;
        }
        if (email1 == "" || !validateEmail(email1)) {
            alert("email must be filled out");
            document.forms["SingUpForm"]["email"].style.border = "1px solid red";
            return false;
        }
        if (email2 == "" || email2 != email1) {
            if(email2 == "" ) {
                alert("repeated email must be filled out");
                document.forms["SingUpForm"]["email2"].style.border = "1px solid red";
                return false;
            }
            else{
                alert("repeated email must be the same as the first introduced email");
                document.forms["SingUpForm"]["email2"].style.border = "1px solid red";
                return false;
            }
        }
        if (password1 == "" || password1.length <5 || password1.length >12 ) {
            if(password1 == "") {
                alert("password must be filled out");
                document.forms["SingUpForm"]["passwordPut"].style.border = "1px solid red";
                return false;
            }
            else{
                alert("password lenght must be between 5 and 12 digit");
                document.forms["SingUpForm"]["passwordPut"].style.border = "1px solid red";
                return false;
            }
        }
        if (password2 == "" || password2 != password1) {
            if(password2 == "") {
                alert("repeated password must be filled out");
                document.forms["SingUpForm"]["password2"].style.border = "1px solid red";
                return false;
            }
            else{
                alert("repeated password must be the same as the first introduced password");
                document.forms["SingUpForm"]["password2"].style.border = "1px solid red";
                return false;
            }
        }
    }

}
function validatePost() {

    var postTitle = document.forms["WritePost"]["postTitle"].value;
    if (postTitle == "" || postTitle.length > 30 ) {
        alert("post title must be filled out and its length can't be more than 15 digit");
        document.forms["WritePost"]["postTitle"].style.border = "1px solid red";
        return false;
    }
    var postText = document.forms["WritePost"]["postText"].value;
    if (postText == "" || postText.length > 50 ) {
        alert("post text must be filled out and its length can't be more than 50 digit");
        document.forms["WritePost"]["postText"].style.border = "1px solid red";
        return false;
    }

}
function validateComments() {
    var comment = document.forms["WriteComment"]["commentText"].value;
    if (comment == "" || comment.length > 30 ) {
        alert("comment must be filled out and its length can't be more than 30 digit");
        document.forms["WriteComment"]["commentText"].style.border = "1px solid red";
        return false;
    }

}
function validateInfo() {
    var firstname = document.forms["ChangeInfo"]["firstname"].value;
    var lastname = document.forms["ChangeInfo"]["lastname"].value;
    var email = document.forms["ChangeInfo"]["email"].value;
    var password = document.forms["ChangeInfo"]["passwordPut"].value;

    if (firstname == "") {
        alert("firstname must be filled out");
        document.forms["ChangeInfo"]["firstname"].style.border = "1px solid red";
        return false;
    }

    if (lastname == "") {
        alert("lastname must be filled out");
        document.forms["ChangeInfo"]["lastname"].style.border = "1px solid red";
        return false;
    }

    if (email == "" || !validateEmail(email)) {
        alert("email must be filled out or it's not valid");
        document.forms["ChangeInfo"]["email"].style.border = "1px solid red";
        return false;
    }

    if (password== "" ||  password.length <5 || password.length >12 ) {
        alert("password must be filled out by 5 to 12 digit");
        document.forms["ChangeInfo"]["passwordPut"].style.border = "1px solid red";
        return false;
    }

}