<?php 
require("inc/db.php");

if (isset($_GET['id'])) {
    // Delete record
    $email=$_GET['id'];
        // SQL Statement
    $sql = "DELETE FROM contributeur WHERE emailC = '$email' ";
    $run_query = mysqli_query($con,$sql);
    if ($run_query) {
        header("Location: gerer_ad.php?status=deleted");
        exit();
    }
    header("Location: gerer_ad.php?status=fail_delete");
    exit();

} else {
    // Redirect to index.php
    header("Location: gerer_ad.php?status=fail_delete");
    exit();
}