<h2>Partenaires</h2>
<div class="table-responsive">
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th scope="col">Email</th>
                <th scope="col">Nom</th>
                <th scope="col">Activités</th>
                <th scope="col">Omnesboxs</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($parnters as $partner) : ?>
                <tr>
                    <td><?= $partner['email'] ?></td>
                    <td><?= $partner['last_name'] ?></td>
                    <td>
                        <div class="dropdown">
                            <div class="dropdown-toggle" style="cursor: pointer;" data-bs-toggle="dropdown">
                                Activités
                            </div>
                            <ul class="dropdown-menu">
                                <li><span class="dropdown-item-text">ID | titre</span></li>
                                <?php foreach ($partner["activities"] as $partner_activity) : ?>
                                    <li><span class="dropdown-item-text"><?= $partner_activity['activity_id'] ?> | <?= $partner_activity['activity_title'] ?></span></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </td>
                    <td>
                        <div class="dropdown">
                            <div class="dropdown-toggle" style="cursor: pointer;" data-bs-toggle="dropdown">
                                Omnesboxs
                            </div>
                            <ul class="dropdown-menu">
                                <li><span class="dropdown-item-text">ID | titre</span></li>
                                <?php foreach ($partner["boxs"] as $partner_box) : ?>
                                    <li><span class="dropdown-item-text"><?= $activity_box['box_id'] ?> | <?= $activity_box['box_title'] ?></span></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>