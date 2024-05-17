<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- External JavaScript libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/backbone.js/1.2.3/backbone-min.js" type="text/javascript"></script>
    <script src="https://kit.fontawesome.com/b9008b61cc.js" crossorigin="anonymous"></script>
    <!-- CSS file -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>css/homePage.css">
</head>

<body>
<div class="questioncontainer">
    <!-- Tag list section -->
    <div class="taglistdiv">
        <div class="cattag">CATEGORIES</div>
        <br>
        <br>
        <div id="taglist"></div> <!-- Display tags here -->
    </div>
    <!-- Feed container -->
    <div class="feedcontainer"></div> <!-- Display questions here -->
</div>

    <script type="text/javascript" lang="javascript">
        $(document).ready(function () {
            event.preventDefault();
            // AJAX request to fetch all tags and display them
            $.ajax({
                url: "<?php echo base_url() ?>index.php/questions/tags/action/all",
                method: "GET"
            }).done(function (data) {
                for (i = 0; i < data.length; i++) {
                    if (data[i] != null) {
                        var span = "<a href='<?php echo base_url() ?>index.php/questions/tagView?tagid=" +
                            data[i].TagId + "'><span>" + data[i].TagName + "</span></a></br>";
                        $('#taglist').append(span);
                    }
                }
            });
        });

        var username = "<?php echo $username ?>";

        $(document).ready(function () {
            event.preventDefault();
            postCollection.fetch(); // Fetch backbone collection on start
        });

        // Backbone Collection
        var PostCollection = Backbone.Collection.extend({
            url: "<?php echo base_url() ?>index.php/home/userQuestions?username=" + username,
        });

        var html = "";
        // Backbone View for displaying posts
        var PostDisplay = Backbone.View.extend({
            el: ".feedcontainer",
            initialize: function () {
                this.listenTo(this.model, "add", this.showResults);
            },
            showResults: function (m) {
                // Display question details
                html +=
                    "<div class='questiondiv'>" +
                    "<div class='uservotediv'>" +
                    "<div class='titlediv'><a href='<?php echo base_url() ?>index.php/questions/question?questionid=" +
                    m.get('QuestionId') + "'>" + m.get('Title') + "</span></a></div>" +

                    "<div class='votediv' id='votediv" + m.get('QuestionId') +
                    "'><i onclick='vote(" + m.get('QuestionId') + ");' class='fa-regular fa-thumbs-up'></i></div></div>" +

                    "<div class='descdiv'>" +
                    m.get('Description') + "</div><br>" +

                    "<div class='usernamediv'><a href='<?php echo base_url() ?>index.php/users/userprofile/?username=" +
                    m.get('Username') + "'><span>" + m.get('Username') + "</span></a></div><br>" +

                    "<div class='tagbox'><div class='tagdiv'>" +
                    "<a href='<?php echo base_url() ?>index.php/questions/tagView?tagid=" + m.get('TagId') + "'>" +
                    "<span><i class='fa-solid'></i>" + m.get('TagName') + "</span></a></div></div>" +
                    "</div>";

                this.$el.html(html); // Display HTML content

                // Check if the user has already voted and change color accordingly
                $.ajax({
                    url: "<?php echo base_url() ?>index.php/home/checkVotes?username=" + username + "&questionid=" + m.get('QuestionId'),
                    method: "GET"
                }).done(function (res) {
                    if (res) {
                        document.getElementById("votediv" + m.get('QuestionId')).style.color = "#a44122";
                    } else {
                        document.getElementById("votediv" + m.get('QuestionId')).style.color = "#d7d1ba";
                    }
                });
            }
        });

        var postCollection = new PostCollection();
        var postDisplay = new PostDisplay({ model: postCollection });

        // Function to handle voting
        function vote($questionid) {
            $.ajax({
                url: "<?php echo base_url() ?>index.php/home/vote",
                data: JSON.stringify({ username: username, questionid: $questionid }),
                contentType: "application/json",
                method: "POST"
            }).done(function (data) {
                // Check if the vote was successful and update vote color
                $.ajax({
                    url: "<?php echo base_url() ?>index.php/home/checkVotes?username=" + username + "&questionid=" + $questionid,
                    method: "GET"
                }).done(function (res) {
                    if (res) {
                        document.getElementById("votediv" + $questionid).style.color = "#a44122";
                    } else {
                        document.getElementById("votediv" + $questionid).style.color = "#d7d1ba";
                    }
                });
            });
        }
    </script>
</body>
</html>
