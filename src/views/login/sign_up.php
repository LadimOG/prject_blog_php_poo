<?php $title = "Inscription"; ?>

<?php ob_start() ?>
<div class="container-lg ">
    <div class="form-container col-12 col-md-6 mx-auto mt-5 ">
        <h1 class="mb-2 text-muted">S'inscrire</h1>
        <?php if (isset($_SESSION['MSG_ERROR'])): ?>
            <div class="containe-fluid my-2">
                <span class="text-danger fw-medium "><?= $_SESSION['MSG_ERROR'] ?></span>
            </div>
            <?php unset($_SESSION['MSG_ERROR']) ?>
        <?php endif ?>
        <form class="row container-xl border px-2 py-3 rounded-2 shadow" method="POST" action="/signup">
            <div class="form-group mb-3 col">
                <label for="lastname" class="form-label">Nom</label>
                <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Nom" required>
            </div>
            <div class="form-group mb-3 col">
                <label for="firstname" class="form-label">Prenom</label>
                <input type="text" class="form-control" name="firstname" id="firstname" placeholder="Prenom" required>
            </div>
            <div class="form-group mb-3">
                <label for="age" class="form-label">Age</label>
                <input type="number" class="form-control" name="age" id="age" placeholder="Votre age" required>
            </div>
            <div class="form-group mb-3 ">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" id="email1" aria-describedby="emailHelp" placeholder="Entrer votre email" required>
            </div>
            <div class="form-group mb-4 col">
                <label for="password">Mot de passe</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Mot de passe" required>
            </div>
            <div class="form-group mb-4 col">
                <label for="password">Ressaisissez votre mot de passe</label>
                <input type="password" class="form-control" name="password2" id="password" placeholder="Mot de passe" required>
            </div>

            <button type="submit" class=" w-100 btn btn-primary">Valider</button>
        </form>
        <p class="mt-3"><a href="/login">Se connecter</a></p>
    </div>
</div>

<?php $content = ob_get_clean(); ?>

<?php require '../src/views/layout/layout.view.php' ?>