<?php

namespace jonasw91\yii2mdl\widgets;

use yii\base\InvalidConfigException;
use yii\web\JsExpression;
use jonasw91\yii2mdl\helpers\Html;

/**
 * Description:
 *
 * @link https://getmdl.io/components/index.html#badges-section
 *
 * Class Slider
 * @package jonasw91\yii2mdl\widgets
 *
 * @author Jonas Wehner <jonaswehner@outlook.de>
 * @version 1.0
 */
class Slider extends MdlWidget
{
    const TYPE_DEFAULT = 'mdl-slider mdl-js-slider';


    protected $defaultMdlOptions = [
        'type' => self::TYPE_DEFAULT,
        'value' => 0,
        'width' => '200px'
    ];

    /**
     * @var array Widget types
     */
    public $types = [
        self::TYPE_DEFAULT
    ];

    /**
     * @throws InvalidConfigException
     */
    public function init()
    {
        parent::init();

        $this->initMdlComponent();

        $this->options['min'] = 0;
        $this->options['max'] = 100;
        $this->options['tabindex'] = false;
    }

    /**
     * @return string
     */
    public function run()
    {
        return Html::tag('p',
            Html::input('range', null, $this->mdlOptions['value'], $this->options),
            ['style' => 'width:' . $this->mdlOptions['width'] . ';']);
    }
}