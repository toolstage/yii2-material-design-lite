<?php

namespace jonasw91\mdl\helpers;

use jonasw91\mdl\assets\MaterialAsset;
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
abstract class BaseMdlWidget extends Widget implements MdlComponent
{
    /**
     * @var array Element options
     */
    public $options = [];

    /**
     * @var array CustomOptions for MDL widget elements
     */
    public $mdlOptions = [];

    /**
     * @var array Set widget default configuration
     */
    protected $defaultMdlOptions = [];

    /**
     * @var array
     */
    protected $types = [];

    /**
     * @var string
     */
    public static $autoIdPrefix = 'mldWidget';

    /**
     * Default configuration of MDL widget components
     *
     * @throws InvalidConfigException
     */
    public function initMdlComponent()
    {
        // Check config and set default values if option is not set
        $this->validateConfiguration();

        // Check type
        if (!in_array($this->mdlOptions['type'], $this->types)) {
            throw new InvalidConfigException(self::INVALID_TYPE_EXCEPTION);
        }

        // Set type
        if (isset($this->options['class'])) {
            $this->options['class'] .= ' ' . $this->mdlOptions ['type'];
        } else {
            $this->options['class'] = $this->mdlOptions ['type'];
        }

        // Set ID
        if (!isset($this->options['id'])) {
            $this->options['id'] = $this->getId();
        }
    }

    /**
     * Check config and set default values if option is not set
     */
    public function validateConfiguration()
    {
        foreach ($this->defaultMdlOptions as $option => $value) {
            if (!isset($this->mdlOptions[$option])) {
                $this->mdlOptions[$option] = $value;
            }
        }
    }
}