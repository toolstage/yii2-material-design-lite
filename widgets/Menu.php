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
 * Class Menu
 * @package jonasw91\yii2mdl\widgets
 *
 * @author Jonas Wehner <jonaswehner@outlook.de>
 * @version 1.0
 */
class Menu extends MdlWidget
{
    const TYPE_LOWER_LEFT = 'mdl-menu mdl-menu--bottom-left mdl-js-menu';
    const TYPE_LOWER_RIGHT = 'mdl-menu mdl-menu--bottom-right mdl-js-menu';
    const TYPE_TOP_LEFT = 'mdl-menu mdl-menu--top-left mdl-js-menu';
    const TYPE_TOP_RIGHT = 'mdl-menu mdl-menu--top-right mdl-js-menu';

    public $items = [];

    protected $defaultMdlOptions = [
        'type' => self::TYPE_LOWER_LEFT,
        'menuButtonOptions' => [
            'class' => 'mdl-button--icon'
        ],
        'menuButtonMdlOptions' => [
            'icon' => 'more_vert',
            'label' => ''
        ],
        'effects' => [
            'rippleEffect' => true
        ]
    ];

    /**
     * @var array Widget types
     */
    public $types = [
        self::TYPE_LOWER_LEFT,
        self::TYPE_LOWER_RIGHT,
        self::TYPE_TOP_LEFT,
        self::TYPE_TOP_RIGHT
    ];

    /**
     * @throws InvalidConfigException
     */
    public function init()
    {
        parent::init();

        $this->initMdlComponent();

        $this->registerMenuStyle();
    }

    /**
     * @return string
     */
    public function run()
    {
        $button = Button::widget([
            'options' => array_merge(['id' => $this->options['id']], $this->mdlOptions['menuButtonOptions']),
            'mdlOptions' => $this->mdlOptions['menuButtonMdlOptions'],
        ]);
        $effects = ' ';
        if ($this->mdlOptions['effects']['rippleEffect']) {
            $effects .= 'mdl-js-ripple-effect';
        }
        //var_dump($this->items);

        $elements = $button . \yii\widgets\Menu::widget([
                'items' => $this->items,
                'linkTemplate' => '<a class="mdl-menu__item" href="{url}">{label}</a>',
                'options' => [
                    'class' => $this->mdlOptions['type'] . $effects,
                    'for' => $this->options['id']
                ],
                'itemOptions' => [
                    'class' => '',
                ]
            ]);

        return Html::tag('div', $elements, [
            'class' => 'menu-wrapper'
        ]);
    }

    protected function registerMenuStyle()
    {
        $css = '
            .menu-wrapper {
            }
        ';
        $this->view->registerCss($css);
    }
}