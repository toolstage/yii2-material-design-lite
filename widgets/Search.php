<?php

namespace jonasw91\mdl\widgets;

use yii\base\DynamicModel;
use yii\base\InvalidConfigException;

/**
 * Description:
 *
 * @link https://getmdl.io/components/index.html#badges-section
 *
 * Class Search
 * @package jonasw91\mdl\widgets
 *
 * @author Jonas Wehner <jonaswehner@outlook.de>
 * @version 1.0
 */
class Search extends MdlWidget
{
    const TYPE_DEFAULT = 'mdl-search-form';

    protected $defaultMdlOptions = [
        'type' => self::TYPE_DEFAULT,
        'icon' => 'search',
        'url' => ['#']
    ];

    /**
     * @var array Widget types
     */
    public $types = [
        self::TYPE_DEFAULT
    ];

    /**
     * @throws InvalidConfigException
     */
    public function init()
    {
        parent::init();

        $this->initMdlComponent();

    }

    /**
     * @return string
     */
    public function run()
    {
        $dynamicModel = new DynamicModel(['search']);
        $form = Form::begin([
            'id' => $this->getId() . 'form',
            'action' => $this->mdlOptions['url']
        ]);

        echo $form->field($dynamicModel, 'search')->expandable([
            'icon' => $this->mdlOptions['icon']
        ]);

        $form->end();
    }
}