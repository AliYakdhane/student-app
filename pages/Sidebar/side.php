<?php

// Check if the user is logged in
if (!isset($_SESSION['user_type'])) {
    // Redirect to the login page or any other appropriate page
    header('location: ../../error/error.php');
    exit(); // Make sure to exit after redirection
}

// Get the user type
$userType = $_SESSION['user_type'];

$current_page = basename($_SERVER['PHP_SELF']);

if ($userType === 'student') {
    $dashboard_link = '../student/student_dashboard.php';
    $notes_link = '../student/notes.php';

    // Add the "active" class to the link if the current page matches
    $dashboard_class = ($current_page === 'student_dashboard.php') ? 'active' : '';
    $notes_class = ($current_page === 'notes.php') ? 'active' : '';}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
      <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="../../../assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../../../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="../../../../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="../../../../assets/css/soft-ui-dashboard.css?v=1.0.7" rel="stylesheet" />
</head>
<body>
<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 " id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href=" https://demos.creative-tim.com/soft-ui-dashboard/pages/dashboard.html " target="_blank">
        <img src="../../../../assets/img/logo-ct-dark.png" class="navbar-brand-img h-100" alt="main_logo">
        <span class="ms-1 font-weight-bold">Student App</span>
      </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto h-75 " id="sidenav-collapse-main">
      <ul class="navbar-nav">
      <?php if ($userType === 'student') { ?>
          <li class="nav-item">
    <a class="nav-link " href="../student/student_dashboard.php">
      <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
        <svg width="12px" height="12px" viewBox="0 0 45 40" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
          <title>shop </title>
          <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
            <g transform="translate(-1716.000000, -439.000000)" fill="#FFFFFF" fill-rule="nonzero">
              <g transform="translate(1716.000000, 291.000000)">
                <g transform="translate(0.000000, 148.000000)">
                  <path class="color-background opacity-6" d="M46.7199583,10.7414583 L40.8449583,0.949791667 C40.4909749,0.360605034 39.8540131,0 39.1666667,0 L7.83333333,0 C7.1459869,0 6.50902508,0.360605034 6.15504167,0.949791667 L0.280041667,10.7414583 C0.0969176761,11.0460037 -1.23209662e-05,11.3946378 -1.23209662e-05,11.75 C-0.00758042603,16.0663731 3.48367543,19.5725301 7.80004167,19.5833333 L7.81570833,19.5833333 C9.75003686,19.5882688 11.6168794,18.8726691 13.0522917,17.5760417 C16.0171492,20.2556967 20.5292675,20.2556967 23.494125,17.5760417 C26.4604562,20.2616016 30.9794188,20.2616016 33.94575,17.5760417 C36.2421905,19.6477597 39.5441143,20.1708521 42.3684437,18.9103691 C45.1927731,17.649886 47.0084685,14.8428276 47.0000295,11.75 C47.0000295,11.3946378 46.9030823,11.0460037 46.7199583,10.7414583 Z"></path>
                  <path class="color-background" d="M39.198,22.4912623 C37.3776246,22.4928106 35.5817531,22.0149171 33.951625,21.0951667 L33.92225,21.1107282 C31.1430221,22.6838032 27.9255001,22.9318916 24.9844167,21.7998837 C24.4750389,21.605469 23.9777983,21.3722567 23.4960833,21.1018359 L23.4745417,21.1129513 C20.6961809,22.6871153 17.4786145,22.9344611 14.5386667,21.7998837 C14.029926,21.6054643 13.533337,21.3722507 13.0522917,21.1018359 C11.4250962,22.0190609 9.63246555,22.4947009 7.81570833,22.4912623 C7.16510551,22.4842162 6.51607673,22.4173045 5.875,22.2911849 L5.875,44.7220845 C5.875,45.9498589 6.7517757,46.9451667 7.83333333,46.9451667 L19.5833333,46.9451667 L19.5833333,33.6066734 L27.4166667,33.6066734 L27.4166667,46.9451667 L39.1666667,46.9451667 C40.2482243,46.9451667 41.125,45.9498589 41.125,44.7220845 L41.125,22.2822926 C40.4887822,22.4116582 39.8442868,22.4815492 39.198,22.4912623 Z"></path>
                </g>
              </g>
            </g>
          </g>
        </svg>
      </div>
      <span class="nav-link-text ms-1">Cours</span>
    </a>
  </li>
  <?php } elseif ($userType === 'teacher') { ?>
      <li class="nav-item">
    <a class="nav-link " href="../teacher/teacher_dashboard.php">
      <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
        <svg width="12px" height="12px" viewBox="0 0 45 40" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
          <title>dashboard</title>
          <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
            <g transform="translate(-1720.000000, -592.000000)" fill="#FFFFFF" fill-rule="nonzero">
              <g transform="translate(1720.000000, 291.000000)">
                <g transform="translate(0.000000, 301.000000)">
                  <path class="color-background" d="M40,0 L40,34 C40,36.209139 38.209139,38 36,38 L4,38 C1.790861,38 3.10862447e-16,36.209139 0,34 L0,4 C1.10862447e-16,1.790861 1.790861,1.29893405e-16 4,0 L40,0 Z M36,2 C34.8954305,2 34,2.8954305 34,4 L34,34 C34,35.1045695 34.8954305,36 36,36 L38,36 L38,2 L36,2 Z M15,19 L13,19 L13,29 C13,30.1045695 13.8954305,31 15,31 L25,31 L25,29 L15,29 L15,19 Z M23,19 L21,19 L21,26 L23,26 L23,19 Z M17,19 L19,19 L19,24 L17,24 L17,19 Z M9,19 L11,19 L11,22 L9,22 L9,19 Z" opacity="0.6"></path>
                  <path class="color-background" d="M15,8 L25,8 C26.1045695,8 27,8.8954305 27,10 L27,16 C27,17.1045695 26.1045695,18 25,18 L15,18 C13.8954305,18 13,17.1045695 13,16 L13,10 C13,8.8954305 13.8954305,8 15,8 Z M15,10 L15,16 L25,16 L25,10 L15,10 Z" opacity="0.6"></path>
                </g>
              </g>
            </g>
          </g>
        </svg>
      </div>
      <span class="nav-link-text ms-1">Teacher Dashboard</span>
    </a>
  </li>
  <?php } elseif ($userType === 'admin') { ?>
  <li class="nav-item">
    <a class="nav-link " href="../admin/dashboard.php">
      <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
        <svg width="12px" height="12px" viewBox="0 0 45 40" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
          <title>dashboard</title>
          <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
            <g transform="translate(-1720.000000, -592.000000)" fill="#FFFFFF" fill-rule="nonzero">
              <g transform="translate(1720.000000, 291.000000)">
                <g transform="translate(0.000000, 301.000000)">
                  <path class="color-background" d="M40,0 L40,34 C40,36.209139 38.209139,38 36,38 L4,38 C1.790861,38 3.10862447e-16,36.209139 0,34 L0,4 C1.10862447e-16,1.790861 1.790861,1.29893405e-16 4,0 L40,0 Z M36,2 C34.8954305,2 34,2.8954305 34,4 L34,34 C34,35.1045695 34.8954305,36 36,36 L38,36 L38,2 L36,2 Z M15,19 L13,19 L13,29 C13,30.1045695 13.8954305,31 15,31 L25,31 L25,29 L15,29 L15,19 Z M23,19 L21,19 L21,26 L23,26 L23,19 Z M17,19 L19,19 L19,24 L17,24 L17,19 Z M9,19 L11,19 L11,22 L9,22 L9,19 Z" opacity="0.6"></path>
                  <path class="color-background" d="M15,8 L25,8 C26.1045695,8 27,8.8954305 27,10 L27,16 C27,17.1045695 26.1045695,18 25,18 L15,18 C13.8954305,18 13,17.1045695 13,16 L13,10 C13,8.8954305 13.8954305,8 15,8 Z M15,10 L15,16 L25,16 L25,10 L15,10 Z" opacity="0.6"></path>
                </g>
              </g>
            </g>
          </g>
        </svg>
      </div>
      <span class="nav-link-text ms-1">Teachers</span>
    </a>
  </li>
<?php } ?>


<?php if ($userType === 'student') { ?>
          <li class="nav-item">
    <a class="nav-link " href="../student/notes.php">
      <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
        <svg width="12px" height="12px" viewBox="0 0 45 40" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
          <title>shop </title>
          <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
            <g transform="translate(-1716.000000, -439.000000)" fill="#FFFFFF" fill-rule="nonzero">
              <g transform="translate(1716.000000, 291.000000)">
                <g transform="translate(0.000000, 148.000000)">
                  <path class="color-background opacity-6" d="M46.7199583,10.7414583 L40.8449583,0.949791667 C40.4909749,0.360605034 39.8540131,0 39.1666667,0 L7.83333333,0 C7.1459869,0 6.50902508,0.360605034 6.15504167,0.949791667 L0.280041667,10.7414583 C0.0969176761,11.0460037 -1.23209662e-05,11.3946378 -1.23209662e-05,11.75 C-0.00758042603,16.0663731 3.48367543,19.5725301 7.80004167,19.5833333 L7.81570833,19.5833333 C9.75003686,19.5882688 11.6168794,18.8726691 13.0522917,17.5760417 C16.0171492,20.2556967 20.5292675,20.2556967 23.494125,17.5760417 C26.4604562,20.2616016 30.9794188,20.2616016 33.94575,17.5760417 C36.2421905,19.6477597 39.5441143,20.1708521 42.3684437,18.9103691 C45.1927731,17.649886 47.0084685,14.8428276 47.0000295,11.75 C47.0000295,11.3946378 46.9030823,11.0460037 46.7199583,10.7414583 Z"></path>
                  <path class="color-background" d="M39.198,22.4912623 C37.3776246,22.4928106 35.5817531,22.0149171 33.951625,21.0951667 L33.92225,21.1107282 C31.1430221,22.6838032 27.9255001,22.9318916 24.9844167,21.7998837 C24.4750389,21.605469 23.9777983,21.3722567 23.4960833,21.1018359 L23.4745417,21.1129513 C20.6961809,22.6871153 17.4786145,22.9344611 14.5386667,21.7998837 C14.029926,21.6054643 13.533337,21.3722507 13.0522917,21.1018359 C11.4250962,22.0190609 9.63246555,22.4947009 7.81570833,22.4912623 C7.16510551,22.4842162 6.51607673,22.4173045 5.875,22.2911849 L5.875,44.7220845 C5.875,45.9498589 6.7517757,46.9451667 7.83333333,46.9451667 L19.5833333,46.9451667 L19.5833333,33.6066734 L27.4166667,33.6066734 L27.4166667,46.9451667 L39.1666667,46.9451667 C40.2482243,46.9451667 41.125,45.9498589 41.125,44.7220845 L41.125,22.2822926 C40.4887822,22.4116582 39.8442868,22.4815492 39.198,22.4912623 Z"></path>
                </g>
              </g>
            </g>
          </g>
        </svg>
      </div>
      <span class="nav-link-text ms-1">Notes</span>
    </a>
  </li>
  <?php } elseif ($userType === 'teacher') { ?>
      <li class="nav-item">
    <a class="nav-link " href="../teacher/list_students.php">
      <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
        <svg width="12px" height="12px" viewBox="0 0 45 40" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
          <title>dashboard</title>
          <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
            <g transform="translate(-1720.000000, -592.000000)" fill="#FFFFFF" fill-rule="nonzero">
              <g transform="translate(1720.000000, 291.000000)">
                <g transform="translate(0.000000, 301.000000)">
                  <path class="color-background" d="M40,0 L40,34 C40,36.209139 38.209139,38 36,38 L4,38 C1.790861,38 3.10862447e-16,36.209139 0,34 L0,4 C1.10862447e-16,1.790861 1.790861,1.29893405e-16 4,0 L40,0 Z M36,2 C34.8954305,2 34,2.8954305 34,4 L34,34 C34,35.1045695 34.8954305,36 36,36 L38,36 L38,2 L36,2 Z M15,19 L13,19 L13,29 C13,30.1045695 13.8954305,31 15,31 L25,31 L25,29 L15,29 L15,19 Z M23,19 L21,19 L21,26 L23,26 L23,19 Z M17,19 L19,19 L19,24 L17,24 L17,19 Z M9,19 L11,19 L11,22 L9,22 L9,19 Z" opacity="0.6"></path>
                  <path class="color-background" d="M15,8 L25,8 C26.1045695,8 27,8.8954305 27,10 L27,16 C27,17.1045695 26.1045695,18 25,18 L15,18 C13.8954305,18 13,17.1045695 13,16 L13,10 C13,8.8954305 13.8954305,8 15,8 Z M15,10 L15,16 L25,16 L25,10 L15,10 Z" opacity="0.6"></path>
                </g>
              </g>
            </g>
          </g>
        </svg>
      </div>
      <span class="nav-link-text ms-1">List of students</span>
    </a>
  </li>
<?php } elseif ($userType === 'admin') { ?>
  <li class="nav-item">
    <a class="nav-link " href="../admin/studentslist.php">
      <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
        <svg width="12px" height="12px" viewBox="0 0 45 40" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
          <title>dashboard</title>
          <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
            <g transform="translate(-1720.000000, -592.000000)" fill="#FFFFFF" fill-rule="nonzero">
              <g transform="translate(1720.000000, 291.000000)">
                <g transform="translate(0.000000, 301.000000)">
                  <path class="color-background" d="M40,0 L40,34 C40,36.209139 38.209139,38 36,38 L4,38 C1.790861,38 3.10862447e-16,36.209139 0,34 L0,4 C1.10862447e-16,1.790861 1.790861,1.29893405e-16 4,0 L40,0 Z M36,2 C34.8954305,2 34,2.8954305 34,4 L34,34 C34,35.1045695 34.8954305,36 36,36 L38,36 L38,2 L36,2 Z M15,19 L13,19 L13,29 C13,30.1045695 13.8954305,31 15,31 L25,31 L25,29 L15,29 L15,19 Z M23,19 L21,19 L21,26 L23,26 L23,19 Z M17,19 L19,19 L19,24 L17,24 L17,19 Z M9,19 L11,19 L11,22 L9,22 L9,19 Z" opacity="0.6"></path>
                  <path class="color-background" d="M15,8 L25,8 C26.1045695,8 27,8.8954305 27,10 L27,16 C27,17.1045695 26.1045695,18 25,18 L15,18 C13.8954305,18 13,17.1045695 13,16 L13,10 C13,8.8954305 13.8954305,8 15,8 Z M15,10 L15,16 L25,16 L25,10 L15,10 Z" opacity="0.6"></path>
                </g>
              </g>
            </g>
          </g>
        </svg>
      </div>
      <span class="nav-link-text ms-1">Students</span>
    </a>
  </li>

<?php } elseif ($userType === 'admin') { ?>
          <li class="nav-item">
    <a class="nav-link " href="../dashboard/edit.php">
      <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
        <svg width="12px" height="12px" viewBox="0 0 45 40" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
          <title>shop </title>
          <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
            <g transform="translate(-1716.000000, -439.000000)" fill="#FFFFFF" fill-rule="nonzero">
              <g transform="translate(1716.000000, 291.000000)">
                <g transform="translate(0.000000, 148.000000)">
                  <path class="color-background opacity-6" d="M46.7199583,10.7414583 L40.8449583,0.949791667 C40.4909749,0.360605034 39.8540131,0 39.1666667,0 L7.83333333,0 C7.1459869,0 6.50902508,0.360605034 6.15504167,0.949791667 L0.280041667,10.7414583 C0.0969176761,11.0460037 -1.23209662e-05,11.3946378 -1.23209662e-05,11.75 C-0.00758042603,16.0663731 3.48367543,19.5725301 7.80004167,19.5833333 L7.81570833,19.5833333 C9.75003686,19.5882688 11.6168794,18.8726691 13.0522917,17.5760417 C16.0171492,20.2556967 20.5292675,20.2556967 23.494125,17.5760417 C26.4604562,20.2616016 30.9794188,20.2616016 33.94575,17.5760417 C36.2421905,19.6477597 39.5441143,20.1708521 42.3684437,18.9103691 C45.1927731,17.649886 47.0084685,14.8428276 47.0000295,11.75 C47.0000295,11.3946378 46.9030823,11.0460037 46.7199583,10.7414583 Z"></path>
                  <path class="color-background" d="M39.198,22.4912623 C37.3776246,22.4928106 35.5817531,22.0149171 33.951625,21.0951667 L33.92225,21.1107282 C31.1430221,22.6838032 27.9255001,22.9318916 24.9844167,21.7998837 C24.4750389,21.605469 23.9777983,21.3722567 23.4960833,21.1018359 L23.4745417,21.1129513 C20.6961809,22.6871153 17.4786145,22.9344611 14.5386667,21.7998837 C14.029926,21.6054643 13.533337,21.3722507 13.0522917,21.1018359 C11.4250962,22.0190609 9.63246555,22.4947009 7.81570833,22.4912623 C7.16510551,22.4842162 6.51607673,22.4173045 5.875,22.2911849 L5.875,44.7220845 C5.875,45.9498589 6.7517757,46.9451667 7.83333333,46.9451667 L19.5833333,46.9451667 L19.5833333,33.6066734 L27.4166667,33.6066734 L27.4166667,46.9451667 L39.1666667,46.9451667 C40.2482243,46.9451667 41.125,45.9498589 41.125,44.7220845 L41.125,22.2822926 C40.4887822,22.4116582 39.8442868,22.4815492 39.198,22.4912623 Z"></path>
                </g>
              </g>
            </g>
          </g>
        </svg>
      </div>
      <span class="nav-link-text ms-1"></span>
    </a>
  </li>
  <?php } ?>

        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Account pages</h6>
        </li>
        <li class="nav-item">
          <a class="nav-link  " href="../Profile/profile.php">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
              <svg width="12px" height="12px" viewBox="0 0 46 42" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                <title>customer-support</title>
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                  <g transform="translate(-1717.000000, -291.000000)" fill="#FFFFFF" fill-rule="nonzero">
                    <g transform="translate(1716.000000, 291.000000)">
                      <g transform="translate(1.000000, 0.000000)">
                        <path class="color-background opacity-6" d="M45,0 L26,0 C25.447,0 25,0.447 25,1 L25,20 C25,20.379 25.214,20.725 25.553,20.895 C25.694,20.965 25.848,21 26,21 C26.212,21 26.424,20.933 26.6,20.8 L34.333,15 L45,15 C45.553,15 46,14.553 46,14 L46,1 C46,0.447 45.553,0 45,0 Z"></path>
                        <path class="color-background" d="M22.883,32.86 C20.761,32.012 17.324,31 13,31 C8.676,31 5.239,32.012 3.116,32.86 C1.224,33.619 0,35.438 0,37.494 L0,41 C0,41.553 0.447,42 1,42 L25,42 C25.553,42 26,41.553 26,41 L26,37.494 C26,35.438 24.776,33.619 22.883,32.86 Z"></path>
                        <path class="color-background" d="M13,28 C17.432,28 21,22.529 21,18 C21,13.589 17.411,10 13,10 C8.589,10 5,13.589 5,18 C5,22.529 8.568,28 13,28 Z"></path>
                      </g>
                    </g>
                  </g>
                </g>
              </svg>
            </div>
            <span class="nav-link-text ms-1">Profile</span>
          </a>
        </li>
        <li class="nav-item cursor-pointer">
          <a class="nav-link  "  onclick="location.href='../auth/logout.php'">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
            </div>
            <span class="nav-link-text ms-1">Log Out</span>
          </a>
        </li>

      </ul>
      <hr>
    </div>
  </aside>
</body>
</html>