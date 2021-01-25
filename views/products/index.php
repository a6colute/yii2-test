<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="products-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Products', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'price',
            [
				'attribute' => 'img',
				'content'=>function($data) {
					return Html::img('/uploads/' . $data->img);
				}
			],
			[
				'label' => 'Свойства',
				'format' => 'raw',
				'content'=>function($data) {
					if ($data->productsToAttributes) {
						$attributes = [];
						foreach ($data->productsToAttributes as $attribute) {
							$attributes[] = $attribute->productAttribute->type->name . ':' . $attribute->productAttribute->name;
						}
						return implode('<br />', $attributes);
					}
					
					return '';
				}
			],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
