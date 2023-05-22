<!-- Barre de navigation -->
<div id="1" class="bg-purple text-white" style="background: linear-gradient(94.59deg, #4923B4 2.39%, #E878CF 97.66%);">
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a href="#" class="navbar-brand">
                <img src="/projet-web-dynamique-3g/public/assets/index/logo.svg" alt="Logo Omnesbox">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link text-white active" aria-current="page" href="index.php?controller=index&task=index">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="index.php?controller=index&task=index">Cartes Cadeaux</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="index.php?controller=index&task=index">J'ai une Omnesbox</a>
                    </li>
                </ul>
            </div>
            <div class="right-area">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <?php if ($isLogin) : ?>
                            <a href="index.php?controller=<?= $accountType; ?>&task=index" class="nav-link text-white">
                                <i class="bi bi-person"></i>
                                Mon compte
                            </a>
                        <?php else : ?>
                            <a href="index.php?controller=account&task=login" class="nav-link text-white">
                                <i class="bi bi-person"></i>
                                Login
                            </a>
                        <?php endif; ?>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link text-white">
                            <i class="bi bi-cart"></i>
                            Panier
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Contenu de la page -->
    <div class="container">
        <div>
            <h1 class="text-center p-5">
                Récapitulatif de mon panier
            </h1>
        </div>
        <div class="row">
            <div class="col-md-7 mx-auto p-3 rounded-5 bg-white text-dark">
                <?php foreach ($cart as $cart) : ?>
                    <div class="row p-3 ">
                        <div class="col-md-3 ">
                            <img src="public/assets/box/parachute.jpg" class="rounded img-fluid">
                        </div>
                        <div class="col-md-4 ">
                            <h4><?= $cart['box_title'] ?></h4>
                        </div>
                        <div class="col-md-1 d-flex justify-content-center align-items-center">
                            <p class="quantity fw-semibold"><?= $cart['articles_number'] ?></p>
                        </div>
                        <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                            <p class="price fw-bold"><?= $cart['box_price'] ?>€</p>
                        </div>
                        <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                            <button>
                                <i class="bi bi-trash"></i>
                            </button>

                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="col-md-3 mx-auto text-center p-3 rounded-5 bg-white text-dark max-height-container">
                <div class="row p-3">
                    <div class="col-md-6 ">
                        <p class="total fw-bold">Total :</p>
                    </div>
                    <div class="col-md-6">
                        <p class="priceTotal fw-bold"> <?= $totalPrice ?> €</p>
                    </div>
                </div>

                <form method="POST" action="">
                    <div class="text-center">
                        <button type="submit" name="valider" value="valider" class="btn btn-primary mt-3" style="background-color: #61B500;">Valider ma commande</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .max-height-container {
        max-height: 175px;
    }

    .quantity {
        font-size: 15px;
    }

    .price {
        font-size: 20px;
    }

    .total {
        font-size: 23px;
    }

    .priceTotal {
        font-size: 23px;
    }
</style>