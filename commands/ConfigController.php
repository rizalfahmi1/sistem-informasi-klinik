<?php

namespace app\commands;

use mdm\admin\models\Menu;
use app\models\User;
use Yii;
use yii\console\Controller;
use yii\console\ExitCode;
use mdm\admin\components\Helper;
use Spatie\Crypto\Rsa\KeyPair;

class ConfigController extends Controller
{
    public function actionTambahItem($tipe, $item, $description = NULL)
    {
        $type = NULL;

        if ($tipe == 'role') {
            $type = 1;
        } elseif ($tipe == 'item') {
            $type = 2;
        }

        $model = \app\models\AuthItem::findOne(['name' => $item, 'type' => $type]);

        if (!$model) {
            $model = new \app\models\AuthItem();
        }

        $model->name = $item;
        $model->type = $type;
        $model->description = $description;

        if ($model->save()) {
            var_dump($model->name . ' done');
        } else {
            var_dump($model->errors);
        }
    }

    public function actionTambahMenu($name, $route, $order, $parent = NULL)
    {
        $model = new Menu;

        if ($parent) {
            $parent = Menu::findOne(["name" => $parent]);
            $model->parent = $parent->id;
            $model->name = $name;
            $model->route = $route;
            $model->order = $order;
            $model->save();
            Helper::invalidate();
        } else {
            $model->name = $name;
            $model->route = $route;
            $model->order = $order;
            $model->save();
            Helper::invalidate();
        }
    }

    public function actionTambahItemChild($parent, $child)
    {
        $model = \app\models\AuthItemChild::findOne(['parent' => $parent, 'child' => $child]);

        if (!$model) {
            $model = new \app\models\AuthItemChild();
        }

        $model->parent = $parent;
        $model->child = $child;

        if ($model->save()) {
            var_dump($model->parent . ' - ' . $model->child . ' done');
        } else {
            var_dump($model->errors);
        }
    }

    public function actionTambahUser($username, $password, $role)
    {
        $model = \app\models\User::findOne(['username' => $username]);

        if (!$model) {
            $model = new \app\models\User();
        }

        $model->username = $username;
        $model->email = $username . '@mail.com';
        $model->setPassword($password);
        $model->generateAuthKey();
        $model->created_at = time();
        $model->updated_at = time();

        if ($model->save()) {
            Yii::$app->authManager->revokeAll($model->getId());
            $auth = Yii::$app->authManager;
            $authorRole = $auth->getRole($role);

            if ($auth->assign($authorRole, $model->getId())) {
                var_dump($model->username . ' done');
            }
        }
    }

    public function actionTambahDataPegawai($username, $password)
    {
        $model = new User();

        $model->username = $username;
        $model->setPassword($password);
        $model->email = $username . '$gmail.com';
        $model->generateAuthKey();
        $model->created_at = time();
        $model->updated_at = time();

        if ($model->save()) {
            $auth = Yii::$app->authManager;
            $authorRole = $auth->getRole('pegawai');

            if ($auth->assign($authorRole, $model->getId())) {
                var_dump($model->username . ' done');
            }
        } else {
            var_dump($model->errors);
        }
    }

    public function actionTambahAdmin($username, $password)
    {
        $this->actionTambahItem('role', 'admin_sistem', 'admin sistem');
        $this->actionTambahUser($username, $password, 'admin_sistem');
        $this->actionTambahItem('item', '/admin/*');
        $this->actionTambahItem('item', '/debug/*');
        $this->actionTambahItem('item', '/gii/*');
        $this->actionTambahItem('item', '/gridview/*');
        $this->actionTambahItem('item', '/user/*');
        $this->actionTambahItem('item', '/assignment/*');
        $this->actionTambahItem('item', '/role/*');
        $this->actionTambahItem('item', '/permission/*');
        $this->actionTambahItem('item', '/route/*');
        $this->actionTambahItem('item', '/rule/*');
        $this->actionTambahItem('item', '/menu/*');
        $this->actionTambahItemChild('admin_sistem', '/admin/*');
        $this->actionTambahItemChild('admin_sistem', '/debug/*');
        $this->actionTambahItemChild('admin_sistem', '/gii/*');
        $this->actionTambahItemChild('admin_sistem', '/gridview/*');
        $this->actionTambahItemChild('admin_sistem', '/user/*');
        $this->actionTambahItemChild('admin_sistem', '/assignment/*');
        $this->actionTambahItemChild('admin_sistem', '/role/*');
        $this->actionTambahItemChild('admin_sistem', '/permission/*');
        $this->actionTambahItemChild('admin_sistem', '/route/*');
        $this->actionTambahItemChild('admin_sistem', '/rule/*');
        $this->actionTambahItemChild('admin_sistem', '/menu/*');
    }
}
