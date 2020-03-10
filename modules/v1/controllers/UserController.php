<?php

namespace app\modules\v1\controllers;
use Yii;
use app\components\Controller;
use app\models\DataUser;
use yii\helpers\Url;

class UserController extends Controller
{
    public $modelClass = 'app\models\DataUser';

    public function behaviors(){
        $behaviors = parent::behaviors();
        $behaviors['authenticator']['except'] = ['create'];
        return $behaviors;
    }

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['create']);
        return $actions;
    }


    // public function actionIndex()
    // {
    //     // return $this->render('index');
    //     // die('asd');
    //     return $this->apiSuccess();
    // }

    public function actionCreate(){
        $model = new DataUser;
        $data = \Yii::$app->getRequest()->getBodyParams();
        $model->load($data['data'], '');
        if ($model->save()) {
            $response = Yii::$app->getResponse();
            $response->setStatusCode(201);
        } elseif (!$model->hasErrors()) {
            throw new ServerErrorHttpException('Failed to create the object for unknown reason.');
        }
        return $model;
    }

}
