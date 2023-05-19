<h2>Boxs Achetées</h2>
<div class="table-responsive">
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Titre</th>
                <th scope="col">Date</th>
                <th scope="col">Prix</th>
                <th scope="col">Partenaire</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($purchased as $purchase) : ?>
                <tr>
                    <td><?= $purchase['box_id'] ?></td>
                    <td><?= $purchase['box_title'] ?></td>
                    <td><?= $purchase['purchase_date'] ?></td>
                    <td><?= $purchase['box_price'] ?></td>
                    <td><?= $purchase['partner_email'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>