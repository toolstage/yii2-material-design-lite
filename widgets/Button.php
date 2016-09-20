<?php

namespace jonasw91\yii2mdl\widgets;

use jonasw91\yii2mdl\helpers\Html;
use yii\helpers\Url;
use yii\web\JsExpression;

/**
 *  Options:
 *  - type      string element type
 *  - action    string|array url
 *  - method    string GET or POST
 *  - recall    string JSExpression result
 *  Example:
 *  ```php
 *  'recall' => new JSExpression ('function (response) {
 *      // Do something
 *  }');
 *  ```
 *  - label     string button value
 *  - icon      string you can see possible icon at @link https://design.google.com/icons/
 *  - effects   array item effects set key to true active effect
 *      key: accent, colored, primary, rippleEffect
 *
 * Class Button
 * @package jonasw91\yii2mdl\widgets
 */
class Button extends MdlWidget
{
    const TYPE_DEFAULT = 'mdl-button mdl-js-button';
    const TYPE_FAB = 'mdl-button mdl-js-button mdl-button--fab';
    const TYPE_MINI_FAB = 'mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab';
    const TYPE_RAISED = 'mdl-button mdl-js-button mdl-button--raised';
    const TYPE_ICON = 'mdl-button mdl-js-button mdl-button--icon';

    /**
     *
     * @var array Default values for attribute @attribute $mdlOptions
     *
     *  - type string element type
     *  - action string|array url
     *  - method string GET or POST
     *  - recall string JSExpression result
     *  Example:
     *  ```php
     *  'recall' => new JSExpression ('function (response) {
     *      // Do something
     *  }');
     *  ```
     *  - label string button value
     *  - icon string you can see possible icon at @link https://design.google.com/icons/
     *  - effects array item effects set key to true active effect
     *      key: accent, colored, primary, rippleEffect
     */
    public $defaultMdlOptions = [
        'type' => self::TYPE_DEFAULT,
        'action' => null,
        'method' => 'GET',
        'recall' => '',
        'label' => 'Button',
        'icon' => null,
        'effects' => [
            'accent' => false,
            'colored' => false,
            'primary' => false,
            'rippleEffect' => false,
        ]
    ];

    /**
     * @var array Widget types
     */
    protected $types = [
        self::TYPE_DEFAULT,
        self::TYPE_FAB,
        self::TYPE_MINI_FAB,
        self::TYPE_RAISED,
        self::TYPE_ICON,
    ];

    /**
     * @var array Widget effects
     */
    protected $effects = [
        'accent' => 'mdl-button--primary',
        'colored' => 'mdl-button--colored',
        'primary' => 'mdl-button--primary',
        'rippleEffect' => 'mdl-js-ripple-effect',
    ];

    protected $label;

    public function init()
    {
        parent::init();

        $this->initMdlComponent();

        $mdlOptions = $this->mdlOptions;

        // set action
        if (!is_null($mdlOptions['action'])) {
            if (strtoupper($mdlOptions['method']) === 'GET' || strtoupper($mdlOptions['method']) === 'POST') {
                $this->view->registerJs(new JsExpression('$("#' . $this->options['id'] . '").click(function (){
                    $.ajax({
                          method: "' . strtoupper($mdlOptions['method']) . '",
                          url: "' . Url::toRoute($mdlOptions['action']) . '"
                    }).success(' . $mdlOptions['recall'] . ');
                });'));
            }
        }

        $icon = '';
        if (!is_null($mdlOptions['icon']) && is_string($mdlOptions['icon'])) {
            $icon = Html::tag('i', $mdlOptions['icon'], ['class' => 'material-icons']) . ' ';
        }

        // set effects
        foreach ($this->effects as $effect => $value) {
            if (isset($mdlOptions['effects'][$effect]) && $mdlOptions['effects'][$effect]) {
                $this->options ['class'] .= ' ' . $value;
            }
        }
    }

    /**
     * @return string
     */
    public function run()
    {
        $icon = Html::tag('i', $this->mdlOptions['icon'], [
            'class' => 'material-icons'
        ]);
        $label = Html::tag('span', $this->mdlOptions['label']);
        return Html::button($icon . $label, $this->options);
    }
}