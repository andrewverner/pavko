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
        $data = Yii::app()->request->getPost('User');
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
        //Yii::app()->sms->send("Ваш код: $code",$model->phone);

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
        $data = Yii::app()->request->getPost('Appeal');
        if (!$data) {
            $this->_json(['error' => 1, 'errCode' => 100]);
            return;
        }
        $model = new Appeal();
        $model->setAttributes($data);
        if ($model->validate()) {
            //@todo upload a file
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

}