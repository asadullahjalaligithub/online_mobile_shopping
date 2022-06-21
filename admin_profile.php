<?php require('includes/admin-authentication.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('includes/header.php'); ?>
    <link rel="stylesheet" type="text/css" href="css/datatable-css.css">
    <style>
    .inputError {
        border: solid 1px red;
    }
    </style>
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <?php include('includes/sidebar.php'); ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper">


            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include('includes/top-nav.php'); ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <div class="row mt-3 p-5">
                        <div class="col">
                            <h1>Edit Profile</h1>
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-3"></div>
                        <div class="col-6">
                            <form id="updateForm">
                                <input type='hidden' value="<?php echo $_SESSION['userid']; ?>" name='userid'
                                    class='userid'>
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">FirstName</label>
                                    <input type="text" class="form-control name"
                                        value="<?php echo $_SESSION['name']; ?>" name="firstname"
                                        id="exampleFormControlInput1" placeholder="Sharifullah">
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlInput2">LastName</label>
                                    <input type="text" class="form-control lastname"
                                        value="<?php echo $_SESSION['surname']; ?>" name="lastname"
                                        id="exampleFormControlInput2" placeholder="Ahamdi">
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlInput3">Username</label>
                                    <input type="text" class="form-control username"
                                        value="<?php echo $_SESSION['username']; ?>" name="username"
                                        id="exampleFormControlInput3" placeholder="ahmadullah.khabere123">
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlInput4">Password</label>
                                    <input type="password" class="form-control password"
                                        value="<?php echo $_SESSION['password']; ?>" name="password" placeholder="****"
                                        id="exampleFormControlInput4">
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlInput4">Email</label>
                                    <input type="email" class="form-control email"
                                        value="<?php echo $_SESSION['email']; ?>" name="email"
                                        id="exampleFormControlInput4" placeholder="name@example.com">
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlInput5">Address</label>
                                    <input type="text" class="form-control address"
                                        value="<?php echo $_SESSION['address']; ?>" name="address"
                                        id="exampleFormControlInput5" placeholder="Afghanistan, Kabul">
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlInput6">Date of Birth</label>
                                    <input type="date" class="form-control dob" value="<?php echo $_SESSION['dob']; ?>"
                                        name="dob" id="exampleFormControlInput6">
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-primary" value="Register">
                                </div>
                            </form>
                        </div>
                        <div class="col-3">
                        </div>
                    </div>


                    <!-- data table plugin example -->





                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; by Marzia Rahimi</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <?php include('includes/footer.php'); ?>
    <!-- Modal -->



    <script src=" js/datatable-js.js"></script>
    <script>
    $(document).ready(function() {

        $('#updateForm').submit(function(e) {
            e.preventDefault();
            var name, lastname, dob, address, username, password, email;
            name = $('#updateForm .name');
            lastname = $('#updateForm .lastname');
            dob = $('#updateForm .dob');
            username = $('#updateForm .username');
            password = $('#updateForm .password');
            email = $('#updateForm .email');
            address = $('#updateForm .address');
            name.removeClass('inputError');
            lastname.removeClass('inputError');
            dob.removeClass('inputError');
            address.removeClass('inputError');
            username.removeClass('inputError');
            password.removeClass('inputError');
            userid = $('#updateForm .userid');
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
                        userid: userid.val(),
                        actionString: "adminUpdateProfile"
                    },
                    success: function(response) {
                        if (response.trim() == "true") {
                            $(location).attr('href', 'index.php');
                        } else {
                            $('#messageModal').modal('show');
                            $('#messageModal .modal-body').html(
                                "Record Updated Successfully!"
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