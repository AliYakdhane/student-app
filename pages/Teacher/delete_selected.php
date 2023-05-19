<?php
session_start();

require_once("../config/connect.inc.php");

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  // Get the selected course IDs
  $selectedCourses = $_POST["selectedCourses"];

  // Check if any courses are selected
  if (!empty($selectedCourses)) {
    // Convert the selected course IDs to a comma-separated string for the SQL query
    $courseIds = implode(",", $selectedCourses);

    // Get the ID of the logged-in teacher (Assuming you have stored it in a variable named $teacher_id)
    $teacherId = $_SESSION['user_id'];

    // Prepare the delete query
    $deleteQuery = "DELETE FROM cours WHERE id IN ($courseIds) AND enseignant_id = :teacher_id";

    // Connexion to the database
    $conn = connect();

    // Prepare the statement
    $stmt = $conn->prepare($deleteQuery);
    $stmt->bindParam(':teacher_id', $teacherId);

    // Execute the delete query
    if ($stmt->execute()) {
      // Deletion successful
      echo "Selected courses have been deleted successfully.";
      header('location: teacher_dashboard.php');
    } else {
      // Error occurred during deletion
      echo "Error deleting selected courses.";
    }
  } else {
    // No courses selected
    echo "No courses selected for deletion.";
  }
} else {
  // Invalid request method
  echo "Invalid request method.";
}
?>
