<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    // header('HTTP/1.0 403 Forbidden', TRUE, 403);
    // die("<h2>Access Denied!</h2> This file is protected and not available to public.");
    header('location: ../../index.php');
    exit();
}

require __DIR__ . '/../model/User.php';

session_start();
if (isset($_SESSION['auth'])) {

    if (isset($_POST['approve'])) {
        $id = $_POST['id'];
        $user = new User;

        if ($user->approveStudentByID($id)) {
            header('location: ../app.php?content=students');
            exit();
        } else {
            $_SESSION['request_failed'] = "Failed to process request. Please try again.";
            header('location: ../app.php?content=students');
            exit();
        }
    }

    if (isset($_POST['decline'])) {
        $id = $_POST['id'];

        session_start();
        $user = new User;

        if ($user->declineStudentByID($id)) {
            header('location: ../app.php?content=students');
            exit();
        } else {
            $_SESSION['request_failed'] = "Failed to process request. Please try again.";
            header('location: ../app.php?content=students');
            exit();
        }
    }
} else {
    header('location: ../app.php');
}
