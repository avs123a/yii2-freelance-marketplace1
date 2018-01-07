<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;

/**
 * Site controller
 */
class SiteController extends Controller
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
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
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
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
		$users = \common\models\User::find()->count();
		$orders = \common\models\Order::find()->count();
		$bids = \common\models\Bid::find()->count();
		$msg = \common\models\Message::find()->count();
        return $this->render('index', [
		    'users' => $users,
			'orders' => $orders,
			'bids' => $bids,
			'msg' => $msg,
		]);
    }
	
	/**
	*DELETE all messages action
	*/
	public function actionClearMessages()
	{
		if(\common\models\Message::deleteAll())
		{
			Yii::$app->session->addFlash('success', 'Вы успешно очистили сообщения на сайте');
			return $this->redirect('//site/index');
		}else{
			Yii::$app->session->addFlash('error', 'Ошибка очистки сообщений');
			return $this->redirect('//site/index');
		}
	}
	

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->loginAdmin()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
