<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/backbone.js/1.2.3/backbone-min.js" type="text/javascript"></script>
    <script src="https://kit.fontawesome.com/b9008b61cc.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>css/homenew.css">
</head>

<body>
<div class="feedcontainer">
    <!-- <div class='userlisting'></div> -->
    <!-- <div class='notfollowing'>
        <div class='heading'></div>
        <div class='userlisting'></div>
    </div> -->
<!--    <div class="locationlistdiv">-->
<!--        <span id='locationname'></span>-->
<!--        <div id="locationlist"> </div>-->
<!--    </div>-->

<div>

<script type="text/javascript" lang="javascript">
    var username="<?php echo $username ?>";
    $(document).ready(function () {
        event.preventDefault();
        postCollection.fetch();//fetch backbone collection on start
    });

    var PostCollection = Backbone.Collection.extend({
        url: "<?php echo base_url() ?>index.php/home/followingposts?username="+username,
    });
    var html = "";
    var PostDisplay = Backbone.View.extend({
        el: ".feedcontainer",
        initialize: function () {
            this.listenTo(this.model, "add", this.showResults);
        },
        showResults: function (m) {//display all posts in backbone view

            html += "<div class='postdiv'>" + 

            "<div class='userlikediv'>" +

                "<div class='titlediv'><a href='<?php echo base_url() ?>index.php/posts/post?postid=" + m.get('PostId') + "'>" + m.get('Title') + "</span></a></div>" +

            "<div class='likediv' id='likediv" + m.get('PostId') + "'><i onclick='like(" + m.get('PostId') + ");' class='fa-regular fa-thumbs-up'></i></div></div>" +

            "<div class='captiondiv'>" +
            
            m.get('Caption') + "</div>" + 
            "<br>" + 

            "<div class='usernamediv'><a href='<?php echo base_url() ?>index.php/users/userprofile/?username=" + m.get('Username') + "'>" + 
                "<span>" + m.get('Username') + "</span></a></div>" + 
            "<br>" +
            "<div class='locationtag'>" + 
                "<div class='locationdiv'>" + 
                "<a href='<?php echo base_url() ?>index.php/posts/locations?locationid=" + m.get('LocationId') + "'>" + 
                "<span><i class='fa-solid'></i>" + m.get('LocationName') + 
            "</span></a></div></div>" + 

            "<div class='commentsdiv' id='commentsdiv" + m.get('PostId') + "'></div></div>";

            this.$el.html(html);
            //get comments for each post and display them
            $.ajax({
                url: "<?php echo base_url() ?>index.php/home/comments?postid="+m.get('PostId'),
                method: "GET"
            }).done(function (res) {
                if(res.length!==0){
                    for (i = 0; i < res.length; i++) {
                        if(i<2){
                            var div ="<span><a class='commuserlink' href='<?php echo base_url() ?>index.php/users/userprofile/?username="+res[i].Username+"'>"+"<br>"+res[i].Username+"</a>"
                            +res[i].CommentBody+"</span></br>";
                            $('#commentsdiv'+m.get('PostId')).append(div);
                        }
		          }
                }
            });
            $.ajax({//check if the user has already liked them or not and change color accordingly
                url: "<?php echo base_url() ?>index.php/home/checklikes?username="+username+"&postid="+m.get('PostId'),
                method: "GET"
            }).done(function (res) {
                if(res){
                    document.getElementById("likediv"+m.get('PostId')).style.color = "#e6b800";
                }
                else{
                    document.getElementById("likediv"+m.get('PostId')).style.color = "#666666";
                }
            });
        }
    });
    var postCollection = new PostCollection();
    var postDisplay = new PostDisplay({model: postCollection})

    //clicking on like buttons
    function like($postid){
        $.ajax({
                url: "<?php echo base_url() ?>index.php/home/like",
                data: JSON.stringify({username: username,postid:$postid}),
                contentType: "application/json",
                method: "POST"
        }).done(function (data) {
            $.ajax({
                url: "<?php echo base_url() ?>index.php/home/checklikes?username="+username+"&postid="+$postid,
                method: "GET"
            })
            .done(function (res) {
                if(res){
                    document.getElementById("likediv"+$postid).style.color = "#e6b800";
                }
                else{
                    document.getElementById("likediv"+$postid).style.color = "#666666";
                }
            });
        });
    }
</script>
</body>
</html>