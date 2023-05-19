<h2>Boxs Offertes</h2>
<div class="table-responsive">
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Titre</th>
                <th scope="col">Date</th>
                <th scope="col">Partenaire</th>
                <th scope="col">Prix</th>
                <th scope="col">Utilisateur</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($offered as $offer) : ?>
                <tr>
                    <td><?= $offer['box_id'] ?></td>
                    <td><?= $offer['box_title'] ?></td>
                    <td><?= $offer['possession_date'] ?></td>
                    <td><?= $offer['chosen_partner_email'] ?></td>
                    <td><?= $offer['box_price'] ?></td>
                    <td><?= $offer['user_email'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>