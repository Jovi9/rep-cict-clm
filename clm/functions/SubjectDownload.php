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
    // download specific file
    if (isset($_GET['file_name'])) {
        $fileName = $_GET['file_name'];
        $filePath = '../pdf/' . $fileName;

        $program = $_SESSION['auth'][0]['program'];
        $year_level = $_SESSION['auth'][0]['year_level'];
        $role = $_SESSION['auth'][0]['role'];

        if ($role == 1) {
            $subject = new Subject;
            $results = $subject->getSubjectsByYearLevel($program, $year_level);

            $subjects = array();
            if ($results) {
                foreach ($results as $result) {
                    $list  = $result['file_dir'];
                    array_push($subjects, $list);
                    unset($list);
                }
                if (!in_array($fileName, $subjects)) {
                    $_SESSION['no_permission'] = "You do not have permission to download this file.";
                    header('location: ../app.php?content=subjects');
                    exit();
                }
            } else {
                $_SESSION['dl_failed'] = "Failed to download file, please try again.";
                header('location: ../app.php?content=subjects');
                exit();
            }
        }

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
