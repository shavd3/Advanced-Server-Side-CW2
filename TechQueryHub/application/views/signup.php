<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>TechQueryHub</title>
    <!-- External Scripts and Styles -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js"
            type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/backbone.js/1.2.3/backbone-min.js"
            type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>css/verify.css">
</head>

<body>
    <div class="postcontainer">
        <!-- Right Section: Logo and Title -->
        <div class="rightdiv">
            <div class="logodiv"><img class="logoimage" src="<?php echo base_url() ?>images/new.png" alt="Logo" /></div>
            <div class="logodiv">
                <span> TechQueryHub </span>
            </div>
        </div>
        <!-- Left Section: Registration Form -->
        <div class="leftregdiv">
            <!-- Registration Heading -->
            <div class="logheading"><span>REGISTER</span></div>
            <!-- Error Message Display -->
            <div class="errormsg" id="errormsg"></div>
            <!-- Registration Form -->
            <form class="authforms" name="signupform">
                <!-- Username Input Field -->
                <div class="input">
                    <input class="signfield" type="text" id="username" name="username"
                           onkeyup="checkusername(); checkinputs();" required />
                    <label class="signlabel">Username <span style="color:#a44122">*</span></label>
                </div>
                <!-- Email Input Field -->
                <div class="input">
                    <input class="signfield" type="text" id="email" name="email"
                           onkeyup="checkinputs(); validateemail()" required />
                    <label class="signlabel">Email <span style="color:#a44122">*</span></label>
                </div>
                <!-- Name Input Field -->
                <div class="input">
                    <input class="signfield" type="text" id="name" name="name" onkeyup="checkinputs();" required />
                    <label class="signlabel">Name</label>
                </div>
                <!-- Password Input Field -->
                <div class="input">
                    <input class="signfield" type="password" id="password" name="password"
                           onkeyup="checkinputs();" required />
                    <label class="signlabel">Password <span style="color:#a44122">*</span></label>
                </div>
                <!-- Sign Up Button -->
                <div class="action">
                    <input class="signupbtn" type="submit" id="createUser" disabled="disabled" value="SIGN UP" />
                </div>
            </form>
            <!-- Sign In Link -->
            <div class="signspandiv">
                    <span>Already have an account? <a href="<?php echo base_url() ?>index.php/users/login">Login</a>
                    </span>
            </div>
        </div>
    </div>

    <script type="text/javascript" lang="javascript">
        // Function to check if required inputs are empty
        function checkinputs() {
            if (document.forms["signupform"]["username"].value != "" && document.forms["signupform"]["email"].value != "" &&
                document.forms["signupform"]["password"].value != "" && document.getElementById("errormsg").innerHTML == "") {
                document.getElementById('createUser').disabled = false;
            } else {
                document.getElementById('createUser').disabled = true;
            }
        }
        // Function to validate email format
        function validateemail() {
            var x = document.forms["signupform"]["email"].value;
            var atposition = x.indexOf("@");
            var dotposition = x.lastIndexOf(".");
            if (atposition < 1 || dotposition < atposition + 2 || dotposition + 2 >= x.length) {
                document.getElementById("errormsg").innerHTML = "Please enter a valid e-mail address";
            } else {
                document.getElementById("errormsg").innerHTML = "";
                checkinputs();
            }
        }
        // Function to check if username already exists
        function checkusername() {
            $.ajax({
                url: "<?php echo base_url() ?>index.php/users/user/action/checkuser",
                data: {
                    'username': "@" + $('#username').val().toLowerCase()
                },
                method: "POST"
            }).done(function (data) {
                if (data == 0) {
                    document.getElementById("errormsg").innerHTML = "";
                    checkinputs();
                } else {
                    document.getElementById("errormsg").innerHTML = "Username Already Exists!";
                }
            });
        }
        // Event listener for sign up button click
        $(document).ready(function () {
            $('#createUser').click(function (event) {
                event.preventDefault();
                userSignup();
            });
        });
        // Backbone Model and Collection for User
        var User = Backbone.Model.extend({
            url: "<?php echo base_url() ?>index.php/users/user/action/signup"
        });
        var UserCollection = Backbone.Collection.extend({
            model: User
        });
        var usersCollection = new UserCollection();
        // Function to handle user sign up
        function userSignup() {
            var newUser = new User();
            newUser.set('username', "@" + $("#username").val().toLowerCase());
            newUser.set('email', $("#email").val());
            newUser.set('name', $("#name").val());
            newUser.set('password', $("#password").val());
            usersCollection.create(newUser, {
                success: function () {
                    // Redirect to login page on successful sign up
                    location.href = "<?php echo base_url() ?>index.php/users/login";
                }
            });
        }
    </script>
</body>
</html>
