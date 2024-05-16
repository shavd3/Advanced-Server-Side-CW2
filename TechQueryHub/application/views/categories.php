<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/backbone.js/1.2.3/backbone-min.js" type="text/javascript"></script>
    <script src="https://kit.fontawesome.com/b9008b61cc.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>css/categories.css">
</head>

<body>
    <div class="locationcontainer">

        <div class="locationlistdiv">
            <span id='locationname'></span>
            <div id="locationlist"> </div>
        </div>

        <div class="postlocadiv"></div>
    </div>

<script type="text/javascript" lang="javascript">
    var tagId="<?php echo $tagid ?>";    
    $(document).ready(function () {
        event.preventDefault();
        $.ajax({//get all posts from the given location id at start and display the posts
            url: "<?php echo base_url() ?>index.php/posts/tags/action/id?tagid="+tagId,
            method: "GET"
            })
            .done(function (data) {
                document.getElementById("locationname").innerHTML = "<i class='fa-solid fa-microchip'></i>"+data.TagName;
            });
        $.ajax({
            url: "<?php echo base_url() ?>index.php/posts/tags/action/all",
            method: "GET"
        })
        .done(function (data) {
            for (i = (tagId-20); i < (+tagId+20); i++) {
                if(data[i]!=null){//display few other locations in the list for easier browsing
                    var span ="<a href='<?php echo base_url() ?>index.php/posts/tagView?tagid="
                    +data[i].TagId+"'><span>"+data[i].TagName+"</span></a></br>";
			        $('#locationlist').append(span);
                }
		    }  
        });
        postCollection.fetch();//backbone fetch to get the posts
    });

    var PostCollection = Backbone.Collection.extend({
        url: "<?php echo base_url() ?>index.php/posts/tagQuestions?tagid="+tagId,
    });

    var html = "";
    var PostDisplay = Backbone.View.extend({
        el: ".postlocadiv",
        initialize: function () {
            this.listenTo(this.model, "add", this.showResults);
        },
        showResults: function (m) {

            html = html + "<div class='postimagediv'><a href='<?php echo base_url() ?>index.php/posts/post?postid="
                + m.get('QuestionId') + "'>"
                + "<div class='titlediv'><a href='<?php echo base_url() ?>index.php/posts/post?postid=" + m.get('QuestionId')
                + "'>" + m.get('Title') + "</span></a></div>" +

                "<div class='captiondiv'>" +

                m.get('Description') + "</div><br>" +

                "</div>";

            this.$el.html(html);
        }
    });

    var postCollection = new PostCollection();
    var postDisplay = new PostDisplay({model: postCollection})

</script>
</body>
</html>