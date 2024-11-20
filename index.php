<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Dashboard - ISCPS</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/ADLaM%20Display.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/css/driver.css">
    <link rel="stylesheet" href="assets/css/datatables.min.css">
    <link rel="stylesheet" href="assets/css/Lightbox-Gallery-No-Gutters-baguetteBox.min.css">
</head>

<body id="page-top" oncontextmenu="return false">
    <div id="wrapper">
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <nav class="navbar navbar-expand bg-white shadow mb-4 topbar">
                    <div class="container-fluid"><img class="mx-2" src="assets/img/pagadian.jpg" height="60">
                        <h2 class="mt-2" style="font-family: 'ADLaM Display', serif;color: rgb(60,14,80);">ISCPS&nbsp;</h2>
                        <!-- <h2 class="d-sm-none d-md-block mt-2" style="font-family: 'ADLaM Display', serif;color: rgb(60,14,80);">- IoT Smart Car Parking System&nbsp;</h2> -->
                        <ul class="navbar-nav flex-nowrap ms-auto">
                            <li class="nav-item"><button class="btn btn-primary" type="button" data-bs-target="#login" data-bs-toggle="modal">Sign In</button></li>
                        </ul>
                    </div>
                </nav>
                <div class="container-fluid">
                    <div class="d-sm-flex justify-content-between align-items-center mb-4">
                        <h3 class="text-dark mb-0">Dashboard</h3>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-xl-3 mb-4">
                            <div class="card shadow border-left-success py-2" id="card-vehicle-in">
                                <div class="card-body">
                                    <div class="row g-0 align-items-center">
                                        <div class="col me-2">
                                            <div class="text-uppercase text-success fw-bold text-xs mb-1"><span>VEHICLE IN</span></div>
                                            <div class="text-dark fw-bold h5 mb-0"><span id="vehicleIn">0</span></div>
                                        </div>
                                        <div class="col-auto"><i class="fas fa-dollar-sign fa-2x text-gray-300"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-3 mb-4">
                            <div class="card shadow border-left-success py-2" id="card-vehicle-out">
                                <div class="card-body">
                                    <div class="row g-0 align-items-center">
                                        <div class="col me-2">
                                            <div class="text-uppercase text-success fw-bold text-xs mb-1"><span>VEHICLE out</span></div>
                                            <div class="text-dark fw-bold h5 mb-0"><span id="vehicleOut">0</span></div>
                                        </div>
                                        <div class="col-auto"><i class="fas fa-dollar-sign fa-2x text-gray-300"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-3 mb-4">
                            <div class="card shadow border-left-success py-2" id="card-vehicle-currently-parked">
                                <div class="card-body">
                                    <div class="row g-0 align-items-center">
                                        <div class="col me-2">
                                            <div class="text-uppercase text-success fw-bold text-xs mb-1"><span>CURRENT VEHICLE PARKED</span></div>
                                            <div class="text-dark fw-bold h5 mb-0"><span  id="vehicleCurrent">0</span></div>
                                        </div>
                                        <div class="col-auto"><i class="fas fa-dollar-sign fa-2x text-gray-300"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="parking-slots" class="row">
                        <div class="col-lg-6 mb-4">
                            <div id="slot1" class="card text-white shadow">
                                <div class="card-body">
                                    <p id="status1" class="m-0"><strong>P1 - </strong></p>
                                    <p class="text-white small m-0">TIME IN: <strong id="inTime1"></strong></p>
                                    <p class="text-white small m-0">TIME OUT: <strong id="outTime1"></strong></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-4">
                            <div id="slot2" class="card text-white shadow">
                                <div class="card-body">
                                    <p id="status2" class="m-0"><strong>P2 - </strong></p>
                                    <p class="text-white small m-0">TIME IN: <strong id="inTime2"></strong></p>
                                    <p class="text-white small m-0">TIME OUT: <strong id="outTime2"></strong></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-4">
                            <div id="slot3" class="card text-white shadow">
                                <div class="card-body">
                                    <p id="status3" class="m-0"><strong>P3 - </strong></p>
                                    <p class="text-white small m-0">TIME IN: <strong id="inTime3"></strong></p>
                                    <p class="text-white small m-0">TIME OUT: <strong id="outTime3"></strong></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-4">
                            <div id="slot4" class="card text-white shadow">
                                <div class="card-body">
                                    <p id="status4" class="m-0"><strong>P4 - </strong></p>
                                    <p class="text-white small m-0">TIME IN: <strong id="inTime4"></strong></p>
                                    <p class="text-white small m-0">TIME OUT: <strong id="outTime4"></strong></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row g-0 photos" id="parking-lot-image" data-bss-baguettebox="">
                        <div class="col item"><a href="assets/img/Screenshot%202024-09-30%20235928.png"><img class="img-fluid w-100" src="assets/img/Screenshot%202024-09-30%20235928.png"></a></div>
                    </div>
                </div>
            </div>
            <footer class="bg-white sticky-footer">
                <div class="container my-auto">
                    <div class="text-center my-auto copyright"><span>Copyright © ICPS 2024</span></div>
                </div>
            </footer>
        </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
    </div>
    <div class="modal fade" role="dialog" tabindex="-1" id="login">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Sign In</h4><button class="btn-close" type="button" aria-label="Close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="sign-in-form">
                        <div class="form-floating mb-3">
                            <input class="form-control" type="text" placeholder="username" name="username" value="<?php echo isset($_COOKIE['username']) ? $_COOKIE['username'] : ''; ?>">
                            <label class="form-label" for="floatingInput">Username</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input class="form-control" type="password" placeholder="password" name="password" value="<?php echo isset($_COOKIE['password']) ? $_COOKIE['password'] : ''; ?>">
                            <label class="form-label" for="floatingInput">Password</label>
                        </div>
                        <div class="d-flex justify-content-center form-check mb-4">
                            <input type="checkbox" class="form-check-input me-2" id="form2Example33" name="remember" <?php echo isset($_COOKIE['username']) ? 'checked' : ''; ?>>
                            <label class="form-check-label" for="form2Example33">Remember Me</label>
                        </div>
                        
                        <button class="btn btn-primary btn-block mb-4 w-100" type="submit">Sign In</button>

                    </form>
                </div>
                <div class="modal-footer"><button class="btn btn-light" type="button" data-bs-dismiss="modal">Close</button></div>
            </div>
        </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/chart.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="assets/js/driver.js.iife.js"></script>
    <script src="assets/js/datatables.min.js"></script>
    <script src="assets/js/sweetalert2.js"></script>
    <script src="assets/js/Lightbox-Gallery-No-Gutters-baguetteBox.min.js"></script>
    <script src="assets/js/Lightbox-Gallery-No-Gutters-Lightbox-Gallery.js"></script>
    <script src="assets/js/form-submit.js"></script>
    <script src="assets/js/tutorial.js"></script>
    <script src="assets/js/sensor.js"></script>
    <script src="assets/js/realtime-count.js"></script>
    <script src="assets/js/protectWebsite.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="assets/js/theme.js"></script>
    <script>
          ClientObj.drive();
    </script>
</body>

</html>