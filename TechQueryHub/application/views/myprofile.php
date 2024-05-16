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
    <div class="profiledeetdiv">
        <div class="topdiv">
            <div class="profpicdiv"></div>
<!--            <div class="followdiv">-->
<!--                <div class="flabel">FOLLOWING</div>-->
<!--                <div class="fcount" id="followingc"></div>-->
<!--                <div class="flabel">FOLLOWERS</div>-->
<!--                <div class="fcount" id="followerc"></div>-->
<!--            </div>-->
        </div>
        <div class="usernamediv"><?php echo $username ?></div>
        <div class="namediv"></div>
        <div class="biodiv"></div>

        <div class="profbottomdiv">
            <a class="editprlink" href="<?php echo base_url()?>index.php/myprofile/editprofile">EDIT PROFILE</a>
            <a class="logoutlink" href="<?php echo base_url()?>index.php/users/logout">LOGOUT</a>
        </div>
    </div>
    <div class="postsdiv" id="postsdiv"></div>
</div>

<script type="text/javascript" lang="javascript">
    var username="<?php echo $username ?>";
    //backbone fetch the post collection on start
    $(document).ready(function () {
        event.preventDefault();
        postCollection.fetch();
        $.ajax({//get user details through api
            url: "<?php echo base_url() ?>index.php/users/userdetails?username="+username,
            method: "GET"
        }).done(function (data) {
            var div ="<img class='profileimage' src='<?php echo base_url() ?>images/profilepics/"+data.UserImage+"'/>";
            $('.profpicdiv').append(div);
            var name ="<span>"+data.Name+"</span>";
            $('.namediv').append(name);
            var bio ="<span>"+data.UserBio+"</span>";
            $('.biodiv').append(bio);
        });
        //$.ajax({//get follower/following counts
        //    url: "<?php //echo base_url() ?>//index.php/myprofile/followcount?username="+username,
        //    method: "GET"
        //}).done(function (data) {
        //    document.getElementById("followingc").innerHTML = data.following
        //    document.getElementById("followerc").innerHTML = data.followers
        //});
    });
   
    var Post = Backbone.Model.extend({
        url: "<?php echo base_url() ?>index.php/myprofile/myposts"
    });

    var PostCollection = Backbone.Collection.extend({
        url: "<?php echo base_url() ?>index.php/myprofile/myposts",
        model: Post,
        parse: function(data) {
            return data;
        } 
    });
    //backbone view to display the posts
    var PostDisplay = Backbone.View.extend({
        el: "#postsdiv",
        initialize: function () {
            this.listenTo(this.model, "add", this.showResults);
        },
        showResults: function () {
            var html = "";
            this.model.each(function (m) {
                // html = html + "<div class='postimagediv'><a href='<?php echo base_url() ?>index.php/posts/post?postid="
                // + m.get('PostId') +"'><img class='postimage' src='<?php echo base_url() ?>images/userposts/"
                // + m.get('PostImage') + "'/></a></div>";

                html = html + "<div class='postimagediv'><a href='<?php echo base_url() ?>index.php/posts/post?postid=" 
                + m.get('QuestionId') + "'>"
                + "<div class='titlediv'><a href='<?php echo base_url() ?>index.php/posts/post?postid=" 
                    + m.get('QuestionId') + "'>" + m.get('Title') + "</span></a></div>" +

                    "<div class='captiondiv'>" +

                    m.get('Description') + "</div><br>" +
                    "<div class='locationtag'>" +
                        "<div class='locationdiv'>" +
                        "<a href='<?php echo base_url() ?>index.php/posts/tagView?tagid=" + m.get('TagId') + "'>" +
                        "<span><i class='fa-solid'></i>" + m.get('TagName') +
                    "</span></a></div></div>" +

                    "</div>";
            });
            this.$el.html(html);
        }
    });
    var postCollection = new PostCollection();
    var postDisplay = new PostDisplay({model: postCollection})
</script>
</body>
</html>