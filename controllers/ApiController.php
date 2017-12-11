<?php
namespace app\controllers;

use app\models\Promocode;
use yii\rest\ActiveController;

class ApiController extends ActiveController
{
    public $modelClass = 'app\models\Promocode';

    public function actionView($id){
        return Promocode::findOne($id);
    }

    public function actionGetDiscountInfo($name){
       return Promocode::find()->where("name like '".$name."'")->one() ?? 0;
    }

    public function actionActivateDiscount($name, $tar_zone){
        return Promocode::find()->where("name like '".$name."' and tar_zone=".$tar_zone)->one() ?? 0;
    }
}