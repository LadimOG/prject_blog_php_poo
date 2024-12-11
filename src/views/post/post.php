<?php

use App\lib\DateFormat;
use App\lib\SanitizerString;

$title = SanitizerString::secureShowOutput($data['post']['title']) ?>

<?php ob_start() ?>
<div class="row w-100">
    <div class="col">
        <div class="card shadow">
            <h5 class="card-header text-center"><?= SanitizerString::secureShowOutput($data['post']['title']) ?></h5>
            <div class="card-body">
                <p class="card-text"><?= SanitizerString::secureShowOutput($data['post']['content']) ?></p>
                <p class="card-text mb-0"><small class="text-body-secondary fw-medium">Auteur : <?= SanitizerString::secureShowOutput($data['post']['author']) ?></small></p>
                <p class="card-text"><small class="text-body-secondary fst-italic"> <?= $data['postDate'] ?></small></p>
                <div class="d-flex justify-content-between">
                    <a class="btn btn-primary" href="/">Retour à la page d'accueil</a>
                    <p><?= count($data['comments']) < 2 ? count($data['comments']) . ' commentaire' : count($data['comments']) . ' commentaires' ?></p>
                </div>
            </div>
        </div>

        <?php if (count($data['comments']) > 0): ?>
            <div class="mt-3 card">
                <?php foreach ($data['comments'] as $comment): ?>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <p><?= SanitizerString::secureShowOutput($comment['comment']) ?></p>
                            <small class="fst-italic">Commentaire de : <?= SanitizerString::secureShowOutput($comment['firstname']) ?></small>
                            <p><small class="fst-italic"> <?= DateFormat::dateSanitizer($comment['created_at']) ?></small></p>
                            <?php if ($data['isConnected'] && $data['userId'] === $comment['user_id']): ?>
                                <div class="d-flex gap-2">
                                    <a href="/comment/<?= $comment['id_comment'] ?>" class="btn btn-primary btn-sm">modifier</a>
                                    <form action="/comment/delete/<?= $comment['id_comment'] ?>" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce commentaire ?');">
                                        <button type="submit" class="btn btn-danger btn-sm">supprimer</button>
                                    </form>
                                <?php endif ?>
                        </li>
                    </ul>
                <?php endforeach ?>
            </div>
        <?php endif ?>
        <?php if (!$data['isConnected']): ?>
            <p class="mt-3 "><a href="/login">Se connecter pour laisser un commentaire</a></p>
        <?php elseif ($data['isConnected']): ?>
            <div class="my-3">
                <?php if ($data['msgError']): ?>
                    <div class="alert alert-danger mt-2 alert-dismissible fade show" role="alert">
                        <?= $data['msgError'] ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif ?>
                <?php if ($data['commentSuccess']): ?>
                    <div class="alert alert-success mt-2 alert-dismissible fade show" role="alert">
                        <?= $data['commentSuccess'] ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif ?>
                <a class="btn btn-primary mt-2  w-100" href="/post/comment">Ajouter un commentaire</a>
            </div>
        <?php endif ?>
    </div>
</div>

<?php $content = ob_get_clean() ?>

<?php require "../src/views/layout/layout.view.php"; ?>