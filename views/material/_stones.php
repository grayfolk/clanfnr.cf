<?php
use yii\helpers\ArrayHelper;
$expiriencesArray = ArrayHelper::map($expiriences, 'id', 'title');
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
	foreach($expiriences as $expirience){
    	$html = $title = '';
		$data = [];
		foreach($material->materialExpiriences as $row){
			if($row->expirience_id == $expirience->id) $data[$row->level_id] = $row->quantity;
		}
		if(count($data)){
			ksort($data);
			$title = '<span class="label label-primary">' . $expirience->title . '</span>';
			$html .= '<table class="table table-hover table-condensed"><tr>';
			foreach($data as $level=>$quantity){
				switch($level){
					case 1:
						$class = 'active';
						break;
					case 3:
						$class = 'success';
						break;
					case 4:
						$class = 'info';
						break;
					case 5:
						$class = 'danger';
						break;
					case 6:
						$class = 'warning';
						break;
					default:
						$class = '';
						break;
				}
				$html .= '<td class="'.$class.'">'.$quantity.'%</td>';
			}
			$html .= '</tr></table>';
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
