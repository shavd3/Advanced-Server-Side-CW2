<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>css/addQuestion.css">
</head>
<body>
<div class="questioncontainer">
    <!-- Question Title -->
    <div class="descdiv">
        <div class="desclabel"> <label for="title">Question Title</label></div>
        <!-- Textarea for question title with required attribute -->
        <div><textarea name="title" id="title" maxlength="100" required></textarea></div>
        <!-- Error message for validation -->
        <div id="title-error-msg" style="color: #a44122; display: none;">Please enter a question title.</div>
    </div>

    <!-- Question Description -->
    <div class="titlediv">
        <div class="desclabel"> <label for="description">Description</label></div>
        <!-- Textarea for question description -->
        <div><textarea name="description" id="description" maxlength="1000"></textarea></div>
        <br>
        <!-- Category Dropdown -->
        <div class="desclabel"><label for="tags">Category</label></div>
        <div>
            <!-- Dropdown menu for selecting category -->
            <select onchange='getTag();' id="tags">
                <option id ='TagName' value=""></option>
            </select>
        </div>
    </div>
    <!-- Submit Button -->
    <div class="questionsubmitdiv"><div id="uploadquestion" >POST</div></div>
</div>

    <script type="text/javascript" lang="javascript">
        var $tagId = "1";
        // Load tags at start and display in drop down
        $.ajax({
            url: "<?php echo base_url() ?>index.php/questions/tags/action/all",
            method: "GET"
        }).done(function (data) {
            $('#tags option').remove();
            // Add options to dropdown menu
            for (i = 0; i < data.length; i++) {
                var option ="<option id ='tagName' value="+data[i].TagId+">"+data[i].TagName+"</option>";
                $('#tags').append(option);
            }
        });
        // Get tag value from form element
        function getTag() {
            $tagId = document.getElementById("tags").value;
        }
        // Function called when upload button is clicked
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
            // AJAX request to add question
            $.ajax({
                url: "<?php echo base_url() ?>index.php/questions/addQuestion", // Sends data to database
                data: JSON.stringify(questionData),
                contentType: "application/json",
                method: "POST"
            }).done(function (data) {
                var result = data.result;
                if (result == "done") {
                    // Redirect to myprofile on success
                    location.href="<?php echo base_url()?>index.php/myprofile";
                }
                else {
                    // Display error message if question is not created
                    document.getElementById("errormsg").innerHTML = "Question is not created";
                }
            });
        });
    </script>
</body>
</html>
