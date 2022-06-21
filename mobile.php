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
                    <div class="row my-3">
                        <div class="col text-center">
                            <h3>Manage Mobile Records</h3>
                        </div>
                    </div>
                    <div class="row my-3">
                        <div class="col">
                            <form id="inputForm">
                                <div class="row">
                                    <div class="col">
                                        <input type="text" class="form-control brand" placeholder="Brand" name="brand">
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control series" placeholder="Series"
                                            name="series">
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control model" placeholder="Model" name="model">
                                    </div>
                                </div>
                                <div class="row my-3">
                                    <div class="col-4">
                                        <input type="text" class="form-control color" placeholder="Color" name="color">
                                    </div>
                                    <div class="col-8">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"> Mobile Image</span>
                                            </div>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input mobileImage"
                                                    name="mobileImage" id="inputGroupFile01"
                                                    accept="image/x-png,image/gif,image/jpeg">
                                                <label class="custom-file-label" id="label"
                                                    for="inputGroupFile01">Choose
                                                    file</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-2">
                                        <input type="submit" class="btn btn-primary saveButton" value="Save">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>


                    <!-- data table plugin example -->
                    <table class="table table-tabular table-striped display" id="tableRecords">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Brand</th>
                                <th>Series</th>
                                <th>Model</th>
                                <th>Color</th>
                                <th>Image</th>
                                <th>Action</th>
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
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Message</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class=".">
                        <input type="hidden" class="mobileid" name="mobileid">
                        <div class="row">
                            <div class="col">
                                <input type="text" class="form-control brand" placeholder="Brand" name="brand">
                            </div>
                            <div class="col">
                                <input type="text" class="form-control series" placeholder="Series" name="series">
                            </div>
                            <div class="col">
                                <input type="text" class="form-control model" placeholder="Model" name="model">
                            </div>
                        </div>
                        <div class="row my-3">
                            <div class="col-4">
                                <input type="text" class="form-control color" placeholder="Color" name="color">
                            </div>
                            <div class="col-8">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> Mobile Image</span>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input mobileImage" name="mobileImage"
                                            id="inputGroupFile01" accept="image/x-png,image/gif,image/jpeg">
                                        <label class="custom-file-label" for="inputGroupFile01">Choose
                                            file</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2">
                                <input type="submit" class="btn btn-success updateButton" value="Update">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-ordinary" data-dismiss='modal'>Close</button>
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
    <script src="js/bs.custom-file.js"></script>
    <script>
    // validating the file type function
    function validateFileType(fileName) {
        var dot = fileName.lastIndexOf(".") + 1;
        var extentionFile = fileName.substr(dot, fileName.length).toLowerCase();
        if (extentionFile == "jpg" || extentionFile == "jpeg" || extentionFile == "png")
            return true;
        else
            return false;
    }
    $(document).ready(function() {
        // initiating the custom file input
        bsCustomFileInput.init();

        var Records = $('#tableRecords').DataTable({
            ajax: {
                url: 'includes/process.php',
                dataSrc: "",
                type: 'post',
                data: {
                    actionString: "loadMobile"
                },
            },
        });


        // save request
        $('#inputForm').on('submit', function(e) {
            e.preventDefault();
            var brand, series, color, model;
            brand = $('#inputForm .brand');
            series = $('#inputForm .series');
            color = $('#inputForm .color');
            model = $('#inputForm .model');
            image = $('#inputForm .mobileImage');
            imageBox = $('#inputForm .custom-file-label');
            brand.removeClass('inputError');
            series.removeClass('inputError');
            color.removeClass('inputError');
            model.removeClass('inputError');
            imageBox.removeClass('inputError');
            if (brand.val().trim() == "")
                brand.addClass('inputError');
            else if (series.val().trim() == "")
                series.addClass('inputError');
            else if (model.val().trim() == "")
                model.addClass('inputError');
            else if (color.val().trim() == "")
                color.addClass('inputError');
            else if (validateFileType(image.val()) == false || image.val().trim() == "")
                imageBox.addClass('inputError');
            else {
                var data = new FormData(this);
                data.append('actionString', 'insertionMobile');
                $.ajax({
                    type: "post",
                    url: "includes/process.php",
                    data: data,
                    cache: false,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.trim() == "true") {
                            $('#inputForm')[0].reset();
                            $('#messageModal').modal('show');
                            $('#messageModal .modal-body').text('Record Saved!');
                            Records.ajax.reload();
                        } else {
                            $('#messageModal').modal('show');
                            $('#messageModal .modal-body').text(
                                'Duplicate Brand name is not allowed!');
                        }
                    }
                });
            }
        });
        // edit request
        $('#tableRecords').on('click', '.editButton', function() {
            var value = $(this).val();
            $.ajax({
                type: "post",
                dataType: 'json',
                url: "includes/process.php",
                data: {
                    actionString: 'getMobile',
                    value: value
                },
                success: function(response) {
                    $('#editModal .mobileid').val(response.mobileid);
                    $('#editModal .brand').val(response.mobilebrand);
                    $('#editModal .color').val(response.mobilecolor);
                    $('#editModal .series').val(response.mobileseries);
                    $('#editModal .model').val(response.mobilemodel);
                    $('#editModal').modal('show');
                }
            });

        });

        // update request 
        $('.updateForm').on('submit', function(e) {
            e.preventDefault();
            var brand, series, color, model, id;
            id = $('.. .mobileid');
            brand = $('.updateForm .brand');
            series = $('.updateForm .series');
            color = $('.updateForm .color');
            model = $('.updateForm .model');
            image = $('.updateForm .mobileImage');
            imageBox = $('.updateForm .custom-file-label');
            brand.removeClass('inputError');
            series.removeClass('inputError');
            color.removeClass('inputError');
            model.removeClass('inputError');
            imageBox.removeClass('inputError');
            if (brand.val().trim() == "")
                brand.addClass('inputError');
            else if (series.val().trim() == "")
                series.addClass('inputError');
            else if (model.val().trim() == "")
                model.addClass('inputError');
            else if (color.val().trim() == "")
                color.addClass('inputError');
            else if (image.val() != "" && validateFileType(image.val()) == false)
                imageBox.addClass('inputError');
            else {
                var data = new FormData(this);
                data.append('actionString', 'updateMobile');
                $.ajax({
                    type: "post",
                    url: "includes/process.php",
                    data: data,
                    cache: false,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.trim() == "true") {
                            $('.updateForm')[0].reset();
                            $('#editModal').modal('hide');
                            $('#messageModal').modal('show');
                            $('#messageModal .modal-body').text('Record Updated!');
                            Records.ajax.reload();
                        } else {

                            $('#editModal').modal('hide');
                            $('#messageModal').modal('show');
                            $('#messageModal .modal-body').text(
                                'Duplicate Brand name is not allowed!');
                        }
                    }
                });
            }
        });

        // delete request
        // edit request
        $('#tableRecords').on('click', '.deleteButton', function() {
            var value = $(this).val();
            $('#deleteModal').modal('show');
            $('#deleteModal .deleteConfirmButton').click(function() {
                $.ajax({
                    type: "post",
                    url: "includes/process.php",
                    data: {
                        actionString: 'deleteMobile',
                        value: value
                    },
                    success: function(response) {
                        if (response.trim() == "true") {
                            $('#deleteModal').modal('hide');
                            $('#messageModal').modal('show');
                            $('#messageModal .modal-body').text(
                                'Record Deleted Successfully!');
                            Records.ajax.reload();
                        } else {

                            $('#deleteModal').modal('hide');
                            $('#messageModal').modal('show');
                            $('#messageModal .modal-body').text(
                                'Failed to Delete; Seems Some Mobile Records are associated with this Brand!'
                            );
                        }
                    }
                });

            });

        });

        // initiating jquery data table
        // $('#mytable').DataTable();
    });
    </script>
</body>

</html>