<?php

/**
 * Created by PhpStorm.
 * User: dkhodakovskiy
 * Date: 5/31/16
 * Time: 5:55 PM
 */
class ApiController extends Controller
{

    public function actionAuth()
    {
        @file_put_contents('/var/www/pavko/data/www/690000.ru/protected/runtime/input.log',print_r($_REQUEST,true),FILE_APPEND);
        $data = $_REQUEST['User'];
        if (!$data) {
            $this->_json(['error' => 1, 'errCode' => 100]);
            return;
        }
        $model = new User();
        $model->setAttributes($data);
        if ($model->validate()) {
            $model->save();
        } else {
            $this->_json([
                'error' => 1,
                'errCode' => 101,
                'errors' => $model->errors
            ]);
            return;
        }

        $code = rand(100000,999999);
        Yii::app()->sms->send("Ваш код: $code",$model->phone);

        $this->_json([
            'error' => 0,
            'id' => $model->id,
            'code' => $code,
            'errCode' => 200,
        ]);
    }

    public function actionAuthForm()
    {
        if (Yii::app()->params['testMode']) $this->render('auth', ['model' => new User()]);
    }

    public function actionAppeal()
    {
        @file_put_contents('/var/www/pavko/data/www/690000.ru/protected/runtime/input.log',print_r($_REQUEST,true),FILE_APPEND);
        @file_put_contents('/var/www/pavko/data/www/690000.ru/protected/runtime/input.log',print_r($_FILES,true),FILE_APPEND);
        $data = $_REQUEST['Appeal'];
        if (!$data) {
            $this->_json(['error' => 1, 'errCode' => 100]);
            return;
        }
        $model = new Appeal();
        $model->setAttributes($data);
        if ($model->validate()) {
            $model->save();
        } else {
            $this->_json([
                'error' => 1,
                'errCode' => 101,
                'errors' => $model->errors
            ]);
            return;
        }

        if (!empty($_FILES)) {
            foreach ($_FILES as $file) {
                if (move_uploaded_file($file['tmp_name'],'/var/www/pavko/data/www/690000.ru/attaches/'.$file['name'])) {
                    $fileModel = new File();
                    $fileModel->setAttributes([
                        'name' => $file['name'],
                        'appeal_id' => $model->id,
                    ]);
                    if (!$fileModel->validate() || !$fileModel->save()) @file_put_contents('/var/www/pavko/data/www/690000.ru/protected/runtime/input.log',print_r($file->errors,true),FILE_APPEND);
                }
            }
        }

        $e = new Emailer();
        $region = Region::model()->findByPk($model->user->region_id);
        if (!$region->email) $to = 'zapros@czpg.ru'; else $to = $region->email;
        $e->to($to)->subject("{$model->id} {$model->category} {$region->name}")->message(
            $this->renderPartial('//api/appeal',['model' => $model],true)
        )->html(true)->send();

        $this->_json([
            'error' => 0,
            'id' => $model->id,
            'errCode' => 200,
        ]);
    }

    private function _json($data)
    {
        header('Content-Type: application/json');
        echo CJSON::encode($data);
    }

    public function actionE()
    {
        $email = Yii::app()->email;
        $email->to = 'andrewverner85@gmail.com';
        $email->subject = 'Hello';
        $email->message = 'Hello <strong>brother</strong>';
        var_dump($email->send());
    }

    public function actionGetRegion($id)
    {
        $region = Region::model()->findByPk($id);
        if ($region) {
            $users = User::model()->findAllByAttributes(['region_id' => $id]);
            if ($users) {
                header('Content-Type: application/octet-stream');
                header('Content-Disposition: attachment; filename='.$region->name.'.csv');
                foreach ($users as $user) {
                    echo "{$user->id};{$user->region_id};{$user->last_name};{$user->first_name};{$user->middle_name};{$user->phone};
";
                }
                exit;
            }
            else
                echo "Пользователей в данном регионе нет ($region->name)";
        }
        else
            echo "Неверный регион";
    }

}
