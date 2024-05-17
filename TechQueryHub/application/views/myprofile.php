<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/backbone.js/1.2.3/backbone-min.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>css/profile.css">
</head>

<body>
<div class="profilecontainer">
    <!-- Profile details section -->
    <div class="profiledeetdiv">
        <div class="topdiv">
            <!-- Profile picture -->
            <div class="profpicdiv"></div>
        </div>
        <!-- User name -->
        <div class="usernamediv"><?php echo $username ?></div>
        <!-- Name -->
        <div class="namediv"></div>
        <!-- Bio -->
        <div class="biodiv"></div>
        <!-- Profile options: Edit Profile and Logout -->
        <div class="profbottomdiv">
            <a class="editprlink" href="<?php echo base_url()?>index.php/myprofile/editprofile">EDIT PROFILE</a>
            <a class="logoutlink" href="<?php echo base_url()?>index.php/users/logout">LOGOUT</a>
        </div>
    </div>
    <!-- User's questions section -->
    <div class="questionsdiv" id="questionsdiv"></div>
</div>

    <script type="text/javascript" lang="javascript">
        var username="<?php echo $username ?>";
        // Fetch user details and questions on page load
        $(document).ready(function () {
            event.preventDefault();
            // Fetch user details via API
            $.ajax({
                url: "<?php echo base_url() ?>index.php/users/userdetails?username="+username,
                method: "GET"
            }).done(function (data) {
                // Display user details
                var div = "<img class='profileimage' src='<?php echo base_url() ?>images/profilepics/"+data.UserImage+"' />";
                $('.profpicdiv').append(div);
                var name = "<span>"+data.Name+"</span>";
                $('.namediv').append(name);
                var bio = "<span>"+data.UserBio+"</span>";
                $('.biodiv').append(bio);
            });

            // Fetch user's questions via Backbone
            postCollection.fetch();
        });

        // Backbone model for user's questions
        var Post = Backbone.Model.extend({
            url: "<?php echo base_url() ?>index.php/myprofile/myQuestions"
        });

        // Backbone collection for user's questions
        var PostCollection = Backbone.Collection.extend({
            url: "<?php echo base_url() ?>index.php/myprofile/myQuestions",
            model: Post,
            parse: function(data) {
                return data;
            }
        });

        // Backbone view to display user's questions
        var PostDisplay = Backbone.View.extend({
            el: "#questionsdiv",
            initialize: function () {
                this.listenTo(this.model, "add", this.showResults);
            },
            showResults: function () {
                var html = "";
                // Iterate through each question in the collection
                this.model.each(function (m) {
                    // Build HTML for each question
                    html +=
                        "<div class='questionboxdiv'><a href='<?php echo base_url() ?>index.php/questions/question?questionid="
                        + m.get('QuestionId') + "'>"
                        + "<div class='titlediv'><a href='<?php echo base_url() ?>index.php/questions/question?questionid="
                        + m.get('QuestionId') + "'>" + m.get('Title') + "</span></a></div>" +
                        "<div class='descdiv'>" +
                        m.get('Description') + "</div><br>" +
                        "<div class='tagbox'>" +
                        "<div class='tagdiv'>" +
                        "<a href='<?php echo base_url() ?>index.php/questions/tagView?tagid="
                        + m.get('TagId') + "'>" +
                        "<span><i class='fa-solid'></i>" + m.get('TagName') +
                        "</span></a></div></div>" +
                        "</div>";
                });
                // Display the questions in the DOM
                this.$el.html(html);
            }
        });

        // Instantiate collection and view
        var postCollection = new PostCollection();
        var postDisplay = new PostDisplay({model: postCollection});
    </script>
</body>
</html>
