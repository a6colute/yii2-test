<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;
use yii\web\JqueryAsset;

/* @var $this yii\web\View */
/* @var $model app\models\Products */
/* @var $form yii\widgets\ActiveForm */

$this->registerJsFile('js/form.js', ['depends' => [JqueryAsset::class]]);
?>

<div class="products-form">

    <?php $form = ActiveForm::begin(['enableClientValidation' => false]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'img')->fileInput() ?>
	
	<div class="attributes-form hidden">
	
	<div class="attributes-form-block hidden">
	
	<?= Html::tag('br'); ?>
	
	<?= $form->field($attributeModel, 'code[]')->textInput() ?>
	
	<?= $form->field($attributeModel, 'name[]')->textInput() ?>
	
	<?= $form->field($attributeTypeModel, 'code[]')->textInput() ?>
	
	<?= $form->field($attributeTypeModel, 'name[]')->textInput() ?>
	
	<?= Html::tag('br'); ?>
	
	</div>
	
	</div>
	
	<?= Html::button('Добавить свойство', ['class' => 'btn btn-success btn-add-attribute']) ?>
	
	<?= Html::tag('br'); ?>
	
	<?= Html::tag('br'); ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
	
	<?php if ($dataProvider) { ?>
	
	<?= Html::tag('br'); ?>
	
	<?= Html::tag('h1', 'Свойства товара:'); ?>
	
	<?= Html::tag('br'); ?>
	
	<?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'productAttribute.type.name',
            'productAttribute.name',
            [
				'class' => 'yii\grid\ActionColumn',
				'template' => '{delete}',
				'buttons' => [
					'delete' => function ($url,$model,$key) {
						return Html::a(Html::tag('span', '', ['class' => 'glyphicon glyphicon-trash']), str_replace('delete', 'delete_attribute', $url));
					},
				],
			],
        ],
    ]); ?>
	
	<?php } ?>

</div>
