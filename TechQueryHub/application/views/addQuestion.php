<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>css/addQuestion.css">
</head>
<body>
    <div class="questioncontainer">
        <div class="descdiv">
            <div class="desclabel"> <label for="title">Question Title</label></div>
            <div><textarea name="title" id="title"  maxlength="100" required></textarea></div>
            <!-- Error message for validation -->
            <div id="title-error-msg" style="color: #a44122; display: none;">Please enter a question title.</div>
        </div>

        <div class="titlediv">
            <div class="desclabel"> <label for="description">Description</label></div>
            <div><textarea name="description" id="description" maxlength="1000"></textarea></div>
            <br>
            <div class="desclabel"><label for="tags">Category</label></div>
            <div>
                <select onchange='getTag();' id="tags">
                    <option id ='TagName' value=""></option>
                </select>
            </div>
        </div>
        <div class="questionsubmitdiv"><div id="uploadquestion" >POST</div></div>
    </div>

<script type="text/javascript" lang="javascript">
    var $tagId = "1";
    //load tags at start and display in drop down
    $.ajax({
        url: "<?php echo base_url() ?>index.php/questions/tags/action/all",
        method: "GET"
    }).done(function (data) {
        $('#tags option').remove();
        for (i = 0; i < data.length; i++) {
            var option ="<option id ='tagName' value="+data[i].TagId+">"+data[i].TagName+"</option>";
            $('#tags').append(option);
        }
    });
    //get tag value from form element
    function getTag() {
        $tagId = document.getElementById("tags").value;
    }
    //function calls when upload button is clicked
    $("#uploadquestion").click(function(event) {
        event.preventDefault();
        // Check if the title is empty
        if ($('#title').val().trim() === "") {
            $('#title-error-msg').show();
            return; // Prevent form submission
        }
        var formdata = new FormData();
        var questionData = {
            tagid: $tagId,
            // postImage: $postImage,
            title: $('#title').val(),
            description: $('#description').val()
        };
        $.ajax({
            url: "<?php echo base_url() ?>index.php/questions/addQuestion", //sends data to databse
            data: JSON.stringify(questionData),
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
