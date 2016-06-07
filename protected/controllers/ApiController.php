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
        $data = $_REQUEST['Appeal'];
        if (!$data) {
            $this->_json(['error' => 1, 'errCode' => 100]);
            return;
        }
        $model = new Appeal();
        $model->setAttributes($data);
        if ($model->validate()) {
            if (!empty($_FILES)) {
        	    if (move_uploaded_file($_FILES['file']['tmp_name'],'/var/www/pavko/data/www/690000.ru/attaches/'.$_FILES['file']['name'])) $model->file = $_FILES['file']['name'];
            }
            $model->save();
        } else {
            $this->_json([
                'error' => 1,
                'errCode' => 101,
                'errors' => $model->errors
            ]);
            return;
        }
        //@todo send an email
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

}