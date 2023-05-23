<?php if (!empty($boxs)) : ?>
    <h2>Pour l'activitée <?= $boxs[0]['activity_id'] ?> : <?= $boxs[0]['activity_title'] ?></h2>
<?php else : ?>
    <h2>Aucune boxs liées à l'activitée <?= $_GET['activity_id'] ?></h2>
<?php endif; ?>

<form id="box-form" method="post">
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
                        <td>
                            <?php echo $box['box_content'] === '' ? '<input type="text" name="box_content" value="">' : $box['box_content']; ?>
                        </td>
                        <td>
                            <?php echo $box['box_price'] === '' ? '<input type="number" name="box_price" step="0.01" value="">' : $box['box_price']; ?>
                        </td>
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
</form>

<script>
    $(document).ready(function() {
        $('.box-checkbox').change(function() {
            var boxId = $(this).data('box-id');
            var isChecked = $(this).is(':checked');
            var selectedValue = (isChecked) ? 'true' : 'false';
            var boxContent = $(this).closest('tr').find('input[name="box_content"]').val();
            var boxPrice = $(this).closest('tr').find('input[name="box_price"]').val();
            $('#box-form').attr('action', 'index.php?controller=partner&task=index&section=boxs&activity_id=<?= $_GET['activity_id']; ?>&selected=' + selectedValue + '&box_id=' + boxId + '&box_content=' + boxContent + '&box_price=' + boxPrice);
            $('#box-form').submit();
        });
    });
</script>