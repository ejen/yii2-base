<?php

namespace ejen\base\backend\controllers\actions;

use Yii;
use yii\web\NotFoundHttpException;

class UpdateAction extends \yii\base\Action
{
    public $modelClass;
    public $view = 'update';
    public $successMessage = 'Данные успешно сохранены';

    public function run($id)
    {
        $modelClass = $this->modelClass;
        if ($id)
        {
            $model = $modelClass::findOne($id);
            if (!$model) throw new NotFoundHttpException;
        }
        else
        {
            $model = new $modelClass;
        }

        if ($model->load(Yii::$app->request->post()))
        {
            if (Yii::$app->request->isPjax)
            {
            }
            else
            {
                if ($model->save())
                {
                    Yii::$app->session->addFlash('success', $this->successMessage);
                    $this->controller->goBack();
                }
            }
        }
        else
        {
            Yii::$app->user->returnUrl = Yii::$app->request->referrer;
        }

        return $this->controller->render($this->view, [
            'model' => $model,
        ]);
    }
}
