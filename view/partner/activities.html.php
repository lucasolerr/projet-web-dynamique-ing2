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
                <?php $var = ($activity['isSelected']) ? 'checked' : ''; ?>
                <tr>
                    <td><?= $activity['activity_id'] ?></td>
                    <td><?= $activity['activity_title'] ?></td>
                    <td><?= $activity['activity_content'] ?></td>
                    <td><input type="checkbox" name="checkbox" class="activity-checkbox" data-activity-id="<?= $activity['activity_id'] ?>" <?= $var ?>></td>
                    <td>
                        <a href="index.php?controller=partner&task=index&section=boxsFromActivityFromSite&activity_id=<?= $activity['activity_id'] ?>">
                            <i class="bi bi-chevron-right"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<script>
    $(document).ready(function() {
        $('.activity-checkbox').change(function() {
            var activityId = $(this).data('activity-id');
            var isChecked = $(this).is(':checked');
            var selectedValue = (isChecked) ? 'true' : 'false';
            window.location.href = "index.php?controller=partner&task=index&section=activities&selected=" + selectedValue + "&activity_id=" + activityId;
        });
    });
</script>
