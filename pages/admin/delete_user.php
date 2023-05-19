<?php
require_once("../config/connect.inc.php");

if (isset($_POST['id'])) {
  $userId = $_POST['id'];

  // Connexion a la base de donnees
  $conn = connect();

  try {
    // Call the deleteUser function to delete the user
    deleteUser($conn, $userId);

    // Close the database connection
    $conn = null;

    // Return a success response
    echo "User deleted successfully";
  } catch (PDOException $e) {
    // Handle the error
    echo "Error: " . $e->getMessage();
  }
} else {
  // If the user ID is not provided, return an error response
  echo "Error: User ID not provided";
}

function deleteUser($conn, $userId) {
  $stmt = $conn->prepare("DELETE FROM enseignants WHERE id=:user_id");
  $stmt->bindParam(':user_id', $userId); // Fix the parameter name to match the binding
  $stmt->execute();
}

?>
