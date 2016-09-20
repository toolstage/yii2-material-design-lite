<?php
/**
 * Created by PhpStorm.
 * User: Jonas Wehner
 * Date: 01.08.2016
 * Time: 16:05
 */
namespace jonasw91\mdl\widgets;

use jonasw91\mdl\helpers\Html;

/**
 * https://getmdl.io/components/index.html#cards-section
 *
 * Class Card
 * @package jonasw91\mdl\widgets
 */
class Card extends MdlWidget
{
    const TYPE_WIDE = 'a';
    const TYPE_SQUARE = 'b';
    const TYPE_IMAGE = 'c';
    const TYPE_EVENT = 'd';

    /**
     * Allowed values are 2, 3, 4, 6, 8, or 16
     *
     * @var int
     */
    public $shadowDepth = 2;

    public $width;

    public $height;

    public $type;

    public $title;

    public $titleBackground;

    public $titleHeight = 100;

    public $actions;

    public $spacer;

    public $background;

    public $menu;

    public $supportingText;

    public $options = [
        'class' => 'mdl-card'
    ];

    public function init()
    {
        parent::init();
        $this->options['class'] .= ' mdl-shadow--' . $this->shadowDepth . 'dp';

        switch ($this->type) {
            case self::TYPE_WIDE:
                break;
            case self::TYPE_SQUARE:
                break;
            case self::TYPE_IMAGE:
                break;
            case self::TYPE_EVENT:
                break;
            default:
                break;
        }
    }

    public function run()
    {
        $content = '';
        $css = '#' . $this->id . ' {
            margin: 10px;
        }';
        if ($this->type == self::TYPE_WIDE) {
            $content = $this->renderTitle() .
                $this->renderSupportingText() .
                $this->renderActions() .
                $this->renderMenu();
        }
        if ($this->type == self::TYPE_SQUARE) {
            $content = $this->renderTitle() .
                $this->renderSupportingText() .
                $this->renderActions();
        }

        if ($this->type == self::TYPE_IMAGE) {
            if (!is_null($this->background)) {
                $css .= '
                 #' . $this->id . ' {
                    background: url("' . $this->background . '") center / cover;
                 }
                 #' . $this->id . ' > .mdl-card__actions {
                    background: rgba(0, 0, 0, 0.2);
                 }
                 #' . $this->id . ' > .mdl-card__actions *{
                    color: #fff;
                 }
                 .mdl-card__actions * {
                  font-size: 14px;
                  font-weight: 500;
                }
                
            ';
            }
            if (!is_null($this->height)) {
                $css .= '#' . $this->id . ' {
                height: ' . $this->height . 'px;
            }';
            }

            $content = $this->renderTitle() .
                $this->renderActions();
        }

        if ($this->type == self::TYPE_EVENT) {
            $content = $this->renderTitle() .
                $this->renderActions();
        }

        $this->view->registerCss($css);

        $card = Html::tag('div',
            $content,
            array_merge($this->options, [
                'id' => $this->id
            ]));

        return $card;
    }

    /**
     * @return string
    color: #fff;
     * background: #3E4EB8;
     */
    private function renderTitle()
    {
        $css = '#' . $this->id . ', #' . $this->id . ' * {
                width: auto;
        }
        ';
        if (!is_null($this->width)) {
            $css .= '#' . $this->id . ' {
                max-width: ' . $this->width . 'px;
        }';
        }
        if ($this->type == self::TYPE_SQUARE) {
            if (!is_null($this->width)) {
                $css .= '#' . $this->id . ' {
                height: ' . $this->width . 'px;
            }';
            }
        }
        if ($this->type == self::TYPE_WIDE) {
            $css .= '#' . $this->id . ' {
                width: auto;
            }
            #' . $this->id . ' > .mdl-card__title {
                height: ' . $this->titleHeight . 'px;
            }
            ';
        }
        if ($this->type == self::TYPE_WIDE || $this->type == self::TYPE_SQUARE) {
            $css .= '#' . $this->id . ' > .mdl-card__title {
                background: url("' . $this->titleBackground . '") no-repeat center center #46B6AC;
                background-size: cover;
                color: #fff
            }';
        }
        if ($this->type == self::TYPE_WIDE) {

        }
        $this->view->registerCss($css);
        $title = Html::tag('div',
            Html::tag('h2', $this->title, [
                'class' => 'mdl-card__title-text'
            ]), [
                'class' => 'mdl-card__title mdl-card--expand'
            ]);

        return $title;
    }

    private function renderMenu()
    {
        if (!is_null($this->menu)) {
            $css = '
            #' . $this->id . ' > .mdl-card__menu {
                color: #fff;
            }
        ';
            $this->view->registerCss($css);
            return Html::tag('div', $this->menu, [
                'class' => 'mdl-card__menu'
            ]);
        }
        return '';
    }

    private function renderSupportingText()
    {
        if (!is_null($this->supportingText)) {
            return Html::tag('div', $this->supportingText, [
                'class' => 'mdl-card__supporting-text'
            ]);
        }
        return '';
    }

    private function renderActions()
    {
        if (!is_null($this->actions)) {
            $spacer = '';
            if (!is_null($this->spacer)) {
                $spacer .= Html::tag('div', $this->spacer, [
                    'class' => 'mdl-layout-spacer'
                ]);
            }

            $css = '';
            if ($this->type == self::TYPE_EVENT) {
                $css .= '
             #' . $this->id . ' > .mdl-card__actions {
                    display: flex;
                    box-sizing:border-box;
                    align-items: center;
            }
            #' . $this->id . ' > .mdl-card__actions {
              border-color: rgba(255, 255, 255, 0.2);
            }
            #' . $this->id . ' > .mdl-card__title {
              align-items: flex-start;
            }
            #' . $this->id . ' > .mdl-card__title > h4 {
              margin-top: 0;
            }
            #' . $this->id . '> .mdl-card__actions > .material-icons {
              padding-right: 10px;
            }
        ';
                $this->view->registerCss($css);
            }
            return Html::tag('div', $this->actions . $spacer, [
                'class' => 'mdl-card__actions mdl-card--border'
            ]);
        }
        return '';
    }
}