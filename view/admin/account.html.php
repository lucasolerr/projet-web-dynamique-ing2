<h2>Informations sur le compte</h2>
<form>
    <div class="form-group">
        <label for="email">Adresse e-mail</label>
        <input type="email" class="form-control" value="<?= $accountInfos[0]['email'] ?>" disabled>
    </div>
    <div class="form-group">
        <label for="last_name">Nom de famille</label>
        <input type="text" class="form-control" value="<?= $accountInfos[0]['last_name'] ?>" disabled>
    </div>
    <div class="form-group">
        <label for="first_name">Prénom</label>
        <input type="text" class="form-control" value="<?= $accountInfos[0]['first_name'] ?>" disabled>
    </div>
    <div class="form-group">
        <label for="account_password">Mot de passe</label>
        <div class="input-group">
            <input type="password" id="account_password" class="form-control" value="<?= $accountInfos[0]['account_password'] ?>" disabled>
            <span class="input-group-text"><i id="account_password_button" style="cursor: pointer;" class="bi bi-eye-slash-fill"></i></span>
        </div>
    </div>
    <div class="form-group">
        <label for="account_type">Type de compte</label>
        <input type="text" class="form-control" value="Admin" disabled>
    </div>
</form>


<script>
    $(document).ready(function() {
        $("#account_password_button").mousedown(function() {
            $("#account_password_button").attr("class", "bi bi-eye-fill");
            $("#account_password").attr("type", "text");
        })
        $("#account_password_button").mouseup(function() {
            $("#account_password_button").attr("class", "bi bi-eye-slash-fill");
            $("#account_password").attr("type", "password");
        })
        $("#account_password_button").mouseout(function() {
            $("#account_password_button").attr("class", "bi bi-eye-slash-fill");
            $("#account_password").attr("type", "password");
        })
    });
</script>