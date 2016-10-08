<?php

use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
$this->title = 'Clan FNR';

// $locationsArray = ArrayHelper::index(ArrayHelper::toArray($materialLocations), null, 'location_id');
// $materialsArray = ArrayHelper::index(ArrayHelper::toArray($materialLocations), null, 'material_id');
$locationsArray = ArrayHelper::map(ArrayHelper::toArray($materialLocations), 'material_id', 'material_id', 'location_id');
$materialsArray = ArrayHelper::map(ArrayHelper::toArray($materialLocations), 'location_id', 'location_id', 'material_id');
?>

<?=  \yii\bootstrap\Tabs::widget([
	'items' => [
		[
			'label' => 'Обычные',
			'content' => $this->render('_regular', [
				'materials' => $materials,
				'locations' => $locations,
				'materialsArray' => $materialsArray
			]),
			'active' => true
		],
		[
			'label' => 'Камни',
			'content' => $this->render('_stones', [
				'materials' => $materials,
				'locations' => $locations,
				'materialsArray' => $materialsArray
			]),
		],
		[
			'label' => 'Материалы захватчиков',
			'content' => $this->render('_inviders', [
				'materials' => $materials,
				'locations' => $locations,
				'materialsArray' => $materialsArray
			]),
		],
		[
			'label' => 'Локации',
			'content' => $this->render('_location', [
				'materials' => $materials,
				'locations' => $locations,
				'locationsArray' => $locationsArray
			]),
		],
		[
			'label' => 'Захватчики',
			'content' => $this->render('_invider', [
				'materials' => $materials,
				'locations' => $locations,
				'locationsArray' => $locationsArray
			]),
		],
   ],
])?>