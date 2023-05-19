<?php
require_once("../config/connect.inc.php");

// Check if the course ID is provided
if (isset($_GET['id'])) {
  // Connexion a la base de donnees
  $conn = connect();

  $courseId = $_GET['id'];

  // Call the deleteCourse function to delete the course
  deleteCourse($conn, $courseId);

  // Redirect back to the dashboard or any other page
  header("Location: teacher_dashboard.php");
  exit();
}
function deleteCourse($conn, $courseId) {
  // Delete related notes
  $deleteNotesQuery = "DELETE FROM notes WHERE cours_id = :course_id";
  $deleteNotesStmt = $conn->prepare($deleteNotesQuery);
  $deleteNotesStmt->bindValue(':course_id', $courseId, PDO::PARAM_INT);
  $deleteNotesStmt->execute();

  // Delete the course
  $deleteCourseQuery = "DELETE FROM cours WHERE id = :course_id";
  $deleteCourseStmt = $conn->prepare($deleteCourseQuery);
  $deleteCourseStmt->bindValue(':course_id', $courseId, PDO::PARAM_INT);
  $deleteCourseStmt->execute();
}

?>
