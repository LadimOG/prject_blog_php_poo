<?php $title = "Connexion"; ?>

<?php ob_start() ?>

<div class="container-fluid ">
    <div class="form-container">
        <h1>Se connecter</h1>
        <?php if (isset($_SESSION['MSG_ERROR'])) { ?>
            <span class="text-danger fw-medium"><?= $_SESSION['MSG_ERROR'] ?></span>
        <?php } ?>
        <?php unset($_SESSION['MSG_ERROR']) ?>
        <form class=" container-xl border px-2 py-3 rounded-2 shadow" method="POST" action="/login">
            <div class="form-group mb-3">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" id="email1" value="" placeholder="Entrer votre email">
            </div>
            <div class="form-group mb-4">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Mot de passe">
            </div>

            <button type="submit" class=" w-100 btn btn-primary">Connecter</button>
        </form>
        <p class="mt-3"><a href="/signup">créer un nouveau compte</a></p>
    </div>

</div>

<?php $content = ob_get_clean(); ?>

<?php require '../src/views/layout/layout.view.php' ?>