<?php
namespace api\modules\v1\controllers;

use yii\rest\ActiveController;

class PromoController extends ActiveController
{
    public $modelClass = 'api\modules\v1\models\Promocode';


    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['corsFilter' ] = [
            'class' => \yii\filters\Cors::className(),
        ];

        return $behaviors;
    }

    public function actions()
    {
        $actions = parent::actions();

        return $actions;
    }


    public function actionView($id){
        return $this->modelClass::getById($id);
    }

    public function actionGetDiscountInfo($name){
       return $this->modelClass::getDiscountByName($name);
    }

    public function actionActivateDiscount($name, $tar_zone){
        return $this->modelClass::activateDiscountByNameAndTarZone($name, $tar_zone);
    }
}