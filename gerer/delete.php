<?php 
require("inc/db.php");

if (isset($_GET['id'])) {
    // Delete record
    $id=$_GET['id'];
        // SQL Statement
    $sql = "DELETE FROM evenement WHERE idEven = '$id' ";
    $run_query = mysqli_query($con,$sql);
    if ($run_query) {
        header("Location: gerer.php?status=deleted");
        exit();
    }
    header("Location: gerer.php?status=fail_delete");
    exit();

} else {
    // Redirect to index.php
    header("Location: gerer.php?status=fail_delete");
    exit();
}