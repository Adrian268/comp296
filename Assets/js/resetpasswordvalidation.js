$('#ResetPasswordForm').validate({
    rules:{
        new_password_cf:{
            equalTo: "#new_password"
        }
    },
    messages:{
        new_password_cf:{
            equalTo: "Passwords do not match."
        }
    },
    errorPlacement: function(error, element) {
        error.insertBefore(element);
    }
});
