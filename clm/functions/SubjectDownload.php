<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    // header('HTTP/1.0 403 Forbidden', TRUE, 403);
    // die("<h2>Access Denied!</h2> This file is protected and not available to public.");
    header('location: ../../index.php');
    exit();
}

require __DIR__ . '/../model/Subject.php';

session_start();
if (isset($_SESSION['auth'])) {

    if (isset($_POST['download'])) {
        $fileName = basename($_POST['file_name']);
        $filePath = '../pdf/' . $fileName;

        if (!empty($fileName) && file_exists($filePath)) {
            header("Cache-Control: public");
            header("Content-Description: File Transfer");
            header("Content-Disposition: attachment; filename=$fileName");
            header("Content-Type: application/zip");
            header("Content-Transfer-Encoding: binary");

            readfile($filePath);
            exit();
        } else {
            $_SESSION['dl_failed'] = "Failed to download file, please try again.";
            header('location: ../app.php?content=subjects');
            exit();
        }
        //     $code = $_POST['subject_code'];
        //     $desc = $_POST['subject_desc'];
        //     $program = $_POST['program'];
        //     $year_level = $_POST['year_level'];
        //     $file = $_FILES['subject_file'];

        //     $fileName = $_FILES['subject_file']['name'];
        //     $fileTempName = $_FILES['subject_file']['tmp_name'];
        //     $fileSize = $_FILES['subject_file']['size'];
        //     $fileError = $_FILES['subject_file']['error'];
        //     $fileType = $_FILES['subject_file']['type'];

        //     $fileExtenstion = explode('.', $fileName);
        //     $fileActualExtension = strtolower(end($fileExtenstion));

        //     $allowed_file = array('pdf');

        //     $fileNameNew = $code . "." . $fileActualExtension;
        //     $fileDestination = '../pdf/' . $fileNameNew;

        //     $subject = new Subject;
        //     if ($subject->subjectCodeExist($code)) {
        //         $_SESSION['code_exist'] = "Subject already added.";
        //         header('location: ../app.php?content=subjects_create');
        //         exit();
        //     }

        //     if (in_array($fileActualExtension, $allowed_file)) {
        //         if ($fileError === 0) {
        //             if ($fileSize < 10000000) {
        //                 if ($subject->storeNewSubject($code, $desc, $program, $year_level, $fileNameNew)) {
        //                     move_uploaded_file($fileTempName, $fileDestination);

        //                     $_SESSION['success'] = "Subject added successfully.";
        //                     header('location: ../app.php?content=subjects_create');
        //                     exit();
        //                 } else {
        //                     $_SESSION['failed'] = "Something went wrong, failed to add new subject. Please try again.";
        //                     header('location: ../app.php?content=subjects_create');
        //                     exit();
        //                 }
        //             } else {
        //                 $_SESSION['file_size'] = "The file is too big.";
        //                 header('location: ../app.php?content=subjects_create');
        //                 exit();
        //             }
        //         } else {
        //             $_SESSION['file_error'] = "This was an error uploading your file, please try again.";
        //             header('location: ../app.php?content=subjects_create');
        //             exit();
        //         }
        //     } else {
        //         $_SESSION['file_not_allowed'] = "This type of file is not allowed. Please upload a valid pdf file.";
        //         header('location: ../app.php?content=subjects_create');
        //         exit();
        //     }
    }
} else {
    header('location: ../app.php');
}
