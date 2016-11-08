<?php
/**
 * Created by PhpStorm.
 * User: Jonas Wehner
 * Date: 02.08.2016
 * Time: 10:56
 */

namespace jonasw91\mdl\widgets;

use jonasw91\mdl\helpers\Html;
use yii\helpers\Url;
use yii\web\JsExpression;

class Layout extends MdlWidget
{
    public $fixedHeader = false;

    public $fixedDrawer = false;

    public $waterfallHeader = false;

    public $scrollableHeader = false;

    public $hasHeader = true;

    public $hasDrawer = true;

    public $useTabs = false;

    public $fixedTabs = false;

    /**
     * ...
     * 'items' => [
     *      [
     *          'label' => 'Example',
     *          'url' => ['index'],
     *          'options' => [
     *              'class' => 'test'
     *           ],
     *      ]
     * }
     * ...
     *
     * @var $items array
     */
    public $items = [];

    /**
     * ...
     * 'tabs' => [
     *      [
     *          'label' => 'Example',
     *          'tabContent' => 'test'
     *          'options' => [
     *              'class' => 'test'
     *          ],
     *      ]
     * }
     * ...
     *
     * @var $items array
     */
    public $tabs = [];

    /**
     * If "ajaxTabs" is true use
     * ...
     * 'tabs' => [
     *      [
     *          'label' => 'Example',
     *          'tabContent' => [
     *              'url' => ['index'],
     *              'parmas' => [...]
     *          ]
     *          'options' => [
     *              'class' => 'test'
     *          ],
     *      ]
     * }
     * ...
     *
     * @var $items array
     */
    public $ajaxTabs;

    public $title;

    public $headerIcon;

    public $background;

    public $transparentHeader;

    public $content = '';

    public $encodeLabels = true;

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        parent::run();
        $title = '';
        if (!is_null($this->title)) {
            $title = Html::tag('span', $this->title, [
                'class' => 'mdl-layout-title'
            ]);
        }

        $spacer = Html::tag('div', '', [
            'class' => 'mdl-layout-spacer'
        ]);

        $items = '';
        foreach ($this->items as $item) {
            $label = '';
            $url = '';
            $options = [];
            $linkWrapper = '';
            if (isset($item['label'])) {
                $label = $item['label'];
            }
            if (isset($item['url'])) {
                $url = $item['url'];
            }
            if (isset($item['options'])) {
                $options = $item['options'];
            }
            $childItems = '';
            if (isset($item['items'])) {
                $childItems = $this->renderDropDown($item, [
                    'class' => 'mdl-navigation parent-dropdown',
                    'style' => 'height:0px;visibility:hidden;'
                ]);
                $linkWrapper .= Html::beginTag('div', [
                    'class' => 'link-wrapper'
                ]);
            }
            $items .= Html::tag('li', $linkWrapper . Html::a(($this->encodeLabels ? utf8_encode($label) : $label), $url, []) . $childItems, array_merge($options, [
                'class' => 'mdl-navigation__link'
            ]));
        }
        $menu = Html::tag('ul', $items, [
            'class' => 'mdl-navigation'
        ]);

        $topHeader = '';
        if (!$this->waterfallHeader) {
            $topHeader = Html::tag('span', $this->title, [
                'class' => 'mdl-layout-title'
            ]);
        }

        $headerRow = Html::tag('div', $topHeader . $spacer . $menu, [
            'class' => 'mdl-layout__header-row'
        ]);

        $headerIcon = Html::tag('div', '<i class="material-icons">' . $this->headerIcon . '</i>', [
            'class' => 'mdl-layout-icon'
        ]);

        $tabBar = '';
        if ($this->useTabs) {
            $tabs = '';
            $index = 1;
            foreach ($this->tabs as $tab) {
                $label = '';
                if (isset($tab['label'])) {
                    $label = $tab['label'];
                }
                $active = '';
                if ($index == 1) {
                    $active = 'is-active';
                }
                $tabs .= Html::a($label, ($this->fixedTabs ? '#fixed-tab-' : '#scroll-tab-') . $index, [
                    'class' => 'mdl-layout__tab ' . $active
                ]);
                $index++;
            }

            $tabBar = Html::tag('div', $tabs, [
                'class' => 'mdl-layout__tab-bar mdl-js-ripple-effect'
            ]);
        }

        $options = '';
        $visibleHeader = '';
        if ($this->scrollableHeader) {
            $options .= '  mdl-layout__header--scroll';
        }

        if ($this->transparentHeader) {
            $options .= ' mdl-layout__header--transparent';
        }
        if ($this->waterfallHeader) {
            $options .= ' mdl-layout__header--waterfall';
            $title = Html::tag('span', $this->title, [
                'class' => 'mdl-layout-title'
            ]);
            $visibleHeader = Html::tag('div', $title . $spacer . '', [
                'class' => 'mdl-layout__header-row'
            ]);
        }

        $header = '';
        if ($this->hasHeader) {
            $header = Html::tag('header', $headerIcon . $visibleHeader . $headerRow . $tabBar, [
                'class' => 'mdl-layout__header ' . $options
            ]);
        }

        $drawer = '';
        if ($this->hasDrawer) {
            $drawer = Html::tag('div', $title . $menu, [
                'class' => 'mdl-layout__drawer'
            ]);
        }

        if ($this->useTabs) {
            $index = 1;
            $tabPages = '';
            foreach ($this->tabs as $tab) {
                $active = '';
                $tabContent = '';
                if ($index == 1) {
                    $active = 'is-active';
                }
                if (isset($tab['tabContent'])) {
                    $tabContent = $tab['tabContent'];
                }
                $pageContent = Html::tag('div', $tabContent, [
                    'class' => 'page-content'
                ]);

                if ($this->ajaxTabs) {
                    $this->view->registerJs(new JsExpression('
                        $("[href=\'#' . ($this->fixedTabs ? 'fixed-tab-' : 'scroll-tab-') . $index . '\']").click(function(event) {
                            $("#' . ($this->fixedTabs ? 'fixed-tab-' : 'scroll-tab-') . $index . '").load("' . Url::to($tab['url']) . '");
                        });
                    '));
                }
                $section = Html::tag('section', $pageContent, [
                    'class' => 'mdl-layout__tab-panel ' . $active,
                    'id' => ($this->fixedTabs ? 'fixed-tab-' : 'scroll-tab-') . $index
                ]);
                $index++;
                $tabPages .= $section;
            }
            $this->content .= $tabPages;
        }

        $footer = '';
        $main = Html::tag('main', $this->content . $footer, [
            'class' => 'mdl-layout__content'
        ]);

        $options = '';
        if ($this->fixedHeader && !$this->scrollableHeader || $this->useTabs) {
            $options .= ' mdl-layout--fixed-header';
            if ($this->fixedTabs) {
                $options .= ' mdl-layout--fixed-tabs';
            }
        }

        if ($this->fixedDrawer && !$this->scrollableHeader) {
            $options .= ' mdl-layout--fixed-drawer';
        }

        $layout = Html::tag('div', $header . $drawer . $main, [
            'class' => 'mdl-layout mdl-js-layout' . $options
        ]);

        if (!is_null($this->background)) {
            $css = '
                .mdl-layout {
                    background: url("' . $this->background . '") center / cover;
                }
            ';
            $this->view->registerCss($css);
        }
        echo $layout;
    }

    protected function renderDropDown($item, $parentOptions = [])
    {
        $items = '';
        $expandIcon = '';
        foreach ($item['items'] as $child) {
            $label = '';
            $url = '';
            $options = [];
            $childItems = '';
            $linkWrapper = '';
            $expandIcon = Button::widget([
                'options' => [
                    'class' => 'pull-right expand-menu-button'
                ],
                'mdlOptions' => [
                    'type' => Button::TYPE_ICON,
                    'label' => '',
                    'icon' => 'expand_more',
                    'effects' => [
                        'primary' => true,
                        'rippleEffect' => true,
                    ]
                ]
            ]);
            if (isset($child['label'])) {
                $label = $child['label'];
            }
            if (isset($child['url'])) {
                $url = $child['url'];
            }
            if (isset($child['options'])) {
                $options = $child['options'];
            }
            if (isset($child['items'])) {
                $childItems = $this->renderDropDown($child);
                $linkWrapper .= Html::beginTag('div', [
                    'class' => 'link-wrapper'
                ]);
            }
            $link = Html::a(($this->encodeLabels ? utf8_encode($label) : $label), $url, []);
            $items .= Html::tag('li',
                $linkWrapper .
                $link .
                $childItems, array_merge($options, [
                    'class' => 'mdl-navigation__link'
                ]));
        }
        $expandIcon .= Html::endTag('div');
        $parentOptions = array_merge([
            'class' => 'mdl-navigation',
            'style' => 'height:0px;visibility:hidden;'
        ], $parentOptions);
        return ' ' . $expandIcon . Html::tag('ul', $items, $parentOptions);
    }
}