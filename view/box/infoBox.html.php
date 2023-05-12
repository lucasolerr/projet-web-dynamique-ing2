<style>
    body {
        background-image: url('public/BG.png');
    }
</style>
<div class="container-fluid">
    <div class="row">
        <div class=" mx-auto p-5">
            <div class="pt-3 pb-5 rounded-5 bg-white text-dark">
                <div class="p-3 m-3">
                    <h2><?= $box['box_title'] ?></h2>
                </div>
                <div class="row">
                    <div class="col-md-3 mx-auto float-start">
                        <img src="public/assets/box/parachute.jpg" class="rounded img-fluid">

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
                                <button type="submit" name="login" value="login" class="btn btn-primary" style="background-color:#FF41C6">Ajouter au panier</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3  mx-auto pt-3">
                        <select class="form-select" aria-label="Default select example">
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
                    <?php if ($grade != NULL) : ?>
                        <div class="ratings">
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
                        <div class="rating">
                            <i class="bi bi-star rating-color"></i>
                            <i class="bi bi-star rating-color"></i>
                            <i class="bi bi-star rating-color"></i>
                            <i class="bi bi-star rating-color"></i>
                            <i class="bi bi-star rating-color"></i>
                            <p>0 avis</p>
                        </div>
                    <?php endif; ?>
                    <form method="POST" action="">
                    </form>
                    <div class="md-12">
                        <h2>Avis :</h2>
                        <?php foreach ($reviews as $review) : ?>
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
        $('select.form-select').change(function() {
            var partner_email = $(this).val(); // récupérer l'email du partenaire sélectionné
            console.log(partner_email);
            var url = window.location.href; // récupérer l'URL de la page avec les paramètres GET existants
            var new_url = url.replace(/&?partner=[^&]*/, '') + ((url.indexOf('?') == -1) ? '?' : '&') + "partner=" + encodeURIComponent(partner_email); // supprimer le paramètre GET "partner" existant et ajouter le nouveau paramètre GET avec l'adresse e-mail du partenaire sélectionné
            window.location.replace(new_url); // mettre à jour l'URL de la page
        });
    });
</script>