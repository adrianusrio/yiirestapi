<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "data_user".
 *
 * @property int $Id
 * @property string $ParentName
 * @property string $ChildName
 * @property int $BirthDate
 * @property int $BirthMonth
 * @property int $BirthYear
 * @property string $City
 * @property string $Email
 * @property string $Sex
 */
class DataUser extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'data_user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ParentName', 'ChildName', 'BirthDate', 'BirthMonth', 'BirthYear', 'City', 'Email', 'Sex', 'Phone'], 'required'],
            [['BirthDate', 'BirthMonth', 'BirthYear'], 'integer'],
            [['ParentName', 'ChildName', 'City', 'Email'], 'string', 'max' => 100],
            [['Sex'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'ParentName' => 'Parent Name',
            'ChildName' => 'Child Name',
            'BirthDate' => 'Birth Date',
            'BirthMonth' => 'Birth Month',
            'BirthYear' => 'Birth Year',
            'City' => 'City',
            'Email' => 'Email',
            'Sex' => 'Sex',
            'Phone' => 'Phone'
        ];
    }
}
