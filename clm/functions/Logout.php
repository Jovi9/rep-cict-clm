<?php
session_start();
if (isset($_SESSION['auth'])) {
    session_unset();
    session_destroy();
    header("location: ../../index.php");
    exit();
} else {
    header("location: ../../index.php");
    exit();
}
