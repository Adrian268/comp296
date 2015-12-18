
$('#RegisterForm').validate({
    rules:{
    name:{
    letterswithbasicpunc: true
    },
    password:{
    alphanumeric: true
    },
    password_confirm:{
    equalTo: "#password"
    },
    email:{
    remote: "util/validate_email.php"
    }
    },
    messages:{
    password_confirm:{
    equalTo: "Passwords do not match."
    },
    email:{
    remote: "Sorry, an account with that email already exists."
    }
    },
    errorPlacement: function(error, element) {
    error.insertBefore(element);
    }
    });
