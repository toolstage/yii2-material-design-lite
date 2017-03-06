<?php

namespace jonasw91\mdl\widgets;

use jonasw91\mdl\helpers\BaseMdlWidget;
use jonasw91\mdl\helpers\Html;
use jonasw91\mdl\helpers\MdlComponent;

/**
 * Description:
 *
 * @link https://getmdl.io/components/index.html#badges-section
 *
 * Class ListItem
 * @package jonasw91\mdl\widgets
 *
 * @author Jonas Wehner <jonaswehner@outlook.de>
 * @version 1.0
 */
class ListItem extends BaseMdlWidget implements MdlComponent
{
    public $options = [
        'class' => 'mdl-list__item mdl-list__item--three-line',
        'tag' => 'li',
        'disabled' => true
    ];

    public $defaultMdlOptions = [
        'icon' => 'Prev',
        'title' => 'Item Title',
        'text' => 'Item Text',
        'action' => 'Post'
    ];

    public function init()
    {
        parent::init();
    }

    /**
     * @return string
     */
    public function run()
    {

        return $this->renderItem();
    }

    /**
     * @return string
     */
    public function renderItem()
    {
        $icon = Html::tag('i', $this->mdlOptions['icon'], ['class' => 'material-icons mdl-list__item-avatar']);
        $title = Html::tag('span', $this->mdlOptions['title'], ['class' => 'mdl-list__item-title']);
        $text = Html::tag('span', $this->mdlOptions['text'], ['class' => 'mdl-list__item-text-body']);
        $primaryContent = Html::tag('span', $icon . $title . $text, ['class' => 'mdl-list__item-primary-content']);
        $action = '';
        if (is_array($this->mdlOptions['action']) && isset($this->mdlOptions['action']['items']) && count($this->mdlOptions['action']['items'])) {
            $action = Menu::widget([
                'items' => $this->mdlOptions['action']['items'],
                'mdlOptions' => [
                    'type' => Menu::TYPE_LOWER_RIGHT,
                    'menuButtonMdlOptions' => [
                        'label' => '',
                        'icon' => 'more_vert',
                        'type' => Button::TYPE_RAISED,
                    ]
                ]
            ]);
        } else if (is_string($this->mdlOptions['action'])) {
            $action = Html::tag('span', $this->mdlOptions['action'], ['class' => 'mdl-list__item-secondary-action']);
        }
        $secondaryContent = Html::tag('span', $action, ['class' => 'mdl-list__item-secondary-content']);

        return Html::tag($this->options['tag'], $primaryContent . $secondaryContent, ['class' => $this->options['class']]);
    }
}