<?php

use App\lib\SanitizerString;

$title = "Modifier commentaire"; ?>

<?php ob_start(); ?>
<h3 class="text-center">Modifier votre commentaire</h3>
<div class="row justify-content-center">
    <div class="col-md-6">
        <form action="/comment/update/<?= $comment['id_comment'] ?>" method="post">
            <div class="mb-3">
                <label for="comment" class="form-label">Votre commentaire</label>
                <textarea
                    class="form-control"
                    id="comment"
                    name="comment"
                    rows="4"
                    required><?= SanitizerString::secureShowOutput($comment['comment']) ?></textarea>
            </div>
            <div class="d-flex justify-content-between">
                <a href="/post/<?= $comment['post_id'] ?>" class="btn btn-secondary">Annuler</a>
                <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
            </div>
        </form>
    </div>
</div>


<?php $content = ob_get_clean(); ?>
<?php require '../src/views/layout/layout.view.php'; ?>