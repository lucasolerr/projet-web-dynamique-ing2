<h2>Activitées proposées</h2>
<div class="table-responsive">
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Titre</th>
                <th scope="col">Description</th>
                <th scope="col">Omnesboxs</th>
            </tr>
        </thead>
        <tbody>
            <?php for ($i=0; $i < count($activities) ; $i++) { ?>
                <tr>
                    <td><?= $activities[$i]['activity_id'] ?></td>
                    <td><?= $activities[$i]['activity_title'] ?></td>
                    <td><?= $activities[$i]['activity_content'] ?></td>
                    <td>
                        <div class="dropdown">
                            <div class="dropdown-toggle" style="cursor: pointer;" data-bs-toggle="dropdown">
                                Omnesboxs
                            </div>
                            <ul class="dropdown-menu">
                                <li><span class="dropdown-item-text">ID | titre</span></li>
                                <?php foreach ($activities_boxs[$i] as $activity_box) : ?>
                                    <li><span class="dropdown-item-text"><?= $activity_box['box_id'] ?> | <?= $activity_box['box_title'] ?></span></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>