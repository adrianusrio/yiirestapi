<?php

namespace app\modules\v1\controllers;
use Yii;
use yii\rest\ActiveController;
use app\components\Controller;
use yii\web\Response;

class UserController extends Controller
{

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator']['except'] = ['index', 'create', 'update'];

        return $behaviors;
    }


    public function actionIndex()
    {
        // return $this->render('index');
        // die('asd');
        return $this->apiSuccess();
    }

    public function actionCreate(){
        // print_r(Yii::$app->request->getBodyParams());
        \Yii::$app->response->statusCode = 200;
        return [
            'statusCode' => 200,
            'message' => 'Success',
        ];
    }

    public function actionUpdate(){
        return $this->apiSuccess();
    }

}
