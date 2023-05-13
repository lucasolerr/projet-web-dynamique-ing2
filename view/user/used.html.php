<h2>Boxs Utilisées</h2>
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
            <?php foreach ($used as $used) : ?>
                <tr>
                    <td><?= $used['box_id'] ?></td>
                    <td><?= $used['box_title'] ?></td>
                    <td><?= $used['used_date'] ?></td>
                    <td><?= $used['chosen_partner_email'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>