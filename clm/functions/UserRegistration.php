<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    header('HTTP/1.0 403 Forbidden', TRUE, 403);
    die("<h2>Access Denied!</h2> This file is protected and not available to public.");
}

require '../model/User.php';

if (!isset($_SESSION['auth'])) {

    if (isset($_POST['register'])) {
        $student_id = $_POST['student_id'];
        $name = $_POST['name'];
        $program = $_POST['program'];
        $year_level = $_POST['year_level'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        session_start();
        $user = new User;

        if ($user->studentIDExists($student_id)) {
            $_SESSION['id_exist'] = "Student ID Exist.";
            header('location: ../../register.php');
            exit();
        } elseif ($user->emailExist($email)) {
            $_SESSION['email_exist'] = "Email Exist.";
            header('location: ../../register.php');
            exit();
        } else {
            $result = $user->registerUser($student_id, $name, $program, $year_level, $email, $password);

            if ($result == true) {
                $_SESSION['reg_success'] = "Registration success.";
                header('location: ../../register.php');
                exit();
            } else {
                $_SESSION['reg_failed'] = "Registration failed.";
                header('location: ../../register.php');
                exit();
            }
        }
    }
} else {
    header('location: ../app.php');
}
