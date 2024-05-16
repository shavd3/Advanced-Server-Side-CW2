<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js" type="text/javascript"></script>
    <script src="https://kit.fontawesome.com/b9008b61cc.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>css/question.css">
</head>
<body>
   <div class='postcontainer'>
        <div class='leftdiv'>
                <div class='titlediv'></div><br>
                <div class='captiondiv'></div>
            <br>
            <div class='locationlikediv'>
                <div class='likediv' id='likediv'></div>
                <div class='likecount'></div>
                <div class="locationtag">
                    <div class='locationdiv'></div>
                </div>
            </div>

            <div class='usernameimgdiv'></div>
                <div class='commentareadiv'>
                    <textarea onkeyup='checkinputs();' name="comment" id="comment" maxlength="1000"></textarea>
                    <button onclick='postcomment();' id='commentbtn' disabled="disabled">Answer</button>
                </div>
                <div class='commentsdiv'></div>
            </div>
   </div>

    <script type="text/javascript" lang="javascript">
        var username="<?php echo $username ?>";
        var questionid="<?php echo $questionid ?>";
        $(document).ready(function () {
            event.preventDefault();
            //get answers and vote count on start
            getAnswers();
            voteCount();
            $.ajax({//get question details
                url: "<?php echo base_url() ?>index.php/questions/question/action/view?questionid="+questionid,
                method: "GET"
                }).done(function (data) {//display post details
                    var div2 ="<a href='<?php echo base_url() ?>index.php/questions/tagView?tagid="
                    + data.TagId +"'><span><i class='fa-solid'></i>"+ data.TagName +"</span></a>";
                    $('.locationdiv').append(div2);
                    var div3 ="<div class='usernamediv'><a href='<?php echo base_url() ?>index.php/users/userprofile/?username="
                             +data.Username +"'><span>"+ data.Username +"</span></a></div>";
                    $('.usernameimgdiv').append(div3);
                    var div4 ="<i onclick='like();' class='fa-regular fa-thumbs-up'></i>";
                    $('.likediv').append(div4);
                    var div5 =data.Title ;
                    $('.titlediv').append(div5);
                    var div6 =data.Description ;
                    $('.captiondiv').append(div6);
                });
                $.ajax({//check if user has already voted the question
                    url: "<?php echo base_url() ?>index.php/home/checkVotes?username="+username+"&questionid="+questionid,
                    method: "GET"
                }).done(function (res) {
                    if(res){
                        document.getElementById("likediv").style.color = "#a44122";
                    }
                    else{
                        document.getElementById("likediv").style.color = "#666666";
                    }
                });
            });
        //disable answer button unless there is a value in the input
        function checkinputs() {
            if ($("#comment").val() != "") {
                document.getElementById('commentbtn').disabled = false;
            }
            else{
                document.getElementById('commentbtn').disabled = true;
            }
        }
        //when question is voted, send post request and change color of button
        function like(){
            $.ajax({
                url: "<?php echo base_url() ?>index.php/home/vote",
                data: JSON.stringify({username: username,questionid:questionid}),
                contentType: "application/json",
                method: "POST"
            }).done(function (data) {
                $.ajax({
                    url: "<?php echo base_url() ?>index.php/home/checkVotes?username="+username+"&questionid="+questionid,
                    method: "GET"
                })
                .done(function (res) {
                    if(res){
                        document.getElementById("likediv").style.color = "#a44122";
                        voteCount();
                    }
                    else{
                        document.getElementById("likediv").style.color = "#666666";
                        voteCount();
                    }
                });
            });
        }
        //when answer button is clicked, add answer to database
        function postcomment(){
            var comment = {
                questionid: questionid,
                answer:$("#comment").val()
            };
            $.ajax({
                url: "<?php echo base_url() ?>index.php/home/answers",
                data: JSON.stringify(comment),
                contentType: "application/json",
                method: "POST"
            }).done(function (data) {
                if (data) {
                    document.getElementById('comment').value = '';
                    getAnswers();
                }
            });
        }
        //get all answers in the post
        function getAnswers(){
            $.ajax({
                    url: "<?php echo base_url() ?>index.php/home/answers?questionid="+questionid,
                    method: "GET"
            }).done(function (res) {
                if(res.length!=0){
                    $('.commentsdiv div').remove();
                    for (i = 0; i < res.length; i++) {
                        var div ="<div class='comments'><a href='<?php echo base_url() ?>index.php/users/userprofile/?username="
                                    +res[i].Username+"'>"+res[i].Username+"</a>"
                                    +res[i].AnswerBody+"</div>";
                        $('.commentsdiv').append(div);
                    }
                }
            });
        }
        //get the vote count for the questions
        function voteCount(){
            $.ajax({
                    url: "<?php echo base_url() ?>index.php/questions/voteCount?voteCount="+questionid,
                    method: "GET"
            }).done(function (res) {
                $('.likecount span').remove();
                if(res==1){
                    var div ="<span>"+res+" Ratings</span>";
                }
                else{
                    var div ="<span>"+res+" Ratings</span>";
                }
                $('.likecount').append(div);
            });
        }
    </script>
</body>
</html>