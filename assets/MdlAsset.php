<?php

namespace jonasw91\mdl\assets;

use jonasw91\assets\PolyAsset;
use yii\web\AssetBundle;

/**
 * Created by PhpStorm.
 * User: Jonas Wehner
 * Date: 20.09.2016
 * Time: 16:27
 */
class MdlAsset extends AssetBundle
{
    public $sourcePath = '@vendor/jonasw91/yii2-material-design-lite/assets';

    public $css = [
        'css/mdl.css',
        'css/layouts/custom_bootstrap.css',
    ];

    public $js = [
        'js/mdl.js',
    ];

    public $depends = [
        'jonasw91\mdl\assets\MaterialAsset',
        'jonasw91\mdl\assets\PolyAsset',
        'jonasw91\mdl\assets\AnimateAsset',
        'jonasw91\mdl\assets\BrandAsset',
        'yii\web\JqueryAsset'
    ];
}