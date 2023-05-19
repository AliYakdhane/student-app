<?php
require_once("../config/connect.inc.php");

// Check if the user IDs are provided
if (isset($_POST['ids'])) {
  // Connexion to the database
  $conn = connect();

  $userIds = $_POST['ids'];

  // Call the deleteUser function for each selected user
  foreach ($userIds as $userId) {
    deleteUser($conn, $userId);
  }

  // Close the database connection
  $conn = null;
}
