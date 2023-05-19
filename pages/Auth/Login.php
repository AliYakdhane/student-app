<?php
session_start();

// initializing variables
$email = "";
$password = "";
$errors = array(); 

// connect to the database
$db = new PDO("mysql:host=localhost;dbname=bookdb", "root", "");

// set the PDO error mode to exception
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// LOGIN USER
if (isset($_POST['login_user'])) {
    // receive all input values from the form
    $email = $_POST['email'];
    $password = $_POST['password'];

    // form validation: ensure that the form is correctly filled ...
    // by adding (array_push()) corresponding error unto $errors array
    if (empty($email)) {
        array_push($errors, "Email is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }

    // if there are no errors, attempt to log in the user
    if (count($errors) == 0) {
        $password = md5($password);

        // Query for students
        $student_query = "SELECT id FROM etudiants WHERE email=? AND mot_de_passe=?";
        $student_stmt = $db->prepare($student_query);
        $student_stmt->execute([$email, $password]);

        // Query for teachers
        $teacher_query = "SELECT id FROM enseignants WHERE email=?AND mot_de_passe=?";
        $teacher_stmt = $db->prepare($teacher_query);
        $teacher_stmt->execute([$email, $password]);

        // Query for admins
        $admin_query = "SELECT id FROM admins WHERE email=? AND mot_de_passe=?";
        $admin_stmt = $db->prepare($admin_query);
        $admin_stmt->execute([$email, $password]);

        if ($student_stmt->rowCount() == 1) {
            // student found, log them in and redirect to student dashboard
            $_SESSION['user_type'] = 'student';
            $_SESSION['success'] = "You are now logged in";
            $student_id = $student_stmt->fetch(PDO::FETCH_COLUMN);
            $_SESSION['user_id'] = $student_id;
            header('location: ../student/student_dashboard.php');
            exit();
        } elseif ($teacher_stmt->rowCount() == 1) {
            // teacher found, log them in and redirect to teacher dashboard
            $_SESSION['user_type'] = 'teacher';
            $_SESSION['success'] = "You are now logged in";
            $teacher_id = $teacher_stmt->fetch(PDO::FETCH_COLUMN);
            $_SESSION['user_id'] = $teacher_id;
            header('location: ../teacher/teacher_dashboard.php');
            exit();
        } elseif ($admin_stmt->rowCount() == 1) {
            // admin found, log them in and redirect to admin dashboard
            $_SESSION['user_type'] = 'admin';
            $_SESSION['success'] = "You are now logged in";
            $admin_id = $admin_stmt->fetch(PDO::FETCH_COLUMN);
            $_SESSION['user_id'] = $admin_id;
            header('location: ../admin/dashboard.php');
            exit();
        } else {
            // if no user found with the provided email and password, show error message
            array_push($errors, "Wrong email or password combination");
        }
    }
}

// Check if the user is logged in as a student
if (isset($_SESSION['user_type']) && $_SESSION['user_type'] === 'student') {
    // Redirect to the student dashboard or any other protected page for students
    header('location: ../student/student_dashboard.php');
    exit(); // Make sure to exit after redirection
}

// Check if the user is logged in as a teacher
if (isset($_SESSION['user_type']) && $_SESSION['user_type'] === 'teacher') {
    // Redirect to the teacher dashboard or any other protected page for teachers
    header('location: ../teacher/teacher_dashboard.php');
    exit(); // Make sure to exit after redirection
}

// Check if the user is logged in as an admin
if (isset($_SESSION['user_type']) && $_SESSION['user_type'] === 'admin') {
    // Redirect to the admin dashboard or any other protected page for admins
    header('location: ../admin/dashboard.php');
    exit(); // Make sure to exit after redirection
}

// If not logged in or the user type is unknown, display the login form
?>