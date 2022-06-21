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
                            <h3>Manage Purchase Records</h3>
                        </div>
                    </div>
                    <div class="row my-3">
                        <div class="col">
                            <form class="inputForm">
                                <div class="row">
                                    <div class="col-6 mb-3">
                                        <input type="text" class="form-control mobile" placeholder="search for Mobile">
                                        <span id="mobileSearch"></span>
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control price" placeholder="Price">
                                    </div>
                                    <div class="col">
                                        <input type="date" class="form-control date">
                                    </div>
                                </div>
                                <div class="row my-3">
                                    <div class="col-4">
                                        <input type="number" class="form-control amount" placeholder="Amount">
                                    </div>
                                    <div class="col-2">
                                        <input type="button" class="btn btn-primary saveButton" value="Save">
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
                                <th>Date</th>
                                <th>Amount</th>
                                <th>Price</th>
                                <th>brand</th>
                                <th>color</th>
                                <th>mobdel</th>
                                <th>series</th>
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
                    actionString: "loadPurchase"
                },
            },
        });


        // save request
        $('.inputForm .saveButton').click(function() {
            var price, date, amount, mobile;
            price = $('.inputForm .price');
            date = $('.inputForm .date');
            amount = $('.inputForm .amount');
            mobile = $('.inputForm .mobile');
            price.removeClass('inputError');
            date.removeClass('inputError');
            amount.removeClass('inputError');
            mobile.removeClass('inputError');
            if (price.val().trim() == "")
                price.addClass('inputError');
            else if (date.val().trim() == "")
                date.addClass('inputError');
            else if (mobile.val().trim() == "")
                mobile.addClass('inputError');
            else if (amount.val().trim() == "")
                amount.addClass('inputError');
            else {
                $.ajax({
                    type: "post",
                    url: "includes/process.php",
                    data: {
                        price: price.val(),
                        date: date.val(),
                        amount: amount.val(),
                        mobile: mobile.val(),
                        actionString: 'insertionPurchase'
                    },
                    success: function(response) {
                        if (response.trim() == "true") {
                            $('.inputForm')[0].reset();
                            $('#messageModal').modal('show');
                            $('#messageModal .modal-body').text('Record Saved!');
                            Records.ajax.reload();
                        } else {
                            $('#messageModal').modal('show');
                            $('#messageModal .modal-body').text(
                                'failed to save purchase record');
                        }
                    }
                });
            }
        });


        // delete request
        $('#tableRecords').on('click', '.deleteButton', function() {
            var value = $(this).val();
            $('#deleteModal').modal('show');
            $('#deleteModal .deleteConfirmButton').click(function() {
                $.ajax({
                    type: "post",
                    url: "includes/process.php",
                    data: {
                        actionString: 'deletePurchase',
                        purchaseid: value
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
                                'Failed to Delete'
                            );
                        }
                    }
                });

            });

        });
        $('.inputForm .mobile').on('keyup', function() {
            if ($(this).val().length > 0) {
                $.ajax({
                    url: 'includes/process.php',
                    type: 'post',
                    dataType: 'json',
                    data: {
                        actionString: 'searchMobile',
                        key: $(this).val()
                    },
                    success: function(response) {
                        var html =
                            '<div class="list-group" style="position:absolute; width:90%; z-index:100">';
                        if (response.length > 0) {
                            for (var count = 0; count < response.length; count++) {
                                html +=
                                    '<a href="#" class="list-group-item list-group-item-action"><span onclick="getText(this)">' +
                                    response[count].mobileid + ' ' + response[count]
                                    .mobilebrand + ' ' + response[count].mobileseries +
                                    ' ' + response[count].mobilemodel + ' ' + response[
                                        count].mobilecolor + '</span></a>';
                            }
                        } else {
                            html +=
                                '<a href="#" class="list-group-item list-group-item-action">No Book Found</a>';
                        }
                        html += "</div>";
                        $('#mobileSearch').html(html);
                    }
                });
            } else
                $('#mobileSearch').html(html);
        });


    });

    function getText(event) {
        $('#mobileSearch').html("");
        $('.inputForm .mobile').val(event.textContent);
    }
    </script>
</body>

</html>