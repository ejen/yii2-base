<?php

namespace ejen\base\backend\controllers\actions;

use Yii;

class DeleteAction extends \yii\base\Action
{
    public $modelClass;

    public function run()
    {
        $modelClass = $this->modelClass;
        $models = $modelClass::find()->andWhere(['id' => Yii::$app->request->post('ids')])->all();

        foreach($models as $model)
        {
            $model->delete();
        }

        Yii::$app->session->addFlash('success', 'Выбранные вами элементы успешно удалены');

        return $this->controller->redirect(Yii::$app->request->referrer);
    }
}

