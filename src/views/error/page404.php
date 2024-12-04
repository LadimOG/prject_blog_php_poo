<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page non trouvée - 404</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        /* Style supplémentaire pour centrer le contenu de la page */
        .container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
</head>

<body>

    <div class="container text-center">
        <div>
            <h1 class="display-1 text-danger">404</h1>
            <h2>Oups ! La page que vous cherchez n'existe pas.</h2>
            <p class="lead"><?= $_SESSION['MSG_ERROR_404'] ?></p>
            <a href="/" class="btn btn-primary">Retour à l'accueil</a>
        </div>
    </div>

    <!-- Lien vers les scripts Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pzjw8f+ua7Kw1TIq0v8Fq3qBbF0gSy9y9rV1B38qrGhV9tBtvGHj7mFLkPl6pcn0" crossorigin="anonymous"></script>
</body>

</html>