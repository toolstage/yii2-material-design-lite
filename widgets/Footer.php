<?php
/**
 * Created by PhpStorm.
 * User: Jonas Wehner
 * Date: 02.08.2016
 * Time: 17:50
 */

namespace jonasw91\mdl\widgets;

use jonasw91\mdl\helpers\Html;

/**
 * Class Footer
 * @package jonasw91\mdl\widgets
 *
 */
class Footer extends MdlWidget
{
    const TYPE_MEGA_FOOTER = 'mdl-mega-footer';
    const TYPE_MINI_FOOTER = 'mdl-mini-footer';

    const POSITION_TOP = '__top-section';
    const POSITION_MIDDLE = '__middle-section';
    const POSITION_BOTTOM = '__bottom-section';

    const SECTION_LEFT = '__left-section';
    const SECTION_RIGHT = '__right-section';
    const SECTION_DROP_DOWN = '__drop-down-section';

    const SECTION_TYPE_LINK_LIST = '__link-list';
    const SECTION_TYPE_SOCIAL_BTN_LIST = '__social-btn';
    const SECTION_TYPE_HEADING = '__heading';


    /**
     * 'items' => [
     *      [
     *          'title' => 'FAQ',
     *          'position' => FOOTER::ITEM_POSITION_TOP,
     *          'section' => FOOTER::ITEM_SECTION_LEFT,
     *          'list_type' => FOOTER::ITEM_DROP_DOWN_SECTION,
     *          'link_list' => [
     *              [
     *                  'label' => 'Question',
     *                  'url' => ['/index'],
     *                  'options' => [
     *                      ...
     *                  ]
     *              ]
     *          ]
     *      ]
     * ]
     *
     * @var $items array
     */
    public $positions;

    public $positionOptions = [];

    public $type;

    public $wrapperOptions = [];

    public $backgroundImg;

    public $backgroundImgOptions = [];


    public function init()
    {
        parent::init();
    }

    public function run()
    {
        $top = '';
        $middle = '';
        $bottom = '';

        foreach ($this->positions as $position) {
            $type = $position['type'];
            $positionOutput = $this->renderPosition($type, $position);
            switch ($type) {
                case self::POSITION_TOP:
                    $top .= $positionOutput;
                    break;
                case self::POSITION_MIDDLE:
                    $middle .= $positionOutput;
                    break;
                case self::POSITION_BOTTOM:
                    $bottom .= $positionOutput;
                    break;
            }
        }
        $img = '';
        if ($this->backgroundImg) {
            $img = Html::img($this->backgroundImg, ['class' => 'footer-img']);
        }

        return Html::tag('footer', Html::tag('div', Html::tag('div', $top . $middle . $bottom . $img, array_merge($this->wrapperOptions, [])), ['class' => 'container']), [
            'class' => $this->type
        ]);
    }

    private function renderPosition($positionType, $position)
    {
        $positionOutput = '';
        foreach ($position['sections'] as $section) {
            $type = isset($section['type']) ? $section['type'] : '';
            $positionOutput .= $this->renderSection($type, $section);
        }
        return Html::tag('div', Html::tag('div', $positionOutput, [
            'class' => $this->type . $positionType
        ]), array_merge($this->positionOptions, [

        ]));
    }

    private function renderSection($sectionType, $section)
    {
        return Html::tag('div', $this->renderItemList($section['itemType'], $section['title'], $section['items']), [
            'class' => $this->type . $sectionType
        ]);
    }

    private function renderItemList($listType, $heading, $items)
    {
        $list = '';
        if ($listType == self::SECTION_TYPE_LINK_LIST) {
            $checkBox = Html::checkbox('', true, [
                'class' => $this->type . '__heading-checkbox'
            ]);

            $heading = Html::tag('h1', $heading, [
                'class' => $this->type . self::SECTION_TYPE_HEADING
            ]);

            foreach ($items as $item) {
                $label = isset($item['label']) ? $item['label'] : '';
                $url = isset($item['url']) ? $item['url'] : '';
                $options = isset($item['options']) ? $item['options'] : [];
                $list .= Html::tag('li', Html::a($label, $url, $options), [
                    'class' => ''
                ]);
            }
            $list = $checkBox . $heading . Html::tag('ul', $list, [
                    'class' => $this->type . self::SECTION_TYPE_LINK_LIST
                ]);

        }
        if ($listType == self::SECTION_TYPE_SOCIAL_BTN_LIST) {
            foreach ($items as $item) {
                $label = isset($item['label']) ? $item['label'] : '';
                $url = isset($item['url']) ? $item['url'] : '';
                $options = isset($item['options']) ? $item['options'] : [];
                $list .= Html::a($label, $url, array_merge($options, [
                    'class' => $this->type . self::SECTION_TYPE_SOCIAL_BTN_LIST
                ]));
            }
        }

        return $list;
    }
}