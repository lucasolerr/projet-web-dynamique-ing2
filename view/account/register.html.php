<style>
    body {
        background: linear-gradient(94.59deg, #4923B4 2.39%, #E878CF 97.66%);
    }
</style>
<div class="container-fluid">
    <div class="row">
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
        <div class=" mx-auto pt-3 col-lg-6">
            <main>
                <div class="text-center p-3 rounded-5 bg-white text-dark">
                    <h2>S'enregistrer</h2>
                    <form method="POST" action="">
                        <div class="form-floating mb-3 mt-3">
                            <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Entrez votre nom">
                            <label for="nom">Nom</label>
                        </div>
                        <div class="form-floating mb-3 mt-3">
                            <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Entrez votre prenom">
                            <label for="prenom">Prenom</label>
                        </div>
                        <div class="form-floating mb-3 mt-3">
                            <input type="email" class="form-control" id="email" name="email" placeholder="Entrez votre adresse e-mail">
                            <label for="email">Adresse e-mail</label>
                        </div>
                        <div class="form-floating mb-3 mt-3">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Entrez votre mot de passe">
                            <label for="mdp">Mot de passe</label>

                        </div>
                        <div class="form-floating mb-3 mt-3">
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirmer votre mot de passe">
                            <label for="confirme_mdp">Confirmer le mot de passe</label>

                        </div>
                        <div class="text-center">
                            <button type="submit" name="register" value="register" class="btn btn-primary mt-3" style="background-color:#FF41C6; border: none;">S'enregistrer</button>
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