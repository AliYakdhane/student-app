<?php
session_start();

// Check if the user is logged in as a teacher
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'teacher') {
    // Redirect to the login page or any other appropriate page
    header('location: ../error/error.php');
    exit(); // Make sure to exit after redirection
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
    Student App
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

    <!-- End Navbar -->
    <div class="container-fluid py-4">
      
    <div class="page-header min-height-300 border-radius-xl " style="background-image: url('../../assets/img/curved-images/curved0.jpg'); background-position-y: 50%;">
        <span class="mask bg-gradient-primary opacity-6"></span>
    
      </div>  
      
      <div class="row my-4">
        <div class="col-lg-12 col-md-6 mb-md-0 mb-4">
        <?php
require_once("../config/connect.inc.php");

// Connexion a la base de donnees
$conn = connect();

$query_courses = "SELECT COUNT(*) as count FROM cours";

// Execute the query for courses
$result_courses = $conn->query($query_courses);

// Fetch the result as an associative array
$row_courses = $result_courses->fetch(PDO::FETCH_ASSOC);

// Get the count from the row
$count_courses = $row_courses['count'];

// Get the ID of the logged-in teacher (Assuming you have stored it in a variable named $teacher_id)
$teacherId = $_SESSION['user_id'];

// Query to get courses added by the logged-in teacher
$req_courses = "SELECT c.id, c.nom, c.enseignant_id, c.fichier, e.nom AS enseignant_nom
                FROM cours c
                INNER JOIN enseignants e ON c.enseignant_id = e.id
                WHERE c.enseignant_id = :teacher_id";

// Prepare the statement
$stmt = $conn->prepare($req_courses);
$stmt->bindParam(':teacher_id', $teacherId);

// Execute the query for courses
$stmt->execute();
$resultat_courses = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo '<div class="card mt-n6">';
echo '<div class="card-body px-0 pb-2">';
echo '<div class="table-responsive">';
  
// Display course count outside the table
echo '<div class="d-flex justify-content-between">';
echo '<div class="mx-4">';

echo '</div>';

// Add the button here
echo '<div class=" mx-4">';
echo '<a href="add_course.php"><button class="btn btn-primary">Add Cours</button></a>';
echo '</div>';
echo '</div>';
// Display table of courses
echo '<form id="formDelete" action="delete_selected.php" method="post">';
echo '<table class="table align-items-center mb-0">';
echo '<thead>
        <tr>
          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"><div class="form-check"><input class="form-check-input" type="checkbox" id="selectAll"></div></th>
          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Id</th>
          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Course Name</th>
          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Teacher Name</th>
          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">File</th>
          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actions</th>
        </tr>
      </thead>';

// Display tbody tag inside the loop
echo '<tbody>';

// Loop through the results for courses
foreach ($resultat_courses as $ligne) {
  echo "<tr>";
  echo "<td>";
  echo "<div class='form-check'>";
  echo "<input class='form-check-input' type='checkbox' name='selectedCourses[]' value='" . $ligne["id"] . "'>";
  echo "</div>";
  echo "</td>";
  echo "<td>";
  echo "<div class='d-flex px-2 py-1'>";
  echo "<div class='d-flex flex-column justify-content-center'>";
  echo "<h6 class='mb-0 text-sm'>" . $ligne["id"] . "</h6>";
  echo "</div>";
  echo "</div>";
  echo "</td>";
  echo "<td class='align-middle text-center text-sm'>";
  echo "<span class='text-xs font-weight-bold'>" . $ligne["nom"] . "</span>";
  echo "</td>";
  echo "<td class='align-middle'>";
  echo "<div class='progress-wrapper w-75 mx-auto'>";
  echo "<div class='progress-info text-center'>";
  echo "<div class='progress-percentage'>";
  echo "<span class='text-xs font-weight-bold'>" . $ligne["enseignant_nom"] . "</span>";
  echo "</div>";
  echo "<div class='progress-percentage'>";
  echo "</div>";
  echo "</div>";
  echo "</td>";
  echo "<td class='align-middle text-center text-sm'>";
  echo "<a href='../file/" . $ligne["fichier"] . "' download>" . $ligne["fichier"] . "</a>";
  echo "</td>";
  echo "<td class='align-middle'>";
  echo '<div class="ms-auto text d-flex justify-content-center ">';
  echo '<a class="btn btn-link px-3 mb-0" href="javascript:;" onclick="if(confirm(\'Are you sure you want to delete this course?\')){window.location.href=\'delete.php?id=' . $ligne["id"] . '\';}" style="color: red;"><i class="far fa-trash-alt me-2"></i>Delete</a>';
  echo '<a href="update.php?id=' . $ligne["id"] . '" class="btn btn-link text-dark px-3 mb-0">';
  echo '<i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Edit</a>';
  echo "</tr>";
}

// Close the tbody and other HTML tags
echo '</tbody>';
echo '</table>';

// Add the delete button and script
echo '<div class="text-center mt-4">';
echo '<button class="btn btn-danger" id="deleteSelected">Delete Selected</button>';
echo '</div>';
echo '</form>';
echo '</div>';
echo '</div>';
echo '</div>';

// Add JavaScript code to handle select all and delete selected functionality
echo '<script>';
echo 'document.addEventListener("DOMContentLoaded", function() {';
echo 'const selectAllCheckbox = document.getElementById("selectAll");';
echo 'const deleteSelectedButton = document.getElementById("deleteSelected");';
echo 'const checkboxes = document.querySelectorAll(\'input[name="selectedCourses[]"]\');';
echo 'selectAllCheckbox.addEventListener("change", function() {';
echo 'checkboxes.forEach(function(checkbox) {';
echo 'checkbox.checked = selectAllCheckbox.checked;';
echo '});';
echo '});';
echo 'deleteSelectedButton.addEventListener("click", function() {';
echo 'if (confirm("Are you sure you want to delete the selected courses?")) {';
echo 'document.getElementById("formDelete").submit();';
echo '}';
echo '});';
echo '});';
echo '</script>';

?>





    
        </div>
        
      </div>
      
    </div>
  </main>
  <div class="modal" id="editModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      </div></div></div>


  <!--   Core JS Files   -->
  <script src="../../assets/js/core/popper.min.js"></script>
  <script src="../../assets/js/core/bootstrap.min.js"></script>
  <script src="../../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="../../assets/js/plugins/chartjs.min.js"></script>
  <script>
    var ctx = document.getElementById("chart-bars").getContext("2d");

    new Chart(ctx, {
      type: "bar",
      data: {
        labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        datasets: [{
          label: "Sales",
          tension: 0.4,
          borderWidth: 0,
          borderRadius: 4,
          borderSkipped: false,
          backgroundColor: "#fff",
          data: [450, 200, 100, 220, 500, 100, 400, 230, 500],
          maxBarThickness: 6
        }, ],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: false,
          }
        },
        interaction: {
          intersect: false,
          mode: 'index',
        },
        scales: {
          y: {
            grid: {
              drawBorder: false,
              display: false,
              drawOnChartArea: false,
              drawTicks: false,
            },
            ticks: {
              suggestedMin: 0,
              suggestedMax: 500,
              beginAtZero: true,
              padding: 15,
              font: {
                size: 14,
                family: "Open Sans",
                style: 'normal',
                lineHeight: 2
              },
              color: "#fff"
            },
          },
          x: {
            grid: {
              drawBorder: false,
              display: false,
              drawOnChartArea: false,
              drawTicks: false
            },
            ticks: {
              display: false
            },
          },
        },
      },
    });


    var ctx2 = document.getElementById("chart-line").getContext("2d");

    var gradientStroke1 = ctx2.createLinearGradient(0, 230, 0, 50);

    gradientStroke1.addColorStop(1, 'rgba(203,12,159,0.2)');
    gradientStroke1.addColorStop(0.2, 'rgba(72,72,176,0.0)');
    gradientStroke1.addColorStop(0, 'rgba(203,12,159,0)'); //purple colors

    var gradientStroke2 = ctx2.createLinearGradient(0, 230, 0, 50);

    gradientStroke2.addColorStop(1, 'rgba(20,23,39,0.2)');
    gradientStroke2.addColorStop(0.2, 'rgba(72,72,176,0.0)');
    gradientStroke2.addColorStop(0, 'rgba(20,23,39,0)'); //purple colors

    new Chart(ctx2, {
      type: "line",
      data: {
        labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        datasets: [{
            label: "Mobile apps",
            tension: 0.4,
            borderWidth: 0,
            pointRadius: 0,
            borderColor: "#cb0c9f",
            borderWidth: 3,
            backgroundColor: gradientStroke1,
            fill: true,
            data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
            maxBarThickness: 6

          },
          {
            label: "Websites",
            tension: 0.4,
            borderWidth: 0,
            pointRadius: 0,
            borderColor: "#3A416F",
            borderWidth: 3,
            backgroundColor: gradientStroke2,
            fill: true,
            data: [30, 90, 40, 140, 290, 290, 340, 230, 400],
            maxBarThickness: 6
          },
        ],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: false,
          }
        },
        interaction: {
          intersect: false,
          mode: 'index',
        },
        scales: {
          y: {
            grid: {
              drawBorder: false,
              display: true,
              drawOnChartArea: true,
              drawTicks: false,
              borderDash: [5, 5]
            },
            ticks: {
              display: true,
              padding: 10,
              color: '#b2b9bf',
              font: {
                size: 11,
                family: "Open Sans",
                style: 'normal',
                lineHeight: 2
              },
            }
          },
          x: {
            grid: {
              drawBorder: false,
              display: false,
              drawOnChartArea: false,
              drawTicks: false,
              borderDash: [5, 5]
            },
            ticks: {
              display: true,
              color: '#b2b9bf',
              padding: 20,
              font: {
                size: 11,
                family: "Open Sans",
                style: 'normal',
                lineHeight: 2
              },
            }
          },
        },
      },
    });
  </script>
  <script>
function openModal(id, username, email) {
  // Get the modal element
  var modal = document.getElementById("edit-modal");

  // Set the values of the input fields in the modal
  modal.querySelector("#id-input").value = id;
  modal.querySelector("#username-input").value = username;
  modal.querySelector("#email-input").value = email;

  // Show the modal
  modal.style.display = "block";
}
</script>

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