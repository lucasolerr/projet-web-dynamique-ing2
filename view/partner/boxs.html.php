<?php if (!empty($boxs)) : ?>
    <h2>Pour l'activitée <?= $boxs[0]['activity_id'] ?> : <?= $boxs[0]['activity_title'] ?></h2>
<?php else : ?>
    <h2>Aucune boxs liées à l'activitée <?= $_GET['activity_id'] ?></h2>
<?php endif; ?>

<div class="table-responsive">
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Titre</th>
                <th scope="col">Contenu</th>
                <th scope="col">Prix</th>
                <th scope="col"> </th>
                <th scope="col"> </th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($boxs as $box) : ?>
                <?php
                $isSelected = '';
                if ($box['isSelected']) {
                    $isSelected = 'checked';
                    $class = 'bg-success-subtle';
                } else {
                    $isSelected = '';
                    $class = 'bg-danger-subtle';
                }
                ?>
                <tr class="<?php echo $class ?>">
                    <td><?= $box['box_id'] ?></td>
                    <td><?= $box['box_title'] ?></td>
                    <td><?= $box['box_content'] ?></td>
                    <td><?= $box['box_price'] ?></td>
                    <td>
                        <input type="checkbox" name="checkbox" class="box-checkbox" data-box-id="<?= $box['box_id'] ?>" <?= $isSelected ?>>
                    </td>
                    <td>
                        <a href="index.php?controller=partner&task=index&section=clients&activity_id=<?= $_GET['activity_id'] ?>&box_id=<?= $box['box_id'] ?>">
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
        $('.box-checkbox').change(function() {
            var boxId = $(this).data('box-id');
            var isChecked = $(this).is(':checked');
            var selectedValue = (isChecked) ? 'true' : 'false';
            window.location.href = "index.php?controller=partner&task=index&section=boxs&activity_id=<?= $_GET['activity_id']; ?>&selected=" + selectedValue + "&box_id=" + boxId;
        });
    });
</script>