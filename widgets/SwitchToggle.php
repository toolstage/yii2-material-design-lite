<?php

namespace jonasw91\mdl\widgets;

use yii\base\InvalidConfigException;
use yii\web\JsExpression;
use jonasw91\mdl\helpers\Html;

/**
 * Description:
 *
 * @link https://getmdl.io/components/index.html#badges-section
 *
 * Class Spinner
 * @package jonasw91\mdl\widgets
 *
 * @author Jonas Wehner <jonaswehner@outlook.de>
 * @version 1.0
 */
class SwitchToggle extends MdlWidget
{
    const TYPE_DEFAULT = 'mdl-switch mdl-js-switch';

    protected $defaultMdlOptions = [
        'type' => self::TYPE_DEFAULT,
        'label' => 'asd',
        'checked' => false,
        'effects' => [
            'rippleEffect' => true
        ]
    ];

    /**
     * @var array Widget types
     */
    public $types = [
        self::TYPE_DEFAULT,
    ];

    /**
     * @throws InvalidConfigException
     */
    public function init()
    {
        parent::init();

        $this->initMdlComponent();

        $this->options['class'] = 'mdl-switch__input';
    }

    /**
     * @return string
     */
    public function run()
    {
        $checkbox = Html::input('checkbox', '', null, $this->options);
        $effect = '';
        if ($this->mdlOptions['effects']['rippleEffect']) {
            $effect = 'mdl-js-ripple-effect';
        }
        $label = Html::tag('span', $this->mdlOptions['label'],
            ['class' => 'mdl-switch__label']);
        return Html::label($checkbox . $label, $this->options['id'], ['class' => $this->mdlOptions['type'] . ' ' . $effect]);
    }
}