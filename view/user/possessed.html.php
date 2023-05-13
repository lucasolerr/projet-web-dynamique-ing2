<h2>Boxs Possédées</h2>
<div class="table-responsive">
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Titre</th>
                <th scope="col">Date</th>
                <th scope="col">Partenaire</th>
                <th scope="col">Prix</th>
                <th scope="col">Choisir Mot de passe</th>
                <th scope="col">Offrir</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($possessed as $possesse) : ?>
                <tr>
                    <td><?= $possesse['box_id'] ?></td>
                    <td><?= $possesse['box_title'] ?></td>
                    <td><?= $possesse['possession_date'] ?></td>
                    <td><?= $possesse['chosen_partner_email'] ?></td>
                    <td><?= $possesse['box_price'] ?></td>
                    <td><input type="password" name="password" class="offer-password"></td>
                    <td><input type="checkbox" data-possession-id="<?=$possesse['possession_id']?>" name="checkbox" class="offer-checkbox"></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script>
    $(document).ready(function() {
        $('.offer-checkbox').change(function() {
            var possessionId = $(this).data('possession-id');
            var isChecked = $(this).is(':checked');
            var selectedValue = (isChecked) ? 'true' : 'false';
            var password = $('input[name="password"]').val(); // Récupérer la valeur de l'input
            window.location.href = "index.php?controller=user&task=index&section=possessed&selected=" + selectedValue + "&possession_id=" + possessionId + '&password=' + password;
        });
    });
</script>