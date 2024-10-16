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
    <link rel="stylesheet" href="assets/css/Lightbox-Gallery-No-Gutters-baguetteBox.min.css">
</head>

<body id="page-top">
    <div id="wrapper">
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <nav class="navbar navbar-expand bg-white shadow mb-4 topbar">
                    <div class="container-fluid"><img class="mx-2" src="assets/img/pagadian.jpg" height="60">
                        <h2 class="mt-2" style="font-family: 'ADLaM Display', serif;color: rgb(60,14,80);">ISCPS&nbsp;</h2>
                        <h2 class="d-sm-none d-md-block mt-2" style="font-family: 'ADLaM Display', serif;color: rgb(60,14,80);">- IoT Smart Car Parking System&nbsp;</h2>
                        <ul class="navbar-nav flex-nowrap ms-auto">
                            <li class="nav-item"><button class="btn btn-primary" type="button">Sign out</button></li>
                        </ul>
                    </div>
                </nav>
                <div class="container-fluid">
                    <div class="d-sm-flex justify-content-between align-items-center mb-4">
                        <h3 class="text-dark mb-0">Dashboard</h3><a class="btn btn-primary btn-sm" role="button" href="#" data-bs-target="#remote" data-bs-toggle="modal"><i class="fas fa-download fa-sm text-white-50"></i>&nbsp;Control Servo Motor</a>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-xl-3 mb-4">
                            <div class="card shadow border-left-success py-2" id="card-vehicle-in">
                                <div class="card-body">
                                    <div class="row g-0 align-items-center">
                                        <div class="col me-2">
                                            <div class="text-uppercase text-success fw-bold text-xs mb-1"><span>VEHICLE IN</span></div>
                                            <div class="text-dark fw-bold h5 mb-0"><span>0</span></div>
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
                                            <div class="text-dark fw-bold h5 mb-0"><span>0</span></div>
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
                                            <div class="text-dark fw-bold h5 mb-0"><span>0</span></div>
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
                                    <p id="time1" class="text-white small m-0">TIME IN: <span id="inTime1"></span></p>
                                    <p class="text-white small m-0">TIME OUT: <span id="outTime1"></span></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-4">
                            <div id="slot2" class="card text-white shadow">
                                <div class="card-body">
                                    <p id="status2" class="m-0"><strong>P2 - </strong></p>
                                    <p id="time2" class="text-white small m-0">TIME IN: <span id="inTime2"></span></p>
                                    <p class="text-white small m-0">TIME OUT: <span id="outTime2"></span></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-4">
                            <div id="slot3" class="card text-white shadow">
                                <div class="card-body">
                                    <p id="status3" class="m-0"><strong>P3 - </strong></p>
                                    <p id="time3" class="text-white small m-0">TIME IN: <span id="inTime3"></span></p>
                                    <p class="text-white small m-0">TIME OUT: <span id="outTime3"></span></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-4">
                            <div id="slot4" class="card text-white shadow">
                                <div class="card-body">
                                    <p id="status4" class="m-0"><strong>P4 - </strong></p>
                                    <p id="time4" class="text-white small m-0">TIME IN: <span id="inTime4"></span></p>
                                    <p class="text-white small m-0">TIME OUT: <span id="outTime4"></span></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card shadow mb-4" id="piechart">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h6 class="text-primary fw-bold m-0">VEHICLES IN &amp; OUT</h6>
                            <div class="dropdown no-arrow"><button class="btn btn-link btn-sm dropdown-toggle" aria-expanded="false" data-bs-toggle="dropdown" type="button"><i class="fas fa-ellipsis-v text-gray-400"></i></button>
                                <div class="dropdown-menu shadow dropdown-menu-end animated--fade-in">
                                    <p class="text-center dropdown-header">dropdown header:</p><a class="dropdown-item" href="#">&nbsp;Action</a><a class="dropdown-item" href="#">&nbsp;Another action</a>
                                    <div class="dropdown-divider"></div><a class="dropdown-item" href="#">&nbsp;Something else here</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="chart-area"><canvas data-bss-chart="{&quot;type&quot;:&quot;doughnut&quot;,&quot;data&quot;:{&quot;labels&quot;:[&quot;Direct&quot;,&quot;Social&quot;],&quot;datasets&quot;:[{&quot;label&quot;:&quot;&quot;,&quot;backgroundColor&quot;:[&quot;#4e73df&quot;,&quot;#1cc88a&quot;],&quot;borderColor&quot;:[&quot;#ffffff&quot;,&quot;#ffffff&quot;],&quot;data&quot;:[&quot;50&quot;,&quot;30&quot;]}]},&quot;options&quot;:{&quot;maintainAspectRatio&quot;:false,&quot;legend&quot;:{&quot;display&quot;:false,&quot;labels&quot;:{&quot;fontStyle&quot;:&quot;normal&quot;}},&quot;title&quot;:{&quot;fontStyle&quot;:&quot;normal&quot;}}}"></canvas></div>
                            <div class="text-center small mt-4"><span class="me-2"><i class="fas fa-circle text-primary"></i>&nbsp;VEHICLE IN</span><span class="me-2"><i class="fas fa-circle text-success"></i>&nbsp;VEHICLE OUT</span></div>
                        </div>
                    </div>
                    <div class="card shadow mb-4" id="parking-logs">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 fw-bold">Parking Logs</p>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 text-nowrap">
                                    <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable"><label class="form-label">Show&nbsp;<select class="d-inline-block form-select form-select-sm">
                                                <option value="10" selected="">10</option>
                                                <option value="25">25</option>
                                                <option value="50">50</option>
                                                <option value="100">100</option>
                                            </select>&nbsp;</label></div>
                                </div>
                                <div class="col-md-6">
                                    <div class="text-md-end dataTables_filter" id="dataTable_filter"><label class="form-label"><input type="search" class="form-control form-control-sm" aria-controls="dataTable" placeholder="Search"></label></div>
                                </div>
                            </div>
                            <div class="table-responsive table mt-2" id="dataTable-1" role="grid" aria-describedby="dataTable_info">
                                <table class="table my-0" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th>PARKING No.</th>
                                            <th>TIME-IN</th>
                                            <th>TIME-OUT</th>
                                            <th>CREATED AT</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><img class="rounded-circle me-2" width="30" height="30" src="assets/img/Gaisano_Capital_Logo.svg.png">P1</td>
                                            <td>2012/03/29<br></td>
                                            <td>2012/03/29<br></td>
                                            <td>2012/03/29<br></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-md-6 align-self-center">
                                    <p id="dataTable_info" class="dataTables_info" role="status" aria-live="polite">Showing 1 to 10 of 27</p>
                                </div>
                                <div class="col-md-6">
                                    <nav class="d-lg-flex justify-content-lg-end dataTables_paginate paging_simple_numbers">
                                        <ul class="pagination">
                                            <li class="page-item disabled"><a class="page-link" aria-label="Previous" href="#"><span aria-hidden="true">«</span></a></li>
                                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                                            <li class="page-item"><a class="page-link" aria-label="Next" href="#"><span aria-hidden="true">»</span></a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
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
    <div class="modal fade" role="dialog" tabindex="-1" id="remote">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Control Servo Motor</h4><button class="btn-close" type="button" aria-label="Close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Here you can remotely open the Entrance or Exit.</p>
                    <div class="row">
                        <div class="col text-center"><a class="btn btn-primary btn-sm w-100" role="button" href="#" data-bs-target="#remote" data-bs-toggle="modal"><i class="fas fa-download fa-sm text-white-50"></i>&nbsp;Open Entrance</a></div>
                        <div class="col text-center"><a class="btn btn-primary btn-sm w-100" role="button" href="#" data-bs-target="#remote" data-bs-toggle="modal"><i class="fas fa-download fa-sm text-white-50"></i>&nbsp;Open Exit</a></div>
                    </div>
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
    <script src="assets/js/Lightbox-Gallery-No-Gutters-baguetteBox.min.js"></script>
    <script src="assets/js/Lightbox-Gallery-No-Gutters-Lightbox-Gallery.js"></script>
    <script src="assets/js/form-submit.js"></script>
    <script src="assets/js/tutorial.js"></script>
    <script src="assets/js/sensor.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="assets/js/theme.js"></script>
</body>

</html>