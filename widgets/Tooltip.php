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
 * Class Spinner
 * @package jonasw91\yii2mdl\widgets
 *
 * TODO create JS solution
 *
 * @author Jonas Wehner <jonaswehner@outlook.de>
 * @version 1.0
 */
class Tooltip extends MdlWidget
{
    const TYPE_DEFAULT = 'mdl-tooltip';

    const POSITION_TOP = 'mdl-tooltip--top';
    const POSITION_RIGHT = 'mdl-tooltip--right';
    const POSITION_BOTTOM = 'mdl-tooltip--bottom';
    const POSITION_LEFT = 'mdl-tooltip--left';

    protected $defaultMdlOptions = [
        'referenceID' => null,
        'text' => 'Tooltip',
        'type' => self::TYPE_DEFAULT,
        'position' => self::POSITION_TOP
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

        $this->options['for'] = $this->mdlOptions['referenceID'];
        $this->options['class'] .= ' ' . $this->mdlOptions['position'];
        $this->options['tabindex'] = -1;
    }

    /**
     * @return string
     */
    public function run()
    {
        return Html::tag('div', $this->mdlOptions['text'], $this->options);
    }
}