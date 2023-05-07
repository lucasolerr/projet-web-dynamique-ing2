<?php $var = '' ?>
<h2>Pour l'activitée <?= $boxs[0]['activity_id'] ?> : <?= $boxs[0]['activity_title'] ?></h2>
<div class="table-responsive">
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Titre</th>
                <th scope="col">Contenu</th>
                <th scope="col">Prix</th>
                <th scope="col"> </th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($boxs as $box) : ?>
                <tr>
                    <td><?= $box['box_id'] ?></td>
                    <td><?= $box['box_title'] ?></td>
                    <td><?= $box['box_content'] ?></td>
                    <td><?= $box['box_price'] ?></td>
                    <?php ($box['isSelected']) ? $var = 'checked' : $var = ''; ?>
                    <td>
                        <input type="checkbox" name="checkbox" id="checkbox" disabled <?= $var ?>>
                    </td>
                </tr>
            <?php endforeach;?>
        </tbody>
    </table>
</div>