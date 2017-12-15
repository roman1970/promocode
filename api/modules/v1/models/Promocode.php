<?php

namespace api\modules\v1\models;

use Yii;

/**
 * This is the model class for table "promocodes".
 *
 * @property integer $id
 * @property string $name
 * @property string $city
 * @property string $tar_zone
 * @property integer $reward
 * @property integer $begin_data
 * @property integer $end_data
 * @property integer $status
 */
class Promocode extends \yii\db\ActiveRecord
{
    const tar_zones = [
        'Новосибирск',
        'Санкт-Петербург',
        'Казань',
        'Кемерово',
        'Москва'
    ];

    const status = [
        'Неактивен',
        'Активен'
    ];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'promocodes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'city', 'tar_zone', 'reward', 'begin_data', 'end_data'], 'required', 'message' => 'Это поле должно быть заполнено'],
            [['reward', 'status'], 'integer', 'message' => 'В этом поле нужно использовать только целое число'],
            [['name', 'city', 'tar_zone'], 'string', 'max' => 255, 'message' => 'Слишком много символов'],
            ['name', 'match', 'pattern' => '/^[a-z]\w*$/i', 'message' => 'Только латиница допустима']

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '#',
            'name' => 'Название промокода',
            'city' => 'City',
            'tar_zone' => 'Тарифная зона',
            'reward' => 'Вознаграждение',
            'begin_data' => 'Дата начала действия',
            'end_data' => 'Дата конца действия',
            'status' => 'Статус',
        ];
    }


    /**
     * Сущность по ай-ди
     * @param $id
     * @return null|static
     */
    public function getById($id){
       return self::findOne($id);
    }

    /**
     * Сущность по имени
     * @param $name
     * @return array|int|null|\yii\db\ActiveRecord
     */
    public function getDiscountByName($name){
        return self::find()->select(['begin_data', 'end_data', 'tar_zone', 'status', 'reward'])->where("name like '".$name."'")->one() ?? 0;
    }

    /**
     * Сущность по имени и тарифной зоне
     * @param $name
     * @param $tar_zone
     * @return int|mixed
     */
    public function activateDiscountByNameAndTarZone($name, $tar_zone){
        return self::find()->where("name like '".$name."' and tar_zone=".$tar_zone)->one()->reward ?? 0;
    }
}
