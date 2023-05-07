<h2>Clients</h2>
<div class="table-responsive">
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th scope="col">Id Box</th>
                <th scope="col">Titre</th>
                <th scope="col">Prix</th>
                <th scope="col">Client</th>
                <th scope="col">Date</th>
                <th scope="col"> </th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($clients as $client) : ?>
                <tr>
                    <td><?= $client['box_id'] ?></td>
                    <td><?= $client['box_title'] ?></td>
                    <td><?= $client['box_price'] ?></td>
                    <td><?= $client['user_email'] ?></td>
                    <td><?= $client['possession_date'] ?></td>
                    <td><input type="checkbox" name="checkbox" class="client-checkbox" data-id="<?= $client['possession_id'] ?>" data-client-email="<?= $client['user_email'] ?>"></td>
                </tr>
            <?php endforeach;?>
        </tbody>
    </table>
</div>
<script>
    $(document).ready(function() {
        $('.client-checkbox').change(function() {
            console.log('test');
            var id = $(this).data('id')
            var clientEmail = $(this).data('client-email');
            var isChecked = $(this).is(':checked');
            var selectedValue = (isChecked) ? 'true' : 'false';
            window.location.href = "index.php?controller=partner&task=index&section=validation&selected=" + selectedValue + "&client_email=" + clientEmail + "&id=" + id;
        });
    });
</script>