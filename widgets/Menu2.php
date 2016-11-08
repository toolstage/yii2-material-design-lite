<?php
/**
 * Created by PhpStorm.
 * User: Jonas Wehner
 * Date: 02.08.2016
 * Time: 10:56
 */

namespace jonasw91\mdl\widgets;


use jonasw91\mdl\helpers\Html;
use webvimark\modules\UserManagement\components\GhostNav;
use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;

class Menu2 extends GhostNav
{
    public function renderItem($item)
    {
        if (is_string($item)) {
            return $item;
        }
        if (!isset($item['label'])) {
            throw new InvalidConfigException("The 'label' option is required.");
        }
        $items = ArrayHelper::getValue($item, 'items');
        $options = ArrayHelper::getValue($item, 'options', []);
        $url = ArrayHelper::getValue($item, 'url', '#');

        $encodeLabel = isset($item['encode']) ? $item['encode'] : $this->encodeLabels;
        $iconClass = isset($item['iconClass']) ? $item['iconClass'] : '';
        $label = $encodeLabel ? Html::encode($item['label']) : $item['label'];
        $label = '<i class="' . $iconClass . '"></i> <span>' . $label . '</span>';
        if (count($items)) {
            $label .= '<i class="fa fa-angle-left pull-right"></i>';
        }

        if (isset($item['active'])) {
            $active = ArrayHelper::remove($item, 'active', false);
        } else {
            $active = $this->isItemActive($item);
        }

        if ($items !== null) {
            $itemHtml = '<ul class="treeview-menu">';
            if (is_array($items)) {
                if ($this->activateItems) {
                    $items = $this->isChildActive($items, $active);
                }

                foreach ($items as $item) {
                    $liClass = "";
                    if (isset($item['options']) && isset($item['options']['class'])) {
                        $liClass = $item['options']['class'];
                    }
                    $itemHtml = $itemHtml . '<li class="' . $liClass . '">' . Html::a('<i class="fa fa-angle-double-right"></i>' . $item['label'], $item['url']) . '</li>';
                }
            }
            $itemHtml .= '</ul>';
            $items = $itemHtml;
        }

        if ($this->activateItems && $active) {
            Html::addCssClass($options, 'active');
        }

        $linkOptions = ArrayHelper::getValue($item, 'linkOptions', []);
        return Html::tag('li', Html::a($label, $url, $linkOptions) . $items, $options);
    }
}