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
      <td><div class="row">
          <?php $m = []; foreach($materials as $material):?>
          <?php if(array_key_exists($location->id, $locationsArray) && in_array($material->id, $locationsArray[$location->id])) $m[$material->type_id][] = $material->title;?>
          <?php endforeach;?>
          <?php foreach($m as $type=>$list):?>
          <?php if(count($list)):?>
          <div class="col-md-2">
            <?php
        switch($type){
			case 3:
				echo ' <span class="label label-primary">Материалы:</span> ';
				break;
			case 2:
				echo ' <span class="label label-primary">Камни:</span> ';
				break;
			case 1:
				echo ' <span class="label label-primary">Обычные материалы:</span> ';
				break;
			default: break;
		}
		?>
          </div>
          <div class="col-md-10">
            <?= implode(', ',$list) . '<div class="clearfix"></div>'?>
          </div>
          <?php endif;?>
          <?php endforeach;?>
        </div></td>
    </tr>
    <?php endif;?>
    <?php endforeach;?>
  </tbody>
</table>
