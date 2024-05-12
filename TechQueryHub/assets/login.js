//check if all inputs are not empty
function checkinputs() {
    if (document.forms["loginform"]["username"].value != "" && document.forms["loginform"]["password"].value != "") {
        document.getElementById('login').disabled = false;
    }
    else{
        document.getElementById('login').disabled = true;
    }
}
$(document).ready(function () {
    //when login is clicked
    $('#login').click(function (event) {
        event.preventDefault();
        userLogin();
    });
});
var Login = Backbone.Model.extend({
    url:"<?php echo base_url()?>index.php/users/user/action/login"
});
var LoginCollection = Backbone.Collection.extend({
    model: Login,
});
var loginCollection = new LoginCollection();
function userLogin() {
    var newLogin = new Login();
    newLogin.set('username', "@"+$("#username").val().toLowerCase());//username is converted to lowercase
    newLogin.set('password', $("#password").val());
    loginCollection.create(newLogin,{
        success: function(response){
            var result=response.changed.result;
            if (result=="success") {//redirect to home on success
                location.href="<?php echo base_url()?>index.php/home/";  
            } else {//else redirect back to login
                location.href="<?php echo base_url()?>index.php/users/login";
            }
        }
    });
}