<?php

namespace jonasw91\mdl\helpers;

use yii\base\InvalidConfigException;
use yii\base\Widget;

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
interface MdlComponent
{
    const INVALID_TYPE_EXCEPTION = 'Unknown Type Exception';

    /**
     * Default configuration of MDL widget components
     *
     * @throws InvalidConfigException
     */
    public function initMdlComponent();


    /**
     * Check config and set default values if option is not set
     */
    public function validateConfiguration();
}