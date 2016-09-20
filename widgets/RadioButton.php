<?php

namespace jonasw91\mdl\widgets;

use yii\base\InvalidConfigException;
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
class RadioButton extends MdlWidget
{
    const TYPE_DEFAULT = 'mdl-radio mdl-js-radio';

    public static $autoIdPrefix = 'option-';

    protected $defaultMdlOptions = [
        'type' => self::TYPE_DEFAULT,
        'label' => 'RadioButton',
        'name' => 'radioList',
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

        $this->options['class'] = 'mdl-radio__button';
    }

    /**
     * @return string
     */
    public function run()
    {
        $checkbox = Html::input('radio', $this->mdlOptions['name'], null, $this->options);
        $effect = '';
        if ($this->mdlOptions['effects']['rippleEffect']) {
            $effect = 'mdl-js-ripple-effect';
        }
        $label = Html::tag('span', $this->mdlOptions['label'],
            ['class' => 'mdl-radio__label']);
        return Html::label($checkbox . $label, $this->options['id'], ['class' => $this->mdlOptions['type'] . ' ' . $effect]);
    }
}