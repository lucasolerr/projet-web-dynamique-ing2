<h2>Boxs Utilisées</h2>
<div class="table-responsive">
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Titre</th>
                <th scope="col">Date</th>
                <th scope="col">Partenaire</th>
                <th scope="col">Prix</th>
                <th scope="col">Note</th>
                <th scope="col">Commentaire</th>
                <th scope="col"> </th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($used as $use) : ?>
                <tr>
                    <td><?= $use['box_id'] ?></td>
                    <td><?= $use['box_title'] ?></td>
                    <td><?= $use['used_date'] ?></td>
                    <td><?= $use['chosen_partner_email'] ?></td>
                    <td><?= $use['box_price'] ?></td>
                    <?php if (is_null($use['grade']) && is_null($use['comment'])) : ?>
                        <td><input type="number" name="grade" class="used-grade"></td>
                        <td><input type="text" name="comment" class="used-comment"></td>
                        <td><input type="checkbox" data-used-id="<?= $use['used_id'] ?>" name="checkbox" class="used-checkbox"></td>
                    <?php else : ?>
                        <td><?= $use['grade'] ?></td>
                        <td><?= $use['comment'] ?></td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script>
    $(document).ready(function() {
        $('.used-checkbox').change(function() {
            var usedId = $(this).data('used-id');
            var isChecked = $(this).is(':checked');
            var selectedValue = (isChecked) ? 'true' : 'false';
            var comment = $('input[name="comment"]').val(); // Récupérer la valeur de l'input
            var grade = $('input[name="grade"]').val(); // Récupérer la valeur de l'input
            window.location.href = "index.php?controller=user&task=index&section=used&selected=" + selectedValue + "&used_id=" + usedId + '&grade=' + grade + '&comment=' + comment;
        });
    });
</script>