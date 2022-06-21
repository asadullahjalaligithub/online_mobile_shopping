<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <?php
include 'includes/header.php';
?>
</head>

<body>

    <div class="p-5 mb-4 bg-light rounded-3">

        <div class="container-fluid py-5">

            <h1 class="display-5 fw-bold text-primary">Mobile Online Store</h1>

            <p class="fs-4 text-dark">This is simple Mobile Online Store System which use for maintain the record of the
                Mobile Store.
                This
                Mobile Online Store System has been made by using PHP script, MySQL Database, JavaScript, jQuery and
                Bootstrap
                5 framework. This is PHP Project on Online Mobile Store System.</p>

        </div>

    </div>

    <div class="row p-3">

        <div class="col-md-6">

            <div class="h-100 p-5 text-white bg-primary rounded-3">

                <h2>Admin Login</h2>
                <p></p>
                <a href="admin_login.php" class="btn btn-outline-light">Admin Login</a>

            </div>

        </div>

        <div class="col-md-6">

            <div class="h-100 p-5 bg-light border rounded-3">

                <h2>User Login</h2>

                <p></p>

                <a href="user_login.php" class="btn btn-outline-secondary">User Login</a>

                <a href="user_registration.php" class="btn btn-outline-primary">User Sign Up</a>

            </div>

        </div>

    </div>

    <?php

include 'includes/footer.php';

?>

</body>

</html>