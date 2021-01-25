<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "products".
 *
 * @property int $id
 * @property string $name
 * @property int $price
 * @property string $img
 *
 * @property ProductsToAttributes[] $productsToAttributes
 * @property Attributes[] $productsAttributes
 */
class Products extends \yii\db\ActiveRecord
{
	const SCENARIO_UPDATE = 'update';
	
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'products';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'price', 'img'], 'required'],
            [['price'], 'integer'],
            [['name', 'img'], 'string', 'max' => 255],
        ];
    }
	
	public function scenarios()
	{		
		return ArrayHelper::merge(parent::scenarios(), [
			self::SCENARIO_UPDATE => ['name', 'price']
		]);
	}

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'price' => 'Price',
            'img' => 'Img',
        ];
    }

    /**
     * Gets query for [[ProductsToAttributes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProductsToAttributes()
    {
        return $this->hasMany(ProductsToAttributes::className(), ['product_id' => 'id']);
    }

    /**
     * Gets query for [[Attributes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProductsAttributes()
    {
        return $this->hasMany(Attributes::className(), ['code' => 'attribute_code'])->viaTable('products_to_attributes', ['product_id' => 'id']);
    }
}
