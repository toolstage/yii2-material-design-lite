<?php

namespace jonasw91\mdl\widgets;

use jonasw91\mdl\helpers\Html;
use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;
use yii\web\JsExpression;
use yii\widgets\ActiveField;

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
class Field extends ActiveField
{
    /* @var \jonasw91\mdl\widgets\Field */
    public $form;

    public $options = ['class' => 'mdl-textfield mdl-js-textfield  mdl-textfield--floating-label'];

    public $inputOptions = ['class' => 'mdl-textfield__input'];

    public $labelOptions = ['class' => 'mdl-textfield__label'];

    public $errorOptions = ['class' => 'mdl-textfield__error'];

    public $expandableIcon = 'search';

    public function expandable($options = [])
    {
        $this->options['class'] = $this->options['class'] . ' mdl-textfield--expandable';
        $options = array_merge($this->inputOptions, $options);
        $this->adjustLabelFor($options);
        if (isset($options['icon'])) {
            $this->expandableIcon = $options['icon'];
        }
        $this->parts['{input}'] =
            Html::tag('div',
                Html::activeTextInput($this->model, $this->attribute, $options) .
                Html::label('', $this->getInputId(), ['class' => 'mdl-textfield__label'])
                ,
                [
                    'class' => 'mdl-textfield__expandable-holder'
                ]);
        return $this;
    }

    public function label($label = null, $options = [])
    {
        if (strpos($this->options['class'], 'mdl-textfield--expandable') !== false) {
            $label = Html::tag('i', $this->expandableIcon, ['class' => 'material-icons']);
            $options = array_merge($options,
                ['class' => 'mdl-button mdl-js-button mdl-button--icon']
            );
        }
        return parent::label($label, $options);
    }

    public function radio($options = [], $enclosedByLabel = true)
    {
        if ($enclosedByLabel) {
            $this->parts['{input}'] = Html::activeRadio($this->model, $this->attribute, $options);
            $this->parts['{label}'] = '';
        } else {
            if (isset($options['label']) && !isset($this->parts['{label}'])) {
                $this->parts['{label}'] = $options['label'];
                if (!empty($options['labelOptions'])) {
                    $this->labelOptions = $options['labelOptions'];
                }
            }
            unset($options['labelOptions']);
            $options['label'] = null;
            $this->parts['{input}'] = Html::activeRadio($this->model, $this->attribute, $options);
        }
        $this->adjustLabelFor($options);

        return $this;
    }
}