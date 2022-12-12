<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    header('HTTP/1.0 403 Forbidden', TRUE, 403);
    die("<h2>Access Denied!</h2> This file is protected and not available to public.");
}

require '../model/User.php';

if (!isset($_SESSION['auth'])) {

    if (isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = new User;
        $result = $user->authenticateLogin($email, $password);

        session_start();
        if (!$result == null) {
            if ($result[0]['status'] == 'pending') {
                $_SESSION['pending'] = 'Your account is pending for approval.';
                header('location: ../../login.php');
                exit();
            }
            $_SESSION['auth'] = $result;
            header('location: ../app.php');
            exit();
        } elseif ($result['error']) {
            $_SESSION['request_failed'] = "Failed to process request. Please try again.";
            header('location: ../../login.php');
            exit();
        } else {
            $_SESSION['invalid_auth'] = "Your email or password is incorrect.";
            header('location: ../../login.php');
            exit();
        }
    }
} else {
    header('location: ../app.php');
}
