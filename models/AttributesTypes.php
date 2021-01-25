<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "attributes_types".
 *
 * @property string $code
 * @property string $name
 *
 * @property Attributes[] $attributes0
 */
class AttributesTypes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'attributes_types';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'name'], 'required'],
            [['code', 'name'], 'string', 'max' => 255],
            [['code'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'code' => 'Код типа атрибута',
            'name' => 'Название типа атрибута',
        ];
    }

    /**
     * Gets query for [[Attributes0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAttributes0()
    {
        return $this->hasMany(Attributes::className(), ['type_code' => 'code']);
    }
}
