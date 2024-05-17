<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>TechQueryHub</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="../../css/verify.css">
</head>
<body>
    <div class="pwform">
        <!-- Password Reset Heading -->
        <div class="pwresetheading"><span>RESET PASSWORD</span></div>
        <!-- Error Message Display -->
        <div class="errormsg" id="errormsg"></div>
        <!-- Password Reset Form -->
        <form class="authforms" name="loginform">
            <!-- Username Input Field -->
            <div class="input">
                <input class="loginfield" type="text" id="username" name="username" onkeyup="checkinputs();" required/>
                <label class="loginlabel">Username<span style="color:#EB9494">*</span></label>
            </div>
            <!-- New Password Input Field -->
            <div class="input">
                <input class="loginfield" type="password" id="password" name="password" onkeyup="checkinputs();" required/>
                <label class="loginlabel">New Password<span style="color:#EB9494">*</span></label>
            </div>
            <!-- Reset Button -->
            <div class="action">
                <input class="loginbtn" type="submit" disabled="disabled" id="changepw" value="RESET" />
            </div>
        </form>

        <!-- Sign Up Link -->
        <div class="loginspandiv">
            <span>Or <a href="<?php echo base_url()?>index.php/users/signup">Sign Up</a> here</span>
        </div>
    </div>

    <script type="text/javascript" lang="javascript">
        // Function to check if inputs are empty
        function checkinputs() {
            if (document.forms["loginform"]["username"].value != "" && document.forms["loginform"]["password"].value != "") {
                document.getElementById('changepw').disabled = false;
            } else {
                document.getElementById('changepw').disabled = true;
            }
        }

        // Event listener for password reset button click
        $("#changepw").click(function(event) {
            event.preventDefault();
            // Data for password reset
            var pwdata = {
                username: "@" + $('#username').val().toLowerCase(),
                password: $('#password').val()
            };
            // AJAX request to reset password
            $.ajax({
                url: "<?php echo base_url() ?>index.php/users/user/action/passwordreset",
                data: JSON.stringify(pwdata),
                contentType: "application/json",
                method: "POST"
            }).done(function (data) {
                // Handle response
                var result = data.result;
                if (result == "success") {
                    // Redirect on successful password reset
                    location.href = "<?php echo base_url() ?>index.php/users/login";
                } else if (result == "logged") {
                    // Redirect if user is changing password while logged in
                    location.href = "<?php echo base_url() ?>index.php/myprofile";
                } else {
                    // Display error message if username doesn't exist
                    document.getElementById("errormsg").innerHTML = "Username Doesn't Exist!";
                }
            });
        });
    </script>
</body>
</html>
