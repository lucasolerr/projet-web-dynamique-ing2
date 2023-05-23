<h2>Partenaires</h2>
<div class="table-responsive" style="height: 100vh">
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
            <?php for ($i=0; $i < count($partners); $i++) {  ?>
                <tr>
                    <td><?= $partners[$i]['email'] ?></td>
                    <td><?= $partners[$i]['last_name'] ?></td>
                    <td>
                        <div class="dropdown">
                            <div class="dropdown-toggle" style="cursor: pointer;" data-bs-toggle="dropdown">
                                Activités
                            </div>
                            <ul class="dropdown-menu">
                                <li><span class="dropdown-item-text">ID | titre</span></li>
                                <?php foreach ($partners_activities[$i] as $partner_activity) : ?>
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
                                <?php foreach ($partners_boxs[$i] as $partner_box) : ?>
                                    <li><span class="dropdown-item-text"><?= $partner_box['box_id'] ?> | <?= $partner_box['box_title'] ?></span></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>