<?php
require('includes/client-authentication.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
include 'includes/header.php';
?>

    <link rel="stylesheet" type="text/css" href="css/datatable-css.css">
    <style>
    .inputError {
        border: solid 1px red;
    }
    </style>
</head>

<body>

    <div class="container-fluid">
        <?php include('includes/customer-menus.php'); ?>
        <div class="row">
            <div class="col">
                <h3>Orders History</h3>
            </div>
        </div>

    </div>
    <div class="row mt-5 p-3">
        <div class="col">
            <!-- data table plugin example -->
            <table class="table table-tabular table-striped display" id="tableRecords">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Brand</th>
                        <th>Series</th>
                        <th>Color</th>
                        <th>Model</th>
                        <th>orderAmount</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>

            </table>
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
                    <h5>Are you Sure want to cancel this Order?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger confirmCancellationButton">Confirm</button>
                </div>
            </div>
        </div>
    </div>

    <?php

include 'includes/footer.php';

?>





    <script src="js/datatable-js.js"></script>
    <script>
    $(document).ready(function() {
        var Records = $('#tableRecords').DataTable({
            ajax: {
                url: 'includes/process.php',
                dataSrc: "",
                type: 'post',
                data: {
                    actionString: "loadOrderItems"
                },
            },
        });
        $('#tableRecords').on('click', '.actionButton', function() {
            var value = $(this).val();
            $('#messageModal').modal('show');
            $('.confirmCancellationButton').click(function() {
                $.ajax({
                    url: 'includes/process.php',
                    type: 'post',
                    data: {
                        actionString: "cancelOrder",
                        orderid: value
                    },
                    success: function(response) {
                        if (response.trim() == "true") {
                            $('#messageModal').modal('hide');
                            Records.ajax.reload();
                        }
                    }
                });
            });

        });
    });
    </script>
</body>

</html>