<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- External JavaScript library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js" type="text/javascript"></script>
    <!-- CSS file -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>css/editProfile.css">
</head>

<body>
<div class="editprofcontainer">
    <!-- Text editing section -->
    <div class="texteditdiv">
        <!-- Error messages -->
        <div class="errormsg" id="errormsg2"></div>
        <!-- Display name change option -->
        <div class="namechangediv"></div>
        <!-- Display email change option -->
        <div class="emailchangediv"></div>
        <!-- Display bio change option -->
        <div class="biochangediv"></div>
        <!-- Change password link -->
        <div class="changepwdiv"><a href="<?php echo base_url()?>index.php/users/passwordreset">Change Password</a></div>
    </div>
    <!-- Profile picture editing section -->
    <div class="piceditdiv">
        <!-- Error messages -->
        <div class="errormsg" id="errormsg"></div>
        <!-- Display current profile picture -->
        <div class="profimagediv"></div>
        <!-- File input for uploading new profile picture -->
        <input type="file" id="image" name="image" onchange="readURL(this);" />
        <!-- Placeholder for file input -->
        <div class="dummy">Select Profile Picture</div>
    </div>
    <!-- Button to save changes -->
    <div class="editprofdiv"><div id="editprofile">SAVE CHANGES</div></div>
</div>

    <script type="text/javascript" lang="javascript">
        // Initialize variables with user data
        var username="<?php echo $username ?>";
        var userimage="";
        var bio="";
        var name="";
        var email="";

        $(document).ready(function () {
            event.preventDefault();
            // AJAX request to get user details and display them
            $.ajax({
                url: "<?php echo base_url() ?>index.php/users/userdetails?username="+username,
                method: "GET"
            }).done(function (data) {
                // Populate user details
                userimage=data.UserImage;
                bio=data.UserBio;
                name=data.Name;
                email=data.Email;
                // Display profile picture
                var div ="<img id='profpicid' src='<?php echo base_url() ?>images/profilepics/"+data.UserImage+"' alt='picture'/>";
                $('.profimagediv').append(div);
                // Display name input field
                var namediv="<div class='labeldiv'>Name</div><div class='inputdiv'><input class='inputedit' onkeyup='getname()' type=text id='name' name='name' value='"+data.Name+"'/></div>";
                $('.namechangediv').append(namediv);
                // Display email input field
                var emaildiv="<div class='labeldiv'>Email</div><div class='inputdiv'><input class='inputedit' onkeyup='validateemail()' type=text id='email' name='email' value='"+data.Email+"'/></div>";
                $('.emailchangediv').append(emaildiv);
                // Display bio input field
                var biodiv="<div class='labeldiv'>Bio</div><div class='inputdiv'><textarea name='bio' id='bio' onkeyup='getbio()' maxlength='120'>"+data.UserBio+"</textarea></div>";
                $('.biochangediv').append(biodiv);
            });
        });

        // Validate the edited email
        function validateemail() {
            var x = $("#email").val();
            var atposition = x.indexOf("@");
            var dotposition = x.lastIndexOf(".");
            if (atposition < 1 || dotposition < atposition + 2 || dotposition + 2 >= x.length) {
                document.getElementById("errormsg2").innerHTML = "Please enter a valid e-mail address";
            }
            else {
                document.getElementById("errormsg2").innerHTML = "";
                email = x;
            }
        }

        // Update 'name' variable when name input changes
        function getname() {
            name = $("#name").val();
        }

        // Update 'bio' variable when bio input changes
        function getbio() {
            bio = $("#bio").val();
        }

        // Display the uploaded image
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                var formdata = new FormData();
                var files = $('#image')[0].files;
                if(files.length > 0 ){
                    formdata.append('image',files[0]);
                    $.ajax({
                        url: "<?php echo base_url() ?>index.php/questions/profpic", // Store the image in folder
                        data: formdata,
                        method: "POST",
                        contentType: false,
                        processData: false
                    }).done(function (data) {
                        var result=data.result;
                        if (result=="done") {
                            userimage = data.image_metadata.file_name; // Get file name
                            reader.onload = function (e) {
                                $('#profpicid').attr('src', e.target.result);
                            };
                            reader.readAsDataURL(input.files[0]);
                            document.getElementById("errormsg").innerHTML = '';
                        } else {
                            $error=data.error.slice(3,-4);
                            document.getElementById("errormsg").innerHTML = $error;
                        }
                    });
                }
            }
        }

        // Save changes when button is clicked
        $("#editprofile").click(function(event) {
            event.preventDefault();
            var postdata = {
                userimage: userimage,
                username:username,
                bio:bio,
                name:name,
                email:email
            }
            $.ajax({
                url: "<?php echo base_url() ?>index.php/users/editprofile",
                data: JSON.stringify(postdata),
                contentType: "application/json",
                method: "PUT"
            }).done(function (data) {
                var result=data.result;
                if(result=="done"){ // Redirect to my profile if successful
                    location.href="<?php echo base_url()?>index.php/myprofile";
                }
                else{
                    document.getElementById("errormsg2").innerHTML = "Couldn't save changes";
                }
            });
        });
    </script>
</body>
</html>
