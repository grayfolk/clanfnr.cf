<?php

namespace app\assets;

use yii\web\AssetBundle;

/**
 *
 * @author Vladymyr Protsenko <grayfolk@gmail.com>
 */
class DataTablesAsset extends AssetBundle {
	public $sourcePath = '@app/vendor/bower/datatables';
	public $baseUrl = '@web';
	public $css = [ 
			'media/css/dataTables.bootstrap.min.css' 
	];
	public $js = [ 
			'media/js/jquery.dataTables.min.js',
			'media/js/dataTables.bootstrap.min.js' 
	];
	public $depends = [ 
			'yii\web\JqueryAsset',
			'yii\bootstrap\BootstrapPluginAsset' 
	];
}
