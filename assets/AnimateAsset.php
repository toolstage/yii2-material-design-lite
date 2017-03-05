<?php

namespace jonasw91\mdl\assets;

use yii\web\AssetBundle;

/**
 * Created by PhpStorm.
 * User: Jonas Wehner
 * Date: 20.09.2016
 * Time: 16:27
 */
class AnimateAsset extends AssetBundle
{
    public $sourcePath = '@vendor/bower/animate.css';

    public $css = [
        'animate.min.css',
    ];
}