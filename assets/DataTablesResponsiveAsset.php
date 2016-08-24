<?php

namespace app\assets;

use yii\web\AssetBundle;

/**
 *
 * @author Vladymyr Protsenko <grayfolk@gmail.com>
 */
class DataTablesResponsiveAsset extends AssetBundle {
	public $sourcePath = '@app/vendor/bower/datatables-responsive';
	public $baseUrl = '@web';
	public $css = [ 
			'css/responsive.dataTables.css' 
	];
	public $js = [ 
			'js/dataTables.responsive.js' 
	];
	public $depends = [ 
			'\app\assets\DataTablesAsset' 
	];
}
