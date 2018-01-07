<?php

namespace frontend\controllers;

use Yii;
use common\models\Bid;
use frontend\models\BidSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * BidController implements the CRUD actions for Bid model.
 */
class BidController extends Controller
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
			'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    
    /**
     * Displays a single Bid model.
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
     * Creates a new Bid model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Bid();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
			Yii::$app->session->addFlash('success','Вы подали заявку к заказу');
            return $this->redirect(['//order/view', 'id' => $model->order_id]);
        } else {
			Yii::$app->session->addFlash('error','Ошибка! Ваша заявка не принята');
            return $this->redirect(['//order/view', 'id' => $model->order_id]);
        }
    }

    /**
     * Updates an existing Bid model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->addFlash('success','Вы успешно обновили заявку к заказу');
            return $this->redirect(['//order/view', 'id' => $model->order_id]);
        } else {
            Yii::$app->session->addFlash('error','Не удалось обновить заявку');
            return $this->redirect(['//order/view', 'id' => $model->order_id]);
        }
    }

    /**
     * Deletes an existing Bid model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
		$model = $this->findModel($id);
		if($model->delete()){
            Yii::$app->session->addFlash('success','Вы удалили заявку к заказу');
            return $this->redirect(['//order/view', 'id' => $model->order_id]);
		}else{
			Yii::$app->session->addFlash('error','Ошибка удаления заявки');
            return $this->redirect(['//order/view', 'id' => $model->order_id]);
		}
		
    }

    /**
     * Finds the Bid model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Bid the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Bid::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
