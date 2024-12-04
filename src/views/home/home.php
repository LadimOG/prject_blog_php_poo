<?php $title = "Bienvenue sur mon blog"; ?>

<?php ob_start() ?>

<div class="p-4 p-md-5 mb-4 text-white bg-dark w-100">
    <div class="col-md-6 px-0">
        <h1 class="display-4 fst-italic fw-semibold">Bievenue sur mon blog <?php echo (isset($_SESSION['user_name']) ? "<span>Bienvenue " . htmlspecialchars($_SESSION['user_name']) . " OG" . "</span>" : "Mon OG") ?></h1>

        <p class="lead my-3">Sur ce blog tu trouveras des articles sur des produits que je possède et que j'utilise au quotidien..</p>

    </div>
</div>
<div class="container mb-4">
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

<?php require "../src/views/layout/layout.view.php"; ?>