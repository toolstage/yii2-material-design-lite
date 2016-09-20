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

    const LINK_LIST = '__link-list';
    const SOCIAL_BTN_LIST = '__social-btn';
    const HEADING = '__heading';

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
    public $items;

    public $type;

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        $this->items = [
            self::POSITION_TOP => [
                [
                    'sectionType' => self::SECTION_LEFT,
                    'items' => [
                        [
                            'listHeading' => 'Killa',
                            'listType' => self::SOCIAL_BTN_LIST,
                            'items' => [
                                [
                                    'label' => ' '
                                ],
                                [
                                    'label' => ' ',
                                ],
                                [
                                    'label' => ' ',
                                ]
                            ]
                        ]
                    ]
                ]
            ],
            self::POSITION_MIDDLE => [
                [
                    'sectionType' => self::SECTION_DROP_DOWN,
                    'items' => [
                        [
                            'listHeading' => 'Killa',
                            'listType' => self::LINK_LIST,
                            'items' => [
                                [
                                    'label' => 'Hello asd ',
                                    'url' => 'asd'
                                ],
                                [
                                    'label' => 'GASd asas dasf ',
                                    'url' => 'asd'
                                ],
                                [
                                    'label' => 'H asdaddasd ello',
                                    'url' => 'asd'
                                ]
                            ]
                        ]
                    ]
                ],
                [
                    'sectionType' => self::SECTION_DROP_DOWN,
                    'items' => [
                        [
                            'listHeading' => 'Killa',
                            'listType' => self::LINK_LIST,
                            'items' => [
                                [
                                    'label' => 'Hello',
                                    'url' => 'asd'
                                ],
                                [
                                    'label' => 'Hello',
                                    'url' => 'asd'
                                ],
                                [
                                    'label' => 'Hello',
                                    'url' => 'asd'
                                ]
                            ]
                        ]
                    ]
                ],
                [
                    'sectionType' => self::SECTION_RIGHT,
                    'items' => [
                        [
                            'listHeading' => 'Killa',
                            'listType' => self::LINK_LIST,
                            'items' => [
                                [
                                    'label' => 'Hello',
                                    'url' => 'asd'
                                ],
                                [
                                    'label' => 'Hello',
                                    'url' => 'asd'
                                ],
                                [
                                    'label' => 'Hello',
                                    'url' => 'asd'
                                ]
                            ]
                        ]
                    ]
                ]
            ],
            self::POSITION_BOTTOM => [
                [
                    'sectionType' => self::SECTION_LEFT,
                    'items' => [
                        [
                            'listHeading' => 'Killa',
                            'listType' => self::LINK_LIST,
                            'items' => [
                                [
                                    'label' => 'Hello',
                                    'url' => 'asd'
                                ],
                                [
                                    'label' => 'Hello',
                                    'url' => 'asd'
                                ],
                                [
                                    'label' => 'Hello',
                                    'url' => 'asd'
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ];

        $top = isset($this->items[self::POSITION_TOP]) ? $this->renderPosition(self::POSITION_TOP, $this->items[self::POSITION_TOP]) : '';
        $middle = isset($this->items[self::POSITION_MIDDLE]) ? $this->renderPosition(self::POSITION_MIDDLE, $this->items[self::POSITION_MIDDLE]) : '';
        $bottom = isset($this->items[self::POSITION_BOTTOM]) ? $this->renderPosition(self::POSITION_BOTTOM, $this->items[self::POSITION_BOTTOM]) : '';

        return Html::tag('footer', $top . $middle . $bottom, [
            'class' => $this->type
        ]);
    }

    private function renderPosition($position, $sections)
    {
        $positionS = '';
        foreach ($sections as $section) {
            $type = isset($section['sectionType']) ? $section['sectionType'] : '';
            $items = isset($section['items']) ? $section['items'] : '';
            $positionS .= $this->renderSection($type, $items);
        }
        return Html::tag('div', $positionS, [
            'class' => $this->type . $position
        ]);
    }

    private function renderSection($sectionType, $items)
    {
        $section = '';
        foreach ($items as $item) {
            $listType = isset($item['listType']) ? $item['listType'] : '';
            $heading = isset($item['listHeading']) ? $item['listHeading'] : '';
            $listItems = isset($item['items']) ? $item['items'] : [];
            $section .= $this->renderItemList($listType, $heading, $listItems);
        }
        return Html::tag('div', $section, [
            'class' => $this->type . $sectionType
        ]);
    }

    private function renderItemList($listType, $heading, $items)
    {
        $list = '';
        if ($listType == self::LINK_LIST) {
            $checkBox = Html::checkbox('', true, [
                'class' => $this->type . '__heading-checkbox'
            ]);

            $heading = Html::tag('h1', $heading, [
                'class' => $this->type . self::HEADING
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
                    'class' => $this->type . self::LINK_LIST
                ]);
        }
        if ($listType == self::SOCIAL_BTN_LIST) {
            foreach ($items as $item) {
                $label = isset($item['label']) ? $item['label'] : '';
                $url = isset($item['url']) ? $item['url'] : '';
                $options = isset($item['options']) ? $item['options'] : [];
                $list .= Html::button($label, array_merge($options, [
                        'class' => $this->type . self::SOCIAL_BTN_LIST
                    ])) . '\n';
            }
        }

        return $list;
    }
}