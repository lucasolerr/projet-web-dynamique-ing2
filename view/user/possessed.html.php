<h2>Boxs Possédées</h2>
<div class="table-responsive">
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Titre</th>
                <th scope="col">Date</th>
                <th scope="col">Partenaire</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($possessed as $possesse) : ?>
                <tr>
                    <td><?= $possesse['box_id'] ?></td>
                    <td><?= $possesse['box_title'] ?></td>
                    <td><?= $possesse['possession_date'] ?></td>
                    <td><?= $possesse['chosen_partner_email'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>