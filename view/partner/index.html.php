<table class="table">
  <thead>
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Titre</th>
      <th scope="col">Description</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($activities as $activity) :?>
    <tr>
      <td><?= $activity['activity_id']?></td>
      <td><?= $activity['activity_title']?></td>
      <td><?= $activity['activity_content']?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>