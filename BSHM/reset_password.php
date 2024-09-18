<?php
include('db_connect.php'); // Ensure this file sets up the $conn variable for mysqli connection

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Check if token exists and is not expired
    $query = $conn->prepare('SELECT * FROM password_resets WHERE token = ? AND expires >= ?');
    $currentTime = date('U');
    $query->bind_param('si', $token, $currentTime);
    $query->execute();
    $result = $query->get_result();
    $reset = $result->fetch_assoc(); // Use fetch_assoc() with mysqli
    $result->free(); // Free the result

    if ($reset) {
        // If the token is valid, show the form to reset the password
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $new_password = password_hash($_POST['password'], PASSWORD_DEFAULT);

            // Update the user's password in the database
            $updateQuery = $conn->prepare('UPDATE users SET password = ? WHERE email = ?');
            $updateQuery->bind_param('ss', $new_password, $reset['email']);
            $updateQuery->execute();
            $updateQuery->store_result(); // Store the result
            $updateQuery->free_result(); // Free the result

            // Delete the token to prevent reuse
            $deleteQuery = $conn->prepare('DELETE FROM password_resets WHERE email = ?');
            $deleteQuery->bind_param('s', $reset['email']);
            $deleteQuery->execute();
            $deleteQuery->store_result(); // Store the result
            $deleteQuery->free_result(); // Free the result

            echo "Your password has been reset successfully.";
        }
    } else {
        echo "Invalid or expired token.";
    }
} else {
    echo "No token provided.";
}
?>

<!-- HTML form to reset password -->
<form action="" method="POST">
    <label for="password">Enter your new password:</label>
    <input type="password" name="password" id="password" required>
    <button type="submit">Reset Password</button>
</form>