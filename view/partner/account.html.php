<h2>Informations sur le compte</h2>
<form>
    <div class="form-group">
        <label for="email">Adresse e-mail</label>
        <input type="email" class="form-control" id="email" placeholder="Entrez votre adresse e-mail" value="<?= $accountInfos[0]['email'] ?>" disabled>
    </div>
    <div class="form-group">
        <label for="last_name">Nom de famille</label>
        <input type="text" class="form-control" id="last_name" placeholder="Entrez votre nom de famille" value="<?= $accountInfos[0]['last_name'] ?>" disabled>
    </div>
    <div class="form-group">
        <label for="first_name">Prénom</label>
        <input type="text" class="form-control" id="first_name" placeholder="Entrez votre prénom" value="<?= $accountInfos[0]['first_name'] ?>" disabled>
    </div>
    <div class="form-group">
        <label for="account_password">Mot de passe</label>
        <input type="password" class="form-control" id="account_password" placeholder="Entrez votre mot de passe" value="<?= $accountInfos[0]['account_password'] ?>" disabled>
    </div>
    <div class="form-group">
        <label for="account_type">Type de compte</label>
        <select class="form-control" id="account_type" disabled>
            <option value="partner" selected>Partenaire</option>
            <option value="customer">Admin</option>
            <option value="customer">Client</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary mt-3">Modifier</button>
</form>
