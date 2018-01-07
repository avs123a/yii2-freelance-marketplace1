<?php

namespace backend\controllers;

use Yii;
use common\models\Bid;
use backend\models\BidSearch;
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
		    'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
						'matchCallback' => function ($rule, $action) {
                            return \common\models\User::isUserAdmin(Yii::$app->user->identity->username);
                        }
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
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
		$order_id = $model->order_id;
        if($model->delete()){
			Yii::$app->session->addFlash('success','Вы удалили заявку');
            return $this->redirect(['//order/view', 'id' => $order_id]);
		}else{
			Yii::$app->session->addFlash('error','Ошибка удаления заявки');
			return $this->redirect(['//order/view', 'id' => $order_id]);
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
