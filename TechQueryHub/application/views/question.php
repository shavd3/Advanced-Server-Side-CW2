<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js" type="text/javascript"></script>
    <script src="https://kit.fontawesome.com/b9008b61cc.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>css/question.css">
</head>
<body>
    <div class='questioncontainer'>
        <div class='centerdiv'>
            <!-- Question Title and Description -->
            <div class='titlediv'></div><br>
            <div class='descdiv'></div>
            <br>
            <!-- Vote, Vote Count, and Tags Section -->
            <div class='tagvotediv'>
                <div class='votediv' id='votediv'></div>
                <div class='votecount'></div>
                <div class="tagbox">
                    <div class='tagdiv'></div>
                </div>
            </div>

            <!-- Username and Answer Textarea -->
            <div class='usernameimgdiv'></div>
            <div class='answerareadiv'>
                <textarea onkeyup='checkinputs();' name="answer" id="answer" maxlength="1000"></textarea>
                <button onclick='postanswer();' id="answerbtn" disabled="disabled">Answer</button>
            </div>

            <!-- Answers Section -->
            <div class='answersdiv'></div>
        </div>
    </div>

    <script type="text/javascript" lang="javascript">
        var username="<?php echo $username ?>";
        var questionid="<?php echo $questionid ?>";

        $(document).ready(function () {
            event.preventDefault();
            // Get answers and vote count on page load
            getAnswers();
            voteCount();

            $.ajax({// Get question details
                url: "<?php echo base_url() ?>index.php/questions/question/action/view?questionid="+questionid,
                method: "GET"
            }).done(function (data) {// Display question details
                var div2 ="<a href='<?php echo base_url() ?>index.php/questions/tagView?tagid="
                    + data.TagId +"'><span><i class='fa-solid'></i>"+ data.TagName +"</span></a>";
                $('.tagdiv').append(div2);
                var div3 ="<div class='usernamediv'><a href='<?php echo base_url() ?>index.php/users/userprofile/?username="
                    +data.Username +"'><span>"+ data.Username +"</span></a></div>";
                $('.usernameimgdiv').append(div3);
                var div4 ="<i onclick='vote();' class='fa-regular fa-thumbs-up'></i>";
                $('.votediv').append(div4);
                var div5 =data.Title ;
                $('.titlediv').append(div5);
                var div6 =data.Description ;
                $('.descdiv').append(div6);
            });

            $.ajax({// Check if user has already voted the question
                url: "<?php echo base_url() ?>index.php/home/checkVotes?username="+username+"&questionid="+questionid,
                method: "GET"
            }).done(function (res) {
                if(res){
                    document.getElementById("votediv").style.color = "#a44122";
                } else {
                    document.getElementById("votediv").style.color = "#666666";
                }
            });
        });

        // Disable answer button unless there is a value in the input
        function checkinputs() {
            if ($("#answer").val() != "") {
                document.getElementById('answerbtn').disabled = false;
            } else {
                document.getElementById('answerbtn').disabled = true;
            }
        }

        // When question is voted, send post request and change color of button
        function vote() {
            $.ajax({
                url: "<?php echo base_url() ?>index.php/home/vote",
                data: JSON.stringify({username: username,questionid:questionid}),
                contentType: "application/json",
                method: "POST"
            }).done(function (data) {
                $.ajax({
                    url: "<?php echo base_url() ?>index.php/home/checkVotes?username="+username+"&questionid="+questionid,
                    method: "GET"
                }).done(function (res) {
                    if(res){
                        document.getElementById("votediv").style.color = "#a44122";
                        voteCount();
                    } else {
                        document.getElementById("votediv").style.color = "#666666";
                        voteCount();
                    }
                });
            });
        }

        // When answer button is clicked, add answer to database
        function postanswer() {
            var answer = {
                questionid: questionid,
                answer:$("#answer").val()
            };
            $.ajax({
                url: "<?php echo base_url() ?>index.php/home/answers",
                data: JSON.stringify(answer),
                contentType: "application/json",
                method: "POST"
            }).done(function (data) {
                if (data) {
                    document.getElementById('answer').value = '';
                    getAnswers();
                }
            });
        }

        // Get all answers in the question
        function getAnswers() {
            $.ajax({
                url: "<?php echo base_url() ?>index.php/home/answers?questionid="+questionid,
                method: "GET"
            }).done(function (res) {
                if(res.length!=0){
                    $('.answersdiv div').remove();
                    for (i = 0; i < res.length; i++) {
                        var div ="<div class='answer'><a href='<?php echo base_url() ?>index.php/users/userprofile/?username="
                            +res[i].Username+"'>"+res[i].Username+"</a>"
                            +res[i].AnswerBody+"</div>";
                        $('.answersdiv').append(div);
                    }
                }
            });
        }

        // Get the vote count for the questions
        function voteCount() {
            $.ajax({
                url: "<?php echo base_url() ?>index.php/questions/voteCount?voteCount="+questionid,
                method: "GET"
            }).done(function (res) {
                $('.votecount span').remove();
                if(res==1){
                    var div ="<span>"+res+" Rating</span>";
                } else {
                    var div ="<span>"+res+" Ratings</span>";
                }
                $('.votecount').append(div);
            });
        }
    </script>
</body>
</html>
