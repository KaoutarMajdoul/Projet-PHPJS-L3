<!-- Modal Confirm Delete -->
<div class="modal fade" id="modal-delete-<?= $event['idEven'] ?>">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fa fa-trash"></i> Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Voulez-vous supprimer cet évènement <strong><?= $event['nom'] ?></strong> ?</p>
            </div>
            <div class="modal-footer">
                <a href="delete.php?obj_id=<?= $event['idEven'] ?>" class="btn btn-outline-success">Supprimer</a>
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Annuler</button>
            </div>
        </div>
    </div>
</div>
<!-- End Modal -->