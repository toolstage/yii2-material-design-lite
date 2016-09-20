<?php

namespace jonasw91\yii2mdl\widgets;

use jonasw91\yii2mdl\helpers\BaseMdlWidget;
use yii\base\InvalidConfigException;

/**
 * Parent class of MDL widget elements
 *
 * @link https://getmdl.io/components/index.html#badges-section
 *
 * Class MdlWidget
 * @package jonasw91\yii2mdl\widgets
 *
 * @author Jonas Wehner <jonaswehner@outlook.de>
 * @version 1.0
 */
class MdlWidget extends BaseMdlWidget
{
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