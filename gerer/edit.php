<?php 
require("inc/db.php");
$id = $_GET['id'];


$sql = "SELECT * FROM evenement WHERE idEven = '$id' LIMIT 1";
$run_query = mysqli_query($con,$sql);
mysqli_num_rows($run_query);
$event = mysqli_fetch_array($run_query);

?>
<!DOCTYPE html>
<html>
<body>
    <?php include("inc/header.php") ?>
    <div class="container">
        <?php if (isset($_GET['status']) && $_GET['status'] == "updated") : ?>
            <div class="alert alert-success" role="alert">
                <strong>Updated</strong>
            </div>
        <?php endif ?>
        <?php if (isset($_GET['status']) && $_GET['status'] == "fail_update") : ?>
            <div class="alert alert-danger" role="alert">
                <strong>Fail Update</strong>
            </div>
        <?php endif ?>
        <!-- Create Form -->
        <div class="card border-danger">
            <div class="card-header bg-danger text-white">
                <strong><i class="fa fa-edit"></i> Modifier un évènement</strong>
            </div>
            <div class="card-body">
                <form action="inc/update.php" method="post">
                    <input type="hidden" name="obj_id" value="<?= $event['idEven'] ?>">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="nom" class="col-form-label">Titre</label>
                            <input type="text" class="form-control" id="obj_dept" name="obj_dept" placeholder="Titre" required value="<?= $event['nom'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="description" class="col-form-label">Description</label>
                            <textarea name="obj_desc" id="" rows="5" class="form-control" placeholder="Description"><?= $event['description'] ?></textarea>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="adresse" class="col-form-label">Adresse</label>
                            <input type="text" class="form-control" id="namobj_titre" name="obj_titre" placeholder="Lieu" required value="<?= $event['adresse'] ?>">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="nbPlaces" class="col-form-label">Nombre de places</label>
                            <input type="number" class="form-control" id="obj_lieu" name="obj_lieu" placeholder="Place" required value="<?= $event['nbPlaces'] ?>" >
                        </div>
                        <div class="form-group col-md-4">
                            <label for="dateDeb" class="col-form-label">Date de début</label>
                            <input type="date" class="form-control" name="obj_cat" id="obj_cat" placeholder="Ville" required value="<?= $event['dateDeb'] ?>">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="dateFin" class="col-form-label">Date de fin</label>
                            <input type="date" class="form-control" name="obj_cat" id="obj_cat" placeholder="Ville" required value="<?= $event['dateFin'] ?>">
                        </div>
                        <div class="form-group col-md-4" data-toggle="collapse" href="#get_theme">
                            <label for="theme active" class="col-form-label">Thème</label>
                            <input type="text" class="form-control" name="obj_cat" id="obj_cat" placeholder="theme" required value="<?= $event['theme'] ?>">
                            <div class="collapse" id="get_theme"></div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success"><i class="fa fa-check-circle"></i> Save</button>
                </form>
            </div>
        </div>
        <!-- End create form -->
        <br>
    </div><!-- /.container -->


    <?php include("inc/footer.php") ?>

</body>
</html>

