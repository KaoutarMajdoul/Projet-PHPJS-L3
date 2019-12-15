<?php 
require("inc/db.php");

if ($_POST) {


    $id = $_POST['idEven'];
    $description    = trim($_POST['description']);
    $adresse   = trim( $_POST['adresse']);
    $nbPlaces     =  (int)$_POST['nbPlaces'];
    $dateDeb   = trim($_POST['dateDeb']);
    $dateFin = trim($_POST['dateFin']);
    $theme = trim($_POST['theme']);

    $sql = 'UPDATE products 
    SET obj_dept = :obj_dept, obj_titre = :obj_titre, obj_lieu = :obj_lieu, obj_cat = :obj_cat, obj_image = :obj_image, descobj_description = :obj_desc 
    WHERE obj_id = :obj_id';

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":obj_cat", $obj_cat);
    $stmt->bindParam(":obj_dept", $obj_dept);
    $stmt->bindParam(":obj_titre", $obj_titre);
    $stmt->bindParam(":obj_lieu", $obj_lieu);


    $stmt->bindParam(":obj_desc", $obj_desc);
    $stmt->bindParam(":obj_image", $obj_image);
    $stmt->bindParam(":obj_contact", $obj_contact);
    $stmt->execute();
    if ($stmt->rowCount()) {
        header("Location: edit.php?id=".$obj_id."&status=updated");
        exit();
    }
    header("Location: edit.php?id=".$obj_id."&status=fail_update");
    exit();

}

?>