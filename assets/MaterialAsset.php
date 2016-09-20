<?php

namespace jonasw91\yii2mdl\assets;

use yii\web\AssetBundle;

/**
 * Created by PhpStorm.
 * User: Jonas Wehner
 * Date: 20.09.2016
 * Time: 16:27
 */
class MaterialAsset extends AssetBundle
{
    public $basePath = '@vendor/yii2-material-design-lite/assets';

    public $css = [
        'css/mdl.css',
    ];

    public $js = [
        'js/mdl.js',
    ];

    public $depends = [
        'jonasw91\yii2mdl\assets\PolyAsset',
    ];
}