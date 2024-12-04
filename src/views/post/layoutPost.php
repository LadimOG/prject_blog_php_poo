<?php $title = 'Post' ?>

<?php ob_start(); ?>

<div class="container mt-5 post-container">
    <div class="row row-cols-1 row-cols-sm-3 ">
        <?php foreach ($data as $post): ?>
            <div class="col">
                <div class=" cardbox card my-2 shadow">
                    <h5 class="card-header"><?= htmlspecialchars($post['title']) ?></h5>
                    <div class="card-body">
                        <p class="card-text"><?= substr(htmlspecialchars($post['content']), 0, 20) . '...' ?></p>
                        <a href="/post/<?= (int)$post['id'] ?>" class="btn btn-primary">Lire le post</a>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </div>
</div>

<?php $content = ob_get_clean(); ?>
<?php require '../src/views/layout/layout.view.php'; ?>