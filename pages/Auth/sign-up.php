
<?php include('server.php') ?>

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

<body class="">
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg position-absolute top-0 z-index-3 w-100 shadow-none my-3 navbar-transparent mt-4">
    <div class="container">
      
      <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon mt-2">
          <span class="navbar-toggler-bar bar1"></span>
          <span class="navbar-toggler-bar bar2"></span>
          <span class="navbar-toggler-bar bar3"></span>
        </span>
      </button>
      <div class=" navbar-collapse justify-content-center" id="navigation">
              <ul class="navbar-nav mx-auto ms-9 me-6">
          
          
          <li class="nav-item">
            <a class="nav-link me-2" href="../pages/sign-up.php">
              <i class="fas fa-user-circle opacity-6  me-1"></i>
              Sign Up
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link me-2" href="../auth/sign-in.html">
              <i class="fas fa-key opacity-6  me-1"></i>
              Sign In
            </a>
          </li>
        </ul>
        
      </div>
    </div>
  </nav>
  <!-- End Navbar -->
  <main class="main-content  mt-0">
    <section class="min-vh-100 mb-8">
      <div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg" style="background-image: url('../../assets/img/curved-images/curved14.jpg');">
        <span class="mask bg-gradient-dark opacity-6"></span>
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-5 text-center mx-auto">
              <h1 class="text-white mb-2 mt-5">Welcome!</h1>
              <p class="text-lead text-white">Complete these forms to create a  new account for free.</p>
            </div>
          </div>
        </div>
      </div>
      <div class="container">
        <div class="row mt-lg-n10 mt-md-n11 mt-n10">
          <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
            <div class="card z-index-0">
              <div class="card-header text-center pt-4">
                <h5>Register!</h5>
              </div>
           
              <div class="card-body">
              <form role="form" method="post" action="server.php">
  <div class="mb-3">
  <input type="text" class="form-control" placeholder="Nom" aria-label="Nom" aria-describedby="nom-addon" required name="nom">
  </div>
  <div class="mb-3">
    <input type="email" class="form-control" placeholder="Email" aria-label="Email" aria-describedby="email-addon" required name="email">
  </div>
  <div class="mb-3">
    <input type="password" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="password-addon" required name="password_1">
  </div>
  <div class="mb-3">
    <input type="password" class="form-control" placeholder="Confirm Password" aria-label="Password" aria-describedby="password-addon" required name="password_2">
  </div>
  <div class="d-flex justify-content-center">
  <div class="form-check form-check-inline ">
    <input class="form-check-input" type="checkbox" id="isStudent" name="isStudent" value="1">
    <label class="form-check-label" for="isStudent">Student</label>
  </div>
  <div class="form-check form-check-inline">
    <input class="form-check-input" type="checkbox" id="isTeacher" name="isTeacher" value="1">
    <label class="form-check-label" for="isTeacher">Teacher</label>
  </div></div>

  <div class="text-center">
    <button type="submit" name="reg_user" class="btn bg-gradient-dark w-100 my-4 mb-2">Sign up</button>
  </div>
  <p class="text-sm mt-3 mb-0">Already have an account? <a href="sign-in.html" class="text-dark font-weight-bolder">Sign in</a></p>
</form>

              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
   </main>
  <!--   Core JS Files   -->
  <script src="../../assets/js/core/popper.min.js"></script>
  <script src="../../assets/js/core/bootstrap.min.js"></script>
  <script src="../../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../../assets/js/soft-ui-dashboard.min.js?v=1.0.7"></script>
</body>

</html>