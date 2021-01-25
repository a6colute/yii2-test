<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "products_to_attributes".
 *
 * @property int $product_id
 * @property string $attribute_code
 *
 * @property Attributes $productAttribute
 * @property Products $product
 */
class ProductsToAttributes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'products_to_attributes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id', 'attribute_code'], 'required'],
            [['product_id'], 'integer'],
            [['attribute_code'], 'string', 'max' => 255],
            [['product_id', 'attribute_code'], 'unique', 'targetAttribute' => ['product_id', 'attribute_code']],
            [['attribute_code'], 'exist', 'skipOnError' => true, 'targetClass' => Attributes::className(), 'targetAttribute' => ['attribute_code' => 'code']],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Products::className(), 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'product_id' => 'Product ID',
            'attribute_code' => 'Attribute Code',
        ];
    }

    /**
     * Gets query for [[ProductAttribute]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProductAttribute()
    {
        return $this->hasOne(Attributes::className(), ['code' => 'attribute_code']);
    }

    /**
     * Gets query for [[Product]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Products::className(), ['id' => 'product_id']);
    }
}
