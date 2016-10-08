<br />
<table class="table table-striped table-hover table-condensed">
  <thead>
    <tr>
      <th> Захватчик </th>
      <th> Материалы </th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($locations as $location):?>
    <?php if($location->type_id == 2):?>
    <tr>
      <td><?= $location->title?></td>
      <td><?php $m = []; foreach($materials as $material):?>
        <?php if(array_key_exists($location->id, $locationsArray) && in_array($material->id, $locationsArray[$location->id])) $m[] = $material->title;?>
        <?php endforeach;?>
        <?= implode(', ',$m)?>
        </td>
    </tr>
    <?php endif;?>
    <?php endforeach;?>
  </tbody>
</table>
