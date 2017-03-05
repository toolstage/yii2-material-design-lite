<?php

namespace jonasw91\mdl\widgets;

use yii\base\InvalidConfigException;
use yii\web\JsExpression;
use jonasw91\mdl\helpers\Html;

/**
 * Description:
 *
 * @link https://getmdl.io/components/index.html#badges-section
 *
 * Class SnackBar
 * @package jonasw91\mdl\widgets
 *
 * @author Jonas Wehner <jonaswehner@outlook.de>
 * @version 1.0
 */
class SnackBar extends MdlWidget
{
    const TYPE_DEFAULT = 'mdl-js-snackbar mdl-snackbar';

    public static $initialized = false;

    protected $defaultMdlOptions = [
        'type' => self::TYPE_DEFAULT,
        'showButton' => null,
        'message' => 'Message',
        'actionText' => 'Action',
        'action' => 'function(event){}',
        'timeout' => 5000,
    ];

    /**
     * @var array Widget types
     */
    public $types = [
        self::TYPE_DEFAULT,
    ];

    /**
     * @throws InvalidConfigException
     */
    public function init()
    {
        parent::init();

        $this->initMdlComponent();

        $this->options['id'] = 'staticSnackBar';
        $this->options['aria-live'] = 'assertive';
        $this->options['aria-atomic'] = 'true';
        $this->options['aria-relevant'] = 'text';

        if (!is_null($this->mdlOptions['showButton'])) {
//            $this->registerSnackBarScript();
        }
    }

    public function run()
    {
        $text = Html::tag('div', '', ['class' => 'mdl-snackbar__text']);
        $action = Html::button('', ['class' => 'mdl-snackbar__action']);

        return Html::tag('div', $text . $action
            , $this->options);
    }

    protected function registerSnackBarScript()
    {
        $js = new JsExpression("
            var notification = document.querySelector('#" . $this->options['id'] . "');
            var showButton = document.querySelector ('#" . $this->mdlOptions['showButton'] . "');
            showButton.addEventListener ('click', function(event) {
                var data = {
                    message: '" . $this->mdlOptions['message'] . "',
                    timeout: '" . $this->mdlOptions['timeout'] . "',
                    actionText: '" . $this->mdlOptions['actionText'] . "',
                    actionHandler: " . $this->mdlOptions['action'] . "
                };
                notification.MaterialSnackbar.showSnackbar(data);
            });
        ");
        $this->view->registerJs($js);
    }
}