<?php $title = "Ajouter un commentaire"; ?>

<?php ob_start(); ?>

<h3 class="text-center">Ajouter votre commentaire</h3>
<div class="row justify-content-center">
    <div class="col-md-6">
        <form action="/comment/add" method="post">
            <div class="mb-3">
                <label for="comment" class="form-label">Votre commentaire</label>
                <textarea
                    class="form-control"
                    id="comment"
                    name="comment"
                    rows="4"
                    required></textarea>
            </div>
            <div class="d-flex justify-content-between">
                <a href="/post/<?= $_SESSION['POST_ID'] ?>" class="btn btn-secondary">Annuler</a>
                <button type="submit" class="btn btn-primary">Enregistrer votre commentaire</button>
            </div>
        </form>
    </div>
</div>


<?php $content = ob_get_clean(); ?>
<?php require '../src/views/layout/layout.view.php'; ?>