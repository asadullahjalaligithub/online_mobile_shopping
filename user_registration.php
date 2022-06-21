<?php

include 'includes/connection.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <?php
include 'includes/header.php';
?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    .inputError {
        border: solid 1px red;
    }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row mt-3 p-5">
            <div class="col">
                <h1>Online Store Registration</h1>
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-3"></div>
            <div class="col-6">
                <form id="registrationForm">
                    <div class="form-group">
                        <label for="exampleFormControlInput1">FirstName</label>
                        <input type="text" class="form-control name" name="firstname" id="exampleFormControlInput1"
                            placeholder="Sharifullah">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput2">LastName</label>
                        <input type="text" class="form-control lastname" name="lastname" id="exampleFormControlInput2"
                            placeholder="Ahamdi">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput3">Username</label>
                        <input type="text" class="form-control username" name="username" id="exampleFormControlInput3"
                            placeholder="ahmadullah.khabere123">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput4">Password</label>
                        <input type="password" class="form-control password" name="password" placeholder="****"
                            id="exampleFormControlInput4">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput4">Email</label>
                        <input type="email" class="form-control email" name="email" id="exampleFormControlInput4"
                            placeholder="name@example.com">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput5">Address</label>
                        <input type="text" class="form-control address" name="address" id="exampleFormControlInput5"
                            placeholder="Afghanistan, Kabul">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput6">Date of Birth</label>
                        <input type="date" class="form-control dob" name="dob" id="exampleFormControlInput6">
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Register">
                    </div>
                </form>
            </div>
            <div class="col-3">
            </div>
        </div>
    </div>



    <?php

include 'includes/footer.php';

?>
    <script>
    $(document).ready(function() {
        $('#registrationForm').submit(function(e) {
            e.preventDefault();
            var name, lastname, dob, address, username, password, email;
            name = $('#registrationForm .name');
            lastname = $('#registrationForm .lastname');
            dob = $('#registrationForm .dob');
            username = $('#registrationForm .username');
            password = $('#registrationForm .password');
            email = $('#registrationForm .email');
            address = $('#registrationForm .address');
            name.removeClass('inputError');
            lastname.removeClass('inputError');
            dob.removeClass('inputError');
            address.removeClass('inputError');
            username.removeClass('inputError');
            password.removeClass('inputError');
            email.removeClass('inputError');
            if (name.val() == "")
                name.addClass('inputError');
            else if (username.val() == "")
                username.addClass('inputError');
            else if (lastname.val() == "")
                lastname.addClass('inputError');
            else if (password.val() == "")
                password.addClass('inputError');
            else if (email.val() == "")
                email.addClass('inputError');
            else if (address.val() == "")
                address.addClass('inputError');
            else if (dob.val() == "")
                dob.addClass('inputError');
            else {
                $.ajax({
                    url: 'includes/process.php',
                    type: 'post',
                    data: {
                        name: name.val(),
                        lastname: lastname.val(),
                        username: username.val(),
                        password: password.val(),
                        email: email.val(),
                        dob: dob.val(),
                        address: address.val(),
                        actionString: "UserRegistration"
                    },
                    success: function(response) {
                        if (response.trim() == "true") {
                            $(location).attr('href', 'index.php');
                        } else {
                            $('#messageModal').modal('show');
                            $('#messageModal .modal-body').html(
                                "Failed to register the User { Duplicate email is not allowed"
                            );
                        }
                    }
                });
            }
        });
    });
    </script>
</body>

</html>