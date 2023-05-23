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
                        <a class="nav-link text-white active" aria-current="page" href="#1">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#2">Cartes Cadeaux</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#3">J'ai une Omnesbox</a>
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
                        <?php if ($isLogin) : ?>
                            <a href="index.php?controller=index&task=cart" class="nav-link text-white">
                                <i class="bi bi-cart"></i>
                                Panier
                            </a>
                        <?php else : ?>
                            <a href="index.php?controller=account&task=login" class="nav-link text-white">
                                <i class="bi bi-cart"></i>
                                Panier
                            </a>
                        <?php endif; ?>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Contenu de la page -->
    <div class="container">
        <div class="row d-flex align-items-center">
            <div class="col-md-6">
                <h2>Venez ACHETER une carte cadeau</h2>
                <p>Découvrez notre vaste sélection de cartes cadeaux et offrez un présent unique à vos proches. Notre section "J'ai une Omnesbox" vous propose d'offrir une expérience de shopping en ligne pratique et agréable.</p>
                <button class="btn btn-lg btn-primary" style="background-color:#FF41C6; border: none;">Acheter</button>
                <button class="btn btn-lg btn-secondary">Infos</button>
            </div>
            <div class="col-md-6 d-flex justify-content-center">
                <img class="img-fluid" src="/projet-web-dynamique-3g/public/assets/index/illustration.png" alt="illustration">
            </div>
        </div>
    </div>
</div>
</div>

<div class="mt-5 container">
    <div class="text-center my-5">
        <h2>Nos partenaires</h2>
    </div>
    <div class="row justify-content-center">
        <div class="col">
            <img src="/projet-web-dynamique-3g/public/assets/index/partenaires/microsoft.svg" alt="microsoft">
        </div>
        <div class="col">
            <img src="/projet-web-dynamique-3g/public/assets/index/partenaires/treehouse.svg" alt="treehouse">
        </div>
        <div class="col">
            <img src="/projet-web-dynamique-3g/public/assets/index/partenaires/amazon.svg" alt="amazon">
        </div>
        <div class="col">
            <img src="/projet-web-dynamique-3g/public/assets/index/partenaires/slack.svg" alt="slack">
        </div>
        <div class="col">
            <img src="/projet-web-dynamique-3g/public/assets/index/partenaires/google.svg" alt="google">
        </div>
    </div>
</div>
<div class="container mt-5 mb-3">
    <div>
        <h2 id="2">Nos cartes cadeaux</h2>
    </div>
    <div class="row">
        <div class="col">
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-secondary filter-button" data-filter="all">Tous</button>
                <button type="button" class="btn btn-secondary filter-button" data-filter="price-asc">Prix croissant</button>
                <button type="button" class="btn btn-secondary filter-button" data-filter="price-desc">Prix décroissant</button>
                <?php foreach ($activities as $activity) : ?>
                    <button type="button" class="btn btn-secondary filter-button" data-filter="<?= $activity['activity_title'] ?>"><?= $activity['activity_title'] ?></button>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <div class="row row-cols-auto justify-content-start">
        <?php foreach ($all_boxs as $box) : if ($box['price'] != NULL) : ?>
                <div class="col card-container <?= $box['activity'] ?>" data-box-id="<?= $box['id'] ?>" data-price="<?= $box['price'] ?>">
                    <div class="card p-3 mb-2" style="width: 20rem;">
                        <?php $nom = $box['activity'];
                        $chemin_image = "/projet-web-dynamique-3g/public/assets/index/" . $nom . ".jpg";
                        ?>
                        <img class="card-img-top" src=<?= $chemin_image ?> alt="cover">
                        <div class="card-body">
                            <h5 class="card-title"><?= $box['title'] ?></h5>
                            <div class="d-flex justify-content-between align-items-center">
                                <?php if ($box['rating'] != NULL) : ?>
                                    <div class="ratings">
                                        <?php
                                        $rating = $box['rating']; // variable de notation
                                        for ($i = 1; $i <= 5; $i++) {
                                            if ($i <= $rating) {
                                                echo '<i class="bi bi-star-fill rating-color"></i>'; // étoile pleine si la valeur est <= à la variable
                                            } else {
                                                echo '<i class="bi bi-star rating-color"></i>'; // étoile vide sinon
                                            }
                                        }
                                        ?>
                                    </div>

                                <?php endif; ?>
                                <h6 class="review-count"><?= $box['num_reviews'] ?> Avis</h6>
                            </div>
                            <div class="d-flex justify-content-between mt-3">
                                <h5><?= number_format($box['price'], 2) ?>€</h5>
                                <a href="#" class="btn btn-primary" style="background-color:#FF41C6; border: none;">Voir la box</a>
                            </div>
                        </div>
                    </div>
                </div>
        <?php endif;
        endforeach; ?>
    </div>
    <div id="3" class="container">
        <?= $hasBoxSection ?>
    </div>
</div>
<div style="height: 300px;"></div>

<footer class="footer">
    <div class="waves">
        <div class="wave" id="wave1"></div>
        <div class="wave" id="wave2"></div>
        <div class="wave" id="wave3"></div>
        <div class="wave" id="wave4"></div>
    </div>
    <ul class="social-icon">
        <li class="social-icon__item"><a class="social-icon__link" href="#">
                <ion-icon name="logo-facebook"></ion-icon>
            </a></li>
        <li class="social-icon__item"><a class="social-icon__link" href="#">
                <ion-icon name="logo-twitter"></ion-icon>
            </a></li>
        <li class="social-icon__item"><a class="social-icon__link" href="#">
                <ion-icon name="logo-linkedin"></ion-icon>
            </a></li>
        <li class="social-icon__item"><a class="social-icon__link" href="#">
                <ion-icon name="logo-instagram"></ion-icon>
            </a></li>
    </ul>
    <ul class="menu">
        <li class="menu__item"><a class="menu__link" href="#">Accueil</a></li>
        <li class="menu__item"><a class="menu__link" href="#">Boxs</a></li>
        <li class="menu__item"><a class="menu__link" href="#">Offrir</a></li>
        <li class="menu__item"><a class="menu__link" href="#">Panier</a></li>
        <li class="menu__item"><a class="menu__link" href="#">Contact</a></li>

    </ul>
    <p>&copy;2023 Omnesbox | All Rights Reserved</p>
</footer>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</html>
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "Poppins", sans-serif;
    }

    .footer {
        position: relative;
        width: 100%;
        background: #FF41C6;
        min-height: 100px;
        padding: 20px 50px;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
    }

    .social-icon,
    .menu {
        position: relative;
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 10px 0;
        flex-wrap: wrap;
    }

    .social-icon__item,
    .menu__item {
        list-style: none;
    }

    .social-icon__link {
        font-size: 2rem;
        color: #fff;
        margin: 0 10px;
        display: inline-block;
        transition: 0.5s;
    }

    .social-icon__link:hover {
        transform: translateY(-10px);
    }

    .menu__link {
        font-size: 1.2rem;
        color: #fff;
        margin: 0 10px;
        display: inline-block;
        transition: 0.5s;
        text-decoration: none;
        opacity: 0.75;
        font-weight: 300;
    }

    .menu__link:hover {
        opacity: 1;
    }

    .footer p {
        color: #fff;
        margin: 15px 0 10px 0;
        font-size: 1rem;
        font-weight: 300;
    }

    .wave {
        position: absolute;
        top: -100px;
        left: 0;
        width: 100%;
        height: 100px;
        background: url("public/wave.png");
        background-size: 1000px 100px;
    }

    .wave#wave1 {
        z-index: 1000;
        opacity: 1;
        bottom: 0;
        animation: animateWaves 4s linear infinite;
    }

    .wave#wave2 {
        z-index: 999;
        opacity: 0.5;
        bottom: 10px;
        animation: animate 4s linear infinite !important;
    }

    .wave#wave3 {
        z-index: 1000;
        opacity: 0.2;
        bottom: 15px;
        animation: animateWaves 3s linear infinite;
    }

    .wave#wave4 {
        z-index: 999;
        opacity: 0.7;
        bottom: 20px;
        animation: animate 3s linear infinite;
    }

    @keyframes animateWaves {
        0% {
            background-position-x: 1000px;
        }

        100% {
            background-positon-x: 0px;
        }
    }

    @keyframes animate {
        0% {
            background-position-x: -1000px;
        }

        100% {
            background-positon-x: 0px;
        }
    }
</style>

<script>
    $(document).ready(function() {
        $(".filter-button").click(function() {
            var value = $(this).attr('data-filter');
            if (value == "all") {
                $('.card-container').show();
            } else if (value == "price-asc") {
                $('.card-container').sort(function(a, b) {
                    var priceA = parseFloat($(a).data('price'));
                    var priceB = parseFloat($(b).data('price'));
                    return priceA - priceB;
                }).appendTo('.row.row-cols-auto');
            } else if (value == "price-desc") {
                $('.card-container').sort(function(a, b) {
                    var priceA = parseFloat($(a).data('price'));
                    var priceB = parseFloat($(b).data('price'));
                    return priceB - priceA;
                }).appendTo('.row.row-cols-auto');
            } else {
                $(".card-container").not('.' + value).hide();
                $('.card-container').filter('.' + value).show();
            }
        });

        $('.card-container').click(function() {
            var box_id = $(this).data('box-id');
            window.location.href = 'index.php?controller=box&task=afficherbox&box_id=' + box_id;
        });
    });
</script>

<style>
    .card-container:hover {
        cursor: pointer;
    }

    .filter-button {
        background-color: #fff;
        color: #333;
        border: none;
        border-radius: 0;
        padding: 10px 20px;
        margin: 5px;
        font-size: 16px;
        font-weight: bold;
        text-transform: uppercase;
        text-decoration: none;
    }

    .filter-button.active,
    .filter-button:focus {
        background-color: #fff;
        color: #6f42c1;
        border: none;
        border-bottom: 1px solid #6f42c1;
        font-size: 18px;
    }

    .filter-button:hover {
        background-color: #ccc;
        border-bottom: 1px solid #6f42c1;
        color: #333;
    }

    .filter-button[data-filter="highest-price"],
    .filter-button[data-filter="lowest-price"] {
        background-color: #fff;
        color: #333;
        border: none;
        border-radius: 0;
        padding: 10px 20px;
        margin: 5px;
        font-size: 16px;
        font-weight: bold;
        text-transform: uppercase;
        text-decoration: none;
    }

    .filter-button[data-filter="highest-price"]:hover,
    .filter-button[data-filter="lowest-price"]:hover {
        background-color: #ccc;
        border-bottom: 1px solid #6f42c1;
        color: #333;
    }
</style>