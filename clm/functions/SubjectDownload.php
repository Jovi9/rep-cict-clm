<?php
// if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
//     // header('HTTP/1.0 403 Forbidden', TRUE, 403);
//     // die("<h2>Access Denied!</h2> This file is protected and not available to public.");
//     header('location: ../../index.php');
//     exit();
// }

require __DIR__ . '/../model/Subject.php';

session_start();
if (isset($_SESSION['auth'])) {

    if (isset($_GET['file_name'])) {
        $fileName = $_GET['file_name'];
        $filePath = '../pdf/' . $fileName;

        if (!empty($fileName) && file_exists($filePath)) {
            header("Cache-Control: public");
            header("Content-Description: File Transfer");
            header("Content-Type: application/pdf");
            header("Content-Disposition: attachment; filename=" . $fileName);

            readfile($filePath);
            exit();
        } else {
            $_SESSION['dl_failed'] = "Failed to download file, please try again.";
            header('location: ../app.php?content=subjects');
            exit();
        }
    }
} else {
    header('location: ../app.php');
}
