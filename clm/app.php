<?php
session_start();
if (!isset($_SESSION['auth'])) {
    header('location: ../login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CICT Learning Materials</title>
    <link rel="stylesheet" href="../css/build/style.css">
</head>

<body>
    <?php @include('./includes/navigation.php') ?>

</body>

</html>