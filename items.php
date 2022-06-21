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
                <h3>Available Mobile Items</h3>
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
                        <th>Available</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>

            </table>
        </div>
    </div>


    <?php

include 'includes/footer.php';

?>
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
                    <form class="orderForm">
                        <input type="hidden" class="stockid" name="stockid">
                        <input type="hidden" class="mobileid" name="mobileid">
                        <div class="row">
                            <div class="col">
                                <input type="text" class="form-control brand " name="brand" readonly
                                    placeholder="Brand">
                            </div>
                            <div class="col">
                                <input type="text" class="form-control series " readonly name="series"
                                    placeholder="Series">
                            </div>
                            <div class="col">
                                <input type="text" name="model" class="form-control model " readonly
                                    placeholder="Model">
                            </div>
                            <div class="col">
                                <input type="text" name="price" class="form-control price " readonly
                                    placeholder="price">
                            </div>
                        </div>
                        <div class="row my-3">
                            <div class="col">
                                <input type="text" name="color" class="form-control color " readonly
                                    placeholder="Color">
                            </div>
                            <div class="col">
                                <input type="text" name="amount" class="form-control amount " readonly>
                            </div>
                            <div class="col-4">
                                <input type="text" name="orderAmount" class="form-control orderAmount"
                                    placeholder="Amount to Order">
                            </div>
                            <div class="col-2">
                                <input type="submit" class="btn btn-success orderButton" value="Proceed">
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
                    actionString: "loadClientItems"
                },
            },
        });
        // order request
        $('#tableRecords').on('click', '.orderButton', function() {
            var value = $(this).val();
            $.ajax({
                type: "post",
                dataType: 'json',
                url: "includes/process.php",
                data: {
                    actionString: 'getOrder',
                    value: value
                },
                success: function(response) {
                    $('#editModal .stockid').val(response.stockid);
                    $('#editModal .mobileid').val(response.mobileid);
                    $('#editModal .brand').val(response.mobilebrand);
                    $('#editModal .color').val(response.mobilecolor);
                    $('#editModal .series').val(response.mobileseries);
                    $('#editModal .model').val(response.mobilemodel);
                    $('#editModal .amount').val(response.amount);
                    $('#editModal .price').val(response.price);
                    $('#editModal').modal('show');
                }
            });

        });
        // order process request 
        $('.orderForm').on('submit', function(e) {
            e.preventDefault();
            var brand, series, color, model, id;
            orderAmount = $('.orderForm .orderAmount');
            availableAmount = $('.orderForm .amount');

            orderAmount.removeClass('inputError');
            // console.log(parseInt(orderAmount.val()) > parseInt(availableAmount.val()));
            if (orderAmount.val().trim() == "" || $.isNumeric(orderAmount.val()) == false || (
                    parseInt(orderAmount.val()) > parseInt(availableAmount.val())))
                orderAmount.addClass('inputError');
            else {
                var data = new FormData(this);
                data.append('actionString', 'processOrder');
                $.ajax({
                    type: "post",
                    url: "includes/process.php",
                    data: data,
                    cache: false,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.trim() == "true") {
                            $('.orderForm')[0].reset();
                            $('#editModal').modal('hide');
                            $('#messageModal').modal('show');
                            $('#messageModal .modal-body').text(
                                'The order has been sent for the approval process');
                            Records.ajax.reload();
                        } else {

                            $('#editModal').modal('hide');
                            $('#messageModal').modal('show');
                            $('#messageModal .modal-body').text(
                                'Failed to process the order');
                        }
                    }
                });
            }
        });
    });
    </script>
</body>

</html>