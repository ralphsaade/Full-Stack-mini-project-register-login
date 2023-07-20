<?php
// Link to your database
include 'dbconnect.php';

header('Content-Type: application/json');

// Get the posted data
$postdata = file_get_contents("php://input");

if(isset($postdata) && !empty($postdata)) {
    $request = json_decode($postdata);

    $email = mysqli_real_escape_string($conn, trim($request->email));
    $password = mysqli_real_escape_string($conn, trim($request->password));

    // Get user with this email
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        if(password_verify($password, $user['password'])){
            // Password is correct, start a new session and save user's name in a session variable
            session_start();
            $_SESSION['name'] = $user['name'];

            echo json_encode(['success' => true, 'message' => 'Login successful']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid password']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'User with this email does not exist']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}
