<?php

namespace jonasw91\mdl\widgets;

use jonasw91\mdl\helpers\Html;
use jonasw91\mdl\helpers\MdlComponent;
use phpDocumentor\Reflection\Exception;
use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/**
 * Description:
 *
 * @link https://getmdl.io/components/index.html#badges-section
 *
 * Class Slider
 * @package jonasw91\mdl\widgets
 *
 * @author Jonas Wehner <jonaswehner@outlook.de>
 * @version 1.0
 */
class ListView extends \yii\widgets\ListView implements MdlComponent
{
    public $defaultOptions = ['class' => 'mdl-list'];

    public $options = [];

    public $defaultItemOptions = [
        'class' => 'mdl-list__item'
    ];

    public $defaultMdlOptions = [
        'primaryContent' => [
            'icon' => 'radio_button_unchecked'
        ]
    ];

    public $mdlOptions = [];

    /**
     * @throws InvalidConfigException
     */
    public function init()
    {
        parent::init();

        $this->validateConfiguration();
    }

    /**
     * Check config and set default values if option is not set
     */
    public function validateConfiguration()
    {
        foreach ($this->defaultMdlOptions as $option => $value) {
            if (!isset($this->mdlOptions[$option])) {
                $this->mdlOptions[$option] = $value;
            }
        }
        foreach ($this->defaultItemOptions as $option => $value) {
            if (!isset($this->itemOptions[$option])) {
                $this->itemOptions[$option] = $value;
            }
        }
        foreach ($this->defaultOptions as $option => $value) {
            if (!isset($this->options[$option])) {
                $this->options[$option] = $value;
            }
        }
    }

    /**
     * Renders a single data model.
     * @param mixed $model the data model to be rendered
     * @param mixed $key the key value associated with the data model
     * @param integer $index the zero-based index of the data model in the model array returned by [[dataProvider]].
     * @return string the rendering result
     */
    public function renderItem($model, $key, $index)
    {
        if ($this->itemView === null) {
            $content = $key;
        } elseif (is_string($this->itemView)) {
            $content = $this->getView()->render($this->itemView, array_merge([
                'model' => $model,
                'key' => $key,
                'index' => $index,
                'widget' => $this,
            ], $this->viewParams));
        } else {
            $content = call_user_func($this->itemView, $model, $key, $index, $this);
        }
        if (!is_null($this->mdlOptions)) {
            if (isset($this->mdlOptions['primaryContent'])) {
                $primaryContent = $this->mdlOptions ['primaryContent'];
                if (!is_null($primaryContent)) {
                    if (is_string($primaryContent)) {
                        $content = $primaryContent;
                    } else {
                        $content = call_user_func($primaryContent, $model, $key, $index, $this);
                    }
                }
                $content = Html::tag('span', $content);
            }
            if (isset($this->mdlOptions['icon'])) {
                $icon = $this->mdlOptions['icon'];
                if (!is_null($icon) && is_string($icon)) {
                    $content = Html::tag('i', $icon, ['class' => 'material-icons mdl-list__item-icon']) . $content;
                }
            } else if (isset($this->mdlOptions['avatar'])) {
                $icon = $this->mdlOptions['avatar'];
                if (!is_null($icon) && is_string($icon)) {
                    $content = Html::tag('i', $icon, ['class' => 'material-icons mdl-list__item-avatar']) . $content;
                }
            } else if (isset($this->mdlOptions['menu'])) {
                $menu = $this->mdlOptions['menu'];
                if (is_string($menu)) {
                    $content = $this->mdlOptions['menu'] . $content;
                } else if (is_array($menu)) {
                    if (isset($menu['items'])) {
                        $items = [];
                        foreach ($menu['items'] as $item) {
                            if (is_array($item) && key_exists('url', $item)) {
                                if (is_object($item['url'])) {
                                    $uri = call_user_func($item['url'], $model, $key, $index, $this);
                                    $item['url'] = $uri;
                                }
                            }
                            $items[] = $item;
                        }
                        $content = Menu::widget([
                                'items' => $items
                            ]) . $content;
                    }
                }
            }
            $action = '';
            if (isset($this->mdlOptions['action'])) {
                $icon = '';
                $actionData = $this->mdlOptions['action'];
                if (!is_null($actionData)) {
                    if (is_string($actionData)) {
                        $action = Url::to($actionData);
                    } else if (is_array($actionData)) {
                        if (isset($actionData['url'])) {
                            $action = Url::to($actionData['url']);
                        }
                        if (isset($actionData['icon'])) {
                            $icon = Html::tag('i', $actionData['icon'], ['class' => 'material-icons']);
                        }
                    }
                }
                $action = Html::a($icon, $action, ['class' => 'mdl-list__item-secondary-action']);
            }
            $content = Html::tag('span', $content, ['class' => 'mdl-list__item-primary-content']) . $action;
        }

        $options = $this->itemOptions;
        $tag = ArrayHelper::remove($options, 'tag', 'div');
        $options['data-key'] = is_array($key) ? json_encode($key, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) : (string)$key;

        return Html::tag($tag, $content, $options);
    }

    /**
     * Default configuration of MDL widget components
     *
     * @throws InvalidConfigException
     */
    public function initMdlComponent()
    {
        // TODO: Implement initMdlComponent() method.
    }
}