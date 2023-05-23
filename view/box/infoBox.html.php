<style>
    body {
        background: linear-gradient(94.59deg, #4923B4 2.39%, #E878CF 97.66%);
    }
</style>
<div class="container-fluid">
    <div class="row">
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a href="#" class="navbar-brand">
                    <img src="/projet-web-dynamique-3g/public/assets/index/logo.svg" alt="Logo Omnesbox">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                    <a class="nav-link text-white active" aria-current="page" href="index.php?controller=index&task=index">Accueil</a>
                </div>
                <div class="right-area">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <?php if ($isLogin) : ?>
                                <a href="index.php?controller=<?= $_SESSION['account_type']; ?>&task=index" class="nav-link text-white">
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
        <div class=" mx-auto p-5">
            <div class="pt-3 pb-5 rounded-5 bg-white text-dark">
                <div class="p-3 m-3">
                    <h2><?= $box['box_title'] ?></h2>
                </div>
                <div class="row">
                    <div class="col-md-3 mx-auto float-start">
                        <?php $nom = $box['activity_title'];
                        $chemin_image = "/projet-web-dynamique-3g/public/assets/index/" . $nom . ".jpg";
                        ?>
                        <img src=<?= $chemin_image ?> class="rounded img-fluid">
                    </div>
                    <div class="col-md-5 mx-auto">
                        <div class="ms-4">
                            <ul class="pt-3">
                                <li><?= $box['box_content'] ?></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3 mx-auto pt-3">
                        <div class="border border-2 rounded-4">
                            <div class="text-center p-3">
                                <p style=" font-size:24px; color:#FF41C6"><?= $box['box_price'] ?>€</p>
                                <div class="p-3">
                                    <select id="quantity-select" class="form-select" aria-label="Default select example" style="color:#FF41C6;">
                                        <option value="">Choisissez la quantité</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                    </select>
                                </div>
                                <button id="cart" class="btn btn-primary" style="background-color:#FF41C6; border: none;">Ajouter au panier</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3  mx-auto pt-3">
                        <select class="form-select test" aria-label="Default select example">
                            <option value="">Choisissez votre partenaire</option>
                            <?php foreach ($partners as $partner) : ?>
                                <?php $select;
                                if ($partner['partner_email'] == $_GET['partner']) {
                                    $select = "selected";
                                } else {
                                    $select = "";
                                } ?>
                                <option <?= $select ?> value="<?= $partner['partner_email'] ?>"><?= $partner['partner_email'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="row">
                        <?php if ($grade != NULL) : ?>

                            <div class="ratings p-3 col-md-2 text-center ">
                                <?php
                                $rating = $grade; // variable de notation
                                for ($i = 1; $i <= 5; $i++) {
                                    if ($i <= $rating) {
                                        echo '<i class="bi bi-star-fill rating-color"></i>'; // étoile pleine si la valeur est <= à la variable
                                    } else {
                                        echo '<i class="bi bi-star rating-color"></i>'; // étoile vide sinon
                                    }
                                }
                                ?>
                                <p><?= $num_reviews ?> Avis</p>
                            </div>
                        <?php else : ?>
                            <div class="rating p-3 col-md-2 text-center">
                                <i class="bi bi-star rating-color"></i>
                                <i class="bi bi-star rating-color"></i>
                                <i class="bi bi-star rating-color"></i>
                                <i class="bi bi-star rating-color"></i>
                                <i class="bi bi-star rating-color"></i>
                                <p>0 avis</p>
                            </div>
                        <?php endif; ?>
                    </div>
                    <form method="POST" action="">
                    </form>

                    <h2 class="col-md-2 text-center">Les Avis :</h2>
                    <?php foreach ($reviews as $review) : ?>
                        <div class="col-md-12 p-3">
                            <div class="alert alert-info" role="alert">
                                <strong><?= $review['user_email'] ?></strong> <?= $review['grade'] ?>/5 : <?= $review['comment'] ?>
                                <div>
                                    a utilisé sa box chez <strong><?= $review['chosen_partner_email'] ?></strong>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        </div>

                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#cart').click(function() {
            var boxId = <?= $box['box_id'] ?>;
            var quantity = $('#quantity-select').val();
            if (quantity) {
                var partnerEmail = '<?= $partner['partner_email'] ?>';
                var url = 'index.php?controller=index&task=cart&action=add&box_id=' + boxId + '&quantity=' + quantity + '&partner_email=' + partnerEmail;
                window.location.href = url;
            }

        });
        $('select.test').change(function() {
            var partner_email = $(this).val(); // récupérer l'email du partenaire sélectionné
            console.log(partner_email);
            var url = window.location.href; // récupérer l'URL de la page avec les paramètres GET existants
            var new_url = url.replace(/&?partner=[^&]*/, '') + ((url.indexOf('?') == -1) ? '?' : '&') + "partner=" + encodeURIComponent(partner_email); // supprimer le paramètre GET "partner" existant et ajouter le nouveau paramètre GET avec l'adresse e-mail du partenaire sélectionné
            window.location.replace(new_url); // mettre à jour l'URL de la page
        });
    });
</script>