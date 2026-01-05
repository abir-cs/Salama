<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/vendors/feather/feather.css">
    <link rel="stylesheet" href="assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="assets/vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/datatables.net-bs5/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" type="text/css" href="assets/js/select.dataTables.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="table.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <title>Document</title>
</head>

<body>
    <?php
    require_once __DIR__ . "/../connection.php";
    if (!isset($_GET['name'])) {
        header("Location: /../login.php");
        exit;
    }
    if (isset($_POST['id'])) {
        $id = $_POST['id'];

        $stmt = $mysqlClient->prepare(
            "DELETE FROM appointments WHERE id = :id"
        );
        $stmt->execute([':id' => $id]);
    }

    // header("Location: manage_appointments.php");
    ?>
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
            <a class="navbar-brand brand-logo me-5" href="dashboard.php?name=<?= $_GET['name'] ?>"><img src="assets/images/Salama.svg" class="me-2"
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
                        <input type="text" class="form-control" id="navbar-search-input" placeholder="Search in table"
                            aria-label="search" aria-describedby="search">
                    </div>
                </li>
            </ul>
            <ul class="navbar-nav navbar-nav-right"></ul>
            <ul class="navbar-nav navbar-nav-right">
                <a class="nav-item nav-settings d-none d-lg-flex">
                    <select class="nav-link" id="sort">
                        <i class="icon-ellipsis"></i>
                        <option value="">Sort by</option>
                        <option value="date_asc">Date ↑</option>
                        <option value="date_desc">Date ↓</option>
                        <option value="lname_asc">Last name A–Z</option>
                        <option value="lname_desc">Last name Z–A</option>
                    </select>
                </a>
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                data-toggle="offcanvas">
                <span class="icon-menu"></span>
            </button>
        </div>
    </nav>
    <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link" href="dashboard.php?name=<?= $_GET['name'] ?>">
                        <i class="icon-grid menu-icon"></i>
                        <span class="menu-title">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="manage_appointments.php?name=<?= $_GET['name'] ?>">
                        <i class="icon-paper menu-icon"></i>
                        <span class="menu-title">Appointments</span>
                    </a>
                </li>
            </ul>
        </nav>
        <div class="management_container container">
            <table class="appointment_table">
                <tr>
                    <thead>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Requested Service</th>
                        <th>Preferred Date</th>
                        <th>Actions</th>
                    </thead>
                </tr>
                <tbody id="appointments-body">
                    <?php

                    $sql_query = "SELECT * FROM `appointments` ";
                    $userStatement = $mysqlClient->query($sql_query);
                    $appointments = $userStatement->fetchAll();

                    foreach ($appointments as $appointment) {
                        echo "<tr>
                <td>" . $appointment['first_name'] . "</td>
                <td>" . $appointment['last_name'] . "</td>
                <td>" . $appointment['requested_service'] . "</td>
                <td class='date'>" . $appointment['preferred_date'] . "</td>
                <td class='buttons'>
                    <a href='details.php?id=" . $appointment['id'] . "' class='btn btn-sm' title='Show Appointment Details'>
                        <i class='fa-solid fa-eye'></i>
                    </a>
                    <a href='../appointment.php?id=" . $appointment['id'] . "'class='btn btn-sm' title='Edit Appointment'>
                        <i class='fa-solid fa-pen'></i>
                    </a>
                    <form method='POST'style='display:inline;' onsubmit='return confirm(\"Are you sure you want to delete this appointment?\");'>
                    <input type='hidden' name='id' value='" . $appointment['id'] . "'>
                    <button class='btn btn-sm' title='Delete Appointment'>
                     <i class='fa-solid fa-trash'></i>
                    </button>
                    </form>
                 
                    <a href='download.php?file=" . $appointment['medical_file'] . "' class='btn btn-sm' title='Download medical file'>
                        <i class='fa-solid fa-download'></i>
                    </a>


                    </td>
                    </tr>";
                    }


                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <script>
        function loadAppointments() {

            const search = document.getElementById('navbar-search-input').value;
            const sort = document.getElementById('sort').value;

            fetch(`fetch_appointment.php?search=${encodeURIComponent(search)}&sort=${sort}`)
                .then(res => res.text())
                .then(html => {
                    document.getElementById('appointments-body').innerHTML = html;
                });
        }

        document.getElementById('navbar-search-input').addEventListener('input', loadAppointments);
        document.getElementById('sort').addEventListener('change', loadAppointments);
    </script>
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
</body>

</html>