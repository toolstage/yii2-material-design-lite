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
class MaterialAsset extends AssetBundle
{
    public $sourcePath = '@vendor/bower/material-design-lite/';

    public $css = [
        'material.css',
        'https://fonts.googleapis.com/icon?family=Material+Icons',
        'https://code.getmdl.io/1.2.1/material.indigo-pink.min.css'
    ];

    public $js = [
        'material.js',
        'https://code.getmdl.io/1.2.1/material.min.js'
    ];
}