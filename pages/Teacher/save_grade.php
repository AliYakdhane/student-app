<?php
session_start();

require_once("../config/connect.inc.php");

// Connexion a la base de donnees
$conn = connect();

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Get the submitted grades
    $grades = $_POST['grade'];

    // Iterate through the grades and save them to the notes table
    foreach ($grades as $studentId => $studentGrades) {
        foreach ($studentGrades as $courseId => $grade) {
            // Insert or update the grade in the notes table
            $query = "INSERT INTO notes (etudiant_id, cours_id, examen, note)
                      VALUES (:student_id, :course_id, :examen, :note)
                      ON DUPLICATE KEY UPDATE note = :note";
            $stmt = $conn->prepare($query);
            $stmt->bindValue(':student_id', $studentId, PDO::PARAM_INT);
            $stmt->bindValue(':course_id', $courseId, PDO::PARAM_INT);
            $stmt->bindValue(':examen', 'Exam', PDO::PARAM_STR); // Assuming it's for an exam
            $stmt->bindValue(':note', $grade, PDO::PARAM_STR);
            $stmt->execute();
        }
    }

    // Redirect back to the student list
    header("Location: list_students.php");
    exit();
}
?>
