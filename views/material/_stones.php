<br />
<table class="table table-striped table-hover table-condensed">
  <thead>
    <tr>
      <th> Камень </th>
      <th> Локации </th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($materials as $material):?>
    <?php if($material->type_id == 2):?>
    <tr>
      <td><?= $material->title?></td>
      <td><?php $l = []; foreach($locations as $location):?>
        <?php if(array_key_exists($material->id, $materialsArray) && in_array($location->id, $materialsArray[$material->id])) $l[] = $location->title;?>
        <?php endforeach;?>
        <?= implode(', ',$l)?>
        </td>
    </tr>
    <?php endif;?>
    <?php endforeach;?>
  </tbody>
</table>
