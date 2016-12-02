<?php
use yii\helpers\ArrayHelper;
$experiencesArray = ArrayHelper::map($experiences, 'id', 'title');
?>
<br />
<table class="table table-striped table-hover table-condensed">
  <thead>
    <tr>
      <th> Камень </th>
      <th> Локации </th>
      <th> Навык </th>
      <th> </th>
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
        <?= implode(', ',$l)?></td>
	<?php
	foreach($experiences as $experience){
    	$title = '';
		$data = [];
		foreach($material->materialExperiences as $row){
			if($row->experience_id == $experience->id) $data[$row->level_id] = $row->quantity;
		}
		if(count($data)){
			$html = \app\helpers\CommonHelper::createExperienceTable($data);
			break;
		}
	}
	?>
      <td><?= $title?></td>
      <td><?= $html?></td>
    </tr>
    <?php endif;?>
    <?php endforeach;?>
  </tbody>
</table>
