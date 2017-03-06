<?php
/**
 * Created by PhpStorm.
 * User: jwehner
 * Date: 06.03.2017
 * Time: 09:45
 */

namespace jonasw91\mdl\widgets;


use yii\bootstrap\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\widgets\Menu;

class BaseMenu extends Menu
{
    /**
     * Renders the content of a menu item.
     * Note that the container and the sub-menus are not rendered here.
     * @param array $item the menu item to be rendered. Please refer to [[items]] to see what data might be in the item.
     * @return string the rendering result
     */
    protected function renderItem($item)
    {
        $options = '';
        if (isset($item['options'])) {
            foreach ($item['options'] as $key => $value) {
                if (is_string($value)) {
                    $options .= $key . '=' . '"' . $value . '" ';
                } else if (is_array($value)) {
                    foreach ($value as $subKey => $subValue) {
                        $options .= $key . '-' . $subKey . '=' . '"' . $subValue . '" ';
                    }
                }
            }
        }

        $template = ArrayHelper::getValue($item, 'template', $this->linkTemplate);

        if (isset($item['url'])) {
            $result = strtr($template, [
                '{url}' => Html::encode(Url::to($item['url'])),
                '{options}' => $options,
                '{label}' => $item['label'],
            ]);
        } else {
            $result = strtr($template, [
                '{options}' => $options,
                '{label}' => $item['label'],
            ]);
        }

        return $result;
    }
}