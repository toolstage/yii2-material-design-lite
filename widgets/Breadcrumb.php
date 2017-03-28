<?php
/**
 * Created by PhpStorm.
 * User: Jonas Wehner
 * Date: 10.03.2017
 * Time: 13:59
 */

namespace jonasw91\mdl\widgets;


use jonasw91\mdl\helpers\Html;
use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;
use yii\widgets\Breadcrumbs;

class Breadcrumb extends Breadcrumbs
{
    public $options = [
        'class' => 'mdl-breadcrumbs'
    ];

    public $linkOptions = [
        'class' => 'mdl-button mdl-js-button mdl-button--primary',
    ];

    public $activeLinkOptions = [
        'class' => 'mdl-button mdl-js-button',
    ];

    public $itemTemplate = '<li>{link}</li>';

    public $activeItemTemplate = '<li class="active">{link}</li>';

    protected function renderItem($link, $template)
    {
        $encodeLabel = ArrayHelper::remove($link, 'encode', $this->encodeLabels);
        if (array_key_exists('label', $link)) {
            $label = $encodeLabel ? Html::encode($link['label']) : $link['label'];
        } else {
            throw new InvalidConfigException('The "label" element is required for each link.');
        }
        if (isset($link['template'])) {
            $template = $link['template'];
        }
        $action = null;
        $options = $link;
        $active = false;
        if (isset($link['url'])) {
            $action = $link ['url'];
            $buttonOptions = array_merge($options, $this->linkOptions);
        } else {
            $activeLinkOptions = array_merge($this->options, $this->activeLinkOptions);
            $buttonOptions = array_merge($options, $activeLinkOptions);
            $active = true;
        }
        unset($options['template'], $options['label'], $options['url']);
        $link = Button::widget([
            'mdlOptions' => [
                'label' => $label,
                'action' => $action,
                'effects' => [
                    'accent' => $active
                ]
            ],
            'options' => $buttonOptions
        ]);
        return strtr($template, ['{link}' => $link]);
    }

}