<div>
    <h2>Ajouter</h2>
    <div class="dropdown">
        <button type="button" id="add_dropdown" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">
            Choix
        </button>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" id="partner_button">Partenaire</a></li>
            <li><a class="dropdown-item" id="activity_button">Activitée</a></li>
            <li><a class="dropdown-item" id="box_button">Box</a></li>
        </ul>
    </div>
    <div id="add_partner">
        <form action="/index.php?controller=Admin&task=add_partner" method="post">
            <div class="mb-3 mt-3">
                <label for="partner_name" class="form-label">Nom :</label>
                <input type="text" maxlength="50" required class="form-control" id="partner_name" placeholder="Entrez le nom du partenaire" name="partner_name">
            </div>
            <div class="mb-3 mt-3">
                <label for="partner_email" class="form-label">Email :</label>
                <input type="email" maxlength="100" required class="form-control" id="partner_email" placeholder="Entrez l'email du partenaire" name="partner_email">
            </div>
            <button type="submit" class="btn btn-primary">Envoyer</button>
        </form>
    </div>
    <div id="add_activity">
        <form action="/index.php?controller=Admin&task=add_activity" method="post">
            <div class="mb-3 mt-3">
                <label for="activity_title" class="form-label">Titre :</label>
                <input type="text" maxlength="100" required class="form-control" id="activity_title" placeholder="Entrez le titre de l'activité" name="activity_title">
            </div>
            <div class="mb-3 mt-3">
                <label for="activity_content">Contenu :</label>
                <textarea class="form-control" maxlength="500" required rows="3" id="activity_content" name="activity_content"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Envoyer</button>
        </form>
    </div>
    <div id="add_box">
        <form action="/index.php?controller=Admin&task=add_box" method="post">
            <div class="mb-3 mt-3">
                <label for="box_title" class="form-label">Titre :</label>
                <input type="text" maxlength="100" required class="form-control" id="box_title" placeholder="Entrez le titre de la box" name="box_title">
            </div>
            <div class="mb-3 mt-3">
                <label for="box_activity">Activité :</label>
                <select id="box_activity" class="form-select" name="box_activity">
                    <?php foreach ($activitiesForAdd as $activity) : ?>
                        <option value="<?= $activity['activity_id'] ?>"><?= $activity['activity_title'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3 mt-3">
                <label for="box_price" class="form-label">Prix :</label>
                <input type="number" min="0.01" max="100000" step="0.01" required class="form-control" id="box_price" placeholder="Entrez le prix de la box" name="box_price">
            </div>
            <div class="mb-3 mt-3">
                <label for="box_content">Contenu :</label>
                <textarea class="form-control" maxlength="500" required rows="3" id="box_content" name="box_content"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Envoyer</button>
        </form>
    </div>
</div>


<script>
    $(document).ready(function() {
        $("#add_partner").hide();
        $("#add_activity").hide();
        $("#add_box").hide();

        $("#partner_button").click(function() {
            $("#add_partner").show();
            $("#add_activity").hide();
            $("#add_box").hide();
            $("#add_dropdown").text("Partenaire");
        });
        $("#activity_button").click(function() {
            $("#add_partner").hide();
            $("#add_activity").show();
            $("#add_box").hide();
            $("#add_dropdown").text("Activité");
        });
        $("#box_button").click(function() {
            $("#add_partner").hide();
            $("#add_activity").hide();
            $("#add_box").show();
            $("#add_dropdown").text("Box");
        });
    });
</script>