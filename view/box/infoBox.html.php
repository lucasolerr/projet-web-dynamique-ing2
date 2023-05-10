<style>
    body {
        background-image: url('view/BG.png');
    }
</style>
<div class="container-fluid">
    <div class="row">
        <div class=" mx-auto p-5">
            <div class="pt-3 pb-5 rounded-5 bg-white text-dark">
                <div class="p-3 m-3">
                    <h2><?= $activity_title ?></h2>
                </div>
                <div class="row">
                    <div class="col-md-3 mx-auto float-start">
                        <img src="view/parachute.jpg" class="rounded img-fluid">

                    </div>
                    <div class="col-md-5 mx-auto">
                        <div class="d-flex ms-4">
                            <button type="button" class="btn btn-outline-warning"><i class="bi bi-star-fill"></i></button>
                            <button type="button" class="btn btn-outline-warning"><i class="bi bi-star-fill"></i></button>
                            <button type="button" class="btn btn-outline-warning"><i class="bi bi-star-fill"></i></button>
                            <button type="button" class="btn btn-outline-warning"><i class="bi bi-star-fill"></i></button>
                            <button type="button" class="btn btn-outline-warning"><i class="bi bi-star"></i></button>
                            <p>Lire les avis</p>
                        </div>
                        <div class="ms-4">
                            <ul class="pt-3">
                                <li><?= $activity_content ?></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3 mx-auto pt-3">
                        <div class="border border-2 rounded-4">
                            <div class="text-center p-3">
                                <p style=" font-size:24px; color:#FF41C6"><?= $box_price ?>€</p>
                                <button type="submit" name="login" value="login" class="btn btn-primary" style="background-color:#FF41C6">Ajouter au panier</button>
                            </div>
                        </div>
                    </div>
                    <form method="POST" action="">

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>