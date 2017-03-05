<?php
/**
 * Created by PhpStorm.
 * User: Jonas Wehner
 * Date: 02.03.2017
 * Time: 21:48
 */

namespace jonasw91\mdl\assets;


use yii\web\AssetBundle;

class BrandAsset extends AssetBundle
{
    public $sourcePath = '@vendor/jonasw91/yii2-material-design-lite/assets/';

    public $css = [
      'css/layouts/gray_orange.css'
    ];
}