<h2>Omnesboxs proposées</h2>
<div class="table-responsive">
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Titre</th>
                <th scope="col">Description</th>
                <th scope="col">Prix</th>
                <th scope="col">Activité</th>
                <th scope="col">Id</th>
            </tr>
        </thead>
        <tbody>
            <?php for ($i=0; $i < count($boxs); $i++) {  ?>
                <tr>
                    <td><?= $boxs[$i]['box_id'] ?></td>
                    <td><?= $boxs[$i]['box_title'] ?></td>
                    <td><?= $boxs[$i]['box_content'] ?></td>
                    <td><?= $boxs[$i]['box_price'] ?></td>
                    <td><?= $boxs_activity[$i][0]['activity_title'] ?></td>
                    <td><?= $boxs_activity[$i][0]['activity_id'] ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>