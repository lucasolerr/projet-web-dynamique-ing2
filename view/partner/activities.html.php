<?php $var = '' ?>
<h2>Activitées proposées</h2>
<div class="table-responsive">
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Titre</th>
                <th scope="col">Description</th>
                <th scope="col"> </th>
                <th scope="col"> </th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($activities as $activity) : ?>
                <tr>
                    <td><?= $activity['activity_id'] ?></td>
                    <td><?= $activity['activity_title'] ?></td>
                    <td><?= $activity['activity_content'] ?></td>
                    <?php ($activity['isSelected']) ? $var = 'checked' : $var = ''; ?>
                    <td><input type="checkbox" name="checkbox" id="checkbox" disabled <?= $var ?>></td>
                    <td>
                        <a href="index.php?controller=partner&task=index&section=boxsFromActivityFromSite&activity_id=<?=$activity['activity_id']?>">
                            <i class="bi bi-chevron-right"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>