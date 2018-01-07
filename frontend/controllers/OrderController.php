<?php

namespace frontend\controllers;

use Yii;
use common\models\Order;
use common\models\User;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\data\Pagination;
use common\models\Bid;
use common\models\Message;
use yii\filters\VerbFilter;

/**
 * OrderController implements the CRUD actions for Order model.
 */
class OrderController extends Controller
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
     * Lists all Order models.
     * @return mixed
     */
    public function actionIndex()
    {
        $query = Order::find();
		$category = null;
        
		//global search
		if($srch = Yii::$app->request->get('gsearch')){
			$query->orFilterWhere(['like', 'title', $srch])->orFilterWhere(['like', 'skills', $srch]);
		}
		
		
		//menu
		if($f1 = Yii::$app->request->get('sd')){
			$query->orFilterWhere(['category'=>$f1]);
			$category = $f1;
		}
		if($f1 = Yii::$app->request->get('wr')){
			$query->orFilterWhere(['category'=>$f1]);
			$category = $f1;
		}
		if($f1 = Yii::$app->request->get('wp')){
			$query->orFilterWhere(['category'=>$f1]);
			$category = $f1;
		}
		if($f1 = Yii::$app->request->get('imk')){
			$query->orFilterWhere(['category'=>$f1]);
			$category = $f1;
		}
		if($f1 = Yii::$app->request->get('sk')){
			$query->orFilterWhere(['category'=>$f1]);
			$category = $f1;
		}
		if($f1 = Yii::$app->request->get('cms')){
			$query->orFilterWhere(['category'=>$f1]);
			$category = $f1;
		}
		if($f1 = Yii::$app->request->get('st')){
			$query->orFilterWhere(['category'=>$f1]);
			$category = $f1;
		}
		if($f1 = Yii::$app->request->get('prog')){
			$query->orFilterWhere(['category'=>$f1]);
			$category = $f1;
		}
		if($f1 = Yii::$app->request->get('progsys')){
			$query->orFilterWhere(['category'=>$f1]);
			$category = $f1;
		}
		if($f1 = Yii::$app->request->get('databases')){
			$query->orFilterWhere(['category'=>$f1]);
			$category = $f1;
		}
		if($f1 = Yii::$app->request->get('games')){
			$query->orFilterWhere(['category'=>$f1]);
			$category = $f1;
		}
		if($f1 = Yii::$app->request->get('testing')){
			$query->orFilterWhere(['category'=>$f1]);
			$category = $f1;
		}
		if($f1 = Yii::$app->request->get('mobilesoft')){
			$query->orFilterWhere(['category'=>$f1]);
			$category = $f1;
		}
		
		//filters
		$search_status='Все проекты';
		if($actual = Yii::$app->request->get('actuality')){
			switch($actual){
			   case 'all_projects': $search_status = 'Все проекты'; break;
			   case 'active_projects': $query->andFilterWhere(['status' => 'Активный']); $search_status = 'Активные'; break;
			   case 'closed_projects': $query->andFilterWhere(['not', ['status' => 'Активный']]); $search_status = 'Завершенные'; break;
			}
		}
		
		
		
		$pagination = new Pagination(['defaultPageSize' => 12, 'totalCount' => $query->count()]);
		$order = $query->orderBy('id DESC')->offset($pagination->offset)->limit($pagination->limit)->indexBy('id')->asArray()->all();
		
		
		
		$methods = null;
		foreach($order as $ord){
			$methods[$ord['id']] = \common\models\Payment::find()->where(['order_id' => $ord['id']])->asArray()->all();
		}
        return $this->render('index', [
            'model' => $order,
			'selected_category' => $category,
			'search_status' => $search_status,
			'methods' => $methods,
            'pagination' => $pagination,
        ]);
    }

    /**
     * Displays a single Order model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
		$editable = false;
		$model = $this->findModel($id);
		$user = User::findOne($model->user_id);
		if($user->username == Yii::$app->user->identity->username)
			$editable = true;
		$query = (new \yii\db\Query())->select(['surname', 'name', 'username', 'price', 'bid.status', 'bid.id', 'user.id AS userid', 'comment', 'currency', 'term'])->from('user')->innerJoin('bid', 'bid.user_id = user.id')->where(['bid.order_id' => $model->id]);
		$pagination = new Pagination(['defaultPageSize' => 5, 'totalCount' => $query->count()]);
		
		//add payment method
		if(Yii::$app->request->post('addmethod')){
			$mt = new \common\models\Payment();
			$mt->order_id = $id;
			$mt->title = Yii::$app->request->post('method_pay');
			if($mt->save()){
				Yii::$app->session->addFlash('success','Вы добавили ПС');
			}else{
				Yii::$app->session->addFlash('error','Ошибка добавления ПС');
			}
		}
		//clear payment method
		if(Yii::$app->request->post('resetmethod')){
		   if(\common\models\Payment::deleteAll(['order_id' => $id])==0){
			   Yii::$app->session->addFlash('error','Ошибка очистки ПС');
		   }else{
			   Yii::$app->session->addFlash('success','Вы очистили список ПС');
		   }
		}
		
		//choose or ignore freelancer's bid
		if(Yii::$app->request->post('choose')){
			$bid1 = Bid::findOne(Yii::$app->request->post('bid_id'));
			$bid1->status = "Одобрена";
			
			$model->worker_login = Yii::$app->request->post('wlogin');
			$model->status = "Указан исполнитель";
			if($bid1->save() && $model->save()){
				Yii::$app->session->addFlash('success','Вы выбрали исполнителя');
			}else{
				Yii::$app->session->addFlash('error','Ошибка сохранения выбранного исполнителя');
			}
		}
		if(Yii::$app->request->post('ignore')){
			$bid1 = Bid::findOne(Yii::$app->request->post('bid_id'));
			$bid1->status = "Отклонена";
			if($bid1->save()){
				Yii::$app->session->addFlash('success','Вы отклонили заявку');
			}else{
				Yii::$app->session->addFlash('error','Ошибка отклонения заявки');
			}
		}
		
		
		$bids = $query->orderBy('bid.id')->offset($pagination->offset)->limit($pagination->limit)->all();
		$methods = $model->getMethods()->orderBy('id')->indexBy('id')->asArray()->all();
		
        return $this->render('view', [
            'model' => $model,
			'customer' => $user,
			'editable' => $editable,
			'bids' => $bids,
			'methods' => $methods,
			'pagination' => $pagination,
        ]);
    }

    /**
     * Creates a new Order model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Order();


        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Order model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Order model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
	
	//send message to customer
	public function actionSendMessage($rec_id)
	{
		if(Yii::$app->request->post('send_msg'))
		{
			$message = new Message();
			$message->sender_id = Yii::$app->user->getId();
			$message->receiver_id = $rec_id;
			$message->subject = Yii::$app->request->post('subject');
			$message->text = Yii::$app->request->post('msgtext');
			if($message->save()){
				Yii::$app->session->addFlash('success','Вы успешно отправили сообщение');
			}else{
				Yii::$app->session->addFlash('error','Ошибка отправки сообщения');
			}
			return $this->redirect(['//cabinet/messages']);
		}
		
		
		
		
	}

    /**
     * Finds the Order model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Order the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Order::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
