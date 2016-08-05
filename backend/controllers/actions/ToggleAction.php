<?php

namespace ejen\base\backend\controllers\actions;

use yii\web\NotFoundHttpException;

class ToggleAction extends \yii\base\Action
{
    public $modelClass;
    public $attribute = 'published';

    public function run($id)
    {
        $className = $this->modelClass;
        $model = $className::findOne($id);
        $model->{$this->attribute} = !$model->{$this->attribute};
        $model->save(false, [$this->attribute]);
    }
}
