<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>TechQueryHub</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js" type="text/javascript"></script>
<!--    <link rel="preconnect" href="https://fonts.googleapis.com">-->
<!--    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>-->
<!--    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300..700&display=swap" rel="stylesheet">-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>css/navigation.css">
</head>
<body>
    <div class="navigationupperdiv">
        <div class="logodiv">
            <a href="<?php echo base_url()?>index.php/home">
                <div class="navname">
                    <a href="<?php echo base_url()?>index.php/home"><span> HOME </span></a>
                </div>
            </a>
        </div>
        <div class="logodiv">
            <div class="navname">
                <a href="<?php echo base_url()?>index.php/questions"><span> QUESTION </span></a>
            </div>
        </div>
        <div class="logodiv">
            <div class="navname">
                <a href="<?php echo base_url()?>index.php/questions/tagView?tagid=1"><span> TAGS </span></a>
            </div>
        </div>
        <div class="logodiv">
            <div class="navname fa-solid fa-user">
                <a href="<?php echo base_url()?>index.php/myprofile" class="profilelink"><span><?php echo $username ?></span></a>
            </div>
        </div>
    </div>

    <div class="navigationdiv">
        <div class="askdiv">
            <div class="askname"><a href="<?php echo base_url()?>index.php/questions"><span> ASK </span></a></div>
        </div>
        <div class="searchdiv">
            <input type="text" class="search" id="search" placeholder="Search for question..." onkeyup='searchusers()'/>
        </div>
        <div class="logomaindiv">
                <div class="logoname">
                    <a href="<?php echo base_url()?>index.php/home"><span> TechQueryHub </span></a>
                </div>
            <div class="logoname">
                <a href="<?php echo base_url()?>index.php/home">
                    <img class="logoimage" src="<?php echo base_url() ?>images/new.png" alt="Logo" />
                </a>
            </div>
        </div>
    </div>
    <!-- search overlays -->
    <div class="searchresults" id="searchresults"></div>

    <script type="text/javascript" lang="javascript">
         var username="<?php echo $username ?>";
         function searchusers() {
              if($('#search').val().length==0){
                   document.getElementById("searchresults").style.display = "none";
              }
              else{//overlay only displayed when something is typed
                   document.getElementById("searchresults").style.display = "block";
              }
              var userdata = {
                    title: $('#search').val().toLowerCase()
              };
              $.ajax({//get questions from the search string
                    url: "<?php echo base_url() ?>index.php/users/user/action/searchuser",
                    data: JSON.stringify(userdata),
                    contentType: "application/json",
                    method: "POST"
                }).done(function (data) {
                   $('#searchresults div').remove();
                   $('#searchresults a').remove();
                   if(data.length==0){//display no results if array length is 0
                        var div ="<div class ='user noresult'>No Results</div>";
                        $('#searchresults').append(div);
                   }
                   else{
                        for (i = 0; i < data.length; i++) {
                             var div ="<a class='userlinks' href='<?php echo base_url() ?>index.php/questions/question?questionid="
                             +data[i].QuestionId+"'><div class ='user'><div class='searuserdeet'>"+data[i].Title+"<br></div></div></a>";
                             $('#searchresults').append(div);
                        }
                   }
              });
         }
    </script>
</body>
</html>