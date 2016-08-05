<?php

namespace ejen\base\backend\controllers\actions;

use Yii;
use yii\data\ActiveDataProvider;

class IndexAction extends \yii\base\Action
{
    public $query;
    public $searchModel;

    public $view = 'index';

    public function run()
    {
        if ($this->query)
        {
            $dataProvider = new ActiveDataProvider([
                'query' => $this->query
            ]);
            return $this->controller->render($this->view, [
                'dataProvider' => $dataProvider
            ]);
        }
        elseif($this->searchModel)
        {
            $dataProvider = $this->searchModel->search(Yii::$app->request->get());
            return $this->controller->render($this->view, [
                'dataProvider' => $dataProvider,
                'searchModel' => $this->searchModel
            ]);
        }
    }
}
