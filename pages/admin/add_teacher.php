<?php
session_start();

// Check if the user is logged in as a teacher
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'admin') {
    // Redirect to the login page or any other appropriate page
    header('location: ../error/error.php');
    exit(); // Make sure to exit after redirection
}



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

<body class="g-sidenav-show  bg-gray-100">
<?php
 include '../sidebar/side.php';
 ?>
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Add Teacher</li>
          </ol>
          <h6 class="font-weight-bolder mb-0">Add</h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
        
          </div>
          <ul class="navbar-nav  justify-content-end">
            
       
            <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                </div>
              </a>
            </li>
     
          </ul>
        </div>
      </div>
    </nav>
    <!-- End Navbar -->
    <?php
require_once("../config/connect.inc.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Connexion a la base de donnees
  $conn = connect();

  // Collect form data
  $name = $_POST["name"];
  $email = $_POST["email"];
  $password = $_POST["password"];

  // Prepare the SQL statement to insert a new teacher
  $stmt = $conn->prepare("INSERT INTO enseignants (nom, email, mot_de_passe) VALUES (:name, :email, :password)");
  $stmt->bindParam(':name', $name);
  $stmt->bindParam(':email', $email);
  $stmt->bindParam(':password', $password);

  try {
    // Execute the statement
    $stmt->execute();

    // Redirect back to the teachers page or any other desired location
    exit();
  } catch (PDOException $e) {
    // Handle the exception or display an error message
    echo "Error: " . $e->getMessage();
  }

  // Close the database connection
  $conn = null;
}
?>

<!-- Rest of your HTML code -->


<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12 mt-4">
            <div class="card">
                <div class="card-header pb-0 px-3">
                    <h6 class="mb-0">User Information</h6>
                </div>
                <div class="card-body pt-4 p-3">
                    <form action="add_teacher.php" method="POST">
                     
                        <div class="form-group mt-3">
                            <label for="name"> Username</label>
                            <input type="text" class="form-control"  id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="email"> Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="password"> Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Add Teacher</button>
</form>
</div>
</div>
</div></div>
</div>

  </main>

  
  
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