<?php
/**
 * Created by PhpStorm.
 * User: jwehner
 * Date: 17.03.2017
 * Time: 14:23
 */

namespace jonasw91\mdl\assets;


use yii\web\AssetBundle;

class BootstrapAsset extends AssetBundle
{
    public $sourcePath = '@vendor/jonasw91/yii2-material-design-lite/assets';

    public $css = [
        'css/layouts/custom_bootstrap.css',
    ];
}