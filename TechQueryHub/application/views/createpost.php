<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>css/createpostnew.css">
</head>
<body>
    <div class="uppostcontainer">
        <!-- <div class="filediv">
            <div class="errormsg" id="errormsg"></div>
                <div class="postpicdiv">
                    <img id='postpicid' src='<?php echo base_url() ?>images/userposts/default.jpg' alt='picture'/>
                </div>
            <input type="file" id="image" name="image" required="required" onchange="readURL(this);"/>
            <div class="dummy"><p>Select Picture</p></div>
        </div> -->

        <div class="captiondiv">
            <div class="caplabel"> <label for="title">Question Title</label></div>
            <div><textarea name="title" id="title"  maxlength="100"></textarea></div>
        </div>

        <div class="titlediv">
            <div class="caplabel"> <label for="caption">Description</label></div>
            <div><textarea name="caption" id="caption"  maxlength="1000"></textarea></div>
            <br>

            <div class="caplabel"><label for="locations">Category</label></div>
                <div>
                    <select onchange='getlocation();' id="locations">
                        <option id ='locationName' value=""></option>
                    </select>
                </div>
            </div>

        <div class="postsubmitdiv"><div id="uploadpost" >POST</div></div>
    </div>

    <script type="text/javascript" lang="javascript">
        var postImage="";
        var $locationid = "1";
        //load loaction posts at start and display in drop down
         $.ajax({
             url: "<?php echo base_url() ?>index.php/posts/location/action/all",
             method: "GET"
         }).done(function (data) {
	         $('#locations option').remove();
		 	for (i = 0; i < data.length; i++) {
		     	var option ="<option id ='locationName' value="+data[i].LocationId+">"+data[i].LocationName+"</option>";
		 	    $('#locations').append(option);
		     }
         });
        //get location value from form element
        function getlocation() {
            $locationid = document.getElementById("locations").value;
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
            var formdata = new FormData();
            // var files = $('#image')[0].files;
            // if(files.length > 0 ){
            //     formdata.append('image',files[0]);
            // $.ajax({
            //     url: "<?php echo base_url() ?>index.php/posts/store",//store the image in folder
            //     data: formdata,
            //     method: "POST",
            //     contentType: false,
            //     processData: false
            // }).done(function (data) {
            //     var result=data.result;
            //     if (result=="done") {
            //         $postImage = data.image_metadata.file_name;  //get filename from the saved image
                    var postdata = {
                        locationid: $locationid,
                        // postImage: $postImage,
                        title: $('#title').val(),
                        caption: $('#caption').val()
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
                            document.getElementById("errormsg").innerHTML = "Post is not created";
                        }
                    });
            //     } else {
            //         $error=data.error.slice(3,-4);
            //         document.getElementById("errormsg").innerHTML = $error;
            //     }
            // });
            // }
            // else{
            //     document.getElementById("errormsg").innerHTML = "Please select a file.";
            // }
        });
        </script>
</body>
</html>