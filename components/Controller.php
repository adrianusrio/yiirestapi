<?php

namespace app\components;

use Yii;
use yii\web\Response;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\QueryParamAuth;
use yii\filters\ContentNegotiator;

class Controller extends \yii\rest\ActiveController
{
    /**
     * @inheritdoc
     */
    public static function allowedDomains() {
        return [
            //'*', // star allows all domains
            // 'http://localhost:8080',
            // 'http://localhost:3000',
            // 'http://localhost',
        ];
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        unset($behaviors['authenticator']);

        $behaviors['contentNegotiator'] = [
			'class' => ContentNegotiator::className(),
			'formats' => [
				'application/json' => Response::FORMAT_JSON,
			],
		];

        $behaviors['corsFilter'] = [
            'class' => \yii\filters\Cors::className(),
            // 'cors' => [
            //     // restrict access to
            //     'Origin' => ['*', 'https://www.myserver.com'],
            //     // Allow only POST and PUT methods
            //     'Access-Control-Request-Method' => ['POST', 'PUT'],
            //     // Allow only headers 'X-Wsse'
            //     'Access-Control-Request-Headers' => ['X-Wsse'],
            //     // Allow credentials (cookies, authorization headers, etc.) to be exposed to the browser
            //     'Access-Control-Allow-Credentials' => true,
            //     // Allow OPTIONS caching
            //     'Access-Control-Max-Age' => 3600,
            //     // Allow the X-Pagination-Current-Page header to be exposed to the browser.
            //     'Access-Control-Expose-Headers' => ['X-Pagination-Current-Page'],
            // ],
        ];
        
        $behaviors['authenticator'] = [
            'class' => CompositeAuth::className(),
            'authMethods' => [
                HttpBasicAuth::className(),
                HttpBearerAuth::className(),
                QueryParamAuth::className(),
            ],
        ];
        // $behaviors['authenticator']['except'] = ['options'];
        return $behaviors;

    }

    /**
     * Api Validate error response
     */
    public function apiValidate($errors, $message = false)
    {
        Yii::$app->response->statusCode = 422;
        return [
            'statusCode' => 422,
            'name' => 'ValidateErrorException',
            'message' => $message ? $message : 'Error validation',
            'errors' => $errors
        ];
    }

    /**
     * Api Created response
     */
    public function apiCreated($data, $message = false)
    {
        Yii::$app->response->statusCode = 201;
        return [
            'statusCode' => 201,
            'message' => $message ? $message : 'Created successfully',
            'data' => $data
        ];
    }

    /**
     * Api Updated response
     */
    public function apiUpdated($data, $message = false)
    {
        Yii::$app->response->statusCode = 202;
        return [
            'statusCode' => 202,
            'message' => $message ? $message : 'Updated successfully',
            'data' => $data
        ];
    }

    /**
     * Api Deleted response
     */
    public function apiDeleted($data, $message = false)
    {
        Yii::$app->response->statusCode = 202;
        return [
            'statusCode' => 202,
            'message' => $message ? $message : 'Deleted successfully',
            'data' => $data
        ];
    }

    /**
     * Api Item response
     */
    public function apiItem($data, $message = false)
    {
        Yii::$app->response->statusCode = 200;
        return [
            'statusCode' => 200,
            'message' => $message ? $message : 'Data retrieval successfully',
            'data' => $data
        ];
    }

    /**
     * Api Collection response
     */
    public function apiCollection($data, $total = 0, $message = false)
    {
        Yii::$app->response->statusCode = 200;
        return [
            'statusCode' => 200,
            'message' => $message ? $message : 'Data retrieval successfully',
            'data' => $data,
            'total' => $total
        ];
    }

    /**
     * Api Success response
     */
    public function apiSuccess($message = false)
    {
        Yii::$app->response->statusCode = 200;
        return [
            'statusCode' => 200,
            'message' => $message ? $message : 'Success',
        ];
    }
}