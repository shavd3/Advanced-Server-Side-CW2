<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- External JavaScript libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/backbone.js/1.2.3/backbone-min.js" type="text/javascript"></script>
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/b9008b61cc.js" crossorigin="anonymous"></script>
    <!-- CSS file -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>css/categories.css">
</head>

<body>
<div class="tagcontainer">
    <!-- Container for tag list -->
    <div class="taglistdiv">
        <!-- Tag name display -->
        <span id='tagname'></span>
        <!-- Tag list -->
        <div id="taglist"></div>
    </div>
    <!-- Container for questions related to the tag -->
    <div class="questiontagdiv"></div>
</div>

    <script type="text/javascript" lang="javascript">
        // Get tag ID from PHP
        var tagId="<?php echo $tagid ?>";

        $(document).ready(function () {
            event.preventDefault();
            // AJAX request to get tag name and display it
            $.ajax({
                url: "<?php echo base_url() ?>index.php/questions/tags/action/id?tagid="+tagId,
                method: "GET"
            }).done(function (data) {
                document.getElementById("tagname").innerHTML = "<i class='fa-solid fa-microchip'></i>"+data.TagName;
            });

            // AJAX request to get list of tags
            $.ajax({
                url: "<?php echo base_url() ?>index.php/questions/tags/action/all",
                method: "GET"
            }).done(function (data) {
                // Display a range of tags before and after the current tag
                for (i = (tagId-20); i < (+tagId+20); i++) {
                    if(data[i]!=null){// Display few other tags in the list
                        var span ="<a href='<?php echo base_url() ?>index.php/questions/tagView?tagid="
                            +data[i].TagId+"'><span>"+data[i].TagName+"</span></a></br>";
                        $('#taglist').append(span);
                    }
                }
            });

            // Backbone fetch to get the questions
            postCollection.fetch();
        });

        // Backbone Collection for Posts
        var PostCollection = Backbone.Collection.extend({
            url: "<?php echo base_url() ?>index.php/questions/tagQuestions?tagid="+tagId,
        });

        var html = "";
        // Backbone View for displaying posts
        var PostDisplay = Backbone.View.extend({
            el: ".questiontagdiv",
            initialize: function () {
                this.listenTo(this.model, "add", this.showResults);
            },
            showResults: function (m) {
                // Construct HTML for displaying questions
                html +=
                    "<div class='questionboxdiv'><a href='<?php echo base_url() ?>index.php/questions/question?questionid="
                        + m.get('QuestionId') + "'>" +
                    "<div class='titlediv'><a href='<?php echo base_url() ?>index.php/questions/question?questionid="
                        + m.get('QuestionId')
                        + "'>" + m.get('Title') + "</span></a></div>" +
                    "<div class='descdiv'>"
                        + m.get('Description') + "</div><br>" +
                    "</div>";

                this.$el.html(html);
            }
        });

        var postCollection = new PostCollection();
        var postDisplay = new PostDisplay({model: postCollection})
    </script>
</body>
</html>
