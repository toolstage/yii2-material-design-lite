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
class Spinner extends MdlWidget
{
    const TYPE_DEFAULT = 'mdl-spinner mdl-js-spinner';
    const TYPE_SINGLE_COLOR = 'mdl-spinner mdl-spinner--single-color mdl-js-spinner';


    protected $defaultMdlOptions = [
        'type' => self::TYPE_DEFAULT,
        'active' => false
    ];

    /**
     * @var array Widget types
     */
    public $types = [
        self::TYPE_DEFAULT,
        self::TYPE_SINGLE_COLOR
    ];

    /**
     * @throws InvalidConfigException
     */
    public function init()
    {
        parent::init();

        $this->initMdlComponent();

        if ($this->mdlOptions['active']) {
            $this->options['class'] .= ' is-active';
        }
    }

    /**
     * @return string
     */
    public function run()
    {
        return Html::tag('div', '', $this->options);
    }
}