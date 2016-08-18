<?php

namespace ejen\base\backend\widgets;

use yii\helpers\Html;
use yii\helpers\Url;

class GridViewButtonUpdate extends \yii\base\Widget
{
    public $gridSelector = '#w0';
    public $label = 'Редактировать';
    public $action = ['update'];

    public function run()
    {
        $this->view->registerJs("

            $('.gridview-update-btn').click(function(e){
                if ($(this).attr('disabled'))
                {
                    e.preventDefault();
                    return false;
                }

                var ids = $('{$this->gridSelector}').yiiGridView('getSelectedRows');
                window.location.href = '".Url::to($this->action)."' + '?id='+ids[0];
            });

            $('{$this->gridSelector}').find(\"[name='selection[]'],[name=selection_all]\").change(function(){
                var ids = $('{$this->gridSelector}').yiiGridView('getSelectedRows');
                $('.gridview-update-btn').attr('disabled', ids.length != 1);
            });
        
        ");

        return Html::a('<i class="fa fa-pencil"></i> '.$this->label, '#', ['class' => 'gridview-update-btn btn btn-warning', 'disabled' => true]);
    }
}
