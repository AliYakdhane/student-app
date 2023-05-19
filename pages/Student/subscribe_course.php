<?php
session_start();

require_once("../config/connect.inc.php");

// Connexion a la base de donnees
$conn = connect();

// Get the course_id from the query parameters
$courseId = $_GET['course_id'];

// Get the student ID from the session
$studentId = $_SESSION['user_id'];

// Check if the student is already subscribed to the course
$query_check_subscription = "SELECT COUNT(*) as count
                            FROM student_courses
                            WHERE student_id = :student_id
                            AND course_id = :course_id";
$stmt_check_subscription = $conn->prepare($query_check_subscription);
$stmt_check_subscription->bindValue(':student_id', $studentId, PDO::PARAM_INT);
$stmt_check_subscription->bindValue(':course_id', $courseId, PDO::PARAM_INT);
$stmt_check_subscription->execute();
$row_check_subscription = $stmt_check_subscription->fetch(PDO::FETCH_ASSOC);
$subscriptionCount = $row_check_subscription['count'];

if ($subscriptionCount > 0) {
    // The student is already subscribed to the course
    echo "You are already subscribed to this course.";
} else {
    // Insert the subscription into the student_courses table
    $query_subscribe = "INSERT INTO student_courses (student_id, course_id) VALUES (:student_id, :course_id)";
    $stmt_subscribe = $conn->prepare($query_subscribe);
    $stmt_subscribe->bindValue(':student_id', $studentId, PDO::PARAM_INT);
    $stmt_subscribe->bindValue(':course_id', $courseId, PDO::PARAM_INT);
    
    if ($stmt_subscribe->execute()) {
        // Subscription successful
        header('Location: student_dashboard.php');
        exit();
    } else {
        // Subscription failed
        echo "Failed to subscribe to this course.";
    }
}
?>
