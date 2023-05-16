<h2>Omnesboxs proposées</h2>
<div class="table-responsive">
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Titre</th>
                <th scope="col">Description</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($boxs as $box) : ?>
                <tr>
                    <td><?= $box['box_id'] ?></td>
                    <td><?= $box['box_title'] ?></td>
                    <td><?= $box['box_content'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>