<style>
    body {
        background-image: url('public/BG.png');
    }
</style>
<div class="container-fluid ">
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link text-white active" aria-current="page" href="index.php?controller=index&task=index">Accueil</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="row">
        <div class=" mx-auto pt-5 col-lg-6">
            <main>
                <div class="text-center p-3 rounded-5 bg-white text-dark">
                    <h2>Se connecter</h2>
                    <form method="POST" action="">
                        <div class="form-floating mb-3 mt-3">
                            <input type="email" class="form-control" id="email" name="email" placeholder="Entrez votre adresse e-mail">
                            <label for="email">Adresse e-mail</label>
                        </div>

                        <div class="form-floating mb-3 mt-3">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Entrez votre mot de passe">
                            <label for="password">Mot de passe</label>
                        </div>

                        <div class="text-center">
                            <p>Vous n'avez pas de compte ? <a href="index.php?controller=account&task=register">S'enregistrer</a></p>
                        </div>
                        <div class="text-center">
                            <button type="submit" name="login" value="login" class="btn btn-primary mt-3" style="background-color:#FF41C6; border: none;">Se connecter</button>
                        </div>
                    </form>
                </div>
            </main>
        </div>
    </div>
    <div>
        <?php
        if ($error) {
            echo $error;
        }
        ?>
    </div>
</div>