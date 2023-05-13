<h2>Boxs Achetées</h2>
<div class="table-responsive">
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Titre</th>
                <th scope="col">Date</th>
                <th scope="col">Choisir Mot de passe</th>
                <th scope="col">Offrir</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($purchased as $purchase) : ?>
                <tr>
                    <td><?= $purchase['box_id'] ?></td>
                    <td><?= $purchase['box_title'] ?></td>
                    <td><?= $purchase['purchase_date'] ?></td>
                    <td><input type="password" name="password" class="activity-checkbox"></td>
                    <td><input type="checkbox" name="checkbox" class="activity-checkbox"></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>