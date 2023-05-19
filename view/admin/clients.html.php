<h2>Clients</h2>
<div class="table-responsive">
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th scope="col">Email</th>
                <th scope="col">Nom</th>
                <th scope="col">Prénom</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($clients as $client) : ?>
                <tr>
                    <td><?= $client['email'] ?></td>
                    <td><?= $client['last_name'] ?></td>
                    <td><?= $client['first_name'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>