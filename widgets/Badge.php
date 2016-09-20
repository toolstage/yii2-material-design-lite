<?php

namespace jonasw91\mdl\widgets;

use jonasw91\mdl\helpers\Html;
use yii\base\InvalidConfigException;

/**
 * Description:
 *
 * Types:
 *
 * - TYPE_DEFAULT:         Defines badge as an MDL component (required)
 * - TYPE_NO_BACKGROUND:   Applies open-circle effect to badge (optional)
 * - TYPE_NO_BACKGROUND:   Make the badge overlap with its container (optional)
 *
 * Options:
 *
 * - type:        (string)        set this option to one of the types which are defined above
 * - badgeContent:(string)        set content of this badge
 * - badgeValue:  (string)        set remark value of this badge
 * - tag:         (string)        set the tag element of this badge (recommended is 'span' or 'a')
 *
 * Usage:
 *
 * ```php
 * <?= Badge::widget([
 *      'options => [
 *          ...
 *      ],
 *      'mdlOptions' => [
 *           'type' => Badge::TYPE_NO_BACKGROUND,
 *           'badgeContent' => 'example',
 *           'badgeValue' => '1',
 *           'tag' => 'span'
 *       ]
 * ]); ?>
 * ```
 *
 * @link https://getmdl.io/components/index.html#badges-section
 *
 * Class Badges
 * @package jonasw91\mdl\widgets
 *
 * @author Jonas Wehner <jonaswehner@outlook.de>
 * @version 1.0
 */
class Badge extends MdlWidget
{
    /*
     * Defines badge as an MDL component (required)
     */
    const TYPE_DEFAULT = 'mdl-badge';
    /**
     * Applies open-circle effect to badge (optional)
     */
    const TYPE_NO_BACKGROUND = 'mdl-badge mdl-badge--no-background';

    /**
     * Make the badge overlap with its container (optional)
     */
    const TYPE_OVERLAP = 'mdl-badge mdl-badge--overlap';

    /**
     * @var array
     *
     *  - type:        (string)        set this option to one of the types which are defined above
     *  - badgeContent:(string)        set content of this badge
     *  - badgeValue:  (string)        set remark value of this badge
     *  - tag:         (string)        set the tag element of this badge (recommended is 'span' or 'a')
     */
    protected $defaultMdlOptions = [
        'type' => self::TYPE_DEFAULT,
        'badgeContent' => 'Badge',
        'badgeValue' => '1',
        'tag' => 'span'
    ];

    /**
     * @var array Widget types
     */
    public $types = [
        self::TYPE_DEFAULT,
        self::TYPE_NO_BACKGROUND,
        self::TYPE_OVERLAP
    ];

    /**
     * @throws InvalidConfigException
     */
    public function init()
    {
        parent::init();

        $this->initMdlComponent();

        // Set type
        if (isset($this->options['class'])) {
            $this->options['class'] .= ' ' . $this->mdlOptions ['type'];
        } else {
            $this->options['class'] = $this->mdlOptions ['type'];
        }

        // Set remark value
        if (isset($this->options['data'])) {
            $this->options ['data'] = array_merge($this->options ['data'], ['badge' => $this->mdlOptions['badgeValue']]);
        } else {
            $this->options ['data'] = ['badge' => $this->mdlOptions['badgeValue']];
        }
    }

    /**
     * @return string
     */
    public function run()
    {
        return Html::tag($this->mdlOptions['tag'], $this->mdlOptions['badgeContent'], $this->options);
    }
}