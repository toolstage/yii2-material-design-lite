<?php
/**
 * Created by PhpStorm.
 * User: Jonas Wehner
 * Date: 02.08.2016
 * Time: 17:03
 */

namespace jonasw91\mdl\widgets;


use yii\base\Exception;
use jonasw91\mdl\helpers\Html;

class TabView extends MdlWidget
{
    public $tabs;

    public function init()
    {
        parent::init();

        if (is_null($this->tabs)) {
            throw new Exception("Attribute tabs must be set");
        }
    }

    public function run()
    {
        $tabLinks = '';
        $tabs = '';
        $index = 1;
        foreach ($this->tabs as $tab) {
            $label = '';
            $id = '';
            $active = '';
            $tabContent = '';
            if (isset($tab['label'])) {
                $label = $tab['label'];
            }
            if (isset($tab['id'])) {
                $id = $tab[''];
            }
            if ($index == 1) {
                $active = 'is-active';
            }
            if (isset($tab['tabContent'])) {
                $tabContent = $tab['tabContent'];
            }

            $url = (($id != '') ? $id : ('tab-item-' . $index));

            $tabLinks .= Html::a($label, '#' . $url, [
                'class' => 'mdl-tabs__tab ' . $active
            ]);

            $pageContent = Html::tag('div', $tabContent, [
                'class' => 'page-content'
            ]);

            $section = Html::tag('section', $pageContent, [
                'class' => 'mdl-tabs__panel ' . $active,
                'id' => $url
            ]);
            $index++;
            $tabs .= $section;
        }

        $tabBar = Html::tag('div', $tabLinks, [
            'class' => 'mdl-tabs__tab-bar'
        ]);

        $tabView = Html::tag('div', $tabBar . $tabs, [
            'class' => 'mdl-tabs mdl-js-tabs mdl-js-ripple-effect'
        ]);
        return $tabView;
    }
}