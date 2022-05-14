<?php

namespace app\controllers;

use app\models\Notification;
use app\models\NotificationSearch;
use app\models\UserNotification;

use Yii;
use yii\base\InvalidConfigException;
use yii\db\StaleObjectException;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * NotificationController implements the CRUD actions for Notification model.
 */
class NotificationController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => AccessControl::class,
                    'rules' => [
                        [
                            'allow' => true,
                            'actions' => ['index'],
                            'roles' => ['@']
                        ],
                        [
                            'allow' => true,
                            'actions' => ['view'],
                            'roles' => ['viewNotification'],
                            'roleParams' => ['notificationId' => Yii::$app->request->get('idNotification')],
                        ],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Notification models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new NotificationSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Notification model.
     * @param int $idNotification Id Notification
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     * @throws StaleObjectException if the model cannot be updated
     * @throws InvalidConfigException if the model have some configuration errors
     */
    public function actionView($idNotification)
    {
        $model = $this->findModel($idNotification);
        $userNotification = UserNotification::findOne(
            [
                'refNotification' => $model->idNotification,
                'refUser' => Yii::$app->user->id
            ]
        );

        if(!$userNotification) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        if(empty($userNotification->readDate)) {
            $userNotification->readDate = Yii::$app->formatter->asDatetime('now', 'php:Y-m-d H:m:i');
            $userNotification->update();

        }

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Finds the Notification model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $idNotification Id Notification
     * @return Notification the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idNotification)
    {
        if (($model = Notification::findOne(['idNotification' => $idNotification])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
