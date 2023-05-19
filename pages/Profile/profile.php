<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
  // Redirect the user to the login page if not logged in
  header("Location: login.php");
  exit();
}

// Get the teacher ID from the session
$teacherId = $_SESSION['user_id'];

// Continue displaying the dashboard or perform any actions specific to the logged-in teacher
// You can use the $teacherId variable to query the database or display information specific to the teacher

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../../assets/img/favicon.png">
  <title>
    Student App by Creative Tim
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="../../assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="../../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="../../assets/css/soft-ui-dashboard.css?v=1.0.7" rel="stylesheet" />
</head>

<body class="g-sidenav-show bg-gray-100">
<?php
 include '../sidebar/side.php';
 ?>
  <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg bg-transparent shadow-none position-absolute px-4 w-100 z-index-2">
      <div class="container-fluid py-1">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 ps-2 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="text-white opacity-5" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">Profile</li>
          </ol>
          <h6 class="text-white font-weight-bolder ms-2">Profile</h6>
        </nav>
        <div class="collapse navbar-collapse me-md-0 me-sm-4 mt-sm-0 mt-2" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            
          </div>
          <ul class="navbar-nav justify-content-end">
           
         
            <li class="nav-item d-xl-none ps-3 pe-0 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-white p-0">
                <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                  <div class="sidenav-toggler-inner">
                    <i class="sidenav-toggler-line bg-white"></i>
                    <i class="sidenav-toggler-line bg-white"></i>
                    <i class="sidenav-toggler-line bg-white"></i>
                  </div>
                </a>
              </a>
            </li>
            
          </ul>
        </div>
      </div>
    </nav>
    <!-- End Navbar -->
         <?php

require_once("../config/connect.inc.php");

// Connexion to the database
$conn = connect();

// Get the user ID and user type from the session
$userId = $_SESSION['user_id'];
$userType = $_SESSION['user_type'];

// Define the table and column names based on the user type
$table = '';
$idColumn = '';
$nameColumn = '';
$emailColumn = '';

if ($userType === 'admin') {
    $table = 'admins';
    $idColumn = 'id';
    $nameColumn = 'nom';
    $emailColumn = 'email';
} elseif ($userType === 'teacher') {
    $table = 'enseignants';
    $idColumn = 'id';
    $nameColumn = 'nom';
    $emailColumn = 'email';
} elseif ($userType === 'student') {
    $table = 'etudiants';
    $idColumn = 'id';
    $nameColumn = 'nom';
    $emailColumn = 'email';
}

// Query to retrieve user information from the respective table
$query = "SELECT * FROM $table WHERE $idColumn = :user_id";
$stmt = $conn->prepare($query);
$stmt->bindValue(':user_id', $userId, PDO::PARAM_INT);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);
$userTypeLabel = '';

if ($userType === 'admin') {
    $userTypeLabel = 'Admin';
} elseif ($userType === 'teacher') {
    $userTypeLabel = 'Teacher';
} elseif ($userType === 'student') {
    $userTypeLabel = 'Student';
}
// Display the user profile information
?>
    <div class="container-fluid">
      <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('../../assets/img/curved-images/curved0.jpg'); background-position-y: 50%;">
        <span class="mask bg-gradient-primary opacity-6"></span>
      </div>
      <div class="card card-body blur shadow-blur mx-4 mt-n6 overflow-hidden">
        <div class="row gx-4">
          <div class="col-auto">
            <div class="avatar avatar-xl position-relative">
              <img src="../../assets/img/bruce-mars.jpg" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
            </div>
          </div>
          <div class="col-auto my-auto">
            <div class="h-100">
              <h5 class="mb-1">
              <?php echo $user[$nameColumn]; ?>
              </h5>
              <p class="mb-0 font-weight-bold text-sm">
              <?php echo $userTypeLabel; ?>
              </p>
            </div>
          </div>
          
        </div>
      </div>
    </div>
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12 col-xl-4">
          
        </div>
   
<div class="col-md-12">
    <div class="card h-100">
        <div class="card-header pb-0 p-3">
            <div class="row">
                <div class="col-md-8 d-flex align-items-center">
                    <h6 class="mb-0">Profile Information</h6>
                </div>
             
            </div>
        </div>
        <div class="card-body p-3">
            <p class="text-sm">
                Hi, i am <span><?php echo $user[$nameColumn]; ?></span> Decisions: If you can’t decide, the answer is no. If two equally difficult paths, choose the one more painful in the short term (pain avoidance is creating an illusion of equality).
            </p>
            <hr class="horizontal gray-light my-4">
            <ul class="list-group">
                <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Full Name:</strong> &nbsp; <?php echo $user[$nameColumn]; ?></li>
                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Email:</strong> &nbsp; <?php echo $user[$emailColumn]; ?></li>
                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Location:</strong> &nbsp; Tunisia</li>
                <li class="list-group-item border-0 ps-0 pb-0">
                    <strong class="text-dark text-sm">Social:</strong> &nbsp;
                    <a class="btn btn-facebook btn-simple mb-0 ps-1 pe-2 py-0" href="javascript:;">
                        <i class="fab fa-facebook fa-lg"></i>
                    </a>
                    <a class="btn btn-twitter btn-simple mb-0 ps-1 pe-2 py-0" href="javascript:;">
                        <i class="fab fa-twitter fa-lg"></i>
                    </a>
                    <a class="btn btn-instagram btn-simple mb-0 ps-1 pe-2 py-0" href="javascript:;">
                        <i class="fab fa-instagram fa-lg"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>

      </div>
     
    </div>
  </div>
 
  <!--   Core JS Files   -->
  <script src="../../assets/js/core/popper.min.js"></script>
  <script src="../../assets/js/core/bootstrap.min.js"></script>
  <script src="../../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../../assets/js/plugins/smooth-scrollbar.min.js"></script>

  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../../assets/js/soft-ui-dashboard.min.js?v=1.0.7"></script>
</body>

</html>