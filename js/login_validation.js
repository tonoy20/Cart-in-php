$(function(){
    var $login = $('#login_form');
    if($login.length) {
        $login.validate({
            rules: {
                username: {
                    required: true
                },
                password: {
                    required: true
                }
            },
            messages: {
                username : {
                    required: "Enter username"
                },
                password: {
                    required: "Enter password"
                }
            }
        })
    }     
})