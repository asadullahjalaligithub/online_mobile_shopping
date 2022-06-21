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

    .frame {
        overflow: scroll;
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
                    <div class="row my-3">
                        <div class="col text-center">
                            <h3> Sale Records</h3>
                        </div>
                    </div>
                    <div class="row my-3">

                    </div>


                    <div class="row">
                        <div class="col frame">
                            <!-- data table plugin example -->
                            <table class="table table-tabular table-striped display" id="tableRecords">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Address</th>
                                        <th>Brand</th>
                                        <th>Series</th>
                                        <th>Model</th>
                                        <th>Color</th>
                                        <th>Date</th>
                                        <th>Amount</th>
                                        <th>Price</th>
                                        <th>Image</th>
                                    </tr>
                                </thead>

                            </table>
                        </div>
                    </div>





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





    <script src="js/datatable-js.js"></script>
    <script src="js/bs.custom-file.js"></script>
    <script>
    // validating the file type function

    $(document).ready(function() {


        var Records = $('#tableRecords').DataTable({
            ajax: {
                url: 'includes/process.php',
                dataSrc: "",
                type: 'post',
                data: {
                    actionString: "loadSalesAdmin"
                },
            },
        });

    });
    </script>
</body>

</html>