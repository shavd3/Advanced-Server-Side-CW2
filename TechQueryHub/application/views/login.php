<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>TechQueryHub</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/backbone.js/1.2.3/backbone-min.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>css/verify.css">
</head>

    <div>
    <div class="postcontainer">
        <!-- Right div containing logo -->
        <div class="rightdiv">
            <div class="logodiv">
                <img class="logoimage" src="<?php echo base_url()?>images/new.png" alt="Logo"/>
            </div>
            <div class="logodiv">
                <span> TechQueryHub </span>
            </div>
        </div>
        <!-- Left div containing login form -->
        <div class="leftdiv"
            <div class="loginform">
                <div class="logheading"><span>LOGIN</span></div>
                <!-- error message if necessary -->
                <?php if (isset($login_error_msg)) { ?>
                <div class="errormsg">
                    <?php echo $login_error_msg ?>
                </div> <?php } ?>

                <form class="authforms" name="loginform">
                    <div class="input">
                        <input class="loginfield" type=text id="username" name='username' onkeyup='checkinputs();' required/>
                        <label class="loginlabel">Username<span style="color:#a44122"></span></label>
                    </div>
                    <div class="input">
                        <input class="loginfield" type=password id="password" name='password' onkeyup='checkinputs();' required/>
                        <label class="loginlabel">Password<span style="color:#a44122"></span></label>
                    </div>

                    <div class="action">
                        <input class="loginbtn" type=submit disabled="disabled" id="login" value="LOGIN" />
                    </div>
                </form>

                <div class="loginspandiv">
                    <a href="<?php echo base_url()?>index.php/users/passwordreset">Forgot Password?</a><br>
                    <span>Don't have an account? <a href="<?php echo base_url()?>index.php/users/signup">Sign Up</a> here </span>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" lang="javascript">
        // Function to enable/disable login button based on input fields
        function checkinputs() {
            if (document.forms["loginform"]["username"].value != "" && document.forms["loginform"]["password"].value != "") {
                document.getElementById('login').disabled = false;
            } else {
                document.getElementById('login').disabled = true;
            }
        }

        $(document).ready(function () {
            // Event listener for login button click
            $('#login').click(function (event) {
                event.preventDefault();
                userLogin();
            });
        });

        // Backbone Model for login
        var Login = Backbone.Model.extend({
            url:"<?php echo base_url()?>index.php/users/user/action/login"
        });

        // Backbone Collection for login
        var LoginCollection = Backbone.Collection.extend({
            model: Login,
        });

        var loginCollection = new LoginCollection();

        // Function to handle user login
        function userLogin() {
            var newLogin = new Login();
            newLogin.set('username', "@"+$("#username").val().toLowerCase()); // Username is converted to lowercase
            newLogin.set('password', $("#password").val());
            loginCollection.create(newLogin,{
                success: function(response){
                    var result=response.changed.result;
                    // Redirect based on login result
                    if (result=="success") {
                        // Redirect to home on success
                        location.href="<?php echo base_url()?>index.php/home/";
                    } else {
                        // Redirect back to login on failure
                        location.href="<?php echo base_url()?>index.php/users/login";
                    }
                }
            });
        }
    </script>
</body>
</html>