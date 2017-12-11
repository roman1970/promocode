<?php

namespace app\models;

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

}
