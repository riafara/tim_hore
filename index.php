<?php
require("koneksi.php");

session_start();

if (!isset($_SESSION['id'])) {
    $_SESSION['msg'] = 'anda harus login untuk mengakses halaman ini';
    header('Location: login.php');
}
$sesID = $_SESSION['id'];
$sesName = $_SESSION['name'];
$sesLvl = $_SESSION['level'];


$query1 = $koneksi->query("SELECT * FROM tb_customer");
$jml_customer = mysqli_num_rows($query1);
$query2 = $koneksi->query("SELECT * FROM tb_paket");
$jml_paket = mysqli_num_rows($query2);
$query3 = $koneksi->query("SELECT * FROM tb_transaksi");
$jml_transaksi = mysqli_num_rows($query3);
$query4 = $koneksi->query("SELECT * FROM tb_user");
$jml_user = mysqli_num_rows($query4);

if( isset($_POST['insert']) ){
    $transaksi = $_POST['txt_id'];
    $tgl = $_POST['txt_tgl'];
    $cust = $_POST['txt_idc'];
    $nama = $_POST['txt_nama'];
    $pkt = $_POST['txt_idp'];
    $qty = $_POST['txt_qty'];
    $biaya = $_POST['txt_biaya'];
    $bayar = $_POST['txt_bayar'];
    $kembali = $_POST['txt_kembali'];

    $query = "INSERT INTO tb_transaksi (id_transaksi, tanggal, id_customer, nama, id_paket, qty, biaya, bayar, kembalian) VALUES ('$transaksi', '$tgl', '$cust', '$nama', '$pkt', '$qty', '$biaya', '$bayar', '$kembali')";
    echo $query;
    $result = mysqli_query($koneksi, $query);
    header('Location: ttransaksi.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>LAUNDRY MIRACLE BUBBLES</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <style type="text/css">
        BODY{
            width: auto;
        }
        #chart-container{
            width: 500px;
            height: auto;
        }
        </style>
        <script type="text/javascript" src="js/jquery.min.js"></script>
        <script type="text/javascript" src="js/Chart.min.js"></script>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div >
                    <img src="img/logoo.jpg" style="width: 50px">
                </div>
                <div class="sidebar-brand-text mx-3"> MIRACLE BUBBLES </div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="index.php">
                <i class="fa fa-home" aria-hidden="true"></i>
                    <span>Home</span></a>
            </li>
            <hr class="sidebar-divider my-0">
            <li class="nav-item active">
                <a class="nav-link" href="tables.php">
                <i class="fa fa-user" aria-hidden="true"></i>
                    <span>User</span></a>
            </li>
            <hr class="sidebar-divider my-0">
            <li class="nav-item active">
                <a class="nav-link" href="tpaket.php">
                <i class="fas fa-camera-retro"></i>
                    <span>Paket</span></a>
            </li>
            <hr class="sidebar-divider my-0">
            <li class="nav-item active">
                <a class="nav-link" href="tcustomer.php">
                <i class="fa fa-users" aria-hidden="true"></i>
                    <span>Customer</span></a>
            </li>
            <hr class="sidebar-divider my-0">
            <li class="nav-item active">
                <a class="nav-link" href="ttransaksi.php">
                <i class="far fa-money-bill-alt" aria-hidden="true"></i>
                    <span>Transaksi</span></a>
            </li>
            <hr class="sidebar-divider my-0">
            <li class="nav-item active">
                <a class="nav-link" href="cetak.php">
                <i class="far fa-file-alt"></i>
                    <span>Report</span></a>
            </li>
            <hr class="sidebar-divider my-0">
            <li class="nav-item active">
                <a class="nav-link" href="bar.php">
                <i class="fas fa-fw fa-chart-line"></i>
                    <span>Graph</span></a>
            </li>
            <hr class="sidebar-divider">
            


            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $sesName; ?></span>
                                <i class="fa fa-user" aria-hidden="true"></i>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                
                                <a href="#" class="dropdown-item" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    
                    <!-- Content Row -->
                    <div class="row">
                    <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                <a href="tables.php">User</a></div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo number_format($jml_user,0,",",".")?></div>
                                        </div>
                                        <div class="col-auto">
                                        <i class="fa fa-user fa-2x text-gray-300" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Earnings (Monthly) Card Example -->
                       
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                <a href="tcustomer.php">Customer</a></div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo number_format($jml_customer,0,",",".")?></div>
                                        </div>
                                        <div class="col-auto">
                                        <i class="fa fa-users fa-2x text-gray-300" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                      
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                <a href="tpaket.php">Paket Laundry</a></div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo number_format($jml_paket,0,",",".")?></div>
                                        </div>
                                        <div class="col-auto">
                                        <i class="fa fa-tasks fa-2x text-gray-300" aria-hidden="true"></i>
                                          
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                <a href="ttransaksi.php">Transaksi</a></div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo number_format($jml_transaksi,0,",",".")?></div>
                                        </div>
                                        <div class="col-auto">
                                        <i class="fa fa-shopping-cart fa-2x text-gray-300" aria-hidden="true"></i>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Content Row -->

                        <div class="row">

                        <!-- Area Chart -->
                        <div class="col">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Transaksi Laundry</h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink">
                                            
                                            <a class="dropdown-item" href="ttransaksi.php">See More</a>
                                           
                                        </div>
                                    </div>
                                </div>
                                <!-- Card Body -->
                                <div id="chart-container">
                        <canvas id="graphCanvas"></canvas>

                    </div>
                    <script>
            $(document).ready(function (){
                showGraph();
            });

            function showGraph()
            {
                {
                    $.post("bar_encode.php",
                    function (data)
                    {
                        console.log(data);
                        var id = [];
                        var jual = [];

                        for (var i in data){
                        id.push(data[i].tgl_masuk);
                        jual.push(data[i].harga_total);
                        }
                        var chartdata = {
                            labels : id,
                            datasets: [
                                {
                                    label: 'Tanggal Transaksi',
                                    backgroundColor: '#355bcc',
                                    borderColor: '#355bcc',
                                    hoverBackgroundColor: '#355bcc',
                                    hoverBorderColor: '#355bcc',
                                    data: jual
                                }
                            ]
                        };

                        var graphTarget = $("#graphCanvas");

                        var barGraph = new Chart(graphTarget, {
                            type: 'line',
                            data: chartdata
                        });
                    });
                }
            }
        </script>
                </div>
                            </div>
                        </div>

                       
                    </div>
                    
                
            </div>
        </div>
                    
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Mircale Bubbles 2023</span>
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

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>
