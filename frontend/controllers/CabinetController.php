<?php
namespace frontend\controllers;

use common\models\User;
use common\models\Order;
use common\models\Bid;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\data\Pagination;

class CabinetController extends Controller
{
	public function behaviors()
    {
        return [
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
	//main cabinet page
	public function actionIndex()
	{
		$user = User::findOne(['username' => \Yii::$app->user->identity->username]);
		$orders = Order::find()->where(['user_id' => $user->id])->count();
		$bids = Bid::find()->where(['user_id' => $user->id])->count();
		
		return $this->render('index',[
		   'user' => $user,
		   'orders' => $orders,
		   'bids' => $bids
		]);
	}
	
	
	//view profile
	public function actionProfileView($id)
	{
		$model = User::findOne($id);
		if($new_email = \Yii::$app->request->post('email_new')){
			$model->email = $new_email;
			if($model->save()){
				\Yii::$app->session->addFlash('success','Вы успешно сменили email');
			}
			else{
				\Yii::$app->session->addFlash('error','Не удалось сменить email');
			}
		}
		return $this->render('profile-view',['model' => $model]);
	}
	
	//update profile
	public function actionProfileUpdate()
	{
		$model = User::findOne(['username' => \Yii::$app->user->identity->username]);
		if ($model->load(\Yii::$app->request->post()) && $model->save()) {
			\Yii::$app->session->addFlash('success','Вы успешно обновили профиль');
			return $this->redirect(['cabinet/profile-view']);
		}
		else{
			return $this->render('profile-update',[
			   'model' => $model,
			]);
		}
	}
	
	//user order archive
	public function actionOrders()
	{
		$user = User::findOne(['username' => \Yii::$app->user->identity->username]);
		
		$model = $user->getOrders()->indexBy('id')->asArray()->all();
		return $this->render('orders',['model' => $model]);
	}
	//
	
	public function actionBids()
	{
		$user = User::findOne(['username' => \Yii::$app->user->identity->username]);
		
		$model = $user->getBids()->indexBy('id')->asArray()->all();
		return $this->render('bids',['model' => $model]);
	}
	
	//messages
	public function actionMessages()
	{
		$user = User::findOne(['username' => \Yii::$app->user->identity->username]);
		
		$sent = (new \yii\db\Query())->select(['message.id', 'surname', 'name', 'username', 'subject', 'text'])->from('message')->innerJoin('user', 'user.id = message.receiver_id')->where(['sender_id' => \Yii::$app->user->getId()])->orderBy('id DESC')->offset($pagination->offset)->limit($pagination->limit)->all();
		$recvmsg = (new \yii\db\Query())->select(['message.id', 'surname', 'name', 'username', 'subject', 'text'])->from('message')->innerJoin('user', 'user.id = message.sender_id')->where(['receiver_id' => \Yii::$app->user->getId()])->orderBy('id DESC')->offset($pagination->offset)->limit($pagination->limit)->all();
		$pagination = new Pagination(['defaultPageSize' => 5, 'totalCount' => max(count($sent),count($recvmsg))]);
		return $this->render('messages',[
		'sent' => $sent,
		'recvmsg' => $recvmsg,
		'pagination' => $pagination,
		]);
	}
	
	public function actionDeleteMessage($msg_id)
	{
		$message = \common\models\Message::findOne($msg_id);
		if($message->delete()){
			\Yii::$app->session->addFlash('success','Сообщение успешно удалено');
		    return $this->redirect(['//messages']);
		}else{
			\Yii::$app->session->addFlash('error','Ошибка удаления сообщения');
			return $this->redirect(['//messages']);
		}
	}
	
	
}
?>