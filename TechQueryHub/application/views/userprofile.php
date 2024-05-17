<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- External Scripts and Styles -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/backbone.js/1.2.3/backbone-min.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>css/profile.css">
</head>

<body>
    <div class="profilecontainer">
        <!-- Profile Details Section -->
        <div class="profiledeetdiv">
            <div class="topdiv">
                <div class="profpicdiv"></div>
            </div>
            <div class="usernamediv"><?php echo $username ?></div>
            <div class="namediv"></div>
            <div class="biodiv"></div>
        </div>

        <!-- Questions Section -->
        <div class="questionsdiv" id="questionsdiv"></div>
    </div>

    <script type="text/javascript" lang="javascript">
        // Username variable
        var username = "<?php echo $username ?>";

        $(document).ready(function () {
            event.preventDefault();
            postCollection.fetch(); // Fetch the questions from collection on start

            // Get user details and display
            $.ajax({
                url: "<?php echo base_url() ?>index.php/users/userdetails?username=" + username,
                method: "GET"
            }).done(function (data) {
                var profilePic = "<img class='profileimage' src='<?php echo base_url() ?>images/profilepics/" + data.UserImage + "'/>";
                $('.profpicdiv').append(profilePic);
                var name = "<span>" + data.Name + "</span>";
                $('.namediv').append(name);
                var bio = "<span>" + data.UserBio + "</span>";
                $('.biodiv').append(bio);
            });
        });

        // Backbone Model for Post
        var Post = Backbone.Model.extend({
            url: "<?php echo base_url() ?>index.php/questions/userQuestions?username=" + username
        });

        // Backbone Collection for Post
        var PostCollection = Backbone.Collection.extend({
            url: "<?php echo base_url() ?>index.php/questions/userQuestions?username=" + username,
            model: Post,
            parse: function(data) {
                return data;
            }
        });

        // Backbone View for Post Display
        var PostDisplay = Backbone.View.extend({
            el: "#questionsdiv",
            initialize: function () {
                this.listenTo(this.model, "add", this.showResults);
            },
            showResults: function () {
                var html = "";
                this.model.each(function (m) {
                    html +=
                        "<div class='questionboxdiv'><a href='<?php echo base_url() ?>index.php/questions/question?questionid=" + m.get('QuestionId') + "'>" +
                        "<div class='titlediv'><a href='<?php echo base_url() ?>index.php/questions/question?questionid=" + m.get('QuestionId') + "'>" + m.get('Title') + "</span></a></div>" +
                        "<div class='descdiv'>" + m.get('Description') + "</div><br>" +
                        "<div class='tagbox'>" +
                        "<div class='tagdiv'>" +
                        "<a href='<?php echo base_url() ?>index.php/questions/tagView?tagid=" + m.get('TagId') + "'>" +
                        "<span><i class='fa-solid'></i>" + m.get('TagName') + "</span></a></div></div>" +
                        "</div>";
                });
                this.$el.html(html);
            }
        });

        var postCollection = new PostCollection();
        var postDisplay = new PostDisplay({model: postCollection})

        // Function to check if user is being followed
        function checkfollow(){
            $.ajax({
                url: "<?php echo base_url() ?>index.php/myprofile/checkfollow?isfollowing=" + username,
                method: "GET"
            });
        }
    </script>
</body>
</html>
