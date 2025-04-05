<?php

namespace app\controllers;

use app\models\AuthAssignment;
use Yii;
use app\models\Pegawai;
use app\models\PegawaiSearch;
use app\models\User;
use yii\base\DynamicModel;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;

/**
 * PegawaiController implements the CRUD actions for Pegawai model.
 */
class PegawaiController extends Controller
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
                    'delete' => ['post'],
                    'bulkdelete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Pegawai models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PegawaiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single Pegawai model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $request = Yii::$app->request;
        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'title' => 'Informasi Lengkap Pengguna',
                'content' => $this->renderAjax('view', [
                    'model' => $this->findModel($id),
                ]),
                'footer' => Html::button(Yii::t('yii2-ajaxcrud', 'Close'), ['class' => 'btn btn-default pull-left', 'data-bs-dismiss' => 'modal']) .
                    Html::a(Yii::t('yii2-ajaxcrud', 'Update'), ['update', 'id' => $id], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])
            ];
        } else {
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }
    }

    /**
     * Creates a new Pegawai model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new Pegawai();
        $model_user = new User();
        $model_dinamis = new DynamicModel(['tanggal_lahir', 'tanggal_bergabung', 'role']);
        $model_dinamis->addRule(['tanggal_lahir', 'tanggal_bergabung', 'role'], 'safe');
        $auth = \Yii::$app->authManager;

        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isGet) {
                return [
                    'title' => 'Tambah Pengguna Baru',
                    'content' => $this->renderAjax('create', [
                        'model' => $model,
                        'model_user' => $model_user,
                        'model_dinamis' => $model_dinamis,

                    ]),
                    'footer' => Html::button('Tutup', ['class' => 'btn btn-default pull-left', 'data-bs-dismiss' => 'modal']) .
                        Html::button('Tambah', ['class' => 'btn btn-primary', 'type' => 'submit'])
                ];
            } else if ($model->load($request->post()) && $model_user->load($request->post()) && $model_dinamis->load($request->post())) {
                $transaction = \Yii::$app->db->beginTransaction();
                $model_user->username = $model->nik;
                $model_user->generateAuthKey();
                $model_user->setPassword($model_user->password_hash);
                $model_user->email = $model->nik . '@gmail.com';
                $model_user->created_at = strtotime('now');
                $model_user->updated_at = strtotime('now');
                if (!$flag = $model_user->save()) {
                    $transaction->rollBack();
                    return [
                        'title' => 'Tambah Pengguna Baru',
                        'content' => $this->renderAjax('create', [
                            'model' => $model,
                            'model_user' => $model_user,
                            'model_dinamis' => $model_dinamis,

                        ]),
                        'footer' => Html::button('Tutup', ['class' => 'btn btn-default pull-left', 'data-bs-dismiss' => 'modal']) .
                            Html::button('Tambah', ['class' => 'btn btn-primary', 'type' => 'submit'])
                    ];
                } else {
                    $model->id_user = $model_user->id;
                    $model->tanggal_lahir = strtotime($model_dinamis->tanggal_lahir);
                    $model->tanggal_bergabung = strtotime($model_dinamis->tanggal_bergabung);
                    $model->status = 1;
                    if (!$flag = $model->save()) {
                        $transaction->rollBack();
                        return [
                            'title' => 'Tambah Pengguna Baru',
                            'content' => $this->renderAjax('create', [
                                'model' => $model,
                                'model_user' => $model_user,
                                'model_dinamis' => $model_dinamis,

                            ]),
                            'footer' => Html::button('Tutup', ['class' => 'btn btn-default pull-left', 'data-bs-dismiss' => 'modal']) .
                                Html::button('Tambah', ['class' => 'btn btn-primary', 'type' => 'submit'])
                        ];
                    }
                }

                if ($flag) {
                    $authorRole = $auth->getRole($model_dinamis->role);
                    $auth->assign($authorRole, $model_user->getId());
                    $transaction->commit();
                    return [
                        'forceReload' => '#crud-datatable-pjax',
                        'title' => 'Tambah Pengguna Baru',
                        'content' => '<span class="text-success">' . 'Berhasil Menambah Pengguna Baru' . '</span>',
                        'footer' =>  Html::button('Tutup', ['class' => 'btn btn-default pull-left', 'data-bs-dismiss' => 'modal']) .
                            Html::a('Tambah Lagi', ['create'], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])
                    ];
                }

                return [
                    'forceReload' => '#crud-datatable-pjax',
                    'title' => 'Tambah Pengguna Baru',
                    'content' => '<span class="text-success">' . 'Tambah Pengguna Baru' . Yii::t('yii2-ajaxcrud', 'Success') . '</span>',
                    'footer' =>  Html::button('Tutup', ['class' => 'btn btn-default pull-left', 'data-bs-dismiss' => 'modal']) .
                        Html::a('Tambah Lagi', ['create'], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])
                ];
            } else {
                return [
                    'title' => 'Tambah Pengguna Baru',
                    'content' => $this->renderAjax('create', [
                        'model' => $model,
                        'model_user' => $model_user,
                        'model_dinamis' => $model_dinamis,

                    ]),
                    'footer' => Html::button('Tutup', ['class' => 'btn btn-default pull-left', 'data-bs-dismiss' => 'modal']) .
                        Html::button('Tambah', ['class' => 'btn btn-primary', 'type' => 'submit'])
                ];
            }
        } else {
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                    'model_user' => $model_user,
                    'model_dinamis' => $model_dinamis,
                ]);
            }
        }
    }

    /**
     * Updates an existing Pegawai model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);
        $model_user = User::findOne($model->id_user);
        $model_dinamis = new DynamicModel(['tanggal_lahir', 'tanggal_bergabung', 'role']);
        $model_dinamis->addRule(['tanggal_lahir', 'tanggal_bergabung', 'role'], 'safe');
        $model_dinamis->tanggal_lahir = date('Y-m-d', $model->tanggal_lahir);
        $model_dinamis->tanggal_bergabung = date('Y-m-d', $model->tanggal_bergabung);
        $model_dinamis->role = Yii::$app->manajemen->getPenugasan($model->id_user);
        $auth = \Yii::$app->authManager;
        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isGet) {
                return [
                    'title' => 'Ubah Data ' . $model->nama_lengkap,
                    'content' => $this->renderAjax('update', [
                        'model' => $model,
                        'model_dinamis' => $model_dinamis
                    ]),
                    'footer' => Html::button('Tutup', ['class' => 'btn btn-default pull-left', 'data-bs-dismiss' => 'modal']) .
                        Html::button('Simpan', ['class' => 'btn btn-primary', 'type' => 'submit'])
                ];
            } else if ($model->load($request->post()) && $model_dinamis->load($request->post())) {
                $transaction = \Yii::$app->db->beginTransaction();
                $model_user->username = $model->nik;
                $model_user->email = $model->nik . '@gmail.com';
                if (!$flag = $model_user->save()) {
                    $transaction->rollBack();
                    return [
                        'title' => 'Ubah Data ' . $model->nama_lengkap,
                        'content' => $this->renderAjax('update', [
                            'model' => $model,
                            'model_dinamis' => $model_dinamis

                        ]),
                        'footer' => Html::button('Tutup', ['class' => 'btn btn-default pull-left', 'data-bs-dismiss' => 'modal']) .
                            Html::button('Simpan', ['class' => 'btn btn-primary', 'type' => 'submit'])
                    ];
                } else {
                    $model->tanggal_lahir = strtotime($model_dinamis->tanggal_lahir);
                    $model->tanggal_bergabung = strtotime($model_dinamis->tanggal_bergabung);
                    if (!$flag = $model->save()) {
                        $transaction->rollBack();
                        return [
                            'title' => 'Ubah Data ' . $model->nama_lengkap,
                            'content' => $this->renderAjax('update', [
                                'model' => $model,
                                'model_dinamis' => $model_dinamis

                            ]),
                            'footer' => Html::button('Tutup', ['class' => 'btn btn-default pull-left', 'data-bs-dismiss' => 'modal']) .
                                Html::button('Simpan', ['class' => 'btn btn-primary', 'type' => 'submit'])
                        ];
                    }
                }

                if ($flag) {
                    $auth->revokeAll($model_user->getId());
                    $authorRole = $auth->getRole($model_dinamis->role);
                    $auth->assign($authorRole, $model_user->getId());
                    $transaction->commit();
                    return [
                        'forceReload' => '#crud-datatable-pjax',
                        'title' => $model->nama_lengkap,
                        'content' => $this->renderAjax('view', [
                            'model' => $model,
                            'model_dinamis' => $model_dinamis


                        ]),
                        'footer' => Html::button(Yii::t('yii2-ajaxcrud', 'Close'), ['class' => 'btn btn-default pull-left', 'data-bs-dismiss' => 'modal']) .
                            Html::a(Yii::t('yii2-ajaxcrud', 'Update'), ['update', 'id' => $id], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])
                    ];
                }
                return [
                    'forceReload' => '#crud-datatable-pjax',
                    'title' => $model->nama_lengkap,
                    'content' => $this->renderAjax('view', [
                        'model' => $model,
                        'model_dinamis' => $model_dinamis


                    ]),
                    'footer' => Html::button(Yii::t('yii2-ajaxcrud', 'Close'), ['class' => 'btn btn-default pull-left', 'data-bs-dismiss' => 'modal']) .
                        Html::a(Yii::t('yii2-ajaxcrud', 'Update'), ['update', 'id' => $id], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])
                ];
            } else {
                return [
                    'title' => 'Ubah Data ' . $model->nama_lengkap,
                    'content' => $this->renderAjax('update', [
                        'model' => $model,
                        'model_dinamis' => $model_dinamis

                    ]),
                    'footer' => Html::button(Yii::t('yii2-ajaxcrud', 'Close'), ['class' => 'btn btn-default pull-left', 'data-bs-dismiss' => 'modal']) .
                        Html::button(Yii::t('yii2-ajaxcrud', 'Save'), ['class' => 'btn btn-primary', 'type' => 'submit'])
                ];
            }
        } else {
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                    'model_dinamis' => $model_dinamis

                ]);
            }
        }
    }

    /**
     * Delete an existing Pegawai model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $request = Yii::$app->request;
        $this->findModel($id)->delete();

        if ($request->isAjax) {
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose' => true, 'forceReload' => '#crud-datatable-pjax'];
        } else {
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }
    }

    /**
     * Delete multiple existing Pegawai model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionBulkdelete()
    {
        $request = Yii::$app->request;
        $pks = explode(',', $request->post('pks')); // Array or selected records primary keys
        foreach ($pks as $pk) {
            $model = $this->findModel($pk);
            $model->delete();
        }

        if ($request->isAjax) {
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose' => true, 'forceReload' => '#crud-datatable-pjax'];
        } else {
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }
    }

    /**
     * Finds the Pegawai model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Pegawai the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Pegawai::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
