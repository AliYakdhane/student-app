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

    <!-- End Navbar -->
    <div class="container-fluid py-2">
    <div class="page-header min-height-300 border-radius-xl " style="background-image: url('../../assets/img/curved-images/curved0.jpg'); background-position-y: 50%;">
        <span class="mask bg-gradient-primary opacity-6"></span>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Dashboard</li>
          </ol>
          <h6 class="font-weight-bolder mb-0">Dashboard</h6>
        </nav>
      </div>  
     
      
      
      <?php
require_once("../config/connect.inc.php");

// Connexion a la base de donnees
$conn = connect();

// Get the teacher ID from the session
$teacherId = $_SESSION['user_id'];

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Get the student ID and course ID from the form value
    $formValue = explode(',', $_POST['submit']);
    $studentId = $formValue[0];
    $courseId = $formValue[1];

    // Get the grade entered for the student and course
    $grade = $_POST['grade'][$studentId][$courseId];
    $examName = $_POST['exam_name'][$studentId][$courseId];

    // Save the grade in the database
    $query = "INSERT INTO notes (etudiant_id, cours_id, examen, note) VALUES (:etudiant_id, :cours_id, :examen, :note)";
    $stmt = $conn->prepare($query);
    $stmt->bindValue(':etudiant_id', $studentId, PDO::PARAM_INT);
    $stmt->bindValue(':cours_id', $courseId, PDO::PARAM_INT);
    $stmt->bindValue(':examen', $examName);
    $stmt->bindValue(':note', $grade);
    $stmt->execute();
}

// Check if the "Save All" button is clicked
if (isset($_POST['save_all'])) {
    foreach ($_POST['grade'] as $studentId => $courses) {
        foreach ($courses as $courseId => $grade) {
            $examName = $_POST['exam_name'][$studentId][$courseId];

            // Save the grade in the database
            $query = "INSERT INTO notes (etudiant_id, cours_id, examen, note) VALUES (:etudiant_id, :cours_id, :examen, :note)";
            $stmt = $conn->prepare($query);
            $stmt->bindValue(':etudiant_id', $studentId, PDO::PARAM_INT);
            $stmt->bindValue(':cours_id', $courseId, PDO::PARAM_INT);
            $stmt->bindValue(':examen', $examName);
            $stmt->bindValue(':note', $grade);
            $stmt->execute();
        }
    }
}

// Check if the "Delete All" button is clicked
if (isset($_POST['delete_all'])) {
    // Delete all grades from the database
    $deleteGradesQuery = "DELETE FROM notes";
    $deleteGradesStmt = $conn->prepare($deleteGradesQuery);
    $deleteGradesStmt->execute();

    // Delete all student-course associations from the database
    $deleteStudentCoursesQuery = "DELETE FROM student_courses";
    $deleteStudentCoursesStmt = $conn->prepare($deleteStudentCoursesQuery);
    $deleteStudentCoursesStmt->execute();
}

// Check if the "Delete" button is clicked for individual grade
if (isset($_POST['delete'])) {
    // Get the student ID and course ID from the form value
    $formValue = explode(',', $_POST['delete']);
    $studentId = $formValue[0];
    $courseId = $formValue[1];

    // Delete the grade from the database
    $deleteGradeQuery = "DELETE FROM notes WHERE etudiant_id = :etudiant_id AND cours_id = :cours_id";
    $deleteGradeStmt = $conn->prepare($deleteGradeQuery);
    $deleteGradeStmt->bindValue(':etudiant_id', $studentId, PDO::PARAM_INT);
    $deleteGradeStmt->bindValue(':cours_id', $courseId, PDO::PARAM_INT);
    $deleteGradeStmt->execute();

    // Delete the student from the course
    $deleteStudentCourseQuery = "DELETE FROM student_courses WHERE student_id = :student_id AND course_id = :course_id";
    $deleteStudentCourseStmt = $conn->prepare($deleteStudentCourseQuery);
    $deleteStudentCourseStmt->bindValue(':student_id', $studentId, PDO::PARAM_INT);
    $deleteStudentCourseStmt->bindValue(':course_id', $courseId, PDO::PARAM_INT);
    $deleteStudentCourseStmt->execute();
}

// Check if the "Delete Selected" button is clicked
if (isset($_POST['delete_selected'])) {
    // Loop through the selected checkboxes
    foreach ($_POST['selected_students'] as $selectedStudent) {
        // Get the student ID and course ID from the form value
        $formValue = explode(',', $selectedStudent);
        $studentId = $formValue[0];
        $courseId = $formValue[1];

        // Delete the grade from the database
        $deleteGradeQuery = "DELETE FROM notes WHERE etudiant_id = :etudiant_id AND cours_id = :cours_id";
        $deleteGradeStmt = $conn->prepare($deleteGradeQuery);
        $deleteGradeStmt->bindValue(':etudiant_id', $studentId, PDO::PARAM_INT);
        $deleteGradeStmt->bindValue(':cours_id', $courseId, PDO::PARAM_INT);
        $deleteGradeStmt->execute();

        // Delete the student from the course
        $deleteStudentCourseQuery = "DELETE FROM student_courses WHERE student_id = :student_id AND course_id = :course_id";
        $deleteStudentCourseStmt = $conn->prepare($deleteStudentCourseQuery);
        $deleteStudentCourseStmt->bindValue(':student_id', $studentId, PDO::PARAM_INT);
        $deleteStudentCourseStmt->bindValue(':course_id', $courseId, PDO::PARAM_INT);
        $deleteStudentCourseStmt->execute();
    }
}

// Query to retrieve the students and their subscribed courses taught by the teacher
$query_students = "SELECT e.id, e.nom AS student_nom, e.email, c.id AS course_id, c.nom AS course_nom
                   FROM etudiants e
                   LEFT JOIN student_courses sc ON e.id = sc.student_id
                   LEFT JOIN cours c ON sc.course_id = c.id
                   WHERE c.enseignant_id = :teacher_id
                   GROUP BY e.id, e.nom, e.email, c.id, c.nom";
$stmt_students = $conn->prepare($query_students);
$stmt_students->bindValue(':teacher_id', $teacherId, PDO::PARAM_INT);
$stmt_students->execute();
$result_students = $stmt_students->fetchAll(PDO::FETCH_ASSOC);

// Display the list of students and their subscribed courses
echo '<div class="card mt-n6">
  <div class="card-body px-0 pb-2">
    <div class="table-responsive">
    <form method="POST" action="">
      <table class="table align-items-center mb-0 table-minimize-margin">
        <thead>
          <tr>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="selectAll">
                <label class="form-check-label" for="selectAll"></label>
              </div>
            </th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Student Name</th>
            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 th-minimize-margin">Email</th>
            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 th-minimize-margin">Course</th>
            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 th-minimize-margin">Exam</th>
            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 th-minimize-margin">Grade</th>
            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 th-minimize-margin">Action</th>
          </tr>
        </thead>
        <tbody>';

// Loop through the results for teachers
foreach ($result_students as $student) {
  echo "<tr>";
  echo "<td>";
  echo "<div class='d-flex px-2 py-1'>";
  echo "<div class='d-flex flex-column justify-content-center'>";
  echo "<div class='form-check'>";
  echo "<input class='form-check-input' type='checkbox' name='selected_students[]' value='" . $student['id'] . "," . $student['course_id'] . "'>";
  echo "<label class='form-check-label'></label>";
  echo "</div>";
  echo "</div>";
  echo "</div>";
  echo "</td>";
  echo "<td>";
  echo "<div class='d-flex px-2 py-1'>";
  echo "<div class='d-flex flex-column justify-content-center'>";
  echo "<h6 class='mb-0 text-sm'>" . $student['student_nom'] . "</h6>";
  echo "</div>";
  echo "</div>";
  echo "</td>";
  echo "<td>";
  echo "<div class='d-flex px-2 py-1'>";
  echo "<div class='d-flex flex-column justify-content-center'>";
  echo "<h6 class='mb-0 text-sm'>" . $student['email'] . "</h6>";
  echo "</div>";
  echo "</div>";
  echo "</td>";
  echo "<td class='align-middle text-center text-sm'>";
  echo "<span class='text-xs font-weight-bold'>" . $student['course_nom'] . "</span>";
  echo "</td>";

  echo '<td class="align-middle text-center text-sm"><input type="text" name="exam_name[' . $student['id'] . '][' . $student['course_id'] . ']" placeholder="Enter exam name"></td>';
  echo '<td class="align-middle text-center text-sm"><input type="text" name="grade[' . $student['id'] . '][' . $student['course_id'] . ']" placeholder="Enter grade"></td>';

  echo '<div class="ms-auto text-center">';
  echo '<td class="align-middle text-center text-sm">
    <button class="btn btn-primary" type="submit" name="submit" value="' . $student['id'] . ',' . $student['course_id'] . '">Save</button>
    <button class="btn btn-danger" type="submit" name="delete" value="' . $student['id'] . ',' . $student['course_id'] . '">Delete</button>
    </td>';

  echo '</div>';
  echo "</tr>";
}
echo '<tr>';
echo '<td colspan=""><button class="btn btn-primary" type="submit" name="save_all" value="save_all">Save All</button></td>';
echo '<td colspan=""><button class="btn btn-danger" type="submit" name="delete_selected" value="delete_selected">Delete Selected</button></td>';

echo '</tr>';
echo '
        </tbody>
      </table>
      </form>
  
    </div>
  </div>
</div>';
?>
<script>
  // Function to toggle select all checkboxes
  function toggleSelectAll() {
    var checkboxes = document.getElementsByName('selected_students[]');
    var selectAll = document.getElementById('selectAll');

    for (var i = 0; i < checkboxes.length; i++) {
      checkboxes[i].checked = selectAll.checked;
    }
  }

  // Add event listener to select all checkbox
  var selectAllCheckbox = document.getElementById('selectAll');
  selectAllCheckbox.addEventListener('change', toggleSelectAll);
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  function deleteUser(userId) {
    if (confirm("Are you sure you want to delete this user?")) {
      $.ajax({
        type: "POST",
        url: "delete_user.php",
        data: { id: userId },
        success: function(response) {
          // Handle success response or reload the page
          location.reload();
        },
        error: function(xhr, status, error) {
          // Handle error
          console.log(error);
        }
      });
    }
  }

  $(document).ready(function() {
    // Select All checkbox functionality
    $("#selectAll").change(function() {
      $("input[type='checkbox']").prop("checked", $(this).prop("checked"));
    });

    // Delete Selected button functionality
    $("#deleteSelected").click(function() {
      if (confirm("Are you sure you want to delete the selected users?")) {
        var selectedIds = [];
        $("input[type='checkbox']:checked").each(function() {
          selectedIds.push($(this).val());
        });

        if (selectedIds.length > 0) {
          $.ajax({
            type: "POST",
            url: "delete_selected_users.php",
            data: { ids: selectedIds },
            traditional: true, // Add this line to ensure the array is sent correctly
            success: function(response) {
              // Handle success response or reload the page
              location.reload();
            },
            error: function(xhr, status, error) {
              // Handle error
              console.log(error);
            }
          });
        }
      }
    });
  });
</script>







    
        </div>
        
      </div>
      
    </div>
  </main>
  <div class="modal" id="editModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit User</h5></div></div></div></div>
  <div class="fixed-plugin">
    <a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
    </a>
    <div class="card shadow-lg ">
      <div class="card-header pb-0 pt-3 ">
        <div class="float-start">
          <h5 class="mt-3 mb-0">Soft UI Configurator</h5>
          <p>See our dashboard options.</p>
        </div>
        <div class="float-end mt-4">
          <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
          </button>
        </div>
        <!-- End Toggle Button -->
      </div>
      <hr class="horizontal dark my-1">
      <div class="card-body pt-sm-3 pt-0">
        <!-- Sidebar Backgrounds -->
        <div>
          <h6 class="mb-0">Sidebar Colors</h6>
        </div>
        <a href="javascript:void(0)" class="switch-trigger background-color">
          <div class="badge-colors my-2 text-start">
            <span class="badge filter bg-gradient-primary active" data-color="primary" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-dark" data-color="dark" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-info" data-color="info" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-success" data-color="success" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-warning" data-color="warning" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-danger" data-color="danger" onclick="sidebarColor(this)"></span>
          </div>
        </a>
        <!-- Sidenav Type -->
        <div class="mt-3">
          <h6 class="mb-0">Sidenav Type</h6>
          <p class="text-sm">Choose between 2 different sidenav types.</p>
        </div>
        <div class="d-flex">
          <button class="btn bg-gradient-primary w-100 px-3 mb-2 active" data-class="bg-transparent" onclick="sidebarType(this)">Transparent</button>
          <button class="btn bg-gradient-primary w-100 px-3 mb-2 ms-2" data-class="bg-white" onclick="sidebarType(this)">White</button>
        </div>
        <p class="text-sm d-xl-none d-block mt-2">You can change the sidenav type just on desktop view.</p>
        <!-- Navbar Fixed -->
        <div class="mt-3">
          <h6 class="mb-0">Navbar Fixed</h6>
        </div>
        <div class="form-check form-switch ps-0">
          <input class="form-check-input mt-1 ms-auto" type="checkbox" id="navbarFixed" onclick="navbarFixed(this)">
        </div>
        <hr class="horizontal dark my-sm-4">
        <a class="btn bg-gradient-dark w-100" href="https://www.creative-tim.com/product/soft-ui-dashboard">Free Download</a>
        <a class="btn btn-outline-dark w-100" href="https://www.creative-tim.com/learning-lab/bootstrap/license/soft-ui-dashboard">View documentation</a>
        <div class="w-100 text-center">
          <a class="github-button" href="https://github.com/creativetimofficial/soft-ui-dashboard" data-icon="octicon-star" data-size="large" data-show-count="true" aria-label="Star creativetimofficial/soft-ui-dashboard on GitHub">Star</a>
          <h6 class="mt-3">Thank you for sharing!</h6>
          <a href="https://twitter.com/intent/tweet?text=Check%20Soft%20UI%20Dashboard%20made%20by%20%40CreativeTim%20%23webdesign%20%23dashboard%20%23bootstrap5&amp;url=https%3A%2F%2Fwww.creative-tim.com%2Fproduct%2Fsoft-ui-dashboard" class="btn btn-dark mb-0 me-2" target="_blank">
            <i class="fab fa-twitter me-1" aria-hidden="true"></i> Tweet
          </a>
          <a href="https://www.facebook.com/sharer/sharer.php?u=https://www.creative-tim.com/product/soft-ui-dashboard" class="btn btn-dark mb-0 me-2" target="_blank">
            <i class="fab fa-facebook-square me-1" aria-hidden="true"></i> Share
          </a>
        </div>
      </div>
    </div>
  </div>

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