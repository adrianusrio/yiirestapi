<?php 
namespace app\controllers;
use Yii;
use app\models\DataUser;
use yii\filters\auth\HttpBasicAuth;
use yii\rest\ActiveController;
use yii\helpers\Url;

class MahasiswaController extends ActiveController
{
    public $modelClass = 'app\models\DataUser';

    public function behaviors()
    {
        $behaviors = parent::behaviors();

        // remove authentication filter
        $auth = $behaviors['authenticator'];
        unset($behaviors['authenticator']);
        
        // add CORS filter
        $behaviors['corsFilter'] = [
            'class' => \yii\filters\Cors::className(),
        ];
        
        // re-add authentication filter
        $behaviors['authenticator'] = $auth;
        // avoid authentication on CORS-pre-flight requests (HTTP OPTIONS method)
        $behaviors['authenticator']['except'] = ['options'];

        return $behaviors;
    }

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['create']);
        return $actions;
    }

    public function actionCreate()
    {
        // your code goes here
        // $params=$_REQUEST;
        // $this->setHeader(200);
        // echo $params;
        $model = new DataUser;
        $data = \Yii::$app->getRequest()->getBodyParams();
        print_r($data);die;
        $model->load($data['data'], '');
        if ($model->save()) {
            $response = Yii::$app->getResponse();
            $response->setStatusCode(201);
            $id = implode(',', array_values($model->getPrimaryKey(true)));
            $response->getHeaders()->set('Location', Url::toRoute(['$this->viewAction', 'id' => $id], true));
        } elseif (!$model->hasErrors()) {
            throw new ServerErrorHttpException('Failed to create the object for unknown reason.');
        }

        return $model;
        // echo json_encode(array('status'=>1,'data'=>$params),JSON_PRETTY_PRINT);
        // json_encode(array('status'=>$params),JSON_PRETTY_PRINT);
        // echo 'asd';
        // die;
    }

    // private function setHeader($status)
    // {
        
    //     $status_header = 'HTTP/1.1 ' . $status . ' ' . $this->_getStatusCodeMessage($status);
    //     $content_type="application/json; charset=utf-8";
        
    //     header($status_header);
    //     header('Content-type: ' . $content_type);
    //     header('X-Powered-By: ' . "Nintriva <nintriva.com>");
    // }

    // private function _getStatusCodeMessage($status)
    // {
    //     $codes = Array(
    //     200 => 'OK',
    //     400 => 'Bad Request',
    //     401 => 'Unauthorized',
    //     402 => 'Payment Required',
    //     403 => 'Forbidden',
    //     404 => 'Not Found',
    //     500 => 'Internal Server Error',
    //     501 => 'Not Implemented',
    //     );
    //     return (isset($codes[$status])) ? $codes[$status] : '';
    // }
}