<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('includes/header.php'); ?>
    <link rel="stylesheet" type="text/css" href="css/datatable-css.css">
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <?php include('includes/sidebar.php'); ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <?php   $query="select * from users";
                    $result=mysqli_query($connection,$query);
                    $html="";
                    while($row=mysqli_fetch_assoc($result))
                    {
                            $html.="<tr>";
                            $html.="<td>".$row['userid']."</td>";
                            $html.="<td>".$row['name']."</td>";
                            $html.="<td>".$row['surname']."</td>";
                            $html.="<td>".$row['address']."</td>";
                            $html.="<td>".$row['dob']."</td>";
                            $html.="<td>".$row['email']."</td>";
                            $html.="<td>".$row['privilage']."</td>";
                            $html.="</tr>";
                    }?>
            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include('includes/top-nav.php'); ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">


                    <!-- data table plugin example -->
                    <table id="mytable" class="display">
                        <thead>
                            <tr>
                                <th>userid</th>
                                <th>name</th>
                                <th>surname</th>
                                <th>address</th>
                                <th>dob</th>
                                <th>email</th>
                                <th>privilage</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                  
                        echo $html;
                    ?>
                        </tbody>
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
    <script src="js/datatable-js.js"></script>
    <script>
    $(document).ready(function() {
        $('#mytable').DataTable();
    });
    </script>
</body>

</html>