<?php
//panggil koneksi ke database
include('hub.php');
//panggil header
include('header.php');
//panggil nav menu
include('navmenu.php');

$today = date('d/m/Y');
$startdate = '01/02/2023';
?>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
                    <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle me-3" id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>
                        <ul class="navbar-nav flex-nowrap ms-auto">
                            <li class="nav-item dropdown d-sm-none no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"></a>
                                <div class="dropdown-menu dropdown-menu-end p-3 animated--grow-in" aria-labelledby="searchDropdown">
                                    <form class="me-auto navbar-search w-100">
                                        <div class="input-group"><input class="bg-light form-control border-0 small" type="text" placeholder="Search for ...">
                                            <div class="input-group-append"><button class="btn btn-primary py-0" type="button"><i class="fas fa-search"></i></button></div>
                                        </div>
                                    </form>
                                </div>
                            </li>
                            <div class="d-none d-sm-block topbar-divider"></div>
                            <li class="nav-item dropdown no-arrow">
                                <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"><span class="d-none d-lg-inline me-2 text-gray-600 small">Valerie Luna</span><img class="border rounded-circle img-profile" src="assets/img/avatars/avatar1.jpeg"></a>
                                    <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in"><a class="dropdown-item" href="#"><i class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Profile</a><a class="dropdown-item" href="#"><i class="fas fa-cogs fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Settings</a><a class="dropdown-item" href="#"><i class="fas fa-list fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Activity log</a>
                                        <div class="dropdown-divider"></div><a class="dropdown-item" href="#"><i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Logout</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
                <div class="container-fluid">
                    <div class="d-sm-flex justify-content-between align-items-center mb-4">
                        <h3 class="text-dark mb-0">Dashboard</h3><a class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button" href="#"><i class="fas fa-download fa-sm text-white-50"></i>&nbsp;Generate Report</a>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-xl-3 mb-4">
                            <div class="card bg-primary shadow border-start-primary py-2">
                                <div class="card-body" style="padding-top: 0;padding-bottom: 0;">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col me-2">
                                            <div class="text-uppercase text-primary fw-bold text-xs mb-1"><span class="fs-6 text-white">ABSENSI</span></div>
											<?php
											$queryhadir = "SELECT AVG(IF(ket = 'h', 1, 0)) * 100 FROM absensi WHERE tanggal BETWEEN '$startdate' AND '$today' AND info='piket'");
											$stmt = $connect->prepare($queryhadir);
											$stmt->bindParam(':startdate', $startdate);
											$stmt->bindParam(':today', $today);
											$stmt->execute();

											// Ambil hasil query
											$result = $stmt->fetch(PDO::FETCH_ASSOC);
											$avg_ket = $result['avg_ket'];
											?>
                                            <div class="text-dark fw-bold h5 mb-0"><span class="fs-1"><?php echo count($kehadiran,1);?></span><span class="fs-1">&nbsp;%</span></div>
                                        </div>
                                        <div class="col-auto"><i class="fas fa-user-friends fa-2x text-gray-300"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-3 mb-4">
                            <div class="card bg-info shadow border-start-primary py-2">
                                <div class="card-body" style="padding-top: 0;padding-bottom: 0;">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col me-2">
                                            <div class="text-uppercase text-primary fw-bold text-xs mb-1"><span class="fs-6 text-white">ToTAL</span></div>
                                            <div class="text-dark fw-bold h5 mb-0"><span class="fs-1">213</span></div>
                                        </div>
                                        <div class="col-auto"><i class="fas fa-user-friends fa-2x text-gray-300"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-3 mb-4">
                            <div class="card bg-success shadow border-start-success py-2">
                                <div class="card-body" style="padding-top: 0;padding-bottom: 0;">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col me-2">
                                            <div class="text-uppercase text-success fw-bold text-xs mb-1"><span class="fs-6 text-white">HADIR</span></div>
                                            <div class="fs-1 text-dark fw-bold h5 mb-0"><span>$jml&nbsp;</span></div>
                                        </div>
                                        <div class="col-auto"><i class="fas fa-user-check fa-2x text-gray-300"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-3 mb-4">
                            <div class="card bg-secondary shadow border-start-info py-2">
                                <div class="card-body" style="padding-top: 0;padding-bottom: 0;">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col me-2">
                                            <div class="text-uppercase text-info fw-bold text-xs mb-1"><span class="fs-6 text-white">IZIN</span></div>
                                            <div class="row g-0 align-items-center">
                                                <div class="col">
                                                    <div class="text-dark fw-bold h5 mb-0"><span class="fs-1">$jml&nbsp;</span></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto"><i class="fas fa-user-clock fa-2x text-gray-300"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-3 mb-4">
                            <div class="card bg-warning shadow border-start-warning py-2">
                                <div class="card-body" style="padding-top: 0;padding-bottom: 0;">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col me-2">
                                            <div class="text-uppercase text-warning fw-bold text-xs mb-1"><span class="fs-6 text-white">SAKIT</span></div>
                                            <div class="text-dark fw-bold h5 mb-0"><span class="fs-1">$jml&nbsp;</span></div>
                                        </div>
                                        <div class="col-auto"><i class="fas fa-bed fa-2x text-gray-300"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-3 mb-4">
                            <div class="card bg-danger shadow border-start-warning py-2">
                                <div class="card-body" style="padding-top: 0;padding-bottom: 0;">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col me-2">
                                            <div class="text-uppercase text-warning fw-bold text-xs mb-1"><span class="fs-6 text-white">ALFA</span></div>
                                            <div class="text-dark fw-bold h5 mb-0"><span class="fs-1">$jml&nbsp;</span></div>
                                        </div>
                                        <div class="col-auto"><i class="fas fa-user-times fa-2x text-gray-300"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-xl-12 mb-4">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="text-primary fw-bold m-0">Kehadiran Per Tingkat</h6>
                                </div>
                                <div class="card-body">
                                    <h4 class="small fw-bold">Kelas VII<span class="float-end">60%</span></h4>
                                    <div class="progress mb-4" title="60%">
                                        <div class="progress-bar bg-danger" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"><span class="visually-hidden">60%</span></div>
                                    </div>
                                    <h4 class="small fw-bold">Kelas VIII<span class="float-end">40%</span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar bg-warning" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%;"><span class="visually-hidden">40%</span></div>
                                    </div>
                                    <h4 class="small fw-bold">Kelas IX<span class="float-end">60%</span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar bg-primary" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"><span class="visually-hidden">60%</span></div>
                                    </div>
                                    <h4 class="small fw-bold">Kelas X<span class="float-end">80%</span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar bg-info" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%;"><span class="visually-hidden">80%</span></div>
                                    </div>
                                    <h4 class="small fw-bold">Kelas XI<span class="float-end">Complete!</span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar bg-success" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"><span class="visually-hidden">100%</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="table-dark fs-5 text-center">
                                        <tr>
                                            <th>Kelas</th>
                                            <th>Kehadiran</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-center">Cell 1</td>
                                            <td class="text-center">Cell 2</td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">Cell 3</td>
                                            <td class="text-center">Cell 4</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<?php include('footer.php'); ?>