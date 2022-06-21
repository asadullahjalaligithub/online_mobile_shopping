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



                    <!-- data table plugin example -->
                    <table class="table table-tabular table-striped display" id="tableRecords">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Brand</th>
                                <th>Model</th>
                                <th>Series</th>
                                <th>Color</th>
                                <th>Stock Amount</th>
                            </tr>
                        </thead>

                    </table>





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
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Message</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="updateForm">
                        <input type="hidden" class="mobileid">
                        <div class="row">
                            <div class="col">
                                <input type="text" class="form-control brand" placeholder="Brand">
                            </div>
                            <div class="col">
                                <input type="text" class="form-control series" placeholder="Series">
                            </div>
                            <div class="col">
                                <input type="text" class="form-control model" placeholder="Model">
                            </div>
                        </div>
                        <div class="row my-3">
                            <div class="col-4">
                                <input type="text" class="form-control color" placeholder="Color">
                            </div>
                            <div class="col-2">
                                <input type="button" class="btn btn-success updateButton" value="Update">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-ordinary" data-dismiss='modal'>Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                    <h5>Are you Sure want to delete this Record?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger deleteConfirmButton">Confirm</button>
                </div>
            </div>
        </div>
    </div>


    <script src="js/datatable-js.js"></script>
    <script>
    $(document).ready(function() {
        var Records = $('#tableRecords').DataTable({
            ajax: {
                url: 'includes/process.php',
                dataSrc: "",
                type: 'post',
                data: {
                    actionString: "loadStock"
                },
            },
        });



    });

    function getText(event) {
        $('#mobileSearch').html("");
        $('.inputForm .mobile').val(event.textContent);
    }
    </script>
</body>

</html>