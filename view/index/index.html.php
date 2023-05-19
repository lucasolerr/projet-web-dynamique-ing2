<!-- Barre de navigation -->
<div id="1" class="bg-purple text-white" style="background: linear-gradient(94.59deg, #4923B4 2.39%, #E878CF 97.66%);">
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a href="#" class="navbar-brand">
                <img src="/public/assets/index/logo.svg" alt="Logo Omnesbox">
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
        <div class="row d-flex align-items-center">
            <div class="col-md-6">
                <h2>Venez ACHETER une carte cadeau</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolor, at aliquam. Laborum in velit eveniet, earum totam nemo nesciunt voluptates voluptate sed dolor maiores consectetur sint, recusandae adipisci consequatur. Pariatur!</p>
                <button class="btn btn-lg btn-primary">Acheter</button>
                <button class="btn btn-lg btn-secondary">Infos</button>
            </div>
            <div class="col-md-6 d-flex justify-content-center">
                <img class="img-fluid" src="/public/assets/index/illustration.png" alt="illustration">
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
            <img src="/public/assets/index/partenaires/microsoft.svg" alt="microsoft">
        </div>
        <div class="col">
            <img src="/public/assets/index/partenaires/treehouse.svg" alt="treehouse">
        </div>
        <div class="col">
            <img src="/public/assets/index/partenaires/amazon.svg" alt="amazon">
        </div>
        <div class="col">
            <img src="/public/assets/index/partenaires/slack.svg" alt="slack">
        </div>
        <div class="col">
            <img src="/public/assets/index/partenaires/google.svg" alt="google">
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
                <?php foreach ($activities as $activity) : ?>
                    <button type="button" class="btn btn-secondary filter-button" data-filter="<?= $activity['activity_title'] ?>"><?= $activity['activity_title'] ?></button>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <div class="row row-cols-auto justify-content-start">
        <?php foreach ($all_boxs as $box) : if($box['price'] != NULL): ?>
            <div class="col card-container <?= $box['activity'] ?>" data-box-id="<?= $box['id'] ?>">
                <div class="card p-3 mb-2" style="width: 20rem;">
                    <img class="card-img-top" src="/public/assets/index/card.png" alt="cover">
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
                            <a href="#" class="btn btn-primary">Add to cart</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; endforeach; ?>
    </div>
    <div id="3" class="container">
        <?= $hasBoxSection ?>
    </div>
</div>

<script>
    $(document).ready(function() {
        $(".filter-button").click(function() {
            var value = $(this).attr('data-filter');
            if (value == "all") {
                $('.card-container').show();
            } else {
                $(".card-container").not('.' + value).hide();
                $('.card-container').filter('.' + value).show();
            }
        });
    });

    $(document).ready(function() {
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
</style>