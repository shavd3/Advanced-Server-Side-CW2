<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>css/addQuestion.css">
</head>
<body>
<div class="uppostcontainer">
    <div class="captiondiv">
        <div class="caplabel"> <label for="title">Question Title</label></div>
        <div><textarea name="title" id="title"  maxlength="100" required></textarea></div>
        <!-- Add error message for validation -->
        <div id="title-error-msg" style="color: #a44122; display: none;">Please enter a question title.</div>
    </div>

    <div class="titlediv">
        <div class="caplabel"> <label for="caption">Description</label></div>
        <div><textarea name="caption" id="caption"  maxlength="1000"></textarea></div>
        <br>

        <div class="caplabel"><label for="locations">Category</label></div>
        <div>
            <select onchange='getTag();' id="locations">
                <option id ='TagName' value=""></option>
            </select>
        </div>
    </div>
    <div class="postsubmitdiv"><div id="uploadpost" >POST</div></div>
</div>

<script type="text/javascript" lang="javascript">
    var postImage="";
    var $tagId = "1";
    //load tags at start and display in drop down
    $.ajax({
        url: "<?php echo base_url() ?>index.php/posts/tags/action/all",
        method: "GET"
    }).done(function (data) {
        $('#locations option').remove();
        for (i = 0; i < data.length; i++) {
            var option ="<option id ='tagName' value="+data[i].TagId+">"+data[i].TagName+"</option>";
            $('#locations').append(option);
        }
    });
    //get tag value from form element
    function getTag() {
        $tagId = document.getElementById("locations").value;
    }
    //to display the image as its uploaded
    function readURL(input) {
        document.getElementById("errormsg").innerHTML = "";
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            var formdata = new FormData();
            var files = $('#image')[0].files;
            if(files.length > 0 ){
                formdata.append('image',files[0]);
                reader.onload = function (e) {
                    $('#postpicid').attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    }
    //function calls when upload button is clicked
    $("#uploadpost").click(function(event) {
        event.preventDefault();
        // Check if the title is empty
        if ($('#title').val().trim() === "") {
            $('#title-error-msg').show();
            return; // Prevent form submission
        }
        var formdata = new FormData();
        var postdata = {
            tagid: $tagId,
            // postImage: $postImage,
            title: $('#title').val(),
            description: $('#caption').val()
        };
        $.ajax({
            url: "<?php echo base_url() ?>index.php/posts/create", //sends data to databse
            data: JSON.stringify(postdata),
            contentType: "application/json",
            method: "POST"
        }).done(function (data) {
            var result = data.result;
            if (result == "done") {//redirect to myprofile on success
                location.href="<?php echo base_url()?>index.php/myprofile";
            }
            else {//else display error msg
                document.getElementById("errormsg").innerHTML = "Question is not created";
            }
        });
    });
</script>
</body>
</html>