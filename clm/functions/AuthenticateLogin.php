<?php

require '../model/User.php';

if (!isset($_SESSION['auth'])) {

    if (isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = new User;
        $result = $user->authenticateLogin($email, $password);
        // echo $result[0]['name'] . "\n\n";
        // echo $result[0]['program'] . "\n\n";
        // echo count($result);
        // var_dump($result);
        session_start();
        if (!$result == null) {
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
