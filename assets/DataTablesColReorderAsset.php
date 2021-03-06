<?php

namespace app\assets;

use yii\web\AssetBundle;

/**
 *
 * @author Vladymyr Protsenko <grayfolk@gmail.com>
 */
class DataTablesColReorderAsset extends AssetBundle {
	public $sourcePath = '@app/vendor/bower/datatables.net-colreorder';
	public $baseUrl = '@web';
	public $css = [ ];
	public $js = [ 
			'js/dataTables.colReorder.min.js' 
	];
	public $depends = [ 
			'\app\assets\DataTablesAsset' 
	];
}
