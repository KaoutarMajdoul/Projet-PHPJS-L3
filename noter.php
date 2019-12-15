<?php 
include "db.php";
session_start();

if (isset($_POST['noter'])){
    if (isset($_GET['id']) && isset($_SESSION["email"])) {
        $emailP = $_SESSION["email"];
        $idEv = $_GET['id'];
        $note = $_POST['note'];
        $sql = "SELECT * FROM participe WHERE emailPers='$emailP'";
        $run_query = mysqli_query($con,$sql);
        if($run_query){
            $count = mysqli_num_rows($run_query);
            if($count == 0){
                header("Location: index.php?status=non_participe");
                exit();
            }
            else{
                    $sql = "SELECT * FROM evenement WHERE idEven='$idEv' AND `dateFin` < DATE(NOW())"; //évènement passé
                    $run_query = mysqli_query($con,$sql);
                    $count = mysqli_num_rows($run_query);
                    if($count == 0){ //L'évènement n'est pas passé
                    header("Location: index.php?status=non_termine");
                    exit();
                }
                else{
                    $sql = "SELECT * FROM note WHERE emailP='$emailP'";
                    $run_query = mysqli_query($con,$sql);
                    $count = mysqli_num_rows($run_query);
                    if($count != 0){ //déjà noté
                        header("Location: index.php?status=alr_note");
                        exit();
                    }
                    else{
                        $sql = "INSERT INTO `note` (`emailP`, `idEv`, `note`) 
                        VALUES ('$emailP', '$idEv', '$note')";
                        $run_query = mysqli_query($con,$sql);


                        if($run_query){
                            header("Location: index.php?status=note_ajoute");
                            exit();
                        }
                        else{
                            header("Location: index.php?status=error");
                            exit();
                        }
                    }
                }
            }
        }
        else{
            header("Location: index.php?status=error");
            exit();
        }
    }
    else{
        header("Location: index.php?status=noaccount");
        exit();
    }
}