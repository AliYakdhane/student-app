<?php
// process_add_course.php

// process_add_course.php

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize the input fields
    $courseName = $_POST['course_name'];
    $teacherId = $_POST['teacher_id'];
    // You can add more validation and sanitization here
    
    // Perform the database insertion
    require_once("../config/connect.inc.php");
    $conn = connect();
    
    // File upload handling
    $file = $_FILES['file'];
    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileError = $file['error'];
    
    // Check if a file is uploaded successfully
    if ($fileError === UPLOAD_ERR_OK) {
        // Move the uploaded file to a desired directory
        $destination = '../file/' . $fileName;
        move_uploaded_file($fileTmpName, $destination);
    } else {
        // Handle file upload error
        echo "File upload error: " . $fileError;
        exit();
    }
    
    // Prepare the query
    $query = "INSERT INTO cours (nom, enseignant_id, fichier) VALUES (:course_name, :teacher_id, :file_name)";
    $stmt = $conn->prepare($query);
    
    // Bind the parameters
    $stmt->bindParam(':course_name', $courseName);
    $stmt->bindParam(':teacher_id', $teacherId);
    $stmt->bindParam(':file_name', $fileName);
    
    // Execute the query
    if ($stmt->execute()) {
        // Course insertion successful
        header('Location: teacher_dashboard.php');
        exit();
    } else {
        // Course insertion failed
        echo "Failed to add course.";
    }
} else {
    // If the form is not submitted, redirect or display an error message
    header('Location: add_course.php');
    exit();
}

?>
