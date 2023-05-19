<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

// initializing variables
$nom = "";
$email = "";
$errors = array();

// connect to the database
$db = new PDO("mysql:host=localhost;dbname=bookdb", "root", "");

// set the PDO error mode to exception
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// REGISTER USER
if (isset($_POST['reg_user'])) {
    // receive all input values from the form
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $password_1 = $_POST['password_1'];
    $password_2 = $_POST['password_2'];
    $isTeacher = isset($_POST['isTeacher']) ? 1 : 0;
    $isStudent = isset($_POST['isStudent']) ? 1 : 0;
    $isAdmin = isset($_POST['isAdmin']) ? 1 : 0;

    // form validation: ensure that the form is correctly filled ...
    // by adding (array_push()) corresponding error unto $errors array
    if (empty($nom)) {
        array_push($errors, "Nom is required");
    }
    if (empty($email)) {
        array_push($errors, "Email is required");
    }
    if (empty($password_1)) {
        array_push($rrors, "Password is required");
    }
    if ($password_1 != $password_2) {
        array_push($errors, "The two passwords do not match");
    }

    // first check the database to make sure
    // a user does not already exist with the same nom and/or email
    $user_check_query = "SELECT * FROM enseignants WHERE nom=:nom OR email=:email LIMIT 1";
    $stmt = $db->prepare($user_check_query);
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) { // if user exists
        if ($user['nom'] === $nom) {
            array_push($errors, "Nom already exists");
        }

        if ($user['email'] === $email) {
            array_push($errors, "Email already exists");
        }
    }

    // Finally, register user if there are no errors in the form
    if (count($errors) == 0) {
        $password = md5($password_1); // encrypt the password before saving in the database

        // Check if the user is registering as a teacher
        if ($isTeacher) {
            $query = "INSERT INTO enseignants (nom, email, mot_de_passe) VALUES (:nom, :email, :password)";
            $stmt = $db->prepare($query);
            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);
            $stmt->execute();
            $_SESSION['user_id'] = $db->lastInsertId(); // Get the ID of the inserted teacher
            $_SESSION['user_type'] = 'teacher';
            $_SESSION['success'] = "You are now registered";
            header('location: ../teacher/teacher_dashboard.php'); // Redirect to the teacher dashboard or any other appropriate page
            exit(); // Make sure to exit after redirection
        }

        // Check if the user is registering as a student
        if ($isStudent) {
            $query = "INSERT INTO etudiants (nom, email, mot_de_passe) VALUES (:nom, :email, :password)";
            $stmt = $db->prepare($query);
            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);
            $stmt->execute();
            $_SESSION['user_id'] = $db->lastInsertId(); // Get the ID of the inserted student
            $_SESSION['user_type'] = 'student';
            $_SESSION['success'] = "You are now registered";
            header('location: ../student/student_dashboard.php'); // Redirect tothe student dashboard or any other appropriate page
            exit(); // Make sure to exit after redirection
        }

        // Check if the user is registering as an admin
        if ($isAdmin) {
            $query = "INSERT INTO admins (username, email, password) VALUES (:username, :email, :password)";
            $stmt = $db->prepare($query);
            $stmt->bindParam(':username', $nom);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);
            $stmt->execute();
            $_SESSION['user_id'] = $db->lastInsertId(); // Get the ID of the inserted admin
            $_SESSION['user_type'] = 'admin';
            $_SESSION['success'] = "You are now registered";
            header('location: ../admin/dashboard.php'); // Redirect to the admin dashboard or any other appropriate page
            exit(); // Make sure to exit after redirection
        }
    } else {
        // Display errors
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
    }

    // close database connection
    $db = null;
}
?>