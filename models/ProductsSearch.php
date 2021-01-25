<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Products;
use app\models\AttributesTypes;

/**
 * ProductsSearch represents the model behind the search form of `app\models\Products`.
 */
class ProductsSearch extends Products
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'price'], 'integer'],
            [['name', 'img'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Products::find();

        // add conditions that should always apply here
		
		if ($priceFrom = (int)$params['priceFrom']) {
			$query->andWhere(['>=', 'price', $priceFrom]);
		}
		
		if ($priceTo = (int)$params['priceTo']) {
			$query->andWhere(['<=', 'price', $priceTo]);
		}
		
		$attributesTypes = AttributesTypes::find()->select('code')->column();
		
		foreach ($attributesTypes as $type) {
			if ($attributes = $params[$type]) {
				$productIDs = ProductsToAttributes::find()->select('product_id')->where(['attribute_code' => explode(',', $attributes)])->column();
				$query->andWhere(['id' => $productIDs]);
			}
		}

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'price' => $this->price,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'img', $this->img]);

        return $dataProvider;
    }
}
