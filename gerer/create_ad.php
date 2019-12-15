<?php 
session_start();

include("inc/header.php")
?>
<div class="container">
    <a href="gerer_ad.php" class="btn btn-light mb-3"><< Retour</a>
    <?php if (isset($_GET['status']) && $_GET['status'] == "created") : ?>
        <div class="alert alert-success" role="alert">
            <strong>Created</strong>
        </div>
    <?php endif ?>
    <?php if (isset($_GET['status']) && $_GET['status'] == "fail_create") : ?>
        <div class="alert alert-danger" role="alert">
            <strong>Fail Create</strong>
        </div>
    <?php endif ?>
    <!-- Create Form -->
    <div class="card border-danger">
        <div class="card-header bg-danger text-white">
            <strong><i class="fa fa-plus"></i> Ajouter un thème</strong>
        </div>
        <div class="card-body">
            <form action="create_ad.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="nom" class="col-form-label">Nom</label>
                    <input type="text" class="form-control" name="nom" id="nom" >
                </div>
                <button type="submit" name ="ajouter" class="btn btn-success"><i class="fa fa-check-circle"></i> Save</button>
            </form>
        </div>
    </div>
    <!-- End create form -->
    <br>
</div><!-- /.container -->
<?php include("inc/footer.php") ?>


<?php 
include "inc/db.php";

if (isset($_POST['ajouter'])){
   

    //récup les données du formulaire
    $nom = $_POST['nom'];
    $email_ad = $_SESSION['email'];

    $sql = "INSERT INTO `theme` (`idTheme`, `emailA`, `nom`) 
    VALUES (0, '$email_ad', '$nom')";
    $run_query = mysqli_query($con,$sql);


    if($run_query){
        echo "<script>alert('Évènement ajouté !' ) </script>";
    }
    else{
        echo "<script>alert('Error' ) </script>";
    }


}


?>