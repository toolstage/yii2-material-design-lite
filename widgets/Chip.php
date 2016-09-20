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
class Chip extends MdlWidget
{
    const TYPE_DEFAULT = 'mdl-chip';
    const TYPE_CONTACT = 'mdl-chip mdl-chip--contact';

    protected $defaultMdlOptions = [
        'type' => self::TYPE_DEFAULT,
        'text' => 'Chip',
        'deletable' => false,
        'tag' => 'span',
        'tealText' => null,
        'tealImgSrc' => null
    ];

    /**
     * @var array Widget types
     */
    public $types = [
        self::TYPE_DEFAULT,
        self::TYPE_CONTACT
    ];

    /**
     * @throws InvalidConfigException
     */
    public function init()
    {
        parent::init();

        $this->initMdlComponent();
    }

    /**
     * @return string
     */
    public function run()
    {
        $text = Html::tag('span', $this->mdlOptions['text'], ['class' => 'mdl-chip__text']);
        $teal = '';
        if ($this->mdlOptions['type'] == self::TYPE_CONTACT) {
            if (!is_null($this->mdlOptions['tealText'])) {
                $teal = Html::tag('span', strtoupper(substr($this->mdlOptions['tealText'], 0, 1)), ['class' => 'mdl-chip__contact mdl-color--teal mdl-color-text--white']);
            }
            if (!is_null($this->mdlOptions['tealImgSrc'])) {
                $teal = Html::img($this->mdlOptions['tealImgSrc'], ['class' => 'mdl-chip__contact']);
            }
        }
        $deleteButton = '';
        if ($this->mdlOptions['deletable']) {
            $deleteButton = Html::tag('a',
                Html::tag('i', 'cancel', ['class' => 'material-icons']),
                ['class' => 'mdl-chip__action chip-delete-button']);
            $this->view->registerJs(new JsExpression('$(".chip-delete-button").click(function() {$("#' . $this->options['id'] . '").fadeOut("slow");});'));
        }
        return Html::tag($this->mdlOptions['tag'], $teal . $text . $deleteButton, $this->options);
    }
}