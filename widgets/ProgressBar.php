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
 * Class Chip
 * @package jonasw91\mdl\widgets
 *
 * @author Jonas Wehner <jonaswehner@outlook.de>
 * @version 1.0
 */
class ProgressBar extends MdlWidget
{
    const TYPE_DEFAULT = 'mdl-progress mdl-js-progress';
    /**
     * @deprecated It will be removed in 2.0.
     */
    const TYPE_INDETERMINATE = 'mdl-progress mdl-js-progress mdl-progress__indeterminate';
    const TYPE_BUFFERING = 'mdl-progress mdl-js-progress ';

    protected $defaultMdlOptions = [
        'type' => self::TYPE_DEFAULT,
        'value' => 0,
        'buffering' => 70,
    ];

    /**
     * @var array Widget types
     */
    public $types = [
        self::TYPE_DEFAULT,
        self::TYPE_INDETERMINATE,
        self::TYPE_BUFFERING
    ];

    /**
     * @throws InvalidConfigException
     */
    public function init()
    {
        parent::init();

        $this->initMdlComponent();
        if (!($this->mdlOptions['type'] == self::TYPE_INDETERMINATE)) {
            $this->view->registerCss('
            .progressbar {
                 -webkit-transition: width 2s; /* Safari */
                transition: width 2s;
            }');
            $progress = "this.MaterialProgress.setProgress(" . $this->mdlOptions['value'] . ");";
            $buffering = '';
            if ($this->mdlOptions['type'] == self::TYPE_BUFFERING) {
                $buffering = "this.MaterialProgress.setBuffer(87);";
            }
            $this->view->registerJs(
                new JsExpression("
                 document.querySelector('#" . $this->options['id'] . "').addEventListener('mdl-componentupgraded', function() {
                    " . $progress . "
                    " . $buffering . "
                  });
                "));

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