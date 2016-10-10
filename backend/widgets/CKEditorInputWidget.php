<?php

namespace ejen\base\backend\widgets;

use  dosamigos\ckeditor\CKEditor;

class CKEditorInputWidget extends \yii\widgets\InputWidget
{
    public function run()
    {
        return CKEditor::widget([
            'model' => $this->model,
            'attribute' => $this->attribute,
            'options' => [
                'rows' => 10,
            ],
            'clientOptions' => [
                'allowedContent' => true,
            ],
        ]);
    }
}
