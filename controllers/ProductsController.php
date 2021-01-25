<?php

namespace app\controllers;

use Yii;
use app\models\Products;
use app\models\ProductsSearch;
use app\models\UploadImage;
use app\models\ProductsToAttributes;
use app\models\Attributes;
use app\models\AttributesTypes;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\data\ActiveDataProvider;

/**
 * ProductsController implements the CRUD actions for Products model.
 */
class ProductsController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Products models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Products model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
	
	/**
	* Upload Image
	*/
	public function uploadImage(Products $productsModel): ?string
	{
        if(Yii::$app->request->isPost) {
			$model = new UploadImage();
			$model->image = UploadedFile::getInstance($productsModel, 'img');
			return $model->upload();
        }
		
		return null;
	}
	
	public function addAttributes(Products $productsModel): void
	{
		$request = Yii::$app->request;
		$attributeCodes = $request->post()['Attributes']['code'];
		$attributeNames = $request->post()['Attributes']['name'];
		$typeCodes = $request->post()['AttributesTypes']['code'];
		$typeNames = $request->post()['AttributesTypes']['name'];
		
		foreach($attributeCodes as $k => $value) {
			if ($typeCodes[$k] === '') continue;
			
			if (!$attributeTypeModel = AttributesTypes::findOne($typeCodes[$k])) {
				$attributeTypeModel = new AttributesTypes();
				$attributeTypeModel->code = $typeCodes[$k];
				$attributeTypeModel->name = $typeNames[$k];
				if (!$attributeTypeModel->save()) continue;
			}				
			if (!$attributeModel = Attributes::findOne($value)) {
				$attributeModel = new Attributes();
				$attributeModel->code = $value;
				$attributeModel->name = $attributeNames[$k];
				$attributeModel->type_code = $attributeTypeModel->code;
				if (!$attributeModel->save()) continue;
			}	
			
			$productsModel->link('productsAttributes', $attributeModel);
		}
	}

    /**
     * Creates a new Products model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Products();

        if ($model->load(Yii::$app->request->post())) {
			$model->img = $this->uploadImage($model);
			
			if ($model->save()) {
				$this->addAttributes($model);
				
				return $this->redirect(['view', 'id' => $model->id]);
			}
        }
		
		$attributeModel = new Attributes();
		$attributeTypeModel = new AttributesTypes();

        return $this->render('create', [
            'model' => $model,
			'attributeModel' => $attributeModel,
			'attributeTypeModel' => $attributeTypeModel,
        ]);
    }

    /**
     * Updates an existing Products model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
		$model->scenario = $model::SCENARIO_UPDATE;
		
		$prevImage = $model->img;

        if ($model->load(Yii::$app->request->post())) {
			$model->img = $this->uploadImage($model) ?? $prevImage;
			
			if ($model->save()) {
				$this->addAttributes($model);
				
				if ($model->img !== $prevImage) {
					unlink(Yii::getAlias("@images/$prevImage"));
				}
				
				return $this->redirect(['view', 'id' => $model->id]);
			}
        }

		$dataProvider = new ActiveDataProvider([
			'query' => ProductsToAttributes::find()->where(['product_id' => $id]),
		]);
		
		$attributeModel = new Attributes();
		$attributeTypeModel = new AttributesTypes();

        return $this->render('update', [
            'model' => $model,
			'attributeModel' => $attributeModel,
			'attributeTypeModel' => $attributeTypeModel,
			'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Deletes an existing Products model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
		
		unlink(Yii::getAlias("@images/{$model->img}"));
		
		$model->delete();

        return $this->redirect(['index']);
    }
	
	public function actionDelete_attribute()
    {
        $model = ProductsToAttributes::find()->where(Yii::$app->request->get())->one();
		
		$productID = $model->product_id;
		
		$model->delete();

        return $this->redirect(['update', 'id' => $productID]);
    }

    /**
     * Finds the Products model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Products the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Products::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
