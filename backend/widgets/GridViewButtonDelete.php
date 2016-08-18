<?php

namespace ejen\base\backend\widgets;

use yii\helpers\Html;

class GridViewButtonDelete extends \yii\base\Widget
{
    public $gridSelector = '#w0';
    public $label = 'Удалить';
    public $action = ['delete'];

    public function run()
    {
        $this->view->registerJs("

            $('.gridview-delete-form .btn').click(function(e){
                if ($(this).attr('disabled'))
                {
                    e.preventDefault();
                    return false;
                }
            });

            $('{$this->gridSelector}').find(\"[name='selection[]'],[name=selection_all]\").change(function(){
                var ids = $('{$this->gridSelector}').yiiGridView('getSelectedRows');
                $('.gridview-delete-form .btn').attr('disabled', ids.length == 0);

                $('.gridview-delete-form input[name=\"ids[]\"]').remove();

                $.each(ids, function(i, id){
                    var input = $('<input>').attr({'type':'hidden','name':'ids[]'}).val(id);
                    $('.gridview-delete-form').append(input);    
                });
                
            });
        
        ");

        return Html::beginForm($this->action, 'post', [
            'class' => 'gridview-delete-form',
            'style' => 'display: inline-block;',
        ]).Html::submitButton('<i class="fa fa-trash"></i> '.$this->label, [
            'class' => 'btn btn-danger',
            'disabled' => true,        
            'data-confirm' => 'Вы уверены что хотите удалить выбранные элементы?',
        ]).Html::endForm();
    }
}
