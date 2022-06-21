<?php 
require('includes/connection.php');
if(isset($_GET['logout']) && $_GET['logout']=='true')
{
    session_destroy();
}
else if(isset($_SESSION['privilage']) && $_SESSION['privilage']!='admin')
{
    header('location:admin_profile.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <?php include'includes/header.php'?>
    <style>
    .inputError {
        border: solid 1px red;
    }
    </style>

</head>

<body class="bg-gradient-primary">

    <div class="container">
        <div class="row mt-5 text-center text-white">
            <div class="col">
                <a href="index.php" class="text-white">
                    <h1>Online Mobile Store</h1>
                </a>
            </div>
        </div>
        <!-- Outer Row -->
        <div class="row justify-content-center mt-5">
            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                    <form class="user">
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user username"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Enter username or email address">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user password"
                                                id="exampleInputPassword" placeholder="Password">
                                        </div>

                                        <button type='button' class="btn btn-primary btn-user btn-block loginButton">
                                            Login
                                        </button>
                                        <hr>
                                        <div class="text-center">

                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
    <div class="modal fade" id="messageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger" id="exampleModalLabel">Message</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss='modal'>Close</button>
                </div>
            </div>
        </div>
    </div>
    <?Php include'includes/footer.php'?>
    <script>
    $(document).ready(function() {
        $('.loginButton').click(function() {
            var username, password;
            username = $('form.user .username');
            password = $('form.user .password');
            username.removeClass('inputError');
            password.removeClass('inputError');
            if (username.val().trim() == 0)
                username.addClass('inputError');
            else if (password.val().trim() == 0)
                password.addClass('inputError');
            else {
                $.ajax({
                    url: 'includes/process.php',
                    type: 'post',
                    data: {
                        username: username.val(),
                        password: password.val(),
                        actionString: "loginAdmin"
                    },
                    success: function(response) {
                        if (response.trim() == "true") {
                            $(location).attr('href', 'admin_profile.php');
                        } else {
                            $('#messageModal').modal('show');
                            $('#messageModal .modal-body').text(
                                "Wrong Username or Password");
                        }
                    }
                });
            }
        });
    });
    </script>

</body>

</html>