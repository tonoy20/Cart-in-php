
jQuery('#regis').validate ({
    rules:{
        r_name: "required",
        r_email: {
            required: true,
            email: true
        },
        r_pass: {
            required: true,
            minlength: 3
        },
        r_repass: {
            required: true,
        }
    }, messages: {
        r_name: "Please Enter name",
        r_email: {
            required: "Please enter email",
            email: "Please enter valid email"
        },
        r_pass: {
            required: "Please Enter name",
            minlength: "password must be more than or equal to 3 characters"
        },
        r_repass: {
            required: "Enter password"
        },
    },
    submitHandler:function(form) {
        form.submit();
    }
})