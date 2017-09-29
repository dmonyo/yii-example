<?php

namespace app\controllers;

use Yii;
use app\models\Contact;
use app\models\Address;
use app\models\ContactSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ContactController implements the CRUD actions for Contact model.
 */
class ContactController extends Controller
{
    /**
     * @inheritdoc
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
     * Lists all Contact models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ContactSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Contact model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Contact model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Contact();
        $model->default_contact = 0;
        $addressModel = new Address();

        if ($model->load(Yii::$app->request->post()) && $addressModel->load(Yii::$app->request->post()) ) {
            $company = \app\models\Company::findOne($model->company_id);
            $model->default_contact = $company->default == null? 1 : 0;
           if($model->save()){
              $addressModel->contact_id = $model->id;
              if($addressModel->save())
                return $this->redirect(['view', 'id' => $model->id]);
           }
        }

        return $this->render('create', [
            'model' => $model,
            'addressModel' => $addressModel,
        ]);
    }

    /**
     * Updates an existing Contact model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $addressModel = Address::findOne(['contact_id' => $model->id]);

         if ($model->load(Yii::$app->request->post()) && $addressModel->load(Yii::$app->request->post()) ) {
           if($model->save()){
              $addressModel->contact_id = $model->id;
              if($addressModel->save())
                return $this->redirect(['view', 'id' => $model->id]);
           }
        }

        return $this->render('update', [
            'model' => $model,
            'addressModel' => $addressModel,
        ]);
    }

    /**
     * Deletes an existing Contact model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Contact model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Contact the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Contact::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
