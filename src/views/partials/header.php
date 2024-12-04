<nav class="navbar navbar-expand-lg bg-light sticky-top ">
    <div class="container-fluid ">
        <h2 class="navbar-brand"><a href="/" class="nav-link">Ladim OG</a></h2>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarToggler">
            <ul class="navbar-nav ms-auto ">
                <li class="nav-item">
                    <a class="nav-link active" href="/category/dev">Développement web</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="/category/hightech">High-tech</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact</a>
                </li>
                <li class="nav-item ">
                    <?php if (!isset($_SESSION['connected'])): ?>
                        <a href="/login" class="  btn btn-primary position-relative">Connexion
                            <span class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle">
                                <span class="visually-hidden">New alerts</span>
                            </span>

                        </a>
                    <?php else: ?>
                        <a href="/logout" class="btn btn-primary position-relative">Déconnecter
                            <span class="position-absolute top-0 start-100 translate-middle p-2 bg-success border border-light rounded-circle">
                                <span class="visually-hidden"></span>
                            </span>
                        </a>
                    <?php endif ?>
                </li>
            </ul>
        </div>

    </div>
</nav>