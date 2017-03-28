<?php
/**
 * Created by PhpStorm.
 * User: jwehner
 * Date: 09.03.2017
 * Time: 08:33
 */

namespace jonasw91\mdl\widgets;


use yii\web\JsExpression;

class GridView extends \yii\grid\GridView
{
    public $tableOptions = [
        'class' => 'mdl-data-table mdl-js-data-table mdl-shadow--2dp',
        'width' => '100%'
    ];

    public $headerRowOptions = [
        'class' => 'mdl-table-header'
    ];

    public $filterRowOptions = [
        'class' => 'filterRow'
    ];

    public function init()
    {
        parent::init();

        if (count($this->rowOptions) == 0) {
            $this->rowOptions = function () {
                return [
                    'class' => 'mdl-data-table__cell--non-numeric'
                ];
            };
        }

        $this->initStyleSheet();
        $this->initJs();
    }

    public function initStyleSheet()
    {
        $this->view->registerCss('
            a.asc:after, a.desc:after {
                display:none;
            }
            input:focus {
                outline-color:transparent;
            }
            #' . $this->options['id'] . ' {
                overflow-x:auto;
            }
        ');
    }

    public function initJs()
    {
        $this->view->registerJs(new JsExpression('
            $("a.asc").parent("th").addClass ("mdl-data-table__header--sorted-ascending");
            $("a.desc").parent("th").addClass ("mdl-data-table__header--sorted-descending");
            $("thead tr th a").addClass ("mdl-button mdl-js-button mdl-button--accent mdl-button--primary mdl-js-ripple-effect");
            $("thead tr th a").prop ("style","width:100%;");
            $("thead tr th").addClass ("mdl-button--accent mdl-button--primary");
            $(".filterRow input").addClass ("mdl-textfield__input");

            $("#' . $this->options['id'] . ' .filterRow input").focusin(function() {
                $(this).parent("td").addClass("is-focused");
            });

            $("#' . $this->options['id'] . ' .filterRow input").focusout(function() {
                $(this).parent("td").removeClass("is-focused");
            });
        '));
    }
}