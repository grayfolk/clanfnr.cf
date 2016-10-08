<br />
<table class="table table-striped table-hover table-condensed">
  <thead>
    <tr>
      <th> Материал </th>
      <th> Локации </th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($materials as $material):?>
    <?php if($material->type_id == 1):?>
    <tr>
      <td><?= $material->title?></td>
      <td><div class="row">
          <?php $l = []; foreach($locations as $location):?>
          <?php if(array_key_exists($material->id, $materialsArray) && in_array($location->id, $materialsArray[$material->id])) $l[$location->type_id][] = $location->title;?>
          <?php endforeach;?>
          <?php foreach($l as $type=>$list):?>
          <?php if(count($list)):?>
          <div class="col-md-2">
            <?php
        switch($type){
			case 2:
				echo ' <span class="label label-primary">Захватчики:</span> ';
				break;
			case 1:
				echo ' <span class="label label-primary">Локации:</span> ';
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
