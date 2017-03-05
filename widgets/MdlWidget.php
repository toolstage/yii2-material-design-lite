<?php

namespace jonasw91\mdl\widgets;

use jonasw91\mdl\helpers\BaseMdlWidget;
use yii\base\InvalidConfigException;

/**
 * Parent class of MDL widget elements
 *
 * @link https://getmdl.io/components/index.html#badges-section
 *
 * Class MdlWidget
 * @package jonasw91\mdl\widgets
 *
 * @author Jonas Wehner <jonaswehner@outlook.de>
 * @version 1.0
 */
class MdlWidget extends BaseMdlWidget
{
    public $model;

    public $attribute;

    /**
     * @throws InvalidConfigException
     */
    public function init()
    {
        parent::init();
    }

    /**
     * @see Widget
     * @return string
     */
    public function run()
    {
        $result = parent::run();
        return $result;
    }
}