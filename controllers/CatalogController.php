<?php

namespace app\controllers;

use Yii;
use app\models\Products;
use app\models\ProductsSearch;
use yii\data\ActiveDataProvider;
use app\models\ProductsToAttributes;

class CatalogController extends \yii\web\Controller
{
	public function attributesWithTypes(): array
	{
		$result = [];
		
		foreach (ProductsToAttributes::find()->all() as $attribute) {
			$result[$attribute->productAttribute->type_code]['name'] = $attribute->productAttribute->type->name;
			$result[$attribute->productAttribute->type_code]['attributes'][$attribute->productAttribute->code] = $attribute->productAttribute->name;
			$result[$attribute->productAttribute->type_code]['checked'] = explode(',', Yii::$app->request->get($attribute->productAttribute->type_code));
		}
		
		return $result;
	}
	
    public function actionIndex()
    {
		$searchModel = new ProductsSearch();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		
		$priceFrom = Yii::$app->request->get('priceFrom') ?? '';
		$priceTo = Yii::$app->request->get('priceTo') ?? '';
		
        return $this->render('index', ['dataProvider' => $dataProvider, 'checkboxFilter' => $this->attributesWithTypes(), 'priceFrom' => $priceFrom, 'priceTo' => $priceTo]);
    }

}
