<?php

namespace ejen\base\backend\widgets;

use Yii;
use yii\helpers\Html;

class GridViewToggleColumn extends \yii\grid\DataColumn
{
    public $headerOptions = [
        'width' => 50
    ];

    public function init()
    {
        parent::init();

        Yii::$app->view->registerJs("
        
            $('#{$this->grid->id} .toggle').click(function(e){
                e.preventDefault();

                var a = $(this);

                $.get(a.attr('href'), function(){
                    if (a.hasClass('label-danger'))
                    {
                        a.removeClass('label-danger').addClass('label-success');
                        a.find('i').removeClass('fa-ban').addClass('fa-check');
                    }
                    else
                    {
                        a.addClass('label-danger').removeClass('label-success');
                        a.find('i').addClass('fa-ban').removeClass('fa-check');
                    }
                });

                return false;
            });
        ");
    }

    protected function renderFilterCellContent()
    {
        return Html::activeDropDownList($this->grid->filterModel, $this->attribute, [
            '0' => 'Нет',
            '1' => 'Да',
        ],[
            'prompt' => '...',
            'class' => 'form-control'
        ]);
    }

    protected function renderDataCellContent($model, $key, $index)
    {
        $value = (bool) $model->{$this->attribute};

        if (!$value)
        {
            return '<center>'.Html::a('<i class="fa fa-ban"></i>', ['toggle', 'id' => $model->id], ['class' => 'label label-danger toggle']).'</center>';
        }

        return '<center>'.Html::a('<i class="fa fa-check"></i>', ['toggle', 'id' => $model->id], ['class' => 'label label-success toggle']).'</center>';
    }
}
