<h2>Clients</h2>
<div class="table-responsive">
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th scope="col">Id Box</th>
                <th scope="col">Titre</th>
                <th scope="col">Description</th>
                <th scope="col">Prix</th>
                <th scope="col">Client</th>
                <th scope="col">Date</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($clients as $client) : ?>
                <tr>
                    <td><?= $client['box_id'] ?></td>
                    <td><?= $client['box_title'] ?></td>
                    <td><?= $client['box_content'] ?></td>
                    <td><?= $client['box_price'] ?></td>
                    <td><?= $client['user_email'] ?></td>
                    <td><?= $client['purchase_date'] ?></td>
                </tr>
            <?php endforeach;?>
        </tbody>
    </table>
</div>