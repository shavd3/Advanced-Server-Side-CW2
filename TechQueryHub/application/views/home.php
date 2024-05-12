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
    <div class='notfollowing'>
        <div class='heading'></div>
        <div class='userlisting'></div>
    </div>
<div>

<script type="text/javascript" lang="javascript">
    var username="<?php echo $username ?>";
    $(document).ready(function () {
        event.preventDefault();
        // $.ajax({//get follow count
        //     url: "<?php echo base_url() ?>index.php/myprofile/followcount?username="+username,
        //     method: "GET"
        // }).done(function (data) {
        //     // if (data.following==0){//if follow count is 0, display no posts and suggest users to follow
        //         // $.ajax({
        //         //     url: "<?php echo base_url() ?>index.php/users/user",
        //         //     method: "GET"
        //         // }).done(function (data) {
        //         //     for (i = 0; i < 5; i++) {
        //         //         var div ="<a href='<?php echo base_url() ?>index.php/users/userprofile/?username="
        //         //          +data[i].Username+"'><div class='users'><div class= 'profilepicdiv'><img class='profilepic' src='<?php echo base_url() ?>images/profilepics/"
        //         //          +data[i].UserImage+"'/></div>"+data[i].Username+"</br>"+data[i].Name+"</div></a>";
        //         //         $('.userlisting').append(div);
        //         //     } 
        //         // });
        //     //}
        //     // else{
        //     //     $('.notfollowing').remove(); 
        //     // }
        // });
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
            // html = html + "<div class='postdiv'><div class='locationdiv'><a href='<?php echo base_url() ?>index.php/posts/locations?locationid="
            // + m.get('LocationId') +"'><span><i class='fa-solid fa-location-dot'></i>"
            // + m.get('LocationName') +"</span></a></div><div class='userlikediv'><div class='usernamediv'><a href='<?php echo base_url() ?>index.php/users/userprofile/?username="
            // + m.get('Username') +"'><span>"+ m.get('Username') +"</span></a></div><div class='likediv' id='likediv"
            // + m.get('PostId') +"'><i onclick='like("+m.get('PostId')+");' class='fa-solid fa-heart'></i></div></div><div class='captiondiv'>"
            // + m.get('Title') + "<br>"
            // + m.get('Caption')+"</div><div class='commentsdiv' id='commentsdiv"
            // + m.get('PostId') +"'></div></div>";

            html += "<div class='postdiv'>" + 

            "<div class='userlikediv'>" + 
            "<div class='usernamediv'><a href='<?php echo base_url() ?>index.php/users/userprofile/?username=" + m.get('Username') + "'>" + 
            "<span>" + m.get('Username') + "</span></a></div>" + 

            "<div class='likediv' id='likediv" + m.get('PostId') + "'><i onclick='like(" + m.get('PostId') + ");' class='fa-solid fa-solid fa-star-half-stroke'></i></div></div>" + 

            "<div class='captiondiv'>" + 

            "<a href='<?php echo base_url() ?>index.php/posts/post?postid=" + m.get('PostId') + "'>"
             + m.get('Title') + "</span></a>" +
            "<br>" + 
            m.get('Caption') + "</div>" + 

            "<div class='locationdiv'>" + 
                "<a href='<?php echo base_url() ?>index.php/posts/locations?locationid=" + m.get('LocationId') + "'>" + 
                "<span><i class='fa-solid'></i>" + m.get('LocationName') + 
            "</span></a></div>" + 

            "<div class='commentsdiv' id='commentsdiv" + m.get('PostId') + "'></div></div>";

            this.$el.html(html);
            //get comments for each post and display them
            $.ajax({
                url: "<?php echo base_url() ?>index.php/home/comments?postid="+m.get('PostId'),
                method: "GET"
            }).done(function (res) {
                if(res.length!=0){             
                    for (i = 0; i < res.length; i++) {
                        if(i<2){
                            var div ="<span><a class='commuserlink' href='<?php echo base_url() ?>index.php/users/userprofile/?username="+res[i].Username+"'>"+res[i].Username+"</a>"
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
                    document.getElementById("likediv"+m.get('PostId')).style.color = "#FC6464";
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