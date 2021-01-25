<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "attributes".
 *
 * @property string $code
 * @property string $type_code
 * @property string $name
 *
 * @property AttributesTypes $type
 * @property ProductsToAttributes[] $productsToAttributes
 * @property Products[] $products
 */
class Attributes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'attributes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'type_code', 'name'], 'required'],
            [['code', 'type_code', 'name'], 'string', 'max' => 255],
            [['code'], 'unique'],
            [['type_code'], 'exist', 'skipOnError' => true, 'targetClass' => AttributesTypes::className(), 'targetAttribute' => ['type_code' => 'code']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'code' => 'Код атрибута',
            'type_code' => 'Код типа атрибута',
            'name' => 'Название атрибута',
        ];
    }

    /**
     * Gets query for [[Type]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(AttributesTypes::className(), ['code' => 'type_code']);
    }

    /**
     * Gets query for [[ProductsToAttributes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProductsToAttributes()
    {
        return $this->hasMany(ProductsToAttributes::className(), ['attribute_code' => 'code']);
    }

    /**
     * Gets query for [[Products]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Products::className(), ['id' => 'product_id'])->viaTable('products_to_attributes', ['attribute_code' => 'code']);
    }
}
