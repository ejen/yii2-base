<?php

namespace ejen\base\backend\widgets;

use yii\helpers\Html;

class ImageUploadInputWidget extends \yii\widgets\InputWidget
{
    public $imagePrefix = '/images/';

    public function run()
    {
        $value = $this->model->{$this->attribute};

        if ($value)
        {
            echo Html::img(rtrim($this->imagePrefix, '/').'/'.$value, ['height' => 200, 'class' => 'thumbnail']);
        }

        echo Html::activeFileInput($this->model, $this->attribute);

        if ($value)
        {
            echo Html::activeHiddenInput($this->model, $this->attribute);
        }
    }
}
