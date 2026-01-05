<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Skydash Admin</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="assets/vendors/feather/feather.css">
  <link rel="stylesheet" href="assets/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="assets/vendors/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <!-- <link rel="stylesheet" href="assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css"> -->
  <link rel="stylesheet" href="assets/vendors/datatables.net-bs5/dataTables.bootstrap5.css">
  <link rel="stylesheet" href="assets/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" type="text/css" href="assets/js/select.dataTables.min.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="assets/css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="assets/images/favicon.png" />
</head>

<body>
  <!-- partial:partials/_navbar.html -->
  <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
      <a class="navbar-brand brand-logo me-5" href="dashboard.php"><img src="assets/images/Salama.svg" class="me-2"
          alt="logo" /></a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
      <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
        <span class="icon-menu"></span>
      </button>
      <ul class="navbar-nav mr-lg-2">
        <li class="nav-item nav-search d-none d-lg-block">
          <div class="input-group">
            <div class="input-group-prepend hover-cursor" id="navbar-search-icon">
              <span class="input-group-text" id="search">
                <i class="icon-search"></i>
              </span>
            </div>
            <input type="text" class="form-control" id="navbar-search-input" placeholder="Search now"
              aria-label="search" aria-describedby="search">
          </div>
        </li>
      </ul>
      <ul class="navbar-nav navbar-nav-right"></ul>
      <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
        data-toggle="offcanvas">
        <span class="icon-menu"></span>
      </button>
    </div>
  </nav>
  <!-- partial -->
  <div class="container-fluid page-body-wrapper">
    <!-- partial:partials/_sidebar.html -->
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
      <ul class="nav">
        <li class="nav-item">
          <a class="nav-link" href="dashboard.php">
            <i class="icon-grid menu-icon"></i>
            <span class="menu-title">Dashboard</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="manage_appointments.php">
            <i class="icon-paper menu-icon"></i>
            <span class="menu-title">Appointments</span>
          </a>
        </li>
      </ul>
    </nav>
    <!-- partial -->
    <div class="main-panel">
      <div class="content-wrapper">
        <div class="row">
          <div class="col-md-12 grid-margin">
            <div class="row">
              <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                <h3 class="font-weight-bold">Welcome
                  <?php require_once __DIR__ . "/../connection.php";
                  $name = $_GET['name'] ?? null;
                  if ($name != null) {
                    echo $name;
                  }
                  ?>!</h3>
                <h6 class="font-weight-normal mb-0">All services operational! You have <span
                    class="text-primary">3 unread alerts!</span></h6>
              </div>
              <div class="col-12 col-xl-4">
                <div class="justify-content-end d-flex">
                  <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                    <button class="btn btn-sm btn-light bg-white dropdown-toggle" type="button" id="dropdownMenuDate2"
                      data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                      <i class="mdi mdi-calendar"></i>Today (<span id="today-date"></span>) </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuDate2">
                      <a class="dropdown-item" href="#">January - March</a>
                      <a class="dropdown-item" href="#">March - June</a>
                      <a class="dropdown-item" href="#">June - August</a>
                      <a class="dropdown-item" href="#">August - November</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6 grid-margin stretch-card">
            <div class="card tale-bg">
              <div class="card-people mt-auto">
                <img src="assets/images/dashboard/Internal-Medicine_JSJ_IMG_8144.jpg" alt="people">
                <div class="weather-info">
                  <div class="d-flex">

                    <div class="ms-2">
                      <h4 class="location font-weight-normal">Salama Clinic</h4>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6 grid-margin transparent">
            <div class="row">
              <div class="col-md-6 mb-4 stretch-card transparent">
                <div class="card card-tale">
                  <div class="card-body">
                    <p class="mb-4">Today’s Appointments</p>
                    <p class="fs-30 mb-2">400</p>
                    <p>10.00% (30 days)</p>
                  </div>
                </div>
              </div>
              <div class="col-md-6 mb-4 stretch-card transparent">
                <div class="card card-dark-blue">
                  <div class="card-body">
                    <p class="mb-4">Total Appointments</p>
                    <p class="fs-30 mb-2">6134</p>
                    <p>22.00% (30 days)</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
                <div class="card card-light-blue">
                  <div class="card-body">
                    <p class="mb-4">Number of Consultations</p>
                    <p class="fs-30 mb-2">34040</p>
                    <p>2.00% (30 days)</p>
                  </div>
                </div>
              </div>
              <div class="col-md-6 stretch-card transparent">
                <div class="card card-light-danger">
                  <div class="card-body">
                    <p class="mb-4">Number of Patients</p>
                    <p class="fs-30 mb-2">47033</p>
                    <p>0.22% (30 days)</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-between">
                  <p class="card-title">Patient Consultations Overview</p>
                  <a href="#" class="text-info">View all</a>
                </div>
                <p class="font-weight-500">Total number of patient consultations during the selected period.</p>
                <div id="sales-chart-legend" class="chartjs-legend mt-4 mb-2"></div>
                <canvas id="sales-chart"></canvas>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 grid-margin stretch-card">
            <div class="card position-relative">
              <div class="card-body">
                <div id="detailedReports" class="carousel slide detailed-report-carousel position-static pt-2"
                  data-bs-ride="carousel">
                  <div class="carousel-inner">
                    <div class="carousel-item active">
                      <div class="row">
                        <div class="col-md-12 col-xl-3 d-flex flex-column justify-content-start">
                          <div class="ml-xl-4 mt-3">
                            <p class="card-title">Detailed Reports</p>
                            <h1 class="text-primary">3,404 Patients Served</h1>
                            <h3 class="font-weight-500 mb-xl-4 text-primary">Specialities</h3>
                            <p class="mb-2 mb-xl-0">Number of consultations per medical specialty during the selected period.</p>
                          </div>
                        </div>
                        <div class="col-md-12 col-xl-9">
                          <div class="row">
                            <div class="col-md-6 border-right">
                              <div class="table-responsive mb-3 mb-md-0 mt-3">
                                <table class="table table-borderless report-table">
                                  <tr>
                                    <td class="text-muted">General medicine</td>
                                    <td class="w-100 px-0">
                                      <div class="progress progress-md mx-4">
                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 70%"
                                          aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                                      </div>
                                    </td>
                                    <td>
                                      <h5 class="font-weight-bold mb-0">713</h5>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td class="text-muted">Cardiology</td>
                                    <td class="w-100 px-0">
                                      <div class="progress progress-md mx-4">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 30%"
                                          aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                                      </div>
                                    </td>
                                    <td>
                                      <h5 class="font-weight-bold mb-0">583</h5>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td class="text-muted">Gynicology</td>
                                    <td class="w-100 px-0">
                                      <div class="progress progress-md mx-4">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 95%"
                                          aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
                                      </div>
                                    </td>
                                    <td>
                                      <h5 class="font-weight-bold mb-0">924</h5>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td class="text-muted">Medical Imaging</td>
                                    <td class="w-100 px-0">
                                      <div class="progress progress-md mx-4">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 60%"
                                          aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                      </div>
                                    </td>
                                    <td>
                                      <h5 class="font-weight-bold mb-0">664</h5>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td class="text-muted">Dermatology</td>
                                    <td class="w-100 px-0">
                                      <div class="progress progress-md mx-4">
                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 40%"
                                          aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                      </div>
                                    </td>
                                    <td>
                                      <h5 class="font-weight-bold mb-0">560</h5>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td class="text-muted">Laboratory Tests</td>
                                    <td class="w-100 px-0">
                                      <div class="progress progress-md mx-4">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 75%"
                                          aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                      </div>
                                    </td>
                                    <td>
                                      <h5 class="font-weight-bold mb-0">793</h5>
                                    </td>
                                  </tr>
                                </table>
                              </div>
                            </div>
                            <div class="col-md-6 mt-3">
                              <div class="daoughnutchart-wrapper">
                                <canvas id="north-america-chart"></canvas>
                              </div>
                              <div id="north-america-chart-legend">
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- here -->
                    <div class="carousel-item">
                      <div class="row">
                        <div class="col-md-12 col-xl-3 d-flex flex-column justify-content-start">
                          <div class="ml-xl-4 mt-3">
                            <p class="card-title">Detailed Reports</p>
                            <h1 class="text-primary">3,404 Total Consultations</h1>
                            <h3 class="font-weight-500 mb-xl-4 text-primary">Specialties</h3>
                            <p class="mb-2 mb-xl-0">Number of consultations per medical specialty during the selected period.</p>
                          </div>
                        </div>
                        <div class="col-md-12 col-xl-9">
                          <div class="row">
                            <div class="col-md-6 border-right">
                              <div class="table-responsive mb-3 mb-md-0 mt-3">
                                <table class="table table-borderless report-table">
                                  <tr>
                                    <td class="text-muted">General medicine</td>
                                    <td class="w-100 px-0">
                                      <div class="progress progress-md mx-4">
                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 70%"
                                          aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                                      </div>
                                    </td>
                                    <td>
                                      <h5 class="font-weight-bold mb-0">713</h5>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td class="text-muted">Cardiology</td>
                                    <td class="w-100 px-0">
                                      <div class="progress progress-md mx-4">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 30%"
                                          aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                                      </div>
                                    </td>
                                    <td>
                                      <h5 class="font-weight-bold mb-0">583</h5>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td class="text-muted">Gynicology</td>
                                    <td class="w-100 px-0">
                                      <div class="progress progress-md mx-4">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 95%"
                                          aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
                                      </div>
                                    </td>
                                    <td>
                                      <h5 class="font-weight-bold mb-0">924</h5>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td class="text-muted">Medical Imaging</td>
                                    <td class="w-100 px-0">
                                      <div class="progress progress-md mx-4">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 60%"
                                          aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                      </div>
                                    </td>
                                    <td>
                                      <h5 class="font-weight-bold mb-0">664</h5>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td class="text-muted">Dermatology</td>
                                    <td class="w-100 px-0">
                                      <div class="progress progress-md mx-4">
                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 40%"
                                          aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                      </div>
                                    </td>
                                    <td>
                                      <h5 class="font-weight-bold mb-0">560</h5>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td class="text-muted">Laboratory Tests</td>
                                    <td class="w-100 px-0">
                                      <div class="progress progress-md mx-4">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 75%"
                                          aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                      </div>
                                    </td>
                                    <td>
                                      <h5 class="font-weight-bold mb-0">793</h5>
                                    </td>
                                  </tr>
                                </table>
                              </div>
                            </div>
                            <div class="col-md-6 mt-3">
                              <div class="daoughnutchart-wrapper">
                                <canvas id="south-america-chart"></canvas>
                              </div>
                              <div id="south-america-chart-legend"></div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- here -->
                  </div>
                  <a class="carousel-control-prev" href="#detailedReports" role="button" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  </a>
                  <a class="carousel-control-next" href="#detailedReports" role="button" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 grid-margin stretch-card">
            <div class="card">

            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
      <!-- partial:partials/_footer.html -->
      <footer class="footer">
        <div class="d-sm-flex justify-content-center justify-content-sm-between">
          <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2023. Premium <a
              href="https://www.bootstrapdash.com/" target="_blank">Bootstrap admin template</a> from BootstrapDash.
            All rights reserved.</span>
          <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i
              class="ti-heart text-danger ms-1"></i></span>
        </div>
      </footer>
      <!-- partial -->
    </div>
    <!-- main-panel ends -->
  </div>
  <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="assets/vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="assets/vendors/chart.js/chart.umd.js"></script>
  <script src="assets/vendors/datatables.net/jquery.dataTables.js"></script>
  <!-- <script src="assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script> -->
  <script src="assets/vendors/datatables.net-bs5/dataTables.bootstrap5.js"></script>
  <script src="assets/js/dataTables.select.min.js"></script>
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="assets/js/off-canvas.js"></script>
  <script src="assets/js/template.js"></script>
  <script src="assets/js/settings.js"></script>
  <script src="assets/js/todolist.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="assets/js/jquery.cookie.js" type="text/javascript"></script>
  <script src="assets/js/dashboard.js"></script>
  <!-- <script src="assets/js/Chart.roundedBarCharts.js"></script> -->
  <!-- End custom js for this page-->
  <script>
    // Create a Date object for today
    const today = new Date();

    // Format the date as: 10 Jan 2021
    const options = {
      day: '2-digit',
      month: 'short',
      year: 'numeric'
    };
    const formattedDate = today.toLocaleDateString('en-GB', options);

    // Insert it into the span
    document.getElementById('today-date').textContent = formattedDate;
  </script>
</body>

</html>