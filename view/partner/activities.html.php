<h2>Activitées proposées</h2>
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
            <?php foreach ($activities as $activity) : ?>
                <tr>
                    <td><?= $activity['activity_id'] ?></td>
                    <td><?= $activity['activity_title'] ?></td>
                    <td><?= $activity['activity_content'] ?></td>
                </tr>
            <?php endforeach;?>
        </tbody>
    </table>
</div>